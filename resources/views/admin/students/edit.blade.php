@extends('admin.layouts.app')
@section('extra-header-scripts')
        <!--DataTables [ OPTIONAL ]-->
        
    <!--Switchery [ OPTIONAL ]-->
    <link href="{{asset('plugins/switchery/switchery.min.css')}}" rel="stylesheet">


    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css')}}" rel="stylesheet">


    <!--Chosen [ OPTIONAL ]-->
    <link href="{{asset('plugins/chosen/chosen.min.css')}}" rel="stylesheet">


    <!--noUiSlider [ OPTIONAL ]-->
    <link href="{{asset('plugins/noUiSlider/nouislider.min.css')}}" rel="stylesheet">


    <!--Select2 [ OPTIONAL ]-->
    <link href="{{asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet">


    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <link href="{{asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <link href="{{asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div id="content-container">
	<div id="page-head">
		
		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow">General Elements</h1>
		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->


		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
		<li><a href="#"><i class="demo-pli-home"></i></a></li>
		<li><a href="#">Forms</a></li>
		<li class="active">General Elements</li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->

	</div>

	
	<!--Page content-->
	<!--===================================================-->
	<div id="page-content">
		

		<div class="row">
			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Edit Admin</h3>
					</div>
		
					<!--Block Styled Form -->
					<!--===================================================-->
					<form method="POST" action="{{ route('admin.admins.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">First Name</label>
										<input name="firstname" value="{{ $user->firstname ?? old('firstname') }}" type="text" class="form-control" required>
									</div>
									@error('firstname')
            	                        <span class="invalid-feedback" role="alert">
        	                                <strong>{{ $message }}</strong>
    	                                </span>
	                                @enderror

								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Last Name</label>
										<input name="lastname" value="{{ $user->lastname ?? old('lastname') }}" type="text" class="form-control" required>
									</div>
									@error('lastname')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">User Name</label>
										<input name="username" value="{{ $user->username ?? old('username') }}" type="text" class="form-control" required>
									</div>
									@error('username')
            	                        <span class="invalid-feedback" role="alert">
        	                                <strong>{{ $message }}</strong>
    	                                </span>
	                                @enderror

								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Full Name</label>
										<input name="fullname" value="{{ $user->fullname ?? old('fullname') }}" type="text" class="form-control" required>
									</div>
									@error('fullname')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Email</label>
										<input name="email" value="{{ $user->email ?? old('email') }}" type="email" class="form-control" required>
									</div>
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Another Email</label>
										<input name="other_email" value="{{ $user->other_email ?? old('other_email') }}" type="email" class="form-control" >
									</div>
									@error('other_email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Password</label>
										<input name="password" type="password" class="form-control">
										@error('password')
            		                        <span class="invalid-feedback" role="alert">
        		                                <strong>{{ $message }}</strong>
    		                                </span>
		                                @enderror

									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Confirm Password</label>
										<input name="password_confirmation" type="password" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Phone Number</label>
										<input name="phone" value="{{ $user->phone ?? old('phone') }}" type="text" class="form-control" >
									</div>
									@error('phone')
            	                        <span class="invalid-feedback" role="alert">
        	                                <strong>{{ $message }}</strong>
    	                                </span>
	                                @enderror

								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Gender</label>
										<select name="gender" class="form-control">
											<option value="male">Male</option>
											<option value="female">female</option>
										</select>
									</div>
									@error('gender')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Avatar</label>
										<input name="avatar" type="file" class="form-control">
									</div>
									@error('avatar')
            	                        <span class="invalid-feedback" role="alert">
        	                                <strong>{{ $message }}</strong>
    	                                </span>
	                                @enderror

								</div>
							</div>
							{{-- <div class="row">
								<div class="col-sm-6">
									<p class="text-main text-bold">Select Role</p>
					
									<!-- Multiple Select Choosen -->
									<!--===================================================-->
									<select id="demo-cs-multiselect" name="roles[]" data-placeholder="Choose a Country..." multiple tabindex="4" required>
										@foreach ($roles as $role)
											<option value="{{$role->id}}">{{$role->name}}</option>										
										@endforeach
									</select>

								</div>
								<div class="col-sm-6">
									<p class="text-main text-bold">Select Extra Permissions</p>
					
									<!-- Multiple Select Choosen -->
									<!--===================================================-->
									<select id="demo-cs-multiselect" name="permissions[]" data-placeholder="Choose a Country..." multiple tabindex="4">
										@foreach ($permissions as $permission)
											<option value="{{$permission->id}}">{{$permission->name}}</option>										
										@endforeach
									</select>
								</div>
							</div> --}}
							
						</div>
						<div class="panel-footer text-right">
							<button class="btn btn-success" type="submit">Submit</button>
						</div>
					</form>
					<!--===================================================-->
					<!--End Block Styled Form -->
		
				</div>
			</div>

		</div>
		
		
	</div>
	<!--===================================================-->
	<!--End page content-->

</div>
@endsection

@section('extra-body-scripts')
    <!--Switchery [ OPTIONAL ]-->
    <script src="{{asset('plugins/switchery/switchery.min.js')}}"></script>


    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>


    <!--Chosen [ OPTIONAL ]-->
    <script src="{{asset('plugins/chosen/chosen.jquery.min.js')}}"></script>


    <!--noUiSlider [ OPTIONAL ]-->
    <script src="{{asset('plugins/noUiSlider/nouislider.min.js')}}"></script>


    <!--Select2 [ OPTIONAL ]-->
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>


    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <script src="{{asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.js')}}"></script>


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <script src="{{asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>


    <!--Form Component [ SAMPLE ]-->
    <script src="{{asset('js/demo/form-component.js')}}"></script>

@endsection