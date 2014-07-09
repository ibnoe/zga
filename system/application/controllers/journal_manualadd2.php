<?php

class journal_manualadd2 extends Controller {

	function journal_manualadd2()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['journalmanual__reference'] = '';
$data['journalmanual__date'] = '';
$data['journalmanual__notes'] = '';
$data['journalmanual__lastupdate'] = '';
$data['journalmanual__updatedby'] = '';
$data['journalmanual__created'] = '';
$data['journalmanual__createdby'] = '';

$q = $this->db->get("coa");

$coa_arr = array();
foreach ($q->result() as $row)
{
	//$coa_arr[$q->id] = $coa_arr[
}
		

		$this->load->view('journal_manual_add2_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		//print_r($_POST);
		
		
if (isset($_POST['journalmanual__reference']) && ($_POST['journalmanual__reference'] == "" || $_POST['journalmanual__reference'] == null))
$error .= "<span class='error'>Reference must not be empty"."</span><br>";

if (isset($_POST['journalmanual__reference'])) {
$this->db->where('reference', $_POST['journalmanual__reference']);
$q = $this->db->get('journalmanual');
if ($q->num_rows() > 0) $error .= "<span class='error'>Reference must be unique"."</span><br>";}

if (isset($_POST['journalmanual__date']) && ($_POST['journalmanual__date'] == "" || $_POST['journalmanual__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['journalmanual__reference']))
$data['reference'] = $_POST['journalmanual__reference'];if (isset($_POST['journalmanual__date']))
$this->db->set('date', "str_to_date('".$_POST['journalmanual__date']."', '%d-%m-%Y')", false);if (isset($_POST['journalmanual__notes']))
$data['notes'] = $_POST['journalmanual__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('journalmanual', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$journalmanual_id = $this->db->insert_id();
$this->load->library('generallib');
//$error .= $this->generallib->commonfunction('journal_manualadd','journalmanual','aftersave', $journalmanual_id);
			
			if (!isset($_POST['journal__coa_id']) || count($_POST['journal__coa_id']) < 2)
				$error .= "<span class='error'>Must have at least a pair of journal entry</span><br>";
			
			if ($error == "")
			{
				$debit_arr = $_POST['journal__debit'];
				$credit_arr = $_POST['journal__credit'];
				$coa_arr = $_POST['journal__coa_id'];;
				
				$totaldebit = 0;
				foreach ($debit_arr as $k=>$v)
				{
					$totaldebit += $v;
				}
				
				$totalcredit = 0;
				foreach ($credit_arr as $k=>$v)
				{
					$totalcredit += $v;
				}
			
				if ($totalcredit != $totaldebit)
				{
					$error .= "<span class='error'>Total debit and credit must be the same.</span><br>";
				}
			
				foreach ($coa_arr as $k=>$v)
				{
					//echo $k." => ".$v;
					$line = array();
					$line['coa_id'] = $v;
					$line['debit'] = $debit_arr[$k];
					$line['credit'] = $credit_arr[$k];
					$line['reference'] = $data['reference'];
					$this->db->set('date', "str_to_date('".$_POST['journalmanual__date']."', '%d-%m-%Y')", false);
					$line['notes'] = $data['notes'];
					$line['intnotes'] = '';
					$line['tablename'] = '';
					$line['tableid'] = 0;
					$line['journalmanual_id'] = $journalmanual_id;
					$line['lastupdate'] = date('Y-m-d H:i:s');
					$line['updatedby'] = $this->session->userdata('user');
					$line['created'] = date('Y-m-d H:i:s');
					$line['createdby'] = $this->session->userdata('user');
					$this->db->insert('journal', $line);
				}
			}
			
			if ($error != "")
			{
				$this->db->where('id', $journalmanual_id);
				$this->db->delete('journalmanual');
			}
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
			}
			else
			{
				echo "<span style='background-color:red'>   </span> ".$error;
			}
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>