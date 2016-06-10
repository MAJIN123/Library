<?php
class Operation_model extends CI_Model
{
    
	public function __construct() 
	{
    	parent::__construct();
		$this->load->model('login_model');
    }
	public function operation_list()
    {
        $add_book=$this->db->select('*')
                            ->from('operation_log')
                            ->join('book','book.latest_time=operation_log.operation_time')
                            ->join('user','user.student_number=operation_log.student_number')
                            ->where('note','add_book')
                            ->get()
                            ->result();
        $lend_book=$this->db->select('*')
                            ->from('operation_log')
                            ->join('lend','lend.lend_time=operation_log.operation_time')
                            ->join('book','book.ISBN=lend.ISBN')
                            ->join('user','user.student_number=operation_log.student_number')
                            ->where('note','lend_book')
                            ->get()
                            ->result();
        $return_book=$this->db->select('*')
                            ->from('operation_log')
                            ->join('lend','lend.return_time=operation_log.operation_time')
                            ->join('book','book.ISBN=lend.ISBN')
                            ->join('user','user.student_number=operation_log.student_number')
                            ->where('note','return_book')
                            ->get()
                            ->result();
        $add_comment=$this->db->select('*')
                            ->from('operation_log')
                            ->join('comment','comment.comment_time=operation_log.operation_time')
                            ->join('book','book.ISBN=comment.ISBN')
                            ->join('user','user.student_number=operation_log.student_number')
                            ->where('note','add_comment')
                            ->get()
                            ->result();
        $operation=array_merge($add_book,$lend_book,$return_book,$add_comment);
        usort($operation,"self::date_sort");
        return $operation;
    }
    public function date_sort($operation1,$operation2)
    {
        if($operation1->operation_time==$operation2->operation_time)
            return 0;
        return strtotime($operation1->operation_time)<strtotime($operation2->operation_time)?1:-1;
    }
}