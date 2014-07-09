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
					target:        '#customermesinlist',
					success: 		customermesinshowResponse,
		}; 
		
		$('#customermesinlistform').submit(function() { 
			$('#customermesinlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function customermesinconfirmdelete(delid, obj)
	{
		$('#customermesin-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', customermesinconfirmdelete2(delid, obj));
	}
	
	function customermesinconfirmdelete2(delid, obj)
	{
		$( "#customermesin-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					customermesincalldeletefn('customermesindelete', delid, 'customermesinlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#customermesin-dialog-confirm').html('');
	}
	
	function customermesinsortupdown(field, direction)
	{
		$("#customermesincurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#customermesinlist',
					success: 		customermesinshowResponse,
		}; 
		$('#customermesinlistform').ajaxSubmit(options);
		return false;
	}
	
	function customermesinshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#customermesinlist',
					success: 		customermesinshowResponse,
		}; 
		
		$('#customermesinlistform').submit(function() { 
			$('#customermesinlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function customermesincalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function customermesinadd()
	{
		$('#customermesinformholder').load('<?=site_url()."/customermesinadd/";?>', function()
		{$('#customermesinclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#customermesinformholder' + '\').html(\'\');' + '$(\'' + '#customermesinclosebutton' + '\').html(\'\');' + '$(\'' + '#customermesinlist' + '\').load(\'<?=site_url();?>/customermesinlist\');' + ';"></input>');
		});	
	}
	
	function customermesinedit(id)
	{
		$('#customermesinformholder').load('<?=site_url()."/customermesinedit/index/";?>' + id, function()
		{$('#customermesinclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#customermesinformholder' + '\').html(\'\');' + '$(\'' + '#customermesinclosebutton' + '\').html(\'\');' + '$(\'' + '#customermesinlist' + '\').load(\'<?=site_url();?>/customermesinlist\');' + ';"></input>');
		});	
	}
	
	function customermesinview(id)
	{
		$('#customermesinformholder').load('<?=site_url()."/customermesinview/index/";?>' + id, function()
		{$('#customermesinclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#customermesinformholder' + '\').html(\'\');' + '$(\'' + '#customermesinclosebutton' + '\').html(\'\');' + '$(\'' + '#customermesinlist' + '\').load(\'<?=site_url();?>/customermesinlist\');' + ';"></input>');
		});	
	}
	
	function customermesingotopage()
	{
		var page = document.customermesinlistform.pageno.options[document.customermesinlistform.pageno.selectedIndex].value;
		
		$("#customermesincurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#customermesinlist',
					success: 		customermesinshowResponse,
		}; 
		$('#customermesinlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="customermesin-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="customermesinclosebutton"></div>
		<div id="customermesinformholder"></div>
		<div id="customermesinlist">
		<!--<form method="post" action="<?=site_url();?>/customermesinlist/index/" id="customermesinlistform" name="customermesinlistform">-->
		<form method="post" action="<?=current_url();?>" id="customermesinlistform" name="customermesinlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="customermesincurrsort">
			</div>
			<div id="customermesinsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="customermesinadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/customermesinadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/customermesinadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="customermesinsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="customermesinsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="customermesinsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="customermesinsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/customermesinview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?php if (isset($row['customermesin__mesin_id']) && $row['mesin__typename'] != "") echo anchor('mesinview/index/'.$row['customermesin__mesin_id'], $row['mesin__typename']);?></td><td><?=anchor('customermesinview/index/'.$row['id'], $row['customermesin__nomesin']);?></td><td><?=$row['customermesin__noserimesin'];?></td><td><?=$row['customermesin__tahun'];?></td><td><?=$row['customermesin__konfigurasi'];?></td><td><?=$row['customermesin__jumlahblanket'];?></td><td><?=$row['customermesin__jumlahroll'];?></td><td><?=$row['customermesin__notes'];?></td><td><?=$row['customermesin__lastupdate'];?></td><td><?=$row['customermesin__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="customermesinview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/customermesinview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="customermesinedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/customermesinedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="customermesinconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="customermesingotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>