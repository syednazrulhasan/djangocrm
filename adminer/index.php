<?php
function adminer_object() {
	include_once "./plugins/plugin.php";
	include_once "./plugins/login-password-less.php";
	
	class AdminerCustomization extends AdminerPlugin {
		function loginFormField($name, $heading, $value) {
			return parent::loginFormField($name, $heading, str_replace('value="server"', 'value="sqlite"', $value));
		}
		function database() {
			return "/home/yaseen/crm/db.sqlite3";
		}
	}
	
	return new AdminerCustomization(array(
		// TODO: inline the result of password_hash() so that the password is not visible in source codes
		new AdminerLoginPasswordLess(password_hash("YOUR_PASSWORD_HERE", PASSWORD_DEFAULT)),
	));
}

include "./adminer.php";