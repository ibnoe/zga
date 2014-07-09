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
					target:        '#productionrequestorderlist',
					success: 		productionrequestordershowResponse,
		}; 
		
		$('#productionrequestorderlistform').submit(function() { 
			$('#productionrequestorderlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function productionrequestorderconfirmdelete(delid, obj)
	{
		$('#productionrequestorder-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', productionrequestorderconfirmdelete2(delid, obj));
	}
	
	function productionrequestorderconfirmdelete2(delid, obj)
	{
		$( "#productionrequestorder-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					productionrequestordercalldeletefn('productionrequestorderdelete', delid, 'productionrequestorderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#productionrequestorder-dialog-confirm').html('');
	}
	
	function productionrequestordersortupdown(field, direction)
	{
		$("#productionrequestordercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#productionrequestorderlist',
					success: 		productionrequestordershowResponse,
		}; 
		$('#productionrequestorderlistform').ajaxSubmit(options);
		return false;
	}
	
	function productionrequestordershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#productionrequestorderlist',
					success: 		productionrequestordershowResponse,
		}; 
		
		$('#productionrequestorderlistform').submit(function() { 
			$('#productionrequestorderlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function productionrequestordercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function productionrequestorderadd()
	{
		$('#productionrequestorderformholder').load('<?=site_url()."/productionrequestorderadd/";?>', function()
		{$('#productionrequestorderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#productionrequestorderformholder' + '\').html(\'\');' + '$(\'' + '#productionrequestorderclosebutton' + '\').html(\'\');' + '$(\'' + '#productionrequestorderlist' + '\').load(\'<?=site_url();?>/productionrequestorderlist\');' + ';"></input>');
		});	
	}
	
	function productionrequestorderedit(id)
	{
		$('#productionrequestorderformholder').load('<?=site_url()."/productionrequestorderedit/index/";?>' + id, function()
		{$('#productionrequestorderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#productionrequestorderformholder' + '\').html(\'\');' + '$(\'' + '#productionrequestorderclosebutton' + '\').html(\'\');' + '$(\'' + '#productionrequestorderlist' + '\').load(\'<?=site_url();?>/productionrequestorderlist\');' + ';"></input>');
		});	
	}
	
	function productionrequestorderview(id)
	{
		$('#productionrequestorderformholder').load('<?=site_url()."/productionrequestorderview/index/";?>' + id, function()
		{$('#productionrequestorderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#productionrequestorderformholder' + '\').html(\'\');' + '$(\'' + '#productionrequestorderclosebutton' + '\').html(\'\');' + '$(\'' + '#productionrequestorderlist' + '\').load(\'<?=site_url();?>/productionrequestorderlist\');' + ';"></input>');
		});	
	}
	
	function productionrequestordergotopage()
	{
		var page = document.productionrequestorderlistform.pageno.options[document.productionrequestorderlistform.pageno.selectedIndex].value;
		
		$("#productionrequestordercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#productionrequestorderlist',
					success: 		productionrequestordershowResponse,
		}; 
		$('#productionrequestorderlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="productionrequestorder-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="productionrequestorderclosebutton"></div>
		<div id="productionrequestorderformholder"></div>
		<div id="productionrequestorderlist">
		<!--<form method="post" action="<?=site_url();?>/productionrequestorderlist/index/" id="productionrequestorderlistform" name="productionrequestorderlistform">-->
		<form method="post" action="<?=current_url();?>" id="productionrequestorderlistform" name="productionrequestorderlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="productionrequestordercurrsort">
			</div>
			<div id="productionrequestordersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="productionrequestorderadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/productionrequestorderadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/productionrequestorderadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="productionrequestordersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="productionrequestordersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="productionrequestordersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="productionrequestordersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/productionrequestorderview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('productionrequestorderview/index/'.$row['id'], $row['productionrequestorder__idstring']);?></td><td><?php if (isset($row['productionrequestorder__customer_id']) && $row['customer__idstring'] != "") echo anchor('customerview/index/'.$row['productionrequestorder__customer_id'], $row['customer__idstring']);?></td><td><?=$row['productionrequestorder__idstring'];?></td><td><?=$row['productionrequestorder__lastupdate'];?></td><td><?=$row['productionrequestorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="productionrequestorderview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/productionrequestorderview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="productionrequestorderedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/productionrequestorderedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="productionrequestorderconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="productionrequestordergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>