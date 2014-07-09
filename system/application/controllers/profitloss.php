<?php

class Profitloss extends Controller {

	function Profitloss()
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
		$endyear = $tmp[2];
		$endmonth = $tmp[1];
		$endday = $tmp[0];
		
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
	
	function _getBalanceUpToDateByClass($classname, $date)
	{
		$this->db->where("name", $classname);
		//$this->db->where("date <=", $date);
		$this->db->where('date <=', "str_to_date('".$date."', '%d-%m-%Y')", false);
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
	
	function _getCOAOfClass($intclass)
	{
		$this->db->from("coa");
		$this->db->join("coatype", "coa.coatype_id = coatype.id");
		$this->db->select("coa.*");
		$this->db->where("coatype.classtype", $intclass);
		$q = $this->db->get();
	
		if ($q->num_rows() > 0)
			return $q->result_array();
		
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
		//$data['currentdate'] = $today['year']."-".$today['mon']."-".$today['mday'];
		$data['currentdate'] = $today['mday']."-".$today['mon']."-".$today['year'];
		
		$data['compare_opt'] = array('monthly' => "Monthly", 'yearly' => "Yearly");
		
		$this->load->view('profitloss_filter_view.php', $data);
	
	}
	
	function submit()
	{
		//$date_from = date('Y-m-d');//$params['date_from'];
		//$date_to = date('Y-m-d');//$params['date_to'];
		
		$date_from = $_POST['profitloss__datefrom'];
		$date_to = $_POST['profitloss__dateto'];
		
		$compare = $_POST['profitloss__comparative'];
		
		//get the date to compare the balance with
		if($compare == "monthly") {
			$tempdate1 = $date_from;
			$newdate1 = strtotime ( '-1 month' , strtotime ( $tempdate1 ) ) ;
			$newdate1 = date ( 'd-m-Y' , $newdate1 );
			$datecompare_from = $newdate1;
		
			$tempdate = $date_to;
			$newdate = strtotime ( '-1 month' , strtotime ( $tempdate ) ) ;
			$newdate = date ( 'd-m-Y' , $newdate );
			$datecompare_to = $newdate;
		}
		else {
			$tempdate2 = $date_from;
			$newdate2 = strtotime ( '-1 year' , strtotime ( $tempdate2 ) ) ;
			$newdate2 = date ( 'd-m-Y' , $newdate2 );
			$datecompare_from = $newdate2;
			
			$tempdate = $date_to;
			$newdate = strtotime ( '-1 year' , strtotime ( $tempdate ) ) ;
			$newdate = date ( 'd-m-Y' , $newdate );
			$datecompare_to = $newdate;
		}
		
		
		// get all revenue and expense coa
		
		$revenue_coa = $this->_getCOAOfClass("Pendapatan");
		$expense_coa = $this->_getCOAOfClass("Beban");
		
		// list sales revenue and cogs
		$sales_revenue_coa = $this->_getCOAOfType("Pendapatan Penjualan");
		$sales_return_revenue_coa = $this->_getCOAOfType("Retur Penjualan");
		$sales_discount_revenue_coa = $this->_getCOAOfType("Potongan Penjualan");
		$cogs_coa = $this->_getCOAOfType("Harga Pokok Penjualan");
		$tax_coa = $this->_getCOAOfType("Pajak Penghasilan");
		
		$total_sales_revenue = 0;
		$total_sales_return_revenue = 0;
		$total_sales_discount_revenue = 0;
		$total_cogs = 0;
		$total_tax_expense = 0;
		
		//for the previous period
		$last_total_sales_revenue = 0;
		$last_total_sales_return_revenue = 0;
		$last_total_sales_discount_revenue = 0;
		$last_total_cogs = 0;
		$last_total_tax_expense = 0;
		
		foreach ($sales_revenue_coa as $k=>$row)
		{
			$bb = $this->_getBalanceUpToDate($row['id'], $date_from);//$beginmonth, $beginyear);
			$eb = $this->_getBalanceUpToDate($row['id'], $date_to);//$endmonth, $endyear);
			
			$balance = $eb - $bb;
			
			$total_sales_revenue += $balance;
			
			$row['balance'] = $balance;
			
			//for the previous period
			$lastbb = $this->_getBalanceUpToDate($row['id'], $datecompare_from);//$beginmonth, $beginyear);
			$lasteb = $this->_getBalanceUpToDate($row['id'], $datecompare_to);//$endmonth, $endyear);
			
			$lastbalance = $lasteb - $lastbb;
			
			$last_total_sales_revenue += $lastbalance;
			
			$row['lastbalance'] = $lastbalance;
			
			$sales_revenue_coa[$k] = $row;
			
		}
		/*
		foreach ($sales_return_revenue_coa as $k=>$row)
		{
			$bb = $this->_getBalanceUpToDate($row['id'], $date_from);//$beginmonth, $beginyear);
			$eb = $this->_getBalanceUpToDate($row['id'], $date_to);//$endmonth, $endyear);
			
			$balance = $eb - $bb;
			
			$total_sales_return_revenue += $balance;
			
			$row['balance'] = $balance;
			
			//for the previous period
			$lastbb = $this->_getBalanceUpToDate($row['id'], $datecompare_from);//$beginmonth, $beginyear);
			$lasteb = $this->_getBalanceUpToDate($row['id'], $datecompare_to);//$endmonth, $endyear);
			
			$lastbalance = $lasteb - $lastbb;
			
			$last_total_sales_return_revenue += $lastbalance;
			
			$row['lastbalance'] = $lastbalance;
			
			$sales_return_revenue_coa[$k] = $row;
			
		}
		
		foreach ($sales_discount_revenue_coa as $k=>$row)
		{
			$bb = $this->_getBalanceUpToDate($row['id'], $date_from);//$beginmonth, $beginyear);
			$eb = $this->_getBalanceUpToDate($row['id'], $date_to);//$endmonth, $endyear);
			
			$balance = $eb - $bb;
			
			$total_sales_discount_revenue += $balance;
			
			$row['balance'] = $balance;
			
			//for the previous period
			$lastbb = $this->_getBalanceUpToDate($row['id'], $datecompare_from);//$beginmonth, $beginyear);
			$lasteb = $this->_getBalanceUpToDate($row['id'], $datecompare_to);//$endmonth, $endyear);
			
			$lastbalance = $lasteb - $lastbb;
			
			$last_total_sales_discount_revenue += $lastbalance;
			
			$row['lastbalance'] = $lastbalance;
			
			$sales_discount_revenue_coa[$k] = $row;
			
		}
		*/
		foreach ($cogs_coa as $k=>$row)
		{
			$bb = $this->_getBalanceUpToDate($row['id'], $date_from);//$beginmonth, $beginyear);
			$eb = $this->_getBalanceUpToDate($row['id'], $date_to);//$endmonth, $endyear);
			
			$balance = $eb - $bb;
			
			$total_cogs += $balance;
			
			$row['balance'] = $balance;
			
			//for the previous period
			$lastbb = $this->_getBalanceUpToDate($row['id'], $datecompare_from);//$beginmonth, $beginyear);
			$lasteb = $this->_getBalanceUpToDate($row['id'], $datecompare_to);//$endmonth, $endyear);
			
			$lastbalance = $lasteb - $lastbb;
			
			$last_total_cogs += $lastbalance;
			
			$row['lastbalance'] = $lastbalance;
			
			$cogs_coa[$k] = $row;
		}
		
		foreach ($tax_coa as $k=>$row)
		{
			$bb = $this->_getBalanceUpToDate($row['id'], $date_from);//$beginmonth, $beginyear);
			$eb = $this->_getBalanceUpToDate($row['id'], $date_to);//$endmonth, $endyear);
			
			$balance = $eb - $bb;
			
			$total_tax_expense += $balance;
			
			$row['balance'] = $balance;
			
			//for the previous period
			$lastbb = $this->_getBalanceUpToDate($row['id'], $datecompare_from);//$beginmonth, $beginyear);
			$lasteb = $this->_getBalanceUpToDate($row['id'], $datecompare_to);//$endmonth, $endyear);
			
			$lastbalance = $lasteb - $lastbb;
			
			$last_total_tax_expense += $lastbalance;
			
			$row['lastbalance'] = $lastbalance;
			
			$tax_coa[$k] = $row;
		}
		
		// show gross margin
		$gross_margin = $total_sales_revenue - $total_cogs;
		$last_gross_margin = $last_total_sales_revenue - $last_total_cogs;
		
		// list operational expense
		$operational_expense_coa = $this->_getCOAOfType("Biaya Overhead Pabrik");
		$operational_expense_coa = array_merge($operational_expense_coa, $this->_getCOAOfType("Beban Pemasaran"));
		$operational_expense_coa = array_merge($operational_expense_coa, $this->_getCOAOfType("Beban Tenaga Kerja"));
		$operational_expense_coa = array_merge($operational_expense_coa, $this->_getCOAOfType("Biaya Operasional Kantor"));
		$operational_expense_coa = array_merge($operational_expense_coa, $this->_getCOAOfType("Biaya Pemeliharaan-Perbaikan"));
		$operational_expense_coa = array_merge($operational_expense_coa, $this->_getCOAOfType("Biaya Sewa"));
		$operational_expense_coa = array_merge($operational_expense_coa, $this->_getCOAOfType("Biaya Utilisasi-Komunikasi"));
		$operational_expense_coa = array_merge($operational_expense_coa, $this->_getCOAOfType("Biaya Jasa Profesional"));
		$operational_expense_coa = array_merge($operational_expense_coa, $this->_getCOAOfType("Biaya Asuransi"));
		
		$total_operational_expense = 0;
		$last_total_operational_expense = 0;
		
		foreach ($operational_expense_coa as $k=>$row)
		{
			$bb = $this->_getBalanceUpToDate($row['id'], $date_from);//$beginmonth, $beginyear);
			$eb = $this->_getBalanceUpToDate($row['id'], $date_to);//$endmonth, $endyear);
			
			$balance = $eb - $bb;
			
			$total_operational_expense += $balance;
			
			$row['balance'] = $balance;
			
			//for the previous period
			$lastbb = $this->_getBalanceUpToDate($row['id'], $datecompare_from);//$beginmonth, $beginyear);
			$lasteb = $this->_getBalanceUpToDate($row['id'], $datecompare_to);//$endmonth, $endyear);
			
			$lastbalance = $lasteb - $lastbb;
			
			$last_total_operational_expense += $lastbalance;
			
			$row['lastbalance'] = $lastbalance;
			
			
			$operational_expense_coa[$k] = $row;
		}
		
		// show operational profit
		
		$operational_profit = $gross_margin - $total_operational_expense;
		$last_operational_profit = $last_gross_margin - $last_total_operational_expense;
		
		// list all of type revenue excep sales revenue and cogs
		
		$total_rest_of_revenue = 0;
		$last_total_rest_of_revenue = 0;
		
		foreach ($revenue_coa as $k=>$row)
		{
			if ($this->_id_in_array($row['id'], $sales_revenue_coa))
				continue;
				
			$filtered_revenue_coa[$k] = $row;
		}
		
		$revenue_coa = $filtered_revenue_coa;
		
		foreach ($revenue_coa as $k=>$row)
		{
			$bb = $this->_getBalanceUpToDate($row['id'], $date_from);//$beginmonth, $beginyear);
			$eb = $this->_getBalanceUpToDate($row['id'], $date_to);//$endmonth, $endyear);
			
			$balance = $eb - $bb;
			
			$total_rest_of_revenue += $balance;
			
			$row['balance'] = $balance;
			
			//for the previous period
			$lastbb = $this->_getBalanceUpToDate($row['id'], $datecompare_from);//$beginmonth, $beginyear);
			$lasteb = $this->_getBalanceUpToDate($row['id'], $datecompare_to);//$endmonth, $endyear);
			
			$lastbalance = $lasteb - $lastbb;
			
			$last_total_rest_of_revenue += $lastbalance;
			
			$row['lastbalance'] = $lastbalance;
			
			
			$revenue_coa[$k] = $row;
		}
		
		// list all of type expense excep operational expense
		
		$total_rest_of_expense = 0;
		$last_total_rest_of_expense = 0;
		
		foreach ($expense_coa as $k=>$row)
		{
			
			if ($this->_id_in_array($row['id'], $operational_expense_coa))
				continue;
				
			if ($this->_id_in_array($row['id'], $cogs_coa))
				continue;
				
			if ($this->_id_in_array($row['id'], $tax_coa))
				continue;
			//echo "expense coa: " . $k . " -> " . $row['id'] . "<br>";	
			$filtered_expense_coa[$k] = $row;
		}
		
		$expense_coa = $filtered_expense_coa;
		
		foreach ($expense_coa as $k=>$row)
		{
			$bb = $this->_getBalanceUpToDate($row['id'], $date_from);//$beginmonth, $beginyear);
			$eb = $this->_getBalanceUpToDate($row['id'], $date_to);//$endmonth, $endyear);
			
			$balance = $eb - $bb;
			
			$total_rest_of_expense += $balance;
			
			$row['balance'] = $balance;
			
			//for the previous period
			$lastbb = $this->_getBalanceUpToDate($row['id'], $datecompare_from);//$beginmonth, $beginyear);
			$lasteb = $this->_getBalanceUpToDate($row['id'], $datecompare_to);//$endmonth, $endyear);
			
			$lastbalance = $lasteb - $lastbb;
			
			$last_total_rest_of_expense += $lastbalance;
			
			$row['lastbalance'] = $lastbalance;
			
			$expense_coa[$k] = $row;
		}
		
		// show net profit
		
		$total_revenue_bb = $this->_getBalanceUpToDateByClass("Pendapatan", $date_from);
		$total_revenue_eb = $this->_getBalanceUpToDateByClass("Pendapatan", $date_to);
		$total_expense_bb = $this->_getBalanceUpToDateByClass("Beban", $date_from);
		$total_expense_eb = $this->_getBalanceUpToDateByClass("Beban", $date_to);
		
		//for the previous period
		$last_total_revenue_bb = $this->_getBalanceUpToDateByClass("Pendapatan", $datecompare_from);
		$last_total_revenue_eb = $this->_getBalanceUpToDateByClass("Pendapatan", $datecompare_to);
		$last_total_expense_bb = $this->_getBalanceUpToDateByClass("Beban", $datecompare_from);
		$last_total_expense_eb = $this->_getBalanceUpToDateByClass("Beban", $datecompare_to);
		
		/*echo "total_revenue_bb ".$total_revenue_bb;
		echo "<br>";
		echo "total_revenue_eb ".$total_revenue_eb;
		echo "<br>";
		echo "total_expense_bb ".$total_expense_bb;
		echo "<br>";
		echo "total_expense_eb ".$total_expense_eb;
		echo "<br>";*/
		
		$total_expense = $total_expense_eb - $total_expense_bb;
		$total_revenue = $total_revenue_eb - $total_revenue_bb;
		
		//for the previous period
		$last_total_expense = $last_total_expense_eb - $last_total_expense_bb;
		$last_total_revenue = $last_total_revenue_eb - $last_total_revenue_bb;
		
		$net_profit = $total_revenue - $total_expense;
		$last_net_profit = $last_total_revenue - $last_total_expense;
		
		$data['sales_revenue_coa'] = $sales_revenue_coa;
		$data['total_sales_revenue'] = $total_sales_revenue;
		$data['last_total_sales_revenue'] = $last_total_sales_revenue;
		$data['cogs_coa'] = $cogs_coa;
		$data['tax_coa'] = $tax_coa;
		
		$data['total_cogs'] = $total_cogs;
		$data['last_total_cogs'] = $last_total_cogs;
		
		$data['gross_margin'] = $gross_margin;
		$data['last_gross_margin'] = $last_gross_margin;
		
		$data['operational_expense_coa'] = $operational_expense_coa;
		
		$data['operational_profit'] = $operational_profit;
		$data['last_operational_profit'] = $last_operational_profit;
		
		$data['total_operational_expense'] = $total_operational_expense;
		$data['last_total_operational_expense'] = $last_total_operational_expense;
		
		$data['operational_expense_coa'] = $operational_expense_coa;
		
		$data['total_operational_expense'] = $total_operational_expense;
		$data['last_total_operational_expense'] = $last_total_operational_expense;
		
		$data['revenue_coa'] = $revenue_coa;
		
		$data['total_rest_of_revenue'] = $total_rest_of_revenue;
		$data['last_total_rest_of_revenue'] = $last_total_rest_of_revenue;
		
		$data['expense_coa'] = $expense_coa;
		
		$data['total_rest_of_expense'] = $total_rest_of_expense;
		$data['last_total_rest_of_expense'] = $last_total_rest_of_expense;
		
		$data['net_profit'] = $net_profit;
		$data['last_net_profit'] = $last_net_profit;
		
		/*foreach ($data as $k=>$row)
		{
			echo $k." => ";
			print_r($row);
			echo "<br>";
		}*/
		
		
		
		
		$temp1 = explode('-',$date_to);
		$month1 = $temp1[1];
		$temp2 = explode('-',$date_from);
		$month2 = $temp2[1];
		
		$temp3 = explode('-',$datecompare_to);
		$month3 = $temp3[1];
		$temp4 = explode('-',$datecompare_from);
		$month4 = $temp4[1];
		
		$month_arr = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		
		$data['comparativedate_to'] = $temp3[0] . " " . $month_arr[$month3-1] . " " .$temp3[2];
		$data['comparativedate_from'] = $temp4[0] . " " . $month_arr[$month4-1] . " " .$temp4[2];
		
		$data['endingdatewords'] = $month_arr[$month1-1] . " " .$temp1[0];
		$data['endingdate'] = $temp1[0] . " " . $month_arr[$month1-1] . " " .$temp1[2];
		$data['beginningdate'] = $temp2[0] . " " . $month_arr[$month2-1] . " " .$temp2[2];
		
		// load view
		$this->load->view('profitloss_report_view', $data);
		
	}
}

?>