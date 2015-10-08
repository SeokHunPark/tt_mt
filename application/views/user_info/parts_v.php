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
	<form id="search_user" method="post" action="/user_info/parts/load_parts_list">
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
					부품 수정
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th scope="col">
					부품 이름
				</th>
				<th scope="col">
					클래스
				</th>
				<th scope="col">
					수량
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<form id="_modify_parts" method="post" action="/user_info/parts/modify_parts">
				<th scope="row">
					<input type="hidden" name="user_id_text" readonly="readonly" value="<?php echo $target_parts['user_id']; ?>" class="input_text" />
					<input type="text" name="item_code_text" readonly="readonly" value="<?php echo $target_parts['item_code']; ?>" class="input_text" />
				</th>
				<td>
					<input type="text" name="class_text" readonly="readonly" value="<?php echo $target_parts['class']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="count_text" value="<?php echo $target_parts['count']; ?>" class="" />
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
					부품 이름
				</th>
				<th scope="col">
					클래스
				</th>
				<th scope="col">
					수량
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($parts_list as $parts)
			{
			?>
				<tr>
					<form method="post" action="/user_info/parts/click_modify_button">
					<th scope="row">
						<input type="hidden" name="user_id" readonly="readonly" value="<?php echo $parts['user_id']; ?>" class="input_text" />
						<input type="text" name="item_code" readonly="readonly" value="<?php echo $parts['item_code']; ?>" class="input_text" />
					</th>
					<td>
						<input type="text" name="class" readonly="readonly" value="<?php echo $parts['class']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="count" readonly="readonly" value="<?php echo $parts['count']; ?>" class="" />
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