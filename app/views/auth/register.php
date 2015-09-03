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
      

	<script>
	 $(document).ready(function(){
	 if ($('.card').find('.loginerror').size()>0)
	 	{
    $('ul.tabs').tabs('select_tab', 'test1');
    	}
    if ($('.card').find('.registererror').size()>0)
	 	{
	 		console.log("found register")
    $('ul.tabs').tabs('select_tab', 'test2');
    	}
  });
	  $(document).ready(function() {
    $('select').material_select();
  });
	</script>
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
			    	<div class="col m10 offset-m1 l6 offset-l3 s12">
			        	<div class="card">
			            	<div class="card-content">
			            	<div class="row">
			            			<div class="col s12">
			            				<a href="{{ urlFor('home') }}" class="btn-small waves-effect"><i class="fa fa-arrow-left"></i> Go Home</a>
			            			</div>
			            		</div>
<div id="test2">
							<div class="row">
									{% if (errors.has('email') or errors.has('username') or errors.has('password') or errors.has('password_confirm') or errors.has('role'))%}
								        <div class="col s12">
								          <div class="card red lighten-2">
								            <div class="card-content white-text registererror">
								            
								            	{% if errors.has('email') %} <div class="alert alert-info">{{ errors.first('email')}}</div> {% endif %}
	{% if errors.has('username') %}<div class="alert alert-info">{{ errors.first('username')}} </div>{% endif %}
	{% if errors.has('password') %}<div class="alert alert-info">{{ errors.first('password')}}</div> {% endif %}
	{% if errors.has('password_confirm') %}<div class="alert alert-info">passwords must match</div>{% endif %}
	{% if errors.has('role') %}<div class="alert alert-info">You must select a role</div>{% endif %}
								            </div>
								          </div>
								        </div>
							        {% endif %}
      							</div>
							<form action="{{ urlFor('register.post') }}" method="post" autocomplete="off">
								<div class="row">
										<div class="input-field col s12">
											<label for="email">Email</label>
											<input class="u-full-width" type="text" name="email" id="email" {% if request.post('email') %} value="{{ request.post('email')}}" {% endif %}>
										</div>
								</div>
								<div class="row">
										<div class="input-field col s12">
											<label for="username">Username</label>
											<input class="u-full-width" type="text" name="username" id="username" {% if request.post('username') %} value="{{ request.post('username')}}" {% endif %}>
										</div>
								</div>
								<div class="row">
									<div class="input-field col s6">
										<label for="password">Password</label>
										<input class="u-full-width" type="password" name="password" id="password">
									</div>
									<div class=" input-field col s6">
										<label for="password_confirm">Password Confirmation</label>
										<input class="u-full-width" type="password" name="password_confirm" id="password_confirm">
									</div>
								</div>
								<div class="row">
									<div class="col s12">
										<label for="role">I will be a(n)...</label>
										<select class="u-full-width" name="role">
											<option value="NULL" {% if request.post('role')=="NULL" %} selected="selected" {% elseif auth.role=="NULL" %} selected="selected" {% endif %}>Select One</option>
											<option value="attendee" {% if request.post('role')=="attendee" %} selected="selected" {% elseif auth.role=="attendee" %} selected="selected" {% endif %}>Attendee</option>
											<option value="volunteer" {% if request.post('role')=="volunteer" %} selected="selected" {% elseif auth.role=="volunteer" %} selected="selected" {% endif %}>Volunteer</option>
											<option value="mentor" {% if request.post('role')=="mentor" %} selected="selected" {% elseif auth.role=="mentor" %} selected="selected" {% endif %}>Mentor</option>
										</select>
										<p style="font-weight:300"><i>If you completed the 8th, 9th, 10th, 11th, or 12th grade during the 2014-2015 school year AND want to participate in the hackathon, you are an <b>attendee</b>. <br>
										If you want to help us with the event in exchange for valid community service hours but not participate in the hackathon itself, you are a <b>volunteer</b>. <br>
										If you want to teach or provide your programming expertise for the event, OR if you are outside of our attendee age range, you are a <b>mentor</b>.</i></p>
									
									</div>
								</div>
								<div class="row">
									<div class="col s12">
											 <button class="btn waves-effect waves-light z-depth-1" type="submit" style="width: 100%" name="action">Register
  											</button>
										</div>
								</div>
											<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

								</form>
			            	</div>
			          	</div>