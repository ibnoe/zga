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
					target:        '#mesinlist',
					success: 		mesinshowResponse,
		}; 
		
		$('#mesinlistform').submit(function() { 
			$('#mesinlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function mesinconfirmdelete(delid, obj)
	{
		$('#mesin-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', mesinconfirmdelete2(delid, obj));
	}
	
	function mesinconfirmdelete2(delid, obj)
	{
		$( "#mesin-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					mesincalldeletefn('mesindelete', delid, 'mesinlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#mesin-dialog-confirm').html('');
	}
	
	function mesinsortupdown(field, direction)
	{
		$("#mesincurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#mesinlist',
					success: 		mesinshowResponse,
		}; 
		$('#mesinlistform').ajaxSubmit(options);
		return false;
	}
	
	function mesinshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#mesinlist',
					success: 		mesinshowResponse,
		}; 
		
		$('#mesinlistform').submit(function() { 
			$('#mesinlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function mesincalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function mesinadd()
	{
		$('#mesinformholder').load('<?=site_url()."/mesinadd/";?>', function()
		{$('#mesinclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#mesinformholder' + '\').html(\'\');' + '$(\'' + '#mesinclosebutton' + '\').html(\'\');' + '$(\'' + '#mesinlist' + '\').load(\'<?=site_url();?>/mesinlist\');' + ';"></input>');
		});	
	}
	
	function mesinedit(id)
	{
		$('#mesinformholder').load('<?=site_url()."/mesinedit/index/";?>' + id, function()
		{$('#mesinclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#mesinformholder' + '\').html(\'\');' + '$(\'' + '#mesinclosebutton' + '\').html(\'\');' + '$(\'' + '#mesinlist' + '\').load(\'<?=site_url();?>/mesinlist\');' + ';"></input>');
		});	
	}
	
	function mesinview(id)
	{
		$('#mesinformholder').load('<?=site_url()."/mesinview/index/";?>' + id, function()
		{$('#mesinclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#mesinformholder' + '\').html(\'\');' + '$(\'' + '#mesinclosebutton' + '\').html(\'\');' + '$(\'' + '#mesinlist' + '\').load(\'<?=site_url();?>/mesinlist\');' + ';"></input>');
		});	
	}
	
	function mesingotopage()
	{
		var page = document.mesinlistform.pageno.options[document.mesinlistform.pageno.selectedIndex].value;
		
		$("#mesincurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#mesinlist',
					success: 		mesinshowResponse,
		}; 
		$('#mesinlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="mesin-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="mesinclosebutton"></div>
		<div id="mesinformholder"></div>
		<div id="mesinlist">
		<!--<form method="post" action="<?=site_url();?>/mesinlist/index/" id="mesinlistform" name="mesinlistform">-->
		<form method="post" action="<?=current_url();?>" id="mesinlistform" name="mesinlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="mesincurrsort">
			</div>
			<div id="mesinsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="mesinadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/mesinadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/mesinadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="mesinsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="mesinsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="mesinsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="mesinsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['mesin__idstring'];?></td><td><?=$row['mesin__typename'];?></td><td><?php if (isset($row['mesin__merkmesin_id']) && $row['mesin__merkmesin_id'] > 0) echo $row['merkmesin__name'];?></td><td><?=$row['mesin__lastupdate'];?></td><td><?=$row['mesin__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="mesinview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/mesinview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="mesinedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/mesinedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="mesinconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="mesingotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>