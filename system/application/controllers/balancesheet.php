<?php

class Balancesheet extends Controller {

	function Balancesheet()
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
	
	function index() 
	{
		$data = array();
		
		$today = getdate();
		//$data['currentdate'] = $today['year']."-".$today['mon']."-".$today['mday'];
		$data['currentdate'] = $today['mday']."-".$today['mon']."-".$today['year'];
		$data['compare_opt'] = array('monthly' => "Monthly", 'yearly' => "Yearly");
		
		$this->load->view('balancesheet_filter_view.php', $data);
	
	}
	
	function submit()
	{
		$data = array();
		
		//$date_to = date("Y-m-d");
		$date_to = $_POST['balancesheet__date'];
		$compare = $_POST['balancesheet__comparative'];
		
		//get the date to compare the balance with
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
		
		// get all coa types
		
		//$this->db->from("coa");
		//$this->db->join("coatype", "coa.coatype_id = coatype.id");
		//$this->db->select("coa.id as coa_id, coatype.name as name, coatype.classtype as coa_type");
		$this->db->from("coatype");
		$this->db->select("coatype.id as coatype_id, coatype.name as name, coatype.classtype as coa_type");
		$q = $this->db->get();
		
		$coa = $q->result();
		
		//print_r($coa);
		//echo "<br>";
		
		$totalasset = 0;
		$totalliability = 0;
		$totalequity = 0;
		
		//for last period
		$lasttotalasset = 0;
		$lasttotalliability = 0;
		$lasttotalequity = 0;
		
		$asset_coa = array();
		
		$current_asset_coa_types = array(
			'Kas',
			'Bank',
			'Piutang Usaha',
			'Piutang Lain-Lain',
			'Persediaan Barang',
			'Uang Muka Pembelian',
			'Pajak Dibayar di Muka',
			'Biaya Dibayar di Muka',
			'Aktiva Pajak Tangguhan',
			);
		
		$non_current_asset_coa_types = array(
			'Deposito Berjangka',
			'Investasi Jangka Panjang',
			'Tanah',
			'Bangunan',
			'Kendaraan Bermotor (D)',
			'Kendaraan Bermotor (ND)',
			'Inventaris Kantor',
			'Mesin dan Peralatan',
			'Instalasi Listrik',
			'Akumulasi Penyusutan',
			'Aktiva Lain-Lain',
			'Aktiva Tetap',
		);
			
		$current_asset_coa = array();
		$non_current_asset_coa = array();
		
		// all of type asset
		foreach ($coa as $k=>$row)
		{
			//print_r($row);
			//echo "<br>";
			if ($row->coa_type == "Aktiva")
			{
				//$balance = $this->_getBalanceUpToDate($row->coa_id, $date_to);//$endmonth, $endyear);
				$balance = $this->_getCoaTypeBalanceUpToDate($row->coatype_id, $date_to);//$endmonth, $endyear);
				$lastbalance = $this->_getCoaTypeBalanceUpToDate($row->coatype_id, $datecompare_to);
				$totalasset += $balance;
				$lasttotalasset += $lastbalance;
	//echo $row->coatype_id . "<br>";
	//echo $balance . "<br>";			
	//echo $row->name;
	//echo "<br>";
	
				if (in_array($row->name, $current_asset_coa_types))
					$current_asset_coa[$k] = array( "name" => $row->name, "balance" => $balance , "lastbalance" => $lastbalance );
				else if (in_array($row->name, $non_current_asset_coa_types))
					$non_current_asset_coa[$k] = array( "name" => $row->name, "balance" => $balance , "lastbalance" => $lastbalance );
			}
		}
		
		$liability_coa = array();
		$current_liability_coa = array();
		$non_current_liability_coa = array();
		
		$current_liability_coa_types = array(
		'Hutang Bank',
		'Hutang Usaha',
		'Hutang Lain-Lain',
		'Uang Muka Penjualan',
		'Hutang Pajak',
		'Biaya YMH Dibayar',
		);
		
		$non_current_liability_coa_types = array(
		'Hutang Bank Jk. Panjang',
		'Hutang Jk. Panjang Lainnya',
		);
		
		// all of type liability
		foreach ($coa as $k=>$row)
		{
			if ($row->coa_type == "Pasiva")
			{
				//$balance = $this->_getBalanceUpToDate($row->coa_id, $date_to);//$endmonth, $endyear);
				$balance = $this->_getCoaTypeBalanceUpToDate($row->coatype_id, $date_to);//$endmonth, $endyear);
				$lastbalance = $this->_getCoaTypeBalanceUpToDate($row->coatype_id, $datecompare_to);
				$totalliability += $balance;
				$lasttotalliability += $lastbalance;
				//echo $row->name;
				//echo "<br>";
				//$liability_coa[$k] = array( "name" => $row->name, "balance" => $balance , "lastbalance" => $lastbalance  );
				if (in_array($row->name, $current_liability_coa_types))
					$current_liability_coa[$k] = array( "name" => $row->name, "balance" => $balance , "lastbalance" => $lastbalance );
				else if (in_array($row->name, $non_current_liability_coa_types))
					$non_current_liability_coa[$k] = array( "name" => $row->name, "balance" => $balance , "lastbalance" => $lastbalance );
			}
		}
		
		$equity_coa = array();
		
		// all of type equity
		foreach ($coa as $k=>$row)
		{
			if ($row->coa_type == "Modal")
			{
				//$balance = $this->_getBalanceUpToDate($row->coa_id, $date_to);//$endmonth, $endyear);
				$balance = $this->_getCoaTypeBalanceUpToDate($row->coatype_id, $date_to);//$endmonth, $endyear);
				$lastbalance = $this->_getCoaTypeBalanceUpToDate($row->coatype_id, $datecompare_to);
				$totalequity += $balance;
				$lasttotalequity += $lastbalance;
				
				$equity_coa[$k] = array( "name" => $row->name, "balance" => $balance , "lastbalance" => $lastbalance  );
			}
		}
		
		// create another entry which is coa current profit (coa class revenue - coa class expense)
		
		$current_profit = $this->_getCurrentProfitUpToDate($date_to);
		$last_profit = $this->_getCurrentProfitUpToDate($datecompare_to);
		$totalequity += $current_profit;
		$lasttotalequity += $last_profit;
		
		//$data['asset_coa'] = $asset_coa;
		$data['current_asset_coa'] = $current_asset_coa;
		$data['non_current_asset_coa'] = $non_current_asset_coa;
		//$data['liability_coa'] = $liability_coa;
		$data['current_liability_coa'] = $current_liability_coa;
		$data['non_current_liability_coa'] = $non_current_liability_coa;
		$data['equity_coa'] = $equity_coa;
		$data['totalasset'] = $totalasset;
		$data['totalliability'] = $totalliability;
		$data['totalequity'] = $totalequity;
		$data['current_profit'] = $current_profit;
		
		//for the previous period
		$data['lasttotalasset'] = $lasttotalasset;
		$data['lasttotalliability'] = $lasttotalliability;
		$data['lasttotalequity'] = $lasttotalequity;
		$data['last_profit'] = $last_profit;
		
		
		
		
		$temp1 = explode('-',$date_to);
		$month1 = $temp1[1];
		$temp = explode('-',$datecompare_to);
		$month = $temp[1];
		$month_arr = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		
		$data['comparativedate'] = $month_arr[$month-1] . " " .$temp[0];
		$data['endingdatewords'] = $month_arr[$month1-1] . " " .$temp1[0];
		$data['endingdate'] = $temp1[2] . " " . $month_arr[$month1-1] . " " .$temp1[0];
		/*foreach ($data as $k=>$row)
		{
			echo $k." => ";
			print_r($row);
			echo "<br>";
		}*/
		
		
		//print_r($data);
		$this->load->view('balancesheet_view', $data);
	}
}

?>