<?php

class fixed_assetview extends Controller {

	function fixed_assetview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($fixed_asset_id=0)
	{
		if ($fixed_asset_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $fixed_asset_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(datebought, "%d-%m-%Y") as datebought', false);
$q = $this->db->get('fixedasset');
if ($q->num_rows() > 0) {
$data = array();
$data['fixed_asset_id'] = $fixed_asset_id;
foreach ($q->result() as $r) {
$data['fixedasset__name'] = $r->name;
$data['fixedasset__datebought'] = $r->datebought;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__coa_id'] = $r->coa_id;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__paidusing_coa_id'] = $r->paidusing_coa_id;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__depreciation_coa_id'] = $r->depreciation_coa_id;
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__accumulated_coa_id'] = $r->accumulated_coa_id;
$data['fixedasset__estlifetime'] = $r->estlifetime;
$data['fixedasset__cost'] = $r->cost;
$data['fixedasset__salvage'] = $r->salvage;
$data['fixedasset__notes'] = $r->notes;
$data['fixedasset__lastupdate'] = $r->lastupdate;
$data['fixedasset__updatedby'] = $r->updatedby;
$data['fixedasset__created'] = $r->created;
$data['fixedasset__createdby'] = $r->createdby;}
$this->load->view('fixed_asset_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['name'] = $_POST['fixedasset__name'];
$data['datebought'] = $_POST['fixedasset__datebought'];
$data['coa_id'] = $_POST['fixedasset__coa_id'];
$data['paidusing_coa_id'] = $_POST['fixedasset__paidusing_coa_id'];
$data['depreciation_coa_id'] = $_POST['fixedasset__depreciation_coa_id'];
$data['accumulated_coa_id'] = $_POST['fixedasset__accumulated_coa_id'];
$data['estlifetime'] = $_POST['fixedasset__estlifetime'];
$data['cost'] = $_POST['fixedasset__cost'];
$data['salvage'] = $_POST['fixedasset__salvage'];
$data['notes'] = $_POST['fixedasset__notes'];
$data['lastupdate'] = $_POST['fixedasset__lastupdate'];
$data['updatedby'] = $_POST['fixedasset__updatedby'];
$data['created'] = $_POST['fixedasset__created'];
$data['createdby'] = $_POST['fixedasset__createdby'];
$this->db->where('id', $data['fixed_asset_id']);
$this->db->update('fixedasset', $data);
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