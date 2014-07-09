<?php

class locationedit extends Controller {

	function locationedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($location_id=0)
	{
		
$q = $this->db->where('id', $location_id);
$q = $this->db->get('contact');
if ($q->num_rows() > 0) {
$data = array();
$data['location_id'] = $location_id;
foreach ($q->result() as $r) {
$data['contact__firstname'] = $r->firstname;
$data['contact__address'] = $r->address;
$data['contact__phone'] = $r->phone;
$data['contact__fax'] = $r->fax;
$data['contact__email'] = $r->email;
$data['contact__iscustomer'] = $r->iscustomer;
$data['contact__issupplier'] = $r->issupplier;
$data['contact__iswarehouse'] = $r->iswarehouse;}
$this->load->view('location_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
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
$this->db->where('id', $_POST['location_id']);
$this->db->update('contact', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>