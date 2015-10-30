<style type="text/css">
.input_text {
	width: 100%;
}
table.log_list_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.log_list_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.log_list_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script>

</script>

<section id="content">
	<p>
	<table class="log_list_table">
		<thead>
			<tr>
				<th scope="col">동시 접속자 수</th>
				<th scope="col">갱신 시간</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">
					<?php echo $cu_info->android_user; ?>
				</th>
				<td>
					<?php echo $cu_info->reg_date; ?>
				</td>
			</tr>
		</tbody>
	</table>
	</p>
	
	
</section>