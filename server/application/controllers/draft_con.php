<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Draft_con extends CI_Controller {
	
	/*
	功能:获取草稿
	参数：post传入用户id
	返回：状态+草稿
	*/
    public function get() {
				$user_id=$this->input->post('user_id');
				$this->load->model('draft','',TRUE);
				$result=$this->draft->getDraft($user_id);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'草稿获取失败','data'=>$result];
				else
						$return=['status'=>'ok','messege'=>'草稿获取成功','data'=>$result];
				$this->json($return);
			//var_dump($user);
				//$this->load->model('schedual','',TRUE);
				//$schedual=$this->schedual->get($sche_id);
    }
    /*
    功能：删除草稿
    参数：post传入 ， $draft_id
    返回：ok、fail+messege
    */
    public function del()
    {
    		$draft_id=$this->input->post('draft_id');
    		$this->load->model('draft','',TRUE);
				$result=$this->draft->delete($draft_id);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'草稿删除失败'];
				else
						$return=['status'=>'ok','messege'=>'草稿获取成功'];
				$this->json($return);
    	}
    	/*
    	功能：保存草稿
    	参数：post 传入user_id++++看下面
    	返回：ok、fail+messege
    	*/
    public function writeIn()
    {
    		//$draft_id=$this->input->post('draft_id');
    		//传入的参数需求在这边
    		$user_id=$this->input->post('user_id');
    		$content=$this->input->post('content');
    		$authority=$this->input->post('authority');
    		$class=$this->input->post('class');
    		
    		$this->load->model('draft','',TRUE);
				$result=$this->draft->exist($user_id);
				if(!$result)
				{
						$return=['status'=>'fail','messege'=>'已经存在草稿'];
						$this->json($return);
				}
				$data=['user_id'=>$user_id,'authority'=>$authority,'content'=>$content,'class'=>$class];
				
				$result=$this->draft->create($data);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'草稿保存失败'];
				else
						$return=['status'=>'ok','messege'=>'草稿保存成功'];
				$this->json($return);
				
    	}
    	
    	/*
    	功能：更新草稿
    	参数：post 传入user_id++++看下面
    	返回：ok、fail+messege
    	*/
    	public function update()
    	{
    		//传入的参数需求在这边
    		$draft_id=$this->input->post('draft_id');
    		//$user_id=$this->input->post('user_id');
    		$content=$this->input->post('content');
    		$authority=$this->input->post('authority');
    		$class=$this->input->post('class');
    		
    		$this->load->model('draft','',TRUE);
				$data=['authority'=>$authority,'content'=>$content,'class'=>$class];
				
				$result=$this->draft->update($data);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'草稿保存失败'];
				else
						$return=['status'=>'ok','messege'=>'草稿保存成功'];
				$this->json($return);
    		}
}