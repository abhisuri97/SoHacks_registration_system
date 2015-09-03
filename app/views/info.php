{% extends 'templates/default.php' %}

{% block title %}Home{% endblock %}
{% block content %}

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
	<script>

  $(document).ready(function(){
    $('ul.tabs').tabs();
  });
  </script>

<div class="row">
  <div class="col m8 offset-m2 s12">
  <div class="card">
	<div class="card-content">
		<div class="row">
			<div class="row">
				            		<div class="col m4 offset-m4 s12">
				            			<img src="/styles/img/logoint.png" width="100%">
				            		</div>
				</div>
		<div class="center-align">
			<h2>Information and To-Do List</h2>
			<p>To start, please select the position which describes you best. <br><br></p>
		</div>
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s3"><a href="#test1">Attendee</a></li>
		        <li class="tab col s3"><a href="#test3">Volunteer/Mentor/Sponsor</a></li>
		      </ul>
		    </div>
		    <div id="test1" class="col s12">
		    	<div class="center-align">
		    	<h5><b>Before you begin, make sure you download the attendee packet at <a href="//sohacks.com/packets/attendee.pdf">http://sohacks.com/packets/attendee.pdf</a> for essential information including event schedules and rules.</b></h5>
		    </div>
		    	<p><br><br>Thank you for considering signing up for SoHacks 2. We are going to limiting our attendee numbers this year to around 200 individuals, so if you haven't signed up yet, NOW is the time to do so. Here is a step by step process to get you started. <b>Even if you have signed up, view the entire to-do list to make sure that you aren't missing anything.</b><br><br>
		    	</p>

		    	<p><b>Sign Up Process</b></p>
		    	<ol>
		    		<li>Go to <a href="//sohacks.com/register" target="_blank">http://www.sohacks.com/register</a> and click <a href="//sohacks.com/register/signup" target="_blank">signup</a> if you do not have an account OR click <a href="//sohacks.com/register/login" target="_blank">log in</a> if you do have an account.</li>
		    		<li>Fill in the appropriate information depending on the page you go to.</li>
		    		<li>If you are registering for the first time, an activation email will be sent to the email you registered with. <b>NOTE: It is very important to click the link in this activation email (sent from register@sohacks.com). You cannot proceed until your account is activated.</b></li>
		    		<li>Click on the <a href="{{ urlFor('account.profile')}}" target="_blank">Registration Form</a> link in the side menu and fill in all the information. Once you finalize all your information. Click the SUBMIT button on the bottom.</li>
		    		<li>If you meet our criteria, a link will appear in the menu bar named <a href="{{ urlFor('decision') }}">Decision</a>, once your application is approved (within 24 hrs).</li>
		    		<li>To view your application decision, go to the <a href="{{ urlFor('decision') }}">Decision</a> page. If accepted, <b>please click the appropriate link to confirm or deny attendance</b>.</li>
		    		<li>Click on the <a href="{{ urlFor('sign') }}">Forms</a> link to start the waiver signing process. <b>If you do not sign a waiver you will not be able to attend the event. <b>Once you reach this stage, you will be unsubscribed from this week's email list.</b></b></li>
		    		<li>Click on the <a href="{{ urlFor('team')}}">Teams</a> link to form a team for the event. <b>We encourage all individuals to be part of a team. Even if competing individually, it is best to create a team in case you find someone you would like to work with during the event.</b></li>
		    		<li>Register for workshops. Go to <a href="{{ urlFor('workshops')}}">this page</a></b></li>

		    	</ol>
		    </div>
		    <div id="test3" class="col s12">
			<div class="center-align">
		    	<h5><b>Before you begin, make sure you download the attendee packet at <a href="//sohacks.com/packets/MentorVolunteer.pdf">http://sohacks.com/packets/MentorVolunteer.pdf</a> for essential information including event schedules and rules.</b></h5>
		    </div>
		    	<p><br><br>Thank you for considering signing up for SoHacks 2. Here is a step by step process to get you started with our sign up process. <b>Even if you have signed up, view the entire to-do list to make sure that you aren't missing anything.</b><br><br>
		    	</p>

		    	<p><b>Sign Up Process</b></p>
		    	<ol>
		    		<li>Go to <a href="//sohacks.com/register" target="_blank">http://www.sohacks.com/register</a> and click <a href="//sohacks.com/register/signup" target="_blank">signup</a> if you do not have an account OR click <a href="//sohacks.com/register/login" target="_blank">log in</a> if you do have an account.</li>
		    		<li>Fill in the appropriate information depending on the page you go to.</li>
		    		<li>If you are registering for the first time, an activation email will be sent to the email you registered with. <b>NOTE: It is very important to click the link in this activation email (sent from register@sohacks.com). You cannot proceed until your account is activated.</b></li>
		    		<li>Click on the <a href="{{ urlFor('account.profile')}}" target="_blank">Registration Form</a> link in the side menu and fill in all the information. Once you finalize all your information. Click the SUBMIT button on the bottom.</li>
		    		<li>If you meet our criteria, a link will appear in the menu bar named <a href="{{ urlFor('decision') }}">Decision</a>, once your application is approved (within 24 hrs).</li>
		    		<li>To view your application decision, go to the <a href="{{ urlFor('decision') }}">Decision</a> page. If accepted, <b>please click the appropriate link to confirm or deny attendance</b>.</li>
		    		<li>Click on the <a href="{{ urlFor('sign') }}">Forms</a> link to start the waiver signing process. <b>If you do not sign a waiver you will not be able to attend the event. <b>Once you reach this stage, you will be unsubscribed from this week's email list.</b></b></li>
		    		<li>On July 30th, you will have the ability to mark which shifts you will be attending. The link will be available in the sidebar under the name <a href="{{ urlFor('shifts') }}">"Shifts"</a>. 
		    		</b></li>

		    	</ol>
		    </div>
		</div>		            		
	</div>
</div>
</div>
				 
				
				
	


{% endblock %}
