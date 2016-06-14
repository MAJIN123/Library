<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('login_model');
    }
    public function index()
	{
		$data['url']='blank_page';
		$data['title']='Blank Page';
		//table data
		$this->load->view('main',$data);
	}
    public function ajax_user_list()
	{
		$list=$this->user_model->get_datatables();
        $data=array();
        $no=$_POST['start'];
        foreach ($list as $user) 
        {
            $no++;
            $row=array();
            $row[]=$user->student_number;
            $row[]=$user->name;
            $row[]=$user->permission_id;
            $row[]='<a class="btn btn-sm btn-primary" href="javascript:void()" title="修改" onclick="edit_user('."'".$user->student_number."'".')"><i class="glyphicon glyphicon-edit"></i> 修改</a>';
            //add html for action
            $row[]='<a class="btn btn-sm btn-danger" href="javascript:void()" title="删除" onclick="delete_user('."'".$user->student_number."'".')"><i class="glyphicon glyphicon-trash"></i> 删除</a>';
            $data[]=$row;
        }
        $output=array(
            "draw"=>$_POST['draw'],
            "recordsTotal"=>$this->user_model->count_all(),
            "recordsFiltered"=>$this->user_model->count_filtered(),
            "data"=>$data,);       
        echo json_encode($output);
	}
    public function ajax_add_user()
    {
        $this->_ajax_add_user_validate();
		$data=array(
                'student_number'=>$this->input->post('student_number'),
                'name'=>$this->input->post('name'),
                'sex'=>$this->input->post('sex'),
                'grade'=>$this->input->post('grade'), 
                'major'=>$this->input->post('major'),
                'permission_id'=>$this->input->post('permission_id'),
                'account_balance'=>$this->input->post('account_balance')
			); 
		$affect=$this->user_model->save($data);
		echo json_encode(array("status"=>TRUE));
    }
    private function _ajax_add_user_validate()
    {
        $this->form_validation->set_rules('student_number','学号','required');
        $this->form_validation->set_rules('name','姓名','required|callback_user_check[name]');
        $this->form_validation->set_rules('sex','性别','required|callback_user_check[sex]');
        $this->form_validation->set_rules('grade','年级','required|callback_user_check[grade]');
        $this->form_validation->set_rules('major','专业','required|callback_user_check[major]');
        $this->form_validation->set_rules('permission_id','权限','required|callback_user_check[permission_id]');
        $this->form_validation->set_rules('account_balance','余额','required|callback_account_balance_check[account_balance]');
		if ($this->form_validation->run()==FALSE)
        {
            echo json_encode(array("error"=>validation_errors()));
            exit();
        }
    }
    function user_check($info)
    {
        $data=$this->user_model->get_userdata_by_student_number($this->input->post('student_number'));
        if($data)
            $user=get_object_vars($data);
        if($data==null||in_array($info,$user)) 
            $judge=true;
        else
        {
            $this->form_validation->set_message('user_check','该学号学生已存在');
            $judge=FALSE;
        }
        return $judge;
    }
    function account_balance_check($account_balance)
    {
        if($account_balance<0)
        {
            $this->form_validation->set_message('account_balance_check','余额小于0');
            return false;
        }
        return true;
    }
    public function ajax_detailed_info($student_number)
    {
        $user=$this->user_model->get_userdata_by_student_number($student_number);
        echo json_encode($user);
    }
    public function ajax_delete_user($student_number)
	{
		$rows=$this->user_model->delete_userdata_by_student_number($student_number);
		echo json_encode(array("status"=>TRUE));
	}
    public function update_personal_info()
    {
        $data=array(
            'student_number'=>$this->input->post('student_number'),
            'name'=>$this->input->post('name'),
            'sex'=>$this->input->post('sex'),
            'major'=>$this->input->post('major'),
            'grade'=>$this->input->post('grade'),
            'account_balance'=>$this->input->post('account_balance')
        ); 
        $this->_ajax_update_personal_info($data);
        $where=array('student_number'=>$data['student_number']);       
        $update=$this->user_model->update($data,$where);
		echo json_encode(array("status"=>TRUE));
    }
    private function _ajax_update_personal_info($data)
    {
        if($data['name']==null||$data['major']==null||$data['grade']==null)
        {
            echo json_encode(array("error"=>'必填项目不能为空！'));
            exit();
        }
        $this->form_validation->set_rules('account_balance','余额','required|callback_account_balance_check[account_balance]');
        if ($this->form_validation->run()==FALSE)
        {
            echo json_encode(array("error"=>validation_errors()));
            exit();
        }
    }
    public function change_password()
    {
        $this->form_validation->set_rules('old_password','原密码','required|callback_is_original_password',
            array('is_original_password'=>'原密码错误'));
            
        $this->form_validation->set_rules('new_password','新密码','required|min_length[6]');
        $this->form_validation->set_rules('confirm_password','确认密码','required|min_length[6]|matches[new_password]');  

        if($this->form_validation->run()==FALSE) 
        {
            echo json_encode(array("error"=>validation_errors()));
            exit();
        }
        else 
            if(!$this->user_model->change_password($this->session->userdata('studentNumber')))//camel拼法
            {
                echo json_encode(array("error"=>'修改密码失败'));
                exit();
            }
            else
                echo json_encode(array("status"=>TRUE));
    }
    public function is_original_password()
    {
        if($this->login_model->check_owner())
            return true;
        else 
            return false;
    }
}