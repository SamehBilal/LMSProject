<nav id="mainnav-container">
    <div id="mainnav">


        <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
        <!--It will only appear on small screen devices.-->
        <!--================================
        <div class="mainnav-brand">
            <a href="index.html" class="brand">
                <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
                <span class="brand-text">Nifty</span>
            </a>
            <a href="#" class="mainnav-toggle"><i class="pci-cross pci-circle icon-lg"></i></a>
        </div>
        -->



        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <!--Profile Widget-->
                    <!--================================-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <img class="img-circle img-md" src="{{asset('img/profile-photos/1.png')}}" alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                <span class="pull-right dropdown-toggle">
                                    <i class="dropdown-caret"></i>
                                </span>
                                <p class="mnp-name">Aaron Chavez</p>
                                <span class="mnp-desc">aaron.cha@themeon.net</span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-gear icon-lg icon-fw"></i> Settings
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-information icon-lg icon-fw"></i> Help
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                            </a>
                        </div>
                    </div>


                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut" class="hidden">
                        <ul class="list-unstyled shortcut-wrap">
                            <li class="col-xs-3" data-content="My Profile">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                    <i class="demo-pli-male"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Messages">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                    <i class="demo-pli-speech-bubble-3"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Activity">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                    <i class="demo-pli-thunder"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Lock Screen">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                    <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->


                    <ul id="mainnav-menu" class="list-group">
            
                        <!--Category name-->
                        <li class="list-header">Navigation</li>
            
                        <!--Menu list item-->
                        <li class="active-sub">
                            <a href="#">
                                <i class="demo-pli-home"></i>
                                <span class="menu-title">Dashboard</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse in">
                                <li class="active-link"><a href="index.html">Dashboard 1</a></li>                                
                            </ul>
                        </li>
                        @hasanyrole('Super Admin|admin')
                        <li>
                            <a href="#">
                                <i class="demo-pli-split-vertical-2"></i>
                                <span class="menu-title">Roles And Permissions</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="{{route('dashboard.roles.index')}}">Roles</a></li>
                                <li><a href="{{route('dashboard.permissions.index')}}">Permissions</a></li>
                            </ul>
                        </li>                        
                        @endhasanyrole
                        <!--Menu list item-->

            
                        <!--Menu list item-->
                        {{-- <li>
                            <a href="widgets.html">
                                <i class="demo-pli-gear"></i>
                                <span class="menu-title">
                                    Widgets
                                    <span class="pull-right badge badge-warning">24</span>
                                </span>
                            </a>
                        </li> --}}
            
                        <li class="list-divider"></li>
                        @hasanyrole('Super Admin|admin')
                            <!--Category name-->
                            <li class="list-header">Users</li>
                
                            <!--Menu list item-->
                            <li>
                                <a href="#">
                                    <i class="demo-pli-boot-2"></i>
                                    <span class="menu-title">Students</span>
                                    <i class="arrow"></i>
                                </a>
                
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="{{route('dashboard.students.index')}}">All Students</a></li>
                                    <li><a href="{{route('dashboard.students.deleted')}}">Deleted Students</a></li>                                  

                                    
                                </ul>
                            </li>
                
                            <!--Menu list item-->
                            <li>
                                <a href="#">
                                    <i class="demo-pli-pen-5"></i>
                                    <span class="menu-title">Parents</span>
                                    <i class="arrow"></i>
                                </a>
                
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="{{route('dashboard.parents.index')}}">All Parents</a></li>
                                    <li><a href="{{route('dashboard.parents.deleted')}}">Deleted Parents</a></li>                                  
                                    
                                </ul>
                            </li>
                
                            <!--Menu list item-->
                            <li>
                                <a href="#">
                                    <i class="demo-pli-receipt-4"></i>
                                    <span class="menu-title">Teachers</span>
                                    <i class="arrow"></i>
                                </a>
                
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="{{route('dashboard.teachers.index')}}">All Teachers</a></li>
                                    <li><a href="{{route('dashboard.teachers.deleted')}}">Deleted Teachers</a></li>                                  

                                </ul>
                            </li>
                
                            <!--Menu list item-->
                            <li>
                                <a href="#">
                                    <i class="demo-pli-bar-chart"></i>
                                    <span class="menu-title">Staff</span>
                                    <i class="arrow"></i>
                                </a>
                
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="{{route('dashboard.staff.index')}}">All Staff</a></li> 
                                    <li><a href="{{route('dashboard.staff.deleted')}}">Deleted Staff</a></li>                                  
                                
                                </ul>
                            </li>
                
                            <!--Menu list item-->
                            <li>
                                <a href="#">
                                    <i class="demo-pli-repair"></i>
                                    <span class="menu-title">Admins</span>
                                    <i class="arrow"></i>
                                </a>
                
                                <!--Submenu-->
                                <ul class="collapse">
                                    <li><a href="{{route('dashboard.admins.index')}}">All Admins</a></li>
                                    <li><a href="{{route('dashboard.admins.deleted')}}">Deleted Admins</a></li>                                  
                                </ul>
                            </li>      
                            <li class="list-divider"></li>

                        @endhasanyrole
      
                        @hasanyrole('Super Admin|admin')

                        <!--Category name-->
                        <li class="list-header">School Structure</li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-computer-secure"></i>
                                <span class="menu-title">Stages</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="{{route('dashboard.stages.index')}}">Manage Stages</a></li>                                
                            </ul>
                        </li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-speech-bubble-5"></i>
                                <span class="menu-title">Classes</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="{{route('dashboard.classes.index')}}">Manage Classes</a></li>
                                
                            </ul>
                        </li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-mail"></i>
                                <span class="menu-title">Courses</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="{{route('dashboard.courses.index')}}">Manage Courses</a></li>
                                
                            </ul>
                        </li>

                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-mail"></i>
                                <span class="menu-title">Attendance</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="{{route('dashboard.attendance.index')}}">Students Attendance</a></li>
                                {{-- <li><a href="{{route('admin.attendance.index')}}">Staff Attendance</a></li> --}}
                                {{-- <li><a href="{{route('admin.attendance.create')}}">Take Attendance</a></li> --}}
                            </ul>
                        </li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-file-html"></i>
                                <span class="menu-title">Other Pages</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="pages-blank.html">Blank Page</a></li>
                                <li><a href="pages-invoice.html">Invoice</a></li>
                                <li><a href="pages-search-results.html">Search Results</a></li>
                                <li><a href="pages-faq.html">FAQ</a></li>
                                <li><a href="pages-pricing.html">Pricing<span class="label label-success pull-right">New</span></a></li>
                                <li class="list-divider"></li>
                                <li><a href="pages-404-alt.html">Error 404 alt</a></li>
                                <li><a href="pages-500-alt.html">Error 500 alt</a></li>
                                <li class="list-divider"></li>
                                <li><a href="pages-404.html">Error 404 </a></li>
                                <li><a href="pages-500.html">Error 500</a></li>
                                <li><a href="pages-maintenance.html">Maintenance</a></li>
                                <li><a href="pages-login.html">Login</a></li>
                                <li><a href="pages-register.html">Register</a></li>
                                <li><a href="pages-password-reminder.html">Password Reminder</a></li>
                                <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                                
                            </ul>
                        </li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-photo-2"></i>
                                <span class="menu-title">Gallery</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="gallery-columns.html">Columns</a></li>
                                <li><a href="gallery-justified.html">Justified</a></li>
                                <li><a href="gallery-nested.html">Nested</a></li>
                                <li><a href="gallery-grid.html">Grid</a></li>
                                <li><a href="gallery-carousel.html">Carousel</a></li>
                                <li class="list-divider"></li>
                                <li><a href="gallery-slider.html">Slider</a></li>
                                <li><a href="gallery-default-theme.html">Default Theme</a></li>
                                <li><a href="gallery-compact-theme.html">Compact Theme</a></li>
                                <li><a href="gallery-grid-theme.html">Grid Theme</a></li>
                                
                            </ul>
                        </li>


                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-tactic"></i>
                                <span class="menu-title">Menu Level</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="#">Second Level Item</a></li>
                                <li><a href="#">Second Level Item</a></li>
                                <li><a href="#">Second Level Item</a></li>
                                <li class="list-divider"></li>
                                <li>
                                    <a href="#">Third Level<i class="arrow"></i></a>

                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="#">Third Level Item</a></li>
                                        <li><a href="#">Third Level Item</a></li>
                                        <li><a href="#">Third Level Item</a></li>
                                        <li><a href="#">Third Level Item</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Third Level<i class="arrow"></i></a>

                                    <!--Submenu-->
                                    <ul class="collapse">
                                        <li><a href="#">Third Level Item</a></li>
                                        <li><a href="#">Third Level Item</a></li>
                                        <li class="list-divider"></li>
                                        <li><a href="#">Third Level Item</a></li>
                                        <li><a href="#">Third Level Item</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
            
                        <li class="list-divider"></li>
            
                        <!--Category name-->
                        <li class="list-header">Extras</li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-happy"></i>
                                <span class="menu-title">Icons Pack</span>
                                <i class="arrow"></i>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="icons-ionicons.html">Ion Icons</a></li>
                                <li><a href="icons-themify.html">Themify</a></li>
                                <li><a href="icons-font-awesome.html">Font Awesome</a></li>
                                <li><a href="icons-flagicons.html">Flag Icon CSS</a></li>
                                <li><a href="icons-weather-icons.html">Weather Icons</a></li>
                                
                            </ul>
                        </li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="#">
                                <i class="demo-pli-medal-2"></i>
                                <span class="menu-title">
                                    PREMIUM ICONS
                                    <span class="label label-danger pull-right">BEST</span>
                                </span>
                            </a>
            
                            <!--Submenu-->
                            <ul class="collapse">
                                <li><a href="premium-line-icons.html">Line Icons Pack</a></li>
                                <li><a href="premium-solid-icons.html">Solid Icons Pack</a></li>
                                
                            </ul>
                        </li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="helper-classes.html">
                                <i class="demo-pli-inbox-full"></i>
                                <span class="menu-title">Helper Classes</span>
                            </a>
                        </li>                                </ul>


                    <!--Widget-->
                    <!--================================-->
                    <div class="mainnav-widget">

                        <!-- Show the button on collapsed navigation -->
                        <div class="show-small">
                            <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                <i class="demo-pli-monitor-2"></i>
                            </a>
                        </div>

                        <!-- Hide the content on collapsed navigation -->
                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                            <ul class="list-group">
                                <li class="list-header pad-no mar-ver">Server Status</li>
                                <li class="mar-btm">
                                    <span class="label label-primary pull-right">15%</span>
                                    <p>CPU Usage</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-primary" style="width: 15%;">
                                            <span class="sr-only">15%</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="mar-btm">
                                    <span class="label label-purple pull-right">75%</span>
                                    <p>Bandwidth</p>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar progress-bar-purple" style="width: 75%;">
                                            <span class="sr-only">75%</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="pad-ver"><a href="#" class="btn btn-success btn-bock">View Details</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End widget-->

                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
