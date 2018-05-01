<?php
class Comment extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
    
    /*
    发表评论
    接收参数：
    返回参数：
    1-成功；
    -1-失败，同时返回失败信息
    */
		public function create($params)
		{
			$result=$this->db->insert('comments', $params);
    	//$result=$query->result();
			//echo $openId;
			//$this->load->model('user','',TRUE);
			//var_dump($user);
			//$com=$this->user->getDraft($openId);
			
			//var_dump($com);
			if(!$result)
    		return -1;
    	return 1;
		
		}
		/*删除评论*/
		public function del($comment_id)
		{
				$result=$this->db->delete('comments', array('commment_id' => $comment_id));
				//$result=$query->result();
				if(!$result)
    				return -1;
    		$query=$this->db->where('comments', array('reply_id' => $comment_id))->get();
    		$result=$query->result();
    		if(!result)
    				return 1;
    		foreach ($result as $comment_in){
    				$result_in=$this->del($comment_in->$comment_id);
						if(-1==$result_in)
    						return -1;
				}
    		return 1;
		}
		
		/*获取评论，先得到sche的所有评论，再根据groupid得到每个评论的回复，返回以时间为order*/
		public function get($comment_id)
		{
			$query = $this->db->order_by('update_time ASC,comment_id ASC')->get_where('comments',array('comment_id'=>$comment_id));
    	$result=$query->result();
    	if(!$result)
    		return -1;
    	return $result;
		}
		
		/*
    *获取对用户的评论
    失败返回-1
    用于个人通知页面
    */
    public function commentsToMe($openId)
    {
    	//echo $openId;
    	$query = $this->db->order_by('update_time ASC,comment_id ASC')->get_where('comments',array('to_whom'=>$openId));
    	$result=$query->result();
    	if(!$result)
    		return -1;
    	return $result;
    	//$this->db->get('comments',)
    }
    
    /*
    *获取用户的评论
    *用于个人通知页面
    v失败返回-1
   	*/
    public function comments($openId)
    {
    	//echo $openId;
    	$query = $this->db->get_where('comments',array('user_id'=>$openId))->order_by('update_time ASC,comment_id ASC');
    	$result=$query->result();
    	if(!$result)
    		return -1;
    	return $result;
    	//$this->db->get('comments',)
    }
		public function currentComments($sche_Id)
    {
    	//echo $openId;
    	$query = $this->db->get_where('comments',array('sche_id'=>$sche_id))->order_by('update_time ASC,comment_id ASC');
    	$result=$query->result();
    	if(!$result)
    		return -1;
    	return $result;
    	//$this->db->get('comments',)
    }

		
}