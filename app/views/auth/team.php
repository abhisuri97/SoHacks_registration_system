{% extends 'templates/default.php' %}

{% block title %}Team{% endblock %}

{% block content %}
<h2>Team Page</h2>
<div class="row">
	<div class="col s12">
		<p>As part of the registration form, you were asked to provide some basic information about your programming experience and what you were hoping to gain out of SoHacks this year.
		We have compiled your answers and created a public user profile for you, which you can view <a href="{{ urlFor('user.profile', {username: auth.username})}}">here</a>. This information is also available on a viewable database of users.</p>
		{% if auth.team == true %} 
		<form action="{{ urlFor('team.addback') }}" method="post" autocomplete="off">
		<input type="submit" class="btn"value="Add me to the team search database">							
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
		</form>
		{% endif %}
		{% if auth.team==false %}
		<p>Since you indicated that you were searching for a team, we have added your <a href="{{ urlFor('user.profile', {username: auth.username})}}">public profile</a> to a user database of other members looking for teams.</p>
		<a href="{{ urlFor('team.all')}}" class="btn green">View team search database</a> <br><br>
		<form action="{{ urlFor('team.has') }}" method="post" autocomplete="off">
		<input type="submit" class="btn red lighten-1" value="Remove Me from this database">				
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
		</form>
		<br><br><br>
		{%endif%}
	</div>
</div>
<div class="row">
	<div class="col s12">
		<div class="row">
			{%if auth.is_team==false %}
			<div class="col s6">
			You can also make a team here.
			<form action="{{ urlFor('team.make') }}" method="post" autocomplete="off">
					<div>
						<lable for="email">Team Name</lable>
						<input class="u-full-width" type="text" name="name" id="team_name">
					</div>
					<button class="btn" type="submit" value="Register">Register Team</button>					
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">


			</form>
		</div>
		<div class="col s6">
			You can join a team here by putting in your access code (ask your team creator for the access code).
			<form action="{{ urlFor('team.join') }}" method="post" autocomplete="off">
					<div>
						<lable for="email">Access Code:</lable>
						<input class="u-full-width" type="text" name="invite" id="team_name">
					</div>
					<button class="btn" type="submit" value="Join">Join Team</button>					
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">


			</form>
		</div>
			{% endif %}
		</div>
	</div>
	{% if auth.is_team == true %}
	<div class="col s12">
		<div class="row">
		<h3>Your team code is {{code}}</h3>
		<form action="{{ urlFor('team.leave') }}" method="post" autocomplete="off">
				<div>Leave Team
					<lable for="email">Retype Access Code:</lable>
					<input class="u-full-width" type="text" name="invite" id="team_name">
				</div>
				<button class="btn" type="submit" value="Join">Leave Team</button>					
				<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
		</form>
		<p>Members:</p>
		</div>
		<div class="row">
		{% if user1 is not null %}
			<div class="col s3" style="text-align:center">
					<div class="card">
					    <div class="card-image waves-effect waves-block waves-light">
					      <img src="{{ user1.getAvatarUrl({size: 30})}}">
					    </div>
					    <div class="card-content">
					      <span class="card-title activator grey-text text-darken-4"><a href="{{ urlFor('user.profile', {username: user1.username })}}">{{user1.getFullNameOrUsername}}</a></span>
					    </div>
					</div>
			</div>
		{%endif%}
		
		{% if user2 is not null %}
			<div class="col s3" style="text-align:center">
					<div class="card">
					    <div class="card-image waves-effect waves-block waves-light">
					      <img src="{{ user2.getAvatarUrl({size: 30})}}">
					    </div>
					    <div class="card-content">
					      <span class="card-title activator grey-text text-darken-4"><a href="{{ urlFor('user.profile', {username: user2.username })}}">{{user2.getFullNameOrUsername}}</a></span>
					    </div>
					</div>
			</div>
		{%endif%}

		{% if user3 is not null %}
			<div class="col s3" style="text-align:center">
					<div class="card">
					    <div class="card-image waves-effect waves-block waves-light">
					      <img src="{{ user3.getAvatarUrl({size: 30})}}">
					    </div>
					    <div class="card-content">
					      <span class="card-title activator grey-text text-darken-4"><a href="{{ urlFor('user.profile', {username: user3.username })}}">{{user3.getFullNameOrUsername}}</a></span>
					    </div>
					</div>
			</div>
		{%endif%}

		{% if user4 is not null %}
			<div class="col s3" style="text-align:center">
					<div class="card">
					    <div class="card-image waves-effect waves-block waves-light">
					      <img src="{{ user4.getAvatarUrl({size: 30})}}">
					    </div>
					    <div class="card-content">
					      <span class="card-title activator grey-text text-darken-4"><a href="{{ urlFor('user.profile', {username: user4.username })}}">{{user4.getFullNameOrUsername}}</a></span>
					    </div>
					</div>
			</div>
		{%endif%}
		</div>
	{%endif%}
	</div>
</div>
{% endblock %}