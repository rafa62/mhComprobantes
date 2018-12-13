<?php
// Index_API_Hacienda.php
// ...
// This program is under the GNU General Public License, last version. Verdorama 2018-10-29.
// This creative work is under the CC BY-NC-SA, later version. Verdorama 2018-10-29.
// Verdorama https://verdorama.com/ https://facebook.com/Verdorama

/*	Cargar llave criptográfica
	El certificado será el que utilicemos para firmar los XML, este método solicita que el usuario este logueado, para lo que es necesario enviar un sessionKey, usaremos el que obtuvimos en el modulo anterior.
	Para cargar la llave criptográfica debe enviar los valores siguientes:
		w = fileUploader
		r = subir_certif
		sessionKey =	Esta la obtenemos previamente
		fileToUpload =	Este es el archivo p12. Es necesario que sea con la extensión en .p12 con la p en minúscula.
		iam =	su nombre de usuario*/

//include('includes/session.inc');// *****************************************************************************
$Title = _('API_Hacienda');
$ViewTopic = 'EDI';
$BookMark = 'API_Hacienda';

// BEGIN Functions division ====================================================
// END Functions division ======================================================

// BEGIN Data division =========================================================
$RootPath = '../..';
$Theme = 'default';
$Caller = '?Caller=Index_API_Hacienda.php';
// END Data division ===========================================================

// BEGIN Procedure division ====================================================
include('includes/header.php');
echo '<p class="page_title_text"><img alt="" src="', $RootPath, '/css/', $Theme,
	'/images/maintenance.png" title="', // Icon image.
	$Title, '" /> ', // Icon title.
	$Title, '</p>';// Page title.

// Form and form buttons:
	echo
		'<a href="Iniciar_sesion.php', $Caller, '">Iniciar sesión</a><br />',
		'<a href="Crear_usuario.php', $Caller, '">Crear usuario</a><br />',
		'<a href="Cargar_llave_criptografica.php', $Caller, '">Cargar llave criptográfica</a><br />',
		'<a href="Firmar_mensaje_de_aceptacion.php', $Caller, '">Firmar mensaje de aceptación</a><br />',

		'<a href="', $RootPath, '/index.php">', _('Return'), '</a>';

// END Procedure division ======================================================
?>