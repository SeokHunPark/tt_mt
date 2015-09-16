<style type="text/css">
#content {
	height:1000px;
	background-color:#F5F5F5;
}

.pop-layer {
	display:none; position: absolute; top: 50%; left: 50%; width: auto; height:auto;  background-color:#fff; border: 5px solid #3571B5; z-index: 10;
}	
.pop-layer .pop-container {
	padding: 20px 25px;
}
.pop-layer p.ctxt {
	color: #666; line-height: 25px;
}
.pop-layer .btn-r {
	width: 100%; margin:10px 0 20px; padding-top: 10px; border-top: 1px solid #DDD; text-align:right;
}

a.cbtn {
	display:inline-block; height:25px; padding:0 14px 0; border:1px solid #304a8a; background-color:#3f5a9d; font-size:13px; color:#fff; line-height:25px;
}	
a.cbtn:hover {
	border: 1px solid #091940; background-color:#1f326a; color:#fff;
}

</style>

<script>
	$(document).ready(function() {
		$("#popup_modify_btn").click(function() {
			if ($("#user_id_text").val() == '') {
				alert('user_id를 입력하세요');
				return false;
			} else {
				var act1 = '/main/update_user';
				$("#modify_user_info").attr('action', act1).submit();
				
				var id_text = document.getElementById("popup_user_id_text");
				var act2 = '/main/load_main/' + id_text.value;
				$("#modify_user_info").attr('action', act2).submit();
			}
		});
	});
</script>

<div id="layer1" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">레이어 팝업 테스트</p>
			
			<form id="modify_user_info" method="post">
			<table id="popup-table" class="table table-striped" border="1px" cellspacing="0" cellpadding="10">
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
					<tr>
						<th scope="row">
							<input type="text" id="popup_user_id_text" name="user_id_text" />
						</th>
						<td>
							<input type="text" id="popup_nickname_text" name="nickname_text" />
						</td>
						<td>
							<input type="text" id="popup_gas_text" name="gas_text" />
						</td>
						<td>
							<input type="text" id="popup_coin_text" name="coin_text" />
						</td>
						<td>
							<input type="button" value="수정" id="popup_modify_btn"/>
						</td>
					</tr>
				</tbody>
			</table>
			</form>

			<div class="btn-r">
				<a href="#" class="cbtn">Close</a>
			</div>
			<!--// content-->
		</div>
	</div>
</div>