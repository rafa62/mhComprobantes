<?php
// Crear_xml_de_mensaje_de_aceptacion.php
// ...
// This program is under the GNU General Public License, last version. Verdorama 2018-10-29.
// This creative work is under the CC BY-NC-SA, later version. Verdorama 2018-10-29.
// Verdorama https://verdorama.com/ https://facebook.com/Verdorama

/*
Creación de xml Mensaje de Aceptacion
Para generar un XML de mensaje de aceptación se requieren varios datos, yo dejare aquí abajo
los datos que voy a usar.
	w:genXML
	r:gen_xml_mr
	clave:50602081800070232071700100001010000001021100000021
	numero_cedula_emisor:702320717
	fecha_emision_doc:	Es el campo <FechaEmision> del documento que se va a aceptar o rechazar. Para este ejemplo: 2018-08-02T00:46:00-06:00
	mensaje:1
	detalle_mensaje:Acepto por completo
	monto_total_impuesto:0
	total_factura:10000
	numero_cedula_receptor:702320717
	numero_consecutivo_receptor:00100001050000001022
*/

//include('includes/session.inc');// *****************************************************************************
$Title = _('Crear mensaje de aceptación XML');
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

		'<input name="w" type="hidden" value="genXML" />',
		'<input name="r" type="hidden" value="gen_xml_mr" />',

		'clave:<br />',
		'<input name="clave" maxlength="50" type="text">50602081800070232071700100001010000001021100000021<br />',

		'numero_cedula_emisor:<br />',
		'<input name="inXml" maxlength="10" type="text">702320717<br />',

		'fecha_emision_doc:<br />',
		'<input name="fecha_emision_doc" maxlength="25" type="text">2018-08-02T00:46:00-06:00<br />',

		'mensaje:<br />',
		'<select name="mensaje">
			<option value="1">05 Confirmación de aceptación del comprobante electrónico</option>
			<option value="2">06 Confirmación de aceptación parcial del comprobante electrónico</option>
			<option value="3">07 Confirmación de rechazo del comprobante electrónico</option>
		</select><br />',

		'detalle_mensaje:<br />',
		'<input name="detalle_mensaje" maxlength="255" type="text">Acepto por completo<br />',

		// monto_total_impuesto:0
		'monto_total_impuesto:<br />',
		'<input name="monto_total_impuesto" maxlength="25" type="text">0<br />',

		// total_factura:10000
		'total_factura:<br />',
		'<input name="total_factura" maxlength="25" type="text">10000<br />',

		// numero_cedula_receptor:702320717
		'numero_cedula_receptor:<br />',
		'<input name="numero_cedula_receptor" maxlength="10" type="text">702320717<br />',

		// numero_consecutivo_receptor:00100001050000001022
		'numero_consecutivo_receptor:<br />',
		'<input name="numero_consecutivo_receptor" maxlength="20" type="text">00100001050000001022<br />',


/*

1/, 2/, 3/Rechazado. Para este ejemplo: 1

		'tipodoc:<br />',
		'<select name="tipodoc">
			<option value="CCE">Confirmación de comprobante electrónico (CCE)</option>
			<option value="CPCE">Confirmación parcial de comprobante electrónico (CPCE)</option>
			<option value="RCE">Rechazo de comprobante electrónico (RCE)</option>
		</select><br />',




	*/




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