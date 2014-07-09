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
					target:        '#supplier_2list',
					success: 		supplier_2showResponse,
		}; 
		
		$('#supplier_2listform').submit(function() { 
			$('#supplier_2listform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function supplier_2confirmdelete(delid, obj)
	{
		$('#supplier_2-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', supplier_2confirmdelete2(delid, obj));
	}
	
	function supplier_2confirmdelete2(delid, obj)
	{
		$( "#supplier_2-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					supplier_2calldeletefn('supplier_2delete', delid, 'supplier_2list');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#supplier_2-dialog-confirm').html('');
	}
	
	function supplier_2sortupdown(field, direction)
	{
		$("#supplier_2currsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#supplier_2list',
					success: 		supplier_2showResponse,
		}; 
		$('#supplier_2listform').ajaxSubmit(options);
		return false;
	}
	
	function supplier_2showResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#supplier_2list',
					success: 		supplier_2showResponse,
		}; 
		
		$('#supplier_2listform').submit(function() { 
			$('#supplier_2listform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function supplier_2calldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function supplier_2add()
	{
		$('#supplier_2formholder').load('<?=site_url()."/supplier_2add/";?>', function()
		{$('#supplier_2closebutton').html('<input type="button" value="Close" onclick="$(\'' + '#supplier_2formholder' + '\').html(\'\');' + '$(\'' + '#supplier_2closebutton' + '\').html(\'\');' + '$(\'' + '#supplier_2list' + '\').load(\'<?=site_url();?>/supplier_2list\');' + ';"></input>');
		});	
	}
	
	function supplier_2edit(id)
	{
		$('#supplier_2formholder').load('<?=site_url()."/supplier_2edit/index/";?>' + id, function()
		{$('#supplier_2closebutton').html('<input type="button" value="Close" onclick="$(\'' + '#supplier_2formholder' + '\').html(\'\');' + '$(\'' + '#supplier_2closebutton' + '\').html(\'\');' + '$(\'' + '#supplier_2list' + '\').load(\'<?=site_url();?>/supplier_2list\');' + ';"></input>');
		});	
	}
	
	function supplier_2view(id)
	{
		$('#supplier_2formholder').load('<?=site_url()."/supplier_2view/index/";?>' + id, function()
		{$('#supplier_2closebutton').html('<input type="button" value="Close" onclick="$(\'' + '#supplier_2formholder' + '\').html(\'\');' + '$(\'' + '#supplier_2closebutton' + '\').html(\'\');' + '$(\'' + '#supplier_2list' + '\').load(\'<?=site_url();?>/supplier_2list\');' + ';"></input>');
		});	
	}
	
	function supplier_2gotopage()
	{
		var page = document.supplier_2listform.pageno.options[document.supplier_2listform.pageno.selectedIndex].value;
		
		$("#supplier_2currsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#supplier_2list',
					success: 		supplier_2showResponse,
		}; 
		$('#supplier_2listform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="supplier_2-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="supplier_2closebutton"></div>
		<div id="supplier_2formholder"></div>
		<div id="supplier_2list">
		<!--<form method="post" action="<?=site_url();?>/supplier_2list/index/" id="supplier_2listform" name="supplier_2listform">-->
		<form method="post" action="<?=current_url();?>" id="supplier_2listform" name="supplier_2listform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="supplier_2currsort">
			</div>
			<div id="supplier_2sort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="supplier_2add()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/supplier_2add/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/supplier_2add/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="supplier_2sortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="supplier_2sortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="supplier_2sortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="supplier_2sortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/supplier_2view/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('supplier_2view/index/'.$row['id'], $row['supplier__idstring']);?></td><td><?=$row['supplier__firstname'];?></td><td><?=$row['supplier__lastname'];?></td><td><?=$row['supplier__address'];?></td><td><?=$row['supplier__phone'];?></td><td><?=$row['supplier__fax'];?></td><td><?=$row['supplier__npwp'];?></td><td><?=$row['supplier__email'];?></td><td><?=$row['supplier__firmtype'];?></td><td><?=$row['supplier__contactperson'];?></td><td><?=$row['supplier__hpcontactperson'];?></td><td><?=$row['supplier__barang'];?></td><td><?=$row['supplier__top'];?></td><td><?php if (isset($row['supplier__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['supplier__currency_id'], $row['currency__name']);?></td><td><?=$row['supplier__rating'];?></td><td><?=$row['supplier__lastupdate'];?></td><td><?=$row['supplier__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="supplier_2view(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/supplier_2view/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="supplier_2edit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/supplier_2edit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="supplier_2confirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="supplier_2gotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>