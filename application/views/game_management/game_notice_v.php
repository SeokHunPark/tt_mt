<style type="text/css">
.input_text {
	width: 100%;
}
.input_textarea {
	width: 100%;
	height: 250px;
}
table.notice_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.notice_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.notice_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script>
function open_cancel_notice_popup(notice_no){

	var temp = $('#_notice_cancel_popup');		//레이어의 id를 temp변수에 저장
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
	
	var notice_no_text = document.getElementById("_notice_no_text");
	notice_no_text.value = notice_no;
}
</script>

<section id="content">
	<p>
	<form method="post" action="/game_management/game_notice/reg_notice">
	<table class="notice_table">
		<tbody>
			<tr>
				<th scope="row">
					분류
				</th>
				<td>
					전체
				</td>
			</tr>
			<tr>
				<th scope="row">
					제목
				</th>
				<td>
					<input type="text" name="title_text" class="input_text"/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					기간 설정
				</th>
				<td>
					<input type="text" id="_begin_day_text" name="begin_day_text"  class=""/>
					<input type="text" id="_begin_time_text" name="begin_time_text" class=""/>
					~
					<input type="text" id="_end_day_text" name="end_day_text" class=""/>
					<input type="text" id="_end_time_text" name="end_time_text" class=""/>
				</td>
			</tr>
			<tr>
				<td scope="row" colspan="2">
					<textarea name="body_text" class="input_textarea"></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	<p>
	<input type="submit" name="reg_button" value="등록" />
	</p>
	</form>
	</p>
	
	<p>
	<table class="notice_table">
		<thead>
			<tr>
				<th scope="col">
					공지 번호
				</th>
				<th scope="col">
					분류
				</th>
				<th scope="col">
					제목
				</th>
				<th scope="col">
					공지 시작일
				</th>
				<th scope="col">
					공지 종료일
				</th>
				<th scope="col" colspan="2">
					적용 상태
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($notice_list as $notice)
			{
			?>
				<tr>
					<th scope="row">
						<input type="text" name="notice_no" readonly="readonly" value="<?php echo $notice['notice_no']; ?>" class="input_text" />
					</th>
					<td>
						<input type="text" name="platform" readonly="readonly" value="<?php echo $notice['platform']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="title" readonly="readonly" value="<?php echo $notice['title']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="begin_date" readonly="readonly" value="<?php echo $notice['begin_date']; ?>" class="input_text"/>
					</td>
					<td>
						<input type="text" name="end_date" readonly="readonly" value="<?php echo $notice['end_date']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="state" readonly="readonly" value="<?php echo $notice['state']; ?>" class="input_text" />
					</td>
					<td>
						<?php
						if ($notice['used'] == 'Y')
						{
						?>
						<input type="button" name="cancel_button" value="취소"
								onclick="open_cancel_notice_popup('<?php echo $notice['notice_no']; ?>'); return false;"/>
						<?php
						}
						?>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	</p>
	
	<p>
	<form method="post" action="/game_management/game_notice/publish">
	<input type="submit" name="publish" value="변경 사항 적용" />
	</form>
	</p>
</section>