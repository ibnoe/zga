<?php

class packing_unitview extends Controller {

	function packing_unitview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($packing_unit_id=0)
	{
		if ($packing_unit_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $packing_unit_id);
$this->db->select('*');
$q = $this->db->get('packingunit');
if ($q->num_rows() > 0) {
$data = array();
$data['packing_unit_id'] = $packing_unit_id;
foreach ($q->result() as $r) {
$data['packingunit__name'] = $r->name;
$data['packingunit__ratio'] = $r->ratio;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['packingunit__uom_id'] = $r->uom_id;
$data['packingunit__lastupdate'] = $r->lastupdate;
$data['packingunit__updatedby'] = $r->updatedby;
$data['packingunit__created'] = $r->created;
$data['packingunit__createdby'] = $r->createdby;}
$this->load->view('packing_unit_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['name'] = $_POST['packingunit__name'];
$data['ratio'] = $_POST['packingunit__ratio'];
$data['uom_id'] = $_POST['packingunit__uom_id'];
$data['lastupdate'] = $_POST['packingunit__lastupdate'];
$data['updatedby'] = $_POST['packingunit__updatedby'];
$data['created'] = $_POST['packingunit__created'];
$data['createdby'] = $_POST['packingunit__createdby'];
$this->db->where('id', $data['packing_unit_id']);
$this->db->update('packingunit', $data);
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