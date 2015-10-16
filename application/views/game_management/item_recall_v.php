<style type="text/css">
.input_text {
	width: 500px;
}
.input_textarea {
	width: 500px;
	height: 150px;
}
table.item_recall_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.item_recall_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.item_recall_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script>

</script>

<section id="content">
	<p>
	<form method="post" action="/game_management/item_recall/recall_all_item">
	<table class="item_recall_table">
		<thead>
			<tr>
				<th scope="col">
					유저 닉네임 리스트
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
	<table class="item_recall_table">
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
	<table class="item_recall_table">
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
	<input type="submit" name="recall_button" value="회수" />
	</p>
	</form>
	</p>
	
	<p>
	<table class="item_recall_table">
		<thead>
			<tr>
				<th scope="col">
					회수 결과
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td scope="row" >
					<textarea name="result_text" class="input_textarea" readonly="readonly">아직사용안함</textarea>
				</td>
			</tr>
		</tbody>
	</table>
	</p>
</section>