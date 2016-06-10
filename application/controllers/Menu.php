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
		$data['url']='blank_page';
		$data['title']='Blank Page';
		//table data
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
		$data['title']='Home Page';
		$data['operation']=$this->operation_model->operation_list();//table data
		$this->load->view('main',$data);
	}
	public function book_management()
	{
		$data['url']='book_management';
		$data['title']='Book Management';
		$data['book']=$this->list_model->category_list();//table data
		$this->load->view('main',$data);
	}
	public function user_management()
	{
		$data['url']='user_management';
		$data['title']='User Management';
		$data['book']=$this->list_model->category_list();//table data
		$this->load->view('main',$data);
	}
	public function comment()
	{
		$data['url']='comment/comment';
		$data['title']='Comment';
		$data['userdata']=$this->list_model->book_list();//table data
		$this->load->view('main',$data);
	}
	public function lend_book()
	{
		$data['url']='lend_book';
		$data['title']='Lend Book';
		$this->load->view('main',$data);
	}
	public function return_book()
	{
		$data['url']='return_book';
		$data['title']='Return Book';
		$data['reminding']='';
		$this->load->view('main',$data);
	}
	public function personal_information()
	{
		$data['url']='personal_information';
		$data['title']='Personal Information';
		$data['userdata']=$this->user_model->get_userdata_by_student_number($this->session->userdata('studentNumber'));//table data
		$data['grade']=$this->user_model->grade_list();//table data
		$data['major']=$this->user_model->major_list();//table data
		$this->load->view('main',$data);
	}
	public function lend_record()
	{
		$data['url']='lend_record';
		$data['title']='Lend Record';
		$this->load->view('main',$data);
	}
	public function fine_rule()
	{
		$data['url']='fine_rule';
		$data['title']='Fine Rule';
		$this->load->view('main',$data);
	}
}
