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
					target:        '#blanketlist',
					success: 		blanketshowResponse,
		}; 
		
		$('#blanketlistform').submit(function() { 
			$('#blanketlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function blanketconfirmdelete(delid, obj)
	{
		$('#blanket-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', blanketconfirmdelete2(delid, obj));
	}
	
	function blanketconfirmdelete2(delid, obj)
	{
		$( "#blanket-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					blanketcalldeletefn('blanketdelete', delid, 'blanketlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#blanket-dialog-confirm').html('');
	}
	
	function blanketsortupdown(field, direction)
	{
		$("#blanketcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#blanketlist',
					success: 		blanketshowResponse,
		}; 
		$('#blanketlistform').ajaxSubmit(options);
		return false;
	}
	
	function blanketshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#blanketlist',
					success: 		blanketshowResponse,
		}; 
		
		$('#blanketlistform').submit(function() { 
			$('#blanketlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function blanketcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function blanketadd()
	{
		$('#blanketformholder').load('<?=site_url()."/blanketadd/";?>', function()
		{$('#blanketclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanketformholder' + '\').html(\'\');' + '$(\'' + '#blanketclosebutton' + '\').html(\'\');' + '$(\'' + '#blanketlist' + '\').load(\'<?=site_url();?>/blanketlist\');' + ';"></input>');
		});	
	}
	
	function blanketedit(id)
	{
		$('#blanketformholder').load('<?=site_url()."/blanketedit/index/";?>' + id, function()
		{$('#blanketclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanketformholder' + '\').html(\'\');' + '$(\'' + '#blanketclosebutton' + '\').html(\'\');' + '$(\'' + '#blanketlist' + '\').load(\'<?=site_url();?>/blanketlist\');' + ';"></input>');
		});	
	}
	
	function blanketview(id)
	{
		$('#blanketformholder').load('<?=site_url()."/blanketview/index/";?>' + id, function()
		{$('#blanketclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#blanketformholder' + '\').html(\'\');' + '$(\'' + '#blanketclosebutton' + '\').html(\'\');' + '$(\'' + '#blanketlist' + '\').load(\'<?=site_url();?>/blanketlist\');' + ';"></input>');
		});	
	}
	
	function blanketgotopage()
	{
		var page = document.blanketlistform.pageno.options[document.blanketlistform.pageno.selectedIndex].value;
		
		$("#blanketcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#blanketlist',
					success: 		blanketshowResponse,
		}; 
		$('#blanketlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="blanket-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="blanketclosebutton"></div>
		<div id="blanketformholder"></div>
		<div id="blanketlist">
		<!--<form method="post" action="<?=site_url();?>/blanketlist/index/" id="blanketlistform" name="blanketlistform">-->
		<form method="post" action="<?=current_url();?>" id="blanketlistform" name="blanketlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="blanketcurrsort">
			</div>
			<div id="blanketsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="blanketadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/blanketadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/blanketadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="blanketsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="blanketsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="blanketsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="blanketsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['item__idstring'];?></td><td><?=$row['item__name'];?></td><td><?=$row['item__palleteno'];?></td><td><?=$row['item__codebaru'];?></td><td><?=$row['item__pressntype'];?></td><td><?=number_format($row['item__ac'], 2);?></td><td><?=number_format($row['item__ar'], 2);?></td><td><?=number_format($row['item__thickness'], 2);?></td><td><?=$row['item__bartype'];?></td><td><?=$row['item__movingspeed'];?></td><td><?=number_format($row['item__minquantity'], 2);?></td><td><?=number_format($row['item__maxquantity'], 2);?></td><td><?=$row['item__barorigin'];?></td><td><?=$row['item__barnonbar'];?></td><td><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['item__itemcategory_id'] > 0) echo $row['itemcategory__name'];?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="blanketview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/blanketview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="blanketedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/blanketedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="blanketconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="blanketgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>