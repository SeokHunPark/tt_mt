﻿<style type="text/css">
.input_text {
	width: 100%;
}
table.car_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.car_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.car_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script type="text/javascript">
function open_delete_car_popup(user_id, model_id){

	var temp = $('#_delete_car_popup');		//레이어의 id를 temp변수에 저장
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
	
	var user_id_text = document.getElementById("_delete_car_user_id_text");
	user_id_text.value = user_id;
	var model_id_text = document.getElementById("_delete_car_model_id_text");
	model_id_text.value = model_id;
}

function open_delete_sup_popup(user_id, model_id){

	var temp = $('#_delete_sup_popup');		//레이어의 id를 temp변수에 저장
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
	
	var user_id_text = document.getElementById("_delete_sup_user_id_text");
	user_id_text.value = user_id;
	var model_id_text = document.getElementById("_delete_sup_model_id_text");
	model_id_text.value = model_id;
}
</script>

<section id="content">	
	<form id="search_user" method="post" action="/user_info/cars/load_car_list">
	<fieldset>
		<div>
			카카오톡 ID
			<input type="text" name="kakao_id_text" style="text-align:center;"/>
			게임 회원번호
			<input type="text" name="game_account_id_text" />
			닉네임
			<input type="text" name="nickname_text" />
			<input type="submit" name="user_search" value="조회" id="search_user_button" />
		</div>
	</fieldset>
	</form>
	
	<?php
	if (isset($user_id))
	{
	?>
	<p>
	<table class="car_table">
		<thead>
			<tr>
				<th scope="col" colspan="15">
					차량 추가
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th scope="col">
					모델명
				</th>
				<th scope="col">
					속도
				</th>
				<th scope="col">
					가속
				</th>
				<th scope="col">
					부스터 충전
				</th>
				<th scope="col">
					부스터 파워
				</th>
				<th scope="col">
					진화 등급
				</th>
				<th scope="col">
					경험치
				</th>
				<th scope="col">
					사용 가능 기술 포인트
				</th>
				<th scope="col">
					공격
				</th>
				<th scope="col">
					방어
				</th>
				<th scope="col">
					공기 저항
				</th>
				<th scope="col">
					데칼 정보
				</th>
				<th scope="col">
					페인트 정보
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<form id="_modify_car" method="post" action="/user_info/cars/add_car">
				<td scope="row">
					<input type="hidden" name="user_id_text" value="<?php echo $user_id; ?>" class="input_text" />
					<input type="text" name="model_id_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="speed_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="accel_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="booster_charge_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="booster_power_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="upgrade_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="exp_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="point_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="atk_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="def_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="aero_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="decal_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="color_text" class="input_text" />
				</td>
				<td>
					<input type="submit"value="추가" />
				</td>
				</form>
			</tr>
		</tbody>
	</table>
	</p>
	<?php
	}
	?>
	
	<?php
	if (isset($target_car))
	{
	?>
	<p>
	<table class="car_table">
		<thead>
			<tr>
				<th scope="col" colspan="15">
					차량 수정
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th scope="col">
					모델명
				</th>
				<th scope="col">
					클래스
				</th>
				<th scope="col">
					속도
				</th>
				<th scope="col">
					가속
				</th>
				<th scope="col">
					부스터 충전
				</th>
				<th scope="col">
					부스터 파워
				</th>
				<th scope="col">
					진화 등급
				</th>
				<th scope="col">
					경험치
				</th>
				<th scope="col">
					사용 가능 기술 포인트
				</th>
				<th scope="col">
					공격
				</th>
				<th scope="col">
					방어
				</th>
				<th scope="col">
					공기 저항
				</th>
				<th scope="col">
					데칼 정보
				</th>
				<th scope="col">
					페인트 정보
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<form id="_modify_car" method="post" action="/user_info/cars/modify_car">
				<td scope="row">
					<input type="hidden" name="user_id_text" value="<?php echo $target_car['user_id']; ?>" class="input_text" />
					<input type="text" name="model_id_text" value="<?php echo $target_car['model_id']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="class_text" value="<?php echo $target_car['class']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="speed_text" value="<?php echo $target_car['speed']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="accel_text" value="<?php echo $target_car['accel']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="booster_charge_text" value="<?php echo $target_car['booster_charge']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="booster_power_text" value="<?php echo $target_car['booster_power']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="upgrade_text" value="<?php echo $target_car['upgrade']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="exp_text" value="<?php echo $target_car['exp']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="point_text" value="<?php echo $target_car['point']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="atk_text" value="<?php echo $target_car['atk']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="def_text" value="<?php echo $target_car['def']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="aero_text" value="<?php echo $target_car['aero']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="decal_text" value="<?php echo $target_car['decal']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="color_text" value="<?php echo $target_car['color']; ?>" class="input_text" />
				</td>
				<td>
					<input type="submit" value="저장" />
				</td>
				</form>
			</tr>
		</tbody>
	</table>
	</p>
	<?php
	}
	?>
	
	<table class="car_table">
		<thead>
			<tr>
				<th scope="col">
					모델명
				</th>
				<th scope="col">
					클래스
				</th>
				<th scope="col">
					속도
				</th>
				<th scope="col">
					가속
				</th>
				<th scope="col">
					부스터 충전
				</th>
				<th scope="col">
					부스터 파워
				</th>
				<th scope="col">
					진화 등급
				</th>
				<th scope="col">
					경험치
				</th>
				<th scope="col">
					사용 가능 기술 포인트
				</th>
				<th scope="col">
					공격
				</th>
				<th scope="col">
					방어
				</th>
				<th scope="col">
					공기 저항
				</th>
				<th scope="col">
					데칼 정보
				</th>
				<th scope="col">
					페인트 정보
				</th>
				<th scope="col">
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($car_list as $car)
			{
			?>
				<tr>
					<form id="_modify_car" method="post" action="/user_info/cars/click_modify_button">
					<th scope="row">
						<input type="hidden" name="user_id" readonly="readonly" value="<?php echo $car['user_id']; ?>" class="input_text" />
						<input type="text" name="model_id" readonly="readonly" value="<?php echo $car['model_id']; ?>" class="input_text" />
					</th>
					<td>
						<input type="text" name="class" readonly="readonly" value="<?php echo $car['class']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="speed" readonly="readonly" value="<?php echo $car['speed']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="accel" readonly="readonly" value="<?php echo $car['accel']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="booster_charge" readonly="readonly" value="<?php echo $car['booster_charge']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="booster_power" readonly="readonly" value="<?php echo $car['booster_power']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="upgrade" readonly="readonly" value="<?php echo $car['upgrade']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="exp" readonly="readonly" value="<?php echo $car['exp']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="point" readonly="readonly" value="<?php echo $car['point']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="atk" readonly="readonly" value="<?php echo $car['atk']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="def" readonly="readonly" value="<?php echo $car['def']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="aero" readonly="readonly" value="<?php echo $car['aero']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="decal" readonly="readonly" value="<?php echo $car['decal']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="color" readonly="readonly" value="<?php echo $car['color']; ?>" class="input_text" />
					</td>
					<td>
						<input type="submit" name="modify_car" value="수정" />
					</td>
					</form>
					<td>
						<input type="submit" name="delete_car" value="삭제" 
							onclick="open_delete_car_popup('<?php echo $car['user_id']; ?>', '<?php echo $car['model_id']; ?>'); return false;"/>
					</td>
					
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	
	<?php
	if (isset($user_id))
	{
	?>
	<p>
	<table class="car_table">
		<thead>
			<tr>
				<th scope="col" colspan="4">
					서포터즈 추가
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th scope="col">
					서포터즈 이름
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<form id="_modify_sup" method="post" action="/user_info/cars/add_sup">
				<th scope="row">
					<input type="hidden" name="user_id_text" readonly="readonly" value="<?php echo $user_id; ?>" class="input_text" />
					<input type="text" name="model_id_text" class="input_text" />
				</th>
				<td>
					<input type="submit" value="추가" />
				</td>
				</form>
			</tr>
		</tbody>
	</table>
	</p>
	<?php
	}
	?>
	
	<?php
	if (isset($target_sup))
	{
	?>
	<p>
	<table class="car_table">
		<thead>
			<tr>
				<th scope="col" colspan="4">
					서포터즈 수정
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th scope="col">
					서포터즈 이름
				</th>
				<th scope="col">
					능력치
				</th>
				<th scope="col">
					호감도
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<form id="_modify_sup" method="post" action="/user_info/cars/modify_sup">
				<th scope="row">
					<input type="hidden" name="user_id_text" readonly="readonly" value="<?php echo $target_sup['user_id']; ?>" class="input_text" />
					<input type="text" name="model_id_text" readonly="readonly" value="<?php echo $target_sup['model_id']; ?>" class="input_text" />
				</th>
				<td>
					<input type="text" name="ability_text" readonly="readonly" value="<?php echo $target_sup['ability']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="count_text" value="<?php echo $target_sup['count']; ?>" class="" />
				</td>
				<td>
					<input type="submit" value="저장" />
				</td>
				</form>
			</tr>
		</tbody>
	</table>
	</p>
	<?php
	}
	?>
	
	<p>
	<table class="car_table">
		<thead>
			<tr>
				<th scope="col">
					서포터즈 이름
				</th>
				<th scope="col">
					능력치
				</th>
				<th scope="col">
					호감도
				</th>
				<th scope="col">
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($sup_list as $sup)
			{
			?>
				<tr>
					<form id="_modify_sup" method="post" action="/user_info/cars/click_modify_sup_button">
					<th scope="row">
						<input type="hidden" name="user_id" readonly="readonly" value="<?php echo $sup['user_id']; ?>" class="input_text" />
						<input type="text" name="model_id" readonly="readonly" value="<?php echo $sup['model_id']; ?>" class="input_text" />
					</th>
					<td>
						<input type="text" name="ability" readonly="readonly" value="<?php echo $sup['ability']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="count" readonly="readonly" value="<?php echo $sup['count']; ?>" class="" />
					</td>
					<td>
						<input type="submit" value="수정" />
					</td>
					</form>
					<td>
						<input type="submit" value="삭제" 
							onclick="open_delete_sup_popup('<?php echo $sup['user_id']; ?>', '<?php echo $sup['model_id']; ?>'); return false;"/>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	</p>
	
</section>