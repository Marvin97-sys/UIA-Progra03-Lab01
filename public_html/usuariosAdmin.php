<?php
$templateTitle = 'Mantenimiento de Usuarios';
$templateScripts = '<script type="text/javascript" src="js/usuariosFunctions.js"></script>';
$templatePageHeader = '<h1><Nombre Sistema><small> Mantenimiento de Usuarios</small><img src="img/logo/logo.png" align="right"/></h1>';

include_once("template/templateHead.php");
?>

<!-- ********************************************************** -->
<!-- ********************************************************** -->
<!-- ********************************************************** -->
<div class="row">
    <div class="col-md-12">
        <form role="form" onsubmit="return false;" id="formUsuarios">
            <div class="row">
                <!-- ******************************************************** -->
                <!-- Campos de formulario      -->
                <!-- ******************************************************** -->
                <div class="col-md-12">

                    <div class="form-group" id="groupidusuario">
                        <label for="txtidusuario">idusuario</label>
                        <input type="text" class="form-control" id="txtidusuario"  placeholder="idusuario">
                    </div>
                    <div class="form-group" id="groupcontraseña">
                        <label for="txtcontraseña">contraseña</label>
                        <input type="text" class="form-control" id="txtcontraseña"  placeholder="contraseña">
                    </div>
                    <div class="form-group" id="groupfecha_registro">
                        <label for="txtfecha_registro">fecha_registro</label>
                        <input type="text" class="form-control" id="txtfecha_registro"  placeholder="fecha_registro">
                    </div>
                    <div class="form-group" id="groupfecha_actualizacion">
                        <label for="fecha_actualizacion">fecha_actualizacion</label>
                        <input type="text" class="form-control" id="txtfecha_actualizacion"  placeholder="fecha_actualizacion">
                    </div>
                    <div class="form-group" id="grouppersonas_idpersonas">
                        <label for="txtpersonas_idpersonas">personas_idpersonas</label>
                        <input type="text" class="form-control" id="txtpersonas_idpersonas"  placeholder="personas_idpersonas">
                    </div>
                    
                    
                    <div class="form-group">
                        <input type="hidden" id="typeAction" value="add_usuarios" />
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
<h3>Tabla con informacion de usuarios</h3>
<br><br>
<div class="row">
    <div class="col-md-12">
        <div id="divResult" style="text-align:center;">Resultado de la consulta</div>
    </div>
</div>
<?php
include_once("template/templateFooter.php");
?>