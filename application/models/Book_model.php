<?php
class Book_model extends CI_Model
{
    var $table='book';
	var $column=array('ISBN','book_name','author','press','collections','remaining_number'); 
	
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
        $book=$this->get_bookdata_by_ISBN($data['ISBN']);
        if($book==null) 
            $this->db->insert('book',$data);
        else
            $this->db->set('delete_time',null);
        $this->db->set('collections','collections+1',false);
        $this->db->set('remaining_number','remaining_number+1',false);
        $this->db->where('ISBN',$data['ISBN']);
        $this->db->update('book');
		return $this->db->affected_rows();
	}
    function update($data)
	{
        $book=$this->get_bookdata_by_ISBN($data['ISBN']);
        $temp=$book->remaining_number-$book->collections+$data['collections'];
        if($data['collections']==0) 
            $this->db->set('delete_time',date('Y-m-d H:i:s'));
        $this->db->set('collections',$data['collections']);
        $this->db->set('remaining_number',$temp);
        $this->db->where('ISBN',$data['ISBN']);
        $this->db->update('book');
		return $this->db->affected_rows();
	}
    function get_bookdata_by_ISBN($ISBN)
	{
        $query=$this->db->from($this->table)
                        ->where('ISBN',$ISBN)
                        ->get();
        return $query->row();   
	}
    function delete_bookdata_by_ISBN($ISBN)
	{
        $this->db->set('collections',0);
        $this->db->set('remaining_number',0);
        $data=array('delete_time'=>date('Y-m-d H:i:s'));
        $where=array('ISBN'=>$ISBN);
        $this->db->update('book',$data,$where);
		return $this->db->affected_rows();
	}
}