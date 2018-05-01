<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments_con extends CI_Controller {

	/*
	���ã�
	�����µ�����
	������
	��post�ķ�ʽ����sche����id��user����id������
	�������ݣ�
	ok �ɹ�
	fail ʧ��
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
			$params['to_whom']=$scheduel[0]->user_id;//��߹��Ʒ��ص����飬��������⣬���ȿ����
			$result=$this->comment->create($params);
			if(-1==$result)
				$return=['status'=>'fail','messege'=>'����ʧ��'];
			else
				$return=['status'=>'ok','messege'=>'���۳ɹ�'];
			$this->json($return);
	}
	/*
	���ã�
	�ظ�����
	����:
	��post�ķ�ʽ����sche����id��user����id�����ݣ�comment_id(�ظ����Ǹ����۵�id)
	�����
	ok �ɹ�
	fail ʧ��
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
			$params['to_whom']=$scheduel[0]->user_id;//��߹��Ʒ��ص����飬��������⣬���ȿ����
			$result=$this->comment->create($params);
			if(-1==$result)
				$return=['status'=>'fail','messege'=>'����ʧ��'];
			else
				$return=['status'=>'ok','messege'=>'���۳ɹ�'];
			$this->json($return);
	}
	/*
	���ã�
	��ȡ���˶��ҵ�����,���ڸ���ҳ��
	����:
	post ��ʽ����user_id
	�����
	������ʽ��comments��ʱ������
	*/
	public function commentsToMe()
	{
			$openId=$this->input->post('user_id');
			$this->load->model('comment','',TRUE);
			//var_dump($user);
			$com=$this->comment->commentsToMe($openId);
			if(-1==$com)
				$return=['status'=>'fail','messege'=>'��ȡ����ʧ��','comments'=>''];
			else
				$return=['status'=>'ok','messege'=>'��ȡ���۳ɹ�','comments'=>$com];
			$this->json($return);
	}
	/*
	���ã�
	��ȡ�ҵ����ۣ����ڸ���ҳ��
	����:
	post ��ʽ����user_id
	�����
	������ʽ��comments��ʱ������
	*/
	public function myComments()
	{
			$openId=$this->input->post('user_id');
			$this->load->model('comment','',TRUE);
			//var_dump($user);
			$com=$this->comment->comments($openId);
			if(-1==$com)
				$return=['status'=>'fail','messege'=>'��ȡ����ʧ��','comments'=>''];
			else
				$return=['status'=>'ok','messege'=>'��ȡ���۳ɹ�','comments'=>$com];
			$this->json($return);
	}
  
	
	
	/*
	���ã�
	��ȡschedual����������,��������
	����:
	post ��ʽ����schedual_id,
	�����
	������ʽ��comments��ʱ������
	*/
	public function getCurrentSchedualComments()
	{
		$sche_Id=$this->input->post('sche_id');
			$this->load->model('comment','',TRUE);
			//var_dump($user);
			$comments=$this->comment->currentComments($sche_Id);
			if(-1==$comments)
				$return=['status'=>'fail','messege'=>'��ȡ����ʧ��','comments'=>''];
			else
				$return=['status'=>'ok','messege'=>'��ȡ���۳ɹ�','comments'=>$com];
			$this->json($return);
		}
		/*
	���ã�
	ɾ����������
	����:
	post ��ʽ����commment_id,user_id
	�����
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
				$return=['status'=>'fail','messege'=>'Ȩ�޲���'];
				$this->json($return);
			}
			$state=$this->comment->del($comment_id);
			if(-1==$state)
				$return=['status'=>'fail','messege'=>'ɾ������ʧ��'];
			else
				$return=['status'=>'ok','messege'=>'ɾ������ʧ��'];
			$this->json($return);
		}
}
