<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Return_book extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('user_model');
		$this->load->model('book_model');
        $this->load->model('list_model');
        $this->load->model('lend_model');
        $this->load->model('return_model');
	}
	public function index()
	{
		$data['url']='blank_page';
		$data['title']='Blank Page';
		//table data
		$this->load->view('main',$data);
	}
    public function ajax_return_book()
    {
        $this->_ajax_return_book_validate();
        $user=$this->user_model->get_userdata_by_student_number($this->input->post('student_number'));
        $book=$this->book_model->get_bookdata_by_ISBN($this->input->post('ISBN'));
        $return=$this->lend_model->get_specified_lenddata($this->input->post('ISBN'),$this->input->post('student_number'));
        
        $date=date('Y-m-d H:i:s');
        $time_length=(strtotime($date)-strtotime($return->lend_time))/3600-24;
        $fine=$time_length>0?$time_length:0;
        $account_balance=$user->account_balance-$fine;
        if($account_balance<0)
        {
            echo json_encode(array("error"=>'归还失败，该用户余额不足以抵消逾期罚款，请提醒充值'));
            exit();
        }
        
        $new_user=array('account_balance'=>$account_balance);         
        $new_book=array('remaining_number'=>$book->remaining_number+1);   
        $new_return=array('return_time'=>$date,'fine'=>$fine);
        
        $user_where=array('student_number'=>$this->input->post('student_number'));       
        $update1=$this->user_model->update($new_user,$user_where);
        
        $book_where=array('ISBN'=>$this->input->post('ISBN'));//指定条件元组更新
        $update2=$this->book_model->update($new_book,$book_where);//只有添加图书时更新时间
        
        $return_where=array(
            'ISBN'=>$this->input->post('ISBN'),
            'student_number'=>$this->input->post('student_number')
            );
        $update3=$this->return_model->update($new_return,$return_where);
        $reminding='归还成功！该用户余额剩余￥'."".$account_balance;
        $output=array(
            "status"=>TRUE,
            "reminding"=>$reminding
            );
		echo json_encode($output);
    }
    private function _ajax_return_book_validate()
    {
        $this->form_validation->set_rules('ISBN','ISBN','required');
        $this->form_validation->set_rules('book_name','书名','required|callback_book_check');
        $this->form_validation->set_rules('student_number','作者','required');
        $this->form_validation->set_rules('name','出版社','required|callback_user_check|callback_lend_check');
        
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
        if($data==null)
        {
            $this->form_validation->set_message('user_check','该学号的用户不存在');
            return false;
        }
        if($data->name!=$this->input->post('name')) 
        {
            $this->form_validation->set_message('user_check','学号与姓名不对应');
            return FALSE;
        }
        return true;
    }
    function lend_check()
    {
        $lend_record=$this->lend_model->get_lenddata_by_ISBN($this->input->post('ISBN'));
        if($lend_record==null)
        {
            $this->form_validation->set_message('lend_check','该ISBN号的书未被借');
            return false;
        }
        foreach($lend_record as $lend_record)
            if($lend_record->student_number==$this->input->post('student_number'))
            {
                if($lend_record->return_time!=null)
                {
                    $this->form_validation->set_message('lend_check','该书已被归还');
                    return false;
                }
                else
                    return true;
            }
        $this->form_validation->set_message('lend_check','没有该借书记录');
        return false;
    }
}
