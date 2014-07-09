<?php

class packing_unitadd extends Controller {

	function packing_unitadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['packingunit__name'] = '';
$data['packingunit__ratio'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['packingunit__uom_id'] = '';
$data['packingunit__lastupdate'] = '';
$data['packingunit__updatedby'] = '';
$data['packingunit__created'] = '';
$data['packingunit__createdby'] = '';
		

		$this->load->view('packing_unit_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['packingunit__name']) && ($_POST['packingunit__name'] == "" || $_POST['packingunit__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (!isset($_POST['packingunit__uom_id']) || ($_POST['packingunit__uom_id'] == "" || $_POST['packingunit__uom_id'] == null  || $_POST['packingunit__uom_id'] == null))
$error .= "<span class='error'>Uom must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['packingunit__name']))
$data['name'] = $_POST['packingunit__name'];if (isset($_POST['packingunit__ratio']))
$data['ratio'] = $_POST['packingunit__ratio'];if (isset($_POST['packingunit__uom_id']))
$data['uom_id'] = $_POST['packingunit__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('packingunit', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$packingunit_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('packing_unitadd','packingunit','aftersave', $packingunit_id);
			
		
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