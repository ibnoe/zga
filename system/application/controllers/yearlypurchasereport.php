<?php

class YearlyPurchaseReport extends Controller {

	function YearlyPurchaseReport()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function _getOldestData() {
		$this->db->order_by('date','desc');
		$this->db->limit(1);
		$this->db->select('DATE_FORMAT(date,"%d-%m-%Y") as date', false);
		$q = $this->db->get('purchaseorder');
		
		if ($q->num_rows() == 0)
		{
			return '01-01-2012';
		}
		
		$row = $q->row_array();
		
		return $row['date'];
	}
	
	function index() 
	{
		$data = array();
		
		$today = getdate();
		$data['currentdate'] = $today['year']."-".$today['mon']."-".$today['mday'];
		$currentyr = $today['year'];
		$oldest = explode("-", $this->_getOldestData());
		
		$oldestyr = $oldest[2];
		
		
		$year_opt = array();
		for($i = $oldestyr; $i <= $currentyr; $i++) {
			$year_opt[$i] = $i;
		}
		
		$data['year_opt'] = $year_opt;	
		$this->load->view('yearlypurchasereport_filter_view.php', $data);
	}
	
	function submit()
	{		
		$year = $_POST['yearlypurchasereport__year'];
		$data['year'] = $year;
		
		//for each month, retrieve pembelian lokal & import
		//LOKAL
		$import = array();
		$lokal = array();
		
		for($i=1;$i<13;$i++) {
		
			$interval = DateInterval::createFromDateString('1 month'); 
			
			//create beginning and ending year date
			//$beginningdate = new DateTime($year.'-'.$i.'-01');
			//$endingdate = $beginningdate;
			//$endingdate->add($interval);
			$beginningdate = $year.'-'.$i.'-01';
			$m = $i+1;
			
			if($i == 12) // bulan desember 
			{
				$yy = $year + 1;
				$endingdate = $yy.'-'.$m.'-01';
			}
			else {
				$endingdate = $year.'-'.$m.'-01';
			}
			
			
			//get lokal purchases
			$this->db->from('purchaseorder');
			$this->db->where('date <=',$endingdate);
			$this->db->where('date >=',$beginningdate);
			$this->db->where('buysource', "Lokal");
			$this->db->select('sum(total) as grandtotal');
			$this->db->select('currency_id');
			$this->db->select('supplier_id');
			$this->db->group_by('supplier_id');
			$q=$this->db->get();
			
			$localresults = $q->result_array();
		
			$lokal[$i-1] = $localresults;
			
			
			//get import purchases
			$this->db->from('purchaseorder');
			$this->db->where('date <=',$endingdate);
			$this->db->where('date >=',$beginningdate);
			$this->db->where('buysource', "Import");
			$this->db->select('sum(total) as grandtotal');
			$this->db->select('currency_id');
			$this->db->select('supplier_id');
			$this->db->group_by('supplier_id');
			$q=$this->db->get();
			
			$importresults = $q->result_array();
		
			$import[$i-1] = $importresults;
		}		
		
		$data['localresults'] = $lokal;
		$data['importresults'] = $import;
		
		$data['db'] = $this->db;
		
		// load view
		//$this->load->view('yearlypurchasereport_print_view2', $data);
		
		//$this->load->view('laporan_pembelian_tahunan_view.php', $data);
		$this->load->view('laporan_penjualan_quantity_per_item_tahunan_view.php', $data);
		//$this->load->view('laporan_penjualan_quantity_per_marketing_tahunan_view.php', $data);
		//$this->load->view('laporan_penjualan_tahunan_view.php', $data);
		
	}
}

?>