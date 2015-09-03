{% extends 'templates/default.php' %}

{% block title %}Registration{% endblock %}

{% block content %}
	<form action="{{ urlFor('account.profile.post') }}" method="post" autocomplete="off">
		<h2>Registration/Application</h2>
		{% if auth.active==false %}
		Unfortunately you're account is not activated at this time. Please click the activate account link in the navigation bar above to send an email to acivate your account.
		{% endif %}
		{% if auth.is_submitted %} <p>This application has been marked as <b>submitted</b> and has been sent to our attendee review committee. We will send you an email when anything changes. <br>
		You may still change the form if you want to; however, there is no guarantee that our committee will review the updated changes. Thank you for your cooperation.</p> 
		{% elseif auth.is_submitted==false %} <p>This application is a quick way for us to get a sense of who is interested in SoHacks this year. Chances are that we will be accepting everyone who applies, but in the case that we need to restrict attendance to a certain amount of people, we will use this application. <br>
		We are <b>"experience blind"</b>, regardless of your programming experience (from none to expert) we will accept you based on interest in the event.</p>
		{%endif %}
		{%if (auth.role=="mentor" or auth.role=="volunteer") %}

			<h4><b>Mentors and Volunteers</b><br>IF YOU ARE 18 OR OLDER, YOU MUST COMPLETE A BACKGROUND CHECK</h4>
			<p>In order to ensure the safety of our attendees other participants, we require that all legal adults must submit a background check. Please click the button below and fill out the form.</p>
			<p>Under "Name of Organization you a requesting this background check for" type in <b>Apps for Aptitude</b>. We will only allow you admittance into the event, once we have confirmed your background check has passed. 
			Please adjust fields in this form so it matches corresponding fields in the background check form. Thank you for your cooperation.</p>
			<a href="https://www.backgroundchecksforvolunteers.com/applicant-center.html" class="btn red">Click here to complete background check (goes to external link)</a>
			{% endif %}
		 <br>
		 <style>
		 	p {
		 		font-weight: 400;
		 		color:#000;
		 	}
		 </style>
		 						<div class="row">
									{% if (errors) %}
								        <div class="col s12">
								          <div class="card red lighten-2">
								            <div class="card-content white-text loginerror">
								              {%if errors.has('email')%}<div class="alert alert-info">{{errors.first('email')}}</div>{%endif%}
					{%if errors.has('first_name')%}<div class="alert alert-info">First Name must be alphabetic</div>{%endif%}
					{%if errors.has('last_name')%}<div class="alert alert-info">Last Name must be alphabetic</div>{%endif%}
					{%if errors.has('zip')%}<div class="alert alert-info">{{errors.first('zip')}}</div>{%endif%}
					{%if errors.has('state')%}<div class="alert alert-info">State must be a maximum of 2 characters</div>{%endif%}
								            </div>
								          </div>
								        </div>
							        {% endif %}
      							</div>
		 			

				<div>

				{% if auth.active %}
		<h4>Demographic Information</h4>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="email" id="email" value="{{ request.post('email') ? request.post('email') : auth.email }}">
				<label for="email">Email</label>			
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<label for="first_name">First Name</label>
				<input type="text" name="first_name" id="first_name" value="{{ request.post('first_name') ? request.post('first_name') : auth.first_name }}">
			</div>
			<div class="input-field col s6">
				<label for="last_name">Last Name</label>
				<input type="text" name="last_name" id="last_name" value="{{ request.post('last_name') ? request.post('last_name') : auth.last_name }}">
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<label for="phone">Phone Number {% if auth.role == "attendee" %}(Emergency Contact){%endif%}</label>
				<input type="text" name="phone" id="phone" value="{{ request.post('phone') ? request.post('phone') : auth.phone }}">
			</div>
			<div class=" input-field col s6">
				<label for="mf">Gender</label><br>
				<input type="radio" name="gender" id="gender" value="male" {% if request.post('gender')=="male" %} checked {% elseif auth.gender=="male" %} checked {% endif %}>
				<label for="gender">Male</label>&nbsp;&nbsp;&nbsp;
				<input type="radio" name="gender" id="gender2" value="female" {% if request.post('gender')=="female" %} checked {% elseif auth.gender=="female" %} checked {% endif %}>
				<label for="gender2">Female</label>&nbsp;&nbsp;&nbsp;
				<input type="radio" name="gender" id="gender3" value="other" {% if request.post('gender')=="other" %} checked {% elseif auth.gender=="other" %} checked {% endif %}>
				<label for="gender3">Other</label><br>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
			<label for="address">Street Address</label>
			<input class="u-full-width" type="text" name="address" id="address" value="{{ request.post('address') ? request.post('address') : auth.address }}">
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
			<label for="city">City</label>
			<input class="u-full-width" type="text" name="city" id="city" value="{{ request.post('city') ? request.post('city') : auth.city }}">
		</div>
		</div>
		<div class="row">
			<div class="col s12">

			<label for="state">State<br>
			If you are outside of the United States, please select the "INTERNATIONAL" option in the dropdown menu below.</label>
			<select class="u-full-width" name="state" id="state">
					<option>Please Select One</option>
					<option value="INT" {% if request.post('state')=="INT" %} selected="selected" {% elseif auth.state=="INT" %} selected="selected" {% endif %}>INTERNATIONAL</option>
					<option value="AL" {% if request.post('state')=="AL" %} selected="selected" {% elseif auth.state=="AL" %} selected="selected" {% endif %}>Alabama</option>
					<option value="AK" {% if request.post('state')=="AK" %} selected="selected" {% elseif auth.state=="AK" %} selected="selected" {% endif %}>Alaska</option>
					<option value="AZ" {% if request.post('state')=="AZ" %} selected="selected" {% elseif auth.state=="AZ" %} selected="selected" {% endif %}>Arizona</option>
					<option value="AR" {% if request.post('state')=="AR" %} selected="selected" {% elseif auth.state=="AR" %} selected="selected" {% endif %}>Arkansas</option>
					<option value="CA" {% if request.post('state')=="CA" %} selected="selected" {% elseif auth.state=="CA" %} selected="selected" {% endif %}>California</option>
					<option value="CO" {% if request.post('state')=="CO" %} selected="selected" {% elseif auth.state=="CO" %} selected="selected" {% endif %}>Colorado</option>
					<option value="CT" {% if request.post('state')=="CT" %} selected="selected" {% elseif auth.state=="CT" %} selected="selected" {% endif %}>Connecticut</option>
					<option value="DE" {% if request.post('state')=="DE" %} selected="selected" {% elseif auth.state=="DE" %} selected="selected" {% endif %}>Delaware</option>
					<option value="DC" {% if request.post('state')=="DC" %} selected="selected" {% elseif auth.state=="DC" %} selected="selected" {% endif %}>District Of Columbia</option>
					<option value="FL" {% if request.post('state')=="FL" %} selected="selected" {% elseif auth.state=="FL" %} selected="selected" {% endif %}>Florida</option>
					<option value="GA" {% if request.post('state')=="GA" %} selected="selected" {% elseif auth.state=="GA" %} selected="selected" {% endif %}>Georgia</option>
					<option value="HI" {% if request.post('state')=="HI" %} selected="selected" {% elseif auth.state=="HI" %} selected="selected" {% endif %}>Hawaii</option>
					<option value="ID" {% if request.post('state')=="ID" %} selected="selected" {% elseif auth.state=="ID" %} selected="selected" {% endif %}>Idaho</option>
					<option value="IL" {% if request.post('state')=="IL" %} selected="selected" {% elseif auth.state=="IL" %} selected="selected" {% endif %}>Illinois</option>
					<option value="IN" {% if request.post('state')=="IN" %} selected="selected" {% elseif auth.state=="IN" %} selected="selected" {% endif %}>Indiana</option>
					<option value="IA" {% if request.post('state')=="IA" %} selected="selected" {% elseif auth.state=="IA" %} selected="selected" {% endif %}>Iowa</option>
					<option value="KS" {% if request.post('state')=="KS" %} selected="selected" {% elseif auth.state=="KS" %} selected="selected" {% endif %}>Kansas</option>
					<option value="KY" {% if request.post('state')=="KY" %} selected="selected" {% elseif auth.state=="KY" %} selected="selected" {% endif %}>Kentucky</option>
					<option value="LA" {% if request.post('state')=="LA" %} selected="selected" {% elseif auth.state=="LA" %} selected="selected" {% endif %}>Louisiana</option>
					<option value="ME" {% if request.post('state')=="ME" %} selected="selected" {% elseif auth.state=="ME" %} selected="selected" {% endif %}>Maine</option>
					<option value="MD" {% if request.post('state')=="MD" %} selected="selected" {% elseif auth.state=="MD" %} selected="selected" {% endif %}>Maryland</option>
					<option value="MA" {% if request.post('state')=="MA" %} selected="selected" {% elseif auth.state=="MA" %} selected="selected" {% endif %}>Massachusetts</option>
					<option value="MI" {% if request.post('state')=="MI" %} selected="selected" {% elseif auth.state=="MI" %} selected="selected" {% endif %}>Michigan</option>
					<option value="MN" {% if request.post('state')=="MN" %} selected="selected" {% elseif auth.state=="MN" %} selected="selected" {% endif %}>Minnesota</option>
					<option value="MS" {% if request.post('state')=="MS" %} selected="selected" {% elseif auth.state=="MS" %} selected="selected" {% endif %}>Mississippi</option>
					<option value="MO" {% if request.post('state')=="MO" %} selected="selected" {% elseif auth.state=="MO" %} selected="selected" {% endif %}>Missouri</option>
					<option value="MT" {% if request.post('state')=="MT" %} selected="selected" {% elseif auth.state=="MT" %} selected="selected" {% endif %}>Montana</option>
					<option value="NE" {% if request.post('state')=="NE" %} selected="selected" {% elseif auth.state=="NE" %} selected="selected" {% endif %}>Nebraska</option>
					<option value="NV" {% if request.post('state')=="NV" %} selected="selected" {% elseif auth.state=="NV" %} selected="selected" {% endif %}>Nevada</option>
					<option value="NH" {% if request.post('state')=="NH" %} selected="selected" {% elseif auth.state=="NH" %} selected="selected" {% endif %}>New Hampshire</option>
					<option value="NJ" {% if request.post('state')=="NJ" %} selected="selected" {% elseif auth.state=="NJ" %} selected="selected" {% endif %}>New Jersey</option>
					<option value="NM" {% if request.post('state')=="NM" %} selected="selected" {% elseif auth.state=="NM" %} selected="selected" {% endif %}>New Mexico</option>
					<option value="NY" {% if request.post('state')=="NY" %} selected="selected" {% elseif auth.state=="NY" %} selected="selected" {% endif %}>New York</option>
					<option value="NC" {% if request.post('state')=="NC" %} selected="selected" {% elseif auth.state=="NC" %} selected="selected" {% endif %}>North Carolina</option>
					<option value="ND" {% if request.post('state')=="ND" %} selected="selected" {% elseif auth.state=="ND" %} selected="selected" {% endif %}>North Dakota</option>
					<option value="OH" {% if request.post('state')=="OH" %} selected="selected" {% elseif auth.state=="OH" %} selected="selected" {% endif %}>Ohio</option>
					<option value="OK" {% if request.post('state')=="OK" %} selected="selected" {% elseif auth.state=="OK" %} selected="selected" {% endif %}>Oklahoma</option>
					<option value="OR" {% if request.post('state')=="OR" %} selected="selected" {% elseif auth.state=="OR" %} selected="selected" {% endif %}>Oregon</option>
					<option value="PA" {% if request.post('state')=="PA" %} selected="selected" {% elseif auth.state=="PA" %} selected="selected" {% endif %}>Pennsylvania</option>
					<option value="RI" {% if request.post('state')=="RI" %} selected="selected" {% elseif auth.state=="RI" %} selected="selected" {% endif %}>Rhode Island</option>
					<option value="SC" {% if request.post('state')=="SC" %} selected="selected" {% elseif auth.state=="SC" %} selected="selected" {% endif %}>South Carolina</option>
					<option value="SD" {% if request.post('state')=="SD" %} selected="selected" {% elseif auth.state=="SD" %} selected="selected" {% endif %}>South Dakota</option>
					<option value="TN" {% if request.post('state')=="TN" %} selected="selected" {% elseif auth.state=="TN" %} selected="selected" {% endif %}>Tennessee</option>
					<option value="TX" {% if request.post('state')=="TX" %} selected="selected" {% elseif auth.state=="TX" %} selected="selected" {% endif %}>Texas</option>
					<option value="UT" {% if request.post('state')=="UT" %} selected="selected" {% elseif auth.state=="UT" %} selected="selected" {% endif %}>Utah</option>
					<option value="VT" {% if request.post('state')=="VT" %} selected="selected" {% elseif auth.state=="VT" %} selected="selected" {% endif %}>Vermont</option>
					<option value="VA" {% if request.post('state')=="VA" %} selected="selected" {% elseif auth.state=="VA" %} selected="selected" {% endif %}>Virginia</option>
					<option value="WA" {% if request.post('state')=="WA" %} selected="selected" {% elseif auth.state=="WA" %} selected="selected" {% endif %}>Washington</option>
					<option value="WV" {% if request.post('state')=="WV" %} selected="selected" {% elseif auth.state=="WV" %} selected="selected" {% endif %}>West Virginia</option>
					<option value="WI" {% if request.post('state')=="WI" %} selected="selected" {% elseif auth.state=="WI" %} selected="selected" {% endif %}>Wisconsin</option>
					<option value="WY" {% if request.post('state')=="WY" %} selected="selected" {% elseif auth.state=="WY" %} selected="selected" {% endif %}>Wyoming</option>
			</select>
		</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
			<label for="zip">Zip Code (5 digit)</label>
			<input class="u-full-width" type="text" name="zip" id="zip" value="{{ request.post('zip') ? request.post('zip') : auth.zip }}">
		</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
			<label for="school">School{% if (auth.role == "mentor" or auth.role == "volunteer") %}/Current place of work (if you are volunteering/mentoring as part of a company please type that company here){% endif %}</label>
			<input class="u-full-width" type="text" name="school" id="school" value="{{ request.post('school') ? request.post('school') : auth.school }}">
		</div>
	</div>
		<div class="row">
			<div class="input-field col s12">
			<label for="age">Age</label>
			<input class="u-full-width" type="text" name="age" id="age" value="{{ request.post('age') ? request.post('age') : auth.age }}">
		</div>
	</div>
		{% if auth.role=="attendee"%}
		<div class="row">
			<div class="col s12">

			
			<p>What grade will you be entering in the 2015-2016 school year?<br>(Note: if the option best answering the question is not available, please email <a href="mailto:contact@sohacks.com">contact@sohacks.com</a>).</p>
			<input type="radio" name="grade" id="grade1" value="9th" {% if request.post('grade')=="9th" %} checked {% elseif auth.grade=="9th" %} checked {% endif %}>
			<label for="grade1">9th</label><br>
			<input type="radio" name="grade" id="grade2" value="10th" {% if request.post('grade')=="10th" %} checked {% elseif auth.grade=="10th" %} checked {% endif %}>
			<label for="grade2">10th</label><br>
			<input type="radio" name="grade" id="grade3" value="11th" {% if request.post('grade')=="11th" %} checked {% elseif auth.grade=="11th" %} checked {% endif %}>
			<label for="grade3">11th</label><br>
			<input type="radio" name="grade" id="grade4" value="12th" {% if request.post('grade')=="12th" %} checked {% elseif auth.grade=="12th" %} checked {% endif %}>
			<label for="grade4">12th</label><br>
			<input type="radio" name="grade" id="grade5" value="fresh" {% if request.post('grade')=="fresh" %} checked {% elseif auth.grade=="fresh" %} checked {% endif %}>
			<label for="grade5">Freshman Year College/1st year after graduation</label><br>
		</div>
	</div>
		{%endif %}
		<div class="row">
			<div class="col s6">
			<p>T-Shirt size <br>(for higher or lower sizes, please email <a href="mailto:contact@sohacks.com">contact@sohacks.com</a>).</p>
			<input type="radio" name="tshirt" id="tshirt1" value="XS" {% if request.post('tshirt')=="XS" %} checked {% elseif auth.tshirt=="XS" %} checked {% endif %}><label for="tshirt1">XS</label><br>
			<input type="radio" name="tshirt" id="tshirt2" value="S" {% if request.post('tshirt')=="S" %} checked {% elseif auth.tshirt=="S" %} checked {% endif %}><label for="tshirt2">S</label><br>
			<input type="radio" name="tshirt" id="tshirt3" value="M" {% if request.post('tshirt')=="M" %} checked {% elseif auth.tshirt=="M" %} checked {% endif %}><label  for="tshirt3">M</label><br>
			<input type="radio" name="tshirt" id="tshirt4" value="L" {% if request.post('tshirt')=="L" %} checked {% elseif auth.tshirt=="L" %} checked {% endif %}><label for="tshirt4">L</label ><br>
			<input type="radio" name="tshirt" id="tshirt5" value="XL" {% if request.post('tshirt')=="XL" %} checked {% elseif auth.tshirt=="XL" %} checked {% endif %}><label for="tshirt5">XL</label><br>
			<input type="radio" name="tshirt" id="tshirt6" value="XXL" {% if request.post('tshirt')=="XXL" %} checked {% elseif auth.tshirt=="Native American" %} checked {% endif %}><label for="tshirt6">XXL</label>

		</div>
	
			<div class="col s6">
			<p>Race<br>(If you prefer not to answer, please mark the last option).</p>
			<input type="radio" name="race" id="race1" value="white" {% if request.post('race')=="white" %} checked {% elseif auth.race=="white" %} checked {% endif %}><label for="race1">White/Caucasian</label><br>
			<input type="radio" name="race" id="race2" value="hispanic" {% if request.post('race')=="hispanic" %} checked {% elseif auth.race=="hispanic" %} checked {% endif %}><label for="race2">Hispanic</label><br>
			<input type="radio" name="race" id="race3" value="asian" {% if request.post('race')=="asian" %} checked {% elseif auth.race=="asian" %} checked {% endif %}><label for="race3">Asian</label><br>
			<input type="radio" name="race" id="race4" value="black" {% if request.post('race')=="black" %} checked {% elseif auth.race=="black" %} checked {% endif %}><label for="race4">African American/Black</label><br>
			<input type="radio" name="race" id="race5" value="islander" {% if request.post('race')=="islander" %} checked {% elseif auth.race=="islander" %} checked {% endif %}><label for="race5">Pacific Islander/Native Hawaiian</label><br>
			<input type="radio" name="race" id="race6" value="native" {% if request.post('race')=="native" %} checked {% elseif auth.race=="native" %} checked {% endif %}><label for="race6">Native American</label><br>
			<input type="radio" name="race" id="race7" value="optout" {% if request.post('race')=="optout" %} checked {% elseif auth.race=="optout" %} checked {% endif %}><label for="race7">I prefer not to answer</label>
		</div></div>
		<div class="row">
			<div class="input-field col s12">
			<input type="text" name="allergies" id="proj">{{ request.post('allergies') ? request.post('allergies') : auth.allergies }}
						<label for="allergies">Do you have any allergies we should know about?</label>

		</div>
		
		{% if auth.is_submitted %}<input type="submit" name="save" value="Save">{%endif%}
		<br><br><br><br>
		<div class="row">
			<div class="col s12">
		<h4>Programming Related Questions</h4>
		{% if auth.is_submitted %}
		<p>This part of the application cannot be accessed after your form submission. Email <a href="mailto:contact@sohacks.com">contact@sohacks.com</a> if you have any more questions or would like your application to be reopened.</p>
		{%endif%}
	</div></div>
		{% if auth.is_submitted==false %}
		<div class="row">
			<div class="col s12">
			<p>Did you attend SoHacks in 2014?</p>
			<input type="radio" name="sohacks" id="sohacks" value="1" {% if request.post('sohacks')=="1" %} checked {% elseif auth.sohacks =="1" %} checked {% endif %}><label for="sohacks">Yes</label><br>
			<input type="radio" name="sohacks" id="sohacks1" value="0" {% if request.post('sohacks')=="0" %} checked {% elseif auth.sohacks =="0" %} checked {% endif %}><label for="sohacks1">No</label>
		</div>
		</div>
		<div class="row">
			<div class="col s12">
			<p>Have you attended a hackathon before?</p>
			<input type="radio" name="hack" id="hack2" value="1" {% if request.post('hack')=="1" %} checked {% elseif auth.hack =="1" %} checked {% endif %}><label for="hack2">Yes</label><br>
			<input type="radio" name="hack" id="hack3" value="0" {% if request.post('hack')=="0" %} checked {% elseif auth.hack =="0" %} checked {% endif %}><label for="hack3">No</label>
		</div>
		</div>
		<div class="row">
			<div class="col s12">
			<p>How comfortable are you with programming?</p>
			<input type="radio" name="prog" id="prog1" value="none" {% if request.post('prog')=="none" %} checked {% elseif auth.prog =="none" %} checked {% endif %}><label for="prog1">No experience whatsoever</label><br>
			<input type="radio" name="prog" id="prog2" value="some" {% if request.post('prog')=="some" %} checked {% elseif auth.prog =="some" %} checked {% endif %}><label for="prog2">Somewhat experienced (e.g. have worked with robotics, made a basic website)</label><br>
			<input type="radio" name="prog" id="prog3" value="very" {% if request.post('prog')=="very" %} checked {% elseif auth.prog =="very" %} checked {% endif %}><label for="prog3">Very experienced (e.g. have taken a CS course at school, made a full project)</label><br>
			<input type="radio" name="prog" id="prog4" value="super" {% if request.post('prog')=="super" %} checked {% elseif auth.prog =="super" %} checked {% endif %}><label for="prog4">Super experienced (e.g. done internships, won prizes at hackathons, taken college CS courses)</label>
		</div>
		</div>
		<div class="row">
			<div class="col s12">
			<p>{% if auth.role=="attendee" %}Do you know any programming languages? Please list the top 3 languages that you know (it's fine to leave these blank).</p>
			<input class="u-full-width" type="text" name="lang1" id="lang1" value="{{ request.post('lang1') ? request.post('lang1') : auth.lang1 }}">
			<input class="u-full-width" type="text" name="lang2" id="lang2" value="{{ request.post('lang2') ? request.post('lang2') : auth.lang2 }}">
			<input class="u-full-width" type="text" name="lang3" id="lang3" value="{{ request.post('lang3') ? request.post('lang3') : auth.lang3 }}">
			{%endif %}
		</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
			{% if auth.role=="mentor"%}
			<label>List any programming languages/concepts you know that you would feel comfortable teaching to others. Separate each subject area by a comma (e.g. html,css,js,php,mysql).</label>
			<textarea class="materialize-textarea" type="text" name="langs" id="proj">{{ request.post('langs') ? request.post('langs') : auth.langs }}</textarea>
			{%endif%}
		</div>
		</div>
		<div class="row">
			<div class="col s12">
			{% if auth.role=="attendee"%}
			<p>Why do you want to come to SoHacks?<br> If the School's Out Hackathon will be the first time you make a programming project, tell us what you want to make.
			If you have made projects before, please feel free to link them here and provide a brief description. If you are planning to request a travel reimbursement, telling us about your past experience will help you have a better chance of getting one.</p>
			{% endif %}
			{% if auth.role=="mentor"%}
			<label for="proj">Please tell us about any prior experience you have with programming. Feel free to list projects as well.</p></label>
			{%endif%}
			{% if (auth.role=="mentor" or auth.role=="attendee")%}<textarea class="materialize-textarea" type="text" name="proj" id="proj">{{ request.post('proj') ? request.post('proj') : auth.proj }}</textarea>{%endif%}
		</div>
		</div>
		<div class="row">
			<div class="col s12">
			{%if auth.role=="attendee"%}
			<p>Do you have a team set for the event? <br>Teams are comprised of up to 4 individuals. If you choose "No", we will add your contact information and basic information to a page where you can connect with other people searching for team members.</p>
			<input type="radio" name="team" id="team" value="1" {% if request.post('team')=="1" %} checked {% elseif auth.team =="1" %} checked {% endif %}><label for="team">Yes</label><br>
			<input type="radio" name="team" id="team1" value="0" {% if request.post('team')=="0" %} checked {% elseif auth.team =="0" %} checked {% endif %}><label for="team1">No</label>
			{% endif %}
		</div>
	</div>
		<div class="row">
			<div class="col s12">
			{% if auth.role=="attendee"%}
			<p>Do you need a laptop?<br>While we do offer the option to provide laptops for some participants, the amount we have available is limited. If you have a laptop, you should bring it to the event.</p>
			<input type="radio" name="laptop" id="laptop" value="1" {% if request.post('laptop')=="1" %} checked {% elseif auth.laptop =="1" %} checked {% endif %}>
			<label for="laptop">Yes</label><br>
			<input type="radio" name="laptop" id="laptop1" value="0" {% if request.post('laptop')=="0" %} checked {% elseif auth.laptop =="0" %} checked {% endif %}>
			<label for="laptop1">No</label>
			{% endif %}
		</div>
		</div>
		<div class="row">
			<div class="col s12">
			{% if (auth.role=="attendee" or auth.role=="mentor")%}
			<p>This year, we are continuing our tradition of providing travel reimbursements to individuals who need them. <br>We are unable to determine the exact amount of reimbursement we can give, but we will try our best to reimburse individuals whose travel costs are greater than $100. 
			All recipients of travel reimbursements will have to bring a receipt of purchase as proof. If you feel this describes you, please put enter the amount of money you will need (SoHacks is from August 7-8, so plan accordingly). <b>Otherwise, leave this space blank.</b> </p>
			<input type="text" name="travel" id="travel" value="{{ request.post('travel') ? request.post('travel') : auth.travel }}">
			{% endif %}
		</div>
		</div>
		<div class="height" style="height:200px"></div>
		{% endif %}
		</div>
		<style>
		input[type="submit"]
{
    border:0px solid red;
    text-decoration:none;
    font-family:roboto;
    color:white;
    background: transparent;
    font-style: normal;
    font-size: 16px;
    padding:20px;
}
input[type="radio"]:checked + label:after{
    background-color:#F79E21;
    border-color:#F79E21;
}

		</style>
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
			{% if auth.is_submitted==false %}
			<div class="meh z-depth-2" style="position: fixed; bottom: 0; background: #FFF; height: 100px; width:100vw; left:0" >
			<input class="waves-effect waves-light orange" type="submit" name="save" style="position: fixed; bottom: 25px; right: 225px" value="Save">
			 <input class="waves-effect waves-light red lighten-1" type="submit" name="submit" style="position: fixed; bottom: 25px; right: 100px" value="Submit">
			</div>
        	{% endif %}
        	{% if auth.is_submitted==true %}
			<div class="meh z-depth-2" style="position: fixed; bottom: 0; background: #FFF; height: 100px; width:100vw; left:0" >
			<input class="waves-effect waves-light orange" type="submit" name="save" style="position: fixed; bottom: 25px; right: 225px" value="Update Info">
			</div>
        	{% endif %}
			
		</div>
	</form>
	{% endif %}

{% endblock %}