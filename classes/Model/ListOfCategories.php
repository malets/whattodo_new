<?php
defined('SYSPATH') or die('No direct script access.');
 
class Model_ListOfCategories extends Model
{
    protected $_tableAchivments = 'achivments';
    protected $_tableCategories = 'categories';

    public function get_all_categories(){
        $categoriesQ = DB::select()
            ->from($this->_tableCategories)
            ->execute();
        
        $result = $categoriesQ->as_array();
 
            if($result)
                return $result;
            else
                return false;
    }
    
    public function get_first_3_categories(){
        $categoriesQ = DB::select()
            ->from($this->_tableCategories)
            ->order_by('ID', 'asc')
            ->limit(3)
            ->execute();
        
        $result = $categoriesQ->as_array();
 
            if($result)
                return $result;
            else
                return false;
    }
}
?>
