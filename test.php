<?php

function get_result_reniec($dni) {
    try {
        $comodin = substr($dni, 0, 1);

        if ($comodin == "9") {
            // Consulta para DNI que comienza con "9"
            $consulta = file_get_contents("https://api.perudevs.com/api/v1/dni/simple?document=".$data['dato_2']."&key=cGVydWRldnMucHJvZHVjdGlvbi5maXRjb2RlcnMuNjJmYTllZDU4ZGI5OTcxZGFkYmY2ZTVj");

            $data = $consulta;
            $info = json_decode($data);

            // Verificar si 'resultado' existe y contiene los campos necesarios
            if (!isset($info->resultado) || !isset($info->resultado->nombres)) {
                return array('success' => false, 'reason' => 'error');
            }

            $nombres = $info->resultado->nombres;
            $ap_paterno = $info->resultado->apellido_paterno;
            $ap_materno = $info->resultado->apellido_materno;
            $nombre_completo = ucwords(strtolower($info->resultado->nombre_completo));
            $nameFomateado = ucwords(strtolower($nombres));
        } else {
            // Consulta para DNI que no comienza con "9"
            $token = 'apis-token-2041.JtDPlJHWeHqCmQdNCFTfiSji1vVAqE4X';
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero='.$dni,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Referer: https://apis.net.pe/consulta-dni-api',
                    'Authorization: Bearer '.$token
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            // Decodificar JSON y verificar errores
            $persona = json_decode($response);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return array('success' => false, 'reason' => 'error');
            }

            // Verificar si los campos esperados existen
            if (!isset($persona->nombres)) {
                return array('success' => false, 'reason' => 'error');
            }

            $nombres = $persona->nombres;
            $ap_paterno = $persona->apellidoPaterno;
            $ap_materno = $persona->apellidoMaterno;
            $nombre_completo = ucwords(strtolower($nombres." ".$ap_paterno." ".$ap_materno));
            $nameFomateado = ucwords(strtolower($nombres));
        }

    } catch (Exception $e) {
        return array('success' => false, 'reason' => 'error');
    }

    $response = array('success' => true, 'nombre_completo' => $nombre_completo, 'nameFomateado' => $nameFomateado);
    return $response;
}

$get_result_reniec_rsp = get_result_reniec("75567837");

echo "<pre>";
print_r($get_result_reniec_rsp);
echo "</pre>";

?>
