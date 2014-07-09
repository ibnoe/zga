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
					target:        '#inking_unit_foillist',
					success: 		inking_unit_foilshowResponse,
		}; 
		
		$('#inking_unit_foillistform').submit(function() { 
			$('#inking_unit_foillistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function inking_unit_foilconfirmdelete(delid, obj)
	{
		$('#inking_unit_foil-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', inking_unit_foilconfirmdelete2(delid, obj));
	}
	
	function inking_unit_foilconfirmdelete2(delid, obj)
	{
		$( "#inking_unit_foil-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					inking_unit_foilcalldeletefn('inking_unit_foildelete', delid, 'inking_unit_foillist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#inking_unit_foil-dialog-confirm').html('');
	}
	
	function inking_unit_foilsortupdown(field, direction)
	{
		$("#inking_unit_foilcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#inking_unit_foillist',
					success: 		inking_unit_foilshowResponse,
		}; 
		$('#inking_unit_foillistform').ajaxSubmit(options);
		return false;
	}
	
	function inking_unit_foilshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#inking_unit_foillist',
					success: 		inking_unit_foilshowResponse,
		}; 
		
		$('#inking_unit_foillistform').submit(function() { 
			$('#inking_unit_foillistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function inking_unit_foilcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function inking_unit_foiladd()
	{
		$('#inking_unit_foilformholder').load('<?=site_url()."/inking_unit_foiladd/";?>', function()
		{$('#inking_unit_foilclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#inking_unit_foilformholder' + '\').html(\'\');' + '$(\'' + '#inking_unit_foilclosebutton' + '\').html(\'\');' + '$(\'' + '#inking_unit_foillist' + '\').load(\'<?=site_url();?>/inking_unit_foillist\');' + ';"></input>');
		});	
	}
	
	function inking_unit_foiledit(id)
	{
		$('#inking_unit_foilformholder').load('<?=site_url()."/inking_unit_foiledit/index/";?>' + id, function()
		{$('#inking_unit_foilclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#inking_unit_foilformholder' + '\').html(\'\');' + '$(\'' + '#inking_unit_foilclosebutton' + '\').html(\'\');' + '$(\'' + '#inking_unit_foillist' + '\').load(\'<?=site_url();?>/inking_unit_foillist\');' + ';"></input>');
		});	
	}
	
	function inking_unit_foilview(id)
	{
		$('#inking_unit_foilformholder').load('<?=site_url()."/inking_unit_foilview/index/";?>' + id, function()
		{$('#inking_unit_foilclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#inking_unit_foilformholder' + '\').html(\'\');' + '$(\'' + '#inking_unit_foilclosebutton' + '\').html(\'\');' + '$(\'' + '#inking_unit_foillist' + '\').load(\'<?=site_url();?>/inking_unit_foillist\');' + ';"></input>');
		});	
	}
	
	function inking_unit_foilgotopage()
	{
		var page = document.inking_unit_foillistform.pageno.options[document.inking_unit_foillistform.pageno.selectedIndex].value;
		
		$("#inking_unit_foilcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#inking_unit_foillist',
					success: 		inking_unit_foilshowResponse,
		}; 
		$('#inking_unit_foillistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="inking_unit_foil-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="inking_unit_foilclosebutton"></div>
		<div id="inking_unit_foilformholder"></div>
		<div id="inking_unit_foillist">
		<form method="post" action="<?=site_url();?>/inking_unit_foillist/index/" id="inking_unit_foillistform" name="inking_unit_foillistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="inking_unit_foilcurrsort">
			</div>
			<div id="inking_unit_foilsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="inking_unit_foiladd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/inking_unit_foiladd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/inking_unit_foiladd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="inking_unit_foilsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="inking_unit_foilsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="inking_unit_foilsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="inking_unit_foilsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['inkingunitfoil__name'];?></td><td><?=$row['inkingunitfoil__category'];?></td><td><?=$row['inkingunitfoil__color'];?></td><td><?=$row['inkingunitfoil__ac'];?></td><td><?=$row['inkingunitfoil__ar'];?></td><td><?=$row['inkingunitfoil__thickness'];?></td><td><?=$row['inkingunitfoil__minquantity'];?></td><td><?=$row['inkingunitfoil__maxquantity'];?></td><td><?=$row['inkingunitfoil__buffer3months'];?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td><?=$row['inkingunitfoil__purchaseable'];?></td><td><?=$row['inkingunitfoil__sellable'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="inking_unit_foilview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/inking_unit_foilview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="inking_unit_foiledit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/inking_unit_foiledit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="inking_unit_foilconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="inking_unit_foilgotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>