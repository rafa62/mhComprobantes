<?php
// Firmar_mensaje_de_aceptacion.php
// ...
// This program is under the GNU General Public License, last version. Verdorama 2018-10-29.
// This creative work is under the CC BY-NC-SA, later version. Verdorama 2018-10-29.
// Verdorama https://verdorama.com/ https://facebook.com/Verdorama


/*
Firmado del xml Mensaje de Aceptación (Pendiente solucionar error)
Para firmar un XML se debe de hacer uso del Token del certificado, el cual subimos en la sección de Subir la llave criptográfica
Los parámetros a enviar para poder firmar un XML son los siguientes:
	w = signXML
	r = signFE
	p12Url =	Este es el código que se obtiene al subir el certificado
	inXml =	Este debe ser el XML que se va a firmar, pero debe ir en base64
	pinP12 =	Esta es la contraseña de la llave criptográfica
	tipodoc =	Tipo de documento. Puede ser CCE, CPCE, o RCE
*/

//include('includes/session.inc');// *****************************************************************************
$Title = _('Firmar mensaje de aceptación');
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
		'<input name="w" type="hidden" value="signXML" />',
		'<input name="r" type="hidden" value="signFE" />',

		'p12Url:<br />',
		'<input name="p12Url" maxlength="255" type="text"><br />',
		'Contraseña de la llave criptográfica:<br />',
		'<input name="pinP12" maxlength="4" type="password"><br />',
		'XML que se va a firmar:<br />',
		'<input name="inXml" maxlength="255" type="text"><br />',
		'tipodoc:<br />',
		'<select name="tipodoc">
			<option value="CCE">Confirmación de comprobante electrónico (CCE)</option>
			<option value="CPCE">Confirmación parcial de comprobante electrónico (CPCE)</option>
			<option value="RCE">Rechazo de comprobante electrónico (RCE)</option>
		</select><br />',

		/*
p12Url= Este es el código que se obtiene al subir el certificado
inXml= Este debe ser el XML que se va a firmar, pero debe ir en base64
pinP12= Esta es la contraseña de la llave criptográfica
tipodoc= Tipo de documento igual puede ser CCE CPCE RCE*/

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