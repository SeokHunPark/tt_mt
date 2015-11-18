<style type="text/css">
.input_text {
	width: 100%;
}
table.admin_list_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.admin_list_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.admin_list_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

</style>

<script>
function open_delete_admin_popup(user_idx){

	var temp = $('#_delete_admin_popup');		//레이어의 id를 temp변수에 저장
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
	
	var user_idx_text = document.getElementById("_delete_admin_user_idx_text");
	user_idx_text.value = user_idx;
}
</script>

<section id="content">	
	<p>
	<table class="admin_list_table">
		<thead>
			<tr>
				<th scope="col">NO.</th>
				<th scope="col">관리자 아이디</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($admin_list as $admin)
			{
			?>
				<tr>
					<th scope="row">
						<?php echo $admin['user_idx']; ?>
					</th>
					<td>
						<?php echo $admin['user_name']; ?>
					</td>
					<td>
						<input type="button" id="_delete_admin_button" value="삭제" 
							onclick="open_delete_admin_popup('<?php echo $admin['user_idx']; ?>'); return false;" />
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	</p>
</section>