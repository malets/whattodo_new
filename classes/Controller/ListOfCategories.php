<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ListOfCategories extends Controller_Common {
    
    public $template = 'ListOfCategories';
    public $model = 'ListOfCategories';
    public $TEST_USER_ID = 0;

	public function action_index()
	{       
                $header_url = 'header/';
                $header = Request::factory($header_url)->execute();
                
		$content = View::factory('ListOfCategories');
 
                $listOfCategories = Model::factory($this->model)->get_all_categories();
                
                $this->template->content = $content;
                $this->template->header = $header;
                $this->template->categories = $listOfCategories;
	}

}
