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
                <h3 class="panel-title">Deleted Teachers List</h3>
            </div>
        
            <div id="demo-custom-toolbar2" class="table-toolbar-left">
                {{-- <button id="demo-dt-addrow-btn" onclick="location.href='" class="btn btn-primary"><i class="demo-pli-plus"></i> Add Admin</button> --}}
                <a class="btn btn-primary" href="{{route('admin.teachers.create')}}"><i class="demo-pli-plus"></i> Add Teacher</a>
            </div>
        
            <div class="panel-body">
                <table id="demo-dt-addrow" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>classes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{$item->fullname}}</td>
                                <td>{{$item->staff->position}}</td>
                                <td>{{number_format($item->staff->salary, 2)}} $</td>
                                <td>
                                    
                                </td>
                                <td>
                                    <form id="delete_form3" action="{{route('admin.restore', $item->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-icon demo-pli-pencil icon-lg add-tooltip demo-bootbox-confirm"></button>
                                    </form>
                                    <form id="delete_form3" action="{{route('admin.forcedelete', $item->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-icon demo-pli-trash icon-lg add-tooltip demo-bootbox-confirm"></button>
                                    </form>


                                </td>
                            </tr>                            
                        @endforeach

                    </tbody>
                </table>
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