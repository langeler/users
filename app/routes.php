<?php

$app = new App([
	"db" => new db(db_host, db_user, db_pass, db_name),
]);

// Get user pages
$app->route->get("/", "userController@login");
$app->route->get("/login", "userController@login");
$app->route->get("/logout", "userController@logout");
$app->route->get("/register", "userController@register");
$app->route->get("/home", "userController@home");
$app->route->get("/profile", "userController@profile");
$app->route->get("/profile/edit", "userController@profile_edit");
$app->route->get("/forgotpassword", "userController@forgot_password");
$app->route->get(
	"/resetpassword/{email}/{code}",
	"userController@reset_password"
);
$app->route->get("/activate/{email}/{code}", "userController@activate");
$app->route->get("/resendactivation", "userController@resend_activation");

// Post user pages
$app->route->post("/register_process", "userController@register_process");
$app->route->post("/authenticate", "userController@authenticate");
$app->route->post("/profile/edit", "userController@profile_edit");
$app->route->post("/forgotpassword", "userController@forgot_password");
$app->route->post(
	"/resetpassword/{email}/{code}",
	"userController@reset_password"
);
$app->route->post("/resendactivation", "userController@resend_activation");

// Get admin pages
$app->route->get("/admin", "adminController@accounts");
$app->route->get("/admin/account", "adminController@account");
$app->route->get("/admin/account/{id}", "adminController@account");
$app->route->get("/admin/emailtemplate", "adminController@emailtemplate");
$app->route->get("/admin/settings", "adminController@settings");

// Post admin pages
$app->route->post("/admin/account", "adminController@account");
$app->route->post("/admin/account/{id}", "adminController@account");
$app->route->post("/admin/emailtemplate", "adminController@emailtemplate");
$app->route->post("/admin/settings", "adminController@settings");
