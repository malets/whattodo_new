<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Error extends Controller_Common {
        public $template = 'common';
    
        public function action_bad_registration_link(){
                $header_url = 'header/';
                $header = Request::factory($header_url)->execute();
                
		$content = View::factory('common');
                
                $this->template->content = $content;
                $this->template->header = $header;
                $this->template->errorMsg = 'Неверная ссылка для завершения регистрации';
        }
}
