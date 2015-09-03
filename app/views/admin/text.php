{% extends 'templates/default.php' %}

{% block title %}Text{% endblock %}

{% block content %}
<h2>Text</h2>
<form action="{{ urlFor('text.send') }}" method="post" autocomplete="off">
<label for="role">Send to which of the following <br></label>

<input type="radio" name="group" id="role" value="1">
<label for="role">Attendee</label><br>

<input type="radio" name="group" id="role1" value="2">
<label for="role1">mentor</label><br>

<input type="radio" name="group" id="role2" value="3">
<label for="role2">volunteer</label><br>

<input type="radio" name="group" id="role3" value="4">
<label for="role3">attendee and volunteer</label><br>

<input type="radio" name="group" id="role4" value="5">
<label for="role4">attendee and mentor</label><br>

<input type="radio" name="group" id="role5" value="6">
<label for="role5">mentor and volunteer</label><br>

<input type="radio" name="group" id="role6" value="7">
<label for="role6">all</label><br>
<label>What you want to send.</label>
			<textarea class="materialize-textarea" type="text" name="body"></textarea>
Click on the link below to start the sending process.</p>

<button class="btn waves-effect waves-light z-depth-1 orange" style="width: 100%" type="submit" name="action">Send
  											</button>
										
									
									<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

</form>
{% endblock %}