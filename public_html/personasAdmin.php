<?php
$templateTitle = 'Mantenimiento de Personas';
$templateScripts = '';
$templatePageHeader = '<h1><Nombre Sistema><small> Mantenimiento de Personas</small><img src="img/logo/logo.png" align="right"/></h1>';

include_once("template/templateHead.php");
?>

<!-- ********************************************************** -->
<!-- ********************************************************** -->
<!-- ********************************************************** -->
<div class="row">
    <div class="col-md-12">
        <form role="form" onsubmit="return false;" id="formPersonas" action="../backend/controller/personasController.php">
            <div class="row">
                <!-- ******************************************************** -->
                <!-- Campos de formulario      -->
                <!-- ******************************************************** -->
                <div class="col-md-12">

                    <div class="form-group" id="groupidpersonas">
                        <label for="txtidpersonas">idpersonas</label>
                        <input type="text" class="form-control" id="txtidpersonas"  placeholder="idpersonas">
                    </div>
                    <div class="form-group" id="groupnombre">
                        <label for="txtnombre">nombre</label>
                        <input type="text" class="form-control" id="txtnombre"  placeholder="nombre">
                    </div>
                    <div class="form-group" id="groupapellido1">
                        <label for="txtapellido1">apellido1</label>
                        <input type="text" class="form-control" id="txtapellido1"  placeholder="apellido1">
                    </div>
                    <div class="form-group" id="groupapellido2">
                        <label for="txtapellido2">apellido2</label>
                        <input type="text" class="form-control" id="txtapellido2"  placeholder="apellido2">
                    </div>
                    <div class="form-group" id="groupcorreo_electronico">
                        <label for="txtcorreo_electronico">correo_electronico</label>
                        <input type="text" class="form-control" id="txtcorreo_electronico"  placeholder="correo_electronico">
                    </div>
                    <div class="form-group" id="groupfecha_nacimiento">
                        <label for="fecha_nacimiento">fecha_nacimiento</label>
                        <input type="text" class="form-control" id="txtfecha_nacimiento"  placeholder="fecha_nacimiento">
                    </div>
                    <div class="form-group" id="groupdireccion">
                        <label for="txtdireccion">direccion</label>
                        <input type="text" class="form-control" id="txtdireccion"  placeholder="direccion">
                    </div>
                    <div class="form-group" id="grouptelefono">
                        <label for="txttelefono">telefono</label>
                        <input type="text" class="form-control" id="txttelefono"  placeholder="telefono">
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" id="typeAction" value="add_personas" />                                                                     
                        <button type="submit" class="btn btn-primary" id="enviar">Guardar</button>
                        <button type="reset" class="btn btn-danger" id="cancelar">Cancelar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<br>
<h3>Tabla con informacion de personas</h3>

<br><br>
<div class="row">
    <div class="col-md-12">
        <table id="dt_personas"  class="table  table-hover dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>idpersonas</th>
                    <th>nombre</th>
                    <th>apellido1</th>
                    <th>apellido2</th>
                    <th>correo_electronico</th>
                    <th>fecha_nacimiento</th>
                    <th>direccion</th>
                    <th>telefono</th>
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

