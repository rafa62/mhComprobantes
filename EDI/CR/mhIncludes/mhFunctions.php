<?php
// mhFunctions.php
// Shows notes of financial statements based on settings.
// This program is under the GNU General Public License, last version. Verdorama, 2016-10-08.
// This creative work is under the CC BY-NC-SA, last version. Verdorama, 2016-10-08.


/*
 * Copyright (C) 2017-2018 CRLibre <https://crlibre.org>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

echo '<br />mhFunctions.php INCLUDED<br />';

function signCE(
	$pinP12,// Este es el código que se obtiene al subir el certificado
	$p12Url,// Esta es la contraseña de la llave criptográfica
	$inXml)// Este debe ser el XML que se va a firmar, pero debe ir en base64
	{
    include 'Firmadohaciendacr.php';
    modules_loader("files");
    $p12Url     = filesGetUrl($p12Url);

	$xmlElements = simplexml_load_string(base64_decode($inXml));
	$TipoComprobante = substr($xmlElements->NumeroConsecutivoReceptor, 8, 2);
	$Tipos = array('01', '02', '03', '04', '05', '06', '07');
	if (!in_array($TipoComprobante, $Tipos)) {
		$tipoDocumento = null;
		return 'Tipo de comprobante desconocido: ' . $TipoComprobante . '<br />';
	} else {
		$tipoDocumento = $TipoComprobante;
		echo '<br />$TipoComprobante=', $TipoComprobante;
	}


    $fac = new Firmadocr();
    //$inXmlUrl debe de ser en Base64
    //$p12Url es un downloadcode previamente suministrado al subir el certificado en el modulo fileUploader -> subir_certif
    //Tipo es el tipo de documento
    //01 FE
    //02 ND
    //03 NC
    //04 TE
    //05 06 07 Mensaje Receptor
    $returnFile = $fac->firmar($p12Url, $pinP12, $inXml, $tipoDocumento);
    $arrayResp  = array(
        "xmlFirmado" => $returnFile
    );

    return $arrayResp;
}


function filesGetUrl($codigo = '') {
    /**
     * Esta funcion se puede llamar desde GET POST si se envian los siguientes parametros
     * w=files
     * r=filesGetUrl
     * downloadCode=codigo de descarga del file
     * Tambien se puede llamar desde un metodo de la siguiente manera:
     * modules_loader("files");       <-- Esta funcion importa el modulo
     * filesGetUrl('codigo');  <------------ esta funcion retorna el URL del file codigo es el downloadCode de la db
     * */
    if ($codigo == '') {
		$codigo = params_get('downloadCode', '');
    }

    $q = sprintf("SELECT * FROM files WHERE downloadCode = '%s'", $codigo);
    $file = db_query($q, 1);
	if ($file != ERROR_DB_NO_RESULTS_FOUND) {
		$filePath = files_createPath($file->idUser, $file->type) . $file->name;
		return $filePath;
	}

    return false;
}


function IsValidClave() {
	// Clave numérica del comprobante a aceptar o rechazar. Formato: d{50,50}.
}

function IsValidNumeroCedula($NumeroCedula) {
	// Número de cédula física/jurídica/NITE/DIMEX del vendedor. Formato: d{12,12}.
	if ($NumeroCedula > 1000000) {
		return str_pad($NumeroCedula, 12, "0", STR_PAD_LEFT);
	} else {
		return FALSE;
	}
}

function IsValidMensaje() {
	// Codigo del mensaje de respuesta. 1 aceptado, 2 aceptado parcialmente, 3 rechazado.
}

function IsValidDetalleMensaje() {
	// Detalle del mensaje. Formato: string{0,80}.
}

function IsValidMontoTotalImpuesto() {
	// Monto total del impuesto, que es obligatorio si el comprobante tenga impuesto. Formato: decimal 18.5.
}
function IsValidTotalFactura() {
	// Monto total de la factura. Formato: decimal 18.5.
}
function IsValidNumeroCedulaReceptor() {
	// Número de cédula fisica/jurídica/NITE/DIMEX del comprador. Formato: d{12,12}.
}
function IsValidNumeroConsecutivoReceptor() {
	// Numeración consecutiva de los mensajes de confirmación. Frmato: d{20,20}.
}


?>
