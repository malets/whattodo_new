<?php defined('SYSPATH') or die('No direct script access.');

class Controller_ListOfAchivments extends Controller_Common {
    
    public $template = 'ListOfAchivments';
    public $model = 'ListOfAchivments';
    public $TEST_USER_ID = 0;

	public function action_index()
	{                       
                $header_url = 'header/';
                $header = Request::factory($header_url)->execute();
                
		$content = View::factory('ListOfAchivments');
                
                $categoryURL = $this->request->param('category');
                $categoryINFO = Model::factory($this->model)->get_categoryINFO_by_URL($categoryURL);
                $listOfAchivments = Model::factory($this->model)->get_achivments_from_category($categoryINFO['ID']);
                
                $this->template->content = $content;
                $this->template->header = $header;
                
                $this->template->achivments = $listOfAchivments;
                $this->template->categoryName = $categoryINFO['Name'];
	}

} // End Welcome
