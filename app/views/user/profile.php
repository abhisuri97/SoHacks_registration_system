{% extends 'templates/default.php' %}

{% block title %}{{ user.getFullNameOrUsername }}{% endblock %}

{% block content %}
	<script src="//sohacks.com/register/croppic.js"></script>
<!--     <link href="//sohacks.com/register/assets/css/main.css" rel="stylesheet">
 -->    <link href="//sohacks.com/register/assets/css/croppic.css" rel="stylesheet">
<div class="twelve columns">
<h2>{{ user.username }}</h5>
<h5>{% if user.team == false %}<b>Looking for team</b>{%endif%}</h6>
{% if auth.username == user.username %}<p>This is how your public profile looks. Users can view anyone who is looking for a team member. You can edit the information on this page by editing the corresponding fields in your application (see navigation bar above).</p> {%endif %}
</div>
<div class="row">
<div class="col s8">
	<img src="{{ user.getAvatarUrl({size:100}) }}" class="avatar" alt="prof pic for {{ user.getFullNameOrUsername }}">
	{% if auth.username == user.username %}
	    <p>Upload a New Profile Image<br> (files must be < 5 MB in either .jpg or .png formats; best results occur for square images):</p>

	{# <form enctype="multipart/form-data" action="{{ urlFor('user.picupload', {id: auth.id}) }}" method="post">
  
    <div class="file-field input-field">
        <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
      	<input class="file-path validate" type="text"/>
     	 <div class="btn">
      	  <span>File</span>
      	  <input name="uploaded_file" type="file" />
      	</div>
    </div> #}
    <form enctype="multipart/form-data" action="{{ urlFor('user.picupload', {id: auth.id}) }}" method="post">
          <div class="file-field input-field">
          	<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
            <div class="btn">
              <span>File</span>
              <input name="uploaded_file" type="file">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
   	<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    <button type="submit" value="Upload" class="btn" />Submit</button>
  </form> 
  
	{%endif%}
</div>
<div class="col s4">
		{% if user.getFullName %}
		<h6><b>Full Name</b><br>
		{{ user.getFullName }}</h6>
		{% endif %}

		<h6><b>Email</b></br>
		{{user.email}}</h6>

		{% if user.lang1 %}
		<h6><b>Languages</b><br>
			{{user.lang1}}<br>
			{{user.lang2}}<br>
			{{user.lang3}}
		</h6>

		{%endif%}
	</div>
	</div>
	<div class="row">
	<div class="twelve columns">
			{% if user.proj %} 
			<h6><b>Previous Projects/What I want to do at SoHacks</b><br></h6>
			<p>
			{{user.proj}}
			</p>
			{% endif %}

	</div>
</div>
{% endblock %}