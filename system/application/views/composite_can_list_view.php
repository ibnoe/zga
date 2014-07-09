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
					target:        '#composite_canlist',
					success: 		composite_canshowResponse,
		}; 
		
		$('#composite_canlistform').submit(function() { 
			$('#composite_canlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function composite_canconfirmdelete(delid, obj)
	{
		$('#composite_can-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', composite_canconfirmdelete2(delid, obj));
	}
	
	function composite_canconfirmdelete2(delid, obj)
	{
		$( "#composite_can-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					composite_cancalldeletefn('composite_candelete', delid, 'composite_canlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#composite_can-dialog-confirm').html('');
	}
	
	function composite_cansortupdown(field, direction)
	{
		$("#composite_cancurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#composite_canlist',
					success: 		composite_canshowResponse,
		}; 
		$('#composite_canlistform').ajaxSubmit(options);
		return false;
	}
	
	function composite_canshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#composite_canlist',
					success: 		composite_canshowResponse,
		}; 
		
		$('#composite_canlistform').submit(function() { 
			$('#composite_canlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function composite_cancalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function composite_canadd()
	{
		$('#composite_canformholder').load('<?=site_url()."/composite_canadd/";?>', function()
		{$('#composite_canclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#composite_canformholder' + '\').html(\'\');' + '$(\'' + '#composite_canclosebutton' + '\').html(\'\');' + '$(\'' + '#composite_canlist' + '\').load(\'<?=site_url();?>/composite_canlist\');' + ';"></input>');
		});	
	}
	
	function composite_canedit(id)
	{
		$('#composite_canformholder').load('<?=site_url()."/composite_canedit/index/";?>' + id, function()
		{$('#composite_canclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#composite_canformholder' + '\').html(\'\');' + '$(\'' + '#composite_canclosebutton' + '\').html(\'\');' + '$(\'' + '#composite_canlist' + '\').load(\'<?=site_url();?>/composite_canlist\');' + ';"></input>');
		});	
	}
	
	function composite_canview(id)
	{
		$('#composite_canformholder').load('<?=site_url()."/composite_canview/index/";?>' + id, function()
		{$('#composite_canclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#composite_canformholder' + '\').html(\'\');' + '$(\'' + '#composite_canclosebutton' + '\').html(\'\');' + '$(\'' + '#composite_canlist' + '\').load(\'<?=site_url();?>/composite_canlist\');' + ';"></input>');
		});	
	}
	
	function composite_cangotopage()
	{
		var page = document.composite_canlistform.pageno.options[document.composite_canlistform.pageno.selectedIndex].value;
		
		$("#composite_cancurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#composite_canlist',
					success: 		composite_canshowResponse,
		}; 
		$('#composite_canlistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="composite_can-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="composite_canclosebutton"></div>
		<div id="composite_canformholder"></div>
		<div id="composite_canlist">
		<form method="post" action="<?=site_url();?>/composite_canlist/index/" id="composite_canlistform" name="composite_canlistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="composite_cancurrsort">
			</div>
			<div id="composite_cansort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="composite_canadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/composite_canadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/composite_canadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="composite_cansortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="composite_cansortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="composite_cansortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="composite_cansortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['composite__name'];?></td><td><?=$row['composite__diameter'];?></td><td><?=$row['composite__length'];?></td><td><?=$row['composite__minquantity'];?></td><td><?=$row['composite__maxquantity'];?></td><td><?=$row['composite__buffer3months'];?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=$row['composite__purchaseable'];?></td><td><?=$row['composite__sellable'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="composite_canview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/composite_canview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="composite_canedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/composite_canedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="composite_canconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="composite_cangotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>