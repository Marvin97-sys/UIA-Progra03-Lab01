<?php
$templateTitle = 'Mantenimiento de Reservaciones';
$templateScripts = '';
$templatePageHeader = '<h1><Nombre Sistema><small> Mantenimiento de Reservaciones</small><img src="img/logo/logo.png" align="right"/></h1>';

include_once("template/templateHead.php");
?>

<!-- ********************************************************** -->
<!-- ********************************************************** -->
<!-- ********************************************************** -->
<div class="row">
    
    <div class="col-md-12">
        
        <form role="form" onsubmit="return false;" id="formReservaciones"  action="../backend/controller/reservacionesController.php">
            <div class="row">
                <!-- ******************************************************** -->
                <!-- Campos de formulario      -->
                <!-- ******************************************************** -->
                <div class="col-md-12">

                    <div class="form-group" id="groupidreservaciones">
                        <label for="txtidreservaciones">idreservaciones</label>
                        <input type="text" class="form-control" id="txtidreservaciones"  placeholder="idreservaciones">
                    </div>
                    <div class="form-group" id="groupusuario_idusuario">
                        <label for="txtusuario_idusuario">usuario_idusuario</label>
                        <input type="text" class="form-control" id="txtusuario_idusuario"  placeholder="usuario_idusuario">
                    </div>
                    <div class="form-group" id="groupvuelos_idvuelos">
                        <label for="txtvuelos_idvuelos">vuelos_idvuelos</label>
                        <input type="text" class="form-control" id="txtvuelos_idvuelos"  placeholder="vuelos_idvuelos">
                    </div>
                    <div class="form-group" id="groupfecha_reservacion">
                        <label for="fecha_reservacion">fecha_reservacion</label>
                        <input type="text" class="form-control" id="txtfecha_reservacion"  placeholder="fecha_reservacion">
                    </div>
                    <div class="form-group" id="groupnumero_fila">
                        <label for="txtnumero_fila">numero_fila</label>
                        <input type="text" class="form-control" id="txtnumero_fila"  placeholder="numero_fila">
                    </div>
                    <div class="form-group" id="groupnumero_asiento">
                        <label for="txtnumero_asiento">numero_asiento</label>
                        <input type="text" class="form-control" id="txtnumero_asiento"  placeholder="numero_asiento">
                    </div>                    
                    
                    
                    <div class="form-group">
                        <input type="hidden" id="typeAction" value="add_reservaciones" />
                        
                        <button type="submit" class="btn btn-primary" id="enviar">Guardar</button>
                        <button type="reset" class="btn btn-danger" id="cancelar">Cancelar</button>
                    </div>
                </div>
            </div>
        </form>
   
    </div>
</div>
    
<br>
<h3>Tabla con informacion de las reservaciones</h3>

<br><br>
<div class="row">
    <div class="col-md-12">
        <table id="dt_reservaciones"  class="table  table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>idreservaciones</th>
                    <th>usuario_idusuario</th>
                    <th>vuelos_idvuelos</th>
                    <th>fecha_reservacion</th>
                    <th>numero_fila</th>
                    <th>numero_asiento</th>
                    <th>ACCION</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<br><br><br><br>
<?php
include_once("template/templateFooter.php");
?>