{% extends 'templates/default.php' %}

{% block title %}Recover Password{% endblock %}

{% block content %}
	Enter Email to start Recovery
								<div class="row">
									{% if (errors) %}
								        <div class="col s12">
								          <div class="card red lighten-2">
								            <div class="card-content white-text loginerror">
								              		{% if errors.has('email') %}{{ errors.first('email') }} {% endif %}
								            </div>
								          </div>
								        </div>
							        {% endif %}
      							</div>
	<form action="{{ urlFor('password.recover.post') }}" method="post" autocomplete="off">
	<div>
		<label for="email"></label>
		<input class="u-full-width" type="text" name="email" id="email" {% if request.post('email') %} value={{request.post('email')}} {%endif%}>
	</div>
	<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
	<div>
			<button type="submit" class="btn orange waves-effect waves-light">Recover Password</button>
	</div>

	</form>
{% endblock %}