<?php

class rif_lineadd extends Controller {

	function rif_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['rcn_id'] = $id;
$data['rcnline__machinespec'] = '';
$data['rcnline__rd'] = '';
$data['rcnline__cd'] = '';
$data['rcnline__rl'] = '';
$data['rcnline__wl'] = '';
$data['rcnline__tl'] = '';
$data['rcnline__coretype'] = '';
$data['rcnline__accfitted'] = '';
$data['rcnline__repairrequest'] = '';
$data['rcnline__remarks'] = '';
$data['rcnline__lastupdate'] = '';
$data['rcnline__updatedby'] = '';
$data['rcnline__created'] = '';
$data['rcnline__createdby'] = '';
		

		$this->load->view('rif_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();
$data['rcn_id'] = $_POST['rcn_id'];if (isset($_POST['rcnline__machinespec']))
$data['machinespec'] = $_POST['rcnline__machinespec'];if (isset($_POST['rcnline__rd']))
$data['rd'] = $_POST['rcnline__rd'];if (isset($_POST['rcnline__cd']))
$data['cd'] = $_POST['rcnline__cd'];if (isset($_POST['rcnline__rl']))
$data['rl'] = $_POST['rcnline__rl'];if (isset($_POST['rcnline__wl']))
$data['wl'] = $_POST['rcnline__wl'];if (isset($_POST['rcnline__tl']))
$data['tl'] = $_POST['rcnline__tl'];if (isset($_POST['rcnline__coretype']))
$data['coretype'] = $_POST['rcnline__coretype'];if (isset($_POST['rcnline__accfitted']))
$data['accfitted'] = $_POST['rcnline__accfitted'];
else $data['accfitted'] = false;if (isset($_POST['rcnline__repairrequest']))
$data['repairrequest'] = $_POST['rcnline__repairrequest'];if (isset($_POST['rcnline__remarks']))
$data['remarks'] = $_POST['rcnline__remarks'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('rcnline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$rcnline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('rif_lineadd','rcnline','aftersave', $rcnline_id);
			
		
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
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