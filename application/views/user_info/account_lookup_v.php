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
function open_modify_nickname_popup(user_id, nickname){

	var temp = $('#modify_nickname_popup');		//레이어의 id를 temp변수에 저장
	temp.fadeIn();	//bg 클래스가 없으면 일반레이어로 실행한다.

	// 화면의 중앙에 레이어를 띄운다.
	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
	else temp.css('top', '0px');
	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
	else temp.css('left', '0px');

	temp.find('#cancel_btn').click(function(e){
		temp.fadeOut();		//'닫기'버튼을 클릭하면 레이어가 사라진다.
		e.preventDefault();
	});
	
	var user_id_text = document.getElementById("_user_id_text");
	user_id_text.value = user_id;
	var current_nickname = document.getElementById("_nickname_text");
	current_nickname.value = nickname;
}
function open_secession_popup(user_id){

	var temp = $('#_secession_popup');		//레이어의 id를 temp변수에 저장
	temp.fadeIn();	//bg 클래스가 없으면 일반레이어로 실행한다.

	// 화면의 중앙에 레이어를 띄운다.
	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
	else temp.css('top', '0px');
	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
	else temp.css('left', '0px');

	temp.find('#cancel_btn').click(function(e){
		temp.fadeOut();		//'닫기'버튼을 클릭하면 레이어가 사라진다.
		e.preventDefault();
	});
	
	var user_id_text = document.getElementById("_secession_user_id_text");
	user_id_text.value = user_id;
}
function open_secession_recovery_popup(user_id){

	var temp = $('#_secession_recovery_popup');		//레이어의 id를 temp변수에 저장
	temp.fadeIn();	//bg 클래스가 없으면 일반레이어로 실행한다.

	// 화면의 중앙에 레이어를 띄운다.
	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
	else temp.css('top', '0px');
	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
	else temp.css('left', '0px');

	temp.find('#cancel_btn').click(function(e){
		temp.fadeOut();		//'닫기'버튼을 클릭하면 레이어가 사라진다.
		e.preventDefault();
	});
	
	var user_id_text = document.getElementById("_secession_recovery_user_id_text");
	user_id_text.value = user_id;
}
function open_modify_money_popup(user_id, gas, coin, gold, vgold, chip){

	var temp = $('#_modify_money_popup');		//레이어의 id를 temp변수에 저장
	temp.fadeIn();	//bg 클래스가 없으면 일반레이어로 실행한다.

	// 화면의 중앙에 레이어를 띄운다.
	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
	else temp.css('top', '0px');
	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
	else temp.css('left', '0px');

	temp.find('#cancel_btn').click(function(e){
		temp.fadeOut();		//'닫기'버튼을 클릭하면 레이어가 사라진다.
		e.preventDefault();
		
		var gas_text = document.getElementById("_new_gas_count_text");
		gas_text.value = "";
		var coin_text = document.getElementById("_new_coin_count_text");
		coin_text.value = "";
		var gold_text = document.getElementById("_new_gold_count_text");
		gold_text.value = "";
		var vgold_text = document.getElementById("_new_vgold_count_text");
		vgold_text.value = "";
		var chip_text = document.getElementById("_new_chip_count_text");
		chip_text.value = "";
	});
	
	var user_id_text = document.getElementById("_modify_money_user_id_text");
	user_id_text.value = user_id;
	var gas_text = document.getElementById("_gas_text");
	gas_text.value = gas;
	var coin_text = document.getElementById("_coin_text");
	coin_text.value = coin;
	var gold_text = document.getElementById("_gold_text");
	gold_text.value = gold;
	var vgold_text = document.getElementById("_vgold_text");
	vgold_text.value = vgold;
	var chip_text = document.getElementById("_chip_text");
	chip_text.value = chip;
}
function open_straight_wins_popup(user_id){

	var temp = $('#_straight_wins_popup');		//레이어의 id를 temp변수에 저장
	temp.fadeIn();	//bg 클래스가 없으면 일반레이어로 실행한다.

	// 화면의 중앙에 레이어를 띄운다.
	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
	else temp.css('top', '0px');
	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
	else temp.css('left', '0px');

	temp.find('#cancel_btn').click(function(e){
		temp.fadeOut();		//'닫기'버튼을 클릭하면 레이어가 사라진다.
		e.preventDefault();
	});
	
	var user_id_text = document.getElementById("_straight_wins_user_id_text");
	user_id_text.value = user_id;
}
function open_modify_straight_status_popup(user_id, mission, stage){

	var temp = $('#_mission_status_popup');		//레이어의 id를 temp변수에 저장
	temp.fadeIn();	//bg 클래스가 없으면 일반레이어로 실행한다.

	// 화면의 중앙에 레이어를 띄운다.
	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
	else temp.css('top', '0px');
	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
	else temp.css('left', '0px');

	temp.find('#cancel_btn').click(function(e){
		temp.fadeOut();		//'닫기'버튼을 클릭하면 레이어가 사라진다.
		e.preventDefault();
	});
	
	var user_id_text = document.getElementById("_mission_status_user_id_text");
	user_id_text.value = user_id;
	var mission_text = document.getElementById("_mission_text");
	mission_text.value = mission;
	var stage_text = document.getElementById("_stage_text");
	stage_text.value = stage;
}
function open_modify_level_popup(user_id){

	var temp = $('#_modify_level_popup');		//레이어의 id를 temp변수에 저장
	temp.fadeIn();	//bg 클래스가 없으면 일반레이어로 실행한다.

	// 화면의 중앙에 레이어를 띄운다.
	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
	else temp.css('top', '0px');
	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
	else temp.css('left', '0px');

	temp.find('#cancel_btn').click(function(e){
		temp.fadeOut();		//'닫기'버튼을 클릭하면 레이어가 사라진다.
		e.preventDefault();
	});
	
	var user_id_text = document.getElementById("_level_user_id_text");
	user_id_text.value = user_id;
}
function open_modify_user_type_popup(user_id, user_type){

	var temp = $('#_modify_user_type_popup');		//레이어의 id를 temp변수에 저장
	temp.fadeIn();	//bg 클래스가 없으면 일반레이어로 실행한다.

	// 화면의 중앙에 레이어를 띄운다.
	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
	else temp.css('top', '0px');
	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
	else temp.css('left', '0px');

	temp.find('#cancel_btn').click(function(e){
		temp.fadeOut();		//'닫기'버튼을 클릭하면 레이어가 사라진다.
		e.preventDefault();
	});
	
	var user_id_text = document.getElementById("_user_type_user_id_text");
	user_id_text.value = user_id;
	var user_type_text = document.getElementById("_user_type_text");
	user_type_text.value = user_type;
}
function open_modify_rp_popup(user_id, rank_point){

	var temp = $('#_modify_rp_popup');		//레이어의 id를 temp변수에 저장
	temp.fadeIn();	//bg 클래스가 없으면 일반레이어로 실행한다.

	// 화면의 중앙에 레이어를 띄운다.
	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
	else temp.css('top', '0px');
	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
	else temp.css('left', '0px');

	temp.find('#cancel_btn').click(function(e){
		temp.fadeOut();		//'닫기'버튼을 클릭하면 레이어가 사라진다.
		e.preventDefault();
	});
	
	var user_id_text = document.getElementById("_rp_user_id_text");
	user_id_text.value = user_id;
	var rp_text = document.getElementById("_rp_text");
	rp_text.value = rank_point;
}
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
					랭크 포인트
				</th>
				<td>
					<?php echo $account_info['rank_point']; ?>
					<input type="submit" value="변경" 
							onclick="open_modify_rp_popup('<?php echo $account_info['user_id']; ?>',
														'<?php echo $account_info['rank_point']; ?>'); return false"/>
				</td>
				<th>
					계정 경험치
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
					<select name="sanctions_days">
						<option value="1">1일 제재</option>
						<option value="3">3일 제재</option>
						<option value="5">5일 제재</option>
						<option value="7">7일 제재</option>
						<option value="15">15일 제재</option>
						<option value="30">30일 제재</option>
						<option value="1000">영구 제재</option>
					</select>
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
					<form id="_user_sanctions" method="post" action="/user_info/account_lookup/off_sanctions">
					<input type="hidden" name="sanction_user_id_text" value="<?php echo $account_info['user_id'] ?>" />
					<input type="submit" value="해제" name="button" />
					</form>
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
			<tr>
				<th scope="row">
				정액 상품 이용
				</th>
				<td>
				<form method="post" action="/user_info/account_lookup/sub_cancel">
				<input type="hidden" name="sub_user_id_text" value="<?php echo $account_info['user_id'] ?>" />
				<input type="hidden" name="sub_item_id_text" value="<?php echo $account_info['sub_item'] ?>" />
				<?php
				if ($account_info['sub_item'] != '')
				{
				?>
				<?php echo $account_info['sub_item']; ?>
				(
				<?php echo $account_info['sub_begin_date']; ?>
				~
				<?php echo $account_info['sub_end_date']; ?>
				)
				<input type="submit" value="청약 취소" name="button" />
				<?php
				}
				?>
				</form>
				</td>
				<th>
				계정 유형
				</th>
				<td>
				<?php echo $account_info['user_type']; ?>
				</td>
				<td>
				<input type="submit" value="계정 유형 변경" name="modify_user_type_button" 
					onclick="open_modify_user_type_popup('<?php echo $account_info['user_id']; ?>',
														'<?php echo $account_info['user_type']; ?>'); return false" />
				</td>
			</tr>
		</tbody>
	</table>
</section>