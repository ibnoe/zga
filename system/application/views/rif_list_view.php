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
					target:        '#riflist',
					success: 		rifshowResponse,
		}; 
		
		$('#riflistform').submit(function() { 
			$('#riflistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function rifconfirmdelete(delid, obj)
	{
		$('#rif-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', rifconfirmdelete2(delid, obj));
	}
	
	function rifconfirmdelete2(delid, obj)
	{
		$( "#rif-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					rifcalldeletefn('rifdelete', delid, 'riflist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#rif-dialog-confirm').html('');
	}
	
	function rifsortupdown(field, direction)
	{
		$("#rifcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#riflist',
					success: 		rifshowResponse,
		}; 
		$('#riflistform').ajaxSubmit(options);
		return false;
	}
	
	function rifshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#riflist',
					success: 		rifshowResponse,
		}; 
		
		$('#riflistform').submit(function() { 
			$('#riflistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function rifcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function rifadd()
	{
		$('#rifformholder').load('<?=site_url()."/rifadd/";?>', function()
		{$('#rifclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rifformholder' + '\').html(\'\');' + '$(\'' + '#rifclosebutton' + '\').html(\'\');' + '$(\'' + '#riflist' + '\').load(\'<?=site_url();?>/riflist\');' + ';"></input>');
		});	
	}
	
	function rifedit(id)
	{
		$('#rifformholder').load('<?=site_url()."/rifedit/index/";?>' + id, function()
		{$('#rifclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rifformholder' + '\').html(\'\');' + '$(\'' + '#rifclosebutton' + '\').html(\'\');' + '$(\'' + '#riflist' + '\').load(\'<?=site_url();?>/riflist\');' + ';"></input>');
		});	
	}
	
	function rifview(id)
	{
		$('#rifformholder').load('<?=site_url()."/rifview/index/";?>' + id, function()
		{$('#rifclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#rifformholder' + '\').html(\'\');' + '$(\'' + '#rifclosebutton' + '\').html(\'\');' + '$(\'' + '#riflist' + '\').load(\'<?=site_url();?>/riflist\');' + ';"></input>');
		});	
	}
	
	function rifgotopage()
	{
		var page = document.riflistform.pageno.options[document.riflistform.pageno.selectedIndex].value;
		
		$("#rifcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#riflist',
					success: 		rifshowResponse,
		}; 
		$('#riflistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="rif-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="rifclosebutton"></div>
		<div id="rifformholder"></div>
		<div id="riflist">
		<!--<form method="post" action="<?=site_url();?>/riflist/index/" id="riflistform" name="riflistform">-->
		<form method="post" action="<?=current_url();?>" id="riflistform" name="riflistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="rifcurrsort">
			</div>
			<div id="rifsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="rifadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/rifadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/rifadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="rifsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="rifsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="rifsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="rifsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/rifview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('rifview/index/'.$row['id'], $row['rcn__norif']);?></td><td><?=$row['rcn__incomingrolldate'];?></td><td><?=$row['rcn__incomingrolltime'];?></td><td><?=$row['rcn__identificationdate'];?></td><td><?=$row['rcn__identificationtime'];?></td><td><?=$row['rcn__press'];?></td><td><?php if (isset($row['rcn__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['rcn__customer_id'], $row['customer__firstname']);?></td><td><?=$row['rcn__nodiss'];?></td><td><?=$row['rcn__datercn'];?></td><td align='right'><?=number_format($row['rcn__totalrollerscollected'], 2);?></td><td><?=$row['rcn__lastupdate'];?></td><td><?=$row['rcn__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="rifview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/rifview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="rifedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/rifedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="rifconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="rifgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>