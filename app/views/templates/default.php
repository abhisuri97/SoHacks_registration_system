<!DOCTYPE html>
<html lang="en">
    <head>
      <!--Import materialize.css-->
      		<title>SoHacks 2 | Login/Register</title>
		<meta charset="UTF-8">

      <link type="text/css" rel="stylesheet" href="/styles/css/materialize.min.css"  media="screen,projection"/>
            <link type="text/css" rel="stylesheet" href="/styles/css/loginstyles.css"  media="screen,projection"/>

<link rel="stylesheet" href="/styles/css/font-awesome.min.css">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <script type="text/javascript" src="/styles/js/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="/styles/js/materialize.min.js"></script>
    </head>

	<style>
	a.button-collapse.top-nav {
  position: absolute;
  text-align: center;
  height: 60px;
  width: 48px;
  left: 7.5%;
  top: 2px;
  float: none;
  margin-left: 1.5rem;
  color: #fff;
  font-size: 32px;
  z-index: 2;
}
	.avatar-small {
		height:50px;
		width: 50px;
		border-radius: 25px;
	}
	.avatar {
		height: 200px;
		width: 200px;
		border-radius: 100px;
	}
	ul.side-nav.fixed li.logo {
  text-align: center;
  margin-top: 16px;
  margin-bottom: 32px;
  border-bottom: 1px solid rgba(221, 221, 221, 0);
}
.top-nav {
	background: url("/styles/img/home.jpg") no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
	<script>
	 $(document).ready(function() {
    $('select').material_select();
  });
	</script>
	<body>
		<header>
		<nav class="top-nav">
	        <div class="container">
	          <div class="nav-wrapper"><a class="page-title">{{ block('title') }}</a></div>
	        </div>
      	</nav>
      	<div class="container">
      	<a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only"><i class="mdi-navigation-menu"></i></a></div>
				{% include 'templates/partials/navigation.php' %}
		</header>
		<main>
			<div class="container">
				<div class="row">
					<div class="col s12" style="padding-top: 100px">
						{% include 'templates/partials/messages.php' %}
						{% block content %}

						{% endblock %}
					</div>
				</div>
			</div>
		</main>
	</body>
</html>