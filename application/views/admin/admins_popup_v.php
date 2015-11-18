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

table.info_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.info_table th {
	border: 1px solid black;
	border-spacing: 0px;
 }
.info_table td {
	border: 1px solid black;
	border-spacing: 0px;
 }

a.pop-btn {
	display:inline-block; height:25px; padding:0 14px 0; border:1px solid #304a8a; background-color:#3f5a9d; font-size:13px; color:#fff; line-height:25px;
}	
a.pop-btn:hover {
	border: 1px solid #091940; background-color:#1f326a; color:#fff;
}

</style>

<div id="_delete_admin_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">관리자를 삭제 하시겠습니까?</p>
			
			<form id="_delete_admin" method="post" action="/admin/admins/delete_admin">
			<input type="input" id="_delete_admin_user_idx_text" name="delete_admin_user_idx_text" readonly="readonly"/>
			<div class="btn-r">
				<input type="submit" value="확인" name="button" />
				<input type="button" id="cancel_btn" value="취소" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>
