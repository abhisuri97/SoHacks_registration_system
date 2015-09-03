{% extends 'email/templates/default.php' %}

{% block content %}
 	<p>You've registered!</p>
 	<p>Activate using <a href="{{ baseUrl }}{{ urlFor('activate') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}" target="_blank">this link</a>. <br>
 	If that doesn't work, try copying this into your browser's addressbar.<br><br>
 	{{ baseUrl }}{{ urlFor('activate') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}
 	</p>
 	<p>
 	If you have any problems email <a href="mailto:abhinavsuri@appsforaptitude.org">abhinavsuri@appsforaptitude.org</a>.<br>
 	From,<br>
 	The SoHacks Team
 	</p>
{% endblock %}