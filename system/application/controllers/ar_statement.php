<?php

class ar_statement extends Controller {

	function ar_statement()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function _getAccountClassBalanceUpToDate($classname, $date)
	{
		$this->db->where("name", $classname);
		$this->db->where("date <=", $date);
		$this->db->from("classbalance");
		$this->db->select_sum("balance");
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
		{
			return $q->row()->balance;
		}
		
		return 0;
	}
	
	function _getCurrentProfitUpToDate($date)
	{
		$enddate = $date;
		$tmp = explode("-", $enddate);
		$endyear = $tmp[0];
		$endmonth = $tmp[1];
		$endday = $tmp[2];
		
		$endperioddate = "2011-12-31";
		
		$tmp = explode("-", $endperioddate);
		$endperiodyear = $tmp[0];
		$endperiodmonth = $tmp[1];
		$endperiodday = $tmp[2];
		
		if (($endperiodmonth <= $endmonth) && ($endperiodday < $endday))
		{
			$timestamp = mktime(0, 0, 0, $endperiodmonth, $endperiodday+1, $endyear);
			$begindate = date('Y-m-d', $timestamp);
		}
		else
		{
			$timestamp = mktime(0, 0, 0, $endperiodmonth, $endperiodday+1, $endyear-1);
			$begindate = date('Y-m-d', $timestamp);
		}
		
		/*echo "Begin: ".$begindate;
		echo "<br>";
		echo "End: ".$enddate;
		echo "<br>";*/
	
		$revenue_balance = $this->_getAccountClassBalanceUpToDate("Revenue", $begindate);
		$expense_balance = $this->_getAccountClassBalanceUpToDate("Expense", $begindate);
		
		$uptobeginbalance = $revenue_balance - $expense_balance;
		
		$revenue_balance = $this->_getAccountClassBalanceUpToDate("Revenue", $enddate);
		$expense_balance = $this->_getAccountClassBalanceUpToDate("Expense", $enddate);
		
		$uptoendbalance = $revenue_balance - $expense_balance;
		
		return $uptoendbalance - $uptobeginbalance;
	}
	
	function _getBalanceUpToDateByClass($classname, $date)
	{
		$this->db->where("name", $classname);
		$this->db->where("date <=", $date);
		$this->db->from("classbalance");
		$this->db->select_sum("balance");
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
		{
			if (is_numeric($q->row()->balance))
				return $q->row()->balance;
			else
				return 0;
		}
		
		return 0;
	}
	
	function _getBalanceUpToDate($coa_id, $date)
	{
		$this->db->where("coa_id", $coa_id);
		$this->db->where("date <=", $date);
		$this->db->from("coabalance");
		$this->db->select_sum("balance");
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
		{
			if (is_numeric($q->row()->balance))
				return $q->row()->balance;
			else
				return 0;
		}
		
		return 0;
	}
	
	function _getCoaTypeBalanceUpToDate($coatype_id, $date)
	{
		$this->db->where("coatype_id", $coatype_id);
		$this->db->where("date <=", $date);
		$this->db->from("coatypebalance");
		$this->db->select_sum("balance");
		$q = $this->db->get();
		
		if ($q->num_rows() > 0)
		{
			if (is_numeric($q->row()->balance))
				return $q->row()->balance;
			else
				return 0;
		}
		
		return 0;
	}
	
	// misc functions
	
	function _is_coa_credit_first($coa_id)
	{
		$this->db->from("coa");
		$this->db->join("coatype", "coa.coatype_id = coatype.id");
		$this->db->where("coa.id", $coa_id);
		$this->db->select("coatype.classtype as coa_type, coa.id as coa_id");
		
		$q = $this->db->get();
		
		$coa_type = $q->row()->coa_type;
		
		if (strpos($coa_type, "Asset") !== false and strpos($coa_type, "Asset") == 0 or
			strpos($coa_type, "Expense") !== false and strpos($coa_type, "Expense") == 0)
			return false;
		return true;
	}
	
	function _GetTotal($coa_id, $fromdate, $todate, $var)
	{
		$this->db->where("date <=", $todate);
		$this->db->where("date >=", $fromdate);
		$this->db->where("coa_id",$coa_id);
		$this->db->from("journal");
		$this->db->select_sum($var);
		$q = $this->db->get();
		
		if (is_numeric($q->row()->{$var}))
			return $q->row()->{$var};
		return 0;
	}
	
	function _getCOAOfClass($intclass)
	{
	
		$this->db->from("coa");
		$this->db->join("coatype", "coa.coatype_id = coatype.id");
		$this->db->select("coa.*");
		$this->db->where("coatype.name", $intclass);
		$q = $this->db->get();
	
		if ($q->num_rows() > 0)
		{
		
			return $q->result();
		}
		
		return array();
	}
	
	function _getCOAOfType($intcoatype)
	{
		$this->db->from("coa");
		$this->db->join("coatype", "coa.coatype_id = coatype.id");
		$this->db->select("coa.*");
		$this->db->where("coatype.name", $intcoatype);
		$q = $this->db->get();
	
		if ($q->num_rows() > 0)
			return $q->result_array();
		
		return array();
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
		//$data['currentdate'] = $today['mday']."-".$today['mon']."-".$today['year'];
		
		$ar_opt = array();
		$ar_opt[0] = "All";
		//get all customers
		$cust = $this->db->get('customer');
		if ($cust->num_rows() > 0)
			foreach ($cust->result() as $row) 
			{ 
				$ar_opt[$row->id] = $row->idstring; 
			}	
		$data['ar_opt'] = $ar_opt;
	
		$this->load->view('ar_statement_filter_view.php', $data);
	
	}
	
	function submit()
	{
		//$date_from = date('Y-m-d');//$params['date_from'];
		//$date_to = date('Y-m-d');//$params['date_to'];
		
		//$date_from = $_POST['arstatement__datefrom'];
		//$date_to = $_POST['arstatement__dateto'];
		$customer_id = $_POST['ar__customer_id'];
		
		
		//get invoices for each customer
		if($customer_id == 0) {
			$top1w = array();
			$top2w = array();
			$top1m = array();
			$top2m = array();
			
			//get all currencies
			$q = $this->db->get('currency');
			$currencies = $q->result_array();
			$data['currencies'] = $currencies;
		
			$c = $this->db->get('customer');
			$allcust= $c->result_array();
			$data['customers'] = $allcust;
			//for each customer, get each overdue AR
			foreach($allcust as $cust) {
				foreach($currencies as $curr) {
					//get invoice with top = 7 days
					$top1w[$cust['idstring']][$curr['name']] = array();
				
					$this->db->from('salesinvoice');
					//$this->db->where('customer_id', $cust['id']);
					//$this->db->where('top','1 Week');
					//$this->db->where('currency_id', $curr['id']);
					$this->db->select('sum(total) as total');
					$q1 = $this->db->get();
					$sum = $q1->row_array();
					
					if($q1->num_rows() <= 0 ) {
						$top1w[$cust['idstring']][$curr['name']] = 0;
					}
					else {
						$sum = $q1->row_array();
						$top1w[$cust['idstring']][$curr['name']] = $sum['total'];
					}
					
					//get invoice with top = 2 weeks
					$top2w[$cust['idstring']][$curr['name']] = array();
					
					$this->db->from('salesinvoice');
					$this->db->where('customer_id', $cust['id']);
					$this->db->where('top','2 Weeks');
					$this->db->where('currency_id', $curr['id']);
					$this->db->select('sum(total) as total');
					$q2 = $this->db->get();
					
					
					if($q2->num_rows() == 0 ) {
					
						$top2w[$cust['idstring']][$curr['name']] = 0;
					}
					else {
						$sum = $q2->row_array();
						$top2w[$cust['idstring']][$curr['name']] = $sum['total'];
					}
							
					//get invoice with top = 1 month
					$top1m[$cust['idstring']][$curr['name']] = array();
					
					$this->db->from('salesinvoice');
					$this->db->where('customer_id', $cust['id']);
					$this->db->where('top','30 Days');
					$this->db->where('currency_id', $curr['id']);
					$this->db->select('sum(total) as total');
					$q3 = $this->db->get();
					
					if($q3->num_rows() <= 0 ) {
						$top1m[$cust['idstring']][$curr['name']] = 0;
					}
					else {
						$sum = $q3->row_array();
						$top1m[$cust['idstring']][$curr['name']] = $sum['total'];
					}
					
					//get invoice with top = 2 month
					$top2m[$cust['idstring']][$curr['name']] = array();
					
					$this->db->from('salesinvoice');
					$this->db->where('customer_id', $cust['id']);
					$this->db->where('top','60 Days');
					$this->db->where('currency_id', $curr['id']);
					$this->db->select('sum(total) as total');
					$q4 = $this->db->get();
					
					if($q4->num_rows() <= 0 ) {
						$top2m[$cust['idstring']][$curr['name']] = 0;
						
					}
					else {
						$sum = $q4->row_array();
						$top2m[$cust['idstring']][$curr['name']] = $sum['total'];
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
			
			$this->db->from('customer');
			$this->db->where('id', $customer_id);
			$q5=$this->db->get();
			$cust = $q5->row_array();
			$data['customers'] = Array(array('idstring' => $cust['idstring']));
			
			foreach($currencies as $curr) {
				//get invoice with top = 7 days
				$top1w[$cust['idstring']][$curr['name']] = array();
				
				$this->db->from('salesinvoice');
				$this->db->where('customer_id', $customer_id);
				$this->db->where('top','1 Week');
				$this->db->where('currency_id', $curr['id']);
				$this->db->select('sum(total) as total');
				$q1 = $this->db->get();
				$sum = $q1->row_array();
				
				if($q1->num_rows() <= 0 ) {
					$top1w[$cust['idstring']][$curr['name']] = 0;
				}
				else {
					$sum = $q1->row_array();
					$top1w[$cust['idstring']][$curr['name']] = $sum['total'];
				}
				
				//get invoice with top = 2 weeks
				$top2w[$cust['idstring']][$curr['name']] = array();
				
				$this->db->from('salesinvoice');
				$this->db->where('customer_id', $customer_id);
				$this->db->where('top','2 Weeks');
				$this->db->where('currency_id', $curr['id']);
				$this->db->select('sum(total) as total');
				$q2 = $this->db->get();
				
				
				if($q2->num_rows() == 0 ) {
				
					$top2w[$cust['idstring']][$curr['name']] = 0;
				}
				else {
					$sum = $q2->row_array();
					$top2w[$cust['idstring']][$curr['name']] = $sum['total'];
				}
						
				//get invoice with top = 1 month
				$top1m[$cust['idstring']][$curr['name']] = array();
				
				$this->db->from('salesinvoice');
				$this->db->where('customer_id', $customer_id);
				$this->db->where('top','30 Days');
				$this->db->where('currency_id', $curr['id']);
				$this->db->select('sum(total) as total');
				$q3 = $this->db->get();
				
				if($q3->num_rows() <= 0 ) {
					$top1m[$cust['idstring']][$curr['name']] = 0;
				}
				else {
					$sum = $q3->row_array();
					$top1m[$cust['idstring']][$curr['name']] = $sum['total'];
				}
				
				//get invoice with top = 2 month
				$top2m[$cust['idstring']][$curr['name']] = array();
				
				$this->db->from('salesinvoice');
				$this->db->where('customer_id', $customer_id);
				$this->db->where('top','60 Days');
				$this->db->where('currency_id', $curr['id']);
				$this->db->select('sum(total) as total');
				$q4 = $this->db->get();
				
				if($q4->num_rows() <= 0 ) {
					$top2m[$cust['idstring']][$curr['name']] = 0;
				}
				else {
					$sum = $q4->row_array();
					$top2m[$cust['idstring']][$curr['name']] = $sum['total'];
				}	
				
			}
			
			
				
			
		}
		
		
		$data['top1w'] = $top1w;
		$data['top2w'] = $top2w;
		$data['top1m'] = $top1m;
		$data['top2m'] = $top2m;
		
		
		//get invoices 
		// load view
		$this->load->view('ar_statement_view', $data);
		
	}
}

?>