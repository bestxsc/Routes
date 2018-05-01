<?php

class Schedual extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
		
		/*获取用户的所有schedual，用于详情页面显示*/
		public function getFull($openId)
		{
			
			$query = $this->db->get_where('schedual',array('user_id'=>$openId));
    	$result=$query->result();
    	if($result==-1)
    		{
    			return -1;
    	}	
    	}
    	$this->load->model('route','',TRUE);
			$self=$this;
			$data=array();
			foreach ($result as $sche_in){
    			$result_in=$self->route->get($sche_in->sche_id);
    			//$result=$query->result();
					if(-1==$result_in)
    			{
    						array_push($data,['sche'=>$sche_in,'route'=>'']);
    				}
    			else
    			{
    						array_push($data,['sche'=>$sche_in,'route'=>$result_in]);
    				}
				}
    	
    	return $data;
		}
		public function get($openId)
    {
    	//echo $openId;
    	$query = $this->db->get_where('schedual',array('user_id'=>$openId));
    	$result=$query->result();
    	if(!$result)
    		return -1;
    	return $result;
    	//$this->db->get('comments',)
    }
    
    public function getBySche_id($sche_id)
    {
    	//echo $openId;
    	$query = $this->db->get_where('sche_id',array('sche_id'=>$sche_id));
    	$result=$query->result();
    	if(!$result)
    		return -1;
    	return $result;
    	//$this->db->get('comments',)
    }
    
    public function delete($schedual_id)
    {
    		$result=$this->db->delete('schedual', array('sche_id' => $schedual_id));
				//$result=$query->result();
				if(!$result)
    				return -1;
    		return 1;
    	}
    	
    public function exist($openId)
    {
    		$query=$this->db->get('schedual', array('user_id' => $openId));
				$result=$query->result();
				if(!$result)
    				return 1;
    		return 0;
    	}
    public function create($data)
    {
    		$result=$this->db->insert('schedual', $data);
	    	//$result=$query->result();
				if(!$result)
	    		return -1;
	    	return 1;
    	}
    public function update($date)
    {
    	$result=$this->db->where('sche_id',$data['sche_id'])->update('schedual', $data);
	    	//$result=$query->result();
				if(!$result)
	    		return -1;
	    	return 1;
    	}
		
		public function search($class)
    {
    	$result=$this->db->get_where('schedual',array('class'=>$class));
	    	//$result=$query->result();
				if(!$result)
	    		return -1;
	    	return $result;
    	}


}