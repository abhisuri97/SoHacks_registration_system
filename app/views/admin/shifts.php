{% extends 'templates/default.php' %}

{% block title %}Shifts{% endblock %}
{% block content %}

{% if auth.isAdmin == true %}
<div class="row">
	<div class="col s12">
		<h3>{% if auth.isAdmin == true %}Add{%endif%} Shifts</h3>
		<form action="{{ urlFor('shifts.add') }}" method="post" autocomplete="off">
		<p>Time (e.g. 1:00 PM - 2:00 PM)</p>
		<input type="text" name="shift_time">
		<p>For who (volunteers, mentors, both)</p>
		<input type="radio" name="for" id="for1" value="4" {% if request.post('grade')=="4" %} checked {% elseif auth.grade=="4" %} checked {% endif %}>
			<label for="for1">Volunteers</label><br>
			<input type="radio" name="for" id="for2" value="5" {% if request.post('grade')=="5" %} checked {% elseif auth.grade=="5" %} checked {% endif %}>
			<label for="for2">Mentors</label><br>
			<input type="radio" name="for" id="for3" value="6" {% if request.post('grade')=="6" %} checked {% elseif auth.grade=="6" %} checked {% endif %}>
			<label for="for3">Both</label><br>
			<br>
		<p>Description</p>
		<input type="text" name="desc">

		<input type="submit" class="btn">						
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
		</form>
	</div>
</div>
{% endif %}
<div class="row">
	<div class="col s12">
	{% for item in list %}
		<div class="card">
    <div class="card-image waves-effect waves-block waves-light">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">{{item.shift}} <br>{{item.count}} signed up<a><i class="fa fa-link right" style="padding-top: 10px;"> View All in time slot</a></i></span>
      <p>Description of Duties: {{item.desc}}</p>
      <p>For all {% if item.for == "4" %} <b>Volunteers</b> {% endif %} {% if item.for == "5" %} <b>Mentors</b> {% endif %} {% if item.for == "6" %} <b>Mentors and Volunteers</b> {% endif %}<br>
		{% set foo = "false" %}
		{% for join in joined %}
			{% if join.shift_id == item.id %}
      			{% if join.user_id == auth.username %}
      				 {% set foo = "true" %}
      			    You have already joined this shift. Do you want to leave it? <br><a href="{{ urlFor('shifts.leave', {id:item.id} )}}" id="leave" class="btn z-depth-0">LEAVE</a>
      			{% endif %}
      		{% endif %}
      	{% endfor %}
      	
      	{% if foo == "false" %} 
      	<br>
      	// <script>
      	// function signup() {
      	// 		$.ajax({
      	// 			type: "POST",
      	// 			url: "{{ urlFor('shifts.signup') }}",
      	// 			data: {id:{{item.id}}},
      	// 			success: function(response) {
      	// 				Materialize.toast(response, 4000);
      	// 				$("#signup{{item.id}}").css("display","none");
      	// 			},
      	// 			error: function() {
      	// 				alert("not working!");
      	// 			}
      	// 		});
      	// 	}
      	// </script>
      				<a href="{{ urlFor('shifts.signup', {id:item.id} )}}" class="btn z-depth-0">Sign Up for this shift</a>
{#       				<a onClick="signup()" id="signup{{item.id}}" class="btn z-depth-0">Sign Up for this shift</a>
 #}      	{% endif %}
      	{% if auth.isAdmin == true %}<br><br><a href="{{ urlFor('shifts.delete', {id:item.id}) }}" class="btn z-depth-0 red">Delete Shift</a><br>{% endif %}
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Users<i class="fa fa-times right"></i></span>
      <p>{% for join in joined %}
			{% if join.shift_id == item.id %}
 				<a href="{{urlFor('user.profile', {username: join.user_id}) }}">{{join.user_id}}</a> in {{item.shift}}<br>
 			{% endif %}
		{% endfor %}</p>
    </div>
  </div>
   {% endfor %}
      
	
		<br>
		</div>
	 
</div>
{% endblock %}
