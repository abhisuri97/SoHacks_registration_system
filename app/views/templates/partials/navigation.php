
<ul id="nav-mobile" class="side-nav fixed">
	<li class="logo">
		<a id="logo-container" href="/register" class="brand-logo">
    		<img src="/styles/img/logo2.jpg" width="100%">
    	</a>
    </li>
	<li >
		<a href="{{ urlFor('home') }}"><i class="fa fa-home fa-lg"></i> Home</a>
	</li>
	{% if auth %}
		<li><a class="modal-trigger" href="#modal1"> <i class="fa fa-list-ol fa-lg"></i> To Do <span class="new badge todonotif" style="line-height: 21px; margin-top: 11px; background-color: #F79E21"></span></a></li>
		<li ><a href="{{ urlFor('workshops') }}"><i class="fa fa-graduation-cap fa-lg"></i> Workshops</a></li>
		<li ><a href="{{ urlFor('resources') }}"><i class="fa fa-graduation-cap fa-lg"></i> Resources</a></li>

		{% if auth.isAdmin == false %}

		<li>
			<a href="{{ urlFor('account.profile')}}"><i class="fa fa-file-text-o fa-lg"></i>
				{% if auth.is_notified == 0 %}
					Registration Form
				{% else %}
					Edit Your Details
				{% endif %}
			</a>
		</li>
		<li>
			<a href="{{ urlFor('invite')}}"><i class="fa fa-envelope-o fa-lg"></i> Invite</a>
		</li>
		<li>
			<a href="{{ urlFor('password.change')}}"><i class="fa fa-unlock-alt fa-lg"></i> Change Password</a>
		</li>
		<li>
			<a href="{{ urlFor('user.profile', {username: auth.username})}}"><i class="fa fa-user fa-lg"></i> View Public Profile</a>
		</li>
			{% if auth.isActive==false %}
				<li>
					<a href="{{ urlFor('resend') }}"><i class="fa fa-exclamation-triangle fa-lg"></i> <b>RESEND ACTIVATION</b></a>
				</li>
			{% endif %}
			{% if auth.is_notified %}
				<li >
					<a href="{{ urlFor('decision') }}"><i class="fa fa-exclamation-circle fa-lg"></i> Decision</a>
				</li>
			{% endif %}
			{% if (auth.is_attending)%}
				{% if auth.role=="attendee" %}
		<!-- 	<li ><a href="#"><i class="fa fa-link fa-lg"></i> Resources</a></li>
		 -->	<li >
		 			<a href="{{ urlFor('team')}}"><i class="fa fa-users fa-lg"></i> Team</a>
		 		</li>
		<!-- 	<li ><a href="#"><i class="fa fa-book fa-lg"></i> Workshops</a></li>
				
		 -->	
		 		{% endif %}
		 		<li >
		 			<a href="{{ urlFor('sign') }}"><i class="fa fa-files-o fa-lg"></i> Forms</a>
		 		</li>
		 	{% endif %}
			{% if (auth.is_attending and auth.role=="mentor")%}
		 		{# <li >
		 			<a href="#"><i class="fa fa-link fa-lg"></i> Resources (coming soon)</a>
		 		</li>
	 			<li >
	 				<a href="#"><i class="fa fa-clock-o fa-lg"></i> Reserve Times (coming soon)</a>
	 			</li> #}
			{% endif %}
			{% if (auth.is_attending and (auth.role=="volunteer" or auth.role=="mentor"))%}
				<li ><a href="{{ urlFor('shifts') }}"><i class="fa fa-clock-o fa-lg"></i> Shifts</a></li>
			{% endif %}


		{% else %}
				<li >
		 			<a href="{{ urlFor('notice') }}"><i class="fa fa-envelope-o fa-lg"></i> Send Notice</a>
		 		</li>
				<li >
		 			<a href="{{ urlFor('shifts') }}"><i class="fa fa-clock-o fa-lg"></i> Set Shift Times</a>
		 		</li>
			<li class="no-padding">
				<ul class="collapsible collapsible-accordion">
					<li>
						<a class="collapsible-header">Attendees<i class="mdi-navigation-arrow-drop-down" style="float:right"></i></a>
						<div class="collapsible-body">
							<ul>
								<li >
									<a href="{{ urlFor('admin.admit') }}">Admit Attendees</a>
								</li>
								<li >
									<a href="{{ urlFor('admitted') }}">View Admitted</a>
								</li>
								<li >
									<a href="{{ urlFor('denied') }}">View Denied</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li class="no-padding">
				<ul class="collapsible collapsible-accordion">
					<li>
						<a class="collapsible-header">Volunteers<i class="mdi-navigation-arrow-drop-down" style="float:right"></i></a>
						<div class="collapsible-body">
							<ul>
								<li >
									<a href="{{ urlFor('admin.volunteer.admit') }}">Admit Volunteers</a>
								</li>
								<li >
									<a href="{{ urlFor('volunteer.admitted') }}">View Admitted</a>
								</li>
								<li >
									<a href="{{ urlFor('volunteer.denied') }}">View Denied</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li class="no-padding">
				<ul class="collapsible collapsible-accordion">
					<li>
						<a class="collapsible-header">Mentors<i class="mdi-navigation-arrow-drop-down" style="float:right"></i></a>
						<div class="collapsible-body">
							<ul>
								<li >
									<a href="{{ urlFor('admin.mentor.admit') }}">Admit Mentors</a>
								</li>
								<li >
									<a href="{{ urlFor('mentor.admitted') }}">View Admitted</a>
								</li>
								<li >
									<a href="{{ urlFor('mentor.denied') }}">View Denied</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
		{% endif %}
	{% else %}
	{% endif %}
	{% if auth %}
	

  
	<li ><a href="{{ urlFor('logout') }}"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
	<li ><b> {{auth.getFullNameOrUsername}}</b></li>
	<li ><img src="{{ auth.getAvatarUrl({size: 30}) }}" class="avatar-small"></li>

</ul>

	{% endif %}
	<script>
	var pathname = window.location.pathname;
	$('li').find('a').each(function(e) {
	if(pathname == $(this).attr('href')) {
		    if($(this).parent().parent().attr('id') == "nav-mobile") {
		    	$(this).parent().addClass('active')
			}
			if($(this).parent().parent().parent().attr('class') == "collapsible-body") {
		    	$(this).parent().addClass('active');
		    	$(this).parent().parent().parent().prev().addClass('active');
		    	$(this).parent().parent().parent().css({ display: "block !important" });
			}		
	}});
  $(".button-collapse").sideNav();
  $('.collapsible').collapsible();

	</script>

<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>TO DO LIST</h4>
      <br>
      <ul class="collection">
		{% if auth.is_attending %}
		<li class="collection-item todo">Fill out necessary forms for the event (at the forms tab) if you are 18 or younger. {% if auth.is_signed %} <b class="finish">DONE</b> {%endif%}</li>
		{% if auth.role == "2" %}<li class="collection-item todo"> Find team members and register your team under the teams tab (at the teams tab){% if auth.is_team %} <b class="finish">DONE</b> {%endif%}{%endif%}</li>
{# 		<li class="todo">Explore some of our mentor resources prior to the event (resources tab)</li>
 #}		{# <li class="todo">Register for Workshops in advance</li> #}
		<li class="collection-item todo">Think about a hack to do/help with</li>
		{% endif %}
		{% if auth %}
		<li class="collection-item todo"><a href="{{urlFor('invite')}}"><b>Send Invites to some friends</b></a> (sent to {{auth.invited}} friends so far) {%endif%} {% if auth.invited > 0%} <b class="finish">DONE</b> {%endif%}</li>
		<li class="collection-item todo"><a href="{{urlFor('register')}}">Register</a> for an account {% if auth %} <b class="finish">DONE</b> {%endif%}</li>
		<li class="collection-item todo"><a href="{{urlFor('login')}}">Login</a> {% if auth %} <b class="finish">DONE</b> {%endif%}</li>
		{% if auth %}
			<li class="collection-item todo">Change your profile picture <a href="{{urlFor('user.profile', {username: auth.username})}}">here</a> {% if auth.profpic %} <b class="finish">DONE</b> {%endif%}</li>{%endif%}
		<li class="collection-item todo">Be sure to activate your account! Check your inbox for messages from register@sohacks.com {% if auth.active %} <b class="finish">DONE</b> {%endif%}</li>
		<li class="collection-item todo">Complete your application {% if auth.is_submitted %} <b class="finish">DONE</b> {%endif%}</li>
	</ul>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action btn modal-close waves-effect waves-green btn-flat ">Close</a>
    </div>
  </div>

	
	<script>
	var i =0;
	var j = 0;
	$('li').each(function(e) {
		if($(this).find('b').hasClass("finish")) {
			i++;
			$(this).css("opacity",".1");
		}
		if($(this).hasClass("todo")) {
			j++;
		}
	});
	$('.todonotif').text(j-i);
	$('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
    }
  );
	</script>