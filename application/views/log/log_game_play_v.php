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
		</form>
	</fieldset>
	
	<fieldset>
		<form method="post" action="/log/log_game_play/load_log/date_search">
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
				<th scope="col">미션 번호</th>
				<th scope="col">스테이지 번호</th>
				<th scope="col">연승</th>
				<th scope="col">사용 아이템</th>
				<th scope="col">시작 일시</th>
				<th scope="col">종료 일시</th>
				<th scope="col">게임 모드</th>
				<th scope="col">플레이 타입</th>
				<th scope="col">선택 차량</th>
				<th scope="col">선택 서포터</th>
				<th scope="col">순위</th>
				<th scope="col">경험치</th>
				<th scope="col">미션 모드</th>
				<th scope="col">랭크 포인트</th>
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
						<?php echo $log['challenge']; ?>
					</td>
					<td>
						<?php echo $log['stage']; ?>
					</td>
					<td>
						<?php echo $log['winning_streak']; ?>
					</td>
					<td>
						<?php echo $log['use_item']; ?>
					</td>
					<td>
						<?php echo $log['start_date']; ?>
					</td>
					<td>
						<?php echo $log['end_date']; ?>
					</td>
					<td>
						<?php echo $log['game_mode']; ?>
					</td>
					<td>
						<?php echo $log['play_type']; ?>
					</td>
					<td>
						<?php echo $log['sel_car']; ?>
					</td>
					<td>
						<?php echo $log['sel_sup']; ?>
					</td>
					<td>
						<?php echo $log['rank']; ?>
					</td>
					<td>
						<?php echo $log['exp']; ?>
					</td>
					<td>
						<?php echo $log['challenge_mode']; ?>
					</td>
					<td>
						<?php echo $log['rank_point']; ?>
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

