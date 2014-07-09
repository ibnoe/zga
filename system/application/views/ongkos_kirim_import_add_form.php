<?php include "header.php" ?>

<script type="text/javascript">
  $(document).ready(function() {
    var options = { 
			target:        '#ongkos_kirim_importoutput',
			success: 		function(data) { if (data.indexOf('success') != -1) location.href='<?=site_url();?>/ongkos_kirim_importview/index/' },
		}; 
		
		$('#ongkos_kirim_importform').click(function(){$('#ongkos_kirim_importform').ajaxForm(options);});
	
  });
  </script>

<div id="maincontent">
  
<h3 class="addtitle">New Ongkos Kirim Import</h3>

<p>
<div id="ongkos_kirim_importoutput"></div>
</p>

<form method="post" action="<?=site_url();?>/ongkos_kirim_importadd/submit" id="ongkos_kirim_importform" class="addform">

<table width="100%" class="addtable">

<tr class='basic'>
<td>ID *</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__idstring', 'value' => $ongkoskirimimport__idstring, 'class' => 'basic', 'id' => 'ongkoskirimimport__idstring'));?></td></tr>
<tr class='basic'>
<td>Adm AWB</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__admawb', 'value' => $ongkoskirimimport__admawb, 'class' => 'basic', 'id' => 'ongkoskirimimport__admawb'));?></td></tr>
<tr class='basic'>
<td>ADM Bank</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__admbank', 'value' => $ongkoskirimimport__admbank, 'class' => 'basic', 'id' => 'ongkoskirimimport__admbank'));?></td></tr>
<tr class='basic'>
<td>Adm Fee</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__admfee', 'value' => $ongkoskirimimport__admfee, 'class' => 'basic', 'id' => 'ongkoskirimimport__admfee'));?></td></tr>
<tr class='basic'>
<td>Adm PIB & PNBP</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__admpib', 'value' => $ongkoskirimimport__admpib, 'class' => 'basic', 'id' => 'ongkoskirimimport__admpib'));?></td></tr>
<tr class='basic'>
<td>Adm PPJK</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__admppjk', 'value' => $ongkoskirimimport__admppjk, 'class' => 'basic', 'id' => 'ongkoskirimimport__admppjk'));?></td></tr>
<tr class='basic'>
<td>Agency Fee</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__agencyfee', 'value' => $ongkoskirimimport__agencyfee, 'class' => 'basic', 'id' => 'ongkoskirimimport__agencyfee'));?></td></tr>
<tr class='basic'>
<td>Angkutan Cengkareng ke Serpong</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__angckgtoserpong', 'value' => $ongkoskirimimport__angckgtoserpong, 'class' => 'basic', 'id' => 'ongkoskirimimport__angckgtoserpong'));?></td></tr>
<tr class='basic'>
<td>Angkutan Tj Priok ke Serpong</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__angprioktoserpong', 'value' => $ongkoskirimimport__angprioktoserpong, 'class' => 'basic', 'id' => 'ongkoskirimimport__angprioktoserpong'));?></td></tr>
<tr class='basic'>
<td>Asuransi</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__asuransi', 'value' => $ongkoskirimimport__asuransi, 'class' => 'basic', 'id' => 'ongkoskirimimport__asuransi'));?></td></tr>
<tr class='basic'>
<td>AWB Fee</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__awbfee', 'value' => $ongkoskirimimport__awbfee, 'class' => 'basic', 'id' => 'ongkoskirimimport__awbfee'));?></td></tr>
<tr class='basic'>
<td>B/L Fee</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__blfee', 'value' => $ongkoskirimimport__blfee, 'class' => 'basic', 'id' => 'ongkoskirimimport__blfee'));?></td></tr>
<tr class='basic'>
<td>Bahandle</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__bahandle', 'value' => $ongkoskirimimport__bahandle, 'class' => 'basic', 'id' => 'ongkoskirimimport__bahandle'));?></td></tr>
<tr class='basic'>
<td>Biaya Freight</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__biayafreight', 'value' => $ongkoskirimimport__biayafreight, 'class' => 'basic', 'id' => 'ongkoskirimimport__biayafreight'));?></td></tr>
<tr class='basic'>
<td>Biaya PNBP</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__biayapnbp', 'value' => $ongkoskirimimport__biayapnbp, 'class' => 'basic', 'id' => 'ongkoskirimimport__biayapnbp'));?></td></tr>
<tr class='basic'>
<td>Biaya Provisi L/C</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__biayaprovisilc', 'value' => $ongkoskirimimport__biayaprovisilc, 'class' => 'basic', 'id' => 'ongkoskirimimport__biayaprovisilc'));?></td></tr>
<tr class='basic'>
<td>BM</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__bm', 'value' => $ongkoskirimimport__bm, 'class' => 'basic', 'id' => 'ongkoskirimimport__bm'));?></td></tr>
<tr class='basic'>
<td>Breakbluk Manifest</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__breakbulkmanifest', 'value' => $ongkoskirimimport__breakbulkmanifest, 'class' => 'basic', 'id' => 'ongkoskirimimport__breakbulkmanifest'));?></td></tr>
<tr class='basic'>
<td>By EDI</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__byedi', 'value' => $ongkoskirimimport__byedi, 'class' => 'basic', 'id' => 'ongkoskirimimport__byedi'));?></td></tr>
<tr class='basic'>
<td>By INSW NPIK</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__byinswnpik', 'value' => $ongkoskirimimport__byinswnpik, 'class' => 'basic', 'id' => 'ongkoskirimimport__byinswnpik'));?></td></tr>
<tr class='basic'>
<td>By Penumpukan</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__bypenumpukan', 'value' => $ongkoskirimimport__bypenumpukan, 'class' => 'basic', 'id' => 'ongkoskirimimport__bypenumpukan'));?></td></tr>
<tr class='basic'>
<td>By Rekomendasi IT</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__byrekomendasiit', 'value' => $ongkoskirimimport__byrekomendasiit, 'class' => 'basic', 'id' => 'ongkoskirimimport__byrekomendasiit'));?></td></tr>
<tr class='basic'>
<td>By Transfer PIB</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__bytransferpib', 'value' => $ongkoskirimimport__bytransferpib, 'class' => 'basic', 'id' => 'ongkoskirimimport__bytransferpib'));?></td></tr>
<tr class='basic'>
<td>CAF (currency adjustment factor)</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__caf', 'value' => $ongkoskirimimport__caf, 'class' => 'basic', 'id' => 'ongkoskirimimport__caf'));?></td></tr>
<tr class='basic'>
<td>CFS Charge</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__cfscharge', 'value' => $ongkoskirimimport__cfscharge, 'class' => 'basic', 'id' => 'ongkoskirimimport__cfscharge'));?></td></tr>
<tr class='basic'>
<td>Custom clearance at shanghai</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__customclearanceshanghai', 'value' => $ongkoskirimimport__customclearanceshanghai, 'class' => 'basic', 'id' => 'ongkoskirimimport__customclearanceshanghai'));?></td></tr>
<tr class='basic'>
<td>Demurrage</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__demurrage', 'value' => $ongkoskirimimport__demurrage, 'class' => 'basic', 'id' => 'ongkoskirimimport__demurrage'));?></td></tr>
<tr class='basic'>
<td>Denda ADM Pabean</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__dendaadmpabean', 'value' => $ongkoskirimimport__dendaadmpabean, 'class' => 'basic', 'id' => 'ongkoskirimimport__dendaadmpabean'));?></td></tr>
<tr class='basic'>
<td>Devanning Charges</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__devanningcharges', 'value' => $ongkoskirimimport__devanningcharges, 'class' => 'basic', 'id' => 'ongkoskirimimport__devanningcharges'));?></td></tr>
<tr class='basic'>
<td>Doc Fee</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__docfee', 'value' => $ongkoskirimimport__docfee, 'class' => 'basic', 'id' => 'ongkoskirimimport__docfee'));?></td></tr>
<tr class='basic'>
<td>DOC shanghai</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__docshanghai', 'value' => $ongkoskirimimport__docshanghai, 'class' => 'basic', 'id' => 'ongkoskirimimport__docshanghai'));?></td></tr>
<tr class='basic'>
<td>Forwarding charges</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__forwardingcharges', 'value' => $ongkoskirimimport__forwardingcharges, 'class' => 'basic', 'id' => 'ongkoskirimimport__forwardingcharges'));?></td></tr>
<tr class='basic'>
<td>Foto u/ Bea Cukai</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__fotountukbeacukai', 'value' => $ongkoskirimimport__fotountukbeacukai, 'class' => 'basic', 'id' => 'ongkoskirimimport__fotountukbeacukai'));?></td></tr>
<tr class='basic'>
<td>Gerakan</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__gerakan', 'value' => $ongkoskirimimport__gerakan, 'class' => 'basic', 'id' => 'ongkoskirimimport__gerakan'));?></td></tr>
<tr class='basic'>
<td>Handling Fee</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__handlingfee', 'value' => $ongkoskirimimport__handlingfee, 'class' => 'basic', 'id' => 'ongkoskirimimport__handlingfee'));?></td></tr>
<tr class='basic'>
<td>Jalur kuning adm doc</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__jalurkuningadmdoc', 'value' => $ongkoskirimimport__jalurkuningadmdoc, 'class' => 'basic', 'id' => 'ongkoskirimimport__jalurkuningadmdoc'));?></td></tr>
<tr class='basic'>
<td>Jasa PPJK</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__jasappjk', 'value' => $ongkoskirimimport__jasappjk, 'class' => 'basic', 'id' => 'ongkoskirimimport__jasappjk'));?></td></tr>
<tr class='basic'>
<td>Kelancaran</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__kelancaran', 'value' => $ongkoskirimimport__kelancaran, 'class' => 'basic', 'id' => 'ongkoskirimimport__kelancaran'));?></td></tr>
<tr class='basic'>
<td>Kl Min</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__klmin', 'value' => $ongkoskirimimport__klmin, 'class' => 'basic', 'id' => 'ongkoskirimimport__klmin'));?></td></tr>
<tr class='basic'>
<td>Lift off</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__liftoff', 'value' => $ongkoskirimimport__liftoff, 'class' => 'basic', 'id' => 'ongkoskirimimport__liftoff'));?></td></tr>
<tr class='basic'>
<td>manifest shanghai</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__manifestshanghai', 'value' => $ongkoskirimimport__manifestshanghai, 'class' => 'basic', 'id' => 'ongkoskirimimport__manifestshanghai'));?></td></tr>
<tr class='basic'>
<td>Mekanis</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__mekanis', 'value' => $ongkoskirimimport__mekanis, 'class' => 'basic', 'id' => 'ongkoskirimimport__mekanis'));?></td></tr>
<tr class='basic'>
<td>Meterai dll</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__materialdll', 'value' => $ongkoskirimimport__materialdll, 'class' => 'basic', 'id' => 'ongkoskirimimport__materialdll'));?></td></tr>
<tr class='basic'>
<td>Ocean Freight</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__oceanfreight', 'value' => $ongkoskirimimport__oceanfreight, 'class' => 'basic', 'id' => 'ongkoskirimimport__oceanfreight'));?></td></tr>
<tr class='basic'>
<td>Other</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__other', 'value' => $ongkoskirimimport__other, 'class' => 'basic', 'id' => 'ongkoskirimimport__other'));?></td></tr>
<tr class='basic'>
<td>Penerbitan SPPB</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__penerbitansppb', 'value' => $ongkoskirimimport__penerbitansppb, 'class' => 'basic', 'id' => 'ongkoskirimimport__penerbitansppb'));?></td></tr>
<tr class='basic'>
<td>Penerbitan SPPB asli Tutup PU</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__penerbitansppbasli', 'value' => $ongkoskirimimport__penerbitansppbasli, 'class' => 'basic', 'id' => 'ongkoskirimimport__penerbitansppbasli'));?></td></tr>
<tr class='basic'>
<td>Perpanjang Penumpukan</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__perpanjangpenumpukan', 'value' => $ongkoskirimimport__perpanjangpenumpukan, 'class' => 'basic', 'id' => 'ongkoskirimimport__perpanjangpenumpukan'));?></td></tr>
<tr class='basic'>
<td>Pick up Shanghai</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__pickupshanghai', 'value' => $ongkoskirimimport__pickupshanghai, 'class' => 'basic', 'id' => 'ongkoskirimimport__pickupshanghai'));?></td></tr>
<tr class='basic'>
<td>Port Facility</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__portfacility', 'value' => $ongkoskirimimport__portfacility, 'class' => 'basic', 'id' => 'ongkoskirimimport__portfacility'));?></td></tr>
<tr class='basic'>
<td>PPH %</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__pph', 'value' => $ongkoskirimimport__pph, 'class' => 'basic', 'id' => 'ongkoskirimimport__pph'));?></td></tr>
<tr class='basic'>
<td>PPN</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__ppn', 'value' => $ongkoskirimimport__ppn, 'class' => 'basic', 'id' => 'ongkoskirimimport__ppn'));?></td></tr>
<tr class='basic'>
<td>PPN Handling</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__ppnhandling', 'value' => $ongkoskirimimport__ppnhandling, 'class' => 'basic', 'id' => 'ongkoskirimimport__ppnhandling'));?></td></tr>
<tr class='basic'>
<td>PPN Kredit</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__ppncredit', 'value' => $ongkoskirimimport__ppncredit, 'class' => 'basic', 'id' => 'ongkoskirimimport__ppncredit'));?></td></tr>
<tr class='basic'>
<td>Receiving</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__receiving', 'value' => $ongkoskirimimport__receiving, 'class' => 'basic', 'id' => 'ongkoskirimimport__receiving'));?></td></tr>
<tr class='basic'>
<td>Repair</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__repair', 'value' => $ongkoskirimimport__repair, 'class' => 'basic', 'id' => 'ongkoskirimimport__repair'));?></td></tr>
<tr class='basic'>
<td>Shanghai warehouse</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__shanghaiwarehouse', 'value' => $ongkoskirimimport__shanghaiwarehouse, 'class' => 'basic', 'id' => 'ongkoskirimimport__shanghaiwarehouse'));?></td></tr>
<tr class='basic'>
<td>Surat Pengantar  DO</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__suratpengantardo', 'value' => $ongkoskirimimport__suratpengantardo, 'class' => 'basic', 'id' => 'ongkoskirimimport__suratpengantardo'));?></td></tr>
<tr class='basic'>
<td>Surcharges</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__surcharges', 'value' => $ongkoskirimimport__surcharges, 'class' => 'basic', 'id' => 'ongkoskirimimport__surcharges'));?></td></tr>
<tr class='basic'>
<td>Surveyor Fee</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__surveyorfee', 'value' => $ongkoskirimimport__surveyorfee, 'class' => 'basic', 'id' => 'ongkoskirimimport__surveyorfee'));?></td></tr>
<tr class='basic'>
<td>Biaya Lain-lain 1</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__biayalain1', 'value' => $ongkoskirimimport__biayalain1, 'class' => 'basic', 'id' => 'ongkoskirimimport__biayalain1'));?></td></tr>
<tr class='basic'>
<td>Biaya Lain-lain 2</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__biayalain2', 'value' => $ongkoskirimimport__biayalain2, 'class' => 'basic', 'id' => 'ongkoskirimimport__biayalain2'));?></td></tr>
<tr class='basic'>
<td>Biaya Lain-lain 3</td>
<td><?=form_input(array('name' => 'ongkoskirimimport__biayalain3', 'value' => $ongkoskirimimport__biayalain3, 'class' => 'basic', 'id' => 'ongkoskirimimport__biayalain3'));?></td></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>
<tr class='basic'></tr>

</table>



<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/ongkos_kirim_importlist";?>'"></input>
<?php endif; ?>
<?=form_submit('done', 'Done');?>
</p>

</form>

</div>

<?php include 'footer.php'; ?>
