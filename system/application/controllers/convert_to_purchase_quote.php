<?php

class convert_to_purchase_quote extends Controller {

	function convert_to_purchase_quote()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function index($id=0)
	{
		$fromtable = "suratpermintaanpembelian";
		$fromtableline = "suratpermintaanpembelianline";
		$totable = "purchaseorderquote";
		$totableline = "purchaseorderquoteline";
		$fromtable_id = $id;
		$this->generallib->convertdata($fromtable, $fromtable_id, $totable, $fromtableline, $totableline);
		
		$data = array();
		$data['converttopurchasequote'] = true;
		$this->db->where("id", $id);
		$this->db->update($fromtable, $data);
	}
}
?>