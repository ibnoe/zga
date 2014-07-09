<?php

class Login extends Controller {

	function Login()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index()
	{
		$user = $this->session->userdata('user');
		
		if ($user == null || $user == "")
		{
			$this->load->view("login_view");
			//return;
		}
		else if (false && isset($_SERVER['HTTP_REFERER']))
		{
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			redirect('main');
		}
	}
	
	function submit()
	{
		//print_r($_POST);
		
		$this->db->where("username", $_POST['username']);
		$this->db->where("password", md5($_POST['password']));
		$q = $this->db->get("users");
		
		if ($q->num_rows() > 0)
		{		
			$data = array(
					   'user'  => $_POST['username'],
					   'logged_in' => TRUE
				   );

			$this->session->set_userdata($data);
		}
		
		redirect('login/index');
	}
	
	function logout()
	{
		$this->session->unset_userdata('user');
		redirect('login/index');
	}
}

?>