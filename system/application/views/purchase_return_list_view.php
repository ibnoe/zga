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
					target:        '#purchase_returnlist',
					success: 		purchase_returnshowResponse,
		}; 
		
		$('#purchase_returnlistform').submit(function() { 
			$('#purchase_returnlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_returnconfirmdelete(delid, obj)
	{
		$('#purchase_return-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_returnconfirmdelete2(delid, obj));
	}
	
	function purchase_returnconfirmdelete2(delid, obj)
	{
		$( "#purchase_return-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_returncalldeletefn('purchase_returndelete', delid, 'purchase_returnlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_return-dialog-confirm').html('');
	}
	
	function purchase_returnsortupdown(field, direction)
	{
		$("#purchase_returncurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_returnlist',
					success: 		purchase_returnshowResponse,
		}; 
		$('#purchase_returnlistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_returnshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_returnlist',
					success: 		purchase_returnshowResponse,
		}; 
		
		$('#purchase_returnlistform').submit(function() { 
			$('#purchase_returnlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_returncalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_returnadd()
	{
		$('#purchase_returnformholder').load('<?=site_url()."/purchase_returnadd/";?>', function()
		{$('#purchase_returnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_returnformholder' + '\').html(\'\');' + '$(\'' + '#purchase_returnclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_returnlist' + '\').load(\'<?=site_url();?>/purchase_returnlist\');' + ';"></input>');
		});	
	}
	
	function purchase_returnedit(id)
	{
		$('#purchase_returnformholder').load('<?=site_url()."/purchase_returnedit/index/";?>' + id, function()
		{$('#purchase_returnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_returnformholder' + '\').html(\'\');' + '$(\'' + '#purchase_returnclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_returnlist' + '\').load(\'<?=site_url();?>/purchase_returnlist\');' + ';"></input>');
		});	
	}
	
	function purchase_returnview(id)
	{
		$('#purchase_returnformholder').load('<?=site_url()."/purchase_returnview/index/";?>' + id, function()
		{$('#purchase_returnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_returnformholder' + '\').html(\'\');' + '$(\'' + '#purchase_returnclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_returnlist' + '\').load(\'<?=site_url();?>/purchase_returnlist\');' + ';"></input>');
		});	
	}
	
	function purchase_returngotopage()
	{
		var page = document.purchase_returnlistform.pageno.options[document.purchase_returnlistform.pageno.selectedIndex].value;
		
		$("#purchase_returncurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_returnlist',
					success: 		purchase_returnshowResponse,
		}; 
		$('#purchase_returnlistform').ajaxSubmit(options);
	}
	
</script>

		<h3></h3>
		<div id="purchase_return-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_returnclosebutton"></div>
		<div id="purchase_returnformholder"></div>
		<div id="purchase_returnlist">
		<form method="post" action="<?=site_url();?>/purchase_returnlist/index/" id="purchase_returnlistform" name="purchase_returnlistform">
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_returncurrsort">
			</div>
			<div id="purchase_returnsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="purchase_returnadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_returnadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_returnadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="purchase_returnsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_returnsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchase_returnsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_returnsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=$row['preturn__orderid'];?></td><td><?=$row['preturn__date'];?></td><td><?=anchor('purchase_orderview/index/'.$row['id'], $row['porder__orderid']);?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=$row['preturn__orderid'];?></td><td><?=$row['preturn__date'];?></td><td><?=anchor('purchase_orderview/index/'.$row['id'], $row['porder__orderid']);?></td><td><?=anchor('locationview/index/'.$row['id'], $row['contact__firstname']);?></td><td><?=$row['preturn__'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_returnview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_returnview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_returnedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_returnedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_returnconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_returngotopage();"');?>
			<?php endif; ?>
			</b>
			
		</form>
		</div>