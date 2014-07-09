<?php

class warehouseview extends Controller {

	function warehouseview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($warehouse_id=0)
	{
		if ($warehouse_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $warehouse_id);
$this->db->select('*');
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0) {
$data = array();
$data['warehouse_id'] = $warehouse_id;
foreach ($q->result() as $r) {
$data['warehouse__name'] = $r->name;
$data['warehouse__address'] = $r->address;
$data['warehouse__phone'] = $r->phone;
$data['warehouse__fax'] = $r->fax;
$data['warehouse__lastupdate'] = $r->lastupdate;
$data['warehouse__updatedby'] = $r->updatedby;
$data['warehouse__created'] = $r->created;
$data['warehouse__createdby'] = $r->createdby;}
$this->load->view('warehouse_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['name'] = $_POST['warehouse__name'];
$data['address'] = $_POST['warehouse__address'];
$data['phone'] = $_POST['warehouse__phone'];
$data['fax'] = $_POST['warehouse__fax'];
$data['lastupdate'] = $_POST['warehouse__lastupdate'];
$data['updatedby'] = $_POST['warehouse__updatedby'];
$data['created'] = $_POST['warehouse__created'];
$data['createdby'] = $_POST['warehouse__createdby'];
$this->db->where('id', $data['warehouse_id']);
$this->db->update('warehouse', $data);
			validationonserver();
			
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