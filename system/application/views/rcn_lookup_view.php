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
					target:        '#rcnlist',
					success: 		rcnshowResponse,
		}; 
		
		$('#rcnlistform').submit(function() { 
			$('#rcnlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function rcnconfirmdelete(delid, obj)
	{
		$('#rcn-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', rcnconfirmdelete2(delid, obj));
	}
	
	function rcnconfirmdelete2(delid, obj)
	{
		$( "#rcn-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					rcncalldeletefn('rcndelete', delid, 'rcnlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rcn-dialog-confirm').html('');
	}
	
	function rcnsortupdown(field, direction)
	{
		$("#rcncurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#rcnlist',
					success: 		rcnshowResponse,
		}; 
		$('#rcnlistform').ajaxSubmit(options);
		return false;
	}
	
	function rcnshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#rcnlist',
					success: 		rcnshowResponse,
		}; 
		
		$('#rcnlistform').submit(function() { 
			$('#rcnlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function rcncalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function rcnadd()
	{
		$('#rcnformholder').load('<?=site_url()."/rcnadd/";?>', function()
		{$('#rcnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rcnformholder' + '\').html(\'\');' + '$(\'' + '#rcnclosebutton' + '\').html(\'\');' + '$(\'' + '#rcnlist' + '\').load(\'<?=site_url();?>/rcnlist\');' + ';"></input>');
		});	
	}
	
	function rcnedit(id)
	{
		$('#rcnformholder').load('<?=site_url()."/rcnedit/index/";?>' + id, function()
		{$('#rcnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rcnformholder' + '\').html(\'\');' + '$(\'' + '#rcnclosebutton' + '\').html(\'\');' + '$(\'' + '#rcnlist' + '\').load(\'<?=site_url();?>/rcnlist\');' + ';"></input>');
		});	
	}
	
	function rcnview(id)
	{
		$('#rcnformholder').load('<?=site_url()."/rcnview/index/";?>' + id, function()
		{$('#rcnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rcnformholder' + '\').html(\'\');' + '$(\'' + '#rcnclosebutton' + '\').html(\'\');' + '$(\'' + '#rcnlist' + '\').load(\'<?=site_url();?>/rcnlist\');' + ';"></input>');
		});	
	}
	
	function rcngotopage()
	{
		var page = document.rcnlistform.pageno.options[document.rcnlistform.pageno.selectedIndex].value;
		
		$("#rcncurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#rcnlist',
					success: 		rcnshowResponse,
		}; 
		$('#rcnlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="rcn-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="rcnclosebutton"></div>
		<div id="rcnformholder"></div>
		<div id="rcnlist">
		<!--<form method="post" action="<?=site_url();?>/rcnlist/index/" id="rcnlistform" name="rcnlistform">-->
		<form method="post" action="<?=current_url();?>" id="rcnlistform" name="rcnlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="rcncurrsort">
			</div>
			<div id="rcnsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="rcnadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/rcnadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/rcnadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="rcnsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="rcnsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="rcnsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="rcnsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['rcn__norif'];?></td><td><?=$row['rcn__norcn'];?></td><td><?=$row['rcn__customerponumber'];?></td><td><?=$row['rcn__datercn'];?></td><td><?php if (isset($row['rcn__customer_id']) && $row['rcn__customer_id'] > 0) echo $row['customer__firstname'];?></td><td><?php if ($row['rcn__reqtorecover'] != 0) echo 'Yes'; else echo '';?></td><td><?php if ($row['rcn__reqcoretoreturn'] != 0) echo 'Yes'; else echo '';?></td><td><?php if ($row['rcn__reqreturnunused'] != 0) echo 'Yes'; else echo '';?></td><td><?php if ($row['rcn__reqreturnfaulty'] != 0) echo 'Yes'; else echo '';?></td><td><?php if ($row['rcn__reqothers'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['rcn__notes'];?></td><td><?=$row['rcn__status'];?></td><td align='right'><?=number_format($row['rcn__totalrollerscollected'], 2);?></td><td><?=$row['rcn__lastupdate'];?></td><td><?=$row['rcn__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="rcnview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/rcnview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="rcnedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/rcnedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="rcnconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="rcngotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>