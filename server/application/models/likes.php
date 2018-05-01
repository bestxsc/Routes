<?php
//delete true 
//get query
//update true
//insert	true
class Likes extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        
    }
    
    
    public function delete($sche_id,$user_id)
    {
    		$user=$this->db->get_where('like_his', ['sche_id' => $sche_id,'user_id'=>$user_id])->result();
    		if(!$user)
    		{
    				$result=$this->db->delete('like_his',['sche_id' => $sche_id,'user_id'=>$user_id]);
    				if(!$result)
    					return -1;
    				return 1;
				}
				else{
						return -1;
				}
    }
    public function create($data)
    {
    		$is_exit=$this->db->get_where('like_his', array('his_id' => $his_id))->result();
    		if(!$is_exit)
    				return -2;
    		$result=$this->db->insert('like_his', $data);
	    	//$result=$query->result();
				if(!$result)
	    		return -1;
	    	return 1;
    	}

}