<style type="text/css">
.input_text {
	width: 100%;
}
table.mail_box_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.mail_box_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.mail_box_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script>
function open_collect_popup(mail_idx, user_id){

	var temp = $('#_mail_collect_popup');		//레이어의 id를 temp변수에 저장
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
	
	var mail_idx_text = document.getElementById("_mail_idx_text");
	mail_idx_text.value = mail_idx;
	var user_id_text = document.getElementById("_user_id_text");
	user_id_text.value = user_id;
}
</script>

<section id="content">
	<fieldset>
		<form id="_term_search" method="post" action="/user_info/mail_box/load_mail_box/date_search">
		<div>
			기간 설정
			<input type="text" name="begin_year" />
			<input type="text" name="begin_month" />
			<input type="text" name="begin_day" />
			~
			<input type="text" name="end_year" />
			<input type="text" name="end_month" />
			<input type="text" name="end_day" />
			<input type="submit" name="week_search" value="일주일" />
			<input type="submit" name="date_search" value="검색" />			
		</div>
		</form>
		<form id="_user_search" method="post" action="/user_info/mail_box/load_mail_box">
		<div>
			카카오톡 ID
			<input type="text" name="kakao_id_text" />
			게임 회원번호
			<input type="text" name="game_account_id_text" />
			닉네임
			<input type="text" name="nickname_text" />
			<input type="submit" name="user_search" value="검색" />
		</div>
		</form>
	</fieldset>
	
	<p>
	<table class="mail_box_table">
		<thead>
			<tr>
				<th scope="col">메일 번호</th>
				<th scope="col">유저 아이디</th>
				<th scope="col">아이템 명</th>
				<th scope="col">개수</th>
				<th scope="col">보낸 사람</th>
				<th scope="col">설명</th>
				<th scope="col">받은 시각</th>
				<th scope="col">만료일</th>
				<th scope="col">수령 시간</th>
				<th scope="col">비고</th>
				<th scope="col">회수</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($mail_list as $mail)
			{
			?>
				<tr>
					<th scope="row">
						<input type="text" class="input_text" name="mail_idx" readonly="readonly" value="<?php echo $mail['mail_idx']; ?>" />
					</th>
					<td>
						<input type="text" class="input_text" name="user_id" readonly="readonly" value="<?php echo $mail['user_id']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="item_name" readonly="readonly" value="<?php echo $mail['item_name']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="item_count" readonly="readonly" value="<?php echo $mail['item_count']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="sender" readonly="readonly" value="<?php echo $mail['sender']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="description" readonly="readonly" value="<?php echo $mail['description']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="reg_date" readonly="readonly" value="<?php echo $mail['reg_date']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="expire_date" readonly="readonly" value="<?php echo $mail['expire_date']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="recv_date" readonly="readonly" value="<?php echo $mail['recv_date']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="stats" readonly="readonly" value="<?php echo $mail['stats']; ?>" />
					</td>
					<td>
						<input type="submit" value="회수" onclick="open_collect_popup('<?php echo $mail['mail_idx']; ?>',
																					'<?php echo $mail['user_id']; ?>'); return false"/>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
		</tfoot>
			<tr>
				<th colspan="11">
					<?php echo $pagination; ?>
				</th>
			</tr>
		<tfoot>
	</table>
	</p>
	
	
</section>