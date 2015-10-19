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
	<fieldset>
		<form method="post" action="/admin/log_cstool/load_log/date_search">
		<div>
			기간 설정
			<input type="text" name="begin_year" />
			<input type="text" name="begin_month" />
			<input type="text" name="begin_day" />
			~
			<input type="text" name="end_year" />
			<input type="text" name="end_month" />
			<input type="text" name="end_day" />
			<input type="submit" name="date_search" value="검색" />			
		</div>
		</form>
		
		<form method="post" action="/admin/log_cstool/load_log/user_search">
		<div>
			관리자 이름
			<input type="text" name="admin_name_text" />
			게임 회원번호
			<input type="text" name="game_account_id_text" />
			닉네임
			<input type="text" name="nickname_text" />
			<input type="submit" name="user_search" value="검색" />
		</div>
		</form>
	</fieldset>
	
	<p>
	<table class="log_list_table">
		<thead>
			<tr>
				<th scope="col">NO.</th>
				<th scope="col">일시</th>
				<th scope="col">IP</th>
				<th scope="col">관리자 이름</th>
				<th scope="col">유저 아이디</th>
				<th scope="col">행동</th>
				<th scope="col">아이템</th>
				<th scope="col">아이템 수량</th>
				<th scope="col">메모</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($log_list as $log)
			{
			?>
				<tr>
					<th scope="row">
						<?php echo $log->log_cstool_idx; ?>
					</th>
					<td>
						<?php echo $log->reg_date; ?>
					</td>
					<td>
						<?php echo $log->ip_address; ?>
					</td>
					<td>
						<?php echo $log->admin_name; ?>
					</td>
					<td>
						<?php echo $log->user_id; ?>
					</td>
					<td>
						<?php echo $log->action; ?>
					</td>
					<td>
						<?php echo $log->item_id; ?>
					</td>
					<td>
						<?php echo $log->item_count; ?>
					</td>
					<td>
						<?php echo $log->memo; ?>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
		</tfoot>
			<tr>
				<th colspan="10">
					<?php echo $pagination; ?>
				</th>
			</tr>
		<tfoot>
	</table>
	</p>
	
	
</section>