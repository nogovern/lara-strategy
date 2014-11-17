<!DOCTYPE html PUBLIC "-//W3C//Dtd html 4.01 Transitional//EN" "http://www.w3.org/tr/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>:::::KG모빌리언스 신용카드 연동 샘플:::::</title>
<style type="text/css">
	body {
		scrollbar-3dlight-color:#888888;
		scrollbar-arrow-color:#888888;
		scrollbar-track-color:#FFFFFF;
		scrollbar-darkshadow-color:#888888;
		scrollbar-face-color:#FFFFFF;
		scrollbar-highlight-color:#FFFFFF;
		scrollbar-shadow-color:#FFFFFF
	}
	body { FONT-family:돋움; FONT-size:9pt;color:#000000; text-decoration:none;}
	td { FONT-family:돋움; FONT-size:9pt;color:#000000; text-decoration:none;}
</style>

<script src="https://pg.mcash.co.kr/dlp/js/npgIF.js"></script> <!-- 필수 -->

<script language="javascript">

	/**
		결제 요청 함수 (결제창 호출)
	*/
	function reqPayment() {
		var form = document.payform;
		PAY_REQUEST(form);
	}

	/**
		거래시간은 편의상 구매자 PC 시간을 사용합니다.
		실제로는 쇼핑몰 서버의 시간을 사용해야 합니다.
	*/
	function setTxTime() {
		var time = new Date();
		var year = time.getFullYear() + "";
		var month = time.getMonth()+1;
		var date = time.getDate();
		var hour = time.getHours();
		var min = time.getMinutes();
		var sec = time.getSeconds();
		if(month<10) month = "0" + month;
		if(date<10) date = "0" + date;
		if(hour<10) hour = "0" + hour;
		if(min<10) min = "0" + min;
		if(sec<10) sec = "0" + sec;
		return year + month + date + hour + min + sec;
	}

	/**
		거래번호(MxIssueNO), 거래일시(MxIssueDate) 생성 예제
		예제에서는 편의상 거래시간을 거래번호로 사용합니다.
		실제로는 쇼핑몰의 고유 주문번호를 사용해야 합니다.
	*/
	function initValue() {
		var tmp = setTxTime();
		document.payform.MxIssueNO.value = "TEST_"+tmp;
		document.payform.MxIssueDate.value = tmp;
	}

</script>
</head>

<body onload="initValue();">
<form name="payform" accept-charset="euc-kr">
<!-- 결제 결과의 REDIRPATH 페이지 전송을 위한 parameter 시작 (수정하지 말것) -->
<input type="hidden" name="ReplyCode" value="">
<input type="hidden" name="ReplyMessage" value="">
<input type="hidden" name="CcCode" value="">
<input type="hidden" name="Installment" value="">
<!-- 결제 결과의 REDIRPATH 페이지 전송을 위한 parameter 끝 -->

<table border="1" width="100%">
<tr>
	<td align="center" colspan="6"><font size="15pt"><b>신용카드 결제 SAMPLE PAGE</b></font></td>
</tr>
<tr>
	<td colspan="3"><font color="red">&nbsp;빨간색 항목은 필수 값!!!</font></td>
	<td colspan="3"></td>
</tr>
<tr>
	<td align="center"><font color="red">가맹점 ID</font></td>
	<td align="center"><font color="red">*MxID</font></td>
	<td><input type="text" name="MxID" id="MxID" size="30" value=""></td>
	<td align="center"><font color="red">가맹점 거래번호</font></td>
	<td align="center"><font color="red">*MxIssueNO</font></td>
	<td><input type="text" name="MxIssueNO" id="MxIssueNO" size="30" value=""></td>
</tr>
<tr>
	<td align="center"><font color="red">결제 요청 시간</font></td>
	<td align="center"><font color="red">*MxIssueDate</font></td>
	<td><input type="text" name="MxIssueDate" id="MxIssueDate" size="30" value=""></td>
	<td align="center"><font color="red">결제 금액</font></td>
	<td align="center"><font color="red">*Amount</font></td>
	<td><input type="text" name="Amount" id="Amount" size="30" value="1000"></td>
</tr>
<tr>
	<td align="center"><font color="red">결제 화폐 코드</font></td>
	<td align="center"><font color="red">*Currency</font></td>
	<td><input type="text" name="Currency" id="Currency" size="30" value="KRW"></td>
	<td align="center"><font color="red">거래 종류</font></td>
	<td align="center"><font color="red">*CcMode</font></td>
	<td><input type="text" name="CcMode" id="CcMode" size="30" value="11"></td>
</tr>
<tr>
	<td align="center"><font color="red">결제 수단 구분</font></td>
	<td align="center"><font color="red">*Smode</font></td>
	<td><input type="text" name="Smode" id="Smode" size="30" value="3001"></td>
	<td align="center"><font color="red">판매 상품명</font></td>
	<td align="center"><font color="red">*CcProdDesc</font></td>
	<td><input type="text" name="CcProdDesc" id="CcProdDesc" size="30" value="신용카드 테스트 상품"></td>
</tr>
<tr>
	<td align="center"><font color="red">구매자 이름</font></td>
	<td align="center"><font color="red">*CcNameOnCard</font></td>
	<td><input type="text" name="CcNameOnCard" id="CcNameOnCard" size="30" value="테스터"></td>
	<td align="center"><font color="red">가맹점 DBPATH로 리턴 되는 값</font></td>
	<td align="center"><font color="red">*MSTR</font></td>
	<td><input type="text" name="MSTR" id="MSTR" size="50" value="MSTR_TEST"></td>
</tr>
<tr>
	<td align="center"><font color="red">가맹점 REDIRPATH로 리턴 되는 값</font></td>
	<td align="center"><font color="red">MSTR2*</font></td>
	<td><input type="text" name="MSTR2" id="MSTR2" size="50" value="MSTR2_TEST"></td>
	<td align="center"><font color="red">가맹점 서버 프로토콜</font></td>
	<td align="center"><font color="red">*connectionType</font></td>
	<td><input type="text" name="connectionType" id="connectionType" size="30" value="http"></td>
</tr>
<tr>
	<td align="center"><font color="red">가맹점 서버 URL</font></td>
	<td align="center"><font color="red">*URL</font></td>
	<td><input type="text" name="URL" id="URL" size="30" value=""></td>
	<td align="center"><font color="red">결과 저장 DBPATH 파일 경로</font></td>
	<td align="center"><font color="red">*DBPATH</font></td>
	<td><input type="text" name="DBPATH" id="DBPATH" size="30" value=""></td>
</tr>
<tr>
	<td align="center"><font color="red">결과 화면 REDIRPATH 파일 경로</font></td>
	<td align="center"><font color="red">*REDIRPATH</font></td>
	<td><input type="text" name="REDIRPATH" id="REDIRPATH" size="30" value=""></td>
	<td align="center"><font color="red"></font></td>
	<td align="center"><font color="red"></font></td>
	<td></td>
</tr>

<tr>
	<td align="center">결제창의 오픈 방식</td>
	<td align="center">dlpType</td>
	<td><input type="text" name="dlpType" id="dlpType" size="30" value=""></td>
	<td align="center">사용자 ID</td>
	<td align="center">Userid</td>
	<td><input type="text" name="Userid" id="Userid" size="30" value=""></td>
</tr>
<tr>
	<td align="center">결제완료 후 가맹점 REDIRPATH 자동 호출</td>
	<td align="center">AutoRedirCall</td>
	<td><input type="text" name="AutoRedirCall" id="AutoRedirCall" size="30" value=""></td>
	<td align="center">DBPATH로 넘어오는 data의 암호화 결정</td>
	<td align="center">signType</td>
	<td><input type="text" name="signType" id="signType" size="30" value=""></td>
</tr>
<tr>
	<td align="center">할부 개월 수를 지정</td>
	<td align="center">Install</td>
	<td><input type="text" name="Install" id="Install" size="30" value=""></td>
	<td align="center">사용자 이메일 주소</td>
	<td align="center">email</td>
	<td><input type="text" name="email" id="email" size="30" value=""></td>
</tr>
<tr>
	<td align="center">매출전표 출력 시 과세/비과세 구분</td>
	<td align="center">BillType</td>
	<td><input type="text" name="BillType" id="BillType" size="30" value=""></td>
	<td align="center">할부 수수료 가맹점 부담 여부</td>
	<td align="center">InstallType</td>
	<td><input type="text" name="InstallType" id="InstallType" size="30" value=""></td>
</tr>
<tr>
	<td align="center">포인트 결제 시 카드사 PAN코드</td>
	<td align="center">PAN</td>
	<td><input type="text" name="PAN" id="PAN" size="30" value=""></td>
	<td align="center">휴대폰번호</td>
	<td align="center">PhoneNO</td>
	<td><input type="text" name="PhoneNO" id="PhoneNO" size="30" value=""></td>
</tr>
<tr>
	<td align="center" colspan="6">&nbsp;</td>
</tr>
<tr>
	<td align="center" colspan="6"><input type="button" value="결제하기" onclick="reqPayment();"></td>
</tr>
</table>
</form>
</body>
</html>
