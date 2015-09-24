<style type="text/css">
table.account_info_table {
	border: 1px solid black;
	border-collapse: collapse;
	text-align: center;
}
.account_info_table th {
	width: 180;
	border: 1px solid black;
	border-spacing: 0px;
 }
.account_info_table td {
	width: 250;
	border: 1px solid black;
	border-spacing: 0px;
 }
</style>

<script>
</script>

<section id="content">
	<form id="search_user" method="post" action="account_lookup/load_account_info">
	<fieldset>
		<div>
			카카오톡 ID
			<input type="text" name="kakao_id_text" />
			게임 회원번호
			<input type="text" name="game_account_id_text" />
			닉네임
			<input type="text" name="nickname_text" />
			<input type="submit" value="조회" id="search_user_button" />
		</div>		
	</fieldset>
	</form>
	
	<table class="account_info_table">
		<tbody>
			<tr>
				<th scope="row">
				카카오톡ID
				</th>
				<td>
				<?php echo $account_info['kakao_id']; ?>
				</td>
				<th>
				캐릭터 명
				</th>
				<td>
				<?php echo $account_info['kakao_id']; ?>
				<input type="submit" value="변경" name="button" />
				</td>
				<td>
					<input type="submit" value="탈퇴" name="button" />
				</td>
			</tr>
			<tr>
				<th scope="row">
				게임 회원번호
				</th>
				<td>
				
				</td>
				<th>
				가입일자
				</th>
				<td>
				
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<th scope="row">
				연료
				</th>
				<td>
				
				</td>
				<th>
				코인
				</th>
				<td>
				
				</td>
				<td rowspan="2">
					<input type="submit" value="재화수정" name="button" />
				</td>
			</tr>
			<tr>
				<th scope="row">
				다이아(유료/무료)
				</th>
				<td>
				
				</td>
				<th>
				트로피
				</th>
				<td>
				
				</td>
			</tr>
			<tr>
				<th scope="row">
				대결모드 연승
				</th>
				<td>
				99
				<input type="submit" value="변경" name="button" />
				</td>
				<th>
				미션모드 진행도
				</th>
				<td>
				1-3
				<input type="submit" value="변경" name="button" />
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<th scope="row">
				친구 대전 연승
				</th>
				<td>
				99
				<input type="submit" value="변경" name="button" />
				</td>
				<th>
				계정 레벨
				</th>
				<td>
				13
				<input type="submit" value="변경" name="button" />
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<th scope="row">
				탈퇴여부
				</th>
				<td>
				
				</td>
				<th>
				탈퇴일자
				</th>
				<td>
				
				</td>
				<td>
					<input type="submit" value="탈퇴복구" name="button" />
				</td>
			</tr>
			<tr>
				<th scope="row">
				최근 로그인
				</th>
				<td>
				
				</td>
				<th>
				접속여부
				</th>
				<td colspan="2">
				Y / N
				</td>
			</tr>
			<tr>
				<th scope="row">
				이용 제한 타입
				</th>
				<td>
				
				</td>
				<th rowspan="2">
				계정 블록
				</th>
				<td>
				
				</td>
				<td>
					<input type="submit" value="제재" name="button" />
				</td>
			</tr>
			<tr>
				<th scope="row">
				제재일
				</th>
				<td>
				
				</td>
				<td>
				블록 해제
				</td>
				<td>
					<input type="submit" value="해제" name="button" />
				</td>
			</tr>
			<tr>
				<th scope="row">
				해제일
				</th>
				<td>
				
				</td>
				<th>
				친구 초대 횟수
				</th>
				<td>
				
				</td>
				<td>
				</td>
			</tr>
		</tbody>
	</table>
</section>