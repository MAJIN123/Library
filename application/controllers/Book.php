<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('book_model');
    }
    public function index()
	{
		$data['url']='blank_page';
		$data['title']='Blank Page';
		//table data
		$this->load->view('main',$data);
	}
    public function ajax_book_list()
	{
		$list=$this->book_model->get_datatables();
        $data=array();
        $no=$_POST['start'];
        foreach ($list as $book) 
        {
            $no++;
            $row=array();
            $row[]=$book->book_name;
            $row[]=$book->author;
            $row[]=$book->collections;
            $row[]=$book->remaining_number;
            $row[]='<a class="btn btn-sm btn-info" href="javascript:void()" title="详细信息" onclick="detailed_info('."'".$book->ISBN."'".')"><i class="glyphicon glyphicon-pushpin"></i>详细信息</a>
                    <a class="btn btn-sm btn-primary" href="javascript:void()" title="修改" onclick="edit_book('."'".$book->ISBN."'".')"><i class="glyphicon glyphicon-edit"></i> 修改</a>';
            //add html for action
            $row[]='<a class="btn btn-sm btn-danger" href="javascript:void()" title="删除" onclick="delete_book('."'".$book->ISBN."'".')"><i class="glyphicon glyphicon-trash"></i> 删除</a>';
            $data[]=$row;
        }
        $output=array(
            "draw"=>$_POST['draw'],
            "recordsTotal"=>$this->book_model->count_all(),
            "recordsFiltered"=>$this->book_model->count_filtered(),
            "data"=>$data,);       
        echo json_encode($output);
	}
    public function ajax_add_book()
    {
        $this->_ajax_add_book_validate();
		$data=array(
                'ISBN'=>$this->input->post('ISBN'),
                'book_name'=>$this->input->post('book_name'),
                'author'=>$this->input->post('author'),
                'press'=>$this->input->post('press'), 
                'category'=>$this->input->post('category')
			); 
		$affect=$this->book_model->save($data);
		echo json_encode(array("status"=>TRUE));
    }
    private function _ajax_add_book_validate()
    {
        $this->form_validation->set_rules('ISBN','ISBN','required');
        $this->form_validation->set_rules('book_name','书名','required|callback_book_check[book_name]');
        $this->form_validation->set_rules('author','作者','required|callback_book_check[author]');
        $this->form_validation->set_rules('press','出版社','required|callback_book_check[press]');
        $this->form_validation->set_rules('category','类别','required|callback_book_check[category]');
		if ($this->form_validation->run()==FALSE)
        {
            echo json_encode(array("error"=>validation_errors()));
            exit();
        }
    }
    function book_check($info)
    {
        $data=$this->book_model->get_bookdata_by_ISBN($this->input->post('ISBN'));
        if($data)
            $book=get_object_vars($data);
        if($data==null||in_array($info,$book)) 
            $judge=true;
        else
        {
            $this->form_validation->set_message('book_check','该ISBN号的书存在，{field}不能不同');
            $judge=FALSE;
        }
        return $judge;
    }
    public function ajax_detailed_info($ISBN)
    {
        $book=$this->book_model->get_bookdata_by_ISBN($ISBN);
        echo json_encode($book);
    }
    // public function ajax_edit_book($ISBN)
    // {
    //     $book=$this->book_model->get_bookdata_by_ISBN($ISBN);
    //     echo json_encode($book);
    // }
    public function ajax_update_book()
    {
        $data=array(
            'ISBN'=>$this->input->post('ISBN'),
            'collections'=>$this->input->post('collections')
            );
        $book=$this->book_model->get_bookdata_by_ISBN($data['ISBN']);
        $temp=$book->remaining_number-$book->collections+$data['collections'];
        $data['remaining_number']=$temp;
        $update=$this->book_model->update($data);
		echo json_encode(array("status"=>TRUE));
    }
    public function ajax_delete_book($ISBN)
	{
		$rows=$this->book_model->delete_bookdata_by_ISBN($ISBN);
		echo json_encode(array("status"=>TRUE));
	}
}