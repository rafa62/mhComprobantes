<?php
// Cargar_llave_criptografica.php
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
$Title = _('Cargar llave criptografica');
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
if(isset($_GET['Caller'])) {
	$_POST['Caller'] = $_GET['Caller'];
}

// Sets default caller:
if(!isset($_POST['Caller'])) {
	$_POST['Caller'] = $RootPath . '/index.php';
}

// Form and form buttons:
	echo
		'<form action="API_Hacienda/www/api.php" enctype="multipart/form-data" method="post">',
		'<input name="w" type="hidden" value="fileUploader" />',
		'<input name="r" type="hidden" value="subir_certif" />',

		'Usuario:<br />',
		'<input name="iam" maxlength="100" type="text"><br />Rafael_Chacon',
		'Llave de la sesión:<br />',
		'<input name="sessionKey" maxlength="255" type="text"><br />Z05BQ1c0UFlqU0hHK3oxVFIyZEt0QT09OjrvfDSoxKrpdbHWimqWmTl/',
		'Archivo p12:<br />',
		'<input name="fileToUpload" maxlength="255" type="file">3101123456.p12<br />',

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