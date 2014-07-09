<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		$('.hidden').hide();
		$('input:reset').button();
		$('input:button').button();
		$('input:submit').button();
		$('input:text').addClass("text ui-widget-content ui-corner-all");
		
		$('form table.main td a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		
		
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#ongkos_kirim_importlist',
					success: 		ongkos_kirim_importshowResponse,
		}; 
		
		$('#ongkos_kirim_importlistform').submit(function() { 
			$('#ongkos_kirim_importlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function ongkos_kirim_importconfirmdelete(delid, obj)
	{
		$('#ongkos_kirim_import-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', ongkos_kirim_importconfirmdelete2(delid, obj));
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
	
	function ongkos_kirim_importsortupdown(field, direction)
	{
		$("#ongkos_kirim_importcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#ongkos_kirim_importlist',
					success: 		ongkos_kirim_importshowResponse,
		}; 
		$('#ongkos_kirim_importlistform').ajaxSubmit(options);
		return false;
	}
	
	function ongkos_kirim_importshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#ongkos_kirim_importlist',
					success: 		ongkos_kirim_importshowResponse,
		}; 
		
		$('#ongkos_kirim_importlistform').submit(function() { 
			$('#ongkos_kirim_importlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function ongkos_kirim_importcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function ongkos_kirim_importadd()
	{
		$('#ongkos_kirim_importformholder').load('<?=site_url()."/ongkos_kirim_importadd/";?>', function()
		{$('#ongkos_kirim_importclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#ongkos_kirim_importformholder' + '\').html(\'\');' + '$(\'' + '#ongkos_kirim_importclosebutton' + '\').html(\'\');' + '$(\'' + '#ongkos_kirim_importlist' + '\').load(\'<?=site_url();?>/ongkos_kirim_importlist\');' + ';"></input>');
		});	
	}
	
	function ongkos_kirim_importedit(id)
	{
		$('#ongkos_kirim_importformholder').load('<?=site_url()."/ongkos_kirim_importedit/index/";?>' + id, function()
		{$('#ongkos_kirim_importclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#ongkos_kirim_importformholder' + '\').html(\'\');' + '$(\'' + '#ongkos_kirim_importclosebutton' + '\').html(\'\');' + '$(\'' + '#ongkos_kirim_importlist' + '\').load(\'<?=site_url();?>/ongkos_kirim_importlist\');' + ';"></input>');
		});	
	}
	
	function ongkos_kirim_importview(id)
	{
		$('#ongkos_kirim_importformholder').load('<?=site_url()."/ongkos_kirim_importview/index/";?>' + id, function()
		{$('#ongkos_kirim_importclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#ongkos_kirim_importformholder' + '\').html(\'\');' + '$(\'' + '#ongkos_kirim_importclosebutton' + '\').html(\'\');' + '$(\'' + '#ongkos_kirim_importlist' + '\').load(\'<?=site_url();?>/ongkos_kirim_importlist\');' + ';"></input>');
		});	
	}
	
	function ongkos_kirim_importgotopage()
	{
		var page = document.ongkos_kirim_importlistform.pageno.options[document.ongkos_kirim_importlistform.pageno.selectedIndex].value;
		
		$("#ongkos_kirim_importcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#ongkos_kirim_importlist',
					success: 		ongkos_kirim_importshowResponse,
		}; 
		$('#ongkos_kirim_importlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="ongkos_kirim_import-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="ongkos_kirim_importclosebutton"></div>
		<div id="ongkos_kirim_importformholder"></div>
		<div id="ongkos_kirim_importlist">
		<!--<form method="post" action="<?=site_url();?>/ongkos_kirim_importlist/index/" id="ongkos_kirim_importlistform" name="ongkos_kirim_importlistform">-->
		<form method="post" action="<?=current_url();?>" id="ongkos_kirim_importlistform" name="ongkos_kirim_importlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="ongkos_kirim_importcurrsort">
			</div>
			<div id="ongkos_kirim_importsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="ongkos_kirim_importadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/ongkos_kirim_importadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/ongkos_kirim_importadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				
				
				<?php foreach ($fields as $k=>$v): ?>
					<th>
						<?=$v;?><br/>
						<?php if (in_array($k, $sortby))
						{
							$index = array_search($k, $sortby);
							if (false)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="ongkos_kirim_importsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="ongkos_kirim_importsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="ongkos_kirim_importsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="ongkos_kirim_importsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
							<?php endif; ?>
						<?php } ?>
					</th>
				<?php endforeach; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				</tr>

				
				<?php foreach ($rows as $row): ?>
					<tr>
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['ongkoskirimimport__idstring'];?></td><td align='right'><?=number_format($row['ongkoskirimimport__admawb'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__admbank'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__admfee'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__admpib'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__admppjk'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__agencyfee'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__angckgtoserpong'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__angprioktoserpong'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__asuransi'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__awbfee'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__blfee'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__bahandle'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__biayafreight'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__biayapnbp'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__biayaprovisilc'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__bm'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__breakbulkmanifest'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__byedi'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__byinswnpik'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__bypenumpukan'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__byrekomendasiit'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__bytransferpib'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__caf'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__cfscharge'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__customclearanceshanghai'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__demurrage'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__dendaadmpabean'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__devanningcharges'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__docfee'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__docshanghai'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__forwardingcharges'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__fotountukbeacukai'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__gerakan'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__handlingfee'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__jalurkuningadmdoc'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__jasappjk'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__kelancaran'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__klmin'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__liftoff'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__manifestshanghai'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__mekanis'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__materialdll'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__oceanfreight'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__other'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__penerbitansppb'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__penerbitansppbasli'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__perpanjangpenumpukan'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__pickupshanghai'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__portfacility'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__pph'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__ppn'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__ppnhandling'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__ppncredit'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__receiving'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__repair'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__shanghaiwarehouse'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__suratpengantardo'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__surcharges'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__surveyorfee'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__biayalain1'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__biayalain2'], 2);?></td><td align='right'><?=number_format($row['ongkoskirimimport__biayalain3'], 2);?></td><td><?=$row['ongkoskirimimport__lastupdate'];?></td><td><?=$row['ongkoskirimimport__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="ongkos_kirim_importview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/ongkos_kirim_importview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="ongkos_kirim_importedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/ongkos_kirim_importedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="ongkos_kirim_importconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="ongkos_kirim_importgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>