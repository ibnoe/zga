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
					target:        '#merk_mesinlist',
					success: 		merk_mesinshowResponse,
		}; 
		
		$('#merk_mesinlistform').submit(function() { 
			$('#merk_mesinlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function merk_mesinconfirmdelete(delid, obj)
	{
		$('#merk_mesin-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', merk_mesinconfirmdelete2(delid, obj));
	}
	
	function merk_mesinconfirmdelete2(delid, obj)
	{
		$( "#merk_mesin-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					merk_mesincalldeletefn('merk_mesindelete', delid, 'merk_mesinlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#merk_mesin-dialog-confirm').html('');
	}
	
	function merk_mesinsortupdown(field, direction)
	{
		$("#merk_mesincurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#merk_mesinlist',
					success: 		merk_mesinshowResponse,
		}; 
		$('#merk_mesinlistform').ajaxSubmit(options);
		return false;
	}
	
	function merk_mesinshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#merk_mesinlist',
					success: 		merk_mesinshowResponse,
		}; 
		
		$('#merk_mesinlistform').submit(function() { 
			$('#merk_mesinlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function merk_mesincalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function merk_mesinadd()
	{
		$('#merk_mesinformholder').load('<?=site_url()."/merk_mesinadd/";?>', function()
		{$('#merk_mesinclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#merk_mesinformholder' + '\').html(\'\');' + '$(\'' + '#merk_mesinclosebutton' + '\').html(\'\');' + '$(\'' + '#merk_mesinlist' + '\').load(\'<?=site_url();?>/merk_mesinlist\');' + ';"></input>');
		});	
	}
	
	function merk_mesinedit(id)
	{
		$('#merk_mesinformholder').load('<?=site_url()."/merk_mesinedit/index/";?>' + id, function()
		{$('#merk_mesinclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#merk_mesinformholder' + '\').html(\'\');' + '$(\'' + '#merk_mesinclosebutton' + '\').html(\'\');' + '$(\'' + '#merk_mesinlist' + '\').load(\'<?=site_url();?>/merk_mesinlist\');' + ';"></input>');
		});	
	}
	
	function merk_mesinview(id)
	{
		$('#merk_mesinformholder').load('<?=site_url()."/merk_mesinview/index/";?>' + id, function()
		{$('#merk_mesinclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#merk_mesinformholder' + '\').html(\'\');' + '$(\'' + '#merk_mesinclosebutton' + '\').html(\'\');' + '$(\'' + '#merk_mesinlist' + '\').load(\'<?=site_url();?>/merk_mesinlist\');' + ';"></input>');
		});	
	}
	
	function merk_mesingotopage()
	{
		var page = document.merk_mesinlistform.pageno.options[document.merk_mesinlistform.pageno.selectedIndex].value;
		
		$("#merk_mesincurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#merk_mesinlist',
					success: 		merk_mesinshowResponse,
		}; 
		$('#merk_mesinlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="merk_mesin-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="merk_mesinclosebutton"></div>
		<div id="merk_mesinformholder"></div>
		<div id="merk_mesinlist">
		<!--<form method="post" action="<?=site_url();?>/merk_mesinlist/index/" id="merk_mesinlistform" name="merk_mesinlistform">-->
		<form method="post" action="<?=current_url();?>" id="merk_mesinlistform" name="merk_mesinlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="merk_mesincurrsort">
			</div>
			<div id="merk_mesinsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="merk_mesinadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/merk_mesinadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/merk_mesinadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="merk_mesinsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="merk_mesinsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="merk_mesinsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="merk_mesinsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/merk_mesinview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('merk_mesinview/index/'.$row['id'], $row['merkmesin__idstring']);?></td><td><?=$row['merkmesin__name'];?></td><td><?=$row['merkmesin__lastupdate'];?></td><td><?=$row['merkmesin__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="merk_mesinview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/merk_mesinview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="merk_mesinedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/merk_mesinedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="merk_mesinconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="merk_mesingotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>