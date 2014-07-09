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
					target:        '#kurs_historylist',
					success: 		kurs_historyshowResponse,
		}; 
		
		$('#kurs_historylistform').submit(function() { 
			$('#kurs_historylistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function kurs_historyconfirmdelete(delid, obj)
	{
		$('#kurs_history-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', kurs_historyconfirmdelete2(delid, obj));
	}
	
	function kurs_historyconfirmdelete2(delid, obj)
	{
		$( "#kurs_history-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					kurs_historycalldeletefn('kurs_historydelete', delid, 'kurs_historylist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#kurs_history-dialog-confirm').html('');
	}
	
	function kurs_historysortupdown(field, direction)
	{
		$("#kurs_historycurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#kurs_historylist',
					success: 		kurs_historyshowResponse,
		}; 
		$('#kurs_historylistform').ajaxSubmit(options);
		return false;
	}
	
	function kurs_historyshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#kurs_historylist',
					success: 		kurs_historyshowResponse,
		}; 
		
		$('#kurs_historylistform').submit(function() { 
			$('#kurs_historylistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function kurs_historycalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function kurs_historyadd()
	{
		$('#kurs_historyformholder').load('<?=site_url()."/kurs_historyadd/";?>', function()
		{$('#kurs_historyclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#kurs_historyformholder' + '\').html(\'\');' + '$(\'' + '#kurs_historyclosebutton' + '\').html(\'\');' + '$(\'' + '#kurs_historylist' + '\').load(\'<?=site_url();?>/kurs_historylist\');' + ';"></input>');
		});	
	}
	
	function kurs_historyedit(id)
	{
		$('#kurs_historyformholder').load('<?=site_url()."/kurs_historyedit/index/";?>' + id, function()
		{$('#kurs_historyclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#kurs_historyformholder' + '\').html(\'\');' + '$(\'' + '#kurs_historyclosebutton' + '\').html(\'\');' + '$(\'' + '#kurs_historylist' + '\').load(\'<?=site_url();?>/kurs_historylist\');' + ';"></input>');
		});	
	}
	
	function kurs_historyview(id)
	{
		$('#kurs_historyformholder').load('<?=site_url()."/kurs_historyview/index/";?>' + id, function()
		{$('#kurs_historyclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#kurs_historyformholder' + '\').html(\'\');' + '$(\'' + '#kurs_historyclosebutton' + '\').html(\'\');' + '$(\'' + '#kurs_historylist' + '\').load(\'<?=site_url();?>/kurs_historylist\');' + ';"></input>');
		});	
	}
	
	function kurs_historygotopage()
	{
		var page = document.kurs_historylistform.pageno.options[document.kurs_historylistform.pageno.selectedIndex].value;
		
		$("#kurs_historycurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#kurs_historylist',
					success: 		kurs_historyshowResponse,
		}; 
		$('#kurs_historylistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="kurs_history-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="kurs_historyclosebutton"></div>
		<div id="kurs_historyformholder"></div>
		<div id="kurs_historylist">
		<!--<form method="post" action="<?=site_url();?>/kurs_historylist/index/" id="kurs_historylistform" name="kurs_historylistform">-->
		<form method="post" action="<?=current_url();?>" id="kurs_historylistform" name="kurs_historylistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="kurs_historycurrsort">
			</div>
			<div id="kurs_historysort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="kurs_historyadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/kurs_historyadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/kurs_historyadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="kurs_historysortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="kurs_historysortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="kurs_historysortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="kurs_historysortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/kurs_historyview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('kurs_historyview/index/'.$row['id'], $row['kurshistory__idstring']);?></td><td><?=$row['kurshistory__date'];?></td><td><?php if (isset($row['kurshistory__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['kurshistory__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['kurshistory__value'], 2);?></td><td><?=$row['kurshistory__notes'];?></td><td><?=$row['kurshistory__lastupdate'];?></td><td><?=$row['kurshistory__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="kurs_historyview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/kurs_historyview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="kurs_historyedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/kurs_historyedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="kurs_historyconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="kurs_historygotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>