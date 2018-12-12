<?php
// mhMensajeReceptor_4.2.php
// Mensaje de aceptacion o rechazo de los documentos electronicos por parte del obligado tributario.
// This program is under the GNU General Public License, last version. Verdorama, 2016-10-08.
// This creative work is under the CC BY-NC-SA, last version. Verdorama, 2016-10-08.

/* Comments in the tax authority language.

Parámetros:

	Datos de entrada
		xmlComprobante = Comprobante electrónico a aceptar o rechazar. Formato: archivo XML.
		Mensaje = Código del mensaje de respuesta. 1 aceptado, 2 aceptado parcialmente, 3 rechazado.
		DetalleMensaje = Detalle del mensaje. Formato: string{0,80}.
		MontoTotalImpuesto = Monto total del impuesto, que es obligatorio si el comprobante tenga impuesto. Formato: decimal 18.5.
		TotalFactura = Monto total de la factura. Formato: decimal 18.5.

	Datos calculados:
		Clave = Clave numérica del comprobante a aceptar o rechazar. Formato: d{50,50}.
		NumeroCedulaEmisor = Número de cédula física/jurídica/NITE/DIMEX del vendedor. Formato: d{12,12}.
		FechaEmisionDoc = Fecha de emisión de la confirmación. Formato: ISO 8601.
		NumeroCedulaReceptor = Número de cédula fisica/jurídica/NITE/DIMEX del comprador. Formato: d{12,12}.
		NumeroConsecutivoReceptor = Numeración consecutiva de los mensajes de confirmación. Frmato: d{20,20}.

*/

// BEGIN Functions division ====================================================
include('mhIncludes/mhFunctions.php');
// END Functions division ======================================================

// BEGIN Data division =========================================================
$Title = _('Mensaje del receptor');
$ViewTopic = 'EDI';
$BookMark = 'mhMensajeReceptor';
$Path = '';// Ruta donde se almacena el archivo xml.
$pinP12 = '310162367412.p12';// Este es el código que se obtiene al subir el certificado
$p12Url = '6428';// Esta es la contraseña de la llave criptográfica
// END Data division ===========================================================

// BEGIN Procedure division ====================================================
/*include('../../../includes/session.php');*/

// Merges GETs into POSTs:
if(isset($_GET['xmlComprobante'])) {// Comprobante electrónico a aceptar o rechazar.
	$_POST['xmlComprobante'] = $_GET['xmlComprobante'];
}
if(isset($_GET['Mensaje'])) {// Código del mensaje de respuesta.
	$_POST['Mensaje'] = $_GET['Mensaje'];
}
if(isset($_GET['DetalleMensaje'])) {// Detalle del mensaje.
	$_POST['DetalleMensaje'] = $_GET['DetalleMensaje'];
}
if(isset($_GET['MontoTotalImpuesto'])) {// Monto total del impuesto.
	$_POST['MontoTotalImpuesto'] = $_GET['MontoTotalImpuesto'];
}
if(isset($_GET['TotalFactura'])) {// Monto total de la factura.
	$_POST['TotalFactura'] = $_GET['TotalFactura'];
}

// Calcula datos:

echo '<br />$_POST[\'xmlComprobante\'] =', $_POST['xmlComprobante'];//***********************************************************************************

$xmlContent = file_get_contents($_POST['xmlComprobante']);
$xmlComprobante = simplexml_load_string( file_get_contents($_POST['xmlComprobante']) );
// <Clave>:
$Clave = $xmlComprobante->Clave;
// <NumeroCedulaEmisor>:
$NumeroCedulaEmisor = substr($Clave, 9, 12);
// <FechaEmisionDoc>
// Calculado en el momento de emitir el XML.
$TipoComprobante = substr($Clave, 29, 2);
// <Mensaje>:
// .
// <DetalleMensaje>:
// .
// <MontoTotalImpuesto> y <TotalFactura>.
switch($_POST['Mensaje']) {
	case 1:// Aceptado.
		$MontoTotalImpuesto = $xmlComprobante->ResumenFactura->TotalImpuesto;
		$TotalFactura = $xmlComprobante->ResumenFactura->TotalComprobante;
		break;
	case 2:// Aceptado parcialmente.
		$MontoTotalImpuesto = $_POST['MontoTotalImpuesto'];
		$TotalFactura = $_POST['TotalFactura'];
		break;
	default:// Rechazado.
		$MontoTotalImpuesto = 0;
		$TotalFactura = 0;
}
// <NumeroCedulaReceptor>:
$NumeroCedulaReceptor = str_pad($xmlComprobante->Receptor->Identificacion->Numero, 12, "0", STR_PAD_LEFT);
// <NumeroConsecutivoReceptor>:
// NumeroConsecutivoReceptor = Numeración consecutiva de los mensajes de confirmación. Frmato: d{20,20}.
// *******************************************************************

// Genera archivo XML sin firmar:
$xmlString = '<?xml version="1.0" encoding="utf-8"?>
<MensajeReceptor xmlns="https://tribunet.hacienda.go.cr/docs/esquemas/2017/v4.2/mensajeReceptor" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="https://tribunet.hacienda.go.cr/docs/esquemas/2017/v4.2/mensajeReceptor MensajeReceptor_4.2.xsd">
	<Clave>' . $Clave . '</Clave>
	<NumeroCedulaEmisor>' . $NumeroCedulaEmisor . '</NumeroCedulaEmisor>
	<FechaEmisionDoc>' . date("c") . '</FechaEmisionDoc>
	<Mensaje>' . $_POST['Mensaje'] . '</Mensaje>';
if (!empty($_POST['DetalleMensaje'])) {
	$xmlString .= '
	<DetalleMensaje>' . $_POST['DetalleMensaje'] . '</DetalleMensaje>';
}
if (!empty($MontoTotalImpuesto)) {
	$xmlString .= '
	<MontoTotalImpuesto>' . $MontoTotalImpuesto . '</MontoTotalImpuesto>';
}
$xmlString .= '
	<TotalFactura>' . $TotalFactura . '</TotalFactura>
	<NumeroCedulaReceptor>' . $NumeroCedulaReceptor . '</NumeroCedulaReceptor>
	<NumeroConsecutivoReceptor>' . $_POST['NumeroConsecutivoReceptor'] . '</NumeroConsecutivoReceptor>
</MensajeReceptor>';

// Writes the contents of $xmlString:
$Handle = fopen($Path . $_POST['NumeroConsecutivoReceptor'] . '_unsigned.xml', 'w') OR die("Unable to open file!");
if(fwrite($Handle, $xmlString)) {
	echo '<br /><span style="color:green">', $_POST['NumeroConsecutivoReceptor'], '_unsigned.xml &#10003;</span><br />';
} else {
	echo '<br /><span style="color:red">', $_POST['NumeroConsecutivoReceptor'], '_unsigned.xml &#x2613;</span><br />';
}
fclose($Handle);


echo '<br /><pre>$xmlString = ', str_replace('<', '&lt;', $xmlString), '</pre>';//***********************************************************************************


/*



$xmlElements = simplexml_load_string($xmlString);//***********************************************************************************
$TipoComprobante = substr($xmlElements->NumeroConsecutivoReceptor, 8, 2);//***********************************************************************************

echo '<br />$TipoComprobante=', $TipoComprobante;//***********************************************************************************
echo '<br />base64_encode($xmlString) = ', base64_encode($xmlString);//***********************************************************************************


echo '
<br /><br />';

echo 'function signCE=', signCE(
	$pinP12,// Este es el código que se obtiene al subir el certificado
	$p12Url,// Esta es la contraseña de la llave criptográfica
	base64_encode($xmlString));// Este debe ser el XML que se va a firmar, pero debe ir en base64

*/

// END Procedure division ======================================================
?>
