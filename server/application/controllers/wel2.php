<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//echo $openId;
		$this->load->model('wel','',TRUE);
		//var_dump($user);
		$com=$this->wel->test();
		
		var_dump($com);
	}
	
	/*
	获取学习方案
	
	public function index($openId)
	{
		//echo $openId;
		$this->load->model('user','',TRUE);
		//var_dump($user);
		$com=$this->user->schedule($openId);
		var_dump($com);
	}
	*/
	
	/*
	*获取用户自己的评论
	*
	public function index($openId)
	{
		echo $openId;
		$this->load->model('user','',TRUE);
		//var_dump($user);
		$com=$this->user->comments($openId);
		var_dump($com);
	}*/
	//public function
}
