<?php
class User_model extends CI_Model
{
    var $table='user';
	var $column=array('student_number','name','grade','major','sex'); 
	
	public function __construct() 
	{
    	parent::__construct();
		$this->load->model('login_model');
    }
    private function _get_datatables_query() //for search and order
    {     
        $this->db->from($this->table);
        $this->db->where('delete_time=',NULL);
        $i=0;
     
        foreach ($this->column as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item,$_POST['search']['value']);
                }
                else         
                    $this->db->or_like($item,$_POST['search']['value']);
                if(count($this->column)-1==$i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i]=$item; // set column array variable to order processing
            $i++;
        }
        if(isset($_POST['order'])) // here order processing
            $this->db->order_by($column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
        else if(isset($this->order))
        {
            $order=$this->order;
            $this->db->order_by(key($order),$order[key($order)]);
        }
    }
	function get_datatables()
    {
        $this->_get_datatables_query();
        
        if($_POST['length']!=-1)
        $this->db->limit($_POST['length'],$_POST['start']);
        $query=$this->db->get();
        return $query->result();
    }
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query=$this->db->get();
        return $query->num_rows();
    }
    function save($data)
	{
        $user=$this->get_userdata_by_student_number($data['student_number']);
        if($user==null) 
            $this->db->insert('user',$data);
        else
        {
            $data['delete_time']=null;
            $where=array('student_number'=>$data['student_number']);
            $this->db->update('user',$data,$where);
        }        
		return $this->db->affected_rows();
	}
    function update($data,$where)
	{
        $this->db->update('user',$data,$where);
		return $this->db->affected_rows();
	}
    function get_userdata_by_student_number($student_number)
	{
        $query=$this->db->from($this->table)
                        ->where('student_number',$student_number)
                        ->where('delete_time=',NULL)
                        ->get();
        return $query->row();   
	}
    function delete_userdata_by_student_number($student_number)
	{
        $data=array('delete_time'=>date('Y-m-d H:i:s'));
        $where=array('student_number'=>$student_number);
        $this->db->update('user',$data,$where);
		return $this->db->affected_rows();
	}
    function grade_list()
    {
        $grade_list=$this->db->select('grade')
                            ->from('user')
                            ->where('delete_time=',NULL)
                            ->distinct()
                            ->get()
                            ->result();
        return $grade_list;   
    }
    function major_list()
    {
        $major_list=$this->db->select('major')
                            ->from('user')
                            ->where('delete_time=',NULL)
                            ->distinct()
                            ->get()
                            ->result();
        return $major_list;   
    }
    function change_password($student_number)
	{	
		if($this->login_model->check_owner()) 
        {
			$data=array('password'=>password_hash($this->input->post('new_password'),PASSWORD_BCRYPT),);
			$this->db->update('user',$data,"student_number=$student_number");			
			return true;
		}
		return false;
	} 
}