<?php
defined('SYSPATH') or die('No direct script access.');
 
class Model_ListOfAchivments extends Model
{
    protected $_tableAchivments = 'achivments';
    protected $_tableCategories = 'categories';
    
    public function get_user_achivments($user_id)
    {
        $achivmentsListQ = DB::select()
                    ->from($this->_tableAchivments)
                    ->where('ID','=',$user_id)
                    ->execute();
        
         $result = $achivmentsListQ->as_array();
 
            //if($result)
                return $result;
            //else
           //     return FALSE;
    }
    
    public function get_achivments_from_category($category_id)
    {
         $achivmentsListQ = DB::select()
                    ->from($this->_tableAchivments)
                    ->where('CategoryID','=',$category_id)
                    ->execute();
        
         $result = $achivmentsListQ->as_array();
 
            //if($result)
                return $result;
    }
    
    public function get_categoryINFO_by_URL($url){
        $categoryIDQ = DB::select()
                    ->from($this->_tableCategories)
                    ->where('URL','=',$url)
                    ->execute();
        
        $result = $categoryIDQ->as_array();
 
            if($result)
                return $result[0];
            else
                return false;
    }
}
?>
