<?php

class item_in_stockview extends Controller {

	function item_in_stockview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($item_in_stock_id=0)
	{
		if ($item_in_stock_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $item_in_stock_id);
$this->db->select('*');
$q = $this->db->get('item');
if ($q->num_rows() > 0) {
$data = array();
$data['item_in_stock_id'] = $item_in_stock_id;
foreach ($q->result() as $r) {
$data['item__idstring'] = $r->idstring;
$data['item__name'] = $r->name;
$data['item__minquantity'] = $r->minquantity;
$data['item__maxquantity'] = $r->maxquantity;
$data['item__buffer3months'] = $r->buffer3months;
$data['item__purchaseable'] = $r->purchaseable;
$data['item__sellable'] = $r->sellable;
$data['item__manufactured'] = $r->manufactured;
$data['item__lastupdate'] = $r->lastupdate;
$data['item__updatedby'] = $r->updatedby;
$data['item__created'] = $r->created;
$data['item__createdby'] = $r->createdby;}
$this->load->view('item_in_stock_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['item__idstring'];
$data['name'] = $_POST['item__name'];
$data['minquantity'] = $_POST['item__minquantity'];
$data['maxquantity'] = $_POST['item__maxquantity'];
$data['buffer3months'] = $_POST['item__buffer3months'];
$data['purchaseable'] = $_POST['item__purchaseable'];
$data['sellable'] = $_POST['item__sellable'];
$data['manufactured'] = $_POST['item__manufactured'];
$data['lastupdate'] = $_POST['item__lastupdate'];
$data['updatedby'] = $_POST['item__updatedby'];
$data['created'] = $_POST['item__created'];
$data['createdby'] = $_POST['item__createdby'];
$this->db->where('id', $data['item_in_stock_id']);
$this->db->update('item', $data);
			validationonserver();
			
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