<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Controller_Common extends Controller_Template {

       public $template = 'common';
        
	public function before()
	{
            parent::before();
            
            $this->template->styles = array('style', 'smoothness/jquery-ui-1.10.3.custom', 'fancybox/jquery.fancybox-1.3.4');
            $this->template->js = array('jquery-ui-1.10.3.custom/js/jquery-1.8.3', 'jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min', 'jquery-ui-1.10.3.custom/js/jquery.form.min', 'fancybox/jquery.mousewheel-3.0.4.pack', 'fancybox/jquery.fancybox-1.3.4.pack');
	}
}
?>
