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
    function get_lenddata_by_ISBN($ISBN)//指定条件
	{
        $query=$this->db->from('lend')
                        ->where('ISBN',$ISBN)
                        ->get();
        return $query->result();   
	}
    function get_specified_lenddata($ISBN,$student_number)//保证返回记录只有一条
	{
        $query=$this->db->from('lend')
                        ->where('ISBN',$ISBN)
                        ->where('student_number',$student_number)
                        ->get();
        return $query->row();   
	}
    function lend_record() 
	{
        if($this->session->userdata('permissionId')==1)
            $lend_list=$this->db->select('*')
                                ->from('lend')
                                ->join('book','book.ISBN=lend.ISBN')
                                ->join('user','user.student_number=lend.student_number')
                                ->get()
                                ->result();
        else
            $lend_list=$this->db->select('*')
                                ->from('lend')
                                ->where('lend.student_number',$this->session->userdata('studentNumber'))
                                ->join('book','book.ISBN=lend.ISBN')
                                ->join('user','user.student_number=lend.student_number')
                                ->get()
                                ->result();
        return $lend_list;
    }
}