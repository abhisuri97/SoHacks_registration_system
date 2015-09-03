{% extends 'templates/default.php' %}

{% block title %}Change-Password{% endblock %}

{% block content %}
	<h2>Change Password</h2>
								<div class="row">
									{% if (errors) %}
								        <div class="col s12">
								          <div class="card red lighten-2">
								            <div class="card-content white-text loginerror">
								              {% if errors.has('password_old') %} <div class="alert alert-info">The old password is required </div>{% endif %}
			{% if errors.has('password') %} <div class="alert alert-info">{{ errors.first('password') }}</div> {% endif %}
						{% if errors.has('password_confirm') %} <div class="alert alert-info"> Passwords must match </div>{% endif %}
								            </div>
								          </div>
								        </div>
							        {% endif %}
      							</div>
				


	<form action="{{ urlFor('password.change.post') }}" method="post" autocomplete="off">
		<div>
			<label for="password_old">Old Password</label>
			<input class="u-full-width" type="password" name="password_old" id="password_old">
		</div>
		<div>
			<label for="password_new">New Password</label>
			<input class="u-full-width" type="password" name="password_new" id="password_new">

		</div>
		<div>
			<label for="password_confirm">Confirm Password</label>
			<input class="u-full-width" type="password" name="password_confirm" id="password_confirm">
		
		</div>
		<div>
			<button type="submit" class="btn orange waves-effect waves-light">Change Password</button>
		</div>
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

	</form>
{% endblock %}