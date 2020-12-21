<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard | Nifty - Admin Template</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{asset('css/nifty.min.css')}}" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{asset('css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">


    <!--=================================================-->



    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{asset('plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/pace/pace.min.js')}}"></script>


    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{asset('css/demo/nifty-demo.min.css')}}" rel="stylesheet">

    @yield('extra-header-scripts')
            
    <!--=================================================

    REQUIRED
    You must include this in your project.


    RECOMMENDED
    This category must be included but you may modify which plugins or components which should be included in your project.


    OPTIONAL
    Optional plugins. You may choose whether to include it in your project or not.


    DEMONSTRATION
    This is to be removed, used for demonstration purposes only. This category must not be included in your project.


    SAMPLE
    Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


    Detailed information and more samples can be found in the document.

    =================================================-->
        
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <!--NAVBAR-->
        <!--===================================================-->
		@include('admin.components.upperNavbar')
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            @yield('content')
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
            <!--ASIDE-->
			@include('admin.components.aside')
            <!--END ASIDE-->

            
            <!--MAIN NAVIGATION-->
			<!--===================================================-->
			@include('admin.components.sideNavbar')
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
		@include('admin.components.footer')
		<!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->


    
    
    
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="{{asset('js/jquery.min.js')}}"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="{{asset('js/nifty.min.js')}}"></script>




    <!--=================================================-->
    
    <!--Demo script [ DEMONSTRATION ]-->
    <script src="{{asset('js/demo/nifty-demo.min.js')}}"></script>

    
    <!--Flot Chart [ OPTIONAL ]-->
    <script src="{{asset('plugins/flot-charts/jquery.flot.min.js')}}"></script>
	<script src="{{asset('plugins/flot-charts/jquery.flot.resize.min.js')}}"></script>
	<script src="{{asset('plugins/flot-charts/jquery.flot.tooltip.min.js')}}"></script>


    <!--Sparkline [ OPTIONAL ]-->
    <script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>


    <!--Specify page [ SAMPLE ]-->
    <script src="{{asset('js/demo/dashboard.js')}}"></script>

    @yield('extra-body-scripts')
    

</body>
</html>
