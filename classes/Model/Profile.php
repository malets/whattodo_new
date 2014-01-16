<?php
defined('SYSPATH') or die('No direct script access.');
 
class Model_Profile extends Model
{
    protected $_tableAchivments = 'achivments';
    protected $_tableCategories = 'categories';
    protected $_tableUserInfo = 'userInfo';
    protected $_tableUserPhotos = 'userPhotos';
    protected $_tableSNUsers = 'socialUsers';
    

    public function get_achivments($user_id){
        $categoriesQ = DB::select()
            ->from($this->_tableAchivments)
            ->where('UserID','=',$user_id)
            ->execute();
        
        $result = $categoriesQ->as_array();
 
            if($result)
                return $result;
            else
                return array();
    }
    
     public function get_all_categories(){
        $categoriesQ = DB::select()
            ->from($this->_tableCategories)
            ->execute();
        
        $result = $categoriesQ->as_array();
 
            if($result)
                return $result;
            else
                return array();
    }
    
    public function edit_profile($values){
         $result = DB::update($this->_tableUserInfo)
                 ->set($values)
                 ->where('userID','=', $values['userID'])
                 ->execute();
         
             return $result;
             
         
    }
    
    public function get_profile($userID){
        $profileQ = DB::select()
                ->from($this->_tableUserInfo)
                ->where('userID', '=', $userID)
                ->execute();
        
        $result = $profileQ->as_array();
        
        if($result)
            return $result[0];
        else
            return false;
        
    }
    
    public function add_photo($userID, $Path){
               $result = DB::insert($this->_tableUserPhotos, array('userID', 'Path'))
                ->values(array($userID, $Path))
                ->execute();
               
        return $result;
    }
    
    public function get_user_photos($userID){
        $photosQ = DB::select('Path')
                ->from($this->_tableUserPhotos)
                ->where('userID','=',$userID)
                ->execute();
        
        $result = $photosQ->as_array();
        return $result;
    }
    
    public function get_user_vk_id($userID){
        $userQ = DB::select('networkUserID')
                ->from($this->_tableSNUsers)
                ->where('userID','=',$userID)
                ->and_where('network', '=', 'vkontakte')
                ->execute();
        
                
        $result = $userQ->as_array();
        
        if($result)
            return $result[0]['networkUserID'];
        else
            return false;
    }
}
?>
