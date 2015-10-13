﻿<style type="text/css">
.input_text {
	width: 100%;
}
table.event_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.event_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.event_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script type="text/javascript">

</script>

<section id="content">	
	<p>
	<form method="post" action="/game_management/ingame_event/add_event">
	<table class="event_table">
		<thead>
			<tr>
				<th scope="col" colspan="10">
					 인게임 이벤트 등록
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row" >
					 이벤트 명
				</th>
				<td colspan="9">
					<input type="text" name="event_name_text" class="input_text" />
				</td>
			</tr>
			<tr>
				<th scope="row" >
					 이벤트 시간
				</th>
				<td colspan="9">
					<input type="text" name="begin_day_text" class="" />
					<input type="text" name="begin_time_text" class="" />
					~
					<input type="text" name="end_day_text" class="" />
					<input type="text" name="end_time_text" class="" />
				</td>
			</tr>
			<tr>
				<th scope="row" >
					 배너 노출 시작 시간
				</th>
				<td colspan="9">
					<input type="text" name="open_day_text" class="" />
					<input type="text" name="open_time_text" class="" />
				</td>
			</tr>
			<tr>
				<th scope="row" >
					 배너 이미지 URL
				</th>
				<td colspan="9">
					<input type="text" name="image_url_text" class="input_text" />
				</td>
			</tr>
			<tr>
				<th scope="row" >
					 배너 연결 URL
				</th>
				<td colspan="9">
					<input type="text" name="link_url_text" class="input_text" />
				</td>
			</tr>
			<tr>
				<th scope="row" rowspan="8">
					 이벤트 내용 설정
				</th>
				<td>
					보너스
				</td>
				<td>
					보석 구매 보너스(%)
				</td>
				<td>
					<input type="text" name="bonus_gold_text" class="" />
				</td>
				<td>
					코인 구매 보너스(%)
				</td>
				<td>
					<input type="text" name="bonus_coin_text" class="" />
				</td>
				<td>
					연료 구매 보너스(%)
				</td>
				<td>
					<input type="text" name="bonus_gas_text" class="" />
				</td>
				<td>
					
				</td>
				<td>
					
				</td>
			</tr>
			<tr>
				<td>
					할인
				</td>
				<td>
					고급 부품 카드 뽑기 할인(%)
				</td>
				<td>
					<input type="text" name="sale_gacha_0_text" class="" />
				</td>
				<td>
					일반 부품 카드 뽑기 할인(%)
				</td>
				<td>
					<input type="text" name="sale_gacha_1_text" class="" />
				</td>
				<td>
					차량 할인(%)
				</td>
				<td>
					<input type="text" name="sale_car_text" class="" />
				</td>
				<td>
					서포터즈 할인(%)
				</td>
				<td>
					<input type="text" name="sale_supporter_text" class="" />
				</td>
			</tr>
			<tr>
				<td rowspan="5">
					플레이
				</td>
				<td>
					미션 코인 획득량 증가(%)
				</td>
				<td>
					<input type="text" name="gain_coin_text" class="" />
				</td>
				<td>
					미션 경험치 획득량 증가(%)
				</td>
				<td>
					<input type="text" name="gain_exp_text" class="" />
				</td>
				<td>
					미견 드랍 카드 확귤 증가(%)
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
					
				</td>
				<td>
					
				</td>
			</tr>
			<tr>
				<td>
					대전 코인 획득량 증가(%)
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
					대전 경험치 획득량 증가(%)
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
					
				</td>
				<td>
					
				</td>
				<td>
					
				</td>
				<td>
					
				</td>
			</tr>
			<tr>
				<td colspan="8">
					미션 이벤트 적용 스테이지 선택
				</td>
			</tr>
			<tr>
				<td>
					전체
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
					스테이지 1
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
					스테이지 2
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
					스테이지 3
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
			</tr>
			<tr>
				<td>
					스테이지 4
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
					스테이지 5
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
					스테이지 6
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
					스테이지 7
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
			</tr>
			<tr>
				<td>
					뽑기
				</td>
				<td>
					A급 뽑기 확률 증가(%)
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
					S급 뽑기 확률 증가(%)
				</td>
				<td>
					<input type="text" name="link_url_text" class="" />
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
		</tbody>
	</table>
	<p>
	<input type="submit" name="reg" value="등록" />
	</p>
	</form>
	</p>
	
	<table class="event_table">
		<thead>
			<tr>
				<th scope="col">
					NO.
				</th>
				<th scope="col">
					이벤트 명
				</th>
				<th scope="col">
					이벤트 기간
				</th>
				<th scope="col">
					배너 노출 시간
				</th>
				<th scope="col">
					이미지 & 링크 URL
				</th>
				<th scope="col">
					이벤트 내용
				</th>
				<th scope="col">
					수정
				</th>
				<th scope="col">
					삭제
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($event_list as $event)
			{
			?>
				<tr>
					<form method="post" action="/game_management/ingame_event/button_event">
					<th scope="row">
						<input type="text" name="event_no" readonly="readonly" value="<?php echo $event['event_no']; ?>" class="input_text" />
						<?php echo $event['event_no']; ?>
					</th>
					<td>
						<?php echo $event['title']; ?>
					</td>
					<td>
						시작 : <?php echo $event['begin_date']; ?><br>
						종료 : <?php echo $event['end_date']; ?>
					</td>
					<td>
						<?php echo $event['open_date']; ?>
					</td>
					<td>
						배너URL : <?php echo $event['image_url']; ?><br>
						링크URL : <?php echo $event['image_url']; ?>
					</td>
					<td>
						<?php echo $event['description']; ?>
					</td>
					<td>
						<input type="submit" name="modify" value="수정" />
					</td>
					<td>
						<input type="submit" name="delete" value="삭제" />
					</td>
					</form>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</section>