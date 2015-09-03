{% extends 'templates/default.php' %}

{% block title %}Send Notice{% endblock %}

{% block content %}
<h2>Send Notice</h2>
	<form action="{{ urlFor('notice.post') }}" method="post" autocomplete="off">
		<div>
			<lable for="to">To</lable><br>
			<select class="u-full-width" name="to">
				<option value="ALL:SIGNUP">All People who Signed up but didn't fill out form</option>				
				<option value="ALL:APPLIED">All People who applied</option>
				<option value="ALL:STUAPPLIED">All students who applied</option>
				<option value="ALL:MENAPPLIED">All mentors who applied</option>
				<option value="ALL:VOLAPPLIED">All Volunteers who applied</option>
				<option value="ALL:DECIDED">All applicants with a decision</option>
				<option value="ALL:STUACCEPTED">All students who are accepted</option>
				<option value="ALL:STUDENIED">All Denied students</option>
				<option value="ALL:MENACCEPTED">All accepted mentors </option>
				<option value="ALL:MENDENIED">All Denied mentors</option>
				<option value="ALL:VOLACCEPTED">All accepted volunteers</option>
				<option value="ALL:VOLDENIED">All Denied volunteers</option>
				<option value="ALL:ACCEPTED">All accepted Applicants</option>
				<option value="ALL:DENIED">All Denied Applicants</option>
				<option value="ALL:STUATTENDING">All students attending</option>
				<option value="ALL:VOLATTENDING">All volunteers attending</option>
				<option value="ALL:MENATTENDING">All mentors attending</option>
				<option value="ALL:ATTENDING">Anyone who has confirmed they are attending the event</option>
			</select>
		</div>
		<div>
			<lable for="subject">Subject</lable>
			<input class="u-full-width" type="text" name="subject" id="username">

		</div>
		<div>
			<lable for="body">Body</lable>
			<input class="u-full-width" type="text" name="body" id="username">

		</div>
		<div>
			<input type="submit" value="Send">
		</div>
				<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

	</form>

{% endblock %}