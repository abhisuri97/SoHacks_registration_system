{% extends 'templates/default.php' %}

{% block title %}Home{% endblock %}
{% block content %}
{% if auth.isAdmin == true %} 
 Here are a bunch of numbers for you
 <div class="row">
 	<div class="col s4">
	 	<div class="card">
	 		<div class="card-content">
	 			<div class="row">
	 				<div class="col s12">
				 		<div class="center-align">
				 			<h4>Attendees</h4>
				 		</div>
						 <p>Attendees who have signed up in total: <b>{{ attendee_total }}</b></p> 
						 <p>Attendees who have signed up and finished registration: <b>{{ attendee_finished }}</b></p>
						 <p>Attendees who are accepted: <b>{{attendee_accept}}</b></p>
						 <p>Attendees who are denied: <b>{{ attendee_deny }}</b></p>
						 <p>Attendees who are attending (confirmed): <b>{{ attendee_attend_confirm }}</b></p>
						 <p>Attendees who are not attending (deny): <b>{{ attendee_attend_deny }}</b></p>
						 <p>Attendees who have signed waivers: <b>{{ attendee_signed }}</b></p>
					</div>
				</div>
			</div>
		</div>
	</div>
 	<div class="col s4">
	 	<div class="card">
	 		<div class="card-content">
	 			<div class="row">
	 				<div class="col s12">
				 		<div class="center-align">
				 			<h4>Mentors</h4>
				 		</div>
						 <p>Mentors who have signed up in total:  <b>{{ mentor_total }}</b></p> 
						 <p>Mentors who have signed up and finished registration: <b>{{ mentor_finished }}</b></p>
						 <p>Mentors who are accepted: <b>{{mentor_accept}}</b></p>
						 <p>Mentors who are denied: <b>{{ mentor_deny }}</b></p>
						 <p>Mentors who are attending (confirmed): <b>{{ mentor_attend_confirm }}</b></p>
						 <p>Mentors who are not attending (deny): <b>{{ mentor_attend_deny }}</b></p>
						 <p>Mentors who have signed waivers: <b>{{ mentor_signed }}</b></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col s4">
	 	<div class="card">
	 		<div class="card-content">
	 			<div class="row">
	 				<div class="col s12">
				 		<div class="center-align">
				 			<h4>Volunteers</h4>
				 		</div>
						 <p>Volunteers who have signed up in total: <b>{{ volunteer_total }}</b></p> 
						 <p>Volunteers who have signed up and finished registration: <b>{{ volunteer_finished }}</b></p>
						 <p>Volunteers who are accepted: <b>{{volunteer_accept}}</b></p>
						 <p>Volunteers who are denied: <b>{{ volunteer_deny }}</b></p>
						 <p>Volunteers who are attending (confirmed): <b>{{ volunteer_attend_confirm }}</b></p>
						 <p>Volunteers who are not attending (deny): <b>{{ volunteer_attend_deny }}</b></p>
						 <p>Volunteers who have signed waivers: <b>{{ volunteer_signed }}</b></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{% endif %}
{% if auth %}
<div class="row">
	<div class="col s12">
		<h1>Welcome!</h1>
		<p style="font-size: 20px">

Thank you for taking interest in the School's Out Hackathon. This year we have made a new portal for all our attendees. We will be developing it over the coming weeks, but expect to see more of this website in the future.
<br>
<b>
So now that you have read a little bit about the School's Out Hackathon, it's time to start hacking! But first, we need you to do a few things. Go to the sidebar and click "To Do" to get started!</b>
</p>
<p>
	From,<br>
	The SoHacks Team
	<p>
</div>
</div>


{% endif %}

{% if auth == false %}
	<style>
	.top-nav{display:none;}
	#nav-mobile{display:none;}
	html { 
  background: url("/styles/img/home.jpg") no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
body {
	background: transparent;
}
main {padding-left: 0px}
	</style>	
				
				<div class="row">
				            		<div class="col m6 offset-m3 l4 offset-l4 s12">
				            			<img src="/styles/img/logoint.png" width="100%">
				            		</div>
				</div>
				<div class="row">
					<div class="col m6 offset-m3 l4 offset-l4 s12">
						<div class="center-align">
							<div class="row">
								<div class="col s12">
									<a class="waves-effect waves-light btn orange" style="width: 80%" href="{{ urlFor('login') }}">Log in</a>
								</div>
							</div>
							<div class="row">
								<div class="col s12">
									<a class="waves-effect waves-light btn orange" style="width: 80%" href="{{ urlFor('register') }}">Sign Up</a>
								</div>
							</div>
						</div>
					</div>
				</div>
	

{% endif %}
{% endblock %}
