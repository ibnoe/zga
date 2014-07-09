<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		/*
		$('a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		*/
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#under_packing_blanketlist',
					success: 		under_packing_blanketshowResponse,
		}; 
		
		$('#under_packing_blanketlistform').submit(function() { 
			$('#under_packing_blanketlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function under_packing_blanketconfirmdelete(delid, obj)
	{
		$('#under_packing_blanket-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', under_packing_blanketconfirmdelete2(delid, obj));
	}
	
	function under_packing_blanketconfirmdelete2(delid, obj)
	{
		$( "#under_packing_blanket-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					under_packing_blanketcalldeletefn('under_packing_blanketdelete', delid, 'under_packing_blanketlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#under_packing_blanket-dialog-confirm').html('');
	}
	
	function under_packing_blanketsortupdown(field, direction)
	{
		$("#under_packing_blanketcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#under_packing_blanketlist',
					success: 		under_packing_blanketshowResponse,
		}; 
		$('#under_packing_blanketlistform').ajaxSubmit(options);
		return false;
	}
	
	function under_packing_blanketshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#under_packing_blanketlist',
					success: 		under_packing_blanketshowResponse,
		}; 
		
		$('#under_packing_blanketlistform').submit(function() { 
			$('#under_packing_blanketlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function under_packing_blanketcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function under_packing_blanketadd()
	{
		$('#under_packing_blanketformholder').load('<?=site_url()."/under_packing_blanketadd/";?>', function()
		{$('#under_packing_blanketclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#under_packing_blanketformholder' + '\').html(\'\');' + '$(\'' + '#under_packing_blanketclosebutton' + '\').html(\'\');' + '$(\'' + '#under_packing_blanketlist' + '\').load(\'<?=site_url();?>/under_packing_blanketlist\');' + ';"></input>');
		});	
	}
	
	function under_packing_blanketedit(id)
	{
		$('#under_packing_blanketformholder').load('<?=site_url()."/under_packing_blanketedit/index/";?>' + id, function()
		{$('#under_packing_blanketclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#under_packing_blanketformholder' + '\').html(\'\');' + '$(\'' + '#under_packing_blanketclosebutton' + '\').html(\'\');' + '$(\'' + '#under_packing_blanketlist' + '\').load(\'<?=site_url();?>/under_packing_blanketlist\');' + ';"></input>');
		});	
	}
	
	function under_packing_blanketview(id)
	{
		$('#under_packing_blanketformholder').load('<?=site_url()."/under_packing_blanketview/index/";?>' + id, function()
		{$('#under_packing_blanketclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#under_packing_blanketformholder' + '\').html(\'\');' + '$(\'' + '#under_packing_blanketclosebutton' + '\').html(\'\');' + '$(\'' + '#under_packing_blanketlist' + '\').load(\'<?=site_url();?>/under_packing_blanketlist\');' + ';"></input>');
		});	
	}
	
	function under_packing_blanketgotopage()
	{
		var page = document.under_packing_blanketlistform.pageno.options[document.under_packing_blanketlistform.pageno.selectedIndex].value;
		
		$("#under_packing_blanketcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#under_packing_blanketlist',
					success: 		under_packing_blanketshowResponse,
		}; 
		$('#under_packing_blanketlistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="under_packing_blanket-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="under_packing_blanketclosebutton"></div>
		<div id="under_packing_blanketformholder"></div>
		<div id="under_packing_blanketlist">
		<form method="post" action="<?=site_url();?>/under_packing_blanketlist/index/" id="under_packing_blanketlistform" name="under_packing_blanketlistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="under_packing_blanketcurrsort">
			</div>
			<div id="under_packing_blanketsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="under_packing_blanketadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/under_packing_blanketadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/under_packing_blanketadd/index/";?>')">
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
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="under_packing_blanketsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="under_packing_blanketsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="under_packing_blanketsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="under_packing_blanketsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['underpackingblanket__name'];?></td><td><?=$row['underpackingblanket__category'];?></td><td><?=$row['underpackingblanket__color'];?></td><td><?=$row['underpackingblanket__ac'];?></td><td><?=$row['underpackingblanket__ar'];?></td><td><?=$row['underpackingblanket__thickness'];?></td><td><?=$row['underpackingblanket__minquantity'];?></td><td><?=$row['underpackingblanket__maxquantity'];?></td><td><?=$row['underpackingblanket__buffer3months'];?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=$row['underpackingblanket__purchaseable'];?></td><td><?=$row['underpackingblanket__sellable'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="under_packing_blanketview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/under_packing_blanketview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="under_packing_blanketedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/under_packing_blanketedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="under_packing_blanketconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="under_packing_blanketgotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>