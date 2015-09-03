{% extends 'email/templates/default.php' %}

{% block content %}
 	<p>You requested a password change</p>
 	<p>Change Password using this link: {{ baseUrl }}{{ urlFor('password.reset') }}?email={{user.email}}&identifier={{ identifier|url_encode }}</p>
 	<p>
 	From,<br>
 	The SoHacks Team
 	</p>
{% endblock %}