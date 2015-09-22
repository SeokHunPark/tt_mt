<script>
	$(document).ready(function() {
		$("#search_button").click(function() {
			if ($("#_word_text").val() == '') {
				alert('조회하실 금칙어를 입력하세요.');
				return false;
			} else {
				var act = '/banned_word/load_banned_word_list';
				$("#bd_search").attr('action', act).submit();
			}
		});
	});
	
	function user_search_enter(form) {
		var keycode = window.event.keyCode;
		if (keycode == 13) $("#search_button").click();
	}
	
	
</script>

<section id="content">
	<form id="bd_search" method="post">
	<fieldset>
		<div>
			<input type="text" name="word_text" id="_word_text" />
			<input type="button" value="조회" id="search_button" />
		</div>
	</fieldset>
	</form>
	
	<table id="banned_word_table">
		<thead>
			<tr>
				<th scope="col">NO.</th>
				<th scope="col">금칙어</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($word_list as $word_list_item)
			#for ($i = 0; $i < count($word_list); $i++)
			{
			?>
				<form id="delete_word" method="post" action="banned_word/delete_word">
				<tr>
					<th scope="row">
						<?php echo $word_list_item->word_idx; ?>
						<input type="hidden" name="word_index" value="<?=$word_list_item->word_idx;?>" />
					</th>
					<td>
						<?php echo $word_list_item->word; ?>
					</td>
					<td>
						<input type="submit" value="삭제" name="delete_button" />
					</td>
				</tr>
				</form>
			<?php
			}
			?>
		</tbody>
	</table>
</section>