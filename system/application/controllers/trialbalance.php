<?php

class Trialbalance extends Controller {

	function Trialbalance()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function _getAccountClassBalanceUpToDate($classname, $date)
	{
		$this->db->where("name", $classname);
		//$this->db->where("date <=", $date);
		$this->db->where('date <=', "str_to_date('".$date."', '%d-%m-%Y')", false);
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
		
		//$endperioddate = "2011-12-31";
		$endperioddate = "31-12-2011";
		
		$tmp = explode("-", $endperioddate);
		$endperiodyear = $tmp[2];
		$endperiodmonth = $tmp[1];
		$endperiodday = $tmp[0];
		
		if (($endperiodmonth <= $endmonth) && ($endperiodday < $endday))
		{
			$timestamp = mktime(0, 0, 0, $endperiodmonth, $endperiodday+1, $endyear);
			$begindate = date('d-m-Y', $timestamp);
		}
		else
		{
			$timestamp = mktime(0, 0, 0, $endperiodmonth, $endperiodday+1, $endyear-1);
			$begindate = date('d-m-Y', $timestamp);
		}
		
		/*echo "Begin: ".$begindate;
		echo "<br>";
		echo "End: ".$enddate;
		echo "<br>";*/
	
		$revenue_balance = $this->_getAccountClassBalanceUpToDate("Pendapatan", $begindate);
		$expense_balance = $this->_getAccountClassBalanceUpToDate("Beban", $begindate);
		
		$uptobeginbalance = $revenue_balance - $expense_balance;
		
		$revenue_balance = $this->_getAccountClassBalanceUpToDate("Pendapatan", $enddate);
		$expense_balance = $this->_getAccountClassBalanceUpToDate("Beban", $enddate);
		
		$uptoendbalance = $revenue_balance - $expense_balance;
		
		return $uptoendbalance - $uptobeginbalance;
	}
	
	function _getBalanceUpToDate($coa_id, $date)
	{
		$this->db->where("coa_id", $coa_id);
		//$this->db->where("date <=", $date);
		$this->db->where('date <=', "str_to_date('".$date."', '%d-%m-%Y')", false);
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
		//$this->db->where("date <=", $date);
		$this->db->where('date <=', "str_to_date('".$date."', '%d-%m-%Y')", false);
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
		
		if (strpos($coa_type, "Aktiva") !== false and strpos($coa_type, "Aktiva") == 0 or
			strpos($coa_type, "Beban") !== false and strpos($coa_type, "Beban") == 0)
			return false;
		return true;
	}
	
	function index()
	{
		$data = array();
		
		$today = getdate();
		//$data['currentdate'] = $today['year']."-".$today['mon']."-".$today['mday'];
		$data['currentdate'] = $today['mday']."-".$today['mon']."-".$today['year'];
		$data['compare_opt'] = array('monthly' => "Monthly", 'yearly' => "Yearly");
		
		$this->load->view('trialbalance_filter_view.php', $data);
	}
	
	function _GetTotal($coa_id, $fromdate, $todate, $var)
	{
		//$this->db->where("date <=", $todate);
		//$this->db->where("date >=", $fromdate);
		$this->db->where('date <=', "str_to_date('".$todate."', '%d-%m-%Y')", false);
		$this->db->where('date >=', "str_to_date('".$fromdate."', '%d-%m-%Y')", false);
		$this->db->where("coa_id",$coa_id);
		$this->db->from("journal");
		$this->db->select_sum($var);
		$q = $this->db->get();
		
		if (is_numeric($q->row()->{$var}))
			return $q->row()->{$var};
		return 0;
	}
	
	function submit()
	{
		$compare = $_POST['trialbalance__comparative'];
		
		$timestamp = mktime(0, 0, 0,1, 1, 2000);
        //$date_from = date('Y-m-d', $timestamp);
		$date_from = date('d-m-Y', $timestamp);
		$date_to = $_POST['trialbalance__date'];
		if($compare == "monthly") {
			$tempdate = $date_to;
			$newdate = strtotime ( '-1 month' , strtotime ( $tempdate ) ) ;
			$newdate = date ( 'd-m-Y' , $newdate );
			$datecompare_to = $newdate;
		}
		else {
			$tempdate = $date_to;
			$newdate = strtotime ( '-1 year' , strtotime ( $tempdate ) ) ;
			$newdate = date ( 'd-m-Y' , $newdate );
			$datecompare_to = $newdate;
		}
		
		
		$q = $this->db->get("coa");
		
		$data['entries'] = array();
		
		/*echo $date_from;
		echo "<br>";
		echo $date_to;
		echo "<br>";*/
		/*echo "endmonth: ".$endmonth;
		echo "endyear: ".$endyear;
		echo "<br>";*/
		
		foreach ($q->result() as $k=>$row)
		{
			$data['entries'][$k]['account'] = $row->name;
			
			//echo $row->name . " " . $bb . " " . $eb;
			//echo "<br>";

			$bb = $this->_getBalanceUpToDate($row->id, $date_from);//$beginmonth, $beginyear);
			$eb = $this->_getBalanceUpToDate($row->id, $date_to);//$endmonth, $endyear);
			
			//get balance at the comparative date
			$cbalance = $this->_getBalanceUpToDate($row->id, $datecompare_to);//$endmonth, $endyear);
			
			$credit_first = $this->_is_coa_credit_first($row->id);
			
			$data['entries'][$k]['total_credit'] = $this->_GetTotal($row->id, $date_from, $date_to, "credit");
			$data['entries'][$k]['total_debit'] = $this->_GetTotal($row->id, $date_from, $date_to, "debit");
			$data['entries'][$k]['open_balance'] = $bb;
			$data['entries'][$k]['current_balance'] = $eb - $bb;
			$data['entries'][$k]['ending_balance'] = $eb;
			$data['entries'][$k]['ending_comparative_balance'] = $cbalance; //showing the ending balance at the comparative date
			
			if ($credit_first)
			{
				$data['entries'][$k]['open_balance'] *= -1;
				$data['entries'][$k]['current_balance'] *= -1;
				$data['entries'][$k]['ending_balance'] *= -1;
				$data['entries'][$k]['ending_comparative_balance'] *= -1;
			}
		}
		
		foreach ($data as $k=>$row)
		{
			/*echo $k." => ";
			print_r($row);
			echo "<br>";*/
		}
		
		$data['endingdate'] = $date_to;
		
		$temp = explode('-',$datecompare_to);
		$month = $temp[1];
		$month_arr = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		
		$data['comparativedate'] = $month_arr[$month-1] . " " .$temp[0];
		$this->load->view('trialbalance_report_view', $data);
	}
}

?>