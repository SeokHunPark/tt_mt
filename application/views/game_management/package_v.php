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
					패키지 추가
				</th>
			</tr>
		</thead>
		<thead>
			<tr>
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
				<form id="_add_package" method="post" action="/game_management/package/add_package">
				<td scope="row">
					<input type="text" name="price_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="image_url_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="gold_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="gas_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="coin_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="item1_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="item2_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="item3_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="item4_text" class="input_text" />
				</td>
				<td>
					<input type="text" name="item5_text" class="input_text" />
				</td>
				<td>
					<input type="submit" value="추가" />
				</td>
				</form>
			</tr>
		</tbody>
	</table>
	</p>
	
	<p>
	<table class="package_table">
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
					<input type="text" name="package_no_new_text" value="<?php echo $target_package['package_no']; ?>" class="input_text" readonly="readonly" />
				</td>
				<td>
					<input type="text" name="price_new_text" value="<?php echo $target_package['price']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="image_url_new_text" value="<?php echo $target_package['image_url']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="gold_new_text" value="<?php echo $target_package['gold']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="gas_new_text" value="<?php echo $target_package['gas']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="coin_new_text" value="<?php echo $target_package['coin']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="item1_new_text" value="<?php echo $target_package['item1']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="item2_new_text" value="<?php echo $target_package['item2']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="item3_new_text" value="<?php echo $target_package['item3']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="item4_new_text" value="<?php echo $target_package['item4']; ?>" class="input_text" />
				</td>
				<td>
					<input type="text" name="item5_new_text" value="<?php echo $target_package['item5']; ?>" class="input_text" />
				</td>
				<td>
					<input type="submit" value="저장" />
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
					<form id="_modify_promotion" method="post" action="/game_management/package/modify_package">
					<th scope="row">
						<input type="text" name="package_no" readonly="readonly" value="<?php echo $pkg['package_no']; ?>" class="input_text" />
					</th>
					<td>
						<input type="text" name="price" readonly="readonly" value="<?php echo $pkg['price']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="image_url" readonly="readonly" value="<?php echo $pkg['image_url']; ?>" class="" />
					</td>
					<td>
						<input type="text" name="gold" readonly="readonly" value="<?php echo $pkg['gold']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="gas" readonly="readonly" value="<?php echo $pkg['gas']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="coin" readonly="readonly" value="<?php echo $pkg['coin']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="item1" readonly="readonly" value="<?php echo $pkg['item1']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="item2" readonly="readonly" value="<?php echo $pkg['item2']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="item3" readonly="readonly" value="<?php echo $pkg['item3']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="item4" readonly="readonly" value="<?php echo $pkg['item4']; ?>" class="input_text" />
					</td>
					<td>
						<input type="text" name="item5" readonly="readonly" value="<?php echo $pkg['item5']; ?>" class="input_text" />
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