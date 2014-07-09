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
					target:        '#accessorieslist',
					success: 		accessoriesshowResponse,
		}; 
		
		$('#accessorieslistform').submit(function() { 
			$('#accessorieslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function accessoriesconfirmdelete(delid, obj)
	{
		$('#accessories-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', accessoriesconfirmdelete2(delid, obj));
	}
	
	function accessoriesconfirmdelete2(delid, obj)
	{
		$( "#accessories-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					accessoriescalldeletefn('accessoriesdelete', delid, 'accessorieslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#accessories-dialog-confirm').html('');
	}
	
	function accessoriessortupdown(field, direction)
	{
		$("#accessoriescurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#accessorieslist',
					success: 		accessoriesshowResponse,
		}; 
		$('#accessorieslistform').ajaxSubmit(options);
		return false;
	}
	
	function accessoriesshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#accessorieslist',
					success: 		accessoriesshowResponse,
		}; 
		
		$('#accessorieslistform').submit(function() { 
			$('#accessorieslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function accessoriescalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function accessoriesadd()
	{
		$('#accessoriesformholder').load('<?=site_url()."/accessoriesadd/";?>', function()
		{$('#accessoriesclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#accessoriesformholder' + '\').html(\'\');' + '$(\'' + '#accessoriesclosebutton' + '\').html(\'\');' + '$(\'' + '#accessorieslist' + '\').load(\'<?=site_url();?>/accessorieslist\');' + ';"></input>');
		});	
	}
	
	function accessoriesedit(id)
	{
		$('#accessoriesformholder').load('<?=site_url()."/accessoriesedit/index/";?>' + id, function()
		{$('#accessoriesclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#accessoriesformholder' + '\').html(\'\');' + '$(\'' + '#accessoriesclosebutton' + '\').html(\'\');' + '$(\'' + '#accessorieslist' + '\').load(\'<?=site_url();?>/accessorieslist\');' + ';"></input>');
		});	
	}
	
	function accessoriesview(id)
	{
		$('#accessoriesformholder').load('<?=site_url()."/accessoriesview/index/";?>' + id, function()
		{$('#accessoriesclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#accessoriesformholder' + '\').html(\'\');' + '$(\'' + '#accessoriesclosebutton' + '\').html(\'\');' + '$(\'' + '#accessorieslist' + '\').load(\'<?=site_url();?>/accessorieslist\');' + ';"></input>');
		});	
	}
	
	function accessoriesgotopage()
	{
		var page = document.accessorieslistform.pageno.options[document.accessorieslistform.pageno.selectedIndex].value;
		
		$("#accessoriescurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#accessorieslist',
					success: 		accessoriesshowResponse,
		}; 
		$('#accessorieslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="accessories-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="accessoriesclosebutton"></div>
		<div id="accessoriesformholder"></div>
		<div id="accessorieslist">
		<!--<form method="post" action="<?=site_url();?>/accessorieslist/index/" id="accessorieslistform" name="accessorieslistform">-->
		<form method="post" action="<?=current_url();?>" id="accessorieslistform" name="accessorieslistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="accessoriescurrsort">
			</div>
			<div id="accessoriessort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="accessoriesadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/accessoriesadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/accessoriesadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="accessoriessortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="accessoriessortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="accessoriessortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="accessoriessortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/accessoriesview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('accessoriesview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td><?=$row['item__subcategory'];?></td><td><?=$row['item__brand'];?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['coa__name'] != "") echo anchor('inventory_accountsview/index/'.$row['item__persediaan_coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['coa1__name'] != "") echo anchor('accountsview/index/'.$row['item__hpp_coa_id'], $row['coa1__name']);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="accessoriesview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/accessoriesview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="accessoriesedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/accessoriesedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="accessoriesconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="accessoriesgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>