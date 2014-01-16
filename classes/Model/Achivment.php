<?php
defined('SYSPATH') or die('No direct script access.');
 
class Model_Achivment extends Model
{
    protected $_tableAchivments = 'achivments';

    public function get_achivment_by_id($achivmentID){
        $categoriesQ = DB::select()
            ->from($this->_tableAchivments)
            ->where('ID','=',$achivmentID)
            ->execute();
        
        $result = $categoriesQ->as_array();
 
            if($result)
                return $result[0];
            else
                return false;
    }
    
    public function add_goal($name, $description, $categoryID, $userID){
        DB::insert($this->_tableAchivments, array('Name', 'Description', 'CategoryID','UserID'))
                ->values(array($name, $description, $categoryID, $userID))
                ->execute();
    }
    
        
    public function achive_goal($goalID){
        $result = DB::update($this->_tableAchivments)
                ->set(array('achived'=>true))
                ->where('ID','=',$goalID)
                ->execute();
        
        return $result;
    }
    
    public function get_goal_user($goalID){
        $userQ = DB::select('UserID')
                ->from($this->_tableAchivments)
                ->where('ID', '=', $goalID)
                ->execute();
        
                $result = $userQ->as_array();
 
        if($result)
                return $result[0]['UserID'];
          else
                return false;
    }
}
?>
