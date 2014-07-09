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
					target:        '#barlist',
					success: 		barshowResponse,
		}; 
		
		$('#barlistform').submit(function() { 
			$('#barlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function barconfirmdelete(delid, obj)
	{
		$('#bar-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', barconfirmdelete2(delid, obj));
	}
	
	function barconfirmdelete2(delid, obj)
	{
		$( "#bar-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					barcalldeletefn('bardelete', delid, 'barlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bar-dialog-confirm').html('');
	}
	
	function barsortupdown(field, direction)
	{
		$("#barcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#barlist',
					success: 		barshowResponse,
		}; 
		$('#barlistform').ajaxSubmit(options);
		return false;
	}
	
	function barshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#barlist',
					success: 		barshowResponse,
		}; 
		
		$('#barlistform').submit(function() { 
			$('#barlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function barcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function baradd()
	{
		$('#barformholder').load('<?=site_url()."/baradd/";?>', function()
		{$('#barclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#barformholder' + '\').html(\'\');' + '$(\'' + '#barclosebutton' + '\').html(\'\');' + '$(\'' + '#barlist' + '\').load(\'<?=site_url();?>/barlist\');' + ';"></input>');
		});	
	}
	
	function baredit(id)
	{
		$('#barformholder').load('<?=site_url()."/baredit/index/";?>' + id, function()
		{$('#barclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#barformholder' + '\').html(\'\');' + '$(\'' + '#barclosebutton' + '\').html(\'\');' + '$(\'' + '#barlist' + '\').load(\'<?=site_url();?>/barlist\');' + ';"></input>');
		});	
	}
	
	function barview(id)
	{
		$('#barformholder').load('<?=site_url()."/barview/index/";?>' + id, function()
		{$('#barclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#barformholder' + '\').html(\'\');' + '$(\'' + '#barclosebutton' + '\').html(\'\');' + '$(\'' + '#barlist' + '\').load(\'<?=site_url();?>/barlist\');' + ';"></input>');
		});	
	}
	
	function bargotopage()
	{
		var page = document.barlistform.pageno.options[document.barlistform.pageno.selectedIndex].value;
		
		$("#barcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#barlist',
					success: 		barshowResponse,
		}; 
		$('#barlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="bar-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="barclosebutton"></div>
		<div id="barformholder"></div>
		<div id="barlist">
		<!--<form method="post" action="<?=site_url();?>/barlist/index/" id="barlistform" name="barlistform">-->
		<form method="post" action="<?=current_url();?>" id="barlistform" name="barlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="barcurrsort">
			</div>
			<div id="barsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="baradd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/baradd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/baradd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="barsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="barsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="barsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="barsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/barview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('barview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td><?=$row['item__barcode'];?></td><td align='right'><?=number_format($row['item__length'], 2);?></td><td><?=$row['item__pressmodel'];?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['coa__name'] != "") echo anchor('inventory_accountsview/index/'.$row['item__persediaan_coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['coa1__name'] != "") echo anchor('accountsview/index/'.$row['item__hpp_coa_id'], $row['coa1__name']);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="barview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/barview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="baredit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/baredit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="barconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="bargotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>