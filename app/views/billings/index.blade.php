<?php
function appr_dtm() {
	$microtime = microtime();
	$comps = explode(" ", $microtime);
	return date("YmdHis") . sprintf("%04d", $comps[0] * 10000);
}
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>테스트 :: 결제페이지</title>
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">

	<style>
		html { height: 100%;}
		body { height: 100%; margin:0;}
		.jumbotron { padding: 20px 0;}
	</style>

    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</head>
<body>

	<div class="container" style="padding-top:30px;">
		<div class="jumbotron">
			<h1>결제하시오!</h1>
		</div>
		
		<div class="page-header">
			<h3>결제양식</h3>
		</div>
		<form name="billing_form" id="billing_form" class="form">
			<div class="form-group">
				<label for="amount">결제 금액: </label>
				<input class="form-control" type="text" name="amount" id="amount" placeholder="0 원" style="width:200px;">
			</div>
			
			<div class="form-group">
				<label class="control-label">결제방법을 선택하세요</label>
				<div>
					<label class="radio-inline">
						<input type="radio" name="pay_method" id="pay_method_1" value="mb"> 핸드폰결제
					</label>
					<label class="radio-inline">
						<input type="radio" name="pay_method" id="pay_method_2" value="cc"> 신용카드
					</label>
					<label class="radio-inline">
						<input type="radio" name="pay_method" id="pay_method_3" value="va"> 가상계좌
					</label>
					<label class="radio-inline">
						<input type="radio" name="pay_method" id="pay_method_3" value="ic"> 계좌이체
					</label>
				</div>
			</div>

			<hr>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">결제하기</button>
			</div>
		</form>

	</div>

	<!-- kg 결제 공통 -->
	<script type="text/javascript">
	function emulAcceptCharset(form) {
		if(form.canHaveHTML) {
			document.charset = form.acceptCharset;
		}
		return true;
	}

	function payRequest(type, form){
		var defCharset = document.charset;
		//아래와 같이 ext_inc_comm.js에 선언되어 있는 함수를 호출
		emulAcceptCharset(form);

		switch(type) {
			case 'cc':
				PAY_REQUEST(form);
				break;
			case 'mb':
				MCASH_PAYMENT(form);
				break;
			case 'va':
			default:
				alert('올바르지 않은 결제 방식입니다');
		}

		document.charset=defCharset;
	}

	</script>
	
	<!-- 신용카드 결제 폼 -->
	<script src="https://pg.mcash.co.kr/dlp/js/npgIF.js"></script> <!-- 필수 -->
	<script type="text/javascript">
	
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
		document.cc_billing_form.MxIssueNO.value = "TEST_"+tmp;
		document.cc_billing_form.MxIssueDate.value = tmp;
	}
	</script>
	<form name="cc_billing_form" id="cc_billing_form" accept-charset="euc-kr">
		<!-- 결제 결과의 REDIRPATH 페이지 전송을 위한 parameter 시작 (수정하지 말것) -->
		<input type="hidden" name="ReplyCode" value="">
		<input type="hidden" name="ReplyMessage" value="">
		<input type="hidden" name="CcCode" value="">
		<input type="hidden" name="Installment" value="">
		<!-- 결제 결과의 REDIRPATH 페이지 전송을 위한 parameter 끝 -->

		<input type="hidden" name="MxID" value="140800150002">
		<input type="hidden" name="MxIssueNO" value="">				<!-- 결제번호 -->
		<input type="hidden" name="MxIssueDate" value="">			<!-- 결제요청시간 -->
		<input type="hidden" name="Currency" value="KRW">
		<input type="hidden" name="CcMode" value="11">
		<input type="hidden" name="Smode" value="3001">
		<input type="hidden" name="Amount" value="">
		<input type="hidden" name="CcProdDesc" value="{{ '공연 티켓 및 관련상품' }}">	<!-- 판매 상품명 -->
		<input type="hidden" name="CcNameOnCard" value="">			<!-- 구매자 이름 -->
		<input type="hidden" name="MSTR" value="test">
		<input type="hidden" name="MSTR2" value="test2">
		<input type="hidden" name="connectionType" value="http">
		
		<!-- 가맹점 서버 URL -->
		<input type="hidden" name="URL" value="{{ $_SERVER['HTTP_HOST'] }} ">	
		<input type="hidden" name="DBPATH" value="billing/cc/dbpath">
		<input type="hidden" name="REDIRPATH" value="billing/cc/redirpath">

		<!-- 선택사항 -->
		<input type="hidden" name="Userid" value="">
	</form>


	<!-- 휴대폰 결제 폼 -->
	<script src="https://mup.mobilians.co.kr/js/ext/ext_inc_comm.js"></script>

	<form name="mb_billing_form" id="mb_billing_form" accept-charset="euc-kr">
		<input type="hidden" name="CASH_GB" value="MC">
		<input type="hidden" name="MC_SVCID" value="{{ Config::get('site.pg.mobile.service_id') }}">
		<input type="hidden" name="PAY_MODE" value="00">
		<input type="hidden" name="Prdtprice" value="">
		<input type="hidden" name="Prdtnm" value="모바일 결제 테스트 상품">
		<input type="hidden" name="Okurl" value="{{ url('billing/mobile') }}">
		<input type="hidden" name="Siteurl" value="supportmyshow.net"><!-- 20 bytes 이하만 가능 -->
		<input type="hidden" name="Tradeid" value="{{  Config::get('site.pg.mobile.service_id') . '_' . appr_dtm() }}">
		<input type="hidden" name="LOGO_YN" value="N">
		<input type="hidden" name="CALL_TYPE" value="P">
	</form>

	<!-- custom script -->
	<script type="text/javascript">

	$(document).ready(function() {
		// 초기 신용카드 정보 셋팅
		initValue();

		$("#billing_form").on('submit', function(e) {
			e.preventDefault();
			var pay_method = $("input[name=pay_method]:checked").val();
			console.log(pay_method);
			if(pay_method == undefined)
				return false;

			var form;
			var	amount = $("#amount").val();

			// 휴대폰결제 양식
			if(pay_method == 'mb') {
				form = document.mb_billing_form;
				$("input[name=Prdtprice]", form).val(amount);
			} 

			// 신용카드
			else if(pay_method == 'cc') {
				form = document.cc_billing_form;
				$("input[name=Amount]", form).val(amount);
				$("input[name=CcNameOnCard]", form).val('testjang');
			} 
			else {
				alert('정의되지 않은 결제 방법입니다');
			}

			var allowed_methods = ['mb', 'cc', 'va', 'ic'];
			if($.inArray(pay_method, allowed_methods) < 0) {
				alert('error!');
			} else {
				payRequest(pay_method, form);
			}
		})
	});

	</script>
</body>
</html>
