<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <link href="assets3/css/style.css" rel="stylesheet">
            <link href="/css2/script.css" rel="stylesheet">
               <!-- Sidebar scroll-->
               <div class="scroll-sidebar">
                   <!-- Sidebar navigation-->
                   <nav class="sidebar-nav">
                       <ul id="sidebarnav">
                           <!-- User Profile-->
                           <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                   href="" aria-expanded="false"><i class="me-3 far fa-clock fa-fw"
                                       aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>
                           <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                   href="" aria-expanded="false">
                                   <i class="me-3 fa fa-user" aria-hidden="true"></i><span
                                       class="hide-menu">Profile</span></a>
                           </li>
                           <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                   href="" aria-expanded="false"><i class="me-3 fas fa-calendar"
                                       aria-hidden="true"></i><span class="hide-menu">Agenda</span></a>
                                   </li>
                           <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                   href="" aria-expanded="false"><i class="me-3 fas fa-calendar-alt"
                                       aria-hidden="true"></i><span class="hide-menu">Upacara</span></a>
                                   </li>
   
   
                           <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link"
                                   aria-expanded="false"><i class="me-3 fas fa-sign-out-alt"
                                       aria-hidden="true"></i><span class="hide-menu">
                                       <form action="" method="post">
                                           @csrf
                                           <button type="submit" class="logOut" >Log Out</button>
                                       </form>
                                       </span></a>
                                   </li>
                           {{-- <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link bg-info"
                                   href="{{ route('upacara-user') }}" aria-expanded="false"><i class="me-3 fas fa-sign-out-alt" style="color:cornsilk"
                                       aria-hidden="true"></i><span class="hide-menu" style="color:cornsilk">Log Out</span></a>
                                   </li> --}}
                       </ul>
   
                   </nav>
                   <!-- End Sidebar navigation -->
               </div>
               <!-- End Sidebar scroll-->
           </aside>
           <!-- ============================================================== -->
           <!-- End Left Sidebar - style you can find in sidebar.scss  -->
           <!-- ============================================================== -->
   