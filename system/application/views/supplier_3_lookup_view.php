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
					target:        '#supplier_3list',
					success: 		supplier_3showResponse,
		}; 
		
		$('#supplier_3listform').submit(function() { 
			$('#supplier_3listform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function supplier_3confirmdelete(delid, obj)
	{
		$('#supplier_3-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', supplier_3confirmdelete2(delid, obj));
	}
	
	function supplier_3confirmdelete2(delid, obj)
	{
		$( "#supplier_3-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					supplier_3calldeletefn('supplier_3delete', delid, 'supplier_3list');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#supplier_3-dialog-confirm').html('');
	}
	
	function supplier_3sortupdown(field, direction)
	{
		$("#supplier_3currsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#supplier_3list',
					success: 		supplier_3showResponse,
		}; 
		$('#supplier_3listform').ajaxSubmit(options);
		return false;
	}
	
	function supplier_3showResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#supplier_3list',
					success: 		supplier_3showResponse,
		}; 
		
		$('#supplier_3listform').submit(function() { 
			$('#supplier_3listform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function supplier_3calldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function supplier_3add()
	{
		$('#supplier_3formholder').load('<?=site_url()."/supplier_3add/";?>', function()
		{$('#supplier_3closebutton').html('<input type="button" value="Close" onclick="$(\'' + '#supplier_3formholder' + '\').html(\'\');' + '$(\'' + '#supplier_3closebutton' + '\').html(\'\');' + '$(\'' + '#supplier_3list' + '\').load(\'<?=site_url();?>/supplier_3list\');' + ';"></input>');
		});	
	}
	
	function supplier_3edit(id)
	{
		$('#supplier_3formholder').load('<?=site_url()."/supplier_3edit/index/";?>' + id, function()
		{$('#supplier_3closebutton').html('<input type="button" value="Close" onclick="$(\'' + '#supplier_3formholder' + '\').html(\'\');' + '$(\'' + '#supplier_3closebutton' + '\').html(\'\');' + '$(\'' + '#supplier_3list' + '\').load(\'<?=site_url();?>/supplier_3list\');' + ';"></input>');
		});	
	}
	
	function supplier_3view(id)
	{
		$('#supplier_3formholder').load('<?=site_url()."/supplier_3view/index/";?>' + id, function()
		{$('#supplier_3closebutton').html('<input type="button" value="Close" onclick="$(\'' + '#supplier_3formholder' + '\').html(\'\');' + '$(\'' + '#supplier_3closebutton' + '\').html(\'\');' + '$(\'' + '#supplier_3list' + '\').load(\'<?=site_url();?>/supplier_3list\');' + ';"></input>');
		});	
	}
	
	function supplier_3gotopage()
	{
		var page = document.supplier_3listform.pageno.options[document.supplier_3listform.pageno.selectedIndex].value;
		
		$("#supplier_3currsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#supplier_3list',
					success: 		supplier_3showResponse,
		}; 
		$('#supplier_3listform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="supplier_3-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="supplier_3closebutton"></div>
		<div id="supplier_3formholder"></div>
		<div id="supplier_3list">
		<!--<form method="post" action="<?=site_url();?>/supplier_3list/index/" id="supplier_3listform" name="supplier_3listform">-->
		<form method="post" action="<?=current_url();?>" id="supplier_3listform" name="supplier_3listform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="supplier_3currsort">
			</div>
			<div id="supplier_3sort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="supplier_3add()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/supplier_3add/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/supplier_3add/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="supplier_3sortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="supplier_3sortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="supplier_3sortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="supplier_3sortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['supplier__idstring'];?></td><td><?=$row['supplier__firstname'];?></td><td><?=$row['supplier__lastname'];?></td><td><?=$row['supplier__address'];?></td><td><?=$row['supplier__phone'];?></td><td><?=$row['supplier__fax'];?></td><td><?=$row['supplier__npwp'];?></td><td><?=$row['supplier__email'];?></td><td><?=$row['supplier__firmtype'];?></td><td><?=$row['supplier__contactperson'];?></td><td><?=$row['supplier__hpcontactperson'];?></td><td><?=$row['supplier__barang'];?></td><td><?=$row['supplier__top'];?></td><td><?php if (isset($row['supplier__currency_id']) && $row['supplier__currency_id'] > 0) echo $row['currency__name'];?></td><td><?=$row['supplier__rating'];?></td><td><?=$row['supplier__lastupdate'];?></td><td><?=$row['supplier__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="supplier_3view(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/supplier_3view/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="supplier_3edit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/supplier_3edit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="supplier_3confirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="supplier_3gotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>