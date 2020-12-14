<!DOCTYPE html>
<html lang="en">
<head>
	<title>Laravel Zoom</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
<link rel="icon" type="image/png" href="{{asset('public/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/meetingList.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Date</th>
                                <th class="column2">Meeting Id</th>
                                <th class="column3">Topic</th>
                                <th class="column4" style="text-align: center !important">Duration</th>
                                <th class="column6">Action</th>
							</tr>
						</thead>
						<tbody>
                                @foreach ($meetings as $item)
                                <tr>
                                    <td class="column1">{{$item->start_time}}</td>
                                    <td class="column2">{{$item->id}}</td>
                                    <td class="column3">{{$item->topic}}</td>
                                    <td class="column4" style="text-align: center !important">{{$item->duration}}</td>
                                    <td class="column6">
                                        <div>
                                            <a href="/meeting?nickname={{$user->name}}&meetingId={{$item->id}}&password={{substr($item->join_url, strpos($item->join_url, '=') + 1)}}&role={{$user->role}}" target="_blank">Join</a>
											@if ($user->role == 1)
											/
											<a style="color: rgb(206, 114, 114) !important" href="/delete/{{$item->id}}">Delete</a>
											@endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>