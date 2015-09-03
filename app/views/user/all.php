{% extends 'templates/default.php' %}

{% block title %}All Users{% endblock %}

{% block content %}

	<h2>All Users looking for team members</h2>
	<h4>Currently {{ looking }} user(s) are looking for team members (including you) </h4>
	{% if users is empty %}
		<p>No Users looking for Team members</p>
	{% else %}

	<div>
		{% for user in users %}
			{% if user.is_admin==false %}
				{%if user.role == "attendee"%}
				{%if loop.index0 % 4 == 0%}
				</div>
					<div class="row">
						<div class="twelve columns">
							<div class="buffer" style="height: 20px;"></div>
						</div>
					</div>
				<div class="row">
				{% endif %}

				<div class="col s12 m3 l3 {{user.lang1}} {{user.lang2}} {{user.lang3}} {{user.hack}} {{user.prog}}" style="text-align:center">
					<div class="card">
    <div class="card-image waves-effect waves-block waves-light" style="height:210px">
      <img class="activator" src="{{user.getAvatarUrl({size: 30})}}">
    </div>
    <div class="card-content" style="min-height:200px">
      <span class="card-title activator grey-text text-darken-4">{{user.getFullNameOrUsername}} <br><i class="fa fa-info-circle" style="padding-top: 10px"></i></span>
      <p><a href="mailto:{{user.email}}" class="button button-primary">Contact User</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">{{user.getFullNameOrUsername}}<i class="fa fa-times right"></i>
</span>
      <p>Knows:</p>
					<div class="row">
						<div class="four columns">
							{{user.lang1}}
						</div>
						<div class="four columns">
							{{user.lang2}}
						</div>
						<div class="four columns">
							{{user.lang3}}
						</div>
					</div>
					<p>Reason to Attend SoHacks/Portfolio</p>
					<p>{{user.proj}}</p>
    </div>
  </div>
					
				</div>
				{%endif%}
			{%endif%}
		{% endfor %}
	{% endif %}
{% endblock %}