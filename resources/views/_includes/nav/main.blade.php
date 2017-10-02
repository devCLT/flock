        
       <nav class="nav has-shadow">
            <div class="container">
                <div class="nav-left">
                    <a class="nav-item" href="{{route('home')}}">
                        <img src="{{asset('images/logo.png')}}" alt="Flock " />
                    </a>
                    <a href="#" class="nav-item is-tab is-hidden-mobile">Learn</a>
                    <a href="#" class="nav-item is-tab is-hidden-mobile">Discuss</a>
                    <a href="#" class="nav-item is-tab is-hidden-mobile">Share</a>
                </div> 

                <div class="nav-right" style="overflow: visible;">
                    @if (Auth::guest())
                    <a href="{{route('login')}}" class="nav-item is-tab">Login</a>
                    <a href="{{route('register')}}" class="nav-item is-tab">Join</a>
                    @else
                    <button class="dropdown is-aligned-right nav-item is-tab">
                        Hey {{Auth::user()->name}} <span class="icon"><i class="fa fa-caret-down"></i></span>

                        <ul class="dropdown-menu">
                            <li><a href="#">
                            <span class="icon"><i class="fa fa-fw m-r-10 fa-user-circle-o"></i></span>  Profile</a></li>
                            <li><a href="#">
                            <span class="icon"><i class="fa fa-fw m-r-10 fa-bell"></i></span>Notifications</a></li>
                            <li><a href="{{route('manage.dashboard')}}">
                            <span class="icon"><i class="fa fa-fw m-r-10 fa-cog"></i></span>Manage</a></li>
                            <li class="separator"></li>
                            
                            <!-- How to force a POST route which button clicked -->
                            <li><a href="{{route('logout')}}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                              <span class="icon">
                                <i class="fa fa-fw fa-sign-out m-r-10"></i>
                              </span>
                              Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                            </form>
                        </li>                            
                        </ul>
                    </button>
                    @endif
                </div>

            </div>
       </nav>

