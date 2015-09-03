{% extends 'templates/default.php' %}

{% block title %}All Mentors{% endblock %}

{% block content %}
	<h2>All Users</h2>
	<a class="btn" href="{{ urlFor('notify.mentors') }}">Notify All Approved/Rejected Mentors of Acceptance/Rejections ({{notify}})</a>
	<p>This will send out an email to all students asking them to check their portals.</p>
	<div class="row">
	<div class="col s3">
	<p>Accepted: {{accept}}</p>
	</div>
	<div class="col s3">
	<p>Rejected: {{reject}}</p>
	</div>
	<div class="col s3">
	<p>Applied: {{ applied }} </p>
	</div>
	<div class="col s3">
	<p>Left To Admit: {{ left }} </p>
	</div>
	</div>
	<a class="btn" href="{{ urlFor('admin.mentor.admit') }}" name="accept">View Potentials Admits</a>
	<a class="btn" href="{{ urlFor('mentor.admitted') }}" name="accept">View Admitted</a>
	<a class="btn" href="{{ urlFor('mentor.denied') }}" name="accept">View denied</a>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<p style="height: 50px"></p>
	{% if users is empty %}
		<p>No Users</p>
	{% else %}


		{% for user in users %}
		<div class="row">
			<div class="col s12 hold">
			    <div class="header">
			    	<div class="row">
				    	<div class="expand col s1"><i class="fa fa-plus-square-o fa-2x"></i></div>
					    <div class="col s3">User:<a href="{{ urlFor('user.profile', {username: user.username})}}">{{ user.username }}</a></div>
					    <div class="col s1">Age:{{user.age}}</div>
					    <div class="col s2">City: {{user.city}}</div>
					    <div class="col s2"><a class="btn admit {% if user.status == 5 %} grey {% endif %}" href="{{ urlFor('mentor.admit', {userId: user.id})}}" name="accept">Accept</a></div>
					    <div class="col s2"><a class="btn deny {% if user.status == 1 %} grey {% endif %}" href="{{ urlFor('mentor.deny', {userId: user.id})}}" name="deny">Deny</a><br></div>
				    </div>		
			    </div>
				    <div class="row">
				    	<div class="col s6">
							 Age: <b>{{user.age}}</b><br>
							 Gender: <b>{{user.gender}} </b><br>
							 Languages: <b>{{user.langs}} </b><br>
							 Was at SoHacks 2014?: <b>{%if user.sohacks %}Yes{%endif%} </b><br>
						</div>
						<div class="col s6">
							 Portfolio: <b>{{user.proj}}</b><br>
						</div>
				</div>
			</div>
	    </div>
		
		{% endfor %}
	{% endif %}
<style>
.row {
	padding-bottom:5px;
}
.header .button {
	padding: 2px;
	color: #000;
	line-height: 20px;
	height: 20px;
	margin-bottom: 0px;
	box-sizing: content-box;
	color: #FFF;
	border: none;
	padding: 5px;
}
.admit {
	color: #FFF;
	background: #2ECC71;
}
.deny {
	color: #FFF;
	background: red;
}
.grey {
	color: #FFF;
	background: #CCC;
}
.container .header {
    background-color:#FFF;
    border-radius: 5px;
    padding: 5px;
    cursor: pointer;
    font-weight: bold;
}
.hold {
	    border: 1px solid #000;
	    border-radius: 5px;

}
.container .content {
    display: none;
    padding : 5px;
}
</style>
<script>
$(".expand").click(function () {

    $header = $(this);
    //getting the next element
    $content = $header.parent().parent().next();
    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
    $content.slideToggle(500, function () {
        //execute this after slideToggle is done
        //change text of header based on visibility of content div

    });

});
</script>
{% endblock %}