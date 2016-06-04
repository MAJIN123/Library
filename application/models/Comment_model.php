<?php
class Comment_model extends CI_Model
{
    
	public function __construct() 
	{
    	parent::__construct();
		$this->load->model('login_model');
    }
	function get_commentdata_by_ISBN($ISBN)
	{
        $query=$this->db->from('comment')
                        ->where('ISBN',$ISBN)
						->join('user','user.student_number=comment.student_number')
                        ->get();
        return $query->result();   
	}
	function appointed_commentdata($ISBN)
	{
		$query=$this->db->from('comment')
                        ->where('ISBN',$ISBN)
						->where('student_number',$this->session->userdata('studentNumber'))
                        ->get();
        return $query->row();   
	}
    function save($data)
	{
        $data['comment_time']=date('Y-m-d H:i:s');
        $this->db->insert('comment',$data);
		return $this->db->insert_id();
	}
}