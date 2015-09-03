<!DOCTYPE html>
<html lang="en">
    <head>
      <!--Import materialize.css-->
      		<title>SoHacks 2 | Login/Register</title>
		<meta charset="UTF-8">

      <link type="text/css" rel="stylesheet" href="/styles/css/materialize.min.css"  media="screen,projection"/>
<link rel="stylesheet" href="/styles/css/font-awesome.min.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <script type="text/javascript" src="/styles/js/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="/styles/js/materialize.min.js"></script>
    </head>

    <body>
      <!--Import jQuery before materialize.js-->
	<style>
	html { 
  background: url("/styles/img/home.jpg") no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
	</style>
	<main>
		<div class="container">
				<div class="row">
					<div class="col s12" style="padding-top: 100px">
					{% include 'templates/partials/messages.php' %}
					</div>
				</div>

				<div class="row">
			    	<div class="col m6 offset-m3 l4 offset-l4 s12">

			        	<div class="card">
			            	<div class="card-content">
			            	
			            		<div class="row">
			            			<div class="col s12">
			            				<a href="{{ urlFor('home') }}" class="btn-small waves-effect"><i class="fa fa-arrow-left"></i> Go Home</a>
			            			</div>
			            		</div>
      						<div id="test1">
      							<div class="row">
									{% if (errors.has('identifier') or errors.has('password-login')) %}
								        <div class="col s12">
								          <div class="card red lighten-2">
								            <div class="card-content white-text loginerror">
								              {% if errors.has('identifier') %} Check if this username is correct! <br> <br>{% endif %}
								              	{% if errors.has('password-login') %}Make sure your password is correct{% endif %}
								            </div>
								          </div>
								        </div>
							        {% endif %}
      							</div>
			              		<form action="{{ urlFor('login.post') }}" method="post" autocomplete="off">
									<div class="row">
										<div class="input-field col s12">
											<label for="identifier">Username/Email</label>
											<input class="u-full-width" type="text" name="identifier" id="identifier">
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<label for="password-login">Password</label>
											<input class="u-full-width" type="password" name="password-login" id="password">
										</div>
									</div>
									<div class="row">
										<div class="col s12">
											<input type="checkbox" name="remember" id="filled-in-box" class="filled-in">
											<label for="filled-in-box">Remember Me</label>
										</div>
									</div>
									<div class="row">
										<div class="col s12">
											 <button class="btn waves-effect waves-light z-depth-1 orange" style="width: 100%" type="submit" name="action">Log In
  											</button>
										</div>
									</div>
									<a href="{{ urlFor('password.recover') }}"> Forgot password? <br></a>
									<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
								</form>
							</div>
			        </div>
			    </div>
			</div>
		</main>
	</body>
</html>
