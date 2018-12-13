<?php
// Iniciar_sesion.php
// ...
// This program is under the GNU General Public License, last version. Verdorama 2018-10-29.
// This creative work is under the CC BY-NC-SA, later version. Verdorama 2018-10-29.
// Verdorama https://verdorama.com/ https://facebook.com/Verdorama

/* Iniciar sesión en el API
	El API utiliza 2 tipos de validación de usuarios ( users_openAccess o users_loggedIn ). En el caso de los módulos users_openAccess,no se requiere un sessionKey para ejecutarlos. Pero, en los que son users_loggedIn, si se requiere enviar al API una autenticación, por lo que en este paso explicaré la manera de obtener una.
	Para ello se debe de interactuar con el módulo users pero el método que vamos a invocar será el users_log_me_in.
	Para solicitar una nueva sessionKey, se deben enviar los valores siguientes:
		w = users
		r = users_log_me_in
		userName = userName previamente registrado
		pwd = una contraseña registrada*/

//include('includes/session.inc');// *****************************************************************************
$Title = _('Iniciar sesión');
$ViewTopic = 'EDI';
$BookMark = 'API_Hacienda';

// BEGIN Functions division ====================================================
// END Functions division ======================================================

// BEGIN Data division =========================================================
$RootPath = '../..';
$Theme = 'default';
// END Data division ===========================================================

// BEGIN Procedure division ====================================================
include('includes/header.php');
echo '<p class="page_title_text"><img alt="" src="', $RootPath, '/css/', $Theme,
	'/images/maintenance.png" title="', // Icon image.
	$Title, '" /> ', // Icon title.
	$Title, '</p>';// Page title.

// Merges gets into posts:
if(isset($_GET['Caller'])) {// Select period from.
	$_POST['Caller'] = $_GET['Caller'];
}

// Sets default caller:
if(!isset($_POST['Caller'])) {
	$_POST['Caller'] = $RootPath . '/index.php';
}

// Form and form buttons:
	echo
		'<form action="API_Hacienda/www/api.php" method="post">',
		'<input name="w" type="hidden" value="users" />',
		'<input name="r" type="hidden" value="users_log_me_in" />',
		'Usuario:<br />',
		'<input name="userName" maxlength="100" type="text"><br />',
		'Contraseña:<br />',
		'<input name="pwd" maxlength="255" type="password"><br />',

		'<br />',
		'<div class="centre noprint">',
			// Form buttons:
			'<button type="submit"><img alt="" src="', $RootPath, '/css/', $Theme,
				'/images/tick.svg" /> ', _('Submit'), '</button>', // "Submit" button.
			'<button onclick="window.location=\'', $_POST['Caller'], '\'" type="button"><img alt="" src="', $RootPath, '/css/', $Theme,
				'/images/return.svg" /> ', _('Return'), '</button>', // "Return" button.
		'</div>',
		'</form>';

// END Procedure division ======================================================
?>