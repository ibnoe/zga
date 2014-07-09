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
					target:        '#price_listlist',
					success: 		price_listshowResponse,
		}; 
		
		$('#price_listlistform').submit(function() { 
			$('#price_listlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function price_listconfirmdelete(delid, obj)
	{
		$('#price_list-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', price_listconfirmdelete2(delid, obj));
	}
	
	function price_listconfirmdelete2(delid, obj)
	{
		$( "#price_list-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					price_listcalldeletefn('price_listdelete', delid, 'price_listlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#price_list-dialog-confirm').html('');
	}
	
	function price_listsortupdown(field, direction)
	{
		$("#price_listcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#price_listlist',
					success: 		price_listshowResponse,
		}; 
		$('#price_listlistform').ajaxSubmit(options);
		return false;
	}
	
	function price_listshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#price_listlist',
					success: 		price_listshowResponse,
		}; 
		
		$('#price_listlistform').submit(function() { 
			$('#price_listlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function price_listcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function price_listadd()
	{
		$('#price_listformholder').load('<?=site_url()."/price_listadd/";?>', function()
		{$('#price_listclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#price_listformholder' + '\').html(\'\');' + '$(\'' + '#price_listclosebutton' + '\').html(\'\');' + '$(\'' + '#price_listlist' + '\').load(\'<?=site_url();?>/price_listlist\');' + ';"></input>');
		});	
	}
	
	function price_listedit(id)
	{
		$('#price_listformholder').load('<?=site_url()."/price_listedit/index/";?>' + id, function()
		{$('#price_listclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#price_listformholder' + '\').html(\'\');' + '$(\'' + '#price_listclosebutton' + '\').html(\'\');' + '$(\'' + '#price_listlist' + '\').load(\'<?=site_url();?>/price_listlist\');' + ';"></input>');
		});	
	}
	
	function price_listview(id)
	{
		$('#price_listformholder').load('<?=site_url()."/price_listview/index/";?>' + id, function()
		{$('#price_listclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#price_listformholder' + '\').html(\'\');' + '$(\'' + '#price_listclosebutton' + '\').html(\'\');' + '$(\'' + '#price_listlist' + '\').load(\'<?=site_url();?>/price_listlist\');' + ';"></input>');
		});	
	}
	
	function price_listgotopage()
	{
		var page = document.price_listlistform.pageno.options[document.price_listlistform.pageno.selectedIndex].value;
		
		$("#price_listcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#price_listlist',
					success: 		price_listshowResponse,
		}; 
		$('#price_listlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="price_list-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="price_listclosebutton"></div>
		<div id="price_listformholder"></div>
		<div id="price_listlist">
		<!--<form method="post" action="<?=site_url();?>/price_listlist/index/" id="price_listlistform" name="price_listlistform">-->
		<form method="post" action="<?=current_url();?>" id="price_listlistform" name="price_listlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="price_listcurrsort">
			</div>
			<div id="price_listsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="price_listadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/price_listadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/price_listadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="price_listsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="price_listsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="price_listsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="price_listsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/price_listview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('price_listview/index/'.$row['id'], $row['pricelist__idstring']);?></td><td><?=$row['pricelist__name'];?></td><td><?=$row['pricelist__lastupdate'];?></td><td><?=$row['pricelist__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="price_listview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/price_listview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="price_listedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/price_listedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="price_listconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="price_listgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>