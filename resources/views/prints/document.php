<?php

use mvc\config\configClass as config;
use mvc\session\sessionClass as session;

$id = documentoTableClass::ID;
$idUsuario = documentoTableClass::USUARIO_ID;
$idvendedor = documentoTableClass::VENDEDOR_ID;
$idTipo = documentoTableClass::TIPO_ID;
$consecutivo = documentoTableClass::CONSECUTIVO;
$fecha = documentoTableClass::FECHA;
$idTerceros = documentoTableClass::TERCEROS_ID;
$idDescuentos = documentoTableClass::DESCUENTOS_ID;
$dias = documentoTableClass::DIAS;
$descuento = documentoTableClass::DESCUENTO;
$anticipo = documentoTableClass::ANTICIPO;
$elaborado = documentoTableClass::ESTATUS;
$cerrado = documentoTableClass::CERRADO;
$anulado = documentoTableClass::ANULADO;
$retefuente = documentoTableClass::RETEUENTE;
$reteica = documentoTableClass::RETEICA;
$revisado = documentoTableClass::REVISADO;
$impresion = documentoTableClass::IMPRESION;
$observacion = documentoTableClass::OBSERVACION;
$desto_valor = documentoTableClass::DESTO_VALOR;

$idDetalle = documentoDetalleTableClass::ID;
$idDocumento = documentoDetalleTableClass::DOCUMENTO_ID;
$idProducto = documentoDetalleTableClass::PRODUCTO_ID;
$idPuc = documentoDetalleTableClass::PUC_ID;
$descripcion = documentoDetalleTableClass::DESCRIPCION;
$cantidad = documentoDetalleTableClass::CANTIDAD;
$costo = documentoDetalleTableClass::COSTO;
$obDetalle = documentoDetalleTableClass::OBSERVACION;
$descDetalle = documentoDetalleTableClass::DESCUENTO;
$opDocumento = documentoDetalleTableClass::DOC_CRUCE;

$idSetup = setupTableClass::ID;
$nit = setupTableClass::NIT;
$representante = setupTableClass::REPRESENTANTE;
$razon_social = setupTableClass::RAZON_SOCIAL;
$responsabilidad_sociedad = setupTableClass::RESPONABILIDAD_SOCIEDAD;
$direccion = setupTableClass::DIRECCION;
$ciudad = setupTableClass::CIUDAD;
$pais = setupTableClass::PAIS;
$celular = setupTableClass::CELULAR;
$email = setupTableClass::EMAIL;
// echo '<pre>';
// print_r($objSetup);
// print_r($objDocumento);
// print_r($objDetalle);
// print_r($objFormaPago);
// print_r($objLogo);
// echo '</pre>';
//exit();
$img = 'img/logo-facturacion-electronica.png';
if (isset($objLogo) and count($objLogo) > 0 and $objLogo->name_file != '') {
    $img = 'upload/setup/' . $objLogo->name_file;
}
?>
<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i');

    *{
        font-family: 'Open Sans', sans-serif;
        font-size: 12px;
    }
    #title_document{
        font-size: 20px;
        border-bottom: 1px solid #252525;
    }
    #data_title{
        border: 1px solid #252525;
    }
    #data_client{
        border: 1px solid #252525;
    }
    #foot{
        background-color: #252525;
        border: 1px solid #252525;
    }
    #logo{
        width: 100px;
        height: 50px;
    }
    #table2{
        border: 1px solid #252525;
    }
    #img_redes{
        height: 15px;
        vertical-align: -webkit-baseline-middle;
    }
    #consecutivo_document{
        text-align: right;
    }
</style>
<body id="imprimir">
    <input type="hidden" id="idSetup" value="<?php echo $objSetup->$idSetup; ?>">
    <input type="hidden" id="rutaLogo" value="<?php echo config::getUrlBase() . 'upload/setup/' ?>">
    <input type="hidden" id="urlTraerLogo" value="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('setup', 'ajaxTraerLogo'); ?>">
    <script type="text/php">
        if (isset($pdf)) {

        $w = $pdf->get_width();
        $h = $pdf->get_height();
        $font = Font_Metrics::get_font("helvetica", "bold");
        $pdf->page_text($w - 85, $h - 40, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0,0,0));
        }
    </script>
<!-- <img style="" id="logo" src="<?php echo config::getUrlBase() . $img ?>"> -->
    <div style="" id="page-wrapper">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="factura" style="text-align:center; padding: 10px 0px;">
<!--            <tr>
                <th colspan="5" id="title_document">jhonny</th>
            </tr>-->
            <tr>
                <th colspan="5" id="consecutivo_document"><span class="pull-right"><?php echo ($objDocumento->sin_consecutivo == '1') ? $objDocumento->consecutivo :'&nbsp;'; ?></span></th>
            </tr>
            <tr>
                <th id="data_title">FECHA</th>
                <th id="data_title"><?php echo ($objDocumento->sin_consecutivo == '1') ? '' : $objDocumento->consecutivo; ?></th>
                <th id="data_title" rowspan="3">
                    <div><?php echo $objSetup->telefono; ?></div>
                    <div><img id="img_redes" src="<?php echo config::getUrlBase() . 'img/wa_xplod.png' ?>"></div>
                </th>
                <th id="data_title" rowspan="3">
                    <div>XPLOD.NY</div>
                    <div><img id="img_redes" src="<?php echo config::getUrlBase() . 'img/igxplod.png' ?>"></div>
                </th>
                <th id="data_title" rowspan="3">
                    <div>XPLOD.NY</div>
                    <div><img id="img_redes" src="<?php echo config::getUrlBase() . 'img/face_xplod.png' ?>"></div>
                </th>
            </tr>
            <tr>
                <td id="data_title" rowspan="2"><?php echo $objDocumento->fecha; ?></td>
                <th id="data_title">Medio de pago</th>
            </tr>
            <tr>
                <td id="data_title">
                    <?php $flag = false; ?>
                    <?php if (isset($objFormaPago) and count($objFormaPago[0]) > 0): ?>
                        <?php foreach ($objFormaPago as $value): ?>
                            <?php if ($flag === false): ?>
                                <?php
                                echo $value->nom_forma_pago;
                                $flag = true
                                ?>
                            <?php else: ?>
                                <?php echo ', ' . $value->nom_forma_pago; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        &nbsp;
                    <?php endif; ?>
                </td>
            </tr>
            <!-- DATOS DEL CLIENTE -->
            <tr>
                <th id="data_client">NOMBRE</th>
                <td id="data_client" colspan="2" style="text-align: left;padding-left: 3px;"><?php echo $objDocumento->nom_tercero; ?></td>
                <th id="data_client">DOCUMENTO</th>
                <td id="data_client" style="text-align: left;padding-left: 3px;"><?php echo $objDocumento->doc_tercero; ?></td>
            </tr>
            <tr>
                <th id="data_client">CORREO</th>
                <td id="data_client" colspan="2" style="text-align: left;padding-left: 3px;"><?php echo $objDocumento->email_tercero; ?></td>
                <th id="data_client">TELÉFONO</th>
                <td id="data_client" style="text-align: left;padding-left: 3px;"><?php echo $objDocumento->tel_tercero; ?></td>
            </tr>
            <tr><td id="table2" colspan="5" style="background-color: #c1c1c1">&nbsp;</td></tr>
            <!-- DETALLE DEL DOCUMENTO -->
            <tr>
                <td colspan="5">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                        <thead>
                            <tr>
                                <th id="table2" width="5%">CANT</th>
                                <th id="table2" width="13%">CÓDIGO</th>
                                <th id="table2" width="14%">CATEGORIA</th>
                                <th id="table2" width="25%">DESCRIPCIÓN</th>
                                <th id="table2" width="14%">V. UNIT</th>
                                <th id="table2" width="14%">DESC. UNIT</th>
                                <th id="table2" width="15%">V. TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?PHP $total = 0; ?>
                            <?PHP $desto = 0; ?>
                            <?PHP $iva = 0; ?>
                            <?php foreach ($objDetalle as $value): ?>
                                <tr>
                                    <td id="table2"><?php echo $value->cantidad ?></td>
                                    <td id="table2"><?php echo $value->cod_producto ?></td>
                                    <td id="table2"><?php echo $value->categoria ?></td>
                                    <td id="table2" style="text-align: left;padding-left: 3px;"><?php echo $value->prod_descripcion ?></td>
                                    <td id="table2"><?php echo '$ ' . number_format((($objDocumento->genera_utilidad == '0') ? 0 : $value->venta), 2) ?></td>
                                    <td id="table2"><?php echo '- $ ' . number_format($value->descuento) ?></td>
                                    <td id="table2" style="text-align: right;padding-right: 3px;"><?php echo '$ ' . number_format($value->cantidad * (($objDocumento->genera_utilidad == '0') ? ($value->costo - $value->descuento) : ($value->venta - $value->descuento)), 2) ?></td>
                                </tr>
                                <?PHP $desto = $desto + $value->descuento; ?>
                                <?PHP $total = $total + ($value->cantidad * (($objDocumento->genera_utilidad == '0') ? $value->costo : $value->venta)); ?>
                                <?PHP $iva = $iva + ($value->cantidad * (($objDocumento->genera_utilidad == '0') ? ($value->costo - $value->descuento) : ($value->venta - $value->descuento))) * $value->iva / 100; ?>
                            <?php endforeach; ?>
                            <?php for ($i = 1; $i <= (9 - COUNT($objDetalle)); $i++): ?>
                                <tr>
                                    <td id="table2">&nbsp;</td>
                                    <td id="table2">&nbsp;</td>
                                    <td id="table2">&nbsp;</td>
                                    <td id="table2">&nbsp;</td>
                                    <td id="table2">&nbsp;</td>
                                    <td id="table2">&nbsp;</td>
                                    <td id="table2">&nbsp;</td>
                                </tr>
                            <?php endfor; ?>
                            <tr>
                                <td id="table2" colspan="7" style="background-color: #c1c1c1">&nbsp;</td>
                                <td></td>
                            </tr>
                        </tbody>
                        <!-- PIE DEL DOCUMENTO -->
                        <tfoot>
                            <tr>
                                <th id="table2" colspan="2" rowspan="3"><img style="" id="logo" src="<?php echo config::getUrlBase() . $img ?>"></th>
                                <th id="table2" colspan="3">PROMOCIÓN NO TIENE CAMBIO</th>
                                <th id="table2" style="text-align: right;">SUBTOTAL</th>
                                <?php $total = $total - $desto -  $objDocumento->descuento?>
                                <th id="table2" style="text-align: right;padding-right: 3px;"><?PHP echo '$ ' . number_format($total, 2); ?></th>
                            </tr>
                            <tr>
                                <th id="table2" colspan="3">NO SE REALIZA REEMBOLSO </th>
                                <th id="table2" style="text-align: right;"><?PHP echo number_format(19, 1) . '%' ?> IVA</th>
                                <?PHP $valorIva = $objDocumento->valor_iva; ?>
                                <?PHP $subtotal = $total + ($valorIva); ?>
                                <th id="table2" style="text-align: right;padding-right: 3px;"><?PHP echo '$ ' . number_format(round($valorIva), 2); ?></th>
                            </tr>
                            <tr>
                                <th id="table2" colspan="3" rowspan="2">
                                    LOS CAMBIOS SE REALIZAN EN UN PLAZO DE 15 DIAS, DE LUNES A VIERNES, RECUERDE PRESENTAR SU FACURA AL MOMENTO DE REALIZAR UN CAMBIO
                                </th>
                                <th id="table2" style="text-align: right;">TOTAL</th>
                                <?php $subtotal = round($subtotal,0); ?>
                                <th id="table2" style="text-align: right;padding-right: 3px;"><?PHP echo '$ ' . number_format(roundToTheNearestAnything($subtotal, 10),2); ?></th>
                            </tr>
                            <tr>
                                <th id="table2" colspan="2">IVA REGIMEN COMUN</th>
                                <th id="table2" style="text-align: right;">DESCUENTO</th>
                                <?php $desto = round($objDocumento->descuento_valor + $objDocumento->descuento,0); ?>
                                <th id="table2" style="text-align: right;padding-right: 3px;"><?PHP echo '$ ' . number_format(roundToTheNearestAnything($desto, 10), 2); ?></th>
                            </tr>
                            <tr>
                                <th id="foot" style="background-color: #c1c1c1;">ASESOR</th>
                                <th id="foot" style="background-color: #c1c1c1;"><?PHP echo tercerosTableClass::getNombreTerceros($objDocumento->vendedor_id) ?></th>
                                <th id="foot" style="background-color: #c1c1c1;" colspan="3">GRACIAS POR SU COMPRA!</th>
                                <th id="foot" style="text-align: right;background-color: #c1c1c1;">TOTAL</th>
                                <?php $totalF = round($subtotal - $objDocumento->descuento_valor,0); ?>
                                <th id="foot" style="text-align: right;padding-right: 3px;background-color: #c1c1c1;"><?PHP echo '$ ' . number_format(roundToTheNearestAnything($totalF, 10), 2); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>

        </table>

    </div>
</body>
<?php
function roundToTheNearestAnything($value, $roundTo) {
    $mod = $value % $roundTo;
    return $value + ($mod < ($roundTo / 2) ? -$mod : $roundTo - $mod);
}
?>
<script src="<?php echo config::getUrlBase2().'web/js/jquery-2.1.1.js' ?>"></script>
<script  type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: $('#urlTraerLogo').val(),
            dataType: 'json',
            data: 'id=' + $('#idSetup').val(),
            type: 'POST',
            success: function (data) {
                console.log(data);
                if (data.datos != false || data.datos != '') {
                    $(data.datos).each(function (index, element) {
                        var ruta = $('#rutaLogo').val();
                        ruta = ruta + element.name_file;
                        var http = new XMLHttpRequest();
                        http.open('HEAD', ruta, false);
                        http.send();
                        if (http.status != 404) {
                            $('#logo').attr('src', ruta);
                        }
                        setTimeout('printHTML()', 300);
                    });
                } else {
                    setTimeout('printHTML()', 300);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                data = {
                    error: jqXHR + ' - ' + textStatus + ' - ' + errorThrown
                }
                $('#modal' + 1).modal('toggle');
                $('body').append('<div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="myModalLabel">ERROR EN TRANSACCIÓN</h4></div><div class="modal-body">' + data.error + '</div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button></div></div></div></div>');
                $('#modalError').modal({show: true});
            }
        });

        Number.prototype.padLeft = function (base, chr) {
            var len = (String(base || 10).length - String(this).length) + 1;
            return len > 0 ? new Array(len).join(chr || '0') + this : this;
        }
        var d = new Date,
                dformat = [d.getFullYear(),
                    (d.getMonth() + 1).padLeft(),
                    d.getDate().padLeft()].join('-') + ' ' +
                [d.getHours().padLeft(),
                    d.getMinutes().padLeft(),
                    d.getSeconds().padLeft()].join(':');
//            lo almaceno en un input llamado 'fecha_creacion' que este en cualquier formulario
        if ($('p[id="fecha_creacionp"]')) {
            $('#fecha_creacionp').text(dformat);
        }

    });

    function roundToTheNearestAnything($value, $roundTo)
    {
        $mod = $value % $roundTo;

        if ($mod < ($roundTo / 2)) {
            return  -$mod;
        } else {
            return $roundTo - $mod;
        }
    }

    function printHTML() {
        if (window.print) {
            window.print();
        }
    }

</script>
