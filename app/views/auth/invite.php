{% extends 'templates/default.php' %}

{% block title %}Invite Users{% endblock %}

{% block content %}
<h2>Invite Users</h2>
<div class="row">
									{% if (errors) %}
								        <div class="col s12">
								          <div class="card red lighten-2">
								            <div class="card-content white-text loginerror">
				{% if errors.has('email') %} <div class="alert alert-info">{{ errors.first('email')}}</div> {% endif %}


								            </div>
								          </div>
								        </div>
							        {% endif %}
      							</div>

	<form action="{{ urlFor('invite.post') }}" method="post" autocomplete="off">
		<div>
			<lable for="to">Email of person you want to invite</lable>
			<input class="u-full-width" type="text" name="to" id="email">
		</div>
		<div>
			<button type="submit" class="btn orange waves-effect waves-light">Send</button>
		</div>
		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

	</form>

{% endblock %}