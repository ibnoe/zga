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
		
		$('.checkall').click(function () { $(this).parents('table.main').find(':checkbox').attr('checked', this.checked); });
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#open_giro_outlist',
					success: 		open_giro_outshowResponse,
		}; 
		
		$('#open_giro_outlistform').submit(function() { 
			$('#open_giro_outlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function open_giro_outconfirmdelete(delid, obj)
	{
		$('#open_giro_out-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_giro_outconfirmdelete2(delid, obj));
	}
	
	function open_giro_outconfirmdelete2(delid, obj)
	{
		$( "#open_giro_out-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_giro_outcalldeletefn('open_giro_outdelete', delid, 'open_giro_outlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_giro_out-dialog-confirm').html('');
	}
	
	function open_giro_outsortupdown(field, direction)
	{
		$("#open_giro_outcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#open_giro_outlist',
					success: 		open_giro_outshowResponse,
		}; 
		$('#open_giro_outlistform').ajaxSubmit(options);
		return false;
	}
	
	function open_giro_outshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#open_giro_outlist',
					success: 		open_giro_outshowResponse,
		}; 
		
		$('#open_giro_outlistform').submit(function() { 
			$('#open_giro_outlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function open_giro_outcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function open_giro_outadd()
	{
		$('#open_giro_outformholder').load('<?=site_url()."/open_giro_outadd/";?>', function()
		{$('#open_giro_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_giro_outformholder' + '\').html(\'\');' + '$(\'' + '#open_giro_outclosebutton' + '\').html(\'\');' + '$(\'' + '#open_giro_outlist' + '\').load(\'<?=site_url();?>/open_giro_outlist\');' + ';"></input>');
		});	
	}
	
	function open_giro_outedit(id)
	{
		$('#open_giro_outformholder').load('<?=site_url()."/open_giro_outedit/index/";?>' + id, function()
		{$('#open_giro_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_giro_outformholder' + '\').html(\'\');' + '$(\'' + '#open_giro_outclosebutton' + '\').html(\'\');' + '$(\'' + '#open_giro_outlist' + '\').load(\'<?=site_url();?>/open_giro_outlist\');' + ';"></input>');
		});	
	}
	
	function open_giro_outview(id)
	{
		$('#open_giro_outformholder').load('<?=site_url()."/open_giro_outview/index/";?>' + id, function()
		{$('#open_giro_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_giro_outformholder' + '\').html(\'\');' + '$(\'' + '#open_giro_outclosebutton' + '\').html(\'\');' + '$(\'' + '#open_giro_outlist' + '\').load(\'<?=site_url();?>/open_giro_outlist\');' + ';"></input>');
		});	
	}
	
	function open_giro_outgotopage()
	{
		var page = document.open_giro_outlistform.pageno.options[document.open_giro_outlistform.pageno.selectedIndex].value;
		
		$("#open_giro_outcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#open_giro_outlist',
					success: 		open_giro_outshowResponse,
		}; 
		$('#open_giro_outlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="open_giro_out-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="open_giro_outclosebutton"></div>
		<div id="open_giro_outformholder"></div>
		<div id="open_giro_outlist">
		<!--<form method="post" action="<?=site_url();?>/open_giro_outlist/index/" id="open_giro_outlistform" name="open_giro_outlistform">-->
		<form method="post" action="<?=current_url();?>" id="open_giro_outlistform" name="open_giro_outlistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#supplierfilter').change(function() { $('#open_giro_outlistform').submit();});});</script>Supplier:&nbsp;<?=form_dropdown('supplier_id', $supplier_opt, $supplier_id, 'id="supplierfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#currencyfilter').change(function() { $('#open_giro_outlistform').submit();});});</script>Currency:&nbsp;<?=form_dropdown('currency_id', $currency_opt, $currency_id, 'id="currencyfilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="open_giro_outcurrsort">
			</div>
			<div id="open_giro_outsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="open_giro_outadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_giro_outadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_giro_outadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				<th><input type='checkbox' class='checkall'></th>
				
				<?php foreach ($fields as $k=>$v): ?>
					<th>
						<?=$v;?><br/>
						<?php if (in_array($k, $sortby))
						{
							$index = array_search($k, $sortby);
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="open_giro_outsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="open_giro_outsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="open_giro_outsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="open_giro_outsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('giroout__id[]', $row['giroout__id'], false);?></td><td><?=$row['giroout__createdate'];?></td><td><?=$row['giroout__girooutid'];?></td><td><?php if (isset($row['giroout__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['giroout__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['giroout__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['giroout__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['giroout__amount'], 2);?></td><td align='right'><?=number_format($row['giroout__amountused'], 2);?></td><td><?php if ($row['giroout__usedflag'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['giroout__lastupdate'];?></td><td><?=$row['giroout__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="open_giro_outview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/open_giro_outview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="open_giro_outedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_giro_outedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="open_giro_outconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="open_giro_outgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#giro_clearance').click(function(){$('#open_giro_outlistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#open_giro_outlistform').attr('action','<?=site_url();?>/giro_out_clearanceadd/index/');});});</script><input id='giro_clearance' type="submit" value="Giro Clearance">
			
		</form>
		</div>