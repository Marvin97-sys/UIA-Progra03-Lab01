<?php
$templateTitle = 'Mantenimiento de Vuelos';
$templateScripts = '<script type="text/javascript" src="js/vuelosFunctions.js"></script>';
$templatePageHeader = '<h1><Nombre Sistema><small> Mantenimiento de Vuelos</small><img src="img/logo/logo.png" align="right"/></h1>';

include_once("template/templateHead.php");
?>

<!-- ********************************************************** -->
<!-- ********************************************************** -->
<!-- ********************************************************** -->
<div class="row">
    <div class="col-md-12">
        <form role="form" onsubmit="return false;" id="formvuelos">
            <div class="row">
                <!-- ******************************************************** -->
                <!-- Campos de formulario      -->
                <!-- ******************************************************** -->
                <div class="col-md-12">

                    <div class="form-group" id="groupidvuelos">
                        <label for="txtidvuelos">idvuelos</label>
                        <input type="text" class="form-control" id="txtidvuelos"  placeholder="idvuelos">
                    </div>
                    <div class="form-group" id="groupfecha_hora">
                        <label for="txtfecha_hora">fecha_hora</label>
                        <input type="text" class="form-control" id="txtfecha_hora"  placeholder="fecha_hora">
                    </div>
                    <div class="form-group" id="grouprutas_idrutas">
                        <label for="txtrutas_idrutas">rutas_idrutas</label>
                        <input type="text" class="form-control" id="txtrutas_idrutas"  placeholder="rutas_idrutas">
                    </div>
                    <div class="form-group" id="groupcatalogo_avion_idcatalogo_avion">
                        <label for="txtcatalogo_avion_idcatalogo_avion">catalogo_avion_idcatalogo_avion</label>
                        <input type="text" class="form-control" id="txtcatalogo_avion_idcatalogo_avion"  placeholder="catalogo_avion_idcatalogo_avion">
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" id="typeAction" value="add_vuelos" />
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
<h3>Tabla con información de Vuelos</h3>
<br><br>
<div class="row">
    <div class="col-md-12">
        <div id="divResult" style="text-align:center;">Resultado de la consulta</div>
    </div>
</div>
<?php
include_once("template/templateFooter.php");
?>
