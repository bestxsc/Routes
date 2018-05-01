<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Schedual extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
    /*
			作用：获取shce，非详情页
			参数：用户Id
			返回：ok、fail+data
		*/
    public function get() {
				$user_id=$this->input->post('user_id');
				$this->load->model('schedual','',TRUE);
				$result=$this->schedual->get($user_id);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'失败','data'=>$result];
				else
						$return=['status'=>'ok','messege'=>'成功','data'=>$result];
				$this->json($return);
			//var_dump($user);
				//$this->load->model('schedual','',TRUE);
				//$schedual=$this->schedual->get($sche_id);
    }
    /*
			作用：获取shce，用于详情页
			参数：用户Id
			返回：ok、fail+data
		*/
    public function getAll() {
				$user_id=$this->input->post('user_id');
				$this->load->model('schedual','',TRUE);
				$result=$this->schedual->getFull($user_id);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'失败','data'=>$result];
				else
						$return=['status'=>'ok','messege'=>'成功','data'=>$result];
				$this->json($return);
			//var_dump($user);
				//$this->load->model('schedual','',TRUE);
				//$schedual=$this->schedual->get($sche_id);
    }
    /*
    作用：删除
			参数：shce_Id
			返回：ok、fail+messege
    */
    public function del()
    {
    		$schedual_id=$this->input->post('schedual_id');
	    		$this->load->model('schedual','',TRUE);
					$result=$this->schedual->delete($sche_id);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'操作失败'];
				else
						$return=['status'=>'ok','messege'=>'操作成功'];
				$this->json($return);
    	}
    	/*
    	作用：新增shce
			参数：看下面
			返回：ok、fail+messege
    	*/
    public function writeIn()
    {
    		//$schedual_id=$this->input->post('schedual_id');
    		//参数看这边
    		$user_id=$this->input->post('user_id');
    		$title=$this->input->post('title');
    		$authority=$this->input->post('authority');
    		$class=$this->input->post('class');
    		$finish_time=$this->input->post('finish_time');
    		//$class=$this->input->post('class');
    		$this->load->model('schedual','',TRUE);
				
				$data=['user_id'=>$user_id,'authority'=>$authority,'title'=>$title,'class'=>$class,'finish_time'=>$finish_time];
				
				$result=$this->schedual->create($data);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'操作失败'];
				else
						$return=['status'=>'ok','messege'=>'操作成功'];
				$this->json($return);
				
    	}
    	
    	/*
    	作用：更新
			参数：看下面
			返回：ok、fail+messege
    	*/
    	public function update()
    	{
    		//参数在这边    		
    		$sche_id=$this->input->post('sche_id');
    		$user_id=$this->input->post('user_id');
    		$title=$this->input->post('title');
    		$authority=$this->input->post('authority');
    		$class=$this->input->post('class');
    		$finish_time=$this->input->post('finish_time');
    		
    		$this->load->model('schedual','',TRUE);
				$data=['sche_id'=>$sche_id,'user_id'=>$user_id,'authority'=>$authority,'title'=>$title,'class'=>$class,'finish_time'=>$finish_time];
				
				$result=$this->schedual->update($data);
				if(-1==$result)
						$return=['status'=>'fail','messege'=>'操作失败'];
				else
						$return=['status'=>'ok','messege'=>'操作成功'];
				$this->json($return);
    		}
    
    
    
    /*
    	作用：搜索
			参数：class
			返回：ok、fail+data
    	*/
		public function search()
		{
				$class=$this->input->post('class');
	    	$this->load->model('schedual','',TRUE);
				$result=$this->schedual->search($class);
				if(-1==$result)
						$return=['status'=>'fail','data'=>''];
				else
						$return=['status'=>'ok','data'=>$result];
				$this->json($return);
		
		}
	
		/*
    	作用：新增route
			参数：看下面
			返回：ok、fail+messege
    	*/
		public function addRoute()
		{
			//参数在这边
				$user_id=$this->input->post('user_id');
	    	$sche_id=$this->input->post('sche_id');
	    	$content=$this->input->post('content');
	    	//$group_id=$this->input->post('group_id');
	    	//$user_id=$this->input->post('user_id');
	    	//$sche_id=$this->input->post('sche_id');
	    	
	    	$this->load->model('schedual','',TRUE);
				$this->load->model('route','',TRUE);
				$count=($this->schedual->getBySche_id($sche_id)[0]->count+1);
				$group_id=$count;
				$result_0=$this->schedual->update(['sche_id'=>$sche_id,'count'=>$count]);
				if(-1==$result_0)
						$return=['status'=>'fail','messege'=>'错误位置sche'];
				$result_1=$this->route->create(['user_id'=>$user_id,
				'sche_id'=>$sche_id,
				'content'=>$content,
				'group_id'=>$group_id
				]);
				if(-1==$result_1)
						$return=['status'=>'fail','messege'=>'错误位置like'];
				if(-1!=$result_0&&-1!=$result_1)
						$return=['status'=>'ok','messege'=>'操作成功'];
				$this->json($return);
			
		}
		
		/*
    	作用：更新rote
			参数：看下面
			返回：ok、fail+messege
    	*/
		public function updateRoute()
		{
			//参数在这边
				//$user_id=$this->input->post('user_id');
	    	//$sche_id=$this->input->post('sche_id');
	    	$content=$this->input->post('content');
	    	$user_id=$this->input->post('route_id');
	    	//$group_id=$this->input->post('group_id');
	    	//$user_id=$this->input->post('user_id');
	    	//$sche_id=$this->input->post('sche_id');
	    	
	    	//$this->load->model('schedual','',TRUE);
				$this->load->model('route','',TRUE);
				//$count=($this->schedual->getBySche_id($sche_id)[0]->count+1);
				//$group_id=$count;
				//$result_0=$this->schedual->update(['sche_id'=>$sche_id,'count'=>$count]);
				//if(-1==$result_0)
					//	$return=['status'=>'fail','messege'=>'����λ��sche'];
				$result=$this->route->update(['route_id'=>$route_id,'content'=>$content]);
				if(-1==$result)
						$return=['status'=>'fail'];
				else
						$return=['status'=>'ok'];
				//if(-1!=$result_0&&-1!=$result_1)
					//	$return=['status'=>'ok','messege'=>'����ɹ�'];
				$this->json($return);
			
		}
		
		
		
		/*
    	作用：删除route
			参数：route_id
			返回：ok、fail+messege
    	*/
		
		public function delRoute()
		{
			//�������������Ҫ�Ĳ���
				$user_id=$this->input->post('route_id');
	    	//$sche_id=$this->input->post('sche_id');
	    	//$content=$this->input->post('content');
	    	//$group_id=$this->input->post('group_id');
	    	//$user_id=$this->input->post('user_id');
	    	//$sche_id=$this->input->post('sche_id');
	    	
	    	$this->load->model('schedual','',TRUE);
				$this->load->model('route','',TRUE);
				$route=$this->route->getById($route_id);
				if(!$route)
				{
					$this->json(['tsatus'=>'fail');
					return;
				}
				$route=$route[0];
				$sche_id=$route->sche_id;
				
				$count=($this->schedual->getBySche_id($sche_id)[0]->count-1);
				//$group_id=$count;
				$result=$this->schedual->delete($route_id);
				if(-1==$result)
						$return=['status'=>'fail'];
				else
				{
						$return=['status'=>'ok'];
				}
				$this->json($return);
			
		}
		
		
		
		/*
    	作用：点赞
			参数：用户id、sche_id
			返回：ok、fail+messege
    	*/
		public function like()
		{
				$user_id=$this->input->post('user_id');
	    	$sche_id=$this->input->post('sche_id');
	    	$this->load->model('schedual','',TRUE);
				$this->load->model('likes','',TRUE);
				$like=($this->schedual->getBySche_id($sche_id)[0]->likes)+1;
				$result_0=$this->schedual->update(['sche_id'=>$sche_id,'likes'=>$like]);
				if(-1==$result_0)
						$return=['status'=>'fail','messege'=>'错误位置sche'];
				$result_1=$this->likes->create(['user_id'=>$user_id,'sche_id'=>$sche_id]);
				if(-1==$result_1)
						$return=['status'=>'fail','messege'=>'错误位置ike'];
				if(-2==$result_1)
						$return=['status'=>'fail','messege'=>'已经有like操作，不可以重复操作'];
				if(-1!=$result_0&&-1!=$result_1&&-2!=$result_1)
						$return=['status'=>'ok','messege'=>'成功'];
				$this->json($return);
		}
		/*
    	作用：取消赞
			参数：user_id、sche_id
			返回：ok、fail+messege
    	*/
		public function dislike()
		{
				$user_id=$this->input->post('user_id');
	    	$sche_id=$this->input->post('sche_id');
	    	$this->load->model('schedual','',TRUE);
				$this->load->model('likes','',TRUE);
				$like=($this->schedual->getBySche_id($sche_id)[0]->likes)-1;
				$result_0=$this->schedual->update(['sche_id'=>$sche_id,'likes'=>$like]);
				if(-1==$result_0)
						$return=['status'=>'fail','messege'=>'出错位置sche'];
				$result_1=$this->likes->delete($sche_id,$user_id);
				if(-1==$result_1)
						$return=['status'=>'fail','messege'=>'出错位置ike'];
				if(-1!=$result_0&&-1!=$result_1)
						$return=['status'=>'ok','messege'=>'成功'];
				$this->json($return);
		}

}