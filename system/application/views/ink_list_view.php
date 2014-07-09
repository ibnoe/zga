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
					target:        '#inklist',
					success: 		inkshowResponse,
		}; 
		
		$('#inklistform').submit(function() { 
			$('#inklistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function inkconfirmdelete(delid, obj)
	{
		$('#ink-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', inkconfirmdelete2(delid, obj));
	}
	
	function inkconfirmdelete2(delid, obj)
	{
		$( "#ink-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					inkcalldeletefn('inkdelete', delid, 'inklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#ink-dialog-confirm').html('');
	}
	
	function inksortupdown(field, direction)
	{
		$("#inkcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#inklist',
					success: 		inkshowResponse,
		}; 
		$('#inklistform').ajaxSubmit(options);
		return false;
	}
	
	function inkshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#inklist',
					success: 		inkshowResponse,
		}; 
		
		$('#inklistform').submit(function() { 
			$('#inklistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function inkcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function inkadd()
	{
		$('#inkformholder').load('<?=site_url()."/inkadd/";?>', function()
		{$('#inkclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#inkformholder' + '\').html(\'\');' + '$(\'' + '#inkclosebutton' + '\').html(\'\');' + '$(\'' + '#inklist' + '\').load(\'<?=site_url();?>/inklist\');' + ';"></input>');
		});	
	}
	
	function inkedit(id)
	{
		$('#inkformholder').load('<?=site_url()."/inkedit/index/";?>' + id, function()
		{$('#inkclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#inkformholder' + '\').html(\'\');' + '$(\'' + '#inkclosebutton' + '\').html(\'\');' + '$(\'' + '#inklist' + '\').load(\'<?=site_url();?>/inklist\');' + ';"></input>');
		});	
	}
	
	function inkview(id)
	{
		$('#inkformholder').load('<?=site_url()."/inkview/index/";?>' + id, function()
		{$('#inkclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#inkformholder' + '\').html(\'\');' + '$(\'' + '#inkclosebutton' + '\').html(\'\');' + '$(\'' + '#inklist' + '\').load(\'<?=site_url();?>/inklist\');' + ';"></input>');
		});	
	}
	
	function inkgotopage()
	{
		var page = document.inklistform.pageno.options[document.inklistform.pageno.selectedIndex].value;
		
		$("#inkcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#inklist',
					success: 		inkshowResponse,
		}; 
		$('#inklistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="ink-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="inkclosebutton"></div>
		<div id="inkformholder"></div>
		<div id="inklist">
		<!--<form method="post" action="<?=site_url();?>/inklist/index/" id="inklistform" name="inklistform">-->
		<form method="post" action="<?=current_url();?>" id="inklistform" name="inklistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="inkcurrsort">
			</div>
			<div id="inksort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="inkadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/inkadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/inkadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="inksortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="inksortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="inksortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="inksortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/inkview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('inkview/index/'.$row['id'], $row['item__idstring']);?></td><td><?=$row['item__name'];?></td><td><?=$row['item__inkcode'];?></td><td align='right'><?=number_format($row['item__weight'], 2);?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['coa__name'] != "") echo anchor('inventory_accountsview/index/'.$row['item__persediaan_coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['coa1__name'] != "") echo anchor('accountsview/index/'.$row['item__hpp_coa_id'], $row['coa1__name']);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="inkview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/inkview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="inkedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/inkedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="inkconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="inkgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>