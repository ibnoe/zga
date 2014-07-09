<?php

class roll_process_updateview extends Controller {

	function roll_process_updateview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($roll_process_update_id=0)
	{
		if ($roll_process_update_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $roll_process_update_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$this->db->select('DATE_FORMAT(maxdate, "%d-%m-%Y") as maxdate', false);
$this->db->select('DATE_FORMAT(deadlinedate, "%d-%m-%Y") as deadlinedate', false);
$q = $this->db->get('rollprocessupdate');
if ($q->num_rows() > 0) {
$data = array();
$data['roll_process_update_id'] = $roll_process_update_id;
foreach ($q->result() as $r) {
$data['rollprocessupdate__idstring'] = $r->idstring;
$data['rollprocessupdate__noorderandcustomer'] = $r->noorderandcustomer;
$data['rollprocessupdate__date'] = $r->date;
$data['rollprocessupdate__qty1'] = $r->qty1;
$data['rollprocessupdate__machinetyperoll'] = $r->machinetyperoll;
$data['rollprocessupdate__compound'] = $r->compound;
$data['rollprocessupdate__rd'] = $r->rd;
$data['rollprocessupdate__wl'] = $r->wl;
$data['rollprocessupdate__tl'] = $r->tl;
$data['rollprocessupdate__qty2'] = $r->qty2;
$data['rollprocessupdate__shipping'] = $r->shipping;
$data['rollprocessupdate__wrapping'] = $r->wrapping;
$data['rollprocessupdate__vulcanizing'] = $r->vulcanizing;
$data['rollprocessupdate__faceoff'] = $r->faceoff;
$data['rollprocessupdate__grinding'] = $r->grinding;
$data['rollprocessupdate__polishing'] = $r->polishing;
$data['rollprocessupdate__maxdate'] = $r->maxdate;
$data['rollprocessupdate__deadlinedate'] = $r->deadlinedate;
$data['rollprocessupdate__notes'] = $r->notes;
$data['rollprocessupdate__lastupdate'] = $r->lastupdate;
$data['rollprocessupdate__updatedby'] = $r->updatedby;
$data['rollprocessupdate__created'] = $r->created;
$data['rollprocessupdate__createdby'] = $r->createdby;}
$this->load->view('roll_process_update_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['rollprocessupdate__idstring'];
$data['noorderandcustomer'] = $_POST['rollprocessupdate__noorderandcustomer'];
$data['date'] = $_POST['rollprocessupdate__date'];
$data['qty1'] = $_POST['rollprocessupdate__qty1'];
$data['machinetyperoll'] = $_POST['rollprocessupdate__machinetyperoll'];
$data['compound'] = $_POST['rollprocessupdate__compound'];
$data['rd'] = $_POST['rollprocessupdate__rd'];
$data['wl'] = $_POST['rollprocessupdate__wl'];
$data['tl'] = $_POST['rollprocessupdate__tl'];
$data['qty2'] = $_POST['rollprocessupdate__qty2'];
$data['shipping'] = $_POST['rollprocessupdate__shipping'];
$data['wrapping'] = $_POST['rollprocessupdate__wrapping'];
$data['vulcanizing'] = $_POST['rollprocessupdate__vulcanizing'];
$data['faceoff'] = $_POST['rollprocessupdate__faceoff'];
$data['grinding'] = $_POST['rollprocessupdate__grinding'];
$data['polishing'] = $_POST['rollprocessupdate__polishing'];
$data['maxdate'] = $_POST['rollprocessupdate__maxdate'];
$data['deadlinedate'] = $_POST['rollprocessupdate__deadlinedate'];
$data['notes'] = $_POST['rollprocessupdate__notes'];
$data['lastupdate'] = $_POST['rollprocessupdate__lastupdate'];
$data['updatedby'] = $_POST['rollprocessupdate__updatedby'];
$data['created'] = $_POST['rollprocessupdate__created'];
$data['createdby'] = $_POST['rollprocessupdate__createdby'];
$this->db->where('id', $data['roll_process_update_id']);
$this->db->update('rollprocessupdate', $data);
			validationonserver();
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully updated.";
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