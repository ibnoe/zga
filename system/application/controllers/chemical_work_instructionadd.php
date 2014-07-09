<?php

class chemical_work_instructionadd extends Controller {

	function chemical_work_instructionadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['chemicalworkinstruction__idstring'] = '';$this->load->library('generallib');
$data['chemicalworkinstruction__idstring'] = $this->generallib->genId('Chemical Work Instruction');
$data['chemicalworkinstruction__date'] = '';
$data['chemicalworkinstruction__name'] = '';
$data['chemicalworkinstruction__joborderno'] = '';
$data['chemicalworkinstruction__packing'] = '';
$data['chemicalworkinstruction__qtyliterkg'] = '';
$data['chemicalworkinstruction__notes'] = '';
$data['chemicalworkinstruction__lastupdate'] = '';
$data['chemicalworkinstruction__updatedby'] = '';
$data['chemicalworkinstruction__created'] = '';
$data['chemicalworkinstruction__createdby'] = '';
		

		$this->load->view('chemical_work_instruction_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['chemicalworkinstruction__idstring']) && ($_POST['chemicalworkinstruction__idstring'] == "" || $_POST['chemicalworkinstruction__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['chemicalworkinstruction__idstring'])) {
$this->db->where('idstring', $_POST['chemicalworkinstruction__idstring']);
$q = $this->db->get('chemicalworkinstruction');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['chemicalworkinstruction__date']) && ($_POST['chemicalworkinstruction__date'] == "" || $_POST['chemicalworkinstruction__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['chemicalworkinstruction__name']) && ($_POST['chemicalworkinstruction__name'] == "" || $_POST['chemicalworkinstruction__name'] == null))
$error .= "<span class='error'>Product Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['chemicalworkinstruction__idstring']))
$data['idstring'] = $_POST['chemicalworkinstruction__idstring'];if (isset($_POST['chemicalworkinstruction__date']))
$this->db->set('date', "str_to_date('".$_POST['chemicalworkinstruction__date']."', '%d-%m-%Y')", false);if (isset($_POST['chemicalworkinstruction__name']))
$data['name'] = $_POST['chemicalworkinstruction__name'];if (isset($_POST['chemicalworkinstruction__joborderno']))
$data['joborderno'] = $_POST['chemicalworkinstruction__joborderno'];if (isset($_POST['chemicalworkinstruction__packing']))
$data['packing'] = $_POST['chemicalworkinstruction__packing'];if (isset($_POST['chemicalworkinstruction__qtyliterkg']))
$data['qtyliterkg'] = $_POST['chemicalworkinstruction__qtyliterkg'];if (isset($_POST['chemicalworkinstruction__notes']))
$data['notes'] = $_POST['chemicalworkinstruction__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('chemicalworkinstruction', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$chemicalworkinstruction_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('chemical_work_instructionadd','chemicalworkinstruction','aftersave', $chemicalworkinstruction_id);
			
		
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