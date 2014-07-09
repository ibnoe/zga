<?php include "header.php" ?>

<script type="text/javascript">
$(document).ready(function() {
<?php if (false): ?>
$('#ongkos_kirim_importchildtabs').tabs({ selected: 0});
<?php endif; ?>
});


function ongkos_kirim_importconfirmdelete(delid, obj)
	{
		$('#ongkos_kirim_import-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', ongkos_kirim_importconfirmdelete3(delid, obj));
	}

function ongkos_kirim_importconfirmdelete2(delid, obj)
	{
		$( "#ongkos_kirim_import-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					ongkos_kirim_importcalldeletefn('ongkos_kirim_importdelete', delid, 'ongkos_kirim_importlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#ongkos_kirim_import-dialog-confirm').html('');
	}
	
	function ongkos_kirim_importconfirmdelete3(delid, obj)
	{
		$( "#ongkos_kirim_import-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					ongkos_kirim_importcalldeletefn3('ongkos_kirim_importdelete', delid, 'ongkos_kirim_importlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#ongkos_kirim_import-dialog-confirm').html('');
	}

function ongkos_kirim_importcalldeletefn(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
function ongkos_kirim_importcalldeletefn3(con, id, list)
	{
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){ location.href='<?=site_url();?>'; });
	}
	

	
</script>

<div id="maincontent">

<div id="ongkos_kirim_import-dialog-confirm" title="Delete this item?">
			
</div>

<h3 class="viewtitle">View Ongkos Kirim Import</h3>

<?=form_hidden("ongkos_kirim_import_id", $ongkos_kirim_import_id);?>

<table width="100%" class="viewtable">
<tr class='basic'>
<td>ID</td><td><?=$ongkoskirimimport__idstring;?></td></tr><tr class='basic'>
<td>Adm AWB</td><td><?=number_format($ongkoskirimimport__admawb, 2);?></td></tr><tr class='basic'>
<td>ADM Bank</td><td><?=number_format($ongkoskirimimport__admbank, 2);?></td></tr><tr class='basic'>
<td>Adm Fee</td><td><?=number_format($ongkoskirimimport__admfee, 2);?></td></tr><tr class='basic'>
<td>Adm PIB & PNBP</td><td><?=number_format($ongkoskirimimport__admpib, 2);?></td></tr><tr class='basic'>
<td>Adm PPJK</td><td><?=number_format($ongkoskirimimport__admppjk, 2);?></td></tr><tr class='basic'>
<td>Agency Fee</td><td><?=number_format($ongkoskirimimport__agencyfee, 2);?></td></tr><tr class='basic'>
<td>Angkutan Cengkareng ke Serpong</td><td><?=number_format($ongkoskirimimport__angckgtoserpong, 2);?></td></tr><tr class='basic'>
<td>Angkutan Tj Priok ke Serpong</td><td><?=number_format($ongkoskirimimport__angprioktoserpong, 2);?></td></tr><tr class='basic'>
<td>Asuransi</td><td><?=number_format($ongkoskirimimport__asuransi, 2);?></td></tr><tr class='basic'>
<td>AWB Fee</td><td><?=number_format($ongkoskirimimport__awbfee, 2);?></td></tr><tr class='basic'>
<td>B/L Fee</td><td><?=number_format($ongkoskirimimport__blfee, 2);?></td></tr><tr class='basic'>
<td>Bahandle</td><td><?=number_format($ongkoskirimimport__bahandle, 2);?></td></tr><tr class='basic'>
<td>Biaya Freight</td><td><?=number_format($ongkoskirimimport__biayafreight, 2);?></td></tr><tr class='basic'>
<td>Biaya PNBP</td><td><?=number_format($ongkoskirimimport__biayapnbp, 2);?></td></tr><tr class='basic'>
<td>Biaya Provisi L/C</td><td><?=number_format($ongkoskirimimport__biayaprovisilc, 2);?></td></tr><tr class='basic'>
<td>BM</td><td><?=number_format($ongkoskirimimport__bm, 2);?></td></tr><tr class='basic'>
<td>Breakbluk Manifest</td><td><?=number_format($ongkoskirimimport__breakbulkmanifest, 2);?></td></tr><tr class='basic'>
<td>By EDI</td><td><?=number_format($ongkoskirimimport__byedi, 2);?></td></tr><tr class='basic'>
<td>By INSW NPIK</td><td><?=number_format($ongkoskirimimport__byinswnpik, 2);?></td></tr><tr class='basic'>
<td>By Penumpukan</td><td><?=number_format($ongkoskirimimport__bypenumpukan, 2);?></td></tr><tr class='basic'>
<td>By Rekomendasi IT</td><td><?=number_format($ongkoskirimimport__byrekomendasiit, 2);?></td></tr><tr class='basic'>
<td>By Transfer PIB</td><td><?=number_format($ongkoskirimimport__bytransferpib, 2);?></td></tr><tr class='basic'>
<td>CAF (currency adjustment factor)</td><td><?=number_format($ongkoskirimimport__caf, 2);?></td></tr><tr class='basic'>
<td>CFS Charge</td><td><?=number_format($ongkoskirimimport__cfscharge, 2);?></td></tr><tr class='basic'>
<td>Custom clearance at shanghai</td><td><?=number_format($ongkoskirimimport__customclearanceshanghai, 2);?></td></tr><tr class='basic'>
<td>Demurrage</td><td><?=number_format($ongkoskirimimport__demurrage, 2);?></td></tr><tr class='basic'>
<td>Denda ADM Pabean</td><td><?=number_format($ongkoskirimimport__dendaadmpabean, 2);?></td></tr><tr class='basic'>
<td>Devanning Charges</td><td><?=number_format($ongkoskirimimport__devanningcharges, 2);?></td></tr><tr class='basic'>
<td>Doc Fee</td><td><?=number_format($ongkoskirimimport__docfee, 2);?></td></tr><tr class='basic'>
<td>DOC shanghai</td><td><?=number_format($ongkoskirimimport__docshanghai, 2);?></td></tr><tr class='basic'>
<td>Forwarding charges</td><td><?=number_format($ongkoskirimimport__forwardingcharges, 2);?></td></tr><tr class='basic'>
<td>Foto u/ Bea Cukai</td><td><?=number_format($ongkoskirimimport__fotountukbeacukai, 2);?></td></tr><tr class='basic'>
<td>Gerakan</td><td><?=number_format($ongkoskirimimport__gerakan, 2);?></td></tr><tr class='basic'>
<td>Handling Fee</td><td><?=number_format($ongkoskirimimport__handlingfee, 2);?></td></tr><tr class='basic'>
<td>Jalur kuning adm doc</td><td><?=number_format($ongkoskirimimport__jalurkuningadmdoc, 2);?></td></tr><tr class='basic'>
<td>Jasa PPJK</td><td><?=number_format($ongkoskirimimport__jasappjk, 2);?></td></tr><tr class='basic'>
<td>Kelancaran</td><td><?=number_format($ongkoskirimimport__kelancaran, 2);?></td></tr><tr class='basic'>
<td>Kl Min</td><td><?=number_format($ongkoskirimimport__klmin, 2);?></td></tr><tr class='basic'>
<td>Lift off</td><td><?=number_format($ongkoskirimimport__liftoff, 2);?></td></tr><tr class='basic'>
<td>manifest shanghai</td><td><?=number_format($ongkoskirimimport__manifestshanghai, 2);?></td></tr><tr class='basic'>
<td>Mekanis</td><td><?=number_format($ongkoskirimimport__mekanis, 2);?></td></tr><tr class='basic'>
<td>Meterai dll</td><td><?=number_format($ongkoskirimimport__materialdll, 2);?></td></tr><tr class='basic'>
<td>Ocean Freight</td><td><?=number_format($ongkoskirimimport__oceanfreight, 2);?></td></tr><tr class='basic'>
<td>Other</td><td><?=number_format($ongkoskirimimport__other, 2);?></td></tr><tr class='basic'>
<td>Penerbitan SPPB</td><td><?=number_format($ongkoskirimimport__penerbitansppb, 2);?></td></tr><tr class='basic'>
<td>Penerbitan SPPB asli Tutup PU</td><td><?=number_format($ongkoskirimimport__penerbitansppbasli, 2);?></td></tr><tr class='basic'>
<td>Perpanjang Penumpukan</td><td><?=number_format($ongkoskirimimport__perpanjangpenumpukan, 2);?></td></tr><tr class='basic'>
<td>Pick up Shanghai</td><td><?=number_format($ongkoskirimimport__pickupshanghai, 2);?></td></tr><tr class='basic'>
<td>Port Facility</td><td><?=number_format($ongkoskirimimport__portfacility, 2);?></td></tr><tr class='basic'>
<td>PPH %</td><td><?=number_format($ongkoskirimimport__pph, 2);?></td></tr><tr class='basic'>
<td>PPN</td><td><?=number_format($ongkoskirimimport__ppn, 2);?></td></tr><tr class='basic'>
<td>PPN Handling</td><td><?=number_format($ongkoskirimimport__ppnhandling, 2);?></td></tr><tr class='basic'>
<td>PPN Kredit</td><td><?=number_format($ongkoskirimimport__ppncredit, 2);?></td></tr><tr class='basic'>
<td>Receiving</td><td><?=number_format($ongkoskirimimport__receiving, 2);?></td></tr><tr class='basic'>
<td>Repair</td><td><?=number_format($ongkoskirimimport__repair, 2);?></td></tr><tr class='basic'>
<td>Shanghai warehouse</td><td><?=number_format($ongkoskirimimport__shanghaiwarehouse, 2);?></td></tr><tr class='basic'>
<td>Surat Pengantar  DO</td><td><?=number_format($ongkoskirimimport__suratpengantardo, 2);?></td></tr><tr class='basic'>
<td>Surcharges</td><td><?=number_format($ongkoskirimimport__surcharges, 2);?></td></tr><tr class='basic'>
<td>Surveyor Fee</td><td><?=number_format($ongkoskirimimport__surveyorfee, 2);?></td></tr><tr class='basic'>
<td>Biaya Lain-lain 1</td><td><?=number_format($ongkoskirimimport__biayalain1, 2);?></td></tr><tr class='basic'>
<td>Biaya Lain-lain 2</td><td><?=number_format($ongkoskirimimport__biayalain2, 2);?></td></tr><tr class='basic'>
<td>Biaya Lain-lain 3</td><td><?=number_format($ongkoskirimimport__biayalain3, 2);?></td></tr><tr class='basic'>
<td>Total</td><td><?=number_format($ongkoskirimimport__total, 2);?></td></tr><tr class='basic'>
<td>Last Update</td><td><?=$ongkoskirimimport__lastupdate;?></td></tr><tr class='basic'>
<td>Last Update By</td><td><?=$ongkoskirimimport__updatedby;?></td></tr><tr class='basic'>
<td>Created</td><td><?=$ongkoskirimimport__created;?></td></tr><tr class='basic'>
<td>Created By</td><td><?=$ongkoskirimimport__createdby;?></td></tr>

</table>

<br>
<div id="ongkos_kirim_importbuttons">
<table align="center" class="viewtablebutton">
<tr>
<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/ongkos_kirim_importedit/index/".$ongkos_kirim_import_id;?>'"></td>
<td class="delete"><input class="button" type="button" value="Delete" onclick="ongkos_kirim_importconfirmdelete(<?=$ongkos_kirim_import_id;?>, this);"></td>
<!--print button-->
</tr>
</table>
</div>
<br>

<div id="ongkos_kirim_importchildtabs">
	
	

</div>

<p>
<?php if (false): ?>
<input type="button" value="Back" onclick="location.href='<?=site_url()."/main/index/ongkos_kirim_importlist";?>'"></input>
<?php endif; ?>
</p>

</div>

<?php include 'footer.php'; ?>
