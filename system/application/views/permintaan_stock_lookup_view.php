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
					target:        '#permintaan_stocklist',
					success: 		permintaan_stockshowResponse,
		}; 
		
		$('#permintaan_stocklistform').submit(function() { 
			$('#permintaan_stocklistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function permintaan_stockconfirmdelete(delid, obj)
	{
		$('#permintaan_stock-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', permintaan_stockconfirmdelete2(delid, obj));
	}
	
	function permintaan_stockconfirmdelete2(delid, obj)
	{
		$( "#permintaan_stock-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					permintaan_stockcalldeletefn('permintaan_stockdelete', delid, 'permintaan_stocklist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#permintaan_stock-dialog-confirm').html('');
	}
	
	function permintaan_stocksortupdown(field, direction)
	{
		$("#permintaan_stockcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#permintaan_stocklist',
					success: 		permintaan_stockshowResponse,
		}; 
		$('#permintaan_stocklistform').ajaxSubmit(options);
		return false;
	}
	
	function permintaan_stockshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#permintaan_stocklist',
					success: 		permintaan_stockshowResponse,
		}; 
		
		$('#permintaan_stocklistform').submit(function() { 
			$('#permintaan_stocklistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function permintaan_stockcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function permintaan_stockadd()
	{
		$('#permintaan_stockformholder').load('<?=site_url()."/permintaan_stockadd/";?>', function()
		{$('#permintaan_stockclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#permintaan_stockformholder' + '\').html(\'\');' + '$(\'' + '#permintaan_stockclosebutton' + '\').html(\'\');' + '$(\'' + '#permintaan_stocklist' + '\').load(\'<?=site_url();?>/permintaan_stocklist\');' + ';"></input>');
		});	
	}
	
	function permintaan_stockedit(id)
	{
		$('#permintaan_stockformholder').load('<?=site_url()."/permintaan_stockedit/index/";?>' + id, function()
		{$('#permintaan_stockclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#permintaan_stockformholder' + '\').html(\'\');' + '$(\'' + '#permintaan_stockclosebutton' + '\').html(\'\');' + '$(\'' + '#permintaan_stocklist' + '\').load(\'<?=site_url();?>/permintaan_stocklist\');' + ';"></input>');
		});	
	}
	
	function permintaan_stockview(id)
	{
		$('#permintaan_stockformholder').load('<?=site_url()."/permintaan_stockview/index/";?>' + id, function()
		{$('#permintaan_stockclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#permintaan_stockformholder' + '\').html(\'\');' + '$(\'' + '#permintaan_stockclosebutton' + '\').html(\'\');' + '$(\'' + '#permintaan_stocklist' + '\').load(\'<?=site_url();?>/permintaan_stocklist\');' + ';"></input>');
		});	
	}
	
	function permintaan_stockgotopage()
	{
		var page = document.permintaan_stocklistform.pageno.options[document.permintaan_stocklistform.pageno.selectedIndex].value;
		
		$("#permintaan_stockcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#permintaan_stocklist',
					success: 		permintaan_stockshowResponse,
		}; 
		$('#permintaan_stocklistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="permintaan_stock-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="permintaan_stockclosebutton"></div>
		<div id="permintaan_stockformholder"></div>
		<div id="permintaan_stocklist">
		<!--<form method="post" action="<?=site_url();?>/permintaan_stocklist/index/" id="permintaan_stocklistform" name="permintaan_stocklistform">-->
		<form method="post" action="<?=current_url();?>" id="permintaan_stocklistform" name="permintaan_stocklistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="permintaan_stockcurrsort">
			</div>
			<div id="permintaan_stocksort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="permintaan_stockadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/permintaan_stockadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/permintaan_stockadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="permintaan_stocksortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="permintaan_stocksortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="permintaan_stocksortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="permintaan_stocksortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['permintaanstock__idstring'];?></td><td><?=$row['permintaanstock__date'];?></td><td><?=$row['permintaanstock__notes'];?></td><td><?=$row['permintaanstock__lastupdate'];?></td><td><?=$row['permintaanstock__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="permintaan_stockview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/permintaan_stockview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="permintaan_stockedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/permintaan_stockedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="permintaan_stockconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="permintaan_stockgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>