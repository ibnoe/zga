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
					target:        '#tunjangan_kesehatan_to_processlist',
					success: 		tunjangan_kesehatan_to_processshowResponse,
		}; 
		
		$('#tunjangan_kesehatan_to_processlistform').submit(function() { 
			$('#tunjangan_kesehatan_to_processlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function tunjangan_kesehatan_to_processconfirmdelete(delid, obj)
	{
		$('#tunjangan_kesehatan_to_process-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', tunjangan_kesehatan_to_processconfirmdelete2(delid, obj));
	}
	
	function tunjangan_kesehatan_to_processconfirmdelete2(delid, obj)
	{
		$( "#tunjangan_kesehatan_to_process-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					tunjangan_kesehatan_to_processcalldeletefn('tunjangan_kesehatan_to_processdelete', delid, 'tunjangan_kesehatan_to_processlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#tunjangan_kesehatan_to_process-dialog-confirm').html('');
	}
	
	function tunjangan_kesehatan_to_processsortupdown(field, direction)
	{
		$("#tunjangan_kesehatan_to_processcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#tunjangan_kesehatan_to_processlist',
					success: 		tunjangan_kesehatan_to_processshowResponse,
		}; 
		$('#tunjangan_kesehatan_to_processlistform').ajaxSubmit(options);
		return false;
	}
	
	function tunjangan_kesehatan_to_processshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#tunjangan_kesehatan_to_processlist',
					success: 		tunjangan_kesehatan_to_processshowResponse,
		}; 
		
		$('#tunjangan_kesehatan_to_processlistform').submit(function() { 
			$('#tunjangan_kesehatan_to_processlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function tunjangan_kesehatan_to_processcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function tunjangan_kesehatan_to_processadd()
	{
		$('#tunjangan_kesehatan_to_processformholder').load('<?=site_url()."/tunjangan_kesehatan_to_processadd/";?>', function()
		{$('#tunjangan_kesehatan_to_processclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#tunjangan_kesehatan_to_processformholder' + '\').html(\'\');' + '$(\'' + '#tunjangan_kesehatan_to_processclosebutton' + '\').html(\'\');' + '$(\'' + '#tunjangan_kesehatan_to_processlist' + '\').load(\'<?=site_url();?>/tunjangan_kesehatan_to_processlist\');' + ';"></input>');
		});	
	}
	
	function tunjangan_kesehatan_to_processedit(id)
	{
		$('#tunjangan_kesehatan_to_processformholder').load('<?=site_url()."/tunjangan_kesehatan_to_processedit/index/";?>' + id, function()
		{$('#tunjangan_kesehatan_to_processclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#tunjangan_kesehatan_to_processformholder' + '\').html(\'\');' + '$(\'' + '#tunjangan_kesehatan_to_processclosebutton' + '\').html(\'\');' + '$(\'' + '#tunjangan_kesehatan_to_processlist' + '\').load(\'<?=site_url();?>/tunjangan_kesehatan_to_processlist\');' + ';"></input>');
		});	
	}
	
	function tunjangan_kesehatan_to_processview(id)
	{
		$('#tunjangan_kesehatan_to_processformholder').load('<?=site_url()."/tunjangan_kesehatan_to_processview/index/";?>' + id, function()
		{$('#tunjangan_kesehatan_to_processclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#tunjangan_kesehatan_to_processformholder' + '\').html(\'\');' + '$(\'' + '#tunjangan_kesehatan_to_processclosebutton' + '\').html(\'\');' + '$(\'' + '#tunjangan_kesehatan_to_processlist' + '\').load(\'<?=site_url();?>/tunjangan_kesehatan_to_processlist\');' + ';"></input>');
		});	
	}
	
	function tunjangan_kesehatan_to_processgotopage()
	{
		var page = document.tunjangan_kesehatan_to_processlistform.pageno.options[document.tunjangan_kesehatan_to_processlistform.pageno.selectedIndex].value;
		
		$("#tunjangan_kesehatan_to_processcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#tunjangan_kesehatan_to_processlist',
					success: 		tunjangan_kesehatan_to_processshowResponse,
		}; 
		$('#tunjangan_kesehatan_to_processlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="tunjangan_kesehatan_to_process-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="tunjangan_kesehatan_to_processclosebutton"></div>
		<div id="tunjangan_kesehatan_to_processformholder"></div>
		<div id="tunjangan_kesehatan_to_processlist">
		<!--<form method="post" action="<?=site_url();?>/tunjangan_kesehatan_to_processlist/index/" id="tunjangan_kesehatan_to_processlistform" name="tunjangan_kesehatan_to_processlistform">-->
		<form method="post" action="<?=current_url();?>" id="tunjangan_kesehatan_to_processlistform" name="tunjangan_kesehatan_to_processlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="tunjangan_kesehatan_to_processcurrsort">
			</div>
			<div id="tunjangan_kesehatan_to_processsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="tunjangan_kesehatan_to_processadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/tunjangan_kesehatan_to_processadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/tunjangan_kesehatan_to_processadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="tunjangan_kesehatan_to_processsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="tunjangan_kesehatan_to_processsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="tunjangan_kesehatan_to_processsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="tunjangan_kesehatan_to_processsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('tunjangankesehatanusage__id[]', $row['tunjangankesehatanusage__id'], false);?></td><td><?=$row['tunjangankesehatanusage__date'];?></td><td><?=$row['tunjangankesehatanusage__description'];?></td><td align='right'><?=number_format($row['tunjangankesehatanusage__amount'], 2);?></td><td align='right'><?=number_format($row['tunjangankesehatanusage__amountpaid'], 2);?></td><td><?=$row['tunjangankesehatanusage__notes'];?></td><td><?php if ($row['tunjangankesehatanusage__processed'] != 0) echo 'V'; else echo '';?></td><td><?=$row['tunjangankesehatanusage__lastupdate'];?></td><td><?=$row['tunjangankesehatanusage__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="tunjangan_kesehatan_to_processview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/tunjangan_kesehatan_to_processview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="tunjangan_kesehatan_to_processedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/tunjangan_kesehatan_to_processedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="tunjangan_kesehatan_to_processconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="tunjangan_kesehatan_to_processgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#already_processed').click(function(){var data = $('#tunjangan_kesehatan_to_processlistform').serialize();$.ajax({type: 'POST',url: '<?=site_url();?>/tunjangankesehatanusage_processed',data: data,success: function (resp) {var options = { 	target:        '#tunjangan_kesehatan_to_processlist',	success: 		tunjangan_kesehatan_to_processshowResponse,}; $('#tunjangan_kesehatan_to_processlistform').ajaxSubmit(options);},});});});</script><input id='already_processed' type="submit" value="Already Processed">
			
		</form>
		</div>