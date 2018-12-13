<?php
// mhMensajeReceptor_4.2.php
// Mensaje de aceptacion o rechazo de los documentos electronicos por parte del obligado tributario.
// This program is under the GNU General Public License, last version. Verdorama, 2016-10-08.
// This creative work is under the CC BY-NC-SA, last version. Verdorama, 2016-10-08.

/* Comments in the tax authority language.

Datos de entrada
	$xmlFile = Comprobante electrónico a firmar. Formato: archivo XML.
	$Signature = Llave criptográfica usada para firmar.
	$passSign = Contraseña de la llave criptográfica.

Datos calculados:

Datos de salida:
	$xmlSigned = Comprobante electrónico firmado. Formato: archivo XML.
*/

// BEGIN Functions division ====================================================
// END Functions division ======================================================

// BEGIN Data division =========================================================

/*
$pinP12 // Este es el código que se obtiene al subir el certificado
$p12Url // Esta es la contraseña de la llave criptográfica
$inXml // Este debe ser el XML que se va a firmar, pero debe ir en base64
*/
// END Data division ===========================================================

// BEGIN Procedure division ====================================================
/*include('../../../includes/session.php');*/





// END Procedure division ======================================================
?>
