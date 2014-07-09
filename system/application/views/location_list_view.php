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
					target:        '#locationlist',
					success: 		locationshowResponse,
		}; 
		
		$('#locationlistform').submit(function() { 
			$('#locationlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function locationconfirmdelete(delid, obj)
	{
		$('#location-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', locationconfirmdelete2(delid, obj));
	}
	
	function locationconfirmdelete2(delid, obj)
	{
		$( "#location-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					locationcalldeletefn('locationdelete', delid, 'locationlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#location-dialog-confirm').html('');
	}
	
	function locationsortupdown(field, direction)
	{
		$("#locationcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#locationlist',
					success: 		locationshowResponse,
		}; 
		$('#locationlistform').ajaxSubmit(options);
		return false;
	}
	
	function locationshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#locationlist',
					success: 		locationshowResponse,
		}; 
		
		$('#locationlistform').submit(function() { 
			$('#locationlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function locationcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function locationadd()
	{
		$('#locationformholder').load('<?=site_url()."/locationadd/";?>', function()
		{$('#locationclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#locationformholder' + '\').html(\'\');' + '$(\'' + '#locationclosebutton' + '\').html(\'\');' + '$(\'' + '#locationlist' + '\').load(\'<?=site_url();?>/locationlist\');' + ';"></input>');
		});	
	}
	
	function locationedit(id)
	{
		$('#locationformholder').load('<?=site_url()."/locationedit/index/";?>' + id, function()
		{$('#locationclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#locationformholder' + '\').html(\'\');' + '$(\'' + '#locationclosebutton' + '\').html(\'\');' + '$(\'' + '#locationlist' + '\').load(\'<?=site_url();?>/locationlist\');' + ';"></input>');
		});	
	}
	
	function locationview(id)
	{
		$('#locationformholder').load('<?=site_url()."/locationview/index/";?>' + id, function()
		{$('#locationclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#locationformholder' + '\').html(\'\');' + '$(\'' + '#locationclosebutton' + '\').html(\'\');' + '$(\'' + '#locationlist' + '\').load(\'<?=site_url();?>/locationlist\');' + ';"></input>');
		});	
	}
	
	function locationgotopage()
	{
		var page = document.locationlistform.pageno.options[document.locationlistform.pageno.selectedIndex].value;
		
		$("#locationcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#locationlist',
					success: 		locationshowResponse,
		}; 
		$('#locationlistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="location-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="locationclosebutton"></div>
		<div id="locationformholder"></div>
		<div id="locationlist">
		<form method="post" action="<?=site_url();?>/locationlist/index/" id="locationlistform" name="locationlistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="locationcurrsort">
			</div>
			<div id="locationsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="locationadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/locationadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/locationadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="locationsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="locationsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="locationsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="locationsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['contact__firstname'];?></td><td><?=$row['contact__address'];?></td><td><?=$row['contact__phone'];?></td><td><?=$row['contact__fax'];?></td><td><?=$row['contact__email'];?></td><td><?=$row['contact__iscustomer'];?></td><td><?=$row['contact__issupplier'];?></td><td><?=$row['contact__iswarehouse'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="locationview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/locationview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="locationedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/locationedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="locationconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="locationgotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>