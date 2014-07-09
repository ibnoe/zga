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
					target:        '#supplierlist',
					success: 		suppliershowResponse,
		}; 
		
		$('#supplierlistform').submit(function() { 
			$('#supplierlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function supplierconfirmdelete(delid, obj)
	{
		$('#supplier-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', supplierconfirmdelete2(delid, obj));
	}
	
	function supplierconfirmdelete2(delid, obj)
	{
		$( "#supplier-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					suppliercalldeletefn('supplierdelete', delid, 'supplierlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#supplier-dialog-confirm').html('');
	}
	
	function suppliersortupdown(field, direction)
	{
		$("#suppliercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#supplierlist',
					success: 		suppliershowResponse,
		}; 
		$('#supplierlistform').ajaxSubmit(options);
		return false;
	}
	
	function suppliershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#supplierlist',
					success: 		suppliershowResponse,
		}; 
		
		$('#supplierlistform').submit(function() { 
			$('#supplierlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function suppliercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function supplieradd()
	{
		$('#supplierformholder').load('<?=site_url()."/supplieradd/";?>', function()
		{$('#supplierclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#supplierformholder' + '\').html(\'\');' + '$(\'' + '#supplierclosebutton' + '\').html(\'\');' + '$(\'' + '#supplierlist' + '\').load(\'<?=site_url();?>/supplierlist\');' + ';"></input>');
		});	
	}
	
	function supplieredit(id)
	{
		$('#supplierformholder').load('<?=site_url()."/supplieredit/index/";?>' + id, function()
		{$('#supplierclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#supplierformholder' + '\').html(\'\');' + '$(\'' + '#supplierclosebutton' + '\').html(\'\');' + '$(\'' + '#supplierlist' + '\').load(\'<?=site_url();?>/supplierlist\');' + ';"></input>');
		});	
	}
	
	function supplierview(id)
	{
		$('#supplierformholder').load('<?=site_url()."/supplierview/index/";?>' + id, function()
		{$('#supplierclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#supplierformholder' + '\').html(\'\');' + '$(\'' + '#supplierclosebutton' + '\').html(\'\');' + '$(\'' + '#supplierlist' + '\').load(\'<?=site_url();?>/supplierlist\');' + ';"></input>');
		});	
	}
	
	function suppliergotopage()
	{
		var page = document.supplierlistform.pageno.options[document.supplierlistform.pageno.selectedIndex].value;
		
		$("#suppliercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#supplierlist',
					success: 		suppliershowResponse,
		}; 
		$('#supplierlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="supplier-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="supplierclosebutton"></div>
		<div id="supplierformholder"></div>
		<div id="supplierlist">
		<!--<form method="post" action="<?=site_url();?>/supplierlist/index/" id="supplierlistform" name="supplierlistform">-->
		<form method="post" action="<?=current_url();?>" id="supplierlistform" name="supplierlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="suppliercurrsort">
			</div>
			<div id="suppliersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="supplieradd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/supplieradd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/supplieradd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="suppliersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="suppliersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="suppliersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="suppliersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/supplierview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('supplierview/index/'.$row['id'], $row['supplier__idstring']);?></td><td><?=$row['supplier__firstname'];?></td><td><?=$row['supplier__lastname'];?></td><td><?=$row['supplier__address'];?></td><td><?=$row['supplier__phone'];?></td><td><?=$row['supplier__fax'];?></td><td><?=$row['supplier__npwp'];?></td><td><?=$row['supplier__email'];?></td><td><?=$row['supplier__firmtype'];?></td><td><?=$row['supplier__contactperson'];?></td><td><?=$row['supplier__hpcontactperson'];?></td><td><?=$row['supplier__barang'];?></td><td><?=$row['supplier__top'];?></td><td><?php if (isset($row['supplier__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['supplier__currency_id'], $row['currency__name']);?></td><td><?=$row['supplier__rating'];?></td><td><?=$row['supplier__lastupdate'];?></td><td><?=$row['supplier__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="supplierview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/supplierview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="supplieredit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/supplieredit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="supplierconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="suppliergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>