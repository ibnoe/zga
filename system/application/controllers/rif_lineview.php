<?php

class rif_lineview extends Controller {

	function rif_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($rif_line_id=0)
	{
		if ($rif_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $rif_line_id);
$this->db->select('*');
$q = $this->db->get('rcnline');
if ($q->num_rows() > 0) {
$data = array();
$data['rif_line_id'] = $rif_line_id;
foreach ($q->result() as $r) {
$data['rcnline__machinespec'] = $r->machinespec;
$data['rcnline__rd'] = $r->rd;
$data['rcnline__cd'] = $r->cd;
$data['rcnline__rl'] = $r->rl;
$data['rcnline__wl'] = $r->wl;
$data['rcnline__tl'] = $r->tl;
$data['rcnline__coretype'] = $r->coretype;
$data['rcnline__accfitted'] = $r->accfitted;
$data['rcnline__repairrequest'] = $r->repairrequest;
$data['rcnline__remarks'] = $r->remarks;
$data['rcnline__lastupdate'] = $r->lastupdate;
$data['rcnline__updatedby'] = $r->updatedby;
$data['rcnline__created'] = $r->created;
$data['rcnline__createdby'] = $r->createdby;}
$this->load->view('rif_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['machinespec'] = $_POST['rcnline__machinespec'];
$data['rd'] = $_POST['rcnline__rd'];
$data['cd'] = $_POST['rcnline__cd'];
$data['rl'] = $_POST['rcnline__rl'];
$data['wl'] = $_POST['rcnline__wl'];
$data['tl'] = $_POST['rcnline__tl'];
$data['coretype'] = $_POST['rcnline__coretype'];
$data['accfitted'] = $_POST['rcnline__accfitted'];
$data['repairrequest'] = $_POST['rcnline__repairrequest'];
$data['remarks'] = $_POST['rcnline__remarks'];
$data['lastupdate'] = $_POST['rcnline__lastupdate'];
$data['updatedby'] = $_POST['rcnline__updatedby'];
$data['created'] = $_POST['rcnline__created'];
$data['createdby'] = $_POST['rcnline__createdby'];
$this->db->where('id', $data['rif_line_id']);
$this->db->update('rcnline', $data);
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