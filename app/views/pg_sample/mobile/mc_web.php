<?
/****************************************************************************************
* ���ϸ� : mc_web.php
* �ۼ��� : PG�����
* �ۼ��� : 2013.10
* ��  �� : �޴��� ����ũ ��� ���� ���� ������
* ��  �� : 0006
* ---------------------------------------------------------------------------------------
* �������� �ҽ� ���Ǻ��濡 ���� å���� ������𽺿��� å���� ���� �ʽ��ϴ�.
* ��û �Ķ���� �� ���� �� �������� Okurl / Notiurl ���� Return �Ǵ� �Ķ���Ϳ�
* ������ ����ó�� ����� ���� �Ŵ����� �ݵ�� �����ϼ���.
* �����Ǽ��� ��ȯ�� �� ������� ������������� �����ٶ��ϴ�.
* 
* ��ȣȭ ���� seed.tar ��� ��ġ �ʿ�
* ��� ��ġ�� ���� ������ �޴��� ���� �Ŵ��� ����
****************************************************************************************/

//�Ʒ� ��ȣȭ��� ��δ� ������ ������ ��ġ�� libCipher �������ϸ� ������ �����η� �����ʼ� (��: /user1/mcash/seed/libCipher)
define("SEEDEXE", "");

/*****************************************************************
�Լ��� : cipher ��ȣȭ ����
���� : cipher ("��ȣȭ�ҵ�����", "�������ŷ���ȣ")
���ǻ��� : �����������
*****************************************************************/
function cipher($seedStr, $seedKey) {
	if($seedStr == "") return "";
	return exec(SEEDEXE." E ".escapeshellarg(getKey($seedKey))." ".escapeshellarg($seedStr)." ");
}

function getKey($value) {
	$padding = "123456789123456789";
	$tmpKey = $value;
	$keyLength = strlen($value);
	if($keyLength < 16) $tmpKey = $tmpKey.substr($padding, 0, 16-$keyLength);
	else $tmpKey = substr($tmpKey, strlen($tmpKey)-16,  strlen($tmpKey));
	for($i = 0; $i < 16; $i++) {
		$result = $result.chr(ord(substr($tmpKey, $i, 1))^($i+1));
	}
	return $result;
}

/*****************************************************************
�Լ��� : appr_dtm ���� ��û�Ͻ� ���ϱ�
*****************************************************************/
function appr_dtm() {
	$microtime = microtime();
	$comps = explode(" ", $microtime);
	return date("YmdHis") . sprintf("%04d", $comps[0] * 10000);
}

/*****************************************************************************************
- �ʼ� �Է� �׸�
*****************************************************************************************/
$CASH_GB	= "MC";		//[   2byte ����] �������ܱ���. "MC" ������. �����Ұ�!
$MC_SVCID	= "";		//[  12byte ����] ������𽺿��� �ο��� ����ID (12byte ���� ����)
$Prdtprice	= "";		//[  10byte ����] ������û�ݾ� (��ȣȭ ��� �� ��ȣȭ ���)
$PAY_MODE	= "00";		//[   2byte ����] ������ �׽�Ʈ/�ǰ��� ���� (00: �׽�Ʈ����-�����, 10: �ǰŷ�����-����)
$Okurl		= "";		//[ 128byte ����] ���� �Ϸ� �� ����ڿ��� ������ �������� �Ϸ� ������. (��: http://www.mcash.co.kr/okurl.jsp)
$Prdtnm		= "";		//[  50byte ����] ��ǰ��
$Siteurl	= "";		//[  20byte ����] ������������ (��: www.mcash.co.kr)

$Tradeid	= $MC_SVCID . "_" . appr_dtm();	//[4byte �̻�, 40byte ����] �������ŷ���ȣ. ���� ��û �� ���� unique�� ���� �����ؾ� ��.
											//�ش� ���ÿ��� �׽�Ʈ�� ���� {������ ����ID + ��û�Ͻ�} �������� �����Ͽ���.



/*****************************************************************************************
- ������ ���� �ʼ��׸�
*****************************************************************************************/
$LOGO_YN	= "N";		//[   1byte ����] ������ �ΰ� ��� ���� (N: ������� �ΰ�-default, Y: ������ �ΰ� (������ ������𽺿� ������ �ΰ� �̹����� ����ؾ���))
$CALL_TYPE	= "P";		//[   4byte ����] ����â ȣ�� ��� (P: �˾�-default, SELF: ��������ȯ, I: ����������)



/*****************************************************************************************
- ���� �Է� �׸�
*****************************************************************************************/
$MC_AUTHPAY			= "";	//[   1byte ����] ���̺긮�� ��� ����  "Y" �� ���� (�޴��� SMS���� �� �Ϲ� ���ϸ�� ���� ������ ���) (N: �̻��-default, Y: ���)
$MC_AUTOPAY			= "";	//[   1byte ����] �ڵ������� ���� ���� �Ϲݰ��� �� "Y" ����. ���� �Ϸ� �� �޴������� ��ü�� USERKEY �߱� �� �ڵ������� AutoBillKey �߱� (N: �̻��-default, Y: ���)
$MC_PARTPAY			= "";	//[   1byte ����] �κ���Ҹ� ���� �Ϲݰ��� �� "Y" ����. ���� �Ϸ� �� �ڵ����� USERKEY �߱� (N: �̻��-default, Y: ���)
$MC_No				= "";	//[  11byte ����] ����� ����ȣ (����â ȣ��� ������ ����ȣ)
$MC_FIXNO			= "";	//[   1byte ����] ����� ����ȣ �����Ұ� ����(N: ��������-default, Y: �����Ұ�)
$MC_DEFAULTCOMMID	= "";	//[   3byte ����] ��Ż� �⺻ ���� ��. SKT, KTF, LGT 3���� �� �� ���ϴ� ��Ż� ���� �� �ش� ��Ż簡 �̸� ���õǾ���.
$MC_FIXCOMMID		= "";	//[   1byte ����] ��Ż� ���� ���� ��. SKT, KTF, LGT 3���� �� �� ���ϴ� ��Ż� ���� �� �ش� ��Ż縸 ����â�� ������.
$Payeremail			= "";	//[  30byte ����] ������ e-mail
$Userid				= "";	//[  20byte ����] ������ ������ID
$Item				= "";	//[   8byte ����] �������ڵ�. �̻�� �� �ݵ�� �������� ����.
$Prdtcd				= "";	//[  40byte ����] ��ǰ�ڵ�. �ڵ������� ��� ��ǰ�ڵ庰 SMS������ ���� ������ �� ����ϸ� ������ ������𽺿� ����� �ʿ���.
$MC_Cpcode			= "";	//[  20byte ����] ��������������key. ������ ��ü�� ��쿡�� ����.
$Notiemail			= "";	//[  30byte ����] �˸� e-mail: ���� �Ϸ� �� ���� ���������� Noti ������ ������ ��� �˶� ������ ���� ������ ����� �̸����ּ�
$Notiurl			= "";	//[ 128byte ����] ���� �Ϸ� �� ������ �� ���� ó���� ����ϴ� ������. System back������ ȣ���� �Ǹ� ����ڿ��Դ� �������� �ʴ´�.
$Closeurl			= "";	//[ 128byte ����] ����â ��ҹ�ư, �ݱ��ư Ŭ�� �� ȣ��Ǵ� ������ �� ������. iframe ȣ�� �� �ʼ�! (��: http://www.mcash.co.kr/closeurl.jsp)
$Failurl			= "";	//[ 128byte ����] ���� ���� �� ����ڿ��� ������ ������ �� ���� ������. ����ó���� ���� ����ó�� �ȳ��� ���������� �����ؾ� �� ��츸 ���.
							//                iframe ȣ�� �� �ʼ�! (��: http://www.mcash.co.kr/failurl.jsp)
$MSTR				= "";	//[2000byte ����] ������ �ݹ� ����. ���������� �߰������� �Ķ���Ͱ� �ʿ��� ��� ����ϸ� &, % �� ���Ұ� (��: MSTR="a=1|b=2|c=3")

/*****************************************************************************************
- ���¸����� ��� �Ʒ��� ������ �Է��ؾ� �մϴ�.
��ٱ��� ������ ��� ��ǥ �Ǹ��� �� n��, ��ǥ �Ǹ��� ����ó�� �Է��ϼ���.
��)	Sellernm  = "ȫ�浿�� 2��";
	Sellertel = "0212345678";
*****************************************************************************************/
$Sellernm			= "";	//[  50byte ����] ���Ǹ��� �̸� (���¸����� ��� �� �Ǹ��� ���� �ʼ�)
$Sellertel			= "";	//[  15byte ����] ���Ǹ��� ��ȭ��ȣ (���¸����� ��� �� �Ǹ��� ���� �ʼ�)



/*****************************************************************************************
- ������ ���� �����׸� (���� ����� �� �ֽ��ϴ�.)
*****************************************************************************************/
$IFRAME_NAME		= "";	//[   1byte ����] ����â�� iframe���� ȣ�� �� ��� iframe ��Ī ����
$INFOAREA_YN		= "";	//[   1byte ����] ����â �ȳ��� ǥ�ÿ��� (Y: ǥ��-default,  N: ��ǥ��)
$FOOTER_YN			= "";	//[   1byte ����] ����â �ϴ� �ȳ� ǥ�ÿ��� (Y: ǥ��-default,  N: ��ǥ��)
$HEIGHT				= "";	//[   4byte ����] ����â ���� (px����: iframe �� ���� ����â ���� ����, �˾�â �� ȣ��� "" �� ����)
$PRDT_HIDDEN		= "";	//[   1byte ����] iframe ���� ��ǰ�� ���� ���� (������ ������ ����â���� ���� �Է� ���׸� iframe���� ����)
$EMAIL_HIDDEN		= "";	//[   1byte ����] ������ e-mail �Է�â ���� ���� (N: ǥ��-default, Y: ��ǥ��)
$CONTRACT_HIDDEN	= "";	//[   1byte ����] �̿��� ���� ���� (Y: ǥ��-default,  N: ��ǥ��)



/*****************************************************************************************
- ��ȣȭ ó�� (��ȣȭ ��� ��)
Cryptstring �׸��� �ݾ׺����� ���� Ȯ�ο����� �ݵ�� �Ʒ��� ���� ���ڿ��� �����Ͽ��� �մϴ�.

��) ��ȣȭ ��Ʈ���� ���������� �����ϴ� �ŷ���ȣ�� ���� ����Ǿ� ���ǹǷ�
��ȣȭ�� �̿��� �ŷ���ȣ��  �����Ǿ� ���޵� ��� ��ȣȭ ���з� ���� ���� �Ұ�
*****************************************************************************************/
$Cryptyn		= "N";		//Y: ��ȣȭ ���, N: ��ȣȭ �̻��
$Cryptstring	= "";		//��ȣȭ ��� �� ��ȣȭ�� ��Ʈ��

if($Cryptyn == "Y") {
	$Cryptstring	= $Prdtprice.$Okurl;	//�ݾ׺���Ȯ�� (������û�ݾ� + Okurl)
	$Okurl			= cipher($Okurl, $Tradeid);
	$Failurl		= cipher($Failurl, $Tradeid);
	$Notiurl		= cipher($Notiurl, $Tradeid);
	$Prdtprice		= cipher($Prdtprice, $Tradeid);
	$Cryptstring	= cipher($Cryptstring, $Tradeid);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"/>
<title>�޴��� ���� SAMPLE PAGE</title>
<?
/*****************************************************************************************
������������ �Ʒ� js ������ �ݵ�� include �ؾ� ��.
�� ����ȯ�� ������ ������� ����ڿ� ���� ���
*****************************************************************************************/
?>
<script src="https://mup.mobilians.co.kr/js/ext/ext_inc_comm.js"></script>

<script language="javascript">
	function payRequest(){
		//�Ʒ��� ���� ext_inc_comm.js�� ����Ǿ� �ִ� �Լ��� ȣ��
		MCASH_PAYMENT(document.payForm);
	}
</script>
</head>

<body>
<form name="payForm" accept-charset="euc-kr">
<table border="1" width="100%">
<tr>
	<td align="center" colspan="6"><font size="15pt"><b>�޴��� ���� SAMPLE PAGE</b></font></td>
</tr>
<tr>
	<td colspan="3"><font color="red">&nbsp;������ �׸��� �ʼ� ��!!!</font></td>
	<td colspan="3"><font color="blue">&nbsp;�Ķ��� �׸��� ����â UI ���� �Ķ����</font></td>
</tr>
<tr>
	<td align="center"><font color="red">�������� ����</font></td>
	<td align="center"><font color="red">*CASH_GB</font></td>
	<td><input type="text" name="CASH_GB" id="CASH_GB" size="30" value="<?echo $CASH_GB;?>"></td>
	<td align="center"><font color="red">����URL</font></td>
	<td align="center"><font color="red">*Okurl</font></td>
	<td><input type="text" name="Okurl" id="Okurl" size="50" value="<?echo $Okurl;?>"></td>
</tr>
<tr>
	<td align="center"><font color="red">���񽺾��̵�</font></td>
	<td align="center"><font color="red">*MC_SVCID</font></td>
	<td><input type="text" name="MC_SVCID" id="MC_SVCID" size="30" value="<?echo $MC_SVCID;?>"></td>
	<td align="center"><font color="red">��ǰ��</font></td>
	<td align="center"><font color="red">*Prdtnm</font></td>
	<td><input type="text" name="Prdtnm" id="Prdtnm" size="30" value="<?echo $Prdtnm;?>"></td>
</tr>
<tr>
	<td align="center"><font color="red">������û�ݾ�</font></td>
	<td align="center"><font color="red">*Prdtprice</font></td>
	<td><input type="text" name="Prdtprice" id="Prdtprice" size="30" value="<?echo $Prdtprice;?>"></td>
	<td align="center"><font color="red">������������</font></td>
	<td align="center"><font color="red">*Siteurl</font></td>
	<td><input type="text" name="Siteurl" id="Siteurl" size="30" value="<?echo $Siteurl;?>"></td>
</tr>
<tr>
	<td align="center"><font color="red">�ŷ�����</font></td>
	<td align="center"><font color="red">*PAY_MODE</font></td>
	<td><input type="text" name="PAY_MODE" id="PAY_MODE" size="30" value="<?echo $PAY_MODE;?>"></td>
	<td align="center"><font color="red">�������ŷ���ȣ</font></td>
	<td align="center"><font color="red">*Tradeid</font></td>
	<td><input type="text" name="Tradeid" id="Tradeid" size="50" value="<?echo $Tradeid;?>"></td>
</tr>
<tr>
	<td align="center"><font color="red">������ �ΰ� ��뿩��</font></td>
	<td align="center"><font color="red">*LOGO_YN</font></td>
	<td><input type="text" name="LOGO_YN" id="LOGO_YN" size="30" value="<?echo $LOGO_YN;?>"></td>
	<td align="center"><font color="red">����â ȣ����</font></td>
	<td align="center"><font color="red">*CALL_TYPE</font></td>
	<td><input type="text" name="CALL_TYPE" id="CALL_TYPE" size="30" value="<?echo $CALL_TYPE;?>"></td>
</tr>
<tr>
	<td align="center">���� ������ ���(hybrid ���)</td>
	<td align="center">MC_AUTHPAY</td>
	<td><input type="text" name="MC_AUTHPAY" id="MC_AUTHPAY" size="30" value="<?echo $MC_AUTHPAY;?>"></td>
	<td align="center">����뺸 ó�� url</td>
	<td align="center">Notiurl</td>
	<td><input type="text" name="Notiurl" id="Notiurl" size="50" value="<?echo $Notiurl;?>"></td>
</tr>
<tr>
	<td align="center">�ڵ������� ���� �Ϲݰ��� ����</td>
	<td align="center">MC_AUTOPAY</td>
	<td><input type="text" name="MC_AUTOPAY" id="MC_AUTOPAY" size="30" value="<?echo $MC_AUTOPAY;?>"></td>
	<td align="center">���/�ݱ� �� �̵� url</td>
	<td align="center">Closeurl</td>
	<td><input type="text" name="Closeurl" id="Closeurl" size="50" value="<?echo $Closeurl;?>"></td>
</tr>
<tr>
	<td align="center">�κ���� ���� ����</td>
	<td align="center">MC_PARTPAY</td>
	<td><input type="text" name="MC_PARTPAY" id="MC_PARTPAY" size="30" value="<?echo $MC_PARTPAY;?>"></td>
	<td align="center">���� �� �̵� url</td>
	<td align="center">Failurl</td>
	<td><input type="text" name="Failurl" id="Failurl" size="50" value="<?echo $Failurl;?>"></td>
</tr>
<tr>
	<td align="center">���� �޴�����ȣ</td>
	<td align="center">MC_No</td>
	<td><input type="text" name="MC_No" id="MC_No" size="30" value="<?echo $MC_No;?>"></td>
	<td align="center">�޴�����ȣ �����Ұ� ����</td>
	<td align="center">MC_FIXNO</td>
	<td><input type="text" name="MC_FIXNO" id="MC_FIXNO" size="30" value="<?echo $MC_FIXNO;?>"></td>
</tr>
<tr>
	<td align="center">������ ���� ���� key</td>
	<td align="center">MC_Cpcode</td>
	<td><input type="text" name="MC_Cpcode" id="MC_Cpcode" size="30" value="<?echo $MC_Cpcode;?>"></td>
	<td align="center">����� ID</td>
	<td align="center">Userid</td>
	<td><input type="text" name="Userid" id="Userid" size="30" value="<?echo $Userid;?>"></td>
</tr>
<tr>
	<td align="center">������</td>
	<td align="center">Item</td>
	<td><input type="text" name="Item" id="Item" size="30" value="<?echo $Item;?>"></td>
	<td align="center">��ǰ�ڵ�</td>
	<td align="center">Prdtcd</td>
	<td><input type="text" name="Prdtcd" id="Prdtcd" size="30" value="<?echo $Prdtcd;?>"></td>
</tr>
<tr>
	<td align="center">������ �̸���</td>
	<td align="center">Payeremail</td>
	<td><input type="text" name="Payeremail" id="Payeremail" size="30" value="<?echo $Payeremail;?>"></td>
	<td align="center">�⺻ �����</td>
	<td align="center">MC_DEFAULTCOMMID</td>
	<td><input type="text" name="MC_DEFAULTCOMMID" id="MC_DEFAULTCOMMID" size="30" value="<?echo $MC_DEFAULTCOMMID;?>"></td>
</tr>
<tr>
	<td align="center">����� �����Ұ� ����</td>
	<td align="center">MC_FIXCOMMID</td>
	<td><input type="text" name="MC_FIXCOMMID" id="MC_FIXCOMMID" size="30" value="<?echo $MC_FIXCOMMID;?>"></td>
	<td align="center">������ �ݹ� ����</td>
	<td align="center">MSTR</td>
	<td><input type="text" name="MSTR" id="MSTR" size="50" value="<?echo $MSTR;?>"></td>
</tr>
<tr>
	<td align="center">���Ǹ��ڸ�</td>
	<td align="center">Sellernm</td>
	<td><input type="text" name="Sellernm" id="Sellernm" size="30" value="<?echo $Sellernm;?>"></td>
	<td align="center">���Ǹ��� ����ó</td>
	<td align="center">Sellertel</td>
	<td><input type="text" name="Sellertel" id="Sellertel" size="30" value="<?echo $Sellertel;?>"></td>
</tr>
<tr>
	<td align="center">Noti �˸�E-mail</td>
	<td align="center">Notiemail</td>
	<td><input type="text" name="Notiemail" id="Notiemail" size="30" value="<?echo $Notiemail;?>"></td>
	<td align="center"><font color="blue">iframe ��Ī</font></td>
	<td align="center"><font color="blue">IFRAME_NAME</font></td>
	<td><input type="text" name="IFRAME_NAME" id="IFRAME_NAME" size="30" value="<?echo $IFRAME_NAME;?>"></td>
</tr>
<tr>
	<td align="center"><font color="blue">����â �ȳ��� ǥ�� ����</font></td>
	<td align="center"><font color="blue">INFOAREA_YN</font></td>
	<td><input type="text" name="INFOAREA_YN" id="INFOAREA_YN" size="30" value="<?echo $INFOAREA_YN;?>"></td>
	<td align="center"><font color="blue">����â �ϴ� �ȳ� ǥ�� ����</font></td>
	<td align="center"><font color="blue">FOOTER_YN</font></td>
	<td><input type="text" name="FOOTER_YN" id="FOOTER_YN" size="30" value="<?echo $FOOTER_YN;?>"></td>
</tr>
<tr>
	<td align="center"><font color="blue">����â ����</font></td>
	<td align="center"><font color="blue">HEIGHT</font></td>
	<td><input type="text" name="HEIGHT" id="HEIGHT" size="30" value="<?echo $HEIGHT;?>"></td>
	<td align="center"><font color="blue">��ǰ�� ���� ����</font></td>
	<td align="center"><font color="blue">PRDT_HIDDEN</font></td>
	<td><input type="text" name="PRDT_HIDDEN" id="PRDT_HIDDEN" size="30" value="<?echo $PRDT_HIDDEN;?>"></td>
</tr>
<tr>
	<td align="center"><font color="blue">������ �̸��� ���� ����</font></td>
	<td align="center"><font color="blue">EMAIL_HIDDEN</font></td>
	<td><input type="text" name="EMAIL_HIDDEN" id="EMAIL_HIDDEN" size="30" value="<?echo $EMAIL_HIDDEN;?>"></td>
	<td align="center"><font color="blue">�̿��� ���� ����</font></td>
	<td align="center"><font color="blue">CONTRACT_HIDDEN</font></td>
	<td><input type="text" name="CONTRACT_HIDDEN" id="CONTRACT_HIDDEN" size="30" value="<?echo $CONTRACT_HIDDEN;?>"></td>
</tr>
<tr>
	<td align="center">��ȣȭ ��� ����</td>
	<td align="center">Cryptyn</td>
	<td><input type="text" name="Cryptyn" id="Cryptyn" size="30" value="<?echo $Cryptyn;?>"></td>
	<td align="center">��ȣȭ ���� ��</td>
	<td align="center">Cryptstring</td>
	<td><input type="text" name="Cryptstring" id="Cryptstring" size="50" value="<?echo $Cryptstring;?>"></td>
</tr>
<tr>
	<td align="center">�������� �ؽ� ��</td>
	<td align="center">Crypthash</td>
	<td colspan="4"><input type="text" name="Crypthash" id="Crypthash" size="50" value="<?echo $Crypthash;?>"></td>
</tr>
<tr>
	<td align="center" colspan="6">&nbsp;</td>
</tr>
<tr>
	<td align="center" colspan="6"><input type="button" value="�����ϱ�" onclick="payRequest();"></td>
</tr>
</table>
</form>
</body>
</html>
