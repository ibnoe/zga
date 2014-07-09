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
					target:        '#karyawanlist',
					success: 		karyawanshowResponse,
		}; 
		
		$('#karyawanlistform').submit(function() { 
			$('#karyawanlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function karyawanconfirmdelete(delid, obj)
	{
		$('#karyawan-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', karyawanconfirmdelete2(delid, obj));
	}
	
	function karyawanconfirmdelete2(delid, obj)
	{
		$( "#karyawan-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					karyawancalldeletefn('karyawandelete', delid, 'karyawanlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#karyawan-dialog-confirm').html('');
	}
	
	function karyawansortupdown(field, direction)
	{
		$("#karyawancurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#karyawanlist',
					success: 		karyawanshowResponse,
		}; 
		$('#karyawanlistform').ajaxSubmit(options);
		return false;
	}
	
	function karyawanshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#karyawanlist',
					success: 		karyawanshowResponse,
		}; 
		
		$('#karyawanlistform').submit(function() { 
			$('#karyawanlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function karyawancalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function karyawanadd()
	{
		$('#karyawanformholder').load('<?=site_url()."/karyawanadd/";?>', function()
		{$('#karyawanclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#karyawanformholder' + '\').html(\'\');' + '$(\'' + '#karyawanclosebutton' + '\').html(\'\');' + '$(\'' + '#karyawanlist' + '\').load(\'<?=site_url();?>/karyawanlist\');' + ';"></input>');
		});	
	}
	
	function karyawanedit(id)
	{
		$('#karyawanformholder').load('<?=site_url()."/karyawanedit/index/";?>' + id, function()
		{$('#karyawanclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#karyawanformholder' + '\').html(\'\');' + '$(\'' + '#karyawanclosebutton' + '\').html(\'\');' + '$(\'' + '#karyawanlist' + '\').load(\'<?=site_url();?>/karyawanlist\');' + ';"></input>');
		});	
	}
	
	function karyawanview(id)
	{
		$('#karyawanformholder').load('<?=site_url()."/karyawanview/index/";?>' + id, function()
		{$('#karyawanclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#karyawanformholder' + '\').html(\'\');' + '$(\'' + '#karyawanclosebutton' + '\').html(\'\');' + '$(\'' + '#karyawanlist' + '\').load(\'<?=site_url();?>/karyawanlist\');' + ';"></input>');
		});	
	}
	
	function karyawangotopage()
	{
		var page = document.karyawanlistform.pageno.options[document.karyawanlistform.pageno.selectedIndex].value;
		
		$("#karyawancurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#karyawanlist',
					success: 		karyawanshowResponse,
		}; 
		$('#karyawanlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="karyawan-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="karyawanclosebutton"></div>
		<div id="karyawanformholder"></div>
		<div id="karyawanlist">
		<!--<form method="post" action="<?=site_url();?>/karyawanlist/index/" id="karyawanlistform" name="karyawanlistform">-->
		<form method="post" action="<?=current_url();?>" id="karyawanlistform" name="karyawanlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="karyawancurrsort">
			</div>
			<div id="karyawansort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="karyawanadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/karyawanadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/karyawanadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="karyawansortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="karyawansortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="karyawansortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="karyawansortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/karyawanview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('karyawanview/index/'.$row['id'], $row['karyawan__idstring']);?></td><td><?=$row['karyawan__name'];?></td><td><?=$row['karyawan__gender'];?></td><td><?=$row['karyawan__address'];?></td><td><?=$row['karyawan__phone1'];?></td><td><?=$row['karyawan__phone2'];?></td><td><?=$row['karyawan__dob'];?></td><td><?=$row['karyawan__education'];?></td><td><?=$row['karyawan__religion'];?></td><td><?=$row['karyawan__joindate'];?></td><td><?=$row['karyawan__department'];?></td><td><?=$row['karyawan__gol'];?></td><td><?=$row['karyawan__endprobationdate'];?></td><td><?=$row['karyawan__rekbca'];?></td><td><?=$row['karyawan__cabbca'];?></td><td><?=$row['karyawan__notes'];?></td><td><?=$row['karyawan__status'];?></td><td><?=$row['karyawan__lastupdate'];?></td><td><?=$row['karyawan__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="karyawanview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/karyawanview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="karyawanedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/karyawanedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="karyawanconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="karyawangotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>