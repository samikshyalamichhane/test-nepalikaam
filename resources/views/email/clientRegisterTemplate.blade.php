<!DOCTYPE html>
<html>

<head>
	<title>Account Registration successful message</title>
	<link
		href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
		rel="stylesheet">
	<style>
		body {
			font-family: 'Open Sans', sans-serif;
		}

		p {
			font-size: 17px;
			padding: 0;
			margin: 0;
		}
	</style>
</head>

<body>
	<div
		style="max-width: 500px; margin: 0 auto;font-size: 18px; border:2px solid #0a5c7e; padding: 15px; border-radius: 10px;">
		<div class="logo" style="margin-bottom: 40px; background: #0a5c7e; text-align: center; ">
			<img src="{{asset('/front/img/logo.png')}}" alt="NK Service Logo" style="max-width: 70px;">
		</div>
		<div class="header" style="padding: 15px;">

			<p>THANK YOU FOR JOINING US:</p>
			<p>
				<strong>YOUR CUSTOMER NUMBER IS :</strong> {{$customerid}}
			</p>
			<p>
				PLEASE NOTE YOUR CUSTOMER NUMBER FOR YOUR FURTHER TRANSACTION.
			</p>
			{!! $dashboard_composer->registerTemplate !!}

		</div>
</body>

</html>

{{-- <p>
	For daily rate update Please visit our website <a href="{{route('home')}}"
target="_blank">www.nepalikaam.com</a> -
</p>
<p style="padding-top: 40px; border-bottom: 2px solid black;">
	REMEMBER US FOR:
</p>
<p>
	-MONEY TRANSFER
</p>
<p>
	-AIRTICKETING
</p>
<p>
	-EDUCATION CONSULTING
</p>
<p>
	-TAX RETURN
</p>
</div>
<div style="width: 100%; padding: 40px 0 20px 0">
	Regards
	<br>
	<p style="border-bottom: 1px solid black;">NK Service</p>
	<p> For Enquery : ..</p>
</div> --}}