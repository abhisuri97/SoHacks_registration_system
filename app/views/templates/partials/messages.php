{% if flash.global %}
<script>
	Materialize.toast("{{ flash.global }}", 5000);
</script>
	<style>
	.alert {
padding: 8px 35px 8px 14px;
margin-bottom: 18px;
color: #c09853;
text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
background-color: #fcf8e3;
border: 1px solid #fbeed5;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}

.alert-heading {
color: inherit;
}

.alert .close {
position: relative;
top: -2px;
right: -21px;
line-height: 18px;
}
.alert-info {
color: #3a87ad;
background-color: #d9edf7;
border-color: #bce8f1;
}
	</style>
{% endif %}