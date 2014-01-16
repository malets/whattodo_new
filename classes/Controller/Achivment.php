<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Achivment extends Controller_CommonAuthorized {
    
    public $template = 'Achivment';
    public $model = 'Achivment';

	public function action_index()
	{       
                $header_url = 'header/';
                $header = Request::factory($header_url)->execute();
                
		$content = View::factory('Achivment');
 
                $achivmentID = $this->request->param('id');
                $achivmentINFO = Model::factory($this->model)->get_achivment_by_id($achivmentID);
                
                $this->template->content = $content;
                $this->template->header = $header;
                $this->template->achivment = $achivmentINFO;
	}

}
