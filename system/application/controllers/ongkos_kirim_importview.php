<?php

class ongkos_kirim_importview extends Controller {

	function ongkos_kirim_importview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($ongkos_kirim_import_id=0)
	{
		if ($ongkos_kirim_import_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $ongkos_kirim_import_id);
$this->db->select('*');
$q = $this->db->get('ongkoskirimimport');
if ($q->num_rows() > 0) {
$data = array();
$data['ongkos_kirim_import_id'] = $ongkos_kirim_import_id;
foreach ($q->result() as $r) {
$data['ongkoskirimimport__idstring'] = $r->idstring;
$data['ongkoskirimimport__admawb'] = $r->admawb;
$data['ongkoskirimimport__admbank'] = $r->admbank;
$data['ongkoskirimimport__admfee'] = $r->admfee;
$data['ongkoskirimimport__admpib'] = $r->admpib;
$data['ongkoskirimimport__admppjk'] = $r->admppjk;
$data['ongkoskirimimport__agencyfee'] = $r->agencyfee;
$data['ongkoskirimimport__angckgtoserpong'] = $r->angckgtoserpong;
$data['ongkoskirimimport__angprioktoserpong'] = $r->angprioktoserpong;
$data['ongkoskirimimport__asuransi'] = $r->asuransi;
$data['ongkoskirimimport__awbfee'] = $r->awbfee;
$data['ongkoskirimimport__blfee'] = $r->blfee;
$data['ongkoskirimimport__bahandle'] = $r->bahandle;
$data['ongkoskirimimport__biayafreight'] = $r->biayafreight;
$data['ongkoskirimimport__biayapnbp'] = $r->biayapnbp;
$data['ongkoskirimimport__biayaprovisilc'] = $r->biayaprovisilc;
$data['ongkoskirimimport__bm'] = $r->bm;
$data['ongkoskirimimport__breakbulkmanifest'] = $r->breakbulkmanifest;
$data['ongkoskirimimport__byedi'] = $r->byedi;
$data['ongkoskirimimport__byinswnpik'] = $r->byinswnpik;
$data['ongkoskirimimport__bypenumpukan'] = $r->bypenumpukan;
$data['ongkoskirimimport__byrekomendasiit'] = $r->byrekomendasiit;
$data['ongkoskirimimport__bytransferpib'] = $r->bytransferpib;
$data['ongkoskirimimport__caf'] = $r->caf;
$data['ongkoskirimimport__cfscharge'] = $r->cfscharge;
$data['ongkoskirimimport__customclearanceshanghai'] = $r->customclearanceshanghai;
$data['ongkoskirimimport__demurrage'] = $r->demurrage;
$data['ongkoskirimimport__dendaadmpabean'] = $r->dendaadmpabean;
$data['ongkoskirimimport__devanningcharges'] = $r->devanningcharges;
$data['ongkoskirimimport__docfee'] = $r->docfee;
$data['ongkoskirimimport__docshanghai'] = $r->docshanghai;
$data['ongkoskirimimport__forwardingcharges'] = $r->forwardingcharges;
$data['ongkoskirimimport__fotountukbeacukai'] = $r->fotountukbeacukai;
$data['ongkoskirimimport__gerakan'] = $r->gerakan;
$data['ongkoskirimimport__handlingfee'] = $r->handlingfee;
$data['ongkoskirimimport__jalurkuningadmdoc'] = $r->jalurkuningadmdoc;
$data['ongkoskirimimport__jasappjk'] = $r->jasappjk;
$data['ongkoskirimimport__kelancaran'] = $r->kelancaran;
$data['ongkoskirimimport__klmin'] = $r->klmin;
$data['ongkoskirimimport__liftoff'] = $r->liftoff;
$data['ongkoskirimimport__manifestshanghai'] = $r->manifestshanghai;
$data['ongkoskirimimport__mekanis'] = $r->mekanis;
$data['ongkoskirimimport__materialdll'] = $r->materialdll;
$data['ongkoskirimimport__oceanfreight'] = $r->oceanfreight;
$data['ongkoskirimimport__other'] = $r->other;
$data['ongkoskirimimport__penerbitansppb'] = $r->penerbitansppb;
$data['ongkoskirimimport__penerbitansppbasli'] = $r->penerbitansppbasli;
$data['ongkoskirimimport__perpanjangpenumpukan'] = $r->perpanjangpenumpukan;
$data['ongkoskirimimport__pickupshanghai'] = $r->pickupshanghai;
$data['ongkoskirimimport__portfacility'] = $r->portfacility;
$data['ongkoskirimimport__pph'] = $r->pph;
$data['ongkoskirimimport__ppn'] = $r->ppn;
$data['ongkoskirimimport__ppnhandling'] = $r->ppnhandling;
$data['ongkoskirimimport__ppncredit'] = $r->ppncredit;
$data['ongkoskirimimport__receiving'] = $r->receiving;
$data['ongkoskirimimport__repair'] = $r->repair;
$data['ongkoskirimimport__shanghaiwarehouse'] = $r->shanghaiwarehouse;
$data['ongkoskirimimport__suratpengantardo'] = $r->suratpengantardo;
$data['ongkoskirimimport__surcharges'] = $r->surcharges;
$data['ongkoskirimimport__surveyorfee'] = $r->surveyorfee;
$data['ongkoskirimimport__biayalain1'] = $r->biayalain1;
$data['ongkoskirimimport__biayalain2'] = $r->biayalain2;
$data['ongkoskirimimport__biayalain3'] = $r->biayalain3;
$data['ongkoskirimimport__total'] = $r->total;
$data['ongkoskirimimport__lastupdate'] = $r->lastupdate;
$data['ongkoskirimimport__updatedby'] = $r->updatedby;
$data['ongkoskirimimport__created'] = $r->created;
$data['ongkoskirimimport__createdby'] = $r->createdby;}
$this->load->view('ongkos_kirim_import_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['ongkoskirimimport__idstring'];
$data['admawb'] = $_POST['ongkoskirimimport__admawb'];
$data['admbank'] = $_POST['ongkoskirimimport__admbank'];
$data['admfee'] = $_POST['ongkoskirimimport__admfee'];
$data['admpib'] = $_POST['ongkoskirimimport__admpib'];
$data['admppjk'] = $_POST['ongkoskirimimport__admppjk'];
$data['agencyfee'] = $_POST['ongkoskirimimport__agencyfee'];
$data['angckgtoserpong'] = $_POST['ongkoskirimimport__angckgtoserpong'];
$data['angprioktoserpong'] = $_POST['ongkoskirimimport__angprioktoserpong'];
$data['asuransi'] = $_POST['ongkoskirimimport__asuransi'];
$data['awbfee'] = $_POST['ongkoskirimimport__awbfee'];
$data['blfee'] = $_POST['ongkoskirimimport__blfee'];
$data['bahandle'] = $_POST['ongkoskirimimport__bahandle'];
$data['biayafreight'] = $_POST['ongkoskirimimport__biayafreight'];
$data['biayapnbp'] = $_POST['ongkoskirimimport__biayapnbp'];
$data['biayaprovisilc'] = $_POST['ongkoskirimimport__biayaprovisilc'];
$data['bm'] = $_POST['ongkoskirimimport__bm'];
$data['breakbulkmanifest'] = $_POST['ongkoskirimimport__breakbulkmanifest'];
$data['byedi'] = $_POST['ongkoskirimimport__byedi'];
$data['byinswnpik'] = $_POST['ongkoskirimimport__byinswnpik'];
$data['bypenumpukan'] = $_POST['ongkoskirimimport__bypenumpukan'];
$data['byrekomendasiit'] = $_POST['ongkoskirimimport__byrekomendasiit'];
$data['bytransferpib'] = $_POST['ongkoskirimimport__bytransferpib'];
$data['caf'] = $_POST['ongkoskirimimport__caf'];
$data['cfscharge'] = $_POST['ongkoskirimimport__cfscharge'];
$data['customclearanceshanghai'] = $_POST['ongkoskirimimport__customclearanceshanghai'];
$data['demurrage'] = $_POST['ongkoskirimimport__demurrage'];
$data['dendaadmpabean'] = $_POST['ongkoskirimimport__dendaadmpabean'];
$data['devanningcharges'] = $_POST['ongkoskirimimport__devanningcharges'];
$data['docfee'] = $_POST['ongkoskirimimport__docfee'];
$data['docshanghai'] = $_POST['ongkoskirimimport__docshanghai'];
$data['forwardingcharges'] = $_POST['ongkoskirimimport__forwardingcharges'];
$data['fotountukbeacukai'] = $_POST['ongkoskirimimport__fotountukbeacukai'];
$data['gerakan'] = $_POST['ongkoskirimimport__gerakan'];
$data['handlingfee'] = $_POST['ongkoskirimimport__handlingfee'];
$data['jalurkuningadmdoc'] = $_POST['ongkoskirimimport__jalurkuningadmdoc'];
$data['jasappjk'] = $_POST['ongkoskirimimport__jasappjk'];
$data['kelancaran'] = $_POST['ongkoskirimimport__kelancaran'];
$data['klmin'] = $_POST['ongkoskirimimport__klmin'];
$data['liftoff'] = $_POST['ongkoskirimimport__liftoff'];
$data['manifestshanghai'] = $_POST['ongkoskirimimport__manifestshanghai'];
$data['mekanis'] = $_POST['ongkoskirimimport__mekanis'];
$data['materialdll'] = $_POST['ongkoskirimimport__materialdll'];
$data['oceanfreight'] = $_POST['ongkoskirimimport__oceanfreight'];
$data['other'] = $_POST['ongkoskirimimport__other'];
$data['penerbitansppb'] = $_POST['ongkoskirimimport__penerbitansppb'];
$data['penerbitansppbasli'] = $_POST['ongkoskirimimport__penerbitansppbasli'];
$data['perpanjangpenumpukan'] = $_POST['ongkoskirimimport__perpanjangpenumpukan'];
$data['pickupshanghai'] = $_POST['ongkoskirimimport__pickupshanghai'];
$data['portfacility'] = $_POST['ongkoskirimimport__portfacility'];
$data['pph'] = $_POST['ongkoskirimimport__pph'];
$data['ppn'] = $_POST['ongkoskirimimport__ppn'];
$data['ppnhandling'] = $_POST['ongkoskirimimport__ppnhandling'];
$data['ppncredit'] = $_POST['ongkoskirimimport__ppncredit'];
$data['receiving'] = $_POST['ongkoskirimimport__receiving'];
$data['repair'] = $_POST['ongkoskirimimport__repair'];
$data['shanghaiwarehouse'] = $_POST['ongkoskirimimport__shanghaiwarehouse'];
$data['suratpengantardo'] = $_POST['ongkoskirimimport__suratpengantardo'];
$data['surcharges'] = $_POST['ongkoskirimimport__surcharges'];
$data['surveyorfee'] = $_POST['ongkoskirimimport__surveyorfee'];
$data['biayalain1'] = $_POST['ongkoskirimimport__biayalain1'];
$data['biayalain2'] = $_POST['ongkoskirimimport__biayalain2'];
$data['biayalain3'] = $_POST['ongkoskirimimport__biayalain3'];
$data['total'] = $_POST['ongkoskirimimport__total'];
$data['lastupdate'] = $_POST['ongkoskirimimport__lastupdate'];
$data['updatedby'] = $_POST['ongkoskirimimport__updatedby'];
$data['created'] = $_POST['ongkoskirimimport__created'];
$data['createdby'] = $_POST['ongkoskirimimport__createdby'];
$this->db->where('id', $data['ongkos_kirim_import_id']);
$this->db->update('ongkoskirimimport', $data);
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