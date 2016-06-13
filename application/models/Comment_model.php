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
						->where('comment.delete_time =',NULL)
						->join('user','user.student_number=comment.student_number')
                        ->get();
        return $query->result();   
	}
	function appointed_commentdata($ISBN)
	{
		$query=$this->db->from('comment')
                        ->where('ISBN',$ISBN)
						->where('student_number',$this->session->userdata('studentNumber'))
						->where('delete_time =',NULL)
                        ->get();
        return $query->row();   
	}
    function save($data)
	{
		$date=date('Y-m-d H:i:s');
		$operation=array(
            'student_number'=>$this->session->userdata('studentNumber'),
            'note'=>'add_comment',
            'operation_time'=>$date,
            ); 
        $this->db->insert('operation_log',$operation);
        $data['comment_time']=$date;
        $this->db->insert('comment',$data);
		return $this->db->insert_id();
	}
	function update($data,$where)
	{
        $operation=array(
            'student_number'=>$where['student_number'],
            'note'=>'edit_comment',
            'operation_time'=>$data['comment_time'],
            ); 
        $this->db->insert('operation_log',$operation);
        $this->db->update('comment',$data,$where);
        return $this->db->affected_rows();
	}
	function delete_appointed_commentdata($ISBN)
	{
        $data=array('delete_time'=>date('Y-m-d H:i:s'));
        $where=array('ISBN'=>$ISBN,'student_number'=>$this->session->userdata('studentNumber'));
        $this->db->update('comment',$data,$where);
		return $this->db->affected_rows();
	}
}