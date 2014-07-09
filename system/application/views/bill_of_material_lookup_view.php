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
					target:        '#bill_of_materiallist',
					success: 		bill_of_materialshowResponse,
		}; 
		
		$('#bill_of_materiallistform').submit(function() { 
			$('#bill_of_materiallistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function bill_of_materialconfirmdelete(delid, obj)
	{
		$('#bill_of_material-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', bill_of_materialconfirmdelete2(delid, obj));
	}
	
	function bill_of_materialconfirmdelete2(delid, obj)
	{
		$( "#bill_of_material-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					bill_of_materialcalldeletefn('bill_of_materialdelete', delid, 'bill_of_materiallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#bill_of_material-dialog-confirm').html('');
	}
	
	function bill_of_materialsortupdown(field, direction)
	{
		$("#bill_of_materialcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#bill_of_materiallist',
					success: 		bill_of_materialshowResponse,
		}; 
		$('#bill_of_materiallistform').ajaxSubmit(options);
		return false;
	}
	
	function bill_of_materialshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#bill_of_materiallist',
					success: 		bill_of_materialshowResponse,
		}; 
		
		$('#bill_of_materiallistform').submit(function() { 
			$('#bill_of_materiallistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function bill_of_materialcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function bill_of_materialadd()
	{
		$('#bill_of_materialformholder').load('<?=site_url()."/bill_of_materialadd/";?>', function()
		{$('#bill_of_materialclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#bill_of_materialformholder' + '\').html(\'\');' + '$(\'' + '#bill_of_materialclosebutton' + '\').html(\'\');' + '$(\'' + '#bill_of_materiallist' + '\').load(\'<?=site_url();?>/bill_of_materiallist\');' + ';"></input>');
		});	
	}
	
	function bill_of_materialedit(id)
	{
		$('#bill_of_materialformholder').load('<?=site_url()."/bill_of_materialedit/index/";?>' + id, function()
		{$('#bill_of_materialclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#bill_of_materialformholder' + '\').html(\'\');' + '$(\'' + '#bill_of_materialclosebutton' + '\').html(\'\');' + '$(\'' + '#bill_of_materiallist' + '\').load(\'<?=site_url();?>/bill_of_materiallist\');' + ';"></input>');
		});	
	}
	
	function bill_of_materialview(id)
	{
		$('#bill_of_materialformholder').load('<?=site_url()."/bill_of_materialview/index/";?>' + id, function()
		{$('#bill_of_materialclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#bill_of_materialformholder' + '\').html(\'\');' + '$(\'' + '#bill_of_materialclosebutton' + '\').html(\'\');' + '$(\'' + '#bill_of_materiallist' + '\').load(\'<?=site_url();?>/bill_of_materiallist\');' + ';"></input>');
		});	
	}
	
	function bill_of_materialgotopage()
	{
		var page = document.bill_of_materiallistform.pageno.options[document.bill_of_materiallistform.pageno.selectedIndex].value;
		
		$("#bill_of_materialcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#bill_of_materiallist',
					success: 		bill_of_materialshowResponse,
		}; 
		$('#bill_of_materiallistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="bill_of_material-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="bill_of_materialclosebutton"></div>
		<div id="bill_of_materialformholder"></div>
		<div id="bill_of_materiallist">
		<!--<form method="post" action="<?=site_url();?>/bill_of_materiallist/index/" id="bill_of_materiallistform" name="bill_of_materiallistform">-->
		<form method="post" action="<?=current_url();?>" id="bill_of_materiallistform" name="bill_of_materiallistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="bill_of_materialcurrsort">
			</div>
			<div id="bill_of_materialsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="bill_of_materialadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/bill_of_materialadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/bill_of_materialadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="bill_of_materialsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="bill_of_materialsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="bill_of_materialsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="bill_of_materialsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['bom__name'];?></td><td><?=$row['bom__lastupdate'];?></td><td><?=$row['bom__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="bill_of_materialview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/bill_of_materialview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="bill_of_materialedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/bill_of_materialedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="bill_of_materialconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="bill_of_materialgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>