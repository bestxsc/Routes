<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments_con extends CI_Controller {

	/*
	作用：
	创建新的评论
	参数：
	用post的方式传输sche——id，user——id，内容
	返回数据：
	ok 成功
	fail 失败
	*/
	
	public function create()
	{
			$sche_id=$this->input->post('sche_id');
			$user_id=$this->input->post('user_id');
			$content=$this->input->post('content');
			$this->load->model('comment','',TRUE);
		//var_dump($user);
			$this->load->model('schedual','',TRUE);
			$schedual=$this->schedual->get($sche_id);
			$params['reply_id']=0;
			$params['is_reply']=0;
			$params['user_id']=$user_id;
			$params['content']=$content;
			$params['sche_id']=$sche_id;
			$params['to_whom']=$scheduel[0]->user_id;//这边估计返回的数组，如果有问题，优先看这边
			$result=$this->comment->create($params);
			if(-1==$result)
				$return=['status'=>'fail','messege'=>'评论失败'];
			else
				$return=['status'=>'ok','messege'=>'评论成功'];
			$this->json($return);
	}
	/*
	作用：
	回复评论
	参数:
	用post的方式传输sche——id，user——id，内容，comment_id(回复的那个评论的id)
	输出：
	ok 成功
	fail 失败
	*/
	public function reply($openId,$sche_id,$reply_id)
	{
			$sche_id=$this->input->post('sche_id');
			$user_id=$this->input->post('user_id');
			$content=$this->input->post('content');
			$comment_id=$this->input->post('comment_id');
			$this->load->model('comment','',TRUE);
		//var_dump($user);
			$this->load->model('schedual','',TRUE);
			$schedual=$this->schedual->get($sche_id);
			$params['reply_id']=$reply_id;
			$params['is_reply']=1;
			$params['user_id']=$user_id;
			$params['content']=$content;
			$params['sche_id']=$sche_id;
			$params['to_whom']=$scheduel[0]->user_id;//这边估计返回的数组，如果有问题，优先看这边
			$result=$this->comment->create($params);
			if(-1==$result)
				$return=['status'=>'fail','messege'=>'评论失败'];
			else
				$return=['status'=>'ok','messege'=>'评论成功'];
			$this->json($return);
	}
	/*
	作用：
	获取别人对我的评论,用于个人页面
	参数:
	post 方式传入user_id
	输出：
	数组形式的comments，时间排序
	*/
	public function commentsToMe()
	{
			$openId=$this->input->post('user_id');
			$this->load->model('comment','',TRUE);
			//var_dump($user);
			$com=$this->comment->commentsToMe($openId);
			if(-1==$com)
				$return=['status'=>'fail','messege'=>'获取评论失败','comments'=>''];
			else
				$return=['status'=>'ok','messege'=>'获取评论成功','comments'=>$com];
			$this->json($return);
	}
	/*
	作用：
	获取我的评论，用于个人页面
	参数:
	post 方式传入user_id
	输出：
	数组形式的comments，时间排序
	*/
	public function myComments()
	{
			$openId=$this->input->post('user_id');
			$this->load->model('comment','',TRUE);
			//var_dump($user);
			$com=$this->comment->comments($openId);
			if(-1==$com)
				$return=['status'=>'fail','messege'=>'获取评论失败','comments'=>''];
			else
				$return=['status'=>'ok','messege'=>'获取评论成功','comments'=>$com];
			$this->json($return);
	}
  
	
	
	/*
	作用：
	获取schedual的所有评论,用于详情
	参数:
	post 方式传入schedual_id,
	输出：
	数组形式的comments，时间排序
	*/
	public function getCurrentSchedualComments()
	{
		$sche_Id=$this->input->post('sche_id');
			$this->load->model('comment','',TRUE);
			//var_dump($user);
			$comments=$this->comment->currentComments($sche_Id);
			if(-1==$comments)
				$return=['status'=>'fail','messege'=>'获取评论失败','comments'=>''];
			else
				$return=['status'=>'ok','messege'=>'获取评论成功','comments'=>$com];
			$this->json($return);
		}
		/*
	作用：
	删除摸个评论
	参数:
	post 方式传入commment_id,user_id
	输出：
	ok/fail+messege
	*/
	public function deleteComments()
	{
			$user_Id=$this->input->post('user_id');
			$comment_id=$this->input->post('comment_id');
			$this->load->model('comment','',TRUE);
			//var_dump($user);
			$comments=$this->comment->get($comment_id);
			$commentObj=$comments[0];
			$user_id_in_comment=$commentObj->user_id;
			if($user_id_in_comment!=$user_id)
			{
				$return=['status'=>'fail','messege'=>'权限不足'];
				$this->json($return);
			}
			$state=$this->comment->del($comment_id);
			if(-1==$state)
				$return=['status'=>'fail','messege'=>'删除评论失败'];
			else
				$return=['status'=>'ok','messege'=>'删除评论失败'];
			$this->json($return);
		}
}
