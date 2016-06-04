<?php

class Login_model extends CI_Model 
{
	var $details;
	public function __construct() 
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('log_model');
    }
	public function check_login() 
    {
		$user=$this->db->where('student_number',$this->input->post('username'))
                        ->get('user')
                        ->result();
        
        if($user) 
        {
            $password=$user[0]->password;
		    return $this->validate_user($user,$password);
        }
        
        $this->log_model->log_xa();
        return false;
	}
    function validate_user($user,$password)
    {

		if(password_verify($this->input->post('password'),$password)) 
        {
            $this->details=$user[0];
            $this->log_model->log_xaa();
            $this->set_session();
            
            return true;
        }
        return false;
	}
    function set_session() 
    {
        // session->set_userdata is a CodeIgniter function that
        // stores data in CodeIgniter's session storage.  Some of the values are built in
        // to CodeIgniter, others are added.  See CodeIgniter's documentation for details.
        $data=array
        (
            'studentNumber'=>$this->details->student_number,
            'name'=>$this->details->name,
            'sex'=>$this->details->sex,
            'major'=>$this->details->major,
            'permissionId'=>$this->details->permission_id,
            'image'=>$this->details->image,
            'isLoggedIn'=>true
        );
        $this->session->set_userdata($data);
    }
}