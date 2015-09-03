{% extends 'templates/default.php' %}

{% block title %}Reset Password{% endblock %}

{% block content %}
	<form action="{{ urlFor('password.reset.post') }}?email={{ email }}&identifier={{ identifier|url_encode }}" method="post" autocomplete="off">
		<div class="row">
									{% if (errors) %}
								        <div class="col s12">
								          <div class="card red lighten-2">
								            <div class="card-content white-text loginerror">
			{% if errors.has('password') %}{{ errors.first('password') }}{% endif %}
							{% if errors.has('password_confirm') %}{{ errors.first('password_confirm') }}{% endif %}

								            </div>
								          </div>
								        </div>
							        {% endif %}
      							</div>
		<div>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</div>
		<div>
			<label for="password_confirm">Confirm Password</label>
			<input type="password" name="password_confirm" id="password_confirm">
		</div>
		<div>
			<button type="submit" class="btn orange waves-effect waves-light">Change Password</button>
		</div>
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	</form>
{% endblock %}