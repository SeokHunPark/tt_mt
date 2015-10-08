<style type="text/css">
.input_text {
	width: 100%;
}
table.parts_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.parts_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.parts_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script type="text/javascript">

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
	
	<p>
	<table class="parts_table">
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
	
	<p>
	<table class="parts_table">
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
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	</p>
	
</section>