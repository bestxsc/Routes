<?php

class User extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
    /*用户登录行为，设置在线状态*/
		public function login($openId)
		{
			//echo $openId;
			//$this->load->model('user','',TRUE);
			//var_dump($user);
			//$com=$this->user->getDraft($openId);
			
			//var_dump($com);
		
		}
		/*用户退出行为，设置在线状态*/
		public function logout($openId)
		{
			
		}
		
}