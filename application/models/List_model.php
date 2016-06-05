<?php
class List_model extends CI_Model 
{     
	public function __construct() 
	{
    	// Call the CI_Model constructor
    	parent::__construct();
    }
    function user_list() 
	{
        $user_list=$this->db->select('*')
                            ->from('user')
                            ->where('delete_time =', NULL)
                            ->get()
                            ->result();
		// var_dump($user_list);
        // die();
        return $user_list;
    }
    function book_list() 
	{
        $role_list=$this->db->select('*')
                            ->from('book')
                            ->where('delete_time=',NULL)
                            ->get()
                            ->result();
        return $role_list;
    }
    function category_list()
    {
        $category_list=$this->db->select('*')
                                ->from('category')
                                ->where('delete_time=',NULL)
                                ->get()
                                ->result();
        return $category_list;   
    }
    function operation_log_list()
    {
        $operation_log_list=$this->db->select('*')
                                    ->from('operation_log')
                                    ->get()
                                    ->result();
        return $operation_log_list;   
    }
    function get_userdata_by_student_number($student_number)
	{
        $query=$this->db->from('user')
                        ->where('student_number',$student_number)
                        ->where('delete_time=',NULL)
                        ->get();
        return $query->row();   
	}
}