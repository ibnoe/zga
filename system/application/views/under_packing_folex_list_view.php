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
					target:        '#under_packing_folexlist',
					success: 		under_packing_folexshowResponse,
		}; 
		
		$('#under_packing_folexlistform').submit(function() { 
			$('#under_packing_folexlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function under_packing_folexconfirmdelete(delid, obj)
	{
		$('#under_packing_folex-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', under_packing_folexconfirmdelete2(delid, obj));
	}
	
	function under_packing_folexconfirmdelete2(delid, obj)
	{
		$( "#under_packing_folex-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					under_packing_folexcalldeletefn('under_packing_folexdelete', delid, 'under_packing_folexlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#under_packing_folex-dialog-confirm').html('');
	}
	
	function under_packing_folexsortupdown(field, direction)
	{
		$("#under_packing_folexcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#under_packing_folexlist',
					success: 		under_packing_folexshowResponse,
		}; 
		$('#under_packing_folexlistform').ajaxSubmit(options);
		return false;
	}
	
	function under_packing_folexshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#under_packing_folexlist',
					success: 		under_packing_folexshowResponse,
		}; 
		
		$('#under_packing_folexlistform').submit(function() { 
			$('#under_packing_folexlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function under_packing_folexcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function under_packing_folexadd()
	{
		$('#under_packing_folexformholder').load('<?=site_url()."/under_packing_folexadd/";?>', function()
		{$('#under_packing_folexclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#under_packing_folexformholder' + '\').html(\'\');' + '$(\'' + '#under_packing_folexclosebutton' + '\').html(\'\');' + '$(\'' + '#under_packing_folexlist' + '\').load(\'<?=site_url();?>/under_packing_folexlist\');' + ';"></input>');
		});	
	}
	
	function under_packing_folexedit(id)
	{
		$('#under_packing_folexformholder').load('<?=site_url()."/under_packing_folexedit/index/";?>' + id, function()
		{$('#under_packing_folexclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#under_packing_folexformholder' + '\').html(\'\');' + '$(\'' + '#under_packing_folexclosebutton' + '\').html(\'\');' + '$(\'' + '#under_packing_folexlist' + '\').load(\'<?=site_url();?>/under_packing_folexlist\');' + ';"></input>');
		});	
	}
	
	function under_packing_folexview(id)
	{
		$('#under_packing_folexformholder').load('<?=site_url()."/under_packing_folexview/index/";?>' + id, function()
		{$('#under_packing_folexclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#under_packing_folexformholder' + '\').html(\'\');' + '$(\'' + '#under_packing_folexclosebutton' + '\').html(\'\');' + '$(\'' + '#under_packing_folexlist' + '\').load(\'<?=site_url();?>/under_packing_folexlist\');' + ';"></input>');
		});	
	}
	
	function under_packing_folexgotopage()
	{
		var page = document.under_packing_folexlistform.pageno.options[document.under_packing_folexlistform.pageno.selectedIndex].value;
		
		$("#under_packing_folexcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#under_packing_folexlist',
					success: 		under_packing_folexshowResponse,
		}; 
		$('#under_packing_folexlistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="under_packing_folex-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="under_packing_folexclosebutton"></div>
		<div id="under_packing_folexformholder"></div>
		<div id="under_packing_folexlist">
		<form method="post" action="<?=site_url();?>/under_packing_folexlist/index/" id="under_packing_folexlistform" name="under_packing_folexlistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="under_packing_folexcurrsort">
			</div>
			<div id="under_packing_folexsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="under_packing_folexadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/under_packing_folexadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/under_packing_folexadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="under_packing_folexsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="under_packing_folexsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="under_packing_folexsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="under_packing_folexsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['itemzengraunderpackingfolex__name'];?></td><td><?=$row['itemzengraunderpackingfolex__netsqm'];?></td><td><?=$row['itemzengraunderpackingfolex__grosssqm'];?></td><td><?=$row['itemzengraunderpackingfolex__minquantity'];?></td><td><?=$row['itemzengraunderpackingfolex__maxquantity'];?></td><td><?=$row['itemzengraunderpackingfolex__buffer3months'];?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=$row['itemzengraunderpackingfolex__purchaseable'];?></td><td><?=$row['itemzengraunderpackingfolex__sellable'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="under_packing_folexview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/under_packing_folexview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="under_packing_folexedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/under_packing_folexedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="under_packing_folexconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="under_packing_folexgotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>