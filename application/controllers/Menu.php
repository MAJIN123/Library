<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data['url']='blank_page';
		$data['title']='Blank Page';
		//table data
		$this->load->view('main',$data);
	}
	public function home_page()
	{
		$data['url']='home_page';
		$data['title']='Home Page';
		//table data
		$this->load->view('main',$data);
	}
	public function book_management()
	{
		$data['url']='book_management';
		$data['title']='Book Management';
		//table data
		$this->load->view('main',$data);
	}
}
