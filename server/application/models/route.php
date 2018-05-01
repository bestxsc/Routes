<?php

class User extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
    
    public function get($sche_id)
    {
    	//echo $openId;
    	$query = $this->db->get_where('route',array('sche_id'=>$sche_id));
    	$result=$query->result();
    	if(!$result)
    		return -1;
    	return $result;
    	//$this->db->get('comments',)
    }
    
    public function getById($route_id)
    {
    	//echo $openId;
    	$query = $this->db->get_where('route',array('route_id'=>$route_id));
    	$result=$query->result();
    	if(!$result)
    		return -1;
    	return $result;
    	//$this->db->get('comments',)
    }
    
    public function delete($route_id)
    {
    		$result=$this->db->delete('route', array('route_id' => $route_id));
				//$result=$query->result();
				if(!$result)
    				return -1;
    		return 1;
    	}
    	
    public function create($data)
    {
    		$result=$this->db->insert('route', $data);
	    	//$result=$query->result();
				if(!$result)
	    		return -1;
	    	return 1;
    	}
    public funtion update($date)
    {
    	$result=$this->db->where('route_id',$data['route_id'])->update('drafts', $data);
	    	//$result=$query->result();
				if(!$result)
	    		return -1;
	    	return 1;
    	}
}