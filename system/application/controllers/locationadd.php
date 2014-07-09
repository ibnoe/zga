<?php

class locationadd extends Controller {

	function locationadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['contact__firstname'] = '';
$data['contact__address'] = '';
$data['contact__phone'] = '';
$data['contact__fax'] = '';
$data['contact__email'] = '';
$data['contact__iscustomer'] = '';
$data['contact__issupplier'] = '';
$data['contact__iswarehouse'] = '';
		

		$this->load->view('location_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['contact__firstname']) && ($_POST['contact__firstname'] == "" || $_POST['contact__firstname'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['contact__firstname']))
$data['firstname'] = $_POST['contact__firstname'];if (isset($_POST['contact__address']))
$data['address'] = $_POST['contact__address'];if (isset($_POST['contact__phone']))
$data['phone'] = $_POST['contact__phone'];if (isset($_POST['contact__fax']))
$data['fax'] = $_POST['contact__fax'];if (isset($_POST['contact__email']))
$data['email'] = $_POST['contact__email'];if (isset($_POST['contact__iscustomer']))
$data['iscustomer'] = $_POST['contact__iscustomer'];if (isset($_POST['contact__issupplier']))
$data['issupplier'] = $_POST['contact__issupplier'];if (isset($_POST['contact__iswarehouse']))
$data['iswarehouse'] = $_POST['contact__iswarehouse'];
$this->db->insert('contact', $data);
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>