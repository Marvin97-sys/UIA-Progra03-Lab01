<?php
$templateTitle = 'Mantenimiento de Rutas';
$templateScripts = '<script type="text/javascript" src="js/rutasFunctions.js"></script>';
$templatePageHeader = '<h1><Nombre Sistema><small> Mantenimiento de Rutas</small><img src="img/logo/logo.png" align="right"/></h1>';

include_once("template/templateHead.php");
?>

<!-- ********************************************************** -->
<!-- ********************************************************** -->
<!-- ********************************************************** -->
<div class="row">
    <div class="col-md-12">
        <form role="form" onsubmit="return false;" id="formrutas">
            <div class="row">
                <!-- ******************************************************** -->
                <!-- Campos de formulario      -->
                <!-- ******************************************************** -->
                <div class="col-md-12">

                    <div class="form-group" id="groupidrutas">
                        <label for="txtidrutas">idrutas</label>
                        <input type="text" class="form-control" id="txtidrutas"  placeholder="idrutas">
                    </div>
                    <div class="form-group" id="grouptrayecto">
                        <label for="txttrayecto">trayecto</label>
                        <input type="text" class="form-control" id="txttrayecto"  placeholder="trayecto">
                    </div>
                    <div class="form-group" id="groupduracion">
                        <label for="txtduracion">duracion</label>
                        <input type="text" class="form-control" id="txtduracion"  placeholder="duracion">
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" id="typeAction" value="add_rutas" />
                        <input type="hidden" value="" id="idTarea"/>
                        <button type="submit" class="btn btn-primary" id="enviar">Guardar</button>
                        <button type="reset" class="btn btn-danger" id="cancelar">Cancelar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<br>
<h3>Tabla con información de Rutas</h3>
<br><br>
<div class="row">
    <div class="col-md-12">
        <div id="divResult" style="text-align:center;">Resultado de la consulta</div>
    </div>
</div>
<?php
include_once("template/templateFooter.php");
?>

