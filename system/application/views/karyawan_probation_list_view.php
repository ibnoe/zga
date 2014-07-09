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
					target:        '#karyawan_probationlist',
					success: 		karyawan_probationshowResponse,
		}; 
		
		$('#karyawan_probationlistform').submit(function() { 
			$('#karyawan_probationlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function karyawan_probationconfirmdelete(delid, obj)
	{
		$('#karyawan_probation-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', karyawan_probationconfirmdelete2(delid, obj));
	}
	
	function karyawan_probationconfirmdelete2(delid, obj)
	{
		$( "#karyawan_probation-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					karyawan_probationcalldeletefn('karyawan_probationdelete', delid, 'karyawan_probationlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#karyawan_probation-dialog-confirm').html('');
	}
	
	function karyawan_probationsortupdown(field, direction)
	{
		$("#karyawan_probationcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#karyawan_probationlist',
					success: 		karyawan_probationshowResponse,
		}; 
		$('#karyawan_probationlistform').ajaxSubmit(options);
		return false;
	}
	
	function karyawan_probationshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#karyawan_probationlist',
					success: 		karyawan_probationshowResponse,
		}; 
		
		$('#karyawan_probationlistform').submit(function() { 
			$('#karyawan_probationlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function karyawan_probationcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function karyawan_probationadd()
	{
		$('#karyawan_probationformholder').load('<?=site_url()."/karyawan_probationadd/";?>', function()
		{$('#karyawan_probationclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#karyawan_probationformholder' + '\').html(\'\');' + '$(\'' + '#karyawan_probationclosebutton' + '\').html(\'\');' + '$(\'' + '#karyawan_probationlist' + '\').load(\'<?=site_url();?>/karyawan_probationlist\');' + ';"></input>');
		});	
	}
	
	function karyawan_probationedit(id)
	{
		$('#karyawan_probationformholder').load('<?=site_url()."/karyawan_probationedit/index/";?>' + id, function()
		{$('#karyawan_probationclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#karyawan_probationformholder' + '\').html(\'\');' + '$(\'' + '#karyawan_probationclosebutton' + '\').html(\'\');' + '$(\'' + '#karyawan_probationlist' + '\').load(\'<?=site_url();?>/karyawan_probationlist\');' + ';"></input>');
		});	
	}
	
	function karyawan_probationview(id)
	{
		$('#karyawan_probationformholder').load('<?=site_url()."/karyawan_probationview/index/";?>' + id, function()
		{$('#karyawan_probationclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#karyawan_probationformholder' + '\').html(\'\');' + '$(\'' + '#karyawan_probationclosebutton' + '\').html(\'\');' + '$(\'' + '#karyawan_probationlist' + '\').load(\'<?=site_url();?>/karyawan_probationlist\');' + ';"></input>');
		});	
	}
	
	function karyawan_probationgotopage()
	{
		var page = document.karyawan_probationlistform.pageno.options[document.karyawan_probationlistform.pageno.selectedIndex].value;
		
		$("#karyawan_probationcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#karyawan_probationlist',
					success: 		karyawan_probationshowResponse,
		}; 
		$('#karyawan_probationlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="karyawan_probation-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="karyawan_probationclosebutton"></div>
		<div id="karyawan_probationformholder"></div>
		<div id="karyawan_probationlist">
		<!--<form method="post" action="<?=site_url();?>/karyawan_probationlist/index/" id="karyawan_probationlistform" name="karyawan_probationlistform">-->
		<form method="post" action="<?=current_url();?>" id="karyawan_probationlistform" name="karyawan_probationlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="karyawan_probationcurrsort">
			</div>
			<div id="karyawan_probationsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="karyawan_probationadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/karyawan_probationadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/karyawan_probationadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="karyawan_probationsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="karyawan_probationsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="karyawan_probationsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="karyawan_probationsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/karyawan_probationview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('karyawan_probationview/index/'.$row['id'], $row['karyawan__idstring']);?></td><td><?=$row['karyawan__name'];?></td><td><?=$row['karyawan__gender'];?></td><td><?=$row['karyawan__address'];?></td><td><?=$row['karyawan__phone1'];?></td><td><?=$row['karyawan__phone2'];?></td><td><?=$row['karyawan__dob'];?></td><td><?=$row['karyawan__education'];?></td><td><?=$row['karyawan__religion'];?></td><td><?=$row['karyawan__joindate'];?></td><td><?=$row['karyawan__department'];?></td><td><?=$row['karyawan__gol'];?></td><td><?=$row['karyawan__endprobationdate'];?></td><td><?=$row['karyawan__rekbca'];?></td><td><?=$row['karyawan__cabbca'];?></td><td><?=$row['karyawan__notes'];?></td><td><?=$row['karyawan__status'];?></td><td><?=$row['karyawan__lastupdate'];?></td><td><?=$row['karyawan__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="karyawan_probationview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/karyawan_probationview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="karyawan_probationedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/karyawan_probationedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="karyawan_probationconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="karyawan_probationgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>