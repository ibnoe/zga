<?php

class mesinadd extends Controller {

	function mesinadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['mesin__idstring'] = '';
$data['mesin__typename'] = '';
$merkmesin_opt = array();
$merkmesin_opt[''] = 'None';
$q = $this->db->get('merkmesin');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $merkmesin_opt[$row->id] = $row->name; }
$data['merkmesin_opt'] = $merkmesin_opt;
$data['mesin__merkmesin_id'] = '';
$data['mesin__lastupdate'] = '';
$data['mesin__updatedby'] = '';
$data['mesin__created'] = '';
$data['mesin__createdby'] = '';
		

		$this->load->view('mesin_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['mesin__idstring']) && ($_POST['mesin__idstring'] == "" || $_POST['mesin__idstring'] == null))
$error .= "<span class='error'>Kode Mesin must not be empty"."</span><br>";

if (isset($_POST['mesin__idstring'])) {
$this->db->where('idstring', $_POST['mesin__idstring']);
$q = $this->db->get('mesin');
if ($q->num_rows() > 0) $error .= "<span class='error'>Kode Mesin must be unique"."</span><br>";}

if (isset($_POST['mesin__typename']) && ($_POST['mesin__typename'] == "" || $_POST['mesin__typename'] == null))
$error .= "<span class='error'>Tipe Mesin must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['mesin__idstring']))
$data['idstring'] = $_POST['mesin__idstring'];if (isset($_POST['mesin__typename']))
$data['typename'] = $_POST['mesin__typename'];if (isset($_POST['mesin__merkmesin_id']))
$data['merkmesin_id'] = $_POST['mesin__merkmesin_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('mesin', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$mesin_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('mesinadd','mesin','aftersave', $mesin_id);
			
		
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