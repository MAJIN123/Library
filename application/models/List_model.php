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
		// var_dump($role_list);
        // die();
        return $role_list;
    }
    function category_list()
    {
        $query=$this->db->query("select distinct category from book;");
        return $query->result();   
    }
}