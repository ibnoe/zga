<?php

class price_list_lineview extends Controller {

	function price_list_lineview()
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
	
		
$this->db->where('id', $price_list_line_id);
$this->db->select('*');
$q = $this->db->get('pricelistline');
if ($q->num_rows() > 0) {
$data = array();
$data['price_list_line_id'] = $price_list_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
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
$this->load->view('price_list_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['pricelistline__item_id'];
$data['pdisc'] = $_POST['pricelistline__pdisc'];
$data['price'] = $_POST['pricelistline__price'];
$data['lastupdate'] = $_POST['pricelistline__lastupdate'];
$data['updatedby'] = $_POST['pricelistline__updatedby'];
$data['created'] = $_POST['pricelistline__created'];
$data['createdby'] = $_POST['pricelistline__createdby'];
$this->db->where('id', $data['price_list_line_id']);
$this->db->update('pricelistline', $data);
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