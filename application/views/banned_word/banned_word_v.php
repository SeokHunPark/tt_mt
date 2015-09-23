<style type="text/css">
table.words_reg_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.words_reg_table th, .words_reg_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }
 
 .words_reg_table .word_col {
	width: 200px;
 }
 .words_reg_table .button_col {
	width: 100px;
 }
</style>

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
	
	<form id="reg_word" method="post" action="banned_word/reg_word">
	<table class="words_reg_table">
		<thead>
			<tr>
				<th scope="col" colspan="2">금칙어 등록</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th scope="col" class="word_col">금칙어</th>
				<th scope="col" class="button_col"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">
					<input type="text" name="word_reg_text" />
				</th>
				<td>
					<input type="submit" value="등록" name="reg_button" />
				</td>
			</tr>
		</tbody>
	</table>
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