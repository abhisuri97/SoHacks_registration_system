{% extends 'templates/default.php' %}

{% block title %}Hey{% endblock %}

{% block content %}
  Hey
<form action="{{ urlFor('new.post') }}" method="post" autocomplete="off">
<div class="twelve columns">
<div class="col s12">
  <label for="username">Username</label>
<input type="text" name="username" id="username" value="{{ request.post('username') ? request.post('username') : user.username }}">
</div>
<label for="first_name">First Name</label>
<input type="text" name="first_name" id="first_name" value="{{ request.post('first_name') ? request.post('first_name') : user.first_name }}">
</div>
<div class="col s12">

<label for="first_name">Last Name</label>
<input type="text" name="last_name" id="last_name" value="{{ request.post('last_name') ? request.post('last_name') : user.last_name }}">

</div>
<div class="col s12">

<label for="email">Email</label>
<input type="text" name="email" id="email" value="{{ request.post('email') ? request.post('email') : user.email }}">

</div>
<div class="col s12">

<label for="email">Emergency Phone:</label>
<input type="text" name="phone" id="phone" value="{{ request.post('phone') ? request.post('phone') : user.phone }}">
</div>

<div class="col s12">
<label for="email">Contact Phone:</label>
<input type="text" name="eventphone" id="phone" value="{{ request.post('eventphone') ? request.post('eventphone') : user.eventphone }}">
</div>

<div class="col s12">

<label for="email">Allergies:</label>
<input type="text" name="allergies" id="allergies" value="{{ request.post('allergies') ? request.post('allergies') : user.allergies }}">
</div>
<div class="col s12">

<label for="laptop">Needs Laptop?: <br></label>
<input type="radio" name="laptop" id="laptop" value="1" {% if request.post('laptop')=="1" %} checked {% elseif user.laptop =="1" %} checked {% endif %}>
			<label for="laptop">Yes</label><br>
			<input type="radio" name="laptop" id="laptop1" value="0" {% if request.post('laptop')=="0" %} checked {% elseif user.laptop =="0" %} checked {% endif %}>
			<label for="laptop1">No</label><br><br><br><br>
</div>
<div class="col s12">

<label for="role">Role: <br></label>
<input type="radio" name="role" id="role" value="attendee" {% if request.post('role')=="attendee" %} checked {% elseif user.role =="attendee" %} checked {% endif %}>
      <label for="role">Attendee</label><br>
<input type="radio" name="role" id="role1" value="mentor" {% if request.post('role')=="mentor" %} checked {% elseif user.role =="mentor" %} checked {% endif %}>
      <label for="role1">mentor</label><br>
<input type="radio" name="role" id="role2" value="volunteer" {% if request.post('role')=="volunteer" %} checked {% elseif user.role =="volunteer" %} checked {% endif %}>
      <label for="role2">volunteer</label><br>
      <br><br><br><br>
</div>
<style>
		input[type="submit"]
{
    border:0px solid red;
    text-decoration:none;
    font-family:roboto;
    color:white;
    background: transparent;
    font-style: normal;
    font-size: 16px;
    padding:20px;
}
input[type="radio"]:checked + label:after{
    background-color:#F79E21;
    border-color:#F79E21;
}

		</style>
<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
			

			 <input class="waves-effect waves-light red lighten-1" type="submit" name="signin" value="sign in">

			
</form>
{% endblock %}