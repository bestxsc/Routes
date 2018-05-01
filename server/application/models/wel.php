<?php

class Wel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
    public function test(){
    $query=$this->db->where('draft_id',2)->update('drafts', array('user_id'=>1));
			var_dump($query);
				//$result=$query->result();
				//if(!$result)
    			//	return -1;
    //		return 1;	
    }
    
    public function getDraft($openId)
    {
    	//echo $openId;
    	$query = $this->db->get_where('drafts',array('user_id'=>$openId));
    	$result=$query->result();
    	if(!$result)
    		return -1;
    	return $result;
    	//$this->db->get('comments',)
    }
    
    /*
    *获取用户的学习方案
    失败返回-1
    
    
    public function schedule($openId)
    {
    	//echo $openId;
    	$query = $this->db->order_by('create_time ASC,id ASC')->get_where('schedual',array('user_id'=>$openId));
    	//return 
    	$sches = $query->result();
    	if(!$sches)
    		return -1;
    	$data=array();
    	//return $sches;
    	foreach ($sches as $sche)
			{
    		$scheId=$sche->id;
    		$query = $this->db->order_by('group_id ASC,update_time ASC,route_id ASC')->get_where('route',array('sche_id'=>$scheId));
    		$route=$query->result();
    		if(!$route)
    			array_push($data,['sche'=>$sche,'route'=>'null']);
    		else
    		{
    			array_push($data,['sche'=>$sche,'route'=>$route]);	
    		}
    		
			}
			if(!$data)
				return -1;
			else
				return $data;
    	//$scheId=
    	//$query = $this->db->order_by('update_time ASC,route_id ASC')->get_where('schedual',array('sche_id'=>$scheId));
    	
    	//$this->db->get('comments',)
    }
    */
    
    
    
    /*
    *获取对用户的评论
    失败返回-1
    public function commentsToMe($openId)
    {
    	//echo $openId;
    	$query = $this->db->order_by('update_time ASC,comment_id ASC')->get_where('comments',array('to_whom'=>$openId));
    	$result=$query->result();
    	if(!result)
    		return -1;
    	return $result;
    	//$this->db->get('comments',)
    }
    */
    /*
    *获取用户的评论
    *
    v失败返回-1
   
    public function comments($openId)
    {
    	//echo $openId;
    	$query = $this->db->get_where('comments',array('user_id'=>$openId))->order_by('update_time ASC,comment_id ASC');
    	$result=$query->result();
    	if(!result)
    		return -1;
    	return $result;
    	//$this->db->get('comments',)
    }
     */
    

}