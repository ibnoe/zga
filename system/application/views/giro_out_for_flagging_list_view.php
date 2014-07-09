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
					target:        '#giro_out_for_flagginglist',
					success: 		giro_out_for_flaggingshowResponse,
		}; 
		
		$('#giro_out_for_flagginglistform').submit(function() { 
			$('#giro_out_for_flagginglistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function giro_out_for_flaggingconfirmdelete(delid, obj)
	{
		$('#giro_out_for_flagging-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_out_for_flaggingconfirmdelete2(delid, obj));
	}
	
	function giro_out_for_flaggingconfirmdelete2(delid, obj)
	{
		$( "#giro_out_for_flagging-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_out_for_flaggingcalldeletefn('giro_out_for_flaggingdelete', delid, 'giro_out_for_flagginglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out_for_flagging-dialog-confirm').html('');
	}
	
	function giro_out_for_flaggingsortupdown(field, direction)
	{
		$("#giro_out_for_flaggingcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#giro_out_for_flagginglist',
					success: 		giro_out_for_flaggingshowResponse,
		}; 
		$('#giro_out_for_flagginglistform').ajaxSubmit(options);
		return false;
	}
	
	function giro_out_for_flaggingshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#giro_out_for_flagginglist',
					success: 		giro_out_for_flaggingshowResponse,
		}; 
		
		$('#giro_out_for_flagginglistform').submit(function() { 
			$('#giro_out_for_flagginglistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function giro_out_for_flaggingcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function giro_out_for_flaggingadd()
	{
		$('#giro_out_for_flaggingformholder').load('<?=site_url()."/giro_out_for_flaggingadd/";?>', function()
		{$('#giro_out_for_flaggingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_out_for_flaggingformholder' + '\').html(\'\');' + '$(\'' + '#giro_out_for_flaggingclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_out_for_flagginglist' + '\').load(\'<?=site_url();?>/giro_out_for_flagginglist\');' + ';"></input>');
		});	
	}
	
	function giro_out_for_flaggingedit(id)
	{
		$('#giro_out_for_flaggingformholder').load('<?=site_url()."/giro_out_for_flaggingedit/index/";?>' + id, function()
		{$('#giro_out_for_flaggingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_out_for_flaggingformholder' + '\').html(\'\');' + '$(\'' + '#giro_out_for_flaggingclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_out_for_flagginglist' + '\').load(\'<?=site_url();?>/giro_out_for_flagginglist\');' + ';"></input>');
		});	
	}
	
	function giro_out_for_flaggingview(id)
	{
		$('#giro_out_for_flaggingformholder').load('<?=site_url()."/giro_out_for_flaggingview/index/";?>' + id, function()
		{$('#giro_out_for_flaggingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_out_for_flaggingformholder' + '\').html(\'\');' + '$(\'' + '#giro_out_for_flaggingclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_out_for_flagginglist' + '\').load(\'<?=site_url();?>/giro_out_for_flagginglist\');' + ';"></input>');
		});	
	}
	
	function giro_out_for_flagginggotopage()
	{
		var page = document.giro_out_for_flagginglistform.pageno.options[document.giro_out_for_flagginglistform.pageno.selectedIndex].value;
		
		$("#giro_out_for_flaggingcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#giro_out_for_flagginglist',
					success: 		giro_out_for_flaggingshowResponse,
		}; 
		$('#giro_out_for_flagginglistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="giro_out_for_flagging-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="giro_out_for_flaggingclosebutton"></div>
		<div id="giro_out_for_flaggingformholder"></div>
		<div id="giro_out_for_flagginglist">
		<!--<form method="post" action="<?=site_url();?>/giro_out_for_flagginglist/index/" id="giro_out_for_flagginglistform" name="giro_out_for_flagginglistform">-->
		<form method="post" action="<?=current_url();?>" id="giro_out_for_flagginglistform" name="giro_out_for_flagginglistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="giro_out_for_flaggingcurrsort">
			</div>
			<div id="giro_out_for_flaggingsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="giro_out_for_flaggingadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_out_for_flaggingadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_out_for_flaggingadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="giro_out_for_flaggingsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="giro_out_for_flaggingsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="giro_out_for_flaggingsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="giro_out_for_flaggingsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
						<!--<td class="view"><input class="button" type="button" value="View" onclick="giro_out_for_flaggingview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/giro_out_for_flaggingview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="giro_out_for_flaggingedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_out_for_flaggingedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_out_for_flaggingconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="giro_out_for_flagginggotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#mark_as_used').click(function(){var data = $('#giro_out_for_flagginglistform').serialize();$.ajax({type: 'POST',url: '<?=site_url();?>/giroout_usedflag',data: data,success: function (resp) {var options = { 	target:        '#giro_out_for_flagginglist',	success: 		giro_out_for_flaggingshowResponse,}; $('#giro_out_for_flagginglistform').ajaxSubmit(options);},});});});</script><input id='mark_as_used' type="submit" value="Mark As Used">
			
		</form>
		</div>