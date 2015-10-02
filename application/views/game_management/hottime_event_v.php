<style type="text/css">
table.account_info_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.account_info_table th {
	width: 180;
	border: 1px solid black;
	border-spacing: 0px;
 }
.account_info_table td {
	width: 250;
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script type="text/javascript">
</script>

<section id="content">
	<form id="search_user" method="post" action="/user_info/account_lookup/load_account_info">
	<fieldset>
		<div>
			카카오톡 ID
			<input type="text" name="kakao_id_text" style="text-align:center;"/>
			게임 회원번호
			<input type="text" name="game_account_id_text" />
			닉네임
			<input type="text" name="nickname_text" />
			<input type="submit" value="조회" id="search_user_button" />
		</div>
	</fieldset>
	</form>
	
	<table class="account_info_table">
		<tbody>
			<tr>
				<th scope="row">
					카카오톡ID
				</th>
				<td>
					<?php echo $account_info['kakao_id']; ?>
				</td>
				<th>
					캐릭터 명
				</th>
				<td>
					<?php echo $account_info['nickname']; ?>
					<input type="button" value="수정" id="modify_btn" 
							onclick="open_modify_nickname_popup('<?php echo $account_info['user_id']; ?>', 
																'<?php echo $account_info['nickname']; ?>'); return false;" />
				</td>
				<td>
					<input type="button" id="_secession_button" value="탈퇴" 
							onclick="open_secession_popup('<?php echo $account_info['user_id']; ?>'); return false;" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					게임 회원번호
				</th>
				<td>
					<?php echo $account_info['user_id']; ?>
				</td>
				<th>
					가입일자
				</th>
				<td>
					<?php echo $account_info['reg_date']; ?>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<th scope="row">
					연료
				</th>
				<td>
					<?php echo $account_info['gas']; ?>
				</td>
				<th>
					코인
				</th>
				<td>
					<?php echo $account_info['coin']; ?>
				</td>
				<td rowspan="2">
					<input type="submit" id="_modify_money_button" value="재화수정" 
							onclick="open_modify_money_popup('<?php echo $account_info['user_id']; ?>',
																'<?php echo $account_info['gas']; ?>',
																'<?php echo $account_info['coin']; ?>',
																'<?php echo $account_info['gold']; ?>', 
																'<?php echo $account_info['vgold']; ?>',
																'<?php echo $account_info['chip']; ?>'); return false;" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					다이아(유료/무료)
				</th>
				<td>
					<?php echo $account_info['gold'], " / ", $account_info['vgold']; ?>
				</td>
				<th>
					트로피
				</th>
				<td>
					<?php echo $account_info['chip']; ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					대결모드 연승
				</th>
				<td>
					<?php echo $account_info['straight_wins']; ?>
					<input type="submit" value="변경" name="button"
							onclick="open_straight_wins_popup('<?php echo $account_info['user_id']; ?>'); return false;"/>
				</td>
				<th>
					미션모드 진행도
				</th>
				<td>
					<?php echo $account_info['current_challenge'], " - ", $account_info['current_stage']; ?>
					<input type="submit" value="변경" name="button" 
							onclick="open_modify_straight_status_popup('<?php echo $account_info['user_id']; ?>',
																		'<?php echo $account_info['current_challenge']; ?>',
																		'<?php echo $account_info['current_stage']; ?>'); return false"/>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<th scope="row">
				</th>
				<td>
				</td>
				<th>
					계정 레벨
				</th>
				<td>
					<?php echo $account_info['account_level']; ?>
					<input type="submit" value="변경" 
							onclick="open_modify_level_popup('<?php echo $account_info['user_id']; ?>'); return false"/>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<th scope="row">
					탈퇴여부
				</th>
				<td>
					<?php echo $account_info['secession']; ?>
				</td>
				<th>
					탈퇴일자
				</th>
				<td>
					<?php echo $account_info['secession_date']; ?>
				</td>
				<td>
					<input type="submit" value="탈퇴복구" 
							onclick="open_secession_recovery_popup('<?php echo $account_info['user_id']; ?>'); return false;"/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					최근 로그인
				</th>
				<td>
					<?php echo $account_info['reacently_login']; ?>
				</td>
				<th>
					접속여부
				</th>
				<td colspan="2">
					<?php echo $account_info['is_connected']; ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					이용 제한 타입
				</th>
				<td>
					<?php echo $account_info['sanction_type']; ?>
				</td>
				<th rowspan="2">
					계정 블록
				</th>
				<form id="_user_sanctions" method="post" action="/user_info/account_lookup/user_sanctions">
				<td>
					<input type="text" id="_sanctions_days" name="sanctions_days" />
				</td>
				<td>
					<input type="hidden" name="sanction_user_id_text" value="<?php echo $account_info['user_id'] ?>" />
					<input type="submit" value="제재" />
				</td>
				</form>
			</tr>
			<tr>
				<th scope="row">
					제재일
				</th>
				<td>
					<?php echo $account_info['sanction_date']; ?>
				</td>
				<td>
					블록 해제
				</td>
				<td>
					<input type="submit" value="해제" name="button" />
				</td>
			</tr>
			<tr>
				<th scope="row">
				해제일
				</th>
				<td>
				<?php echo $account_info['release_date']; ?>
				</td>
				<th>
				친구 초대 횟수
				</th>
				<td>
				<?php echo $account_info['invite_count']; ?>
				</td>
				<td>
				</td>
			</tr>
		</tbody>
	</table>
</section>