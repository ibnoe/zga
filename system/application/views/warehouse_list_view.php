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
					target:        '#warehouselist',
					success: 		warehouseshowResponse,
		}; 
		
		$('#warehouselistform').submit(function() { 
			$('#warehouselistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function warehouseconfirmdelete(delid, obj)
	{
		$('#warehouse-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', warehouseconfirmdelete2(delid, obj));
	}
	
	function warehouseconfirmdelete2(delid, obj)
	{
		$( "#warehouse-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					warehousecalldeletefn('warehousedelete', delid, 'warehouselist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#warehouse-dialog-confirm').html('');
	}
	
	function warehousesortupdown(field, direction)
	{
		$("#warehousecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#warehouselist',
					success: 		warehouseshowResponse,
		}; 
		$('#warehouselistform').ajaxSubmit(options);
		return false;
	}
	
	function warehouseshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#warehouselist',
					success: 		warehouseshowResponse,
		}; 
		
		$('#warehouselistform').submit(function() { 
			$('#warehouselistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function warehousecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function warehouseadd()
	{
		$('#warehouseformholder').load('<?=site_url()."/warehouseadd/";?>', function()
		{$('#warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#warehouseformholder' + '\').html(\'\');' + '$(\'' + '#warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#warehouselist' + '\').load(\'<?=site_url();?>/warehouselist\');' + ';"></input>');
		});	
	}
	
	function warehouseedit(id)
	{
		$('#warehouseformholder').load('<?=site_url()."/warehouseedit/index/";?>' + id, function()
		{$('#warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#warehouseformholder' + '\').html(\'\');' + '$(\'' + '#warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#warehouselist' + '\').load(\'<?=site_url();?>/warehouselist\');' + ';"></input>');
		});	
	}
	
	function warehouseview(id)
	{
		$('#warehouseformholder').load('<?=site_url()."/warehouseview/index/";?>' + id, function()
		{$('#warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#warehouseformholder' + '\').html(\'\');' + '$(\'' + '#warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#warehouselist' + '\').load(\'<?=site_url();?>/warehouselist\');' + ';"></input>');
		});	
	}
	
	function warehousegotopage()
	{
		var page = document.warehouselistform.pageno.options[document.warehouselistform.pageno.selectedIndex].value;
		
		$("#warehousecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#warehouselist',
					success: 		warehouseshowResponse,
		}; 
		$('#warehouselistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="warehouse-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="warehouseclosebutton"></div>
		<div id="warehouseformholder"></div>
		<div id="warehouselist">
		<!--<form method="post" action="<?=site_url();?>/warehouselist/index/" id="warehouselistform" name="warehouselistform">-->
		<form method="post" action="<?=current_url();?>" id="warehouselistform" name="warehouselistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="warehousecurrsort">
			</div>
			<div id="warehousesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="warehouseadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/warehouseadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/warehouseadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="warehousesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="warehousesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="warehousesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="warehousesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/warehouseview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('warehouseview/index/'.$row['id'], $row['warehouse__name']);?></td><td><?=$row['warehouse__address'];?></td><td><?=$row['warehouse__phone'];?></td><td><?=$row['warehouse__fax'];?></td><td><?=$row['warehouse__lastupdate'];?></td><td><?=$row['warehouse__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="warehouseview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/warehouseview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="warehouseedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/warehouseedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="warehouseconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="warehousegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>