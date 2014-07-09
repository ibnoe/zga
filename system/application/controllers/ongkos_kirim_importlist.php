<?php

class ongkos_kirim_importlist extends Controller {

	function ongkos_kirim_importlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('ongkoskirimimport');
$this->db->where('ongkoskirimimport.disabled = 0');
$this->db->select('ongkoskirimimport.id as id', false);
$this->db->select('ongkoskirimimport.idstring as ongkoskirimimport__idstring', false);
$this->db->select('ongkoskirimimport.admawb as ongkoskirimimport__admawb', false);
$this->db->select('ongkoskirimimport.admbank as ongkoskirimimport__admbank', false);
$this->db->select('ongkoskirimimport.admfee as ongkoskirimimport__admfee', false);
$this->db->select('ongkoskirimimport.admpib as ongkoskirimimport__admpib', false);
$this->db->select('ongkoskirimimport.admppjk as ongkoskirimimport__admppjk', false);
$this->db->select('ongkoskirimimport.agencyfee as ongkoskirimimport__agencyfee', false);
$this->db->select('ongkoskirimimport.angckgtoserpong as ongkoskirimimport__angckgtoserpong', false);
$this->db->select('ongkoskirimimport.angprioktoserpong as ongkoskirimimport__angprioktoserpong', false);
$this->db->select('ongkoskirimimport.asuransi as ongkoskirimimport__asuransi', false);
$this->db->select('ongkoskirimimport.awbfee as ongkoskirimimport__awbfee', false);
$this->db->select('ongkoskirimimport.blfee as ongkoskirimimport__blfee', false);
$this->db->select('ongkoskirimimport.bahandle as ongkoskirimimport__bahandle', false);
$this->db->select('ongkoskirimimport.biayafreight as ongkoskirimimport__biayafreight', false);
$this->db->select('ongkoskirimimport.biayapnbp as ongkoskirimimport__biayapnbp', false);
$this->db->select('ongkoskirimimport.biayaprovisilc as ongkoskirimimport__biayaprovisilc', false);
$this->db->select('ongkoskirimimport.bm as ongkoskirimimport__bm', false);
$this->db->select('ongkoskirimimport.breakbulkmanifest as ongkoskirimimport__breakbulkmanifest', false);
$this->db->select('ongkoskirimimport.byedi as ongkoskirimimport__byedi', false);
$this->db->select('ongkoskirimimport.byinswnpik as ongkoskirimimport__byinswnpik', false);
$this->db->select('ongkoskirimimport.bypenumpukan as ongkoskirimimport__bypenumpukan', false);
$this->db->select('ongkoskirimimport.byrekomendasiit as ongkoskirimimport__byrekomendasiit', false);
$this->db->select('ongkoskirimimport.bytransferpib as ongkoskirimimport__bytransferpib', false);
$this->db->select('ongkoskirimimport.caf as ongkoskirimimport__caf', false);
$this->db->select('ongkoskirimimport.cfscharge as ongkoskirimimport__cfscharge', false);
$this->db->select('ongkoskirimimport.customclearanceshanghai as ongkoskirimimport__customclearanceshanghai', false);
$this->db->select('ongkoskirimimport.demurrage as ongkoskirimimport__demurrage', false);
$this->db->select('ongkoskirimimport.dendaadmpabean as ongkoskirimimport__dendaadmpabean', false);
$this->db->select('ongkoskirimimport.devanningcharges as ongkoskirimimport__devanningcharges', false);
$this->db->select('ongkoskirimimport.docfee as ongkoskirimimport__docfee', false);
$this->db->select('ongkoskirimimport.docshanghai as ongkoskirimimport__docshanghai', false);
$this->db->select('ongkoskirimimport.forwardingcharges as ongkoskirimimport__forwardingcharges', false);
$this->db->select('ongkoskirimimport.fotountukbeacukai as ongkoskirimimport__fotountukbeacukai', false);
$this->db->select('ongkoskirimimport.gerakan as ongkoskirimimport__gerakan', false);
$this->db->select('ongkoskirimimport.handlingfee as ongkoskirimimport__handlingfee', false);
$this->db->select('ongkoskirimimport.jalurkuningadmdoc as ongkoskirimimport__jalurkuningadmdoc', false);
$this->db->select('ongkoskirimimport.jasappjk as ongkoskirimimport__jasappjk', false);
$this->db->select('ongkoskirimimport.kelancaran as ongkoskirimimport__kelancaran', false);
$this->db->select('ongkoskirimimport.klmin as ongkoskirimimport__klmin', false);
$this->db->select('ongkoskirimimport.liftoff as ongkoskirimimport__liftoff', false);
$this->db->select('ongkoskirimimport.manifestshanghai as ongkoskirimimport__manifestshanghai', false);
$this->db->select('ongkoskirimimport.mekanis as ongkoskirimimport__mekanis', false);
$this->db->select('ongkoskirimimport.materialdll as ongkoskirimimport__materialdll', false);
$this->db->select('ongkoskirimimport.oceanfreight as ongkoskirimimport__oceanfreight', false);
$this->db->select('ongkoskirimimport.other as ongkoskirimimport__other', false);
$this->db->select('ongkoskirimimport.penerbitansppb as ongkoskirimimport__penerbitansppb', false);
$this->db->select('ongkoskirimimport.penerbitansppbasli as ongkoskirimimport__penerbitansppbasli', false);
$this->db->select('ongkoskirimimport.perpanjangpenumpukan as ongkoskirimimport__perpanjangpenumpukan', false);
$this->db->select('ongkoskirimimport.pickupshanghai as ongkoskirimimport__pickupshanghai', false);
$this->db->select('ongkoskirimimport.portfacility as ongkoskirimimport__portfacility', false);
$this->db->select('ongkoskirimimport.pph as ongkoskirimimport__pph', false);
$this->db->select('ongkoskirimimport.ppn as ongkoskirimimport__ppn', false);
$this->db->select('ongkoskirimimport.ppnhandling as ongkoskirimimport__ppnhandling', false);
$this->db->select('ongkoskirimimport.ppncredit as ongkoskirimimport__ppncredit', false);
$this->db->select('ongkoskirimimport.receiving as ongkoskirimimport__receiving', false);
$this->db->select('ongkoskirimimport.repair as ongkoskirimimport__repair', false);
$this->db->select('ongkoskirimimport.shanghaiwarehouse as ongkoskirimimport__shanghaiwarehouse', false);
$this->db->select('ongkoskirimimport.suratpengantardo as ongkoskirimimport__suratpengantardo', false);
$this->db->select('ongkoskirimimport.surcharges as ongkoskirimimport__surcharges', false);
$this->db->select('ongkoskirimimport.surveyorfee as ongkoskirimimport__surveyorfee', false);
$this->db->select('ongkoskirimimport.biayalain1 as ongkoskirimimport__biayalain1', false);
$this->db->select('ongkoskirimimport.biayalain2 as ongkoskirimimport__biayalain2', false);
$this->db->select('ongkoskirimimport.biayalain3 as ongkoskirimimport__biayalain3', false);
$this->db->select('ongkoskirimimport.lastupdate as ongkoskirimimport__lastupdate', false);
$this->db->select('ongkoskirimimport.updatedby as ongkoskirimimport__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "ongkoskirimimport.idstring like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.admawb like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.admbank like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.admfee like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.admpib like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.admppjk like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.agencyfee like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.angckgtoserpong like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.angprioktoserpong like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.asuransi like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.awbfee like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.blfee like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.bahandle like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.biayafreight like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.biayapnbp like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.biayaprovisilc like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.bm like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.breakbulkmanifest like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.byedi like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.byinswnpik like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.bypenumpukan like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.byrekomendasiit like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.bytransferpib like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.caf like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.cfscharge like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.customclearanceshanghai like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.demurrage like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.dendaadmpabean like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.devanningcharges like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.docfee like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.docshanghai like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.forwardingcharges like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.fotountukbeacukai like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.gerakan like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.handlingfee like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.jalurkuningadmdoc like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.jasappjk like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.kelancaran like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.klmin like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.liftoff like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.manifestshanghai like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.mekanis like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.materialdll like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.oceanfreight like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.other like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.penerbitansppb like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.penerbitansppbasli like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.perpanjangpenumpukan like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.pickupshanghai like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.portfacility like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.pph like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.ppn like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.ppnhandling like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.ppncredit like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.receiving like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.repair like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.shanghaiwarehouse like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.suratpengantardo like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.surcharges like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.surveyorfee like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.biayalain1 like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.biayalain2 like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.biayalain3 like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || ongkoskirimimport.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('ongkoskirimimport__idstring', 'asc');
$this->db->order_by('ongkoskirimimport__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($edit_module_id=0)
	{
		$data = array();
		
		
		
		$data['pageno'] = 0;
		if (isset($_POST['pageno'])) 
		{
			$data['pageno'] = $_POST['pageno'];
		}
		//echo $data['pageno'];
		$data['perpage'] = 20;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('ongkoskirimimport__idstring' => 'ID', 'ongkoskirimimport__admawb' => 'Adm AWB', 'ongkoskirimimport__admbank' => 'ADM Bank', 'ongkoskirimimport__admfee' => 'Adm Fee', 'ongkoskirimimport__admpib' => 'Adm PIB & PNBP', 'ongkoskirimimport__admppjk' => 'Adm PPJK', 'ongkoskirimimport__agencyfee' => 'Agency Fee', 'ongkoskirimimport__angckgtoserpong' => 'Angkutan Cengkareng ke Serpong', 'ongkoskirimimport__angprioktoserpong' => 'Angkutan Tj Priok ke Serpong', 'ongkoskirimimport__asuransi' => 'Asuransi', 'ongkoskirimimport__awbfee' => 'AWB Fee', 'ongkoskirimimport__blfee' => 'B/L Fee', 'ongkoskirimimport__bahandle' => 'Bahandle', 'ongkoskirimimport__biayafreight' => 'Biaya Freight', 'ongkoskirimimport__biayapnbp' => 'Biaya PNBP', 'ongkoskirimimport__biayaprovisilc' => 'Biaya Provisi L/C', 'ongkoskirimimport__bm' => 'BM', 'ongkoskirimimport__breakbulkmanifest' => 'Breakbluk Manifest', 'ongkoskirimimport__byedi' => 'By EDI', 'ongkoskirimimport__byinswnpik' => 'By INSW NPIK', 'ongkoskirimimport__bypenumpukan' => 'By Penumpukan', 'ongkoskirimimport__byrekomendasiit' => 'By Rekomendasi IT', 'ongkoskirimimport__bytransferpib' => 'By Transfer PIB', 'ongkoskirimimport__caf' => 'CAF (currency adjustment factor)', 'ongkoskirimimport__cfscharge' => 'CFS Charge', 'ongkoskirimimport__customclearanceshanghai' => 'Custom clearance at shanghai', 'ongkoskirimimport__demurrage' => 'Demurrage', 'ongkoskirimimport__dendaadmpabean' => 'Denda ADM Pabean', 'ongkoskirimimport__devanningcharges' => 'Devanning Charges', 'ongkoskirimimport__docfee' => 'Doc Fee', 'ongkoskirimimport__docshanghai' => 'DOC shanghai', 'ongkoskirimimport__forwardingcharges' => 'Forwarding charges', 'ongkoskirimimport__fotountukbeacukai' => 'Foto u/ Bea Cukai', 'ongkoskirimimport__gerakan' => 'Gerakan', 'ongkoskirimimport__handlingfee' => 'Handling Fee', 'ongkoskirimimport__jalurkuningadmdoc' => 'Jalur kuning adm doc', 'ongkoskirimimport__jasappjk' => 'Jasa PPJK', 'ongkoskirimimport__kelancaran' => 'Kelancaran', 'ongkoskirimimport__klmin' => 'Kl Min', 'ongkoskirimimport__liftoff' => 'Lift off', 'ongkoskirimimport__manifestshanghai' => 'manifest shanghai', 'ongkoskirimimport__mekanis' => 'Mekanis', 'ongkoskirimimport__materialdll' => 'Meterai dll', 'ongkoskirimimport__oceanfreight' => 'Ocean Freight', 'ongkoskirimimport__other' => 'Other', 'ongkoskirimimport__penerbitansppb' => 'Penerbitan SPPB', 'ongkoskirimimport__penerbitansppbasli' => 'Penerbitan SPPB asli Tutup PU', 'ongkoskirimimport__perpanjangpenumpukan' => 'Perpanjang Penumpukan', 'ongkoskirimimport__pickupshanghai' => 'Pick up Shanghai', 'ongkoskirimimport__portfacility' => 'Port Facility', 'ongkoskirimimport__pph' => 'PPH %', 'ongkoskirimimport__ppn' => 'PPN', 'ongkoskirimimport__ppnhandling' => 'PPN Handling', 'ongkoskirimimport__ppncredit' => 'PPN Kredit', 'ongkoskirimimport__receiving' => 'Receiving', 'ongkoskirimimport__repair' => 'Repair', 'ongkoskirimimport__shanghaiwarehouse' => 'Shanghai warehouse', 'ongkoskirimimport__suratpengantardo' => 'Surat Pengantar  DO', 'ongkoskirimimport__surcharges' => 'Surcharges', 'ongkoskirimimport__surveyorfee' => 'Surveyor Fee', 'ongkoskirimimport__biayalain1' => 'Biaya Lain-lain 1', 'ongkoskirimimport__biayalain2' => 'Biaya Lain-lain 2', 'ongkoskirimimport__biayalain3' => 'Biaya Lain-lain 3', 'ongkoskirimimport__lastupdate' => 'Last Update', 'ongkoskirimimport__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('ongkos_kirim_import_list_view', $data);
	}
}

?>