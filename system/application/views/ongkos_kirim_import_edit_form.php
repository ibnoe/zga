<?php include "header.php" ?>

<script type="text/javascript">
	$(document).ready(function() {
		
		var options = {
			target:        '#ongkos_kirim_importoutput',   // target element(s) to be updated with server response 
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=$_SERVER['HTTP_REFERER'];?>' },
		};
			 
		$('#ongkos_kirim_importeditform').click(function(){$('#ongkos_kirim_importeditform').ajaxForm(options);});
	});
</script>

<div id="maincontent">

<h3 class="edittitle">Edit Ongkos Kirim Import</h3>

<p>
<div id="ongkos_kirim_importoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/ongkos_kirim_importedit/submit" id="ongkos_kirim_importeditform" class="editform">

<?=form_hidden("ongkos_kirim_import_id", $ongkos_kirim_import_id);?>

<table width="100%" class="edittable">
<tr class='basic'>
<td>ID *</td><td><?=form_input(array('name' => 'ongkoskirimimport__idstring', 'value' => $ongkoskirimimport__idstring, 'id' => 'ongkoskirimimport__idstring'));?></td></tr><tr class='basic'>
<td>Adm AWB</td><td><?=form_input(array('name' => 'ongkoskirimimport__admawb', 'value' => $ongkoskirimimport__admawb, 'id' => 'ongkoskirimimport__admawb'));?></td></tr><tr class='basic'>
<td>ADM Bank</td><td><?=form_input(array('name' => 'ongkoskirimimport__admbank', 'value' => $ongkoskirimimport__admbank, 'id' => 'ongkoskirimimport__admbank'));?></td></tr><tr class='basic'>
<td>Adm Fee</td><td><?=form_input(array('name' => 'ongkoskirimimport__admfee', 'value' => $ongkoskirimimport__admfee, 'id' => 'ongkoskirimimport__admfee'));?></td></tr><tr class='basic'>
<td>Adm PIB & PNBP</td><td><?=form_input(array('name' => 'ongkoskirimimport__admpib', 'value' => $ongkoskirimimport__admpib, 'id' => 'ongkoskirimimport__admpib'));?></td></tr><tr class='basic'>
<td>Adm PPJK</td><td><?=form_input(array('name' => 'ongkoskirimimport__admppjk', 'value' => $ongkoskirimimport__admppjk, 'id' => 'ongkoskirimimport__admppjk'));?></td></tr><tr class='basic'>
<td>Agency Fee</td><td><?=form_input(array('name' => 'ongkoskirimimport__agencyfee', 'value' => $ongkoskirimimport__agencyfee, 'id' => 'ongkoskirimimport__agencyfee'));?></td></tr><tr class='basic'>
<td>Angkutan Cengkareng ke Serpong</td><td><?=form_input(array('name' => 'ongkoskirimimport__angckgtoserpong', 'value' => $ongkoskirimimport__angckgtoserpong, 'id' => 'ongkoskirimimport__angckgtoserpong'));?></td></tr><tr class='basic'>
<td>Angkutan Tj Priok ke Serpong</td><td><?=form_input(array('name' => 'ongkoskirimimport__angprioktoserpong', 'value' => $ongkoskirimimport__angprioktoserpong, 'id' => 'ongkoskirimimport__angprioktoserpong'));?></td></tr><tr class='basic'>
<td>Asuransi</td><td><?=form_input(array('name' => 'ongkoskirimimport__asuransi', 'value' => $ongkoskirimimport__asuransi, 'id' => 'ongkoskirimimport__asuransi'));?></td></tr><tr class='basic'>
<td>AWB Fee</td><td><?=form_input(array('name' => 'ongkoskirimimport__awbfee', 'value' => $ongkoskirimimport__awbfee, 'id' => 'ongkoskirimimport__awbfee'));?></td></tr><tr class='basic'>
<td>B/L Fee</td><td><?=form_input(array('name' => 'ongkoskirimimport__blfee', 'value' => $ongkoskirimimport__blfee, 'id' => 'ongkoskirimimport__blfee'));?></td></tr><tr class='basic'>
<td>Bahandle</td><td><?=form_input(array('name' => 'ongkoskirimimport__bahandle', 'value' => $ongkoskirimimport__bahandle, 'id' => 'ongkoskirimimport__bahandle'));?></td></tr><tr class='basic'>
<td>Biaya Freight</td><td><?=form_input(array('name' => 'ongkoskirimimport__biayafreight', 'value' => $ongkoskirimimport__biayafreight, 'id' => 'ongkoskirimimport__biayafreight'));?></td></tr><tr class='basic'>
<td>Biaya PNBP</td><td><?=form_input(array('name' => 'ongkoskirimimport__biayapnbp', 'value' => $ongkoskirimimport__biayapnbp, 'id' => 'ongkoskirimimport__biayapnbp'));?></td></tr><tr class='basic'>
<td>Biaya Provisi L/C</td><td><?=form_input(array('name' => 'ongkoskirimimport__biayaprovisilc', 'value' => $ongkoskirimimport__biayaprovisilc, 'id' => 'ongkoskirimimport__biayaprovisilc'));?></td></tr><tr class='basic'>
<td>BM</td><td><?=form_input(array('name' => 'ongkoskirimimport__bm', 'value' => $ongkoskirimimport__bm, 'id' => 'ongkoskirimimport__bm'));?></td></tr><tr class='basic'>
<td>Breakbluk Manifest</td><td><?=form_input(array('name' => 'ongkoskirimimport__breakbulkmanifest', 'value' => $ongkoskirimimport__breakbulkmanifest, 'id' => 'ongkoskirimimport__breakbulkmanifest'));?></td></tr><tr class='basic'>
<td>By EDI</td><td><?=form_input(array('name' => 'ongkoskirimimport__byedi', 'value' => $ongkoskirimimport__byedi, 'id' => 'ongkoskirimimport__byedi'));?></td></tr><tr class='basic'>
<td>By INSW NPIK</td><td><?=form_input(array('name' => 'ongkoskirimimport__byinswnpik', 'value' => $ongkoskirimimport__byinswnpik, 'id' => 'ongkoskirimimport__byinswnpik'));?></td></tr><tr class='basic'>
<td>By Penumpukan</td><td><?=form_input(array('name' => 'ongkoskirimimport__bypenumpukan', 'value' => $ongkoskirimimport__bypenumpukan, 'id' => 'ongkoskirimimport__bypenumpukan'));?></td></tr><tr class='basic'>
<td>By Rekomendasi IT</td><td><?=form_input(array('name' => 'ongkoskirimimport__byrekomendasiit', 'value' => $ongkoskirimimport__byrekomendasiit, 'id' => 'ongkoskirimimport__byrekomendasiit'));?></td></tr><tr class='basic'>
<td>By Transfer PIB</td><td><?=form_input(array('name' => 'ongkoskirimimport__bytransferpib', 'value' => $ongkoskirimimport__bytransferpib, 'id' => 'ongkoskirimimport__bytransferpib'));?></td></tr><tr class='basic'>
<td>CAF (currency adjustment factor)</td><td><?=form_input(array('name' => 'ongkoskirimimport__caf', 'value' => $ongkoskirimimport__caf, 'id' => 'ongkoskirimimport__caf'));?></td></tr><tr class='basic'>
<td>CFS Charge</td><td><?=form_input(array('name' => 'ongkoskirimimport__cfscharge', 'value' => $ongkoskirimimport__cfscharge, 'id' => 'ongkoskirimimport__cfscharge'));?></td></tr><tr class='basic'>
<td>Custom clearance at shanghai</td><td><?=form_input(array('name' => 'ongkoskirimimport__customclearanceshanghai', 'value' => $ongkoskirimimport__customclearanceshanghai, 'id' => 'ongkoskirimimport__customclearanceshanghai'));?></td></tr><tr class='basic'>
<td>Demurrage</td><td><?=form_input(array('name' => 'ongkoskirimimport__demurrage', 'value' => $ongkoskirimimport__demurrage, 'id' => 'ongkoskirimimport__demurrage'));?></td></tr><tr class='basic'>
<td>Denda ADM Pabean</td><td><?=form_input(array('name' => 'ongkoskirimimport__dendaadmpabean', 'value' => $ongkoskirimimport__dendaadmpabean, 'id' => 'ongkoskirimimport__dendaadmpabean'));?></td></tr><tr class='basic'>
<td>Devanning Charges</td><td><?=form_input(array('name' => 'ongkoskirimimport__devanningcharges', 'value' => $ongkoskirimimport__devanningcharges, 'id' => 'ongkoskirimimport__devanningcharges'));?></td></tr><tr class='basic'>
<td>Doc Fee</td><td><?=form_input(array('name' => 'ongkoskirimimport__docfee', 'value' => $ongkoskirimimport__docfee, 'id' => 'ongkoskirimimport__docfee'));?></td></tr><tr class='basic'>
<td>DOC shanghai</td><td><?=form_input(array('name' => 'ongkoskirimimport__docshanghai', 'value' => $ongkoskirimimport__docshanghai, 'id' => 'ongkoskirimimport__docshanghai'));?></td></tr><tr class='basic'>
<td>Forwarding charges</td><td><?=form_input(array('name' => 'ongkoskirimimport__forwardingcharges', 'value' => $ongkoskirimimport__forwardingcharges, 'id' => 'ongkoskirimimport__forwardingcharges'));?></td></tr><tr class='basic'>
<td>Foto u/ Bea Cukai</td><td><?=form_input(array('name' => 'ongkoskirimimport__fotountukbeacukai', 'value' => $ongkoskirimimport__fotountukbeacukai, 'id' => 'ongkoskirimimport__fotountukbeacukai'));?></td></tr><tr class='basic'>
<td>Gerakan</td><td><?=form_input(array('name' => 'ongkoskirimimport__gerakan', 'value' => $ongkoskirimimport__gerakan, 'id' => 'ongkoskirimimport__gerakan'));?></td></tr><tr class='basic'>
<td>Handling Fee</td><td><?=form_input(array('name' => 'ongkoskirimimport__handlingfee', 'value' => $ongkoskirimimport__handlingfee, 'id' => 'ongkoskirimimport__handlingfee'));?></td></tr><tr class='basic'>
<td>Jalur kuning adm doc</td><td><?=form_input(array('name' => 'ongkoskirimimport__jalurkuningadmdoc', 'value' => $ongkoskirimimport__jalurkuningadmdoc, 'id' => 'ongkoskirimimport__jalurkuningadmdoc'));?></td></tr><tr class='basic'>
<td>Jasa PPJK</td><td><?=form_input(array('name' => 'ongkoskirimimport__jasappjk', 'value' => $ongkoskirimimport__jasappjk, 'id' => 'ongkoskirimimport__jasappjk'));?></td></tr><tr class='basic'>
<td>Kelancaran</td><td><?=form_input(array('name' => 'ongkoskirimimport__kelancaran', 'value' => $ongkoskirimimport__kelancaran, 'id' => 'ongkoskirimimport__kelancaran'));?></td></tr><tr class='basic'>
<td>Kl Min</td><td><?=form_input(array('name' => 'ongkoskirimimport__klmin', 'value' => $ongkoskirimimport__klmin, 'id' => 'ongkoskirimimport__klmin'));?></td></tr><tr class='basic'>
<td>Lift off</td><td><?=form_input(array('name' => 'ongkoskirimimport__liftoff', 'value' => $ongkoskirimimport__liftoff, 'id' => 'ongkoskirimimport__liftoff'));?></td></tr><tr class='basic'>
<td>manifest shanghai</td><td><?=form_input(array('name' => 'ongkoskirimimport__manifestshanghai', 'value' => $ongkoskirimimport__manifestshanghai, 'id' => 'ongkoskirimimport__manifestshanghai'));?></td></tr><tr class='basic'>
<td>Mekanis</td><td><?=form_input(array('name' => 'ongkoskirimimport__mekanis', 'value' => $ongkoskirimimport__mekanis, 'id' => 'ongkoskirimimport__mekanis'));?></td></tr><tr class='basic'>
<td>Meterai dll</td><td><?=form_input(array('name' => 'ongkoskirimimport__materialdll', 'value' => $ongkoskirimimport__materialdll, 'id' => 'ongkoskirimimport__materialdll'));?></td></tr><tr class='basic'>
<td>Ocean Freight</td><td><?=form_input(array('name' => 'ongkoskirimimport__oceanfreight', 'value' => $ongkoskirimimport__oceanfreight, 'id' => 'ongkoskirimimport__oceanfreight'));?></td></tr><tr class='basic'>
<td>Other</td><td><?=form_input(array('name' => 'ongkoskirimimport__other', 'value' => $ongkoskirimimport__other, 'id' => 'ongkoskirimimport__other'));?></td></tr><tr class='basic'>
<td>Penerbitan SPPB</td><td><?=form_input(array('name' => 'ongkoskirimimport__penerbitansppb', 'value' => $ongkoskirimimport__penerbitansppb, 'id' => 'ongkoskirimimport__penerbitansppb'));?></td></tr><tr class='basic'>
<td>Penerbitan SPPB asli Tutup PU</td><td><?=form_input(array('name' => 'ongkoskirimimport__penerbitansppbasli', 'value' => $ongkoskirimimport__penerbitansppbasli, 'id' => 'ongkoskirimimport__penerbitansppbasli'));?></td></tr><tr class='basic'>
<td>Perpanjang Penumpukan</td><td><?=form_input(array('name' => 'ongkoskirimimport__perpanjangpenumpukan', 'value' => $ongkoskirimimport__perpanjangpenumpukan, 'id' => 'ongkoskirimimport__perpanjangpenumpukan'));?></td></tr><tr class='basic'>
<td>Pick up Shanghai</td><td><?=form_input(array('name' => 'ongkoskirimimport__pickupshanghai', 'value' => $ongkoskirimimport__pickupshanghai, 'id' => 'ongkoskirimimport__pickupshanghai'));?></td></tr><tr class='basic'>
<td>Port Facility</td><td><?=form_input(array('name' => 'ongkoskirimimport__portfacility', 'value' => $ongkoskirimimport__portfacility, 'id' => 'ongkoskirimimport__portfacility'));?></td></tr><tr class='basic'>
<td>PPH %</td><td><?=form_input(array('name' => 'ongkoskirimimport__pph', 'value' => $ongkoskirimimport__pph, 'id' => 'ongkoskirimimport__pph'));?></td></tr><tr class='basic'>
<td>PPN</td><td><?=form_input(array('name' => 'ongkoskirimimport__ppn', 'value' => $ongkoskirimimport__ppn, 'id' => 'ongkoskirimimport__ppn'));?></td></tr><tr class='basic'>
<td>PPN Handling</td><td><?=form_input(array('name' => 'ongkoskirimimport__ppnhandling', 'value' => $ongkoskirimimport__ppnhandling, 'id' => 'ongkoskirimimport__ppnhandling'));?></td></tr><tr class='basic'>
<td>PPN Kredit</td><td><?=form_input(array('name' => 'ongkoskirimimport__ppncredit', 'value' => $ongkoskirimimport__ppncredit, 'id' => 'ongkoskirimimport__ppncredit'));?></td></tr><tr class='basic'>
<td>Receiving</td><td><?=form_input(array('name' => 'ongkoskirimimport__receiving', 'value' => $ongkoskirimimport__receiving, 'id' => 'ongkoskirimimport__receiving'));?></td></tr><tr class='basic'>
<td>Repair</td><td><?=form_input(array('name' => 'ongkoskirimimport__repair', 'value' => $ongkoskirimimport__repair, 'id' => 'ongkoskirimimport__repair'));?></td></tr><tr class='basic'>
<td>Shanghai warehouse</td><td><?=form_input(array('name' => 'ongkoskirimimport__shanghaiwarehouse', 'value' => $ongkoskirimimport__shanghaiwarehouse, 'id' => 'ongkoskirimimport__shanghaiwarehouse'));?></td></tr><tr class='basic'>
<td>Surat Pengantar  DO</td><td><?=form_input(array('name' => 'ongkoskirimimport__suratpengantardo', 'value' => $ongkoskirimimport__suratpengantardo, 'id' => 'ongkoskirimimport__suratpengantardo'));?></td></tr><tr class='basic'>
<td>Surcharges</td><td><?=form_input(array('name' => 'ongkoskirimimport__surcharges', 'value' => $ongkoskirimimport__surcharges, 'id' => 'ongkoskirimimport__surcharges'));?></td></tr><tr class='basic'>
<td>Surveyor Fee</td><td><?=form_input(array('name' => 'ongkoskirimimport__surveyorfee', 'value' => $ongkoskirimimport__surveyorfee, 'id' => 'ongkoskirimimport__surveyorfee'));?></td></tr><tr class='basic'>
<td>Biaya Lain-lain 1</td><td><?=form_input(array('name' => 'ongkoskirimimport__biayalain1', 'value' => $ongkoskirimimport__biayalain1, 'id' => 'ongkoskirimimport__biayalain1'));?></td></tr><tr class='basic'>
<td>Biaya Lain-lain 2</td><td><?=form_input(array('name' => 'ongkoskirimimport__biayalain2', 'value' => $ongkoskirimimport__biayalain2, 'id' => 'ongkoskirimimport__biayalain2'));?></td></tr><tr class='basic'>
<td>Biaya Lain-lain 3</td><td><?=form_input(array('name' => 'ongkoskirimimport__biayalain3', 'value' => $ongkoskirimimport__biayalain3, 'id' => 'ongkoskirimimport__biayalain3'));?></td></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr><tr class='basic'></tr>

</table>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/ongkos_kirim_importlist";?>'"></input>
<?php endif; ?>
<input type="reset"></input>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>


