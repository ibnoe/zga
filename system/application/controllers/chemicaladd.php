<?php

class chemicaladd extends Controller {

	function chemicaladd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['item__idstring'] = '';$this->load->library('generallib');
$data['item__idstring'] = $this->generallib->genId('Chemical');
$data['item__name'] = '';
$data['item__chemicalcode'] = '';
$data['item__chemicaltype'] = '';
$data['item__packingsize'] = '';
$data['item__intitemtype'] = 'chemical';
$data['item__itemcategory_id'] = '3';
$data['item__purchaseable'] = '';
$data['item__sellable'] = '';
$data['item__manufactured'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['item__persediaan_coa_id'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['item__hpp_coa_id'] = '';
$data['item__lastupdate'] = '';
$data['item__updatedby'] = '';
$data['item__created'] = '';
$data['item__createdby'] = '';
		

		$this->load->view('chemical_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['item__idstring']) && ($_POST['item__idstring'] == "" || $_POST['item__idstring'] == null))
$error .= "<span class='error'>Item ID must not be empty"."</span><br>";

if (isset($_POST['item__idstring'])) {
$this->db->where('idstring', $_POST['item__idstring']);
$q = $this->db->get('item');
if ($q->num_rows() > 0) $error .= "<span class='error'>Item ID must be unique"."</span><br>";}

if (isset($_POST['item__name']) && ($_POST['item__name'] == "" || $_POST['item__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (!isset($_POST['item__persediaan_coa_id']) || ($_POST['item__persediaan_coa_id'] == "" || $_POST['item__persediaan_coa_id'] == null  || $_POST['item__persediaan_coa_id'] == null))
$error .= "<span class='error'>Account Persediaan must not be empty"."</span><br>";

if (!isset($_POST['item__hpp_coa_id']) || ($_POST['item__hpp_coa_id'] == "" || $_POST['item__hpp_coa_id'] == null  || $_POST['item__hpp_coa_id'] == null))
$error .= "<span class='error'>Account HPP must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['item__idstring']))
$data['idstring'] = $_POST['item__idstring'];if (isset($_POST['item__name']))
$data['name'] = $_POST['item__name'];if (isset($_POST['item__chemicalcode']))
$data['chemicalcode'] = $_POST['item__chemicalcode'];if (isset($_POST['item__chemicaltype']))
$data['chemicaltype'] = $_POST['item__chemicaltype'];if (isset($_POST['item__packingsize']))
$data['packingsize'] = $_POST['item__packingsize'];if (isset($_POST['item__intitemtype']))
$data['intitemtype'] = $_POST['item__intitemtype'];if (isset($_POST['item__itemcategory_id']))
$data['itemcategory_id'] = $_POST['item__itemcategory_id'];if (isset($_POST['item__purchaseable']))
$data['purchaseable'] = $_POST['item__purchaseable'];
else $data['purchaseable'] = false;if (isset($_POST['item__sellable']))
$data['sellable'] = $_POST['item__sellable'];
else $data['sellable'] = false;if (isset($_POST['item__manufactured']))
$data['manufactured'] = $_POST['item__manufactured'];
else $data['manufactured'] = false;if (isset($_POST['item__persediaan_coa_id']))
$data['persediaan_coa_id'] = $_POST['item__persediaan_coa_id'];if (isset($_POST['item__hpp_coa_id']))
$data['hpp_coa_id'] = $_POST['item__hpp_coa_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('item', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$item_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('chemicaladd','item','aftersave', $item_id);
			
		
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