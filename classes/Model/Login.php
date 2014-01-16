<?php
defined('SYSPATH') or die('No direct script access.');
 
class Model_Login extends Model
{
    protected $_tableUsers = 'users';
    protected $_tableUnactiveUsers = 'unactiveUsers';
    protected $_tableUserRole = 'roles_users';
    protected $_tableUserInfo = 'userInfo';
    protected $_tableSNUsers = 'socialUsers';



    public function add_user($email, $pass, $activationCode){
        DB::insert($this->_tableUsers, array('username', 'email', 'password'))
                ->values(array($email, $email, $pass))
                ->execute();
        
        $id = mysql_insert_id();
        
        DB::insert($this->_tableUnactiveUsers, array('userID', 'CODE'))
                ->values(array($id, $activationCode))
                ->execute();

    }
    
    public function add_social_user($userID, $userInfo, $email, $networkInfo){
        DB::insert($this->_tableUsers, array('username', 'password', 'email')) //поле с паролем не м.б. пустым иначе вылетает ексепшн
                ->values(array($userID, 0, $email))
                ->execute();
        
         $id = mysql_insert_id();
        
        DB::insert($this->_tableUserInfo, array_merge(array('userID'),array_keys($userInfo)) )
        ->values( array_merge(array($id), array_values($userInfo)) )
        ->execute();
  

        DB::insert($this->_tableSNUsers, array('userID', 'network', 'networkUserID'))
                ->values(array($id, $networkInfo['name'],  $networkInfo['userID']))
                ->execute();
        
    }


    public function activation($email, $code){
         $userIDq = DB::select()
                 ->from($this->_tableUsers)
                 ->where('email', '=', $email)
                 ->execute();
         
         $userID = $userIDq->as_array();
         
         if(!$userID)
             return 'Пользователь с email '+$email+' не был найден в базе';
         
         $userID = $userID[0]['id'];

         $activateUser = DB::select()
            ->from($this->_tableUnactiveUsers)
            ->where('userID','=',$userID)
            ->and_where('CODE', '=', $code)
            ->execute();
         
        $result = $activateUser->as_array();
        
        if(!$result)
            return 'Пользователь с email '+$email+' был удалён до того, как активировал свою запись';
        
        DB::delete($this->_tableUnactiveUsers)
            ->where('userID','=',$userID)
            ->and_where('CODE', '=', $code)
            ->execute();
        
        DB::update($this->_tableUsers)
                ->set(array('activate'=>true))
                ->where('id', '=', $userID)
                ->execute();
				
        DB::insert($this->_tableUserRole, array('user_id', 'role_id'))
                        ->values(array($userID, '1'))
                        ->execute();
        
        DB::insert($this->_tableUserInfo, array('userID'))
                ->values(array($userID))
                ->execute();
		
        
        return true;
    }
    
    public function is_user_exist($username){
                $userQ = DB::select()
            ->from($this->_tableUsers)
            ->where('username','=',$username)
            ->execute();
        
        $result = $userQ->as_array();
 
            if($result)
                return true;
            else
                return false;
    }
    
    public function get_social_user_info($network, $networkUserID){
        $userQ =  DB::select()
            ->from($this->_tableSNUsers)
            ->where('network','=',$network)
            ->and_where('networkUserID', '=', $networkUserID)
            ->execute();
        
        $result = $userQ->as_array();
            if($result)
                return $result[0];
            else
                return false;
    }
    
    public function social_users_count(){
        $count = DB::select(DB::expr('count(distinct userID) as different_users'))
                ->from($this->_tableSNUsers)
                ->execute();
        
        $result = $count->as_array();

        return $result[0]["different_users"];
    }
    
    public function get_user_data_by_id($userID){
        $userQ = DB::select()
                ->from($this->_tableUsers)
                ->where('ID', '=', $userID)
                ->execute();
        
        $result = $userQ->as_array();
 
            if($result)
                return $result[0];
            else
                return false;
    }
}
?>
