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
					target:        '#item_categorylist',
					success: 		item_categoryshowResponse,
		}; 
		
		$('#item_categorylistform').submit(function() { 
			$('#item_categorylistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function item_categoryconfirmdelete(delid, obj)
	{
		$('#item_category-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', item_categoryconfirmdelete2(delid, obj));
	}
	
	function item_categoryconfirmdelete2(delid, obj)
	{
		$( "#item_category-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					item_categorycalldeletefn('item_categorydelete', delid, 'item_categorylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#item_category-dialog-confirm').html('');
	}
	
	function item_categorysortupdown(field, direction)
	{
		$("#item_categorycurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#item_categorylist',
					success: 		item_categoryshowResponse,
		}; 
		$('#item_categorylistform').ajaxSubmit(options);
		return false;
	}
	
	function item_categoryshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#item_categorylist',
					success: 		item_categoryshowResponse,
		}; 
		
		$('#item_categorylistform').submit(function() { 
			$('#item_categorylistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function item_categorycalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function item_categoryadd()
	{
		$('#item_categoryformholder').load('<?=site_url()."/item_categoryadd/";?>', function()
		{$('#item_categoryclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#item_categoryformholder' + '\').html(\'\');' + '$(\'' + '#item_categoryclosebutton' + '\').html(\'\');' + '$(\'' + '#item_categorylist' + '\').load(\'<?=site_url();?>/item_categorylist\');' + ';"></input>');
		});	
	}
	
	function item_categoryedit(id)
	{
		$('#item_categoryformholder').load('<?=site_url()."/item_categoryedit/index/";?>' + id, function()
		{$('#item_categoryclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#item_categoryformholder' + '\').html(\'\');' + '$(\'' + '#item_categoryclosebutton' + '\').html(\'\');' + '$(\'' + '#item_categorylist' + '\').load(\'<?=site_url();?>/item_categorylist\');' + ';"></input>');
		});	
	}
	
	function item_categoryview(id)
	{
		$('#item_categoryformholder').load('<?=site_url()."/item_categoryview/index/";?>' + id, function()
		{$('#item_categoryclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#item_categoryformholder' + '\').html(\'\');' + '$(\'' + '#item_categoryclosebutton' + '\').html(\'\');' + '$(\'' + '#item_categorylist' + '\').load(\'<?=site_url();?>/item_categorylist\');' + ';"></input>');
		});	
	}
	
	function item_categorygotopage()
	{
		var page = document.item_categorylistform.pageno.options[document.item_categorylistform.pageno.selectedIndex].value;
		
		$("#item_categorycurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#item_categorylist',
					success: 		item_categoryshowResponse,
		}; 
		$('#item_categorylistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="item_category-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="item_categoryclosebutton"></div>
		<div id="item_categoryformholder"></div>
		<div id="item_categorylist">
		<!--<form method="post" action="<?=site_url();?>/item_categorylist/index/" id="item_categorylistform" name="item_categorylistform">-->
		<form method="post" action="<?=current_url();?>" id="item_categorylistform" name="item_categorylistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="item_categorycurrsort">
			</div>
			<div id="item_categorysort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="item_categoryadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/item_categoryadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/item_categoryadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="item_categorysortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="item_categorysortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="item_categorysortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="item_categorysortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/item_categoryview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('item_categoryview/index/'.$row['id'], $row['itemcategory__name']);?></td><td><?=$row['itemcategory__notes'];?></td><td><?=$row['itemcategory__lastupdate'];?></td><td><?=$row['itemcategory__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="item_categoryview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/item_categoryview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="item_categoryedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/item_categoryedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="item_categoryconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="item_categorygotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>