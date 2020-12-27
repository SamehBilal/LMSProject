@extends('layouts.app_layout')
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
						<h3 class="panel-title">Create New Staff Member</h3>
					</div>
		
					<!--Block Styled Form -->
					<!--===================================================-->
					<form method="POST" action="{{ route('admin.teachers.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="panel-body">
							@include('manage_users.partials.createuser')

							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Course</label>
										<select name="course_id" class="form-control" required>
											@foreach ($courses as $course)
												<option value="{{$course->id}}">{{$course->title}}</option>
											@endforeach
										</select>									
									</div>
									@error('course_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
							
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Salary</label>
										<input name="salary" value="{{ old('salary') }}" type="number" class="form-control" required>
									</div>
									@error('salary')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
							
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Graduation Year</label>
										<input name="graduation_year" value="{{ old('graduation_year') }}" type="date" class="form-control" required>
									</div>
									@error('graduation_year')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
							
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">University</label>
										<input name="university" value="{{ old('university') }}" type="text" class="form-control" required>
									</div>
									@error('university')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
							
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Classes</label>
										<select name="class_id[]" class="form-control" multiple required>
											@foreach ($classes as $class)
												<option value="{{$class->id}}">{{$class->name}}</option>
											@endforeach
										</select>									
									</div>
									@error('class_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
							
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">CV</label>
										<input name="cv" value="{{ old('cv') }}" type="file" class="form-control" required>
									</div>
									@error('cv')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
							
								</div>

							</div>
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