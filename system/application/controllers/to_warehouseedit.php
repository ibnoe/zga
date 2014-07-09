<?php

class to_warehouseedit extends Controller {

	function to_warehouseedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($to_warehouse_id=0)
	{
		if ($to_warehouse_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $to_warehouse_id);
$this->db->select('*');
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0) {
$data = array();
$data['to_warehouse_id'] = $to_warehouse_id;
foreach ($q->result() as $r) {
$data['warehouse__name'] = $r->name;
$data['warehouse__address'] = $r->address;
$data['warehouse__phone'] = $r->phone;
$data['warehouse__fax'] = $r->fax;
$data['warehouse__lastupdate'] = $r->lastupdate;
$data['warehouse__updatedby'] = $r->updatedby;
$data['warehouse__created'] = $r->created;
$data['warehouse__createdby'] = $r->createdby;}
$this->load->view('to_warehouse_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['warehouse__name']) && ($_POST['warehouse__name'] == "" || $_POST['warehouse__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['warehouse__name']))
$data['name'] = $_POST['warehouse__name'];if (isset($_POST['warehouse__address']))
$data['address'] = $_POST['warehouse__address'];if (isset($_POST['warehouse__phone']))
$data['phone'] = $_POST['warehouse__phone'];if (isset($_POST['warehouse__fax']))
$data['fax'] = $_POST['warehouse__fax'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['to_warehouse_id']);
$this->db->update('warehouse', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('to_warehouseedit','warehouse','afteredit', $_POST['to_warehouse_id']);
			
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully updated.";
			}
			else
			{
				echo "<span style='background-color:red'>   </span> ".$error;
			}
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>