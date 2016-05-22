<?php
class Log_model extends CI_Model 
{
	public function __construct() 
	{
    	// Call the CI_Model constructor
    	parent::__construct();
    }
	//log incorrect password and user
    function log_xa() 
	{
        $wrong_password=$this->input->post('pswd');
        $related_user=$this->input->post('user');
		
		if($this->agent->is_browser())
			$agent=$this->agent->browser().' '.$this->agent->version();
		elseif($this->agent->is_robot())
			$agent=$this->agent->robot();
		elseif($this->agent->is_mobile())
			$agent=$this->agent->mobile();
		else
			$agent='Unidentified User Agent';		       
		$detail=json_encode(array('wrong_password'=>$wrong_password,'related_user'=>$related_user,'user_agent'=>$agent));
		$array=array
		(
			'time'=>date('Y-m-d H:i:s'),
			'level'=>'01',
			'detail'=>$detail
		);
        $this->db->insert('system_log',$array);
    }
	//success login
	function log_xaa() 
	{
		$related_user=$this->input->post('username');
		
		if($this->agent->is_browser())
			$agent=$this->agent->browser().' '.$this->agent->version();
		else if($this->agent->is_robot())
			$agent=$this->agent->robot();
		else if($this->agent->is_mobile())
			$agent=$this->agent->mobile();
		else
			$agent='Unidentified User Agent';
		$detail=json_encode(array('related_user'=>$related_user,'user_agent'=>$agent));
		$array=array
		(
			'time'=>date('Y-m-d H:i:s'),
			'level'=>'00',
			'detail'=>$detail
		);
		$this->db->insert('system_log',$array);
    }
	//request made
	function log_xb() 
	{
        $related_user=$this->session->userdata('id');
		$detail=json_encode(array('url_request'=>uri_string(),'related_user'=>$related_user));
		$array=array
		(
			'time'=>date('Y-m-d H:i:s'),
			'level'=>'11',
			'detail'=>$detail
		);
        $this->db->insert('system_log',$array);
    }
	function get_open_record_log() 
	{
		return $this->db->select('open_room_record.*,meeting_room.name')
						->from('open_room_record')
						//filter
						->join('meeting_room','meeting_room.id=open_room_record.room_id')
						->order_by('time','DESC')
						->limit(100)
						->get()
						->result();
	}
}