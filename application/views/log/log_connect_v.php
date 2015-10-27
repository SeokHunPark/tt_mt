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
		<form method="post" action="/log/log_viewer/load_log">
		<input type="submit" name="log_connect_button" value="log_connect" />
		<input type="submit" name="log_consume_item_button" value="log_consume_item" />
		<input type="submit" name="log_consume_money_button" value="log_consume_money" />
		<input type="submit" name="log_gain_item_button" value="log_gain_item" />
		<input type="submit" name="log_gain_mail_button" value="log_gain_mail" />
		<input type="submit" name="log_gain_money_button" value="log_gain_money" />
		<input type="submit" name="log_game_play_button" value="log_game_play" />
		<input type="submit" name="log_game_room_button" value="log_game_room" />
		<input type="submit" name="log_leave_button" value="log_leave" />
		<input type="submit" name="log_levelup_button" value="log_levelup" />
		<input type="submit" name="log_mail_button" value="log_mail" />
		<input type="submit" name="log_tuning_button" value="log_tuning" />
		</form>
	</fieldset>
	
	<fieldset>
		<form method="post" action="/log/log_connect/load_log/date_search">
		<div>
			기간 설정
			<input type="text" name="begin_year" />
			<input type="text" name="begin_month" />
			<input type="text" name="begin_day" />
			~
			<input type="text" name="end_year" />
			<input type="text" name="end_month" />
			<input type="text" name="end_day" />
		</div>
		<div>
			카카오톡 ID
			<input type="text" name="kakao_id_text" />
			게임 회원번호
			<input type="text" name="game_account_id_text" />
			닉네임
			<input type="text" name="nickname_text" />
		</div>
		<div>
			<input type="submit" name="date_search" value="검색" />
		</div>
		</form>
	</fieldset>
	
	<p>
	<table class="log_list_table">
		<thead>
			<tr>
				<th scope="col">사용자 아이디</th>
				<th scope="col">로그인 일시</th>
				<th scope="col">로그아웃 일시</th>
				<th scope="col">플레이 횟수</th>
				<th scope="col">로그인시 보유 다이아</th>
				<th scope="col">로그아웃시 보유 다이아</th>
				<th scope="col">로그인시 보유 코인</th>
				<th scope="col">로그아웃시 보유 코인</th>
				<th scope="col">마켓</th>
				<th scope="col">플랫폼 타입</th>
				<th scope="col">운영체제 타입</th>
				<th scope="col">운영체제 버전</th>
				<th scope="col">국가</th>
				<th scope="col">언어</th>
				<th scope="col">플랫폼 사용자 아이디</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($log_list as $log)
			{
			?>
				<tr>
					<th scope="row">
						<?php echo $log['user_id']; ?>
					</th>
					<td>
						<?php echo $log['login_date']; ?>
					</td>
					<td>
						<?php echo $log['logout_date']; ?>
					</td>
					<td>
						<?php echo $log['num_play']; ?>
					</td>
					<td>
						<?php echo $log['s_gold']; ?>
					</td>
					<td>
						<?php echo $log['e_gold']; ?>
					</td>
					<td>
						<?php echo $log['s_coin']; ?>
					</td>
					<td>
						<?php echo $log['e_coin']; ?>
					</td>
					<td>
						<?php echo $log['market']; ?>
					</td>
					<td>
						<?php echo $log['platform_type']; ?>
					</td>
					<td>
						<?php echo $log['os_type']; ?>
					</td>
					<td>
						<?php echo $log['os_version']; ?>
					</td>
					<td>
						<?php echo $log['country']; ?>
					</td>
					<td>
						<?php echo $log['language']; ?>
					</td>
					<td>
						<?php echo $log['platform_user_id']; ?>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
		</tfoot>
			<tr>
				<th colspan="15">
					<?php echo $pagination; ?>
				</th>
			</tr>
		<tfoot>
	</table>
	</p>
	
</section>

