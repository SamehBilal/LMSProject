<!DOCTYPE html>
<html lang="en">
<head>
	<title>Laravel Zoom</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://source.zoom.us/1.7.9/lib/vendor/jquery.min.js"></script>
</head>
<body>
    <div id="app"></div>
    <p style="display: none" id="zk">{{env('ZOOM_CLIENT_KEY')}}{{env('ZOOM_CLIENT_SECRET')}}</p>
    <script src="{{asset('js/app2.js') }}" type="text/javascript"></script>
</body>
</html>