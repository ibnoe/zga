<?php

class price_list_lineedit extends Controller {

	function price_list_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($price_list_line_id=0)
	{
		if ($price_list_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $price_list_line_id);
$this->db->select('*');
$q = $this->db->get('pricelistline');
if ($q->num_rows() > 0) {
$data = array();
$data['price_list_line_id'] = $price_list_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['pricelistline__item_id'] = $r->item_id;
$data['pricelistline__pdisc'] = $r->pdisc;
$data['pricelistline__price'] = $r->price;
$data['pricelistline__lastupdate'] = $r->lastupdate;
$data['pricelistline__updatedby'] = $r->updatedby;
$data['pricelistline__created'] = $r->created;
$data['pricelistline__createdby'] = $r->createdby;}
$this->load->view('price_list_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['pricelistline__item_id']) || ($_POST['pricelistline__item_id'] == "" || $_POST['pricelistline__item_id'] == null  || $_POST['pricelistline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['pricelistline__price']) && ($_POST['pricelistline__price'] == "" || $_POST['pricelistline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['pricelistline__item_id']))
$data['item_id'] = $_POST['pricelistline__item_id'];if (isset($_POST['pricelistline__pdisc']))
$data['pdisc'] = $_POST['pricelistline__pdisc'];if (isset($_POST['pricelistline__price']))
$data['price'] = $_POST['pricelistline__price'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['price_list_line_id']);
$this->db->update('pricelistline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('price_list_lineedit','pricelistline','afteredit', $_POST['price_list_line_id']);
			
			
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