<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <title>Title</title>
	    <link rel="stylesheet" href="css/style.css">
	    <link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	</head>
	<body>
	
		<div id="nav-holder">
		    <div class="nav">
		        <a href="{{ url('/') }}" class="nav-item" id="jumpy">
		            <div > </div>
		            <p>Home</p>
		        </a>
		        <a href="{{ url('/shop') }}" class="nav-item" id="shop">
		            <div></div>
		            <p>Shop</p>
		        </a>
		        <a href="{{ url('/game') }}" class="nav-item" id="play">
		            <div></div>
		            <p>Play</p>
		        </a>
		        
		        @if(Auth::guest())
			        <a href="{{ url('/login') }}" class="nav-item" id="login">
			            <div></div>
			            <p>Login</p>
			        </a>
			        <a href="{{ url('/register') }}" class="nav-item" id="register">
			            <div></div>
			            <p>Register</p>
			        </a>
			   	@else
			   		<a href="{{ url('/profile') }}" class="nav-item" id="profile">
			            <div></div>
			            <p>{{ Auth::user()->username }}</p>
			        </a>
			        <a href="{{ url('/logout') }}" class="nav-item" id="logout">
			            <div></div>
			            <p>Logout</p>
			        </a>
			  	@endif
		    </div>
		</div>
	
		@yield('content')
		
		<div id="footer">
		    <div class="nav">
		        <a href="" class="nav-item footer-item" id="facebook">
		            <p>Facebook</p>
		            <div >
		            </div>
		        </a>
		        <a href="" class="nav-item footer-item" id="twitter">
		            <p>Twitter</p>
		            <div></div>
		        </a>
		        <a href="" class="nav-item footer-item" id="google">
		            <p>Google+</p>
		            <div></div>
		        </a>
		        <a href="" class="nav-item footer-item" id="instagram">
		            <p>Instagram</p>
		            <div></div>
		        </a>
		        <a href="" class="nav-item footer-item" id="about-us">
		            <p>About us</p>
		            <div></div>
		        </a>
		    </div>
		</div>

<<<<<<< HEAD
    <title>Jumpy</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>


    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Jumpy
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a style="color:#FFF" href="{{ url('/game') }}">Play</a></li>
                    <li><a href="{{ url('/shop') }}">Shop</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>

                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>

                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
=======
	
	</body>
</html>
>>>>>>> fa6d2ccd6280d64e37c0fa8f282d1e521282bfc8
