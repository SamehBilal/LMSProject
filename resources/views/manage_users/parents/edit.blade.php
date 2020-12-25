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
						<h3 class="panel-title">Edit Parent</h3>
					</div>
		
					<!--Block Styled Form -->
					<!--===================================================-->
					<form method="POST" action="{{ route('admin.parents.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
						<div class="panel-body">
							@include('manage_users.partials.edituser')		
							<div class="row">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="control-label">Students</label>
											<select name="students[]" multiple class="form-control" required>
												@foreach ($students as $student)
														<option
														@foreach ($user->parentTo as $parent)
														 @if ($parent->student_id  == $student->id)selected 
														 @endif
														 @endforeach
														value="{{$student->id}}">
														 {{$student->username}}
														</option>
													
												@endforeach
											</select>									
										</div>
										@error('students')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
								
									</div>
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