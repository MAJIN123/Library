<?php
class Return_model extends CI_Model
{  
    function update($data,$where)
	{
        $operation=array(
            'student_number'=>$where['student_number'],
            'note'=>'return_book',
            'operation_time'=>$data['return_time'],
            ); 
        $this->db->insert('operation_log',$operation);
        $this->db->update('lend',$data,$where);
        return $this->db->affected_rows();
	}
}