<?php

class ap_statement extends Controller {

	function ap_statement()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	
	
	// a little helper
	function _id_in_array($id, $arr)
	{
		foreach ($arr as $srow)
		{
			if ($srow['id'] == $id)
			{
				return true;
			}
		}
		
		return false;
	}
	
	function index() 
	{
		$data = array();
		
		$today = getdate();
		$data['currentdate'] = $today['mday']."-".$today['mon']."-".$today['year'];
		
		$ap_opt = array();
		$ap_opt[0] = "All";
		//get all suppliers
		$suppliers = $this->db->get('supplier');
		if ($suppliers->num_rows() > 0)
			foreach ($suppliers->result() as $row) 
			{ 
				$ap_opt[$row->id] = $row->idstring; 
			}	
		$data['ap_opt'] = $ap_opt;
	
		$this->load->view('ap_statement_filter_view.php', $data);
	
	}
	
	function submit()
	{
		$supplier_id = $_POST['ap__supplier_id'];
		
		
		//get invoices for each customer
		if($supplier_id == 0) {
			$top1w = array();
			$top2w = array();
			$top1m = array();
			$top2m = array();
			
			//get all currencies
			$q = $this->db->get('currency');
			$currencies = $q->result_array();
			$data['currencies'] = $currencies;
			
			$s = $this->db->get('supplier');
			$allsupplier= $s->result_array();
			$data['suppliers'] = $allsupplier;
			//for each supplier, get each overdue AP
			foreach($allsupplier as $supp) {
				foreach($currencies as $curr) {
					//get invoice with top = 7 days
					$top1w[$supp['idstring']][$curr['name']] = array();
					
					$this->db->from('purchaseinvoice');
					$this->db->where('supplier_id', $supp['id']);
					$this->db->where('top', "1 Week");
					$this->db->where('currency_id', $curr['id']);
					$this->db->select('sum(total) as grandtotal');
					$q1 = $this->db->get();
					$sum = $q1->row_array();
					
					if($q1->num_rows() <= 0 ) {
						$top1w[$supp['idstring']][$curr['name']] = array( 'grandtotal' => 0);
					}
					else {
						$sum = $q1->row_array();
						$top1w[$supp['idstring']][$curr['name']] = array( 'grandtotal' => $sum['grandtotal']);
					}
					
					//get invoice with top = 2 weeks
					$top2w[$supp['idstring']][$curr['name']] = array();
					
					$this->db->from('purchaseinvoice');
					$this->db->where('supplier_id', $supp['id']);
					$this->db->where('top', '2 Weeks');
					$this->db->where('currency_id', $curr['id']);
					$this->db->select('sum(total) as grandtotal');
					$q2 = $this->db->get();
					
					
					if($q2->num_rows() == 0 ) {
					
						$top2w[$supp['idstring']][$curr['name']] = array( 'grandtotal' => 0);
					}
					else {
						$sum = $q2->row_array();
						$top2w[$supp['idstring']][$curr['name']] = array( 'grandtotal' => $sum['grandtotal']);
					}
							
					//get invoice with top = 1 month
					$top1m[$supp['idstring']][$curr['name']] = array();
					
					$this->db->from('purchaseinvoice');
					$this->db->where('supplier_id', $supp['id']);
					$this->db->where('top', '30 Days');
					$this->db->where('currency_id', $curr['id']);
					$this->db->select('sum(total) as grandtotal');
					$q3 = $this->db->get();
					
					if($q3->num_rows() <= 0 ) {
						$top1m[$supp['idstring']][$curr['name']] = array( 'grandtotal' => 0);
					}
					else {
						$sum = $q3->row_array();
						$top1m[$supp['idstring']][$curr['name']] = array( 'grandtotal' => $sum['grandtotal']);
					}
					
					//get invoice with top = 2 month
					$top2m[$supp['idstring']][$curr['name']] = array();
					
					$this->db->from('purchaseinvoice');
					$this->db->where('supplier_id', $supp['id']);
					$this->db->where('top', '60 Days');
					$this->db->where('currency_id', $curr['id']);
					$this->db->select('sum(total) as grandtotal');
					$q4 = $this->db->get();
					
					if($q4->num_rows() <= 0 ) {
						$top2m[$supp['idstring']][$curr['name']] = array( 'grandtotal' => 0);
						
					}
					else {
						$sum = $q4->row_array();
						$top2m[$supp['idstring']][$curr['name']] = array( 'grandtotal' => $sum['grandtotal']);
					}	
				}
			}
		}
		else { //get invoice for the selected customer
			$top1w = array();
			$top2w = array();
			$top1m = array();
			$top2m = array();
			
			//get all currencies
			$q = $this->db->get('currency');
			$currencies = $q->result_array();
			$data['currencies'] = $currencies;
			
			$this->db->from('supplier');
			$this->db->where('id', $supplier_id);
			$q5=$this->db->get();
			$supp = $q5->row_array();
			$data['suppliers'] = Array(array('idstring' => $supp['idstring']));
			
			foreach($currencies as $curr) {
				//get invoice with top = 7 days
				$top1w[$supp['idstring']][$curr['name']] = array();
				
				$this->db->from('purchaseinvoice');
				$this->db->where('supplier_id', $supplier_id);
				$this->db->where('top', '1 Week');
				$this->db->where('currency_id', $curr['id']);
				$this->db->select('sum(total) as grandtotal');
				$q1 = $this->db->get();
				$sum = $q1->row_array();
				
				if($q1->num_rows() <= 0 ) {
					$top1w[$supp['idstring']][$curr['name']] = array( 'grandtotal' => 0);
				}
				else {
					$sum = $q1->row_array();
					$top1w[$supp['idstring']][$curr['name']] = array( 'grandtotal' => $sum['grandtotal']);
				}
				
				//get invoice with top = 2 weeks
				$top2w[$supp['idstring']][$curr['name']] = array();
				
				$this->db->from('purchaseinvoice');
				$this->db->where('supplier_id', $supplier_id);
				$this->db->where('top', '2 Weeks');
				$this->db->where('currency_id', $curr['id']);
				$this->db->select('sum(total) as grandtotal');				
				$q2 = $this->db->get();
				
				
				if($q2->num_rows() == 0 ) {
				
					$top2w[$supp['idstring']][$curr['name']] = array( 'grandtotal' => 0);
				}
				else {
					$sum = $q2->row_array();
					$top2w[$supp['idstring']][$curr['name']] = array( 'grandtotal' => $sum['grandtotal']);
				}
						
				//get invoice with top = 1 month
				$top1m[$supp['idstring']][$curr['name']] = array();
				
				$this->db->from('purchaseinvoice');
				$this->db->where('supplier_id', $supplier_id);
				$this->db->where('top', '30 Days');
				$this->db->where('currency_id', $curr['id']);
				$this->db->select('sum(total) as grandtotal');
				$q3 = $this->db->get();
				
				if($q3->num_rows() <= 0 ) {
					$top1m[$supp['idstring']][$curr['name']] = array( 'grandtotal' => 0);
				}
				else {
					$sum = $q3->row_array();
					$top1m[$supp['idstring']][$curr['name']] = array( 'grandtotal' => $sum['grandtotal']);
				}
				
				//get invoice with top = 2 month
				$top2m[$supp['idstring']][$curr['name']] = array();
				
				$this->db->from('purchaseinvoice');
				$this->db->where('supplier_id', $supplier_id);
				$this->db->where('top', '60 Days');
				$this->db->where('currency_id', $curr['id']);
				$this->db->select('sum(total) as grandtotal');
				$q4 = $this->db->get();
				
				if($q4->num_rows() <= 0 ) {
					$top2m[$supp['idstring']][$curr['name']] = array( 'grandtotal' => 0);
				}
				else {
					$sum = $q4->row_array();
					$top2m[$supp['idstring']][$curr['name']] = array( 'grandtotal' => $sum['grandtotal']);
				}	
				
			}
			
		}
		
		
		$data['top1w'] = $top1w;
		$data['top2w'] = $top2w;
		$data['top1m'] = $top1m;
		$data['top2m'] = $top2m;
		
		
		//get invoices 
		// load view
		$this->load->view('ap_statement_view', $data);
		
	}
}

?>