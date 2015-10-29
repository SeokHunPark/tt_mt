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

<div id="modify_nickname_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">닉네임 변경</p>
			
			<form id="modify_nickname" method="post" action="/user_info/account_lookup/modify_nickname">
			<input type="hidden" id="_user_id_text" name="user_id_text" />
			<table class="table table-striped" border="1px" cellspacing="0" cellpadding="10">
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
				<input type="button" id="cancel_btn" value="취소" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>

<div id="_secession_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">탈퇴 하시겠습니까?</p>
			
			<form id="_secession" method="post" action="/user_info/account_lookup/secession">
			<input type="hidden" id="_secession_user_id_text" name="secession_user_id_text" />
			<div class="btn-r">
				<input type="submit" value="탈퇴" name="button" />
				<input type="button" id="cancel_btn" value="취소" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>

<div id="_secession_recovery_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">탈퇴 복구를 진행 하시겠습니까?</p>
			
			<form id="_secession_recovery" method="post" action="/user_info/account_lookup/secession_recovery">
			<input type="hidden" id="_secession_recovery_user_id_text" name="secession_recovery_user_id_text" />
			<div class="btn-r">
				<input type="submit" value="확인" name="button" />
				<input type="button" id="cancel_btn" value="취소" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>

<div id="_modify_money_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">재화 변경 (+/- 기호로 재화 조절)</p>
			
			<form id="modify_money" method="post" action="/user_info/account_lookup/modify_money">
			<input type="hidden" id="_modify_money_user_id_text" name="modify_money_user_id_text" />
			<table class="info_table">
				<tbody>
					<tr>
						<td scope="row">
							연료
						</td>
						<td>
							<input type="text" id="_gas_text" name="gas_text" readonly="readonly" style="width:100%;" />
						</td>
						<td>
							코인
						</td>
						<td>
							<input type="text" id="_coin_text" name="coin_text" readonly="readonly" style="width:100%;" />
						</td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td scope="row" colspan="2">
							<input type="text" id="_new_gas_count_text" name="new_gas_count_text" />
						</td>
						<td colspan="2">
							<input type="text" id="_new_coin_count_text" name="new_coin_count_text" />
						</td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td scope="row">
							다이아(유료/무료)
						</td>
						<td>
							<input type="text" id="_gold_text" name="gold_text" readonly="readonly" style="width:40%;" />
							/
							<input type="text" id="_vgold_text" name="vgold_text" readonly="readonly" style="width:40%;" />
						</td>
						<td>
							트로피
						</td>
						<td>
							<input type="text" id="_chip_text" name="chip_text" readonly="readonly" style="width:100%;" />
						</td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td scope="row" colspan="2">
							<input type="text" id="_new_gold_count_text" name="new_gold_count_text" />
							/
							<input type="text" id="_new_vgold_count_text" name="new_vgold_count_text" />
						</td>
						<td colspan="2">
							<input type="text" id="_new_chip_count_text" name="new_chip_count_text" />
						</td>
					</tr>
				</tbody>
			</table>

			<div class="btn-r">
				<input type="submit" value="변경" name="button" />
				<input type="button" id="cancel_btn" value="취소" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>

<div id="_straight_wins_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">대결 모드 연승을 변경 하시겠습니까?</p>
			
			<form id="_straight_wins" method="post" action="/user_info/account_lookup/modify_straight_wins">
			<input type="hidden" id="_straight_wins_user_id_text" name="straight_wins_user_id_text" />
			<input type="text" id="_winning_count_text" name="winning_count_text" />
			<div class="btn-r">
				<input type="submit" value="확인" name="button" />
				<input type="button" id="cancel_btn" value="취소" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>

<div id="_mission_status_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">미션 모드 스테이지 변경 하시겠습니까?</p>
			
			<form id="_modify_mission_status" method="post" action="/user_info/account_lookup/modify_mission_status">
			<input type="hidden" id="_mission_status_user_id_text" name="mission_status_user_id_text" />
			<input type="text" id="_mission_text" name="mission_text" />
			<input type="text" id="_stage_text" name="stage_text" />
			<div class="btn-r">
				<input type="submit" value="확인" name="button" />
				<input type="button" id="cancel_btn" value="취소" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>

<div id="_modify_level_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">계정 경험치를 변경 하시겠습니까?</p>
			
			<form id="_modify_level" method="post" action="/user_info/account_lookup/modify_level">
			<input type="hidden" id="_level_user_id_text" name="level_user_id_text" />
			<input type="text" id="_level_text" name="level_text" />
			<div class="btn-r">
				<input type="submit" value="확인" name="button" />
				<input type="button" id="cancel_btn" value="취소" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>

<div id="_modify_user_type_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">변경할 계정 유형을 입력하십시오</p>
			
			<form id="_modify_user_type" method="post" action="/user_info/account_lookup/modify_user_type">
			<input type="hidden" id="_user_type_user_id_text" name="user_type_user_id_text" />
			<input type="text" id="_user_type_text" name="user_type_text" />
			<div class="btn-r">
				<input type="submit" value="확인" name="button" />
				<input type="button" id="cancel_btn" value="취소" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>

<div id="_modify_rp_popup" class="pop-layer">
	<div class="pop-container">
		<div class="pop-conts">
			<!--content //-->
			<p class="ctxt mb20">변경할 랭크 포인트를 입력하세요(변경 된 랭크 포인트는 아이템전을 플레이해야 랭킹 서버에 적용이 됩니다)</p>
			
			<form id="_modify_rp" method="post" action="/user_info/account_lookup/modify_rp">
			<input type="hidden" id="_rp_user_id_text" name="rp_user_id_text" />
			<input type="text" id="_rp_text" name="rp_text" />
			<div class="btn-r">
				<input type="submit" value="확인" name="button" />
				<input type="button" id="cancel_btn" value="취소" />
			</div>
			</form>
			<!--// content-->
		</div>
	</div>
</div>