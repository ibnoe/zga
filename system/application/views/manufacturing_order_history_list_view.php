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
					target:        '#manufacturing_order_historylist',
					success: 		manufacturing_order_historyshowResponse,
		}; 
		
		$('#manufacturing_order_historylistform').submit(function() { 
			$('#manufacturing_order_historylistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function manufacturing_order_historyconfirmdelete(delid, obj)
	{
		$('#manufacturing_order_history-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_order_historyconfirmdelete2(delid, obj));
	}
	
	function manufacturing_order_historyconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_order_history-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_order_historycalldeletefn('manufacturing_order_historydelete', delid, 'manufacturing_order_historylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_order_history-dialog-confirm').html('');
	}
	
	function manufacturing_order_historysortupdown(field, direction)
	{
		$("#manufacturing_order_historycurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#manufacturing_order_historylist',
					success: 		manufacturing_order_historyshowResponse,
		}; 
		$('#manufacturing_order_historylistform').ajaxSubmit(options);
		return false;
	}
	
	function manufacturing_order_historyshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#manufacturing_order_historylist',
					success: 		manufacturing_order_historyshowResponse,
		}; 
		
		$('#manufacturing_order_historylistform').submit(function() { 
			$('#manufacturing_order_historylistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function manufacturing_order_historycalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function manufacturing_order_historyadd()
	{
		$('#manufacturing_order_historyformholder').load('<?=site_url()."/manufacturing_order_historyadd/";?>', function()
		{$('#manufacturing_order_historyclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_historyformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_historyclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_historylist' + '\').load(\'<?=site_url();?>/manufacturing_order_historylist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_historyedit(id)
	{
		$('#manufacturing_order_historyformholder').load('<?=site_url()."/manufacturing_order_historyedit/index/";?>' + id, function()
		{$('#manufacturing_order_historyclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_historyformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_historyclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_historylist' + '\').load(\'<?=site_url();?>/manufacturing_order_historylist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_historyview(id)
	{
		$('#manufacturing_order_historyformholder').load('<?=site_url()."/manufacturing_order_historyview/index/";?>' + id, function()
		{$('#manufacturing_order_historyclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_order_historyformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_historyclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_order_historylist' + '\').load(\'<?=site_url();?>/manufacturing_order_historylist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_order_historygotopage()
	{
		var page = document.manufacturing_order_historylistform.pageno.options[document.manufacturing_order_historylistform.pageno.selectedIndex].value;
		
		$("#manufacturing_order_historycurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#manufacturing_order_historylist',
					success: 		manufacturing_order_historyshowResponse,
		}; 
		$('#manufacturing_order_historylistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="manufacturing_order_history-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="manufacturing_order_historyclosebutton"></div>
		<div id="manufacturing_order_historyformholder"></div>
		<div id="manufacturing_order_historylist">
		<!--<form method="post" action="<?=site_url();?>/manufacturing_order_historylist/index/" id="manufacturing_order_historylistform" name="manufacturing_order_historylistform">-->
		<form method="post" action="<?=current_url();?>" id="manufacturing_order_historylistform" name="manufacturing_order_historylistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="manufacturing_order_historycurrsort">
			</div>
			<div id="manufacturing_order_historysort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="manufacturing_order_historyadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_order_historyadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_order_historyadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				
				<th></th>
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
									echo '<a href="#" class="updown" onclick="manufacturing_order_historysortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="manufacturing_order_historysortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="manufacturing_order_historysortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="manufacturing_order_historysortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/manufacturing_order_historyview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('manufacturing_order_historyview/index/'.$row['id'], $row['manufacturingorderdone__idstring']);?></td><td><?=$row['manufacturingorderdone__date'];?></td><td><?=$row['manufacturingorderdone__notes'];?></td><td><?=$row['manufacturingorderdone__lastupdate'];?></td><td><?=$row['manufacturingorderdone__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="manufacturing_order_historyview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/manufacturing_order_historyview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="manufacturing_order_historyedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_order_historyedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_order_historyconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="manufacturing_order_historygotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>