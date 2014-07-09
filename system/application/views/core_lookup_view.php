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
					target:        '#corelist',
					success: 		coreshowResponse,
		}; 
		
		$('#corelistform').submit(function() { 
			$('#corelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function coreconfirmdelete(delid, obj)
	{
		$('#core-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', coreconfirmdelete2(delid, obj));
	}
	
	function coreconfirmdelete2(delid, obj)
	{
		$( "#core-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					corecalldeletefn('coredelete', delid, 'corelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#core-dialog-confirm').html('');
	}
	
	function coresortupdown(field, direction)
	{
		$("#corecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#corelist',
					success: 		coreshowResponse,
		}; 
		$('#corelistform').ajaxSubmit(options);
		return false;
	}
	
	function coreshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#corelist',
					success: 		coreshowResponse,
		}; 
		
		$('#corelistform').submit(function() { 
			$('#corelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function corecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function coreadd()
	{
		$('#coreformholder').load('<?=site_url()."/coreadd/";?>', function()
		{$('#coreclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#coreformholder' + '\').html(\'\');' + '$(\'' + '#coreclosebutton' + '\').html(\'\');' + '$(\'' + '#corelist' + '\').load(\'<?=site_url();?>/corelist\');' + ';"></input>');
		});	
	}
	
	function coreedit(id)
	{
		$('#coreformholder').load('<?=site_url()."/coreedit/index/";?>' + id, function()
		{$('#coreclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#coreformholder' + '\').html(\'\');' + '$(\'' + '#coreclosebutton' + '\').html(\'\');' + '$(\'' + '#corelist' + '\').load(\'<?=site_url();?>/corelist\');' + ';"></input>');
		});	
	}
	
	function coreview(id)
	{
		$('#coreformholder').load('<?=site_url()."/coreview/index/";?>' + id, function()
		{$('#coreclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#coreformholder' + '\').html(\'\');' + '$(\'' + '#coreclosebutton' + '\').html(\'\');' + '$(\'' + '#corelist' + '\').load(\'<?=site_url();?>/corelist\');' + ';"></input>');
		});	
	}
	
	function coregotopage()
	{
		var page = document.corelistform.pageno.options[document.corelistform.pageno.selectedIndex].value;
		
		$("#corecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#corelist',
					success: 		coreshowResponse,
		}; 
		$('#corelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="core-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="coreclosebutton"></div>
		<div id="coreformholder"></div>
		<div id="corelist">
		<!--<form method="post" action="<?=site_url();?>/corelist/index/" id="corelistform" name="corelistform">-->
		<form method="post" action="<?=current_url();?>" id="corelistform" name="corelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="corecurrsort">
			</div>
			<div id="coresort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="coreadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/coreadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/coreadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="coresortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="coresortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="coresortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="coresortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['item__idstring'];?></td><td><?=$row['item__name'];?></td><td><?=$row['item__subcategory'];?></td><td><?=$row['item__coreno'];?></td><td><?=$row['item__presstype'];?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__persediaan_coa_id']) && $row['item__persediaan_coa_id'] > 0) echo $row['coa__name'];?></td><td><?php if (isset($row['item__hpp_coa_id']) && $row['item__hpp_coa_id'] > 0) echo $row['coa1__name'];?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['item__itemcategory_id'] > 0) echo $row['itemcategory__name'];?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="coreview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/coreview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="coreedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/coreedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="coreconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="coregotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>