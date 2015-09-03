{% extends 'templates/default.php' %}

{% block title %}{{ user.getFullNameOrUsername }}{% endblock %}

{% block content %}
<form action="{{ urlFor('signinprof.post', {username:user.username}) }}" method="post" autocomplete="off">
<div class="twelve columns">
<h2>{{ user.username }}</h5>
<h5>Status:{% if user.status == 2 %}Accepted Attendee{%endif%} {%if user.status==4 %}Accepted Volunteer{%endif%} {%if user.status == 5%}Accepted Mentor {%endif%}{% if user.status == 1 %} Denied {%endif%}</h5>
<div class="col s12">
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


<label for="email">Is their waiver signed?:</label>
<p id="signature">
{% if user.is_signed == 0%}No{%endif%} {%if user.is_signed == 1 %}Yes{%endif%}
</p>
<script>
function signup() {
      			$.ajax({
      				type: "POST",
      				url: "{{ urlFor('sign.sendspec') }}",
      				data: {"email":"{{user.email}}"},
      				success: function(response) {
      					Materialize.toast(response, 10000);
      					$("#signature").text("Sent");
      				},
      				error: function() {
      					alert("not working!");
      				}
      			});
      		}
 function signcheck() {
      			$.ajax({
      				type: "POST",
      				url: "{{ urlFor('sign.check') }}",
      				data: {"email":"{{user.email}}"},
      				success: function(response) {
      					Materialize.toast(response, 10000);
      					$("#signature").text("Yes");
      					$("#sendwaiver").css("display","none");
      					$("#signcheck").css("display","none");

      				},
      				error: function() {
      					Materialize.toast("No Update", 10000);
      					$("#signature").text("(no Update)");
      				}
      			});
      		}
</script>
{% if user.is_signed ==0%}<a id="sendwaiver" onClick="signup()" class="btn orange affect-waves waves-light">Click here to send Waiver</a><br><a id="signcheck" onClick="signcheck()" class="btn orange affect-waves waves-light">Check if waiver is signed</a>{%endif%}
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
			
			<input class="waves-effect waves-light orange" type="submit" name="signout" value="sign out">

			 <input class="waves-effect waves-light red lighten-1" type="submit" name="signin" value="sign in">

			
</form>
{% endblock %}