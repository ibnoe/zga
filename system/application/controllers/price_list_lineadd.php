<?php

class price_list_lineadd extends Controller {

	function price_list_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['pricelist_id'] = $id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['pricelistline__item_id'] = '';
$data['pricelistline__pdisc'] = '';
$data['pricelistline__price'] = '';
$data['pricelistline__lastupdate'] = '';
$data['pricelistline__updatedby'] = '';
$data['pricelistline__created'] = '';
$data['pricelistline__createdby'] = '';
$pricelist = array();
$this->db->where('id', $id);
$q = $this->db->get('pricelist');
if ($q->num_rows() > 0)
$pricelist = $q->row_array();
$data['pricelistline__lastupdate'] = $pricelist['lastupdate'];
$data['pricelistline__updatedby'] = $pricelist['updatedby'];
$data['pricelistline__created'] = $pricelist['created'];
$data['pricelistline__createdby'] = $pricelist['createdby'];
		

		$this->load->view('price_list_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['pricelistline__item_id']) || ($_POST['pricelistline__item_id'] == "" || $_POST['pricelistline__item_id'] == null  || $_POST['pricelistline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['pricelistline__price']) && ($_POST['pricelistline__price'] == "" || $_POST['pricelistline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['pricelist_id'] = $_POST['pricelist_id'];if (isset($_POST['pricelistline__item_id']))
$data['item_id'] = $_POST['pricelistline__item_id'];if (isset($_POST['pricelistline__pdisc']))
$data['pdisc'] = $_POST['pricelistline__pdisc'];if (isset($_POST['pricelistline__price']))
$data['price'] = $_POST['pricelistline__price'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('pricelistline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$pricelistline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('price_list_lineadd','pricelistline','aftersave', $pricelistline_id);
			
		
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