<?php
class Lend_model extends CI_Model
{  
    function insert($data)
	{
        $operation=array(
            'student_number'=>$data['student_number'],
            'note'=>'lend_book',
            'operation_time'=>$data['lend_time'],
            ); 
        $this->db->insert('operation_log',$operation);
        $this->db->insert('lend',$data);
        return $this->db->affected_rows();
	}
}