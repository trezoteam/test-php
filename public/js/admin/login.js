function authenticate() {
	var $user_name = $('#user_name').val();
	var $password = $('#password').val();
	
	$.ajax({
		method: "POST",
		url: "/admin/login/",
		data: {
			user_name:$user_name,
			password:$password
		}
	}).done(function(value) {
		var $value = JSON.parse(value);
		if ($value.errors.length > 0) {
			alert($value.errors);
		} else {
			window.location.replace("/");
		}
	});
}