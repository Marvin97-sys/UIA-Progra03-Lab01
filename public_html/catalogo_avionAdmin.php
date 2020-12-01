<?php
$templateTitle = 'Mantenimiento de Catalogo de Aviones';
$templateScripts = '<script type="text/javascript" src="js/catalogo_avionFunctions.js"></script>';
$templatePageHeader = '<h1><Nombre Sistema><small> Mantenimiento de Catalogo de Aviones</small><img src="img/logo/logo.png" align="right"/></h1>';

include_once("template/templateHead.php");
?>

<!-- ********************************************************** -->
<!-- ********************************************************** -->
<!-- ********************************************************** -->
<div class="row">
    <div class="col-md-12">
        <form role="form" onsubmit="return false;" id="formcatalogo_avion">
            <div class="row">
                <!-- ******************************************************** -->
                <!-- Campos de formulario      -->
                <!-- ******************************************************** -->
                <div class="col-md-12">

                    <div class="form-group" id="groupidcatalogo_avion">
                        <label for="txtidcatalogo_avion">idcatalogo_avion</label>
                        <input type="text" class="form-control" id="txtidcatalogo_avion"  placeholder="idcatalogo_avion">
                    </div>
                    <div class="form-group" id="groupaño">
                        <label for="txtaño">año</label>
                        <input type="text" class="form-control" id="txtaño"  placeholder="año">
                    </div>
                    <div class="form-group" id="groupmodelo">
                        <label for="txtmodelo">modelo</label>
                        <input type="text" class="form-control" id="txtmodelo"  placeholder="modelo">
                    </div>
                    <div class="form-group" id="groupmarca">
                        <label for="txtmarca">marca</label>
                        <input type="text" class="form-control" id="txtmarca"  placeholder="marca">
                    </div>
                    <div class="form-group" id="groupcantidad_filas">
                        <label for="cantidad_filas">cantidad_filas</label>
                        <input type="text" class="form-control" id="txtcantidad_filas"  placeholder="cantidad_filas">
                    </div>
                    <div class="form-group" id="groupasientos_por_fila">
                        <label for="asientos_por_fila">asientos_por_fila</label>
                        <input type="text" class="form-control" id="txtasientos_por_fila"  placeholder="asientos_por_fila">
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" id="typeAction" value="add_catalogo_avion" />
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
<h3>Tabla con informacion de Aviones</h3>
<br><br>
<div class="row">
    <div class="col-md-12">
        <div id="divResult" style="text-align:center;">Resultado de la consulta</div>
    </div>
</div>
<?php
include_once("template/templateFooter.php");
?>


