<?php

class blanketadd extends Controller {

	function blanketadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['item__idstring'] = '';$this->load->library('generallib');
$data['item__idstring'] = $this->generallib->genId('Blanket');
$data['item__name'] = '';
$data['item__palleteno'] = '';
$data['item__codebaru'] = '';
$data['item__pressntype'] = '';
$data['item__ac'] = '';
$data['item__ar'] = '';
$data['item__thickness'] = '';
$data['item__bartype'] = '';
$data['item__movingspeed'] = '';
$data['item__minquantity'] = '';
$data['item__maxquantity'] = '';
$data['item__barorigin'] = '';
$data['item__barnonbar'] = '';
$data['item__buffer3months'] = '';
$data['item__intitemtype'] = 'blanket';
$data['item__itemcategory_id'] = '1';
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
		

		$this->load->view('blanket_add_form', $data);
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
$data['name'] = $_POST['item__name'];if (isset($_POST['item__palleteno']))
$data['palleteno'] = $_POST['item__palleteno'];if (isset($_POST['item__codebaru']))
$data['codebaru'] = $_POST['item__codebaru'];if (isset($_POST['item__pressntype']))
$data['pressntype'] = $_POST['item__pressntype'];if (isset($_POST['item__ac']))
$data['ac'] = $_POST['item__ac'];if (isset($_POST['item__ar']))
$data['ar'] = $_POST['item__ar'];if (isset($_POST['item__thickness']))
$data['thickness'] = $_POST['item__thickness'];if (isset($_POST['item__bartype']))
$data['bartype'] = $_POST['item__bartype'];if (isset($_POST['item__movingspeed']))
$data['movingspeed'] = $_POST['item__movingspeed'];if (isset($_POST['item__minquantity']))
$data['minquantity'] = $_POST['item__minquantity'];if (isset($_POST['item__maxquantity']))
$data['maxquantity'] = $_POST['item__maxquantity'];if (isset($_POST['item__barorigin']))
$data['barorigin'] = $_POST['item__barorigin'];if (isset($_POST['item__barnonbar']))
$data['barnonbar'] = $_POST['item__barnonbar'];
else $data['barnonbar'] = false;if (isset($_POST['item__buffer3months']))
$data['buffer3months'] = $_POST['item__buffer3months'];if (isset($_POST['item__intitemtype']))
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
$error .= $this->generallib->commonfunction('blanketadd','item','aftersave', $item_id);
			
		
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