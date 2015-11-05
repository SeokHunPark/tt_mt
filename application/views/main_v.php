	<style type="text/css">
	#content {
		height:1000px;
		background-color:#F5F5F5;
	}
	</style>
	
	<script>
			
		$(document).ready(function() {
			$("#search_btn").click(function() {
				if ($("#q").val() == '') {
					alert('검색어를 입력하세요');
					return false;
				} else {
					var act = '/main/load_main';
					$("#bd_search").attr('action', act).submit();
				}
			});
		});
		
		function user_search_enter(form) {
			var keycode = window.event.keyCode;
			if (keycode == 13) $("#search_btn").click();
		}
		
		function layer_open(el, user_id, nickname, gas, coin){

			var temp = $('#' + el);		//레이어의 id를 temp변수에 저장
			temp.fadeIn();	//bg 클래스가 없으면 일반레이어로 실행한다.

			// 화면의 중앙에 레이어를 띄운다.
			if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
			else temp.css('top', '0px');
			if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
			else temp.css('left', '0px');

			temp.find('a.cbtn').click(function(e){
				temp.fadeOut();		//'닫기'버튼을 클릭하면 레이어가 사라진다.
				e.preventDefault();
			});

			var id_text = document.getElementById("popup_user_id_text");
			id_text.value = user_id;
			var id_text = document.getElementById("popup_nickname_text");
			id_text.value = nickname;
			var id_text = document.getElementById("popup_gas_text");
			id_text.value = gas;
			var id_text = document.getElementById("popup_coin_text");
			id_text.value = coin;
		}
		
		$(document).ready(function(){
			$(".datepicker").datepicker({
				dateFormat:'yy-mm-dd',
				monthNamesShort:['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
				dayNamesMin : ['일','월','화','수','목','금','토'],
				monthNames : ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
				constrainInput: true
			});
			$("#radio").buttonset();
		});
	</script>
	
	<section id="content">
		<form id="bd_search" method="post">
		<fieldset>
			<div class="control-group">
				<input type="text" name="user_id" id="q" onkeypress="user_search_enter(document.q);" />
				<input type="button" value="조회" id="search_btn" />
			</div>
			<input type="text" class="datepicker">
		</fieldset>
		</form>
		
		<header>목록</header>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">user_id</th>
					<th scope="col">nickname</th>
					<th scope="col">gas</th>
					<th scope="col">coin</th>
					<th scope="col">수정</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($list as $lt)
				{
				?>
					<tr>
						<th scope="row">
							<?php echo $lt->user_id; ?>
						</th>
						<td>
							<?php echo $lt->nickname; ?>
						</td>
						<td>
							<?php echo $lt->gas; ?>
						</td>
						<td>
							<?php echo $lt->coin; ?>
						</td>
						<td>
							<input type="button" value="수정" id="modify_btn" 
								onclick="layer_open('layer1', 
													'<?php echo $lt->user_id; ?>', 
													'<?php echo $lt->nickname; ?>', 
													'<?php echo $lt->gas; ?>', 
													'<?php echo $lt->coin; ?>'); return false;" />
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</section>
	