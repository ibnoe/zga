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
					target:        '#from_warehouselist',
					success: 		from_warehouseshowResponse,
		}; 
		
		$('#from_warehouselistform').submit(function() { 
			$('#from_warehouselistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function from_warehouseconfirmdelete(delid, obj)
	{
		$('#from_warehouse-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', from_warehouseconfirmdelete2(delid, obj));
	}
	
	function from_warehouseconfirmdelete2(delid, obj)
	{
		$( "#from_warehouse-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					from_warehousecalldeletefn('from_warehousedelete', delid, 'from_warehouselist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#from_warehouse-dialog-confirm').html('');
	}
	
	function from_warehousesortupdown(field, direction)
	{
		$("#from_warehousecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#from_warehouselist',
					success: 		from_warehouseshowResponse,
		}; 
		$('#from_warehouselistform').ajaxSubmit(options);
		return false;
	}
	
	function from_warehouseshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#from_warehouselist',
					success: 		from_warehouseshowResponse,
		}; 
		
		$('#from_warehouselistform').submit(function() { 
			$('#from_warehouselistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function from_warehousecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function from_warehouseadd()
	{
		$('#from_warehouseformholder').load('<?=site_url()."/from_warehouseadd/";?>', function()
		{$('#from_warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#from_warehouseformholder' + '\').html(\'\');' + '$(\'' + '#from_warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#from_warehouselist' + '\').load(\'<?=site_url();?>/from_warehouselist\');' + ';"></input>');
		});	
	}
	
	function from_warehouseedit(id)
	{
		$('#from_warehouseformholder').load('<?=site_url()."/from_warehouseedit/index/";?>' + id, function()
		{$('#from_warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#from_warehouseformholder' + '\').html(\'\');' + '$(\'' + '#from_warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#from_warehouselist' + '\').load(\'<?=site_url();?>/from_warehouselist\');' + ';"></input>');
		});	
	}
	
	function from_warehouseview(id)
	{
		$('#from_warehouseformholder').load('<?=site_url()."/from_warehouseview/index/";?>' + id, function()
		{$('#from_warehouseclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#from_warehouseformholder' + '\').html(\'\');' + '$(\'' + '#from_warehouseclosebutton' + '\').html(\'\');' + '$(\'' + '#from_warehouselist' + '\').load(\'<?=site_url();?>/from_warehouselist\');' + ';"></input>');
		});	
	}
	
	function from_warehousegotopage()
	{
		var page = document.from_warehouselistform.pageno.options[document.from_warehouselistform.pageno.selectedIndex].value;
		
		$("#from_warehousecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#from_warehouselist',
					success: 		from_warehouseshowResponse,
		}; 
		$('#from_warehouselistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="from_warehouse-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="from_warehouseclosebutton"></div>
		<div id="from_warehouseformholder"></div>
		<div id="from_warehouselist">
		<!--<form method="post" action="<?=site_url();?>/from_warehouselist/index/" id="from_warehouselistform" name="from_warehouselistform">-->
		<form method="post" action="<?=current_url();?>" id="from_warehouselistform" name="from_warehouselistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="from_warehousecurrsort">
			</div>
			<div id="from_warehousesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="from_warehouseadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/from_warehouseadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/from_warehouseadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="from_warehousesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="from_warehousesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="from_warehousesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="from_warehousesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/from_warehouseview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('from_warehouseview/index/'.$row['id'], $row['warehouse__name']);?></td><td><?=$row['warehouse__address'];?></td><td><?=$row['warehouse__phone'];?></td><td><?=$row['warehouse__fax'];?></td><td><?=$row['warehouse__lastupdate'];?></td><td><?=$row['warehouse__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="from_warehouseview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/from_warehouseview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="from_warehouseedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/from_warehouseedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="from_warehouseconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="from_warehousegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>