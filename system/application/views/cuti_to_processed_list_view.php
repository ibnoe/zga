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
					target:        '#cuti_to_processedlist',
					success: 		cuti_to_processedshowResponse,
		}; 
		
		$('#cuti_to_processedlistform').submit(function() { 
			$('#cuti_to_processedlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function cuti_to_processedconfirmdelete(delid, obj)
	{
		$('#cuti_to_processed-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', cuti_to_processedconfirmdelete2(delid, obj));
	}
	
	function cuti_to_processedconfirmdelete2(delid, obj)
	{
		$( "#cuti_to_processed-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					cuti_to_processedcalldeletefn('cuti_to_processeddelete', delid, 'cuti_to_processedlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#cuti_to_processed-dialog-confirm').html('');
	}
	
	function cuti_to_processedsortupdown(field, direction)
	{
		$("#cuti_to_processedcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#cuti_to_processedlist',
					success: 		cuti_to_processedshowResponse,
		}; 
		$('#cuti_to_processedlistform').ajaxSubmit(options);
		return false;
	}
	
	function cuti_to_processedshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#cuti_to_processedlist',
					success: 		cuti_to_processedshowResponse,
		}; 
		
		$('#cuti_to_processedlistform').submit(function() { 
			$('#cuti_to_processedlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function cuti_to_processedcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function cuti_to_processedadd()
	{
		$('#cuti_to_processedformholder').load('<?=site_url()."/cuti_to_processedadd/";?>', function()
		{$('#cuti_to_processedclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cuti_to_processedformholder' + '\').html(\'\');' + '$(\'' + '#cuti_to_processedclosebutton' + '\').html(\'\');' + '$(\'' + '#cuti_to_processedlist' + '\').load(\'<?=site_url();?>/cuti_to_processedlist\');' + ';"></input>');
		});	
	}
	
	function cuti_to_processededit(id)
	{
		$('#cuti_to_processedformholder').load('<?=site_url()."/cuti_to_processededit/index/";?>' + id, function()
		{$('#cuti_to_processedclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cuti_to_processedformholder' + '\').html(\'\');' + '$(\'' + '#cuti_to_processedclosebutton' + '\').html(\'\');' + '$(\'' + '#cuti_to_processedlist' + '\').load(\'<?=site_url();?>/cuti_to_processedlist\');' + ';"></input>');
		});	
	}
	
	function cuti_to_processedview(id)
	{
		$('#cuti_to_processedformholder').load('<?=site_url()."/cuti_to_processedview/index/";?>' + id, function()
		{$('#cuti_to_processedclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#cuti_to_processedformholder' + '\').html(\'\');' + '$(\'' + '#cuti_to_processedclosebutton' + '\').html(\'\');' + '$(\'' + '#cuti_to_processedlist' + '\').load(\'<?=site_url();?>/cuti_to_processedlist\');' + ';"></input>');
		});	
	}
	
	function cuti_to_processedgotopage()
	{
		var page = document.cuti_to_processedlistform.pageno.options[document.cuti_to_processedlistform.pageno.selectedIndex].value;
		
		$("#cuti_to_processedcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#cuti_to_processedlist',
					success: 		cuti_to_processedshowResponse,
		}; 
		$('#cuti_to_processedlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="cuti_to_processed-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="cuti_to_processedclosebutton"></div>
		<div id="cuti_to_processedformholder"></div>
		<div id="cuti_to_processedlist">
		<!--<form method="post" action="<?=site_url();?>/cuti_to_processedlist/index/" id="cuti_to_processedlistform" name="cuti_to_processedlistform">-->
		<form method="post" action="<?=current_url();?>" id="cuti_to_processedlistform" name="cuti_to_processedlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="cuti_to_processedcurrsort">
			</div>
			<div id="cuti_to_processedsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="cuti_to_processedadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/cuti_to_processedadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/cuti_to_processedadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="cuti_to_processedsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="cuti_to_processedsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="cuti_to_processedsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="cuti_to_processedsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('cutiklaim__id[]', $row['cutiklaim__id'], false);?></td><td><?=$row['cutiklaim__date'];?></td><td><?=number_format($row['cutiklaim__totalcutiklaimed'], 2);?></td><td><?=$row['cutiklaim__notes'];?></td><td><?php if ($row['cutiklaim__processed'] != 0) echo 'V'; else echo '';?></td><td><?=$row['cutiklaim__lastupdate'];?></td><td><?=$row['cutiklaim__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="cuti_to_processedview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/cuti_to_processedview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="cuti_to_processededit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/cuti_to_processededit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="cuti_to_processedconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="cuti_to_processedgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#mark_as_used').click(function(){var data = $('#cuti_to_processedlistform').serialize();$.ajax({type: 'POST',url: '<?=site_url();?>/cutiklaim_processed',data: data,success: function (resp) {var options = { 	target:        '#cuti_to_processedlist',	success: 		cuti_to_processedshowResponse,}; $('#cuti_to_processedlistform').ajaxSubmit(options);},});});});</script><input id='mark_as_used' type="submit" value="Mark As Used">
			
		</form>
		</div>