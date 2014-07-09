<?php

class ongkos_kirim_importedit extends Controller {

	function ongkos_kirim_importedit()
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
	
		
$q = $this->db->where('id', $ongkos_kirim_import_id);
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
$data['ongkoskirimimport__lastupdate'] = $r->lastupdate;
$data['ongkoskirimimport__updatedby'] = $r->updatedby;
$data['ongkoskirimimport__created'] = $r->created;
$data['ongkoskirimimport__createdby'] = $r->createdby;}
$this->load->view('ongkos_kirim_import_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['ongkoskirimimport__idstring']) && ($_POST['ongkoskirimimport__idstring'] == "" || $_POST['ongkoskirimimport__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['ongkoskirimimport__idstring'])) {$this->db->where("id !=", $_POST['ongkos_kirim_import_id']);
$this->db->where('idstring', $_POST['ongkoskirimimport__idstring']);
$q = $this->db->get('ongkoskirimimport');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['ongkoskirimimport__idstring']))
$data['idstring'] = $_POST['ongkoskirimimport__idstring'];if (isset($_POST['ongkoskirimimport__admawb']))
$data['admawb'] = $_POST['ongkoskirimimport__admawb'];if (isset($_POST['ongkoskirimimport__admbank']))
$data['admbank'] = $_POST['ongkoskirimimport__admbank'];if (isset($_POST['ongkoskirimimport__admfee']))
$data['admfee'] = $_POST['ongkoskirimimport__admfee'];if (isset($_POST['ongkoskirimimport__admpib']))
$data['admpib'] = $_POST['ongkoskirimimport__admpib'];if (isset($_POST['ongkoskirimimport__admppjk']))
$data['admppjk'] = $_POST['ongkoskirimimport__admppjk'];if (isset($_POST['ongkoskirimimport__agencyfee']))
$data['agencyfee'] = $_POST['ongkoskirimimport__agencyfee'];if (isset($_POST['ongkoskirimimport__angckgtoserpong']))
$data['angckgtoserpong'] = $_POST['ongkoskirimimport__angckgtoserpong'];if (isset($_POST['ongkoskirimimport__angprioktoserpong']))
$data['angprioktoserpong'] = $_POST['ongkoskirimimport__angprioktoserpong'];if (isset($_POST['ongkoskirimimport__asuransi']))
$data['asuransi'] = $_POST['ongkoskirimimport__asuransi'];if (isset($_POST['ongkoskirimimport__awbfee']))
$data['awbfee'] = $_POST['ongkoskirimimport__awbfee'];if (isset($_POST['ongkoskirimimport__blfee']))
$data['blfee'] = $_POST['ongkoskirimimport__blfee'];if (isset($_POST['ongkoskirimimport__bahandle']))
$data['bahandle'] = $_POST['ongkoskirimimport__bahandle'];if (isset($_POST['ongkoskirimimport__biayafreight']))
$data['biayafreight'] = $_POST['ongkoskirimimport__biayafreight'];if (isset($_POST['ongkoskirimimport__biayapnbp']))
$data['biayapnbp'] = $_POST['ongkoskirimimport__biayapnbp'];if (isset($_POST['ongkoskirimimport__biayaprovisilc']))
$data['biayaprovisilc'] = $_POST['ongkoskirimimport__biayaprovisilc'];if (isset($_POST['ongkoskirimimport__bm']))
$data['bm'] = $_POST['ongkoskirimimport__bm'];if (isset($_POST['ongkoskirimimport__breakbulkmanifest']))
$data['breakbulkmanifest'] = $_POST['ongkoskirimimport__breakbulkmanifest'];if (isset($_POST['ongkoskirimimport__byedi']))
$data['byedi'] = $_POST['ongkoskirimimport__byedi'];if (isset($_POST['ongkoskirimimport__byinswnpik']))
$data['byinswnpik'] = $_POST['ongkoskirimimport__byinswnpik'];if (isset($_POST['ongkoskirimimport__bypenumpukan']))
$data['bypenumpukan'] = $_POST['ongkoskirimimport__bypenumpukan'];if (isset($_POST['ongkoskirimimport__byrekomendasiit']))
$data['byrekomendasiit'] = $_POST['ongkoskirimimport__byrekomendasiit'];if (isset($_POST['ongkoskirimimport__bytransferpib']))
$data['bytransferpib'] = $_POST['ongkoskirimimport__bytransferpib'];if (isset($_POST['ongkoskirimimport__caf']))
$data['caf'] = $_POST['ongkoskirimimport__caf'];if (isset($_POST['ongkoskirimimport__cfscharge']))
$data['cfscharge'] = $_POST['ongkoskirimimport__cfscharge'];if (isset($_POST['ongkoskirimimport__customclearanceshanghai']))
$data['customclearanceshanghai'] = $_POST['ongkoskirimimport__customclearanceshanghai'];if (isset($_POST['ongkoskirimimport__demurrage']))
$data['demurrage'] = $_POST['ongkoskirimimport__demurrage'];if (isset($_POST['ongkoskirimimport__dendaadmpabean']))
$data['dendaadmpabean'] = $_POST['ongkoskirimimport__dendaadmpabean'];if (isset($_POST['ongkoskirimimport__devanningcharges']))
$data['devanningcharges'] = $_POST['ongkoskirimimport__devanningcharges'];if (isset($_POST['ongkoskirimimport__docfee']))
$data['docfee'] = $_POST['ongkoskirimimport__docfee'];if (isset($_POST['ongkoskirimimport__docshanghai']))
$data['docshanghai'] = $_POST['ongkoskirimimport__docshanghai'];if (isset($_POST['ongkoskirimimport__forwardingcharges']))
$data['forwardingcharges'] = $_POST['ongkoskirimimport__forwardingcharges'];if (isset($_POST['ongkoskirimimport__fotountukbeacukai']))
$data['fotountukbeacukai'] = $_POST['ongkoskirimimport__fotountukbeacukai'];if (isset($_POST['ongkoskirimimport__gerakan']))
$data['gerakan'] = $_POST['ongkoskirimimport__gerakan'];if (isset($_POST['ongkoskirimimport__handlingfee']))
$data['handlingfee'] = $_POST['ongkoskirimimport__handlingfee'];if (isset($_POST['ongkoskirimimport__jalurkuningadmdoc']))
$data['jalurkuningadmdoc'] = $_POST['ongkoskirimimport__jalurkuningadmdoc'];if (isset($_POST['ongkoskirimimport__jasappjk']))
$data['jasappjk'] = $_POST['ongkoskirimimport__jasappjk'];if (isset($_POST['ongkoskirimimport__kelancaran']))
$data['kelancaran'] = $_POST['ongkoskirimimport__kelancaran'];if (isset($_POST['ongkoskirimimport__klmin']))
$data['klmin'] = $_POST['ongkoskirimimport__klmin'];if (isset($_POST['ongkoskirimimport__liftoff']))
$data['liftoff'] = $_POST['ongkoskirimimport__liftoff'];if (isset($_POST['ongkoskirimimport__manifestshanghai']))
$data['manifestshanghai'] = $_POST['ongkoskirimimport__manifestshanghai'];if (isset($_POST['ongkoskirimimport__mekanis']))
$data['mekanis'] = $_POST['ongkoskirimimport__mekanis'];if (isset($_POST['ongkoskirimimport__materialdll']))
$data['materialdll'] = $_POST['ongkoskirimimport__materialdll'];if (isset($_POST['ongkoskirimimport__oceanfreight']))
$data['oceanfreight'] = $_POST['ongkoskirimimport__oceanfreight'];if (isset($_POST['ongkoskirimimport__other']))
$data['other'] = $_POST['ongkoskirimimport__other'];if (isset($_POST['ongkoskirimimport__penerbitansppb']))
$data['penerbitansppb'] = $_POST['ongkoskirimimport__penerbitansppb'];if (isset($_POST['ongkoskirimimport__penerbitansppbasli']))
$data['penerbitansppbasli'] = $_POST['ongkoskirimimport__penerbitansppbasli'];if (isset($_POST['ongkoskirimimport__perpanjangpenumpukan']))
$data['perpanjangpenumpukan'] = $_POST['ongkoskirimimport__perpanjangpenumpukan'];if (isset($_POST['ongkoskirimimport__pickupshanghai']))
$data['pickupshanghai'] = $_POST['ongkoskirimimport__pickupshanghai'];if (isset($_POST['ongkoskirimimport__portfacility']))
$data['portfacility'] = $_POST['ongkoskirimimport__portfacility'];if (isset($_POST['ongkoskirimimport__pph']))
$data['pph'] = $_POST['ongkoskirimimport__pph'];if (isset($_POST['ongkoskirimimport__ppn']))
$data['ppn'] = $_POST['ongkoskirimimport__ppn'];if (isset($_POST['ongkoskirimimport__ppnhandling']))
$data['ppnhandling'] = $_POST['ongkoskirimimport__ppnhandling'];if (isset($_POST['ongkoskirimimport__ppncredit']))
$data['ppncredit'] = $_POST['ongkoskirimimport__ppncredit'];if (isset($_POST['ongkoskirimimport__receiving']))
$data['receiving'] = $_POST['ongkoskirimimport__receiving'];if (isset($_POST['ongkoskirimimport__repair']))
$data['repair'] = $_POST['ongkoskirimimport__repair'];if (isset($_POST['ongkoskirimimport__shanghaiwarehouse']))
$data['shanghaiwarehouse'] = $_POST['ongkoskirimimport__shanghaiwarehouse'];if (isset($_POST['ongkoskirimimport__suratpengantardo']))
$data['suratpengantardo'] = $_POST['ongkoskirimimport__suratpengantardo'];if (isset($_POST['ongkoskirimimport__surcharges']))
$data['surcharges'] = $_POST['ongkoskirimimport__surcharges'];if (isset($_POST['ongkoskirimimport__surveyorfee']))
$data['surveyorfee'] = $_POST['ongkoskirimimport__surveyorfee'];if (isset($_POST['ongkoskirimimport__biayalain1']))
$data['biayalain1'] = $_POST['ongkoskirimimport__biayalain1'];if (isset($_POST['ongkoskirimimport__biayalain2']))
$data['biayalain2'] = $_POST['ongkoskirimimport__biayalain2'];if (isset($_POST['ongkoskirimimport__biayalain3']))
$data['biayalain3'] = $_POST['ongkoskirimimport__biayalain3'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['ongkos_kirim_import_id']);
$this->db->update('ongkoskirimimport', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('ongkos_kirim_importedit','ongkoskirimimport','afteredit', $_POST['ongkos_kirim_import_id']);
			
			
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