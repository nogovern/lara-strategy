
<?

/****************************************************************************************
* ���ϸ� : okurl.php
* �ۼ��� : PG�����
* �ۼ��� : 2013.10
* ��  �� : �޴��� ���� okurl ������
* ��  �� : 0006
* ---------------------------------------------------------------------------------------
* ���� ������ �� ������ ��ȯ���� ȣ��Ǵ� �������̸� ���������� �����ؾ��ϴ� ������
*
* ���� ������ ���� ����� ����ڿ��� ��� �Ǵ� ����ó�� ������
* notiurl ���� ��� ����� �ߺ� ó�� ���� �ʿ�
* �˾� ������ ����â ���� ������ �θ�â�� ���� ��ũ��Ʈ ó���� �Ͻø� �˴ϴ�.
****************************************************************************************/

$Resultcd		= $_POST["Resultcd"];		//[   4byte ����] ����ڵ�
$Resultmsg		= $_POST["Resultmsg"];		//[ 100byte ����] ����޼���

$AutoBillKey	= $_POST["AutoBillKey"];	//[  15byte ����] �ڵ����� ���ʵ��Ű
$CASH_GB		= $_POST["CASH_GB"];		//[   2byte ����] ��������(MC)
$Commid			= $_POST["Commid"];			//[   3byte ����] �����
$Mobilid		= $_POST["Mobilid"];		//[  15byte ����] ������� �ŷ���ȣ
$Mrchid			= $_POST["Mrchid"];			//[   8byte ����] ����ID
$MSTR			= $_POST["MSTR"];			//[2000byte ����] ������ ���� �ݹ麯��
$No				= $_POST["No"];				//[  11byte ����] ����ȣ
$Payeremail		= $_POST["Payeremail"];		//[  30byte ����] ������ �̸���
$Prdtnm			= $_POST["Prdtnm"];			//[  50byte ����] ��ǰ��
$Prdtprice		= $_POST["Prdtprice"];		//[  10byte ����] ��ǰ����
$Signdate		= $_POST["Signdate"];		//[  14byte ����] ��������
$Svcid			= $_POST["Svcid"];			//[  12byte ����] ����ID
$Tradeid		= $_POST["Tradeid"];		//[  40byte ����] �����ŷ���ȣ
$Userid			= $_POST["Userid"];			//[  20byte ����] �����ID
$USERKEY		= $_POST["USERKEY"];		//[  15byte ����] �޴�������(�����, �޴�����ȣ, �ֹι�ȣ) ��ü�� USERKEY



/*********************************************************************************
* �Ʒ��� ����� �ܼ��� ����ϴ� �����Դϴ�.
* ������������ �θ�â ��ȯ�� ��ũ��Ʈ ó������ �Ͻø� �˴ϴ�.
*********************************************************************************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"/>
<title>������ OKURL ������� �޴�������</title>
</head>

<body>
<!-- input user information# -->
<table border ='1' width="100%">
<tr>
	<td width="20%">�Ķ����</td>
	<td width="80%">��</td>
</tr>
<tr>
	<td>Resultcd</td>
	<td><?echo $Resultcd;?></td>
</tr>
<tr>
	<td>Resultmsg</td>
	<td><?echo $Resultmsg;?></td>
</tr>
<tr>
	<td>AutoBillKey</td>
	<td><?echo $AutoBillKey;?></td>
</tr>
<tr>
	<td>CASH_GB</td>
	<td><?echo $CASH_GB;?></td>
</tr>
<tr>
	<td>Commid</td>
	<td><?echo $Commid;?></td>
</tr>
<tr>
	<td>Mobilid</td>
	<td><?echo $Mobilid;?></td>
</tr>
<tr>
	<td>Mrchid</td>
	<td><?echo $Mrchid;?></td>
</tr>
<tr>
	<td>MSTR</td>
	<td><?echo $MSTR;?></td>
</tr>
<tr>
	<td>No</td>
	<td><?echo $No;?></td>
</tr>
<tr>
	<td>Payeremail</td>
	<td><?echo $Payeremail;?></td>
</tr>
<tr>
	<td>Prdtnm</td>
	<td><?echo $Prdtnm;?></td>
</tr>
<tr>
	<td>Prdtprice</td>
	<td><?echo $Prdtprice;?></td>
</tr>
<tr>
	<td>Signdate</td>
	<td><?echo $Signdate;?></td>
</tr>
<tr>
	<td>Svcid</td>
	<td><?echo $Svcid;?></td>
</tr>
<tr>
	<td>Tradeid</td>
	<td><?echo $Tradeid;?></td>
</tr>
<tr>
	<td>Userid</td>
	<td><?echo $Userid;?></td>
</tr>
<tr>
	<td>USERKEY</td>
	<td><?echo $USERKEY;?></td>
</tr>
</table>
</body>
</html>
