<?php
    require_once( HYBRIDPATH."/hybridauth/Hybrid/Auth.php" );

 class Controller_OAuth extends Controller {
        public $model = 'Login';
        private $config = "/hybridauth/config.php";
        
        public function action_OAuth_VK(){ 
                $hybridauth = new Hybrid_Auth(HYBRIDPATH . $this->config );
                $network_name = $this->request->param('network');

		$network = $hybridauth->authenticate($network_name);   
                $user_profile = $this->getUserProfile($network);   

                $user = Model::factory($this->model)->get_social_user_info($network_name, $user_profile->identifier);
               
                if(!$user)
                {
                    $userInfo = array();

                    $userInfo['Name'] = $user_profile->firstName.' '.$user_profile->lastName;
                    $userInfo['Birthdate'] = $user_profile->birthYear.'-'.$user_profile->birthMonth.'-'.$user_profile->birthDay;
                    $userInfo['City'] = $user_profile->city;
                    
                    $networkInfo = array();
                    $networkInfo['name'] = $network_name;
                    $networkInfo['userID'] = $user_profile->identifier;
                
                    $userCount = Model::factory($this->model)->social_users_count();
                    $userName = 'SU'.($userCount+1);
                    Model::factory($this->model)->add_social_user($userName, $userInfo, $userName.'@test.ru', $networkInfo);
                }
                else
                {
                    $userData =  Model::factory($this->model)->get_user_data_by_id($user['userID']);
                    $userName = $userData['username'];
                }
                
                Auth::instance()->force_login($userName); 

		//$twitter->logout();
        }
        
        public function action_post_message(){
            $hybridauth = new Hybrid_Auth(HYBRIDPATH . $this->config );
            $network = $this->request->param('network');
            
            $network_auth = $hybridauth->authenticate($network);

            $userProfile = $this->getUserProfile($network_auth);
            
             $response = $network_auth->api()->api("/me/feed", "post", array(
                        "message" => "Hi there",
                        "picture" => "http://whattodo.twmail.info/static/images/sphere.png",
                        "link" => "http://whattodo.twmail.info",
                        "name" => "Что сделать?",
                        "description" => "Бла-бла-бла для поста",
                        "caption" => "Наш сайт"
                        ));
        }
        
        private function getUserProfile($network){                            
                try{
                    $network->getUserProfile();
                }catch(Exception $e){
                    $network->login();
                }               
                
                return $network->getUserProfile();
        }
      /*  public function action_get_code(){
                if($this->request->query('code'))
                {
                    $authResponse = $this->get_access($this->request->query('code'));
                    if(isset($authResponse->access_token)) 
                    {
                        $social_user_id = $authResponse->user_id.'::vk';
                        $social_user_test_email = $authResponse->user_id.'__vk@test.ru';
                        
                        if(!Model::factory($this->model)->is_user_exist($social_user_id))
                        {
                            $social_user_info = (array) $this->get_user_info($authResponse->access_token, $authResponse->user_id);
                            $city_info = (array) $this->get_city_info($social_user_info['city']);
                            $social_user_info['city'] = $city_info['name'];
                            $user_info = array();

                            $config = $this->get_config('vk');
                            $fields_mapping = $config['fields_mapping'];

                            foreach($fields_mapping as $key => $value)
                            {
                                if(is_array($value))
                                {
                                    $user_info_value = '';
                                    foreach ($value as $val) {
                                        $user_info_value.= $social_user_info[$val].' ';
                                    }
                                    $user_info[$key] = $user_info_value;
                                }
                                else    
                                  $user_info[$key] = $social_user_info[$value];
                            }

                            Model::factory($this->model)->add_social_user($social_user_id, $user_info, $social_user_test_email);
                        }
                        Auth::instance()->force_login($social_user_id);
                        HTTP::redirect('/');
                    }
                }
                else
                    HTTP::redirect('/');
        }
        
        private function get_access($code){
            $client =  $this->get_config('vk');
            $request_url = $client['url'].'?client_id='.$client['app'].'&client_secret='.$client['key'].'&code='.$code.'&redirect_uri=http://whattodo.zz.mu/vklogin';
            $request = Request::factory($request_url);
            return json_decode($request->execute()->body());            
         }
        
        private function get_config($social){
            $config = Kohana::$config->load('oauth'); 
            return $config->get($social);
        }
        
        private function get_user_info($access_token, $user_id){
            $request_url = 'https://api.vk.com/method/users.get?user_id='.$user_id.'&fields=uid,first_name,last_name,nickname,screen_name,sex,bdate,city,country,timezone,photo&v=5.2&access_token='.$access_token;
            $request = Request::factory($request_url);
            $response = (array) json_decode($request->execute()->body());
            return $response['response'][0];
        }
        
        private function get_city_info($cityId){
            $request_url = 'https://api.vk.com/method/database.getCitiesById?city_ids='.$cityId;
            $request = Request::factory($request_url);
            $response = (array) json_decode($request->execute()->body());
            return $response['response'][0];
        }
*/     
 }
?>
