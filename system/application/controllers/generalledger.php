<?php

class Generalledger extends Controller {

	function Generalledger()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index() 
	{
		$data = array();
		
		$today = getdate();
		//$data['currentdate'] = $today['year']."-".$today['mon']."-".$today['mday'];
		$data['currentdate'] = $today['mday']."-".$today['mon']."-".$today['year'];
		
		$this->db->from("coa");
		$this->db->select("id");
		$this->db->select("name");
		$q=$this->db->get();
		$data['coa_array'] = array();
		$data['coa_array'][0] = "All";
		foreach($q->result_array() as $row)
		{
			$data['coa_array'][$row['id']] = $row['name'];
		}
		
		
		$this->load->view('generalledger_filter_view.php', $data);
	
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
	
	function submit()
	{
		$data = array();
		//$date_from = date("Y-m-d");
		//$date_to = date("Y-m-d");
		$date_from = $_POST['generalledger__datefrom'];
		$date_to = $_POST['generalledger__dateto'];
		$coa = $_POST['generalledger__coa']; 
		
		$date = $date_from;
        $arr = explode("-", $date);
        $year = $arr[2];
        $month = $arr[1];
        $day = $arr[0];
        
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        $date_initial = date('d-m-Y', $timestamp);
		
		
		$data['results'] = array();
		$data['coa_names'] = array();
		$counter = 0;
		
		$data['classtype'] = '';
		
		if($coa != 0)
		{	
			$data['initialbalance'] = 0;
			
			$this->db->from("journal");
			$this->db->join("coa","journal.coa_id = coa.id"); 
			$this->db->join("coatype", "coa.coatype_id = coatype.id");
			$this->db->select('DATE_FORMAT(journal.date, "%d-%m-%Y") as date',false);
			$this->db->select("journal.reference as reference");
			$this->db->select("journal.debit as debit");
			$this->db->select("journal.credit as credit");
			$this->db->select("journal.coa_id as coa_id");
			$this->db->select("coatype.classtype as classtype");
			$this->db->select("coa.name as coa_name");
			$this->db->where('journal.coa_id', $coa);
			//$this->db->where('journal.date >=', $date_from);
			//$this->db->where('journal.date <=', $date_to);
			$this->db->where('journal.date >=', "str_to_date('".$date_from."', '%d-%m-%Y')", false);
			$this->db->where('journal.date <=', "str_to_date('".$date_to."', '%d-%m-%Y')", false);
			$q = $this->db->get();
			$data['results'] = $q->result_array();
			
			//get beginning balance for this particular coa
			$data['initialbalance'] = $this->_getBalanceUpToDate($coa, $date_initial);
			
			
		}
		else { //group journal transaction per coa
		
			$data['initialbalance'] = array();
			
			$this->db->from('coa');
			$this->db->join('coatype','coa.coatype_id = coatype.id');
			$this->db->select('coa.id as id');
			$this->db->select('coa.name as name');
			$this->db->select('coatype.classtype as classtype');
			$query = $this->db->get();
			foreach($query->result() as $percoa)
			{	
				$this->db->from('journal');
				$this->db->join('coa','journal.coa_id = coa.id', 'left'); 
				$this->db->join('coatype', 'coa.coatype_id = coatype.id', 'left');
				$this->db->select('DATE_FORMAT(journal.date, "%d-%m-%Y") as date',false);
				$this->db->select('journal.reference as reference');
				$this->db->select('journal.debit as debit');
				$this->db->select('journal.credit as credit');
				$this->db->select('journal.coa_id as coa_id');
				$this->db->select('coatype.classtype as classtype');
				$this->db->select('coa.name as coa_name');
				$this->db->where('journal.coa_id', $percoa->id);
				//$this->db->where('journal.date >=', $date_from);
				//$this->db->where('journal.date <=', $date_to);
				$this->db->where('journal.date >=', "str_to_date('".$date_from."', '%d-%m-%Y')", false);
				$this->db->where('journal.date <=', "str_to_date('".$date_to."', '%d-%m-%Y')", false);
				$s = $this->db->get();
			
				$data['coa_names'][$counter] = $percoa->name;
				$data['classtype'][$counter] = $percoa->classtype;
				$data['results'][$counter] = $s->result_array();
				//get initial balance for this coa
				$data['initialbalance'][$counter] = 
						$this->_getBalanceUpToDate($percoa->id, $date_initial);
				
				$counter ++;
				
			}
		}
		
		$data['counter'] = $counter;
	
		/*foreach ($data as $k=>$row)
		{
			echo $k." => ";
			print_r($row);
			echo "<br>";
		}*/
		
		if($coa != 0)
		{
			$this->db->from('coa');
			$this->db->join('coatype','coatype.id = coa.coatype_id');
			$this->db->where('coa.id',$coa);
			$this->db->select('coa.name as name');
			$this->db->select('coatype.classtype as classtype');
			$r = $this->db->get();
			foreach ($r->result() as $row)
			{
				$data['coa_name'] = $row->name;
				$data['classtype'] = $row->classtype;
			}
		}
		else {
			$data['coa_name'] = "ALL";
		}
		
		$data['date_from'] = $date_from;
		$data['date_to'] = $date_to;
		$data['coa'] = $coa;
		//print_r($data);
		$this->load->view('general_ledger_view', $data);
	}
}

?>