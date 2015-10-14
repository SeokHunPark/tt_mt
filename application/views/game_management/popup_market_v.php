<style type="text/css">
.input_text {
	width: 100%;
}
table.promotion_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.promotion_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.promotion_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script type="text/javascript">

</script>

<section id="content">
	<fieldset>
		<form id="_management_promotion" method="post" action="/game_management/popup_market">
		<input type="submit" value="프로모션 관리" />
		</form>
		<form id="_management_pakcage" method="post" action="/game_management/package">
		<input type="submit" value="패키지 관리" />
		</form>
	</fieldset>
	
	<p>
	<table class="promotion_table">
		<thead>
			<tr>
				<th scope="col" colspan="8">
					프로모션 수정
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th scope="col">
					프로모션 번호
				</th>
				<th scope="col">
					프로모션 이름
				</th>
				<th scope="col">
					지급 패키지 번호
				</th>
				<th scope="col">
					재 노출 간격 (분)
				</th>
				<th scope="col">
					구매 후 재 노출 간격 (일)
				</th>
				<th scope="col">
					노출 상한 보석
				</th>
				<th scope="col">
					노출 확률 (%)
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<form id="_save_promotion" method="post" action="/game_management/popup_market/save_promotion">
				<td scope="row">
					<input type="text" class="input_text" name="promotion_no_new_text" value="<?php echo $target_promo['promotion_no']; ?>" readonly="readonly" />
				</td>
				<td>
					<input type="text" class="input_text" name="title_new_text" value="<?php echo $target_promo['title']; ?>" />
				</td>
				<td>
					<input type="text" class="input_text" name="package_new_text" value="<?php echo $target_promo['package']; ?>" />
				</td>
				<td>
					<input type="text" class="input_text" name="expose_int_new_text" value="<?php echo $target_promo['expose_int']; ?>" />
				</td>
				<td>
					<input type="text" class="input_text" name="reexpose_buy_new_text" value="<?php echo $target_promo['reexpose_buy']; ?>" />
				</td>
				<td>
					<input type="text" class="input_text" name="expose_limit_new_text" value="<?php echo $target_promo['expose_limit']; ?>" />
				</td>
				<td>
					<input type="text" class="input_text" name="expose_prob_new_text" value="<?php echo $target_promo['expose_prob']; ?>" />
				</td>
				<td>
					<input type="submit" value="저장" action="/game_manegement/popup_market/modify_promotion" />
				</td>
				</form>
			</tr>
		</tbody>
	</table>
	</p>
	
	<p>
	<table class="promotion_table">
		<thead>
			<tr>
				<th scope="col">프로모션 번호</th>
				<th scope="col">프로모션 이름</th>
				<th scope="col">지급 패키지 번호</th>
				<th scope="col">재 노출 간격 (분)</th>
				<th scope="col">구매 후 재 노출 간격 (일)</th>
				<th scope="col">노출 상한 보석</th>
				<th scope="col">노출 확률 (%)</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($promotion_list as $promo)
			{
			?>
				<tr>
					<form id="_modify_promotion" method="post" action="/game_management/popup_market/modify_promotion">
					<th scope="row">
						<input type="text" class="input_text" name="promotion_no" readonly="readonly" value="<?php echo $promo->promotion_no; ?>" />
					</th>
					<td>
						<input type="text" class="input_text" name="title" readonly="readonly" value="<?php echo $promo->title; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="package" readonly="readonly" value="<?php echo $promo->package; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="expose_int" readonly="readonly" value="<?php echo $promo->expose_int; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="reexpose_buy" readonly="readonly" value="<?php echo $promo->reexpose_buy; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="expose_limit" readonly="readonly" value="<?php echo $promo->expose_limit; ?>" />
					</td>
					<td>
						<input type="text" class="input_text" name="expose_prob" readonly="readonly" value="<?php echo $promo->expose_prob; ?>" />
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
	
	<p>
	<form method="post" action="/game_management/popup_market/publish">
	<input type="submit" name="publish" value="변경 사항 적용" />
	</form>
	</p>
</section>