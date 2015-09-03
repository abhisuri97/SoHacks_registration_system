{% extends 'templates/default.php' %}

{% block title %}Sign{% endblock %}

{% block content %}
<h2>Forms</h2>
<p>This year we are going paperless with our waivers. Through our sponsor HelloSign, we are integrating online form signing into our hackathon. HelloSign is an incredibly secure way of
hosting and signing documents and legal waivers under a secure protocol. If you are under the age of 18, you will need a parent/guardian to sign these forms for you. Thank you for your cooperation.<br>
Click on the link below to start the signing process.</p>
{% if auth.is_signed==false %}<a href="{{urlFor('sign.send')}}" class="btn orange affect-waves waves-light">Click here to send an email</a>{%endif%}
{%if auth.sent_signature == true %}<p style="font-weight:700">An email has been sent to you. Click above if it doesn't reach you within the next hour</p>
<p><b>Current Status:</b>{%if auth.is_signed == false %} Not signed (Refresh Page to Update){% endif %} {% if auth.is_signed==true %} Signature Received {% endif %}
{%endif%}
{% endblock %}