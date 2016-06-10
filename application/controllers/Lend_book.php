<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lend_book extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('user_model');
		$this->load->model('book_model');
        $this->load->model('list_model');
        $this->load->model('lend_model');
	}
	public function index()
	{
		$data['url']='blank_page';
		$data['title']='Blank Page';
		//table data
		$this->load->view('main',$data);
	}
    public function ajax_lend_book()
    {
        $this->_ajax_add_lend_validate();
        $book=$this->book_model->get_bookdata_by_ISBN($this->input->post('ISBN'));
        $new_book=array(
            'ISBN'=>$this->input->post('ISBN'),//ISBN必须有
            'remaining_number'=>$book->remaining_number-1
            );
        $where=array('ISBN'=>$this->input->post('ISBN'));
        $update1=$this->book_model->update($new_book,$where);
        $new_lend=array(
            'ISBN'=>$this->input->post('ISBN'),
            'student_number'=>$this->input->post('student_number'),
            'lend_time'=>date('Y-m-d H:i:s')
        );
        $update2=$this->lend_model->insert($new_lend);
		echo json_encode(array("status"=>TRUE));
    }
    private function _ajax_add_lend_validate()
    {
        $this->form_validation->set_rules('ISBN','ISBN','required');
        $this->form_validation->set_rules('book_name','书名','required|callback_book_check');
        $this->form_validation->set_rules('student_number','作者','required');
        $this->form_validation->set_rules('name','出版社','required|callback_user_check');
		if ($this->form_validation->run()==FALSE)
        {
            echo json_encode(array("error"=>validation_errors()));
            exit();
        }
    }
    function book_check()
    {
        $data=$this->book_model->get_bookdata_by_ISBN($this->input->post('ISBN'));
        if($data==null)
        {
            $this->form_validation->set_message('book_check','该ISBN号不存在');
            return false;
        }
        if($data->remaining_number==0)
        {
            $this->form_validation->set_message('book_check','该ISBN号的书藏量为0');
            return false;
        }
        if($data->book_name!=$this->input->post('book_name')) 
        {
            $this->form_validation->set_message('book_check','书名与ISBN号不对应');
            return FALSE;
        }
        return true;
    }
    function user_check()
    {
        $data=$this->user_model->get_userdata_by_student_number($this->input->post('student_number'));
        $record=$this->lend_model->get_specified_lenddata($this->input->post('ISBN'),$this->input->post('student_number'));
        if($data==null)
        {
            $this->form_validation->set_message('user_check','该学号的用户不存在');
            return false;
        }
        if($data->is_blocked==1)
        {
            $this->form_validation->set_message('user_check','该账户已被冻结，不可借书，可能是因为余额不足');
            return false;
        }
        if($data->name!=$this->input->post('name')) 
        {
            $this->form_validation->set_message('user_check','学号与姓名不对应');
            return FALSE;
        }
        if($record!=null&&$record->return_time==null)
        {
            $this->form_validation->set_message('user_check','同一本书只能借一次，该用户已借过且未归还');
            return FALSE;
        }
        return true;
    }
    public function lend_record_list()
	{
		$list=$this->lend_model->lend_record();
        echo json_encode($list);
	}
}
