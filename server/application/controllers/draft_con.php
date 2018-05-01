<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Draft_con extends CI_Controller {
	
	/*
	����:��ȡ�ݸ�
	������post�����û�id
	���أ�״̬+�ݸ�
	*/
    public function get() {
				$user_id=$this->input->post('user_id');
				$this->load->model('draft','',TRUE);
				$result=$this->draft->getDraft($user_id);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'�ݸ��ȡʧ��','data'=>$result];
				else
						$return=['status'=>'ok','messege'=>'�ݸ��ȡ�ɹ�','data'=>$result];
				$this->json($return);
			//var_dump($user);
				//$this->load->model('schedual','',TRUE);
				//$schedual=$this->schedual->get($sche_id);
    }
    /*
    ���ܣ�ɾ���ݸ�
    ������post���� �� $draft_id
    ���أ�ok��fail+messege
    */
    public function del()
    {
    		$draft_id=$this->input->post('draft_id');
    		$this->load->model('draft','',TRUE);
				$result=$this->draft->delete($draft_id);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'�ݸ�ɾ��ʧ��'];
				else
						$return=['status'=>'ok','messege'=>'�ݸ��ȡ�ɹ�'];
				$this->json($return);
    	}
    	/*
    	���ܣ�����ݸ�
    	������post ����user_id++++������
    	���أ�ok��fail+messege
    	*/
    public function writeIn()
    {
    		//$draft_id=$this->input->post('draft_id');
    		//����Ĳ������������
    		$user_id=$this->input->post('user_id');
    		$content=$this->input->post('content');
    		$authority=$this->input->post('authority');
    		$class=$this->input->post('class');
    		
    		$this->load->model('draft','',TRUE);
				$result=$this->draft->exist($user_id);
				if(!$result)
				{
						$return=['status'=>'fail','messege'=>'�Ѿ����ڲݸ�'];
						$this->json($return);
				}
				$data=['user_id'=>$user_id,'authority'=>$authority,'content'=>$content,'class'=>$class];
				
				$result=$this->draft->create($data);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'�ݸ屣��ʧ��'];
				else
						$return=['status'=>'ok','messege'=>'�ݸ屣��ɹ�'];
				$this->json($return);
				
    	}
    	
    	/*
    	���ܣ����²ݸ�
    	������post ����user_id++++������
    	���أ�ok��fail+messege
    	*/
    	public function update()
    	{
    		//����Ĳ������������
    		$draft_id=$this->input->post('draft_id');
    		//$user_id=$this->input->post('user_id');
    		$content=$this->input->post('content');
    		$authority=$this->input->post('authority');
    		$class=$this->input->post('class');
    		
    		$this->load->model('draft','',TRUE);
				$data=['authority'=>$authority,'content'=>$content,'class'=>$class];
				
				$result=$this->draft->update($data);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'�ݸ屣��ʧ��'];
				else
						$return=['status'=>'ok','messege'=>'�ݸ屣��ɹ�'];
				$this->json($return);
    		}
}