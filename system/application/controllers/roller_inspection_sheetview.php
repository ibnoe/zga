<?php

class roller_inspection_sheetview extends Controller {

	function roller_inspection_sheetview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($roller_inspection_sheet_id=0)
	{
		if ($roller_inspection_sheet_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $roller_inspection_sheet_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('rollerinspectionsheet');
if ($q->num_rows() > 0) {
$data = array();
$data['roller_inspection_sheet_id'] = $roller_inspection_sheet_id;
foreach ($q->result() as $r) {
$data['rollerinspectionsheet__idstring'] = $r->idstring;
$data['rollerinspectionsheet__date'] = $r->date;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['rollerinspectionsheet__customer_id'] = $r->customer_id;
$mesin_opt = array();
$q = $this->db->get('mesin');
foreach ($q->result() as $row) { $mesin_opt[$row->id] = $row->typename; }
$data['mesin_opt'] = $mesin_opt;
$data['rollerinspectionsheet__mesin_id'] = $r->mesin_id;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rollerinspectionsheet__roll_id'] = $r->roll_id;
$data['rollerinspectionsheet__orderno'] = $r->orderno;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rollerinspectionsheet__compound_id'] = $r->compound_id;
$data['rollerinspectionsheet__lastupdate'] = $r->lastupdate;
$data['rollerinspectionsheet__updatedby'] = $r->updatedby;
$data['rollerinspectionsheet__created'] = $r->created;
$data['rollerinspectionsheet__createdby'] = $r->createdby;}
$this->load->view('roller_inspection_sheet_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['rollerinspectionsheet__idstring'];
$data['date'] = $_POST['rollerinspectionsheet__date'];
$data['customer_id'] = $_POST['rollerinspectionsheet__customer_id'];
$data['mesin_id'] = $_POST['rollerinspectionsheet__mesin_id'];
$data['roll_id'] = $_POST['rollerinspectionsheet__roll_id'];
$data['orderno'] = $_POST['rollerinspectionsheet__orderno'];
$data['compound_id'] = $_POST['rollerinspectionsheet__compound_id'];
$data['lastupdate'] = $_POST['rollerinspectionsheet__lastupdate'];
$data['updatedby'] = $_POST['rollerinspectionsheet__updatedby'];
$data['created'] = $_POST['rollerinspectionsheet__created'];
$data['createdby'] = $_POST['rollerinspectionsheet__createdby'];
$this->db->where('id', $data['roller_inspection_sheet_id']);
$this->db->update('rollerinspectionsheet', $data);
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