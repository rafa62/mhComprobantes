<?php
// Crear_usuario.php
// ...
// This program is under the GNU General Public License, last version. Verdorama 2018-10-29.
// This creative work is under the CC BY-NC-SA, later version. Verdorama 2018-10-29.
// Verdorama https://verdorama.com/ https://facebook.com/Verdorama

/* La creación de usuarios se encuentra en el modulo llamado users este esta en \api\modules\users.
	Para ver las funciones que tiene el modulo basta con abrir el archivo module.php

	Para crear un usuario se debe enviar los siguientes parámetros:
	w = users
	r = users_register
	fullName = Esto es el nombre completo del usuario
	userName = Esto es el nombre de usuario
	email = Esto es el correo del usuario
	about = Esta es una información extra del usuario
	country = Esta es información de ubicación
	pwd = Esta es la contraseña para el usuario

	El GET completo seria el siguiente: 'EDI/CR/API_Hacienda/www/api.php?w=users&r=users_register'
		&fullName=Walner%20Borbon
		&userName=walner1borbon
		&email=walner1borbon@gmail.com
		&about=otro%20Usuaruio
		&country=CR
		&pwd=123*/

/*	Database:
		idUser	int(11)
		fullName 	varchar(255)
		userName	varchar(100)
		email	varchar(100)
		about 	varchar(255)
		country 	varchar(3)
		statusÍndice 	varchar(1)
		timestamp 	int(11)
		lastAccess 	int(11)
		pwd 	varchar(255)
		avatar 	varchar(200)*/

//include('includes/session.inc');// *****************************************************************************
$Title = _('Crear usuario');
$ViewTopic = 'EDI';
$BookMark = 'Instala_API_Hacienda';

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
		'<input name="r" type="hidden" value="users_register" />',
		'Usuario:<br />',
		'<input name="userName" maxlength="100" type="text"><br />',
		'Contraseña:<br />',
		'<input name="pwd" maxlength="255" type="password"><br />',
		'Nombre:<br />',
		'<input name="fullName" maxlength="255" type="text"><br />',
		'Correo-e:<br />',
		'<input name="email" maxlength="100" type="text"><br />',
		'información extra del usuario:<br />',
		'<input name="about" maxlength="255" type="text"><br />',
		'Ubicación:<br />',
		'<input name="country" maxlength="3" type="text"><br />',

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