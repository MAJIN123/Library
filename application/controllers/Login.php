<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('captcha_model');
    }
        //login in will redirect to here if user login in already
    public function index()
    {
        if($this->session->userdata('isLoggedIn'))
            redirect('menu');
        else 
        {
            $data['pic']=$this->captcha_model->init_pic();
            $data['error']='';
            $this->load->view('login',$data);
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('username',"用户名",'required');
        $this->form_validation->set_rules('password',"密码",'required');
        $this->form_validation->set_message('required','{field}不能为空!');
        //$this->form_validation->set_rules('captcha',"验证码",'required');
          
        if ($this->form_validation->run()==FALSE)
        {
            $data['error']=validation_errors();
            $this->load->view('login',$data);
        }
        $check=$this->login_model->check_login();
        if($check)
            redirect('menu');
        else 
        {
            $data['error']='用户名或者密码错误';
            $this->load->view('login',$data);
        }
    }
    function user_permission_check()
    {
        if($this->input->post('role')<$this->session->userdata('isAdmin')) 
            return true;
        else 
            return false;
    }    
    public function login_out() 
    {
        $this->session->sess_destroy();
        $this->index();
    }
}