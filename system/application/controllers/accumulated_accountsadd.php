<?php

class accumulated_accountsadd extends Controller {

	function accumulated_accountsadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['coa__idstring'] = '';$this->load->library('generallib');
$data['coa__idstring'] = $this->generallib->genId('Accumulated Accounts');
$data['coa__name'] = '';
$coatype_opt = array();
$coatype_opt[''] = 'None';
$q = $this->db->get('coatype');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coatype_opt[$row->id] = $row->name; }
$data['coatype_opt'] = $coatype_opt;
$data['coa__coatype_id'] = '';
$data['coa__lastupdate'] = '';
$data['coa__updatedby'] = '';
$data['coa__created'] = '';
$data['coa__createdby'] = '';
		

		$this->load->view('accumulated_accounts_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['coa__idstring']) && ($_POST['coa__idstring'] == "" || $_POST['coa__idstring'] == null))
$error .= "<span class='error'>Acc No must not be empty"."</span><br>";

if (isset($_POST['coa__idstring'])) {
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
$this->db->insert('coa', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$coa_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('accumulated_accountsadd','coa','aftersave', $coa_id);
			
		
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