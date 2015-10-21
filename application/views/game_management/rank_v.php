<style type="text/css">
.input_text {
	width: 100%;
}
table.order_list_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.order_list_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.order_list_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script>
</script>

<section id="content">
	<fieldset>
		<form method="post" action="/game_management/rank/load_ranking/date_search">
		<div>
			기간 설정
			<input type="text" name="reg_year" />
			<input type="text" name="reg_month" />
			<input type="text" name="reg_day" />
			<input type="submit" name="date_search" value="검색" />			
		</div>
		</form>
	</fieldset>
	
	<p>
	<table class="order_list_table">
		<thead>
			<tr>
				<th scope="col">등록 일자</th>
				<th scope="col">순위</th>
				<th scope="col">유저 아이디</th>
				<th scope="col">랭크 포인트</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($rank_info_list as $rank_info)
			{
			?>
				<tr>
					<th scope="row">
						<input type="hidden" name="user_id" value="<?php echo $rank_info['user_id']; ?>" />
						<?php echo $rank_info['reg_date']; ?>
					</th>
					<td>
						<?php echo $rank_info['rank']; ?>
					</td>
					<td>
						<?php echo $rank_info['user_id']; ?>
					</td>
					<td>
						<?php echo $rank_info['rank_point']; ?>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
		</tfoot>
			<tr>
				<th colspan="4">
					<?php echo $pagination; ?>
				</th>
			</tr>
		<tfoot>
	</table>
	</p>
	
	
</section>