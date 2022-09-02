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

			Full Name:{{$name}} ({{$customerid}})
			<br>
			<u>Address</u>
			<br>
			{{$address}}
			<br>
			Suburb:{{$suberb}}
			<br>
			State:{{$state}}
			<br>
			Post Code:{{$post_code}}
			<br>

			<br>
			<br>

			Email:<a href="mailto:{{$email}}">{{$email}}</a>
			<br>
			Mobile Number:{{$phone}}

			<br>
			Customer Number:{{$customerid}}
			<br>

			ID Type:{{$idtype}}
			<br>
			<a href="{{asset('document/'.$citizenship)}}" download="">Download Id</a>
			<br>
			<img src="{{asset('document/'.$citizenship)}}" style="width: 100%">
		</div>

	</div>
</body>

</html>