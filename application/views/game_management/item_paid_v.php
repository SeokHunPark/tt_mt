<style type="text/css">
.input_text {
	width: 500px;
}
.input_textarea {
	resize: none;
	width: 500px;
	height: 150px;
}
table.item_paid_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.item_paid_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.item_paid_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script>

</script>

<section id="content">
	<fieldset>
		<div>
			<input type="checkbox" name="" value="유저 아이디">
			<input type="checkbox" name="" value="">
		</div>
	</fieldset>
	
	<p>
	<form method="post" action="/game_management/item_paid/send_all_item" >
	<table class="item_paid_table">
		<thead>
			<tr>
				<th scope="col">
					유저 리스트
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td scope="row" >
					<textarea name="user_list_text" class="input_textarea"></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="item_paid_table">
		<thead>
			<tr>
				<th scope="col">
					아이템 목록
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td scope="row" >
					<textarea name="item_list_text" class="input_textarea"></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="item_paid_table">
		<thead>
			<tr>
				<th scope="col">
					내용
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td scope="row" >
					<input name="message_text" class="input_text" />
				</td>
			</tr>
		</tbody>
	</table>
	<p>
	<input type="submit" name="send_button" value="발송" />
	</p>
	</form>
	</p>
</section>