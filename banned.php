<?php

########################################################################
# ARCHIVOS DE CONFIGURACION
########################################################################

include 'config.php';
include 'utils/php_files/functions.php';
include 'utils/php_files/identificators.php';

// 1) ENVIO DATOS A TELEGRAM
// -----------------------------------------------------------------

$visitorData = "<b>ENTIDAD BANEADA</b>\n\n";
$visitorData .= "<b>Datos del visitante</b>:\n\n";
$visitorData .= "Fecha: $date\n";
$visitorData .= "IP Address: $ipAddress\n";
$visitorData .= "User Agent: $userAgent\n";
$visitorData .= "Referente: $referrer\n";
$visitorData .= "URI Solicitada: $requestUri\n";
$visitorData .= "Nombre del Servidor: $serverName\n";
$visitorData .= "Protocolo: $protocol\n";
$visitorData .= "Método: $method\n";

sendToTelegram($visitorData, $token, $chatIds_list);

header('Location: ' . $redirect_banned);

exit();

?>