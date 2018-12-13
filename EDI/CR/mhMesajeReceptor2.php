<?php
// mhMensajeReceptor_4.2.php
// Mensaje de aceptacion o rechazo de los documentos electronicos por parte del obligado tributario.
// This program is under the GNU General Public License, last version. Verdorama, 2016-10-08.
// This creative work is under the CC BY-NC-SA, last version. Verdorama, 2016-10-08.

/* Comments in the tax authority language.

Datos de entrada
	$xmlComprobante = Comprobante electrónico a aceptar o rechazar. Formato: archivo XML.
	$Mensaje = Código del mensaje de respuesta. 1 aceptado, 2 aceptado parcialmente, 3 rechazado.
	$DetalleMensaje = Detalle del mensaje. Formato: string{0,80}.
	$MontoTotalImpuesto = Monto total del impuesto, que es obligatorio si el comprobante tenga impuesto. Formato: decimal 18.5.
	$TotalFactura = Monto total de la factura. Formato: decimal 18.5.

Datos calculados:
	$Clave = Clave numérica del comprobante a aceptar o rechazar. Formato: d{50,50}.
	$NumeroCedulaEmisor = Número de cédula física/jurídica/NITE/DIMEX del vendedor. Formato: d{12,12}.
	$FechaEmisionDoc = Fecha de emisión de la confirmación. Formato: ISO 8601.
	$NumeroCedulaReceptor = Número de cédula fisica/jurídica/NITE/DIMEX del comprador. Formato: d{12,12}.
	$NumeroConsecutivoReceptor = Numeración consecutiva de los mensajes de confirmación. Frmato: d{20,20}.
*/

// BEGIN Functions division ====================================================
// END Functions division ======================================================

// BEGIN Data division =========================================================
$Title = _('Crear mensaje de aceptación XML');
$ViewTopic = 'EDI';
$BookMark = 'API_Hacienda';
$RootPath = '../..';
$Theme = 'default';
// END Data division ===========================================================

// BEGIN Procedure division ====================================================
/*include('../../../includes/session.php');*/

include('../../../includes/header.php');
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
		'<form action="mhMesajeReceptorProcess2.php" method="post">',

		'xmlComprobante:<br />',
		'<input name="xmlComprobante" type="file" /><br />',

		'Mensaje:<br />',
		'<select name="Mensaje">
			<option value="1">Confirmación de aceptación del comprobante electrónico</option>
			<option value="2">Confirmación de aceptación parcial del comprobante electrónico</option>
			<option value="3">Confirmación de rechazo del comprobante electrónico</option>
		</select>1<br />',

		'DetalleMensaje:<br />',
		'<input name="DetalleMensaje" maxlength="255" type="text">Acepto por completo<br />',

		'MontoTotalImpuesto:<br />',
		'<input name="MontoTotalImpuesto" maxlength="25" type="text">0<br />',

		'TotalFactura:<br />',
		'<input name="TotalFactura" maxlength="25" type="text">10000<br />',

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