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
					target:        '#packaginglist',
					success: 		packagingshowResponse,
		}; 
		
		$('#packaginglistform').submit(function() { 
			$('#packaginglistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function packagingconfirmdelete(delid, obj)
	{
		$('#packaging-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', packagingconfirmdelete2(delid, obj));
	}
	
	function packagingconfirmdelete2(delid, obj)
	{
		$( "#packaging-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					packagingcalldeletefn('packagingdelete', delid, 'packaginglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#packaging-dialog-confirm').html('');
	}
	
	function packagingsortupdown(field, direction)
	{
		$("#packagingcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#packaginglist',
					success: 		packagingshowResponse,
		}; 
		$('#packaginglistform').ajaxSubmit(options);
		return false;
	}
	
	function packagingshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#packaginglist',
					success: 		packagingshowResponse,
		}; 
		
		$('#packaginglistform').submit(function() { 
			$('#packaginglistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function packagingcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function packagingadd()
	{
		$('#packagingformholder').load('<?=site_url()."/packagingadd/";?>', function()
		{$('#packagingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#packagingformholder' + '\').html(\'\');' + '$(\'' + '#packagingclosebutton' + '\').html(\'\');' + '$(\'' + '#packaginglist' + '\').load(\'<?=site_url();?>/packaginglist\');' + ';"></input>');
		});	
	}
	
	function packagingedit(id)
	{
		$('#packagingformholder').load('<?=site_url()."/packagingedit/index/";?>' + id, function()
		{$('#packagingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#packagingformholder' + '\').html(\'\');' + '$(\'' + '#packagingclosebutton' + '\').html(\'\');' + '$(\'' + '#packaginglist' + '\').load(\'<?=site_url();?>/packaginglist\');' + ';"></input>');
		});	
	}
	
	function packagingview(id)
	{
		$('#packagingformholder').load('<?=site_url()."/packagingview/index/";?>' + id, function()
		{$('#packagingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#packagingformholder' + '\').html(\'\');' + '$(\'' + '#packagingclosebutton' + '\').html(\'\');' + '$(\'' + '#packaginglist' + '\').load(\'<?=site_url();?>/packaginglist\');' + ';"></input>');
		});	
	}
	
	function packaginggotopage()
	{
		var page = document.packaginglistform.pageno.options[document.packaginglistform.pageno.selectedIndex].value;
		
		$("#packagingcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#packaginglist',
					success: 		packagingshowResponse,
		}; 
		$('#packaginglistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="packaging-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="packagingclosebutton"></div>
		<div id="packagingformholder"></div>
		<div id="packaginglist">
		<!--<form method="post" action="<?=site_url();?>/packaginglist/index/" id="packaginglistform" name="packaginglistform">-->
		<form method="post" action="<?=current_url();?>" id="packaginglistform" name="packaginglistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="packagingcurrsort">
			</div>
			<div id="packagingsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="packagingadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/packagingadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/packagingadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="packagingsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="packagingsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="packagingsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="packagingsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/packagingview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('packagingview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td><?=$row['item__packagingtype'];?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td align='right'><?=number_format($row['item__expiryduration'], 2);?></td><td><?=$row['item__expirydate'];?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['coa__name'] != "") echo anchor('inventory_accountsview/index/'.$row['item__persediaan_coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['coa1__name'] != "") echo anchor('accountsview/index/'.$row['item__hpp_coa_id'], $row['coa1__name']);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="packagingview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/packagingview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="packagingedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/packagingedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="packagingconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="packaginggotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>