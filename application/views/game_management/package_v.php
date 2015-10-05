<style type="text/css">
.input_text {
	width: 100%;
}
table.package_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.package_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.package_table td {
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
	<table class="package_table">
		<thead>
			<tr>
				<th scope="col" colspan="15">
					프로모션 수정
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
				<th scope="col">
					패키지 번호
				</th>
				<th scope="col">
					아이템 가격
				</th>
				<th scope="col">
					상품 이미지 URL
				</th>
				<th scope="col">
					지급 보석
				</th>
				<th scope="col">
					지급 연료
				</th>
				<th scope="col">
					지급 코인
				</th>
				<th scope="col">
					지급 아이템 1
				</th>
				<th scope="col">
					지급 아이템 2
				</th>
				<th scope="col">
					지급 아이템 3
				</th>
				<th scope="col">
					지급 아이템 4
				</th>
				<th scope="col">
					지급 아이템 5
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<form id="_save_package" method="post" action="/game_management/package/save_package">
				<td scope="row">
					<input type="text" name="promotion_no_new_text" value="<?php echo $target_package['package_no']; ?>" class="input_text" readonly="readonly" />
				</td>
				<td>
					<input type="text" name="title_new_text" value="<?php echo $target_package['price']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="package_new_text" value="<?php echo $target_package['image_url']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="expose_int_new_text" value="<?php echo $target_package['gold']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="reexpose_buy_new_text" value="<?php echo $target_package['gas']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="expose_limit_new_text" value="<?php echo $target_package['coin']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="expose_prob_new_text" value="<?php echo $target_package['item1']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="expose_prob_new_text" value="<?php echo $target_package['item2']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="expose_prob_new_text" value="<?php echo $target_package['item3']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="expose_prob_new_text" value="<?php echo $target_package['item4']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="expose_prob_new_text" value="<?php echo $target_package['item5']; ?>" class="input_text" />
				</td>
				<td>
					<input type="submit" value="저장" action="/game_manegement/popup_market/modify_promotion" />
				</td>
				</form>
			</tr>
		</tbody>
	</table>
	</p>
	
	<table class="package_table">
		<thead>
			<tr>
				<th scope="col">
					패키지 번호
				</th>
				<th scope="col">
					아이템 가격
				</th>
				<th scope="col">
					상품 이미지 URL
				</th>
				<th scope="col">
					지급 보석
				</th>
				<th scope="col">
					지급 연료
				</th>
				<th scope="col">
					지급 코인
				</th>
				<th scope="col">
					지급 아이템 1
				</th>
				<th scope="col">
					지급 아이템 2
				</th>
				<th scope="col">
					지급 아이템 3
				</th>
				<th scope="col">
					지급 아이템 4
				</th>
				<th scope="col">
					지급 아이템 5
				</th>
				<th scope="col">
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($package_list as $pkg)
			{
			?>
				<tr>
					<form id="_modify_promotion" method="post" action="/game_management/popup_market/modify_package">
					<th scope="row">
						<input type="text" name="package_no" readonly="readonly" value="<?php echo $pkg->package_no; ?>" class="input_text" />
					</th>
					<td>
						<input type="text" name="price" readonly="readonly" value="<?php echo $pkg->price; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="image_url" readonly="readonly" value="<?php echo $pkg->image_url; ?>" class="" />
					</td>
					<td>
						<input type="text" name="gold" readonly="readonly" value="<?php echo $pkg->gold; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="gas" readonly="readonly" value="<?php echo $pkg->gas; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="coin" readonly="readonly" value="<?php echo $pkg->coin; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="expose_prob" readonly="readonly" class="input_text" />
					</td>
					<td>
						<input type="text" name="expose_prob" readonly="readonly" class="input_text" />
					</td>
					<td>
						<input type="text" name="expose_prob" readonly="readonly" class="input_text" />
					</td>
					<td>
						<input type="text" name="expose_prob" readonly="readonly" class="input_text" />
					</td>
					<td>
						<input type="text" name="expose_prob" readonly="readonly" class="input_text" />
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
</section>