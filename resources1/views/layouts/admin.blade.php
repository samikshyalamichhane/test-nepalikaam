<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.4/datepicker.css" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/AdminLTE.css')}}">
   <link rel="stylesheet" href="{{asset('backend/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/datepicker/datepicker3.css')}}">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/skins/_all-skins.min.css')}}">

  <link rel="stylesheet" href="{{asset('js/jquery.Jcrop.min.css')}}">


  <style type="text/css">
    .modal-dialog {
      position: relative;
      display: table; //This is important
      overflow-y: auto;
      overflow-x: auto;
      min-width: 300px;
    }

    .jcrop-keymgr {
      opacity: 0 !important;
    }

    button {
      background: none;
      border: none;
      padding: 0;
      margin: 0;
    }
     #example1_wrapper {
      overflow-x: auto;
    }
  </style>
  @stack('styles')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->

  <div class="wrapper">
    <?php
$user_access = explode(",", Auth::user()->access_level);
$route = Request::route()->getName();
$role = Auth::user()->role;
$flag = Auth::user()->flag;

?>

    <header class="main-header">
      <!-- Logo -->
      <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>N</b>K</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>NK</b>Services</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">

          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <!-- Notifications: style can be found in dropdown.less -->
            <!-- Tasks: style can be found in dropdown.less -->
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="">My Account</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <p>
                    Nk Services
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{asset('front/img/logo.png')}}" alt="User Image" style="max-width: 120px;">
          </div>

        </div>
        <?php
$transaction = \App\Models\Transaction::where('new', 0)->get();
$users = \App\User::where('new', 1)->where('role', 'client')->get();

?>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
           <li><a href="{{route('change-rate')}}">
              <i class="fa fa-dollar"></i> <span>Exchange Rate</span>
               <!--<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>-->
            </a>
            </li>
            <li class="treeview">
            <a href="{{route('dashboard.index')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <!--  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> -->
            </a>

            @if($role=="admin" || ($role=="editor" && (in_array("slider",$user_access))))
          <li class="treeview ">
            <a href="#">
              <i class="fa fa-sliders"></i> <span>Slider</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="{{route('slider.create')}}"><i class="fa fa-circle-o text-yellow"></i> Add
                  Slider</a></li>
              <li class=""><a href="{{route('slider.index')}}"><i class="fa fa-circle-o text-aqua"></i> All Sliders</a>
              </li>
            </ul>
          </li>
          @endif

          @if($role=="admin" || ($role=="editor" && (in_array("popupad",$user_access))))
          <li class="treeview ">
            <a href="#">
              <i class="fa fa-sliders"></i> <span>Popup</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="{{route('popupad.create')}}"><i class="fa fa-circle-o text-yellow"></i> Add
                  popupad</a></li>
              <li class=""><a href="{{route('popupad.index')}}"><i class="fa fa-circle-o text-aqua"></i> All popupad</a>
              </li>
            </ul>
          </li>
          @endif


          <!--<li class="treeview ">-->
          <!--  <a href="#">-->
          <!--    <i class="fa fa-sliders"></i> <span>Page</span>-->
          <!--    <span class="pull-right-container">-->
          <!--      <i class="fa fa-angle-left pull-right"></i>-->
          <!--    </span>-->
          <!--  </a>-->
          <!--  <ul class="treeview-menu">-->

          <!--    <li class=""><a href=""><i class="fa fa-circle-o text-aqua"></i> All Pages</a></li>-->
          <!--  </ul>-->
          <!--</li>-->
          @if($role=="admin" || ($role=="editor" && (in_array("service",$user_access))))
          <li class="treeview ">
            <a href="#">
              <i class="fa fa-sliders"></i> <span>Service</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <!-- <li class=""><a href="{{route('service.create')}}"><i class="fa fa-circle-o text-yellow"></i> Add Service</a></li> -->
              <li class=""><a href="{{route('service.index')}}"><i class="fa fa-circle-o text-aqua"></i> All
                  Services</a></li>
            </ul>
          </li>
          @endif
          @if($role=="admin" || ($role=="editor" && (in_array("testimonial",$user_access))))
          <li class="treeview ">
            <a href="#">
              <i class="fa fa-sliders"></i> <span>Testimonial</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="{{route('testimonial.create')}}"><i class="fa fa-circle-o text-yellow"></i> Add
                  Testimonial</a></li>
              <li class=""><a href="{{route('testimonial.index')}}"><i class="fa fa-circle-o text-aqua"></i> All
                  Testimoials</a></li>
            </ul>
          </li>
          @endif
          @if($role=="admin" || ($role=="editor" && (in_array("transaction",$user_access))))
          <li class="treeview ">
            <a href="#">
              <i class="fa fa-sliders"></i> <span>Transaction</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                @if(count($transaction)>0)
                <small class="label pull-right bg-red">{{count($transaction)}}</small>
                @endif

              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="{{route('transaction.create')}}"><i class="fa fa-circle-o text-yellow"></i>Add
                  Transaction</a></li>
              <li class=""><a href="{{route('transaction.index')}}"><i
                    class="fa fa-circle-o text-yellow"></i>Transaction List</a></li>
              <li class=""><a href="{{route('dailyTransaction')}}"><i class="fa fa-circle-o text-yellow"></i>Daily
                  Transaction List</a></li>
              <li class=""><a href="{{route('completedTransactionReport')}}"><i class="fa fa-circle-o text-yellow"></i>General Report</a></li>

            </ul>
          </li>
          @endif
          @if($role=="admin" || ($role=="editor" && (in_array("customer",$user_access))))
          <li class="treeview ">
            <a href="#">
              <i class="fa fa-sliders"></i> <span>Customer</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <!--@if(count($users)>0)-->
                <!--<small class="label pull-right bg-red">{{count($users)}}</small>-->
                <!--@endif-->
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="{{route('customerAdd')}}"><i class="fa fa-circle-o text-yellow"></i>Add Customer</a>
              </li>
              <li class=""><a href="{{route('customer.index')}}"><i class="fa fa-circle-o text-yellow"></i>Pending
                  List</a></li>
              <li class=""><a href="{{route('approvedCustomer')}}"><i class="fa fa-circle-o text-yellow"></i>Approved
                  List</a></li>
              <li class=""><a href="{{route('rejectedCustomer')}}"><i class="fa fa-circle-o text-yellow"></i>Rejected
                  List</a></li>
              <!-- <li class=""><a href=""><i class="fa fa-circle-o text-aqua"></i>Approved List</a></li> -->
            </ul>
          </li>
          @endif
          @if($role=="admin" || ($role=="editor" && (in_array("user",$user_access))))
          <li class="treeview ">
            <a href="#">
              <i class="fa fa-sliders"></i> <span>User</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="{{route('user.create')}}"><i class="fa fa-circle-o text-yellow"></i> Add User</a>
              </li>
              <li class=""><a href="{{route('user.index')}}"><i class="fa fa-circle-o text-aqua"></i> All Users</a></li>
            </ul>
          </li>
          @endif

        @if($role=="admin" || ($role=="editor" && (in_array("promocode",$user_access))))
          <li class="treeview ">
            <a href="#">
              <i class="fa fa-sliders"></i> <span>Promo code</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="{{route('promocode.index')}}"><i class="fa fa-circle-o text-yellow"></i>All lists</a>
              </li>
              <li class=""><a href="{{route('promocode.create')}}"><i class="fa fa-circle-o text-yellow"></i>Add New</a>
              </li>
            </ul>
          </li>
        @endif












        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->


      <!-- Main content -->
      @yield('content')

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">

      </div>
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://almsaeedstudio.com">Nk Service</a>.</strong> All
      rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <!--  -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

  </div>
  <!-- ./wrapper -->

  <!-- jQuery 2.2.3 -->
  <script src="{{asset('backend/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('backend/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('backend/plugins/fastclick/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('backend/dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->

  <script src="{{asset('backend/dist/js/demo.js')}}"></script>
  @stack('script')
</body>

</html>