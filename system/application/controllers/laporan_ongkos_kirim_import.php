<?php

class laporan_ongkos_kirim_import extends Controller {

	function laporan_ongkos_kirim_import()
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
		
		$this->load->view('laporan_ongkos_kirim_import_filterview', $data);
	}
	
	function submit()
	{
        $date_from = $_POST['date_from'];
		$date_to = $_POST['date_to'];
		
		$data['beginningdate'] = $date_from;
		$data['endingdate'] = $date_to;
		
		// load view
		$this->load->view('laporan_ongkos_kirim_import_view', $data);
	}
}

?>
