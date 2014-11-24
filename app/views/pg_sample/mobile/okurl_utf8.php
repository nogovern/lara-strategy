
<?php

/****************************************************************************************
* 파일명 : okurl.php
* 작성자 : PG기술팀
* 작성일 : 2013.10
* 용  도 : 휴대폰 결제 okurl 페이지
* 버  전 : 0006
* ---------------------------------------------------------------------------------------
* 결제 성공시 웹 페이지 전환으로 호출되는 페이지이며 가맹점에서 구현해야하는 페이지
*
* 결제 성공에 따른 결과를 사용자에게 출력 또는 서비스처리 페이지
* notiurl 에서 결과 저장시 중복 처리 주의 필요
* 팝업 형식의 결제창 사용시 가맹점 부모창에 대한 스크립트 처리를 하시면 됩니다.
****************************************************************************************/

$Resultcd		= $_POST["Resultcd"];		//[   4byte 고정] 결과코드
$Resultmsg		= $_POST["Resultmsg"];		//[ 100byte 이하] 결과메세지

$AutoBillKey	= $_POST["AutoBillKey"];	//[  15byte 이하] 자동결제 최초등록키
$CASH_GB		= $_POST["CASH_GB"];		//[   2byte 고정] 결제수단(MC)
$Commid			= $_POST["Commid"];			//[   3byte 고정] 이통사
$Mobilid		= $_POST["Mobilid"];		//[  15byte 이하] 모빌리언스 거래번호
$Mrchid			= $_POST["Mrchid"];			//[   8byte 고정] 상점ID
$MSTR			= $_POST["MSTR"];			//[2000byte 이하] 가맹점 전달 콜백변수
$No				= $_POST["No"];				//[  11byte 이하] 폰번호
$Payeremail		= $_POST["Payeremail"];		//[  30byte 이하] 결제자 이메일
$Prdtnm			= $_POST["Prdtnm"];			//[  50byte 이하] 상품명
$Prdtprice		= $_POST["Prdtprice"];		//[  10byte 이하] 상품가격
$Signdate		= $_POST["Signdate"];		//[  14byte 이하] 결제일자
$Svcid			= $_POST["Svcid"];			//[  12byte 고정] 서비스ID
$Tradeid		= $_POST["Tradeid"];		//[  40byte 이하] 상점거래번호
$Userid			= $_POST["Userid"];			//[  20byte 이하] 사용자ID
$USERKEY		= $_POST["USERKEY"];		//[  15byte 이하] 휴대폰정보(이통사, 휴대폰번호, 주민번호) 대체용 USERKEY



/*********************************************************************************
* 아래는 결과를 단순히 출력하는 샘플입니다.
* 가맹점에서는 부모창 전환등 스크립트 처리등을 하시면 됩니다.
*********************************************************************************/
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>가맹점 OKURL 모빌리언스 휴대폰결제</title>
</head>

<body>
<!-- input user information# -->
<table border ='1' width="100%">
<tr>
	<td width="20%">파라미터</td>
	<td width="80%">값</td>
</tr>
<tr>
	<td>Resultcd</td>
	<td><?php echo $Resultcd;?></td>
</tr>
<tr>
	<td>Resultmsg</td>
	<td><?php echo $Resultmsg;?></td>
</tr>
<tr>
	<td>AutoBillKey</td>
	<td><?php echo $AutoBillKey;?></td>
</tr>
<tr>
	<td>CASH_GB</td>
	<td><?php echo $CASH_GB;?></td>
</tr>
<tr>
	<td>Commid</td>
	<td><?php echo $Commid;?></td>
</tr>
<tr>
	<td>Mobilid</td>
	<td><?php echo $Mobilid;?></td>
</tr>
<tr>
	<td>Mrchid</td>
	<td><?php echo $Mrchid;?></td>
</tr>
<tr>
	<td>MSTR</td>
	<td><?php echo $MSTR;?></td>
</tr>
<tr>
	<td>No</td>
	<td><?php echo $No;?></td>
</tr>
<tr>
	<td>Payeremail</td>
	<td><?php echo $Payeremail;?></td>
</tr>
<tr>
	<td>Prdtnm</td>
	<td><?php echo $Prdtnm;?></td>
</tr>
<tr>
	<td>Prdtprice</td>
	<td><?php echo $Prdtprice;?></td>
</tr>
<tr>
	<td>Signdate</td>
	<td><?php echo $Signdate;?></td>
</tr>
<tr>
	<td>Svcid</td>
	<td><?php echo $Svcid;?></td>
</tr>
<tr>
	<td>Tradeid</td>
	<td><?php echo $Tradeid;?></td>
</tr>
<tr>
	<td>Userid</td>
	<td><?php echo $Userid;?></td>
</tr>
<tr>
	<td>USERKEY</td>
	<td><?php echo $USERKEY;?></td>
</tr>
</table>
</body>
</html>
