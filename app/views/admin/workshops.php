{% extends 'templates/default.php' %}

{% block title %}Workshops{% endblock %}
{% block content %}

{% if auth.isAdmin == true %}
<div class="row">
  <div class="col s12">
    <h3>{% if auth.isAdmin == true %}Add{%endif%} Workshops</h3>
    <form action="{{ urlFor('workshops.add') }}" method="post" autocomplete="off">
    <p>Workshop Name (include time: e.g. Greenfoot workshop (8 PM))</p>
    <input type="text" name="workshop">
    <p>Tools Needed (e.g. Chrome, FTP)</p>
    <input type="text" name="tools">
    <p>Description</p>
    <input type="text" name="desc">
    <p>Max amount of people</p>
    <input type="text" name="max">
    <input type="submit" class="btn">           
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </form>
  </div>
</div>
{% endif %}
<div class="row">
  <div class="col s12">
  {% for item in list %}
         {%if loop.index0 % 3 == 0%}
        </div>
          <div class="row">
            <div class="">
              <div class="buffer" style="height: 20px;"></div>
            </div>
          </div>
        <div class="row">
        {% endif %}
    <div class="col s12 m4 l4">
    <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">{{item.workshop}} <br>{{item.count}} signed up<a><i class="fa fa-link" style="padding-top: 10px;"> View All in workshop</a></i></span>
      <p>Description of Workshop: {{item.desc}}</p>
      <p>Tools needed: {{item.tools}}</p>
      <p>Current number in workshop out of max: {{item.count}}/{{item.max}}</p>
    {% set foo = "false" %}
    {% for join in joined %}
      {% if join.workshop_id == item.id %}
            {% if join.user_id == auth.username %}
               {% set foo = "true" %}
                You have already joined this shift. Do you want to leave it? <br><a href="{{ urlFor('workshop.leave', {id:item.id} )}}" id="leave" class="btn z-depth-0">LEAVE</a>
            {% endif %}
          {% endif %}
        {% endfor %}
        
        {% if foo == "false" %} 
        <br>
         <script>
        // function signup() {
        //    $.ajax({
        //      type: "POST",
        //      url: "{{ urlFor('shifts.signup') }}",
        //      data: {id:{{item.id}}},
        //      success: function(response) {
        //        Materialize.toast(response, 4000);
        //        $("#signup{{item.id}}").css("display","none");
        //      },
        //      error: function() {
        //        alert("not working!");
        //      }
        //    });
        //  }
        // </script>
              <a href="{{ urlFor('workshops.signup', {id:item.id} )}}" class="btn z-depth-0">Sign Up for this WOrkshop</a>
{#              <a onClick="signup()" id="signup{{item.id}}" class="btn z-depth-0">Sign Up for this shift</a>
 #}       {% endif %}
        {% if auth.isAdmin == true %}<br><br><a href="{{ urlFor('workshops.delete', {id:item.id}) }}" class="btn z-depth-0 red">Delete Workshop</a><br>{% endif %}
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Users<i class="fa fa-times right"></i></span>
      <p>{% for join in joined %}
      {% if join.workshop_id == item.id %}
        <a href="{{urlFor('user.profile', {username: join.user_id}) }}">{{join.user_id}}</a> in {{item.workshop}}<br>
      {% endif %}
    {% endfor %}</p>
    </div>
  </div></div>
   {% endfor %}
      
  
    <br>
    </div>
   
</div>
{% endblock %}
