<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
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

	
	</body>
</html>