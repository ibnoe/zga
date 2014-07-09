<?php

class packing_unitedit extends Controller {

	function packing_unitedit()
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
	
		
$q = $this->db->where('id', $packing_unit_id);
$this->db->select('*');
$q = $this->db->get('packingunit');
if ($q->num_rows() > 0) {
$data = array();
$data['packing_unit_id'] = $packing_unit_id;
foreach ($q->result() as $r) {
$data['packingunit__name'] = $r->name;
$data['packingunit__ratio'] = $r->ratio;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['packingunit__uom_id'] = $r->uom_id;
$data['packingunit__lastupdate'] = $r->lastupdate;
$data['packingunit__updatedby'] = $r->updatedby;
$data['packingunit__created'] = $r->created;
$data['packingunit__createdby'] = $r->createdby;}
$this->load->view('packing_unit_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['packingunit__name']) && ($_POST['packingunit__name'] == "" || $_POST['packingunit__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (!isset($_POST['packingunit__uom_id']) || ($_POST['packingunit__uom_id'] == "" || $_POST['packingunit__uom_id'] == null  || $_POST['packingunit__uom_id'] == 0))
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
$this->db->where('id', $_POST['packing_unit_id']);
$this->db->update('packingunit', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('packing_unitedit','packingunit','afteredit', $_POST['packing_unit_id']);
			
			
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