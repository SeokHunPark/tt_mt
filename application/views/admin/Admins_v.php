<style type="text/css">
table.admin_list_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.admin_list_table th {
	width: 180;
	border: 1px solid black;
	border-spacing: 0px;
 }
.admin_list_table td {
	width: 250;
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script>
</script>

<section id="content">	
	<table id="admin_list_table">
		<thead>
			<tr>
				<th scope="col">NO.</th>
				<th scope="col">아이디</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($admin_list as $admin)
			{
			?>
				<form id="delete_word" method="post" action="/banned_word/delete_word">
				<tr>
					<th scope="row">
						<?php echo $admin->user_idx; ?>
						<input type="hidden" name="word_index" value="<? echo $admin->user_idx;?>" />
					</th>
					<td>
						<?php echo $admin->user_name; ?>
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