<?php
//delete true 
//get query
//update true
//insert	true
class Draft extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        
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
    public function delete($draft_id)
    {
    		$result=$this->db->delete('drafts', array('draft_id' => $draft_id));
				//$result=$query->result();
				if(!$result)
    				return -1;
    		return 1;
    	}
    	
    public function exist($user_id)
    {
    		$query=$this->db->get('drafts', array('user_id' => $user_id));
				$result=$query->result();
				if(!$result)
    				return 1;
    		return 0;
    	}
    public function create($data)
    {
    		$result=$this->db->insert('drafts', $data);
	    	//$result=$query->result();
				if(!$result)
	    		return -1;
	    	return 1;
    	}
    public funtion update($date)
    {
    	$result=$this->db->where('draft_id',$data['draft_id'])->update('drafts', $data);
	    	//$result=$query->result();
				if(!$result)
	    		return -1;
	    	return 1;
    	}
}