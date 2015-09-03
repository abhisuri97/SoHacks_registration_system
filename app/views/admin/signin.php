{% extends 'templates/default.php' %}

{% block title %}Signin{% endblock %}
{% block content %}

		<script>
	var MIN_LENGTH = 1;
$( document ).ready(function() {
	$("#keyword").keyup(function() {
		var keyword = $("#keyword").val();
		if (keyword.length >= MIN_LENGTH) {
			$.post( "{{ urlFor('signininfo')}}", { keyword: keyword } )
			.done(function( data ) {
				$('#results').html('');
				var results = jQuery.parseJSON(data);
				var count = 0;
				$(results).each(function(key, value) {
					var test = value.split("____");
					$('#results').append('<div class="item"><a href="/register/s/'+ test[0] + '"> ' + test[0] + '</a> (' +test[1] + ' '+ test[2] + ')'+ '</div>');
					count++;
				});
				if(count==0) {
					$('#results').append('<div class="item"><a href="/register/new">Add User</a></div>');
				}
			    $('.item').click(function() {
			    	var text = $(this).text();
			    	$('#keyword').val(text);
			    })

			});
		} else {
			$('#results').html('<div class="item"><a href="/register/s/new">Add User</a></div>');
		}
	});

    $("#keyword").blur(function(){
    		$("#results").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#results").show();
    	});

});
</script>
	<h5>Name of Attendee/Mentor/Volunteer</h5>
  	<input type="text" value="" placeholder="Search" id="keyword">
  	<div id="results">
	</div>
<style>
#keyword {
	width: 100%;
	font-size: 1em;
}

#results {
	display:none;
	width: 100%;
	display: absolute;
	border: 1px solid #c0c0c0;
	border-radius: 5px;
	padding:5px;
}

#results .item {
	padding: 3px;
	font-family: Helvetica;
	border-bottom: 1px solid #c0c0c0;
}

#results .item:last-child {
	border-bottom: 0px;
}

#results .item:hover {
	background-color: #f2f2f2;
	cursor: pointer;
}</style>

{% endblock %}