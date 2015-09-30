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
function open_modify_nickname_popup(el, user_id, nickname){

	var temp = $('#' + el);		//레이어의 id를 temp변수에 저장
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
</script>

<section id="content">
	<form id="search_user" method="post" action="/user_info/account_lookup/load_account_info">
	<fieldset>
		<div>
			카카오톡 ID
			<input type="text" name="kakao_id_text" />
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
						onclick="open_modify_nickname_popup('modify_nickname_popup', 
															'<?php echo $account_info['user_id']; ?>', 
															'<?php echo $account_info['nickname']; ?>'); return false;" />
				</td>
				<td>
					<input type="submit" value="탈퇴" name="button" />
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
					<input type="submit" value="재화수정" name="button" />
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
				<input type="submit" value="변경" name="button" />
				</td>
				<th>
				미션모드 진행도
				</th>
				<td>
				<?php echo $account_info['current_challenge'], " - ", $account_info['current_stage']; ?>
				<input type="submit" value="변경" name="button" />
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
				<input type="submit" value="변경" name="button" />
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
					<input type="submit" value="탈퇴복구" name="button" />
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
				<?php echo $account_info['restriction_type']; ?>
				</td>
				<th rowspan="2">
				계정 블록
				</th>
				<td>
				<?php echo $account_info['account_block']; ?>
				</td>
				<td>
					<input type="submit" value="제재" name="button" />
				</td>
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