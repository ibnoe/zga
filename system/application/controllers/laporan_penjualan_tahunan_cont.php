<?php

class laporan_penjualan_tahunan_cont extends Controller {

	function laporan_penjualan_tahunan_cont()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index() 
	{
		$data = array();
		
		$today = getdate();
		$data['currentdate'] = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
		$currentyr = $today['year'];
		$oldestyr = '2012';
		
		
		$year_opt = array();
		for($i = $oldestyr; $i <= $currentyr; $i++) {
			$year_opt[$i] = $i;
		}
		
		$data['year_opt'] = $year_opt;	
		$this->load->view('laporan_penjualan_tahunanfilter_view', $data);
	}
	
	function submit()
	{		
        $data['year'] = $_POST['year'];
		// load view
		$this->load->view('laporan_penjualan_tahunan_view', $data);
	}
}

?>
