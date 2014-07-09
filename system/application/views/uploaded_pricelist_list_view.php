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
					target:        '#uploaded_pricelistlist',
					success: 		uploaded_pricelistshowResponse,
		}; 
		
		$('#uploaded_pricelistlistform').submit(function() { 
			$('#uploaded_pricelistlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function uploaded_pricelistconfirmdelete(delid, obj)
	{
		$('#uploaded_pricelist-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', uploaded_pricelistconfirmdelete2(delid, obj));
	}
	
	function uploaded_pricelistconfirmdelete2(delid, obj)
	{
		$( "#uploaded_pricelist-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					uploaded_pricelistcalldeletefn('uploaded_pricelistdelete', delid, 'uploaded_pricelistlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#uploaded_pricelist-dialog-confirm').html('');
	}
	
	function uploaded_pricelistsortupdown(field, direction)
	{
		$("#uploaded_pricelistcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#uploaded_pricelistlist',
					success: 		uploaded_pricelistshowResponse,
		}; 
		$('#uploaded_pricelistlistform').ajaxSubmit(options);
		return false;
	}
	
	function uploaded_pricelistshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#uploaded_pricelistlist',
					success: 		uploaded_pricelistshowResponse,
		}; 
		
		$('#uploaded_pricelistlistform').submit(function() { 
			$('#uploaded_pricelistlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function uploaded_pricelistcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function uploaded_pricelistadd()
	{
		$('#uploaded_pricelistformholder').load('<?=site_url()."/uploaded_pricelistadd/";?>', function()
		{$('#uploaded_pricelistclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#uploaded_pricelistformholder' + '\').html(\'\');' + '$(\'' + '#uploaded_pricelistclosebutton' + '\').html(\'\');' + '$(\'' + '#uploaded_pricelistlist' + '\').load(\'<?=site_url();?>/uploaded_pricelistlist\');' + ';"></input>');
		});	
	}
	
	function uploaded_pricelistedit(id)
	{
		$('#uploaded_pricelistformholder').load('<?=site_url()."/uploaded_pricelistedit/index/";?>' + id, function()
		{$('#uploaded_pricelistclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#uploaded_pricelistformholder' + '\').html(\'\');' + '$(\'' + '#uploaded_pricelistclosebutton' + '\').html(\'\');' + '$(\'' + '#uploaded_pricelistlist' + '\').load(\'<?=site_url();?>/uploaded_pricelistlist\');' + ';"></input>');
		});	
	}
	
	function uploaded_pricelistview(id)
	{
		$('#uploaded_pricelistformholder').load('<?=site_url()."/uploaded_pricelistview/index/";?>' + id, function()
		{$('#uploaded_pricelistclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#uploaded_pricelistformholder' + '\').html(\'\');' + '$(\'' + '#uploaded_pricelistclosebutton' + '\').html(\'\');' + '$(\'' + '#uploaded_pricelistlist' + '\').load(\'<?=site_url();?>/uploaded_pricelistlist\');' + ';"></input>');
		});	
	}
	
	function uploaded_pricelistgotopage()
	{
		var page = document.uploaded_pricelistlistform.pageno.options[document.uploaded_pricelistlistform.pageno.selectedIndex].value;
		
		$("#uploaded_pricelistcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#uploaded_pricelistlist',
					success: 		uploaded_pricelistshowResponse,
		}; 
		$('#uploaded_pricelistlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="uploaded_pricelist-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="uploaded_pricelistclosebutton"></div>
		<div id="uploaded_pricelistformholder"></div>
		<div id="uploaded_pricelistlist">
		<!--<form method="post" action="<?=site_url();?>/uploaded_pricelistlist/index/" id="uploaded_pricelistlistform" name="uploaded_pricelistlistform">-->
		<form method="post" action="<?=current_url();?>" id="uploaded_pricelistlistform" name="uploaded_pricelistlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="uploaded_pricelistcurrsort">
			</div>
			<div id="uploaded_pricelistsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="uploaded_pricelistadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/uploaded_pricelistadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/uploaded_pricelistadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="uploaded_pricelistsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="uploaded_pricelistsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="uploaded_pricelistsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="uploaded_pricelistsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/uploaded_pricelistview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('uploaded_pricelistview/index/'.$row['id'], $row['uploadedpricelist__name']);?></td><td><?=$row['uploadedpricelist__notes'];?></td><td><?=$row['uploadedpricelist__lastupdate'];?></td><td><?=$row['uploadedpricelist__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="uploaded_pricelistview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/uploaded_pricelistview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="uploaded_pricelistedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/uploaded_pricelistedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="uploaded_pricelistconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="uploaded_pricelistgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>