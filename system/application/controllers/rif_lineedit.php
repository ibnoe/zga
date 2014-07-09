<?php

class rif_lineedit extends Controller {

	function rif_lineedit()
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
	
		
$q = $this->db->where('id', $rif_line_id);
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
$this->load->view('rif_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['rcnline__machinespec']))
$data['machinespec'] = $_POST['rcnline__machinespec'];if (isset($_POST['rcnline__rd']))
$data['rd'] = $_POST['rcnline__rd'];if (isset($_POST['rcnline__cd']))
$data['cd'] = $_POST['rcnline__cd'];if (isset($_POST['rcnline__rl']))
$data['rl'] = $_POST['rcnline__rl'];if (isset($_POST['rcnline__wl']))
$data['wl'] = $_POST['rcnline__wl'];if (isset($_POST['rcnline__tl']))
$data['tl'] = $_POST['rcnline__tl'];if (isset($_POST['rcnline__coretype']))
$data['coretype'] = $_POST['rcnline__coretype'];
if (isset($_POST['rcnline__accfitted']))
$data['accfitted'] = 1;
else
$data['accfitted'] = 0;if (isset($_POST['rcnline__repairrequest']))
$data['repairrequest'] = $_POST['rcnline__repairrequest'];if (isset($_POST['rcnline__remarks']))
$data['remarks'] = $_POST['rcnline__remarks'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['rif_line_id']);
$this->db->update('rcnline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('rif_lineedit','rcnline','afteredit', $_POST['rif_line_id']);
			
			
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