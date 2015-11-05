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
function open_cancel_order_popup(order_id, user_id){

	var temp = $('#_order_cancel_popup');		//레이어의 id를 temp변수에 저장
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
	
	var order_id_text = document.getElementById("_order_id_text");
	order_id_text.value = order_id;
	var user_id_text = document.getElementById("_user_id_text");
	user_id_text.value = user_id;
}
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
		<form method="post" action="/payment/order_lookup/load_order/date_search">
		<div>
			기간 설정
			<input type="text" class="datepicker" name="begin_day">
			~
			<input type="text" class="datepicker" name="end_day">
			<input type="submit" name="date_search" value="검색" />			
		</div>
		</form>
		
		<form method="post" action="/payment/order_lookup/load_order/user_search">
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
		
		<form method="post" action="/payment/order_lookup/load_order/order_id_search">
		<div>
			주문 번호
			<input type="text" name="order_id_text" />
			<input type="submit" name="order_id_search" value="검색" />
		</div>
		</form>
	</fieldset>
	
	<fieldset>
		<form method="post" action="/payment/order_lookup/recovery">
		<div>
			주문 복구 상품 명
			<input type="text" name="item_id_text" />
			이벤트 보너스 비율(%)
			<input type="text" name="event_bonus_text" />
			게임 회원번호
			<input type="text" name="game_account_id_text" />
			결제 일시
			<input type="text" name="order_day_text" />
			<input type="text" name="order_time_text" />
			주문 번호
			<input type="text" name="order_id_text" />
			<input type="submit" name="recovery" value="복구" />
		</div>
		</form>
	</fieldset>
	
	<p>
	<table class="order_list_table">
		<thead>
			<tr>
				<th scope="col">유저 아이디</th>
				<th scope="col">결제 일자</th>
				<th scope="col">상품 지급 일</th>
				<th scope="col">스토어</th>
				<th scope="col">상태</th>
				<th scope="col">금액</th>
				<th scope="col">삼품 명</th>
				<th scope="col">스토어 주문 번호</th>
				<th scope="col">비고</th>
				<th scope="col">주문 취소</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($order_list as $order)
			{
			?>
				<tr>
					<th scope="row">
						<input type="hidden" name="user_id" value="<?php echo $order['user_id']; ?>" />
						<?php echo $order['user_id']; ?>
					</th>
					<td>
						<?php echo $order['pub_date']; ?>
					</td>
					<td>
						<?php echo $order['reg_date']; ?>
					</td>
					<td>
						<?php echo $order['market']; ?>
					</td>
					<td>
						<?php echo $order['status']; ?>
					</td>
					<td>
						<?php echo $order['real_cash']; ?>
					</td>
					<td>
						<?php echo $order['item_id']; ?>
					</td>
					<td>
						<input type="hidden" name="receipt_key" value="<?php echo $order['receipt_key']; ?>" />
						<?php echo $order['receipt_key']; ?>
					</td>
					<td>
						<?php echo $order['memo']; ?>
					</td>
					<td>
						<?php
						if ($order['status'] == 'N')
						{
						?>
						<input type="submit" name="cancel_order" value="주문 취소" 
							onclick="open_cancel_order_popup('<?php echo $order['receipt_key']; ?>',
															'<?php echo $order['user_id']; ?>'); return false;" />
						<?php
						}
						?>
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