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
	width: 100%; margin:10px 0 20px; padding-top: 10px; border-top: 1px solid #DDD; text-align:center;
}

a.pop-btn {
	display:inline-block; height:25px; padding:0 14px 0; border:1px solid #304a8a; background-color:#3f5a9d; font-size:13px; color:#fff; line-height:25px;
}	
a.pop-btn:hover {
	border: 1px solid #091940; background-color:#1f326a; color:#fff;
}

</style>

<div id="modify_nickname_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">닉네임 변경</p>
			
			<form id="modify_nickname" method="post" action="/user_info/account_lookup/modify_nickname">
			<input type="hidden" id="_user_id_text" name="user_id_text" />
			<table id="popup-table" class="table table-striped" border="1px" cellspacing="0" cellpadding="10">
				<thead>
					<tr>
						<th scope="col">
							현재 닉네임
						</th>
						<th scope="col">
							<input type="text" id="_nickname_text" name="nickname_text" readonly="readonly" />
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">
							변경 할 닉네임
						</th>
						<td>
							<input type="text" id="_new_nickname_text" name="new_nickname_text" />
						</td>
					</tr>
				</tbody>
			</table>

			<div class="btn-r">
				<input type="submit" value="변경" name="button" />
				<input type="button" id="cancel_btn" value="취소" name="button" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>