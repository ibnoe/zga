<?php

class inventory_accountsedit extends Controller {

	function inventory_accountsedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($inventory_accounts_id=0)
	{
		if ($inventory_accounts_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $inventory_accounts_id);
$this->db->select('*');
$q = $this->db->get('coa');
if ($q->num_rows() > 0) {
$data = array();
$data['inventory_accounts_id'] = $inventory_accounts_id;
foreach ($q->result() as $r) {
$data['coa__idstring'] = $r->idstring;
$data['coa__name'] = $r->name;
$coatype_opt = array();
$coatype_opt[''] = 'None';
$q = $this->db->get('coatype');
foreach ($q->result() as $row) { $coatype_opt[$row->id] = $row->name; }
$data['coatype_opt'] = $coatype_opt;
$data['coa__coatype_id'] = $r->coatype_id;
$data['coa__lastupdate'] = $r->lastupdate;
$data['coa__updatedby'] = $r->updatedby;
$data['coa__created'] = $r->created;
$data['coa__createdby'] = $r->createdby;}
$this->load->view('inventory_accounts_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['coa__idstring']) && ($_POST['coa__idstring'] == "" || $_POST['coa__idstring'] == null))
$error .= "<span class='error'>Acc No must not be empty"."</span><br>";

if (isset($_POST['coa__idstring'])) {$this->db->where("id !=", $_POST['inventory_accounts_id']);
$this->db->where('idstring', $_POST['coa__idstring']);
$q = $this->db->get('coa');
if ($q->num_rows() > 0) $error .= "<span class='error'>Acc No must be unique"."</span><br>";}

if (isset($_POST['coa__name']) && ($_POST['coa__name'] == "" || $_POST['coa__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['coa__idstring']))
$data['idstring'] = $_POST['coa__idstring'];if (isset($_POST['coa__name']))
$data['name'] = $_POST['coa__name'];if (isset($_POST['coa__coatype_id']))
$data['coatype_id'] = $_POST['coa__coatype_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['inventory_accounts_id']);
$this->db->update('coa', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('inventory_accountsedit','coa','afteredit', $_POST['inventory_accounts_id']);
			
			
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