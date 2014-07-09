<?php

class store_finished_productsview extends Controller {

	function store_finished_productsview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($store_finished_products_id=0)
	{
		
$q = $this->db->where('id', $store_finished_products_id);
$q = $this->db->get('morder');
if ($q->num_rows() > 0) {
$data = array();
$data['store_finished_products_id'] = $store_finished_products_id;
foreach ($q->result() as $r) {}
$this->load->view('store_finished_products_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['store_finished_products_id']);
$this->db->update('morder', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>