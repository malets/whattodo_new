<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller_Common {
    
    public $template = 'Login';
    public $model = 'Login';

	public function action_index()
	{       
                $header_url = 'header/';
                $header = Request::factory($header_url)->execute();
                
		$content = View::factory('Login');
                
                $this->template->content = $content;
                $this->template->actionURL = 'login_check';
                $this->template->header = $header;
               // $this->template->categories = $categoriesINFO;
	}
        
        public function action_login(){
             $isAuth = $this->authFunction();
             if($isAuth)
                 HTTP::redirect('/');
             else
                 HTTP::redirect('/login/');
        }
        
        private function authFunction(){
                return Auth::instance()->login($this->request->post('e-mail'), $this->request->post('pass'));
        }
        
        public function action_registration(){
                $header_url = 'header/';
                $header = Request::factory($header_url)->execute();
                
		$content = View::factory('Login');
                
                $this->template->content = $content;
                $this->template->actionURL = 'register';
                $this->template->header = $header;
        }
        
        public function action_register(){
                $data = array();
        if (HTTP_Request::POST == $this->request->method())
        {            
            try {
 
                // производим проверку всех полей
                $object = Validation::factory($this->request->post());
                $object
                    ->rule('pass', 'not_empty')
                    ->rule('pass', 'min_length', array(':value', '5'))
                    ->rule('e-mail', 'email');
                
               
               // var_dump($res);
                // очищаем массив с POST
                $_POST = array();
                $rand = rand(0, 100000000);
                $activationCode = md5($this->request->post('e-mail')).md5($rand);
                $passHash = Auth::instance()->hash_password($this->request->post('pass'));
                
                Model::factory($this->model)->add_user($this->request->post('e-mail'), $passHash, $activationCode);
                
				$subject = 'Регистрация на whatToDo';

                $to = $this->request->post('e-mail');
                $message = 'Вы отправили запрос регистрации на whatToDo. Для завершения регистрации просьба перейти по <a href="http://'.$_SERVER['SERVER_NAME'].'/registration_check?login='.$this->request->post('e-mail').'&code='.$activationCode.'">ссылке</a>';
				$headers = 'Content-type: text/html; charset=utf-8';
                $this->XMail('whatToDo', $to, $subject, $message); // отправляем пользователю сообщение с его паролем
 
                //Auth::instance()->force_login($this->request->post('e-mail')); // сразу же авторизуем его, без ввода логина и пароля
                HTTP::redirect('/');
 
            } catch (ORM_Validation_Exception $e) {
 
                // если во время валидации возникли ошибки
              //  $data['messageReg'] = Kohana::message('account', 'errorReg');
              //  $data['errors']=$e->errors('models');            
                // берем значения ошибок из файла /application/messages/model/user.php
            }
        }    
       // $data['email'] = array_key_exists('email', $this->request->post()) ? htmlspecialchars($this->request->post('email')) : '';
       // $data['username'] = array_key_exists('username', $this->request->post()) ? htmlspecialchars($this->request->post('username')) : '';     // вставляем данные в формы, если они были введены
        }
        
        
        public function action_registration_check(){
                $email = $this->request->query('login');
                $code = $this->request->query('code');
                
                if(!isset($email) || !isset($code))
                    HTTP::redirect('/bad_registration_link');
                else{
                    $activationResult = Model::factory($this->model)->activation($email, $code);
                    
                    if($activationResult == true)
                        HTTP::redirect('/profile');
                    else
                        HTTP::redirect('/bad_registration_link');
                }
        }
        
      /*  public function action_vk(){
                if($this->request->query('code'))
                    HTTP::redirect('/');
                else
                    HTTP::redirect('/');
        }*/
        
        public function action_logout(){
            Auth::instance()->logout();
            HTTP::redirect(URL::base());
        }


        
		
		private	function XMail( $from, $to, $subj, $text) {
		var_dump($text);
			$un        = strtoupper(uniqid(time()));
			$head      = "From: $from\n";
			$head     .= "To: $to\n";
			$head     .= "Subject: $subj\n";
			$head     .= "X-Mailer: PHPMail Tool\n";
			$head     .= "Reply-To: $from\n";
			$head     .= "Mime-Version: 1.0\n";
			$head     .= "Content-Type:multipart/mixed;";
			$head     .= "boundary=\"----------".$un."\"\n\n";
			$zag       = "------------".$un."\nContent-Type:text/html; charset=utf-8\n";
			$zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
			$zag      .= "------------".$un."\n";

			return @mail("$to", "$subj", $zag, $head);
		}

}
