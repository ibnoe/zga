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
					target:        '#compoundlist',
					success: 		compoundshowResponse,
		}; 
		
		$('#compoundlistform').submit(function() { 
			$('#compoundlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function compoundconfirmdelete(delid, obj)
	{
		$('#compound-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', compoundconfirmdelete2(delid, obj));
	}
	
	function compoundconfirmdelete2(delid, obj)
	{
		$( "#compound-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					compoundcalldeletefn('compounddelete', delid, 'compoundlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#compound-dialog-confirm').html('');
	}
	
	function compoundsortupdown(field, direction)
	{
		$("#compoundcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#compoundlist',
					success: 		compoundshowResponse,
		}; 
		$('#compoundlistform').ajaxSubmit(options);
		return false;
	}
	
	function compoundshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#compoundlist',
					success: 		compoundshowResponse,
		}; 
		
		$('#compoundlistform').submit(function() { 
			$('#compoundlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function compoundcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function compoundadd()
	{
		$('#compoundformholder').load('<?=site_url()."/compoundadd/";?>', function()
		{$('#compoundclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#compoundformholder' + '\').html(\'\');' + '$(\'' + '#compoundclosebutton' + '\').html(\'\');' + '$(\'' + '#compoundlist' + '\').load(\'<?=site_url();?>/compoundlist\');' + ';"></input>');
		});	
	}
	
	function compoundedit(id)
	{
		$('#compoundformholder').load('<?=site_url()."/compoundedit/index/";?>' + id, function()
		{$('#compoundclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#compoundformholder' + '\').html(\'\');' + '$(\'' + '#compoundclosebutton' + '\').html(\'\');' + '$(\'' + '#compoundlist' + '\').load(\'<?=site_url();?>/compoundlist\');' + ';"></input>');
		});	
	}
	
	function compoundview(id)
	{
		$('#compoundformholder').load('<?=site_url()."/compoundview/index/";?>' + id, function()
		{$('#compoundclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#compoundformholder' + '\').html(\'\');' + '$(\'' + '#compoundclosebutton' + '\').html(\'\');' + '$(\'' + '#compoundlist' + '\').load(\'<?=site_url();?>/compoundlist\');' + ';"></input>');
		});	
	}
	
	function compoundgotopage()
	{
		var page = document.compoundlistform.pageno.options[document.compoundlistform.pageno.selectedIndex].value;
		
		$("#compoundcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#compoundlist',
					success: 		compoundshowResponse,
		}; 
		$('#compoundlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="compound-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="compoundclosebutton"></div>
		<div id="compoundformholder"></div>
		<div id="compoundlist">
		<!--<form method="post" action="<?=site_url();?>/compoundlist/index/" id="compoundlistform" name="compoundlistform">-->
		<form method="post" action="<?=current_url();?>" id="compoundlistform" name="compoundlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="compoundcurrsort">
			</div>
			<div id="compoundsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="compoundadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/compoundadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/compoundadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="compoundsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="compoundsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="compoundsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="compoundsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/compoundview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('compoundview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td><?=$row['item__subcategory'];?></td><td align='right'><?=number_format($row['item__expiryduration'], 2);?></td><td><?=$row['item__expirydate'];?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['coa__name'] != "") echo anchor('inventory_accountsview/index/'.$row['item__persediaan_coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['coa1__name'] != "") echo anchor('accountsview/index/'.$row['item__hpp_coa_id'], $row['coa1__name']);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="compoundview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/compoundview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="compoundedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/compoundedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="compoundconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="compoundgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>