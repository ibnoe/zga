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
					target:        '#reject_manufacturinglist',
					success: 		reject_manufacturingshowResponse,
		}; 
		
		$('#reject_manufacturinglistform').submit(function() { 
			$('#reject_manufacturinglistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function reject_manufacturingconfirmdelete(delid, obj)
	{
		$('#reject_manufacturing-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', reject_manufacturingconfirmdelete2(delid, obj));
	}
	
	function reject_manufacturingconfirmdelete2(delid, obj)
	{
		$( "#reject_manufacturing-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					reject_manufacturingcalldeletefn('reject_manufacturingdelete', delid, 'reject_manufacturinglist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#reject_manufacturing-dialog-confirm').html('');
	}
	
	function reject_manufacturingsortupdown(field, direction)
	{
		$("#reject_manufacturingcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#reject_manufacturinglist',
					success: 		reject_manufacturingshowResponse,
		}; 
		$('#reject_manufacturinglistform').ajaxSubmit(options);
		return false;
	}
	
	function reject_manufacturingshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#reject_manufacturinglist',
					success: 		reject_manufacturingshowResponse,
		}; 
		
		$('#reject_manufacturinglistform').submit(function() { 
			$('#reject_manufacturinglistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function reject_manufacturingcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function reject_manufacturingadd()
	{
		$('#reject_manufacturingformholder').load('<?=site_url()."/reject_manufacturingadd/";?>', function()
		{$('#reject_manufacturingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#reject_manufacturingformholder' + '\').html(\'\');' + '$(\'' + '#reject_manufacturingclosebutton' + '\').html(\'\');' + '$(\'' + '#reject_manufacturinglist' + '\').load(\'<?=site_url();?>/reject_manufacturinglist\');' + ';"></input>');
		});	
	}
	
	function reject_manufacturingedit(id)
	{
		$('#reject_manufacturingformholder').load('<?=site_url()."/reject_manufacturingedit/index/";?>' + id, function()
		{$('#reject_manufacturingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#reject_manufacturingformholder' + '\').html(\'\');' + '$(\'' + '#reject_manufacturingclosebutton' + '\').html(\'\');' + '$(\'' + '#reject_manufacturinglist' + '\').load(\'<?=site_url();?>/reject_manufacturinglist\');' + ';"></input>');
		});	
	}
	
	function reject_manufacturingview(id)
	{
		$('#reject_manufacturingformholder').load('<?=site_url()."/reject_manufacturingview/index/";?>' + id, function()
		{$('#reject_manufacturingclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#reject_manufacturingformholder' + '\').html(\'\');' + '$(\'' + '#reject_manufacturingclosebutton' + '\').html(\'\');' + '$(\'' + '#reject_manufacturinglist' + '\').load(\'<?=site_url();?>/reject_manufacturinglist\');' + ';"></input>');
		});	
	}
	
	function reject_manufacturinggotopage()
	{
		var page = document.reject_manufacturinglistform.pageno.options[document.reject_manufacturinglistform.pageno.selectedIndex].value;
		
		$("#reject_manufacturingcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#reject_manufacturinglist',
					success: 		reject_manufacturingshowResponse,
		}; 
		$('#reject_manufacturinglistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="reject_manufacturing-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="reject_manufacturingclosebutton"></div>
		<div id="reject_manufacturingformholder"></div>
		<div id="reject_manufacturinglist">
		<!--<form method="post" action="<?=site_url();?>/reject_manufacturinglist/index/" id="reject_manufacturinglistform" name="reject_manufacturinglistform">-->
		<form method="post" action="<?=current_url();?>" id="reject_manufacturinglistform" name="reject_manufacturinglistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="reject_manufacturingcurrsort">
			</div>
			<div id="reject_manufacturingsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="reject_manufacturingadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/reject_manufacturingadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/reject_manufacturingadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="reject_manufacturingsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="reject_manufacturingsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="reject_manufacturingsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="reject_manufacturingsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/reject_manufacturingview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('reject_manufacturingview/index/'.$row['id'], $row['rejectmanufacturing__idstring']);?></td><td><?=$row['rejectmanufacturing__date'];?></td><td><?php if (isset($row['rejectmanufacturing__manufacturingrejectreason_id']) && $row['manufacturingrejectreason__name'] != "") echo anchor('manufacturing_reject_reasonview/index/'.$row['rejectmanufacturing__manufacturingrejectreason_id'], $row['manufacturingrejectreason__name']);?></td><td><?=$row['rejectmanufacturing__notes'];?></td><td><?=$row['rejectmanufacturing__lastupdate'];?></td><td><?=$row['rejectmanufacturing__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="reject_manufacturingview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/reject_manufacturingview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="reject_manufacturingedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/reject_manufacturingedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="reject_manufacturingconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="reject_manufacturinggotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>