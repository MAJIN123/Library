<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('list_model');
		$this->load->model('user_model');
		$this->load->model('operation_model');
	}
	public function index()
	{
		$data['url']='home_page';
		$data['title']='主页';
		$data['operation']=$this->operation_model->operation_list();//table data
		$this->load->view('main',$data);
	}
	public function test()
	{
		$data['url']='test';
		$data['title']='Test';
		//table data
		$this->load->view('main',$data);
	}
	public function home_page()
	{
		$data['url']='home_page';
		$data['title']='主页';
		$data['operation']=$this->operation_model->operation_list();//table data
		$this->load->view('main',$data);
	}
	public function book_management()
	{
		$data['url']='book_management';
		$data['title']='图书管理';
		$data['book']=$this->list_model->category_list();//table data
		$this->load->view('main',$data);
	}
	public function user_management()
	{
		$data['url']='user_management';
		$data['title']='用户管理';
		$data['grade']=$this->user_model->grade_list();//table data
		$data['major']=$this->user_model->major_list();//table data
		$data['permission']=$this->list_model->permission_list();//table data
		$this->load->view('main',$data);
	}
	public function comment()
	{
		$data['url']='comment/comment';
		$data['title']='评论';
		$data['userdata']=$this->list_model->book_list();//table data
		$this->load->view('main',$data);
	}
	public function lend_book()
	{
		$data['url']='lend_book';
		$data['title']='借书';
		$this->load->view('main',$data);
	}
	public function return_book()
	{
		$data['url']='return_book';
		$data['title']='还书';
		$data['reminding']='';
		$this->load->view('main',$data);
	}
	public function personal_information()
	{
		$data['url']='personal_information';
		$data['title']='个人信息';
		$data['userdata']=$this->user_model->get_userdata_by_student_number($this->session->userdata('studentNumber'));//table data
		$data['grade']=$this->user_model->grade_list();//table data
		$data['major']=$this->user_model->major_list();//table data
		$this->load->view('main',$data);
	}
	public function lend_record()
	{
		$data['url']='lend_record';
		$data['title']='借书记录';
		$this->load->view('main',$data);
	}
}
