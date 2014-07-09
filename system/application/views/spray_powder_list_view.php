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
					target:        '#spray_powderlist',
					success: 		spray_powdershowResponse,
		}; 
		
		$('#spray_powderlistform').submit(function() { 
			$('#spray_powderlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function spray_powderconfirmdelete(delid, obj)
	{
		$('#spray_powder-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', spray_powderconfirmdelete2(delid, obj));
	}
	
	function spray_powderconfirmdelete2(delid, obj)
	{
		$( "#spray_powder-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					spray_powdercalldeletefn('spray_powderdelete', delid, 'spray_powderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#spray_powder-dialog-confirm').html('');
	}
	
	function spray_powdersortupdown(field, direction)
	{
		$("#spray_powdercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#spray_powderlist',
					success: 		spray_powdershowResponse,
		}; 
		$('#spray_powderlistform').ajaxSubmit(options);
		return false;
	}
	
	function spray_powdershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#spray_powderlist',
					success: 		spray_powdershowResponse,
		}; 
		
		$('#spray_powderlistform').submit(function() { 
			$('#spray_powderlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function spray_powdercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function spray_powderadd()
	{
		$('#spray_powderformholder').load('<?=site_url()."/spray_powderadd/";?>', function()
		{$('#spray_powderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#spray_powderformholder' + '\').html(\'\');' + '$(\'' + '#spray_powderclosebutton' + '\').html(\'\');' + '$(\'' + '#spray_powderlist' + '\').load(\'<?=site_url();?>/spray_powderlist\');' + ';"></input>');
		});	
	}
	
	function spray_powderedit(id)
	{
		$('#spray_powderformholder').load('<?=site_url()."/spray_powderedit/index/";?>' + id, function()
		{$('#spray_powderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#spray_powderformholder' + '\').html(\'\');' + '$(\'' + '#spray_powderclosebutton' + '\').html(\'\');' + '$(\'' + '#spray_powderlist' + '\').load(\'<?=site_url();?>/spray_powderlist\');' + ';"></input>');
		});	
	}
	
	function spray_powderview(id)
	{
		$('#spray_powderformholder').load('<?=site_url()."/spray_powderview/index/";?>' + id, function()
		{$('#spray_powderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#spray_powderformholder' + '\').html(\'\');' + '$(\'' + '#spray_powderclosebutton' + '\').html(\'\');' + '$(\'' + '#spray_powderlist' + '\').load(\'<?=site_url();?>/spray_powderlist\');' + ';"></input>');
		});	
	}
	
	function spray_powdergotopage()
	{
		var page = document.spray_powderlistform.pageno.options[document.spray_powderlistform.pageno.selectedIndex].value;
		
		$("#spray_powdercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#spray_powderlist',
					success: 		spray_powdershowResponse,
		}; 
		$('#spray_powderlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="spray_powder-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="spray_powderclosebutton"></div>
		<div id="spray_powderformholder"></div>
		<div id="spray_powderlist">
		<!--<form method="post" action="<?=site_url();?>/spray_powderlist/index/" id="spray_powderlistform" name="spray_powderlistform">-->
		<form method="post" action="<?=current_url();?>" id="spray_powderlistform" name="spray_powderlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="spray_powdercurrsort">
			</div>
			<div id="spray_powdersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="spray_powderadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/spray_powderadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/spray_powderadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="spray_powdersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="spray_powdersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="spray_powdersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="spray_powdersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/spray_powderview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('spray_powderview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td><?=$row['item__chemicalcode'];?></td><td align='right'><?=number_format($row['item__weight'], 2);?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['coa__name'] != "") echo anchor('inventory_accountsview/index/'.$row['item__persediaan_coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['coa1__name'] != "") echo anchor('accountsview/index/'.$row['item__hpp_coa_id'], $row['coa1__name']);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="spray_powderview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/spray_powderview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="spray_powderedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/spray_powderedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="spray_powderconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="spray_powdergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>