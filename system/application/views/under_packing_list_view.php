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
					target:        '#under_packinglist',
					success: 		under_packingshowResponse,
		}; 
		
		$('#under_packinglistform').submit(function() { 
			$('#under_packinglistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function under_packingconfirmdelete(delid, obj)
	{
		$('#under_packing-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', under_packingconfirmdelete2(delid, obj));
	}
	
	function under_packingconfirmdelete2(delid, obj)
	{
		$( "#under_packing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					under_packingcalldeletefn('under_packingdelete', delid, 'under_packinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#under_packing-dialog-confirm').html('');
	}
	
	function under_packingsortupdown(field, direction)
	{
		$("#under_packingcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#under_packinglist',
					success: 		under_packingshowResponse,
		}; 
		$('#under_packinglistform').ajaxSubmit(options);
		return false;
	}
	
	function under_packingshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#under_packinglist',
					success: 		under_packingshowResponse,
		}; 
		
		$('#under_packinglistform').submit(function() { 
			$('#under_packinglistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function under_packingcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function under_packingadd()
	{
		$('#under_packingformholder').load('<?=site_url()."/under_packingadd/";?>', function()
		{$('#under_packingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#under_packingformholder' + '\').html(\'\');' + '$(\'' + '#under_packingclosebutton' + '\').html(\'\');' + '$(\'' + '#under_packinglist' + '\').load(\'<?=site_url();?>/under_packinglist\');' + ';"></input>');
		});	
	}
	
	function under_packingedit(id)
	{
		$('#under_packingformholder').load('<?=site_url()."/under_packingedit/index/";?>' + id, function()
		{$('#under_packingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#under_packingformholder' + '\').html(\'\');' + '$(\'' + '#under_packingclosebutton' + '\').html(\'\');' + '$(\'' + '#under_packinglist' + '\').load(\'<?=site_url();?>/under_packinglist\');' + ';"></input>');
		});	
	}
	
	function under_packingview(id)
	{
		$('#under_packingformholder').load('<?=site_url()."/under_packingview/index/";?>' + id, function()
		{$('#under_packingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#under_packingformholder' + '\').html(\'\');' + '$(\'' + '#under_packingclosebutton' + '\').html(\'\');' + '$(\'' + '#under_packinglist' + '\').load(\'<?=site_url();?>/under_packinglist\');' + ';"></input>');
		});	
	}
	
	function under_packinggotopage()
	{
		var page = document.under_packinglistform.pageno.options[document.under_packinglistform.pageno.selectedIndex].value;
		
		$("#under_packingcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#under_packinglist',
					success: 		under_packingshowResponse,
		}; 
		$('#under_packinglistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="under_packing-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="under_packingclosebutton"></div>
		<div id="under_packingformholder"></div>
		<div id="under_packinglist">
		<!--<form method="post" action="<?=site_url();?>/under_packinglist/index/" id="under_packinglistform" name="under_packinglistform">-->
		<form method="post" action="<?=current_url();?>" id="under_packinglistform" name="under_packinglistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="under_packingcurrsort">
			</div>
			<div id="under_packingsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="under_packingadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/under_packingadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/under_packingadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="under_packingsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="under_packingsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="under_packingsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="under_packingsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/under_packingview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('under_packingview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td><?=$row['item__category'];?></td><td><?=$row['item__color'];?></td><td><?=$row['item__presstype'];?></td><td align='right'><?=number_format($row['item__ac'], 2);?></td><td align='right'><?=number_format($row['item__ar'], 2);?></td><td align='right'><?=number_format($row['item__thickness'], 2);?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['coa__name'] != "") echo anchor('inventory_accountsview/index/'.$row['item__persediaan_coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['coa1__name'] != "") echo anchor('accountsview/index/'.$row['item__hpp_coa_id'], $row['coa1__name']);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="under_packingview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/under_packingview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="under_packingedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/under_packingedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="under_packingconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="under_packinggotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>