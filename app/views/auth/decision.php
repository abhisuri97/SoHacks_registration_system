{% extends 'templates/default.php' %}

{% block title %}Decision{% endblock %}

{% block content %}
<h2>Your Registration Decision</h2>
	{% if auth.is_notified %}
		{% if auth.status == 2 %}
			<h4>Congratulations {{auth.getFullNameOrUsername}},</h4>
			<p>We are pleased to inform you that you have been invited to attend SoHacks 2 this year. You'll have a great time exploring new ideas and building the newest products while being surrounded by
			some of the most passionate people we could find. We do need you to do a few things first. 
			<ol>
				<li>Confirm that you will be present on August 7-8 at Trinity University (below). If you cannot be there for the event, please let us know by clicking the "Cannot Attend" button.</li>
				<li>Look to do list (see navigation bar on the side) for more tasks.</li>
			</ol>
			Regarding travel reimbursement: We currently are appropriating funds but are waiting on a few sponsors to help fund the event. We will be reviewing travel reimbursements at a later date. If you feel that your reimbursement situation is more demanding, please email us at contact@sohacks.com.
			{% if auth.is_attending%}
				<h4>You have <b>Confirmed</b> your attendance. Click <a href="{{ urlFor('decision.deny')}}">here</a> to deny attedance.</h4>
			{% endif %}
			{% if auth.is_attending is not null %}
				{% if auth.is_attending ==0 %} 
				<h4>You have <b>Denied</b> your attendance. Click <a href="{{ urlFor('decision.confirm')}}">here</a> to accept attedance.</h4>
				{%endif%}
			{%endif%}
			{% if auth.is_attending is null%}
			<a href="{{ urlFor('decision.confirm') }}" class="btn green lighten-1" style="background-color:green!important; border-color:#FFF">Confirm Attendance</a>
			<a href="{{ urlFor('decision.deny') }}" class="btn red lighten-1" style="background-color:red!important;color:#FFF;border-color:#FFF">Cannot Attend</a>
			{%endif%}

			<p>Unfortunately, we will not be doing an online hackathon this year, but we will keep this portal up so you can view resources.</p>
		{%endif%}
	{%endif%}
	{% if auth.is_notified %}
		{% if auth.status == 1 %}
			<h4>Dear {{auth.getFullNameOrUsername}},</h4>
			<p>We regret to inform you that we cannot accomodate you at SoHacks 2 this year. However, we still encourage you to try and participate in several other hackathons in the nation. If you feel that this message was received in error, contact us at contact@sohacks.com.  		
			<p>Unfortunately, we will not be doing an online hackathon this year, but we will keep this portal up so you can view resources.</p>
		{%endif%}
	{%endif%}
	{% if auth.is_notified %}
		{% if auth.status == 4 %}
			<h4>Dear {{auth.getFullNameOrUsername}},</h4>
			<p>Thank you for applying to volunteer at SoHacks this year. You have been accepted! We are looking forward to your help this year!</p>	
			{% if auth.is_attending%}
				<h4>You have <b>Confirmed</b> your attendance. Click <a href="{{ urlFor('decision.deny')}}">here</a> to deny attedance.</h4>
			{% endif %}
			{% if auth.is_attending is not null %}
				{% if auth.is_attending ==0 %} 
				<h4>You have <b>Denied</b> your attendance. Click <a href="{{ urlFor('decision.confirm')}}">here</a> to accept attedance.</h4>
				{%endif%}
			{%endif%}
			{% if auth.is_attending is null%}
			<a href="{{ urlFor('decision.confirm') }}" class="btn green lighten-1" style="background-color:green!important; border-color:#FFF">Confirm Attendance</a>
			<a href="{{ urlFor('decision.deny') }}" class="btn red lighten-1" style="background-color:red!important;color:#FFF;border-color:#FFF">Cannot Attend</a>
			{%endif%}	
		{%endif%}
	{%endif%}
	{% if auth.is_notified %}
		{% if auth.status == 5 %}
			<h4>Dear {{auth.getFullNameOrUsername}},</h4>
			<p>Thank you for applying to mentor at SoHacks this year. You have been accepted! We are looking forward to your help this year!</p>
			{% if auth.is_attending%}
				<h4>You have <b>Confirmed</b> your attendance. Click <a href="{{ urlFor('decision.deny')}}">here</a> to deny attedance.</h4>
			{% endif %}
			{% if auth.is_attending is not null %}
				{% if auth.is_attending ==0 %} 
				<h4>You have <b>Denied</b> your attendance. Click <a href="{{ urlFor('decision.confirm')}}">here</a> to accept attedance.</h4>
				{%endif%}
			{%endif%}
			{% if auth.is_attending is null%}
			<a href="{{ urlFor('decision.confirm') }}" class="btn green lighten-1" style="background-color:green!important; border-color:#FFF">Confirm Attendance</a>
			<a href="{{ urlFor('decision.deny') }}" class="btn red lighten-1" style="background-color:red!important;color:#FFF;border-color:#FFF">Cannot Attend</a>
			{%endif%}		
		{%endif%}
	{%endif%}
{% endblock %}