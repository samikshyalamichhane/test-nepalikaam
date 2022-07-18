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

			Type: {{$type}}
			<br>

			Sender Name: {{$name}}
			<br>
			Customer ID: {{$customerid}}
			<br>
			Email: <a href="mailto:{{$email}}">{{$email}}</a>
			<br>
			Phone: {{$phone}}
			<br>
			<hr>
			<u>Receiver Detail</u>
			<br>
			@if($type=='Bank-Deposit')

			Account Holder Name:{{$receiver_name}}

			<br>
			Receiver Contact No:{{$receiver_contact_no}}
			<br>
			Bank Name:{{$bank_name}}
			<br>
			Bank Branch:{{$bank_branch}}
			<br>
			Account Number:{{$account_number}}
			<br>

			@elseif($type=='E-sewa')
			Esewa number : {{ $esewa_number }}
			<br>

			@else
			Full Name:{{$receiver_name}}
			<br>
			Contact No:{{$receiver_contact_no}}
			<br>
			Pick Up District:{{@$pick_up_district}}
			<br>

			@endif
			Remit Amount:{{$amount}}
			<br>
			NPR::{{$npr}} ({{ @$promo_code == 1 ? 'Promo Code applied' : 'Promo Code not applied' }})
			<br>
			<hr>
			@if($transfer_receipt)
			<u>Transaction Bill</u><br>
				@forelse ($transfer_receipt as $receipt)
				<img src="{{asset('images/main/'.$receipt->document)}}" style="width: 50%; margin-top: 10px;">
				@empty
				@endforelse
			@endif
			<hr>
			<br>


		</div>
		<!-- <div style="width: 100%; padding: 40px 0 20px 0">
			Regards
			<br>
			<p style="border-bottom: 1px solid black;">NK Service</p>
			<p> For Enquery : ..</p>
		</div> -->
	</div>
</body>

</html>