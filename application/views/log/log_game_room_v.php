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
$(document).ready(function(){
	$(".datepicker").datepicker({
		dateFormat:'yy-mm-dd',
		monthNamesShort:['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNamesMin : ['일','월','화','수','목','금','토'],
		monthNames : ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		constrainInput: true
	});
});
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
		<form method="post" action="/log/log_game_room/load_log/date_search">
		<div>
			기간 설정
			<input type="text" class="datepicker" name="begin_day">
			~
			<input type="text" class="datepicker" name="end_day">
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
	
	<h3>게임 룸 로그</h3>

	<p>
	<table class="log_list_table">
		<thead>
			<tr>
				<th scope="col">게임 모드</th>
				<th scope="col">방장 아이디</th>
				<th scope="col">시작 일시</th>
				<th scope="col">방 이름</th>
				<th scope="col">플레이 유저 수</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($log_list as $log)
			{
			?>
				<tr>
					<th scope="row">
						<?php echo $log['game_mode']; ?>
					</th>
					<td>
						<?php echo $log['owner_id']; ?>
					</td>
					<td>
						<?php echo $log['start_date']; ?>
					</td>
					<td>
						<?php echo $log['room_name']; ?>
					</td>
					<td>
						<?php echo $log['num_user']; ?>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
		</tfoot>
			<tr>
				<th colspan="5">
					<?php echo $pagination; ?>
				</th>
			</tr>
		<tfoot>
	</table>
	</p>
	
</section>

