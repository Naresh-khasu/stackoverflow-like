 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

     <!-- Sidebar Toggle (Topbar) -->
     <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
         <i class="fa fa-bars"></i>
     </button>

     <!-- Topbar Search -->
     <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST" action="{{route('search')}}">
         @csrf
         <div class="input-group">
             <input type="text" class="form-control bg-light border-0 small" placeholder="Search for questions..."
                 aria-label="Search" aria-describedby="basic-addon2" name="search">
             <div class="input-group-append">
                 <button class="btn btn-primary" type="submit">
                     <i class="fas fa-search fa-sm"></i>
                 </button>
             </div>
         </div>
     </form>

     <!-- Topbar Navbar -->
     <ul class="navbar-nav ml-auto">

         <!-- Nav Item - Search Dropdown (Visible Only XS) -->
         <li class="nav-item dropdown no-arrow d-sm-none">
             <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                 <i class="fas fa-search fa-fw"></i>
             </a>
             <!-- Dropdown - Messages -->
             <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                 aria-labelledby="searchDropdown">
                 <form class="form-inline mr-auto w-100 navbar-search">
                     <div class="input-group">
                         <input type="text" class="form-control bg-light border-0 small" placeholder="Search for questions..."
                             aria-label="Search" aria-describedby="basic-addon2">
                         <div class="input-group-append">
                             <button class="btn btn-primary" type="button">
                                 <i class="fas fa-search fa-sm"></i>
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </li>
         <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="{{route('home')}}">
                <span class="mr-2 d-lg-inline text-gray-600 small">Home</span>
            </a>

        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="{{route('question.create')}}">
                <span class="mr-2 d-lg-inline text-gray-600 small">Ask a question</span>
            </a>

        </li>
        @auth
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="{{route('question.index')}}">
                <span class="mr-2 d-lg-inline text-gray-600 small">My Questions</span>
            </a>

        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="{{route('getAcheivement')}}">
                <span class="mr-2 d-lg-inline text-gray-600 small">Achievements</span>
            </a>

        </li>
        @endauth



         <div class="topbar-divider d-none d-sm-block"></div>

         <!-- Nav Item - User Information -->
         @auth
             <li class="nav-item dropdown no-arrow">
                 <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                     <span class="mr-2 d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                 </a>
                 <!-- Dropdown - User Information -->
                 <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                         <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                         Logout
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
                 </div>
             </li>
         @else
         <li class="nav-item dropdown no-arrow">

             <a href="{{ route('login') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                 Login</a>
             <a href="{{ route('register') }}" class="d-sm-inline-block btn btn-sm btn-info shadow-sm"> Sign up</a>
            </li>

         @endauth


     </ul>

 </nav>
 <!-- End of Topbar -->
