<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
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
				<input class="form-control" type="text" name="amount">
			</div>
			<div class="form-group">
				<label class="control-label">결제방법을 선택하세요</label>
				<div>
					<label class="radio-inline">
						<input type="radio" name="pay_method" id="pay_method_1" value="1"> 핸드폰결제
					</label>
					<label class="radio-inline">
						<input type="radio" name="pay_method" id="pay_method_2" value="2"> 신용카드
					</label>
					<label class="radio-inline">
						<input type="radio" name="pay_method" id="pay_method_3" value="3"> 가상계좌
					</label>
				</div>
			</div>

			<hr>
			<div class="form-group">
				<button class="btn btn-primary">결제하기</button>
			</div>
		</form>

	</div>
	
	<!-- custom script -->
	<script type="text/javascript">
	</script>
</body>
</html>
