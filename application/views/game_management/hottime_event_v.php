<style type="text/css">
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
	<table class="event_table">
		<thead>
			<tr>
				<th scope="col" colspan="15">
					 이벤트 등록
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th scope="col">
					이벤트 명
				</th>
				<th scope="col">
					이벤트 타입
				</th>
				<th scope="col">
					이벤트 기간
				</th>
				<th scope="col">
					리워드 연료
				</th>
				<th scope="col">
					리워드 트로피
				</th>
				<th scope="col">
					리워드 보석
				</th>
				<th scope="col">
					리워드 코인
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<form method="post" action="/game_management/hottime_event/add_event">
				<td scope="row">
					<input type="text" name="event_name_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="event_type_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="begin_day_text"  class=""/>
					<input type="text" name="begin_time_text" class=""/>
					~
					<input type="text" name="end_day_text" class=""/>
					<input type="text" name="end_time_text" class=""/>
				</td>
				<td>
					<input type="text" name="gas_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="chip_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="gold_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="coin_text" class="input_text" />
				</td>
				<td>
					<input type="submit" name="add_event" value="등록" />
				</td>
				</form>
			</tr>
		</tbody>
	</table>
	</p>
	
	<p>
	<table class="event_table">
		<thead>
			<tr>
				<th scope="col" colspan="15">
					패키지 수정
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th scope="col">
					NO.
				</th>
				<th scope="col">
					이벤트 명
				</th>
				<th scope="col">
					이벤트 타입
				</th>
				<th scope="col">
					이벤트 기간
				</th>
				<th scope="col">
					리워드 연료
				</th>
				<th scope="col">
					리워드 트로피
				</th>
				<th scope="col">
					리워드 보석
				</th>
				<th scope="col">
					리워드 코인
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<form method="post" action="/game_management/hottime_event/modify_event">
				<td scope="row">
					<input type="text" name="event_no_text" value="<?php echo $target_event['event_no']; ?>" class="input_text" readonly="readonly" />
				</td>
				<td >
					<input type="text" name="event_name_text" value="<?php echo $target_event['event_name']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="event_type_text" value="<?php echo $target_event['event_type']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="begin_day_text" value="<?php echo $target_event['begin_day']; ?>" class=""/>
					<input type="text" name="begin_time_text" value="<?php echo $target_event['begin_time']; ?>" class=""/>
					~
					<input type="text" name="end_day_text" value="<?php echo $target_event['end_day']; ?>" class=""/>
					<input type="text" name="end_time_text" value="<?php echo $target_event['end_time']; ?>" class=""/>
				</td>
				<td>
					<input type="text" name="gas_text" value="<?php echo $target_event['gas']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="chip_text" value="<?php echo $target_event['chip']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="gold_text" value="<?php echo $target_event['gold']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="coin_text" value="<?php echo $target_event['coin']; ?>" class="input_text" />
				</td>
				<td>
					<input type="submit" name="modify" value="적용" />
				</td>
				</form>
			</tr>
		</tbody>
	</table>
	</p>
	
	<p>
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
					이벤트 타입
				</th>
				<th scope="col">
					이벤트 기간
				</th>
				<th scope="col">
					리워드 연료
				</th>
				<th scope="col">
					리워드 트로피
				</th>
				<th scope="col">
					리워드 보석
				</th>
				<th scope="col">
					리워드 코인
				</th>
				<th scope="col">
					사용 유무
				</th>
				<th scope="col">
					수정
				</th>
				<th scope="col">
					상태 변경
				</th>
				<th scope="col">
					참여자 수
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($event_list as $event)
			{
			?>
				<tr>
					<form method="post" action="/game_management/hottime_event/button_event">
					<th scope="row">
						<input type="text" name="event_no" readonly="readonly" value="<?php echo $event['event_no']; ?>" class="input_text" />
					</th>
					<td>
						<input type="text" name="event_name" readonly="readonly" value="<?php echo $event['event_name']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="event_type" readonly="readonly" value="<?php echo $event['event_type']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="event_term" readonly="readonly" value="<?php echo $event['event_term']; ?>" class=""/>
					</td>
					<td>
						<input type="text" name="gas" readonly="readonly" value="<?php echo $event['gas']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="chip" readonly="readonly" value="<?php echo $event['chip']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="gold" readonly="readonly" value="<?php echo $event['gold']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="coin" readonly="readonly" value="<?php echo $event['coin']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="is_used" readonly="readonly" value="<?php echo $event['is_used']; ?>" class="input_text" />
					</td>
					<td>
						<input type="submit" name="modify" value="수정" />
					</td>
					<td>
						<input type="submit" name="state" value="<?php echo $event['is_used']; ?>" />
					</td>
					<td>
						
					</td>
					</form>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	</p>
	
	<p>
	<form method="post" action="/game_management/hottime_event/publish">
	<input type="submit" name="publish" value="변경 사항 적용" />
	</form>
	</p>
</section>