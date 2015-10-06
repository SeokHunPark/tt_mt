﻿<style type="text/css">
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

<section id="content">
	<fieldset>
		<form id="_term_search" method="post" action="/user_info/mail_box/load_mail_box">
		<div>
			기간 설정
			<input type="text" name="begin_year" />
			<input type="text" name="begin_month" />
			<input type="text" name="begin_day" />
			~
			<input type="text" name="end_year" />
			<input type="text" name="end_month" />
			<input type="text" name="end_day" />
			<input type="submit" value="검색" />
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
			<input type="submit" value="검색" />
		</div>
		</form>
	</fieldset>
	
	
	<p>
	<table class="mail_box_table">
		<thead>
			<tr>
				<th scope="col">메일 번호</th>
				<th scope="col">아이템 명</th>
				<th scope="col">개수</th>
				<th scope="col">보낸 사람</th>
				<th scope="col">설명</th>
				<th scope="col">받은 시각</th>
				<th scope="col">만료일</th>
				<th scope="col">수행 시간</th>
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
					<form id="_collect_mail" method="post" action="/user_info/mail_box/collect_mail">
					<th scope="row">
						<input type="text" class="input_text" name="promotion_no" readonly="readonly" value="<?php echo $mail['mail_idx']; ?>" />
					</th>
					<td>
						<input type="text" class="input_text" name="title" readonly="readonly" value="<?php echo $mail['item_name']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="package" readonly="readonly" value="<?php echo $mail['item_count']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="expose_int" readonly="readonly" value="<?php echo $mail['sender']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="reexpose_buy" readonly="readonly" value="<?php echo $mail['description']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="expose_limit" readonly="readonly" value="<?php echo $mail['reg_date']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="expose_prob" readonly="readonly" value="<?php echo $mail['expire_date']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="expose_prob" readonly="readonly" value="<?php echo $mail['recv_date']; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="expose_prob" readonly="readonly" value="<?php echo $mail['memo']; ?>" />
					</td>
					<td>
						<input type="submit" value="회수" />
					</td>
					</form>
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