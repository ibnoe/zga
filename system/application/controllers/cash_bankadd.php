<?php

class cash_bankadd extends Controller {

	function cash_bankadd()
	{
		parent::Controller();	

		$this->load->helper('form');
		$this->load->helper('url');
	}

	function index($id = 0)
	{
		$data = array();


		$data['cashbank__name'] = '';
		$currency_opt = array();
		$currency_opt[''] = 'None';
		$q = $this->db->get('currency');
		if ($q->num_rows() > 0)
			foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
		$data['currency_opt'] = $currency_opt;
		$data['cashbank__currency_id'] = '';
		$coa_opt = array();
		$coa_opt[''] = 'None';
		$q = $this->db->get('coa');
		if ($q->num_rows() > 0)
			foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
		$data['coa_opt'] = $coa_opt;
		$data['cashbank__coa_id'] = '';
		$data['cashbank__notes'] = '';
		$data['cashbank__lastupdate'] = '';
		$data['cashbank__updatedby'] = '';
		$data['cashbank__created'] = '';
		$data['cashbank__createdby'] = '';


		$this->load->view('cash_bank_add_form', $data);
	}

	function submit()
	{
		$error = "";


		if (isset($_POST['cashbank__name']) && ($_POST['cashbank__name'] == "" || $_POST['cashbank__name'] == null))
			$error .= "<span class='error'>Name must not be empty"."</span><br>";

		if (!isset($_POST['cashbank__currency_id']) || ($_POST['cashbank__currency_id'] == "" || $_POST['cashbank__currency_id'] == null  || $_POST['cashbank__currency_id'] == null))
			$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		if (!isset($_POST['cashbank__coa_id']) || ($_POST['cashbank__coa_id'] == "" || $_POST['cashbank__coa_id'] == null  || $_POST['cashbank__coa_id'] == null))
			$error .= "<span class='error'>Account must not be empty"."</span><br>";


		if ($error == "")
		{

			$data = array();if (isset($_POST['cashbank__name']))
				$data['name'] = $_POST['cashbank__name'];if (isset($_POST['cashbank__currency_id']))
				$data['currency_id'] = $_POST['cashbank__currency_id'];if (isset($_POST['cashbank__coa_id']))
				$data['coa_id'] = $_POST['cashbank__coa_id'];if (isset($_POST['cashbank__notes']))
				$data['notes'] = $_POST['cashbank__notes'];
			$data['lastupdate'] = date('Y-m-d H:i:s');
			$data['updatedby'] = $this->session->userdata('user');
			$data['created'] = date('Y-m-d H:i:s');
			$data['createdby'] = $this->session->userdata('user');
			$this->db->insert('cashbank', $data);
			$this->session->set_userdata('last_insert_id', $this->db->insert_id());
			$cashbank_id = $this->db->insert_id();
			$this->load->library('generallib');
			$error .= $this->generallib->commonfunction('cash_bankadd','cashbank','aftersave', $cashbank_id);


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