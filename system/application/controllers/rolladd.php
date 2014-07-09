<?php

class rolladd extends Controller {

	function rolladd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['item__idstring'] = '';$this->load->library('generallib');
$data['item__idstring'] = $this->generallib->genId('Roll');
$data['item__name'] = '';
$data['item__rollno'] = '';
$data['item__inktype'] = '';
$data['item__machinetype'] = '';
$data['item__core'] = '';
$data['item__rd'] = '';
$data['item__cd'] = '';
$data['item__rl'] = '';
$data['item__wl'] = '';
$data['item__tl'] = '';
$data['item__compound'] = '';
$data['item__processscheme'] = '';
$data['item__rollertype'] = '';
$data['item__isaccessories'] = '';
$data['item__minquantity'] = '';
$data['item__maxquantity'] = '';
$data['item__buffer3months'] = '';
$data['item__intitemtype'] = 'roll';
$data['item__itemcategory_id'] = '2';
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
		

		$this->load->view('roll_add_form', $data);
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
$data['name'] = $_POST['item__name'];if (isset($_POST['item__rollno']))
$data['rollno'] = $_POST['item__rollno'];if (isset($_POST['item__inktype']))
$data['inktype'] = $_POST['item__inktype'];if (isset($_POST['item__machinetype']))
$data['machinetype'] = $_POST['item__machinetype'];if (isset($_POST['item__core']))
$data['core'] = $_POST['item__core'];if (isset($_POST['item__rd']))
$data['rd'] = $_POST['item__rd'];if (isset($_POST['item__cd']))
$data['cd'] = $_POST['item__cd'];if (isset($_POST['item__rl']))
$data['rl'] = $_POST['item__rl'];if (isset($_POST['item__wl']))
$data['wl'] = $_POST['item__wl'];if (isset($_POST['item__tl']))
$data['tl'] = $_POST['item__tl'];if (isset($_POST['item__compound']))
$data['compound'] = $_POST['item__compound'];if (isset($_POST['item__processscheme']))
$data['processscheme'] = $_POST['item__processscheme'];if (isset($_POST['item__rollertype']))
$data['rollertype'] = $_POST['item__rollertype'];if (isset($_POST['item__isaccessories']))
$data['isaccessories'] = $_POST['item__isaccessories'];
else $data['isaccessories'] = false;if (isset($_POST['item__minquantity']))
$data['minquantity'] = $_POST['item__minquantity'];if (isset($_POST['item__maxquantity']))
$data['maxquantity'] = $_POST['item__maxquantity'];if (isset($_POST['item__buffer3months']))
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
$error .= $this->generallib->commonfunction('rolladd','item','aftersave', $item_id);
			
		
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