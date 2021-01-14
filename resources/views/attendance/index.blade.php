@extends('layouts.app_layout')
@section('extra-header-scripts')
        <!--DataTables [ OPTIONAL ]-->
        <link href="{{asset('plugins/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div id="content-container">
    <div id="page-head">
        
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Data Tables</h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
        <li><a href="#"><i class="demo-pli-home"></i></a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Tables</li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>

    
    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        
        <!-- Add Row -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Admins List</h3>
            </div>
        
            <div class="row">
                <!-- Student Attendence Search Area Start Here -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Student Attendence</h3>
                                </div>
                            </div>
                            <form class="new-added-form">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Select Class</label>
                                        <select name="class"  class="select2">
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $class)
                                                <option {{ request()->input('class') == $class->name ? 'selected' : '' }} value="{{$class->name}}">{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Select Month</label>
                                        <select name="month" class="select2">
                                            <option value="0">Select Month</option>
                                            <option {{ request()->input('month') == 'January' ? 'selected' : '' }}  value="January">January</option>
                                            <option {{ request()->input('month') == 'February' ? 'selected' : '' }} value="February">February</option>
                                            <option {{ request()->input('month') == 'March' ? 'selected' : '' }}    value="March">March</option>
                                            <option {{ request()->input('month') == 'April' ? 'selected' : '' }}    value="April">April</option>
                                            <option {{ request()->input('month') == 'May' ? 'selected' : '' }}      value="May">May</option>
                                            <option {{ request()->input('month') == 'June' ? 'selected' : '' }}     value="June">June</option>
                                            <option {{ request()->input('month') == 'July' ? 'selected' : '' }}     value="July">July</option>
                                            <option {{ request()->input('month') == 'August' ? 'selected' : '' }}   value="August">August</option>
                                            <option {{ request()->input('month') == 'September' ? 'selected' : '' }}value="September">September</option>
                                            <option {{ request()->input('month') == 'October' ? 'selected' : '' }}  value="October">October</option>
                                            <option {{ request()->input('month') == 'November' ? 'selected' : '' }} value="November">November</option>
                                            <option {{ request()->input('month') == 'December' ? 'selected' : '' }} value="December">December</option>
                                        </select>
                                    </div>
                                    <div class="col-12 form-group mg-t-8">
                                        <button type="submit" class="btn btn-success">Search</button>
                                        <a class="btn btn-danger" href="{{route('dashboard.attendance.index')}}">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Student Attendence Search Area End Here -->
                <!-- Student Attendence Area Start Here -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (request()->input('class') && request()->input('month'))
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Attendence Sheet Of Class {{request()->input('class')}}:{{request()->input('month')}}</h3>
                                    </div>
                                </div>

                                @if($records !== null && $records->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table bs-table table-striped table-bordered text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Students</th>
                                                    @for ($i = 1; $i <= $daysInMonth; $i++)
                                                        <th>{{$i}}</th>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $counter = 0; @endphp
                                                @foreach ($records as $key => $record)
                                                <tr>
                                                    
                                                        <td class="text-left">
                                                            @foreach ($students as $student)
                                                                @if ($student->id == $key)
                                                                    {{$student->user->fullname}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        @for ($i = 1; $i <= $daysInMonth; $i++)

                                                            <td>
                                                                @foreach ($record as $data)
                                                                @if ($data->daynumber == $i)
                                                                    @php $counter++ @endphp
                                                                    @if ($data->attendance == 1)
                                                                        <i class="fa fa-check text-success"></i>
                                                                    @else
                                                                        <i class="fa fa-times text-danger"></i>
                                                                    @endif                                                              
                                                                @endif
                                                                @endforeach
                                                                @if ($counter == 1)
                                                                    @php $counter-- @endphp
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                        @endfor                                                    
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-center">There are no available records.</p>
                                @endif

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===================================================-->
        <!-- End Add Row -->
        
        
        
    </div>
    <!--===================================================-->
    <!--End page content-->

</div>

@endsection

@section('extra-body-scripts')
    <!--DataTables [ OPTIONAL ]-->
    <script src="{{asset('plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
	<script src="{{asset('plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
	<script src="{{asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>


    <!--DataTables Sample [ SAMPLE ]-->
    <script src="{{asset('js/demo/tables-datatables.js')}}"></script>
@endsection