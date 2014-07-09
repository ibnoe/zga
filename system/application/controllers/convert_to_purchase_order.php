<?php

class convert_to_purchase_order extends Controller {

	function convert_to_purchase_order()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function index($id=0)
	{
		$fromtable = "purchaseorderquote";
		$fromtableline = "purchaseorderquoteline";
		$totable = "purchaseorder";
		$totableline = "purchaseorderline";
		$fromtable_id = $id;
		$this->generallib->convertdata($fromtable, $fromtable_id, $totable, $fromtableline, $totableline);
		
		$data = array();
		$data['converttopurchaseorder'] = true;
		$this->db->where("id", $id);
		$this->db->update($fromtable, $data);
	}
}
?>