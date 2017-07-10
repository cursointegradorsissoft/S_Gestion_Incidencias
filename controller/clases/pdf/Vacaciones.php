<?php
    require_once('html2pdf.class.php');
    ob_start();
?>

<style type="text/css">
    table.page_header {width: 100%; background: #E0F8F7; border-bottom: solid 1mm #0B243B; padding: 2mm; }
    table.page_footer {width: 100%; background: #E0F8F7; border-top: solid 1mm #0B243B; padding: 2mm; }
    ul.main { width: 95%; list-style-type: square; }
    ul.main li { padding-bottom: 2mm; }
    h1 { text-align: center; font-size: 20mm; }
    h3 { text-align: center; font-size: 14mm; }
    .logo{width: 100%; border-bottom:solid 0.5mm #1C1C1C; overflow: hidden; height: 7%; }

    .logo .left{width: 15%; overflow: hidden; height: 100%; float: left; }
    .logo .medium{width: 65%; overflow: hidden; height: 100%; font-size: 9mm;  padding-top: 2mm;  margin-top: -18.5mm; margin-left: 47mm; }
    .logo .right{width: 20%; overflow: hidden; height: 100%; margin-top: -18.5mm;  padding-top: 5mm; padding-left: 15mm; margin-left: 152mm }
    .logo .left img{ width: 100%; height: 70%; margin-top: 2mm; }

    .tabla{width: 90%; }
    .tabla .content-izq{width: 45%; height: 2%; font-size: 4mm; padding-left: 15mm; }
    .tabla .content-der{width: 65%; height: 2%; font-size: 4mm; }
</style>

<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 12pt">
    <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 50%; text-align: left; color:#585858">
                   Documento de Solicitud Vacaciones
                </td>
                <td style="width: 50%; text-align: right"></td>
            </tr>
        </table>
    </page_header>

    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;">Departamento de Recursos Humanos</td>
                <td style="width: 34%; text-align: center">[[page_cu]]/[[page_nb]]</td>
                <td style="width: 33%; text-align: right">www.BraillardPeru.com</td>
            </tr>
        </table>
    </page_footer>


    <div class="contenedor" style="height:100%; width: 100%; ">
        <div class='logo'>
            <div class="left">
               <img src="tcpdf/slogan.png"> 
            </div>

            <div class="medium">
                Registro de Vacaciones
            </div>

            <div class="right">
                <?php echo date("d/m/Y"); ?>
            </div>
        </div>


        <table class="tabla">

            <tr><td class="content-izq"></td></tr>
            <tr>
                <td class="content-izq">Nombres y Apellidos</td>
                <td class="content-der"><?php echo $nombre; ?></td>
            </tr>

            <tr><td class="content-izq"></td></tr>
            <tr>
                <td class="content-izq">Area</td>
                <td class="content-der"><?php echo $area; ?></td>
            </tr>


            <tr><td class="content-izq"></td></tr>
            <tr>
                <td class="content-izq">Cargo</td>
                <td class="content-der"><?php echo $cargo; ?></td>
            </tr>

            <tr><td class="content-izq"></td></tr>
            <tr>
                <td class="content-izq">Periodo</td>
                <td class="content-der"><?php echo $periodo; ?></td>
            </tr>

            <tr><td class="content-izq"></td></tr>
            <tr>
                <td class="content-izq">Fecha Inicio</td>
                <td class="content-der"><?php echo $inicio; ?></td>
            </tr>

            <tr><td class="content-izq"></td></tr>
            <tr>
                <td class="content-izq">Fecha Fin</td>
                <td class="content-der"><?php echo $fin; ?></td>
            </tr>

            <tr><td class="content-izq"></td></tr>
            <tr>
                <td class="content-izq">Canridad de Dias</td>
                <td class="content-der"><?php echo $total; ?></td>
            </tr>

            <tr><td class="content-izq"></td></tr>
            <tr>
                <td class="content-izq">Fecha de Regreso</td>
                <td class="content-der"><?php echo $retorno; ?></td>
            </tr>

            <tr><td class="content-izq"></td></tr>
            <tr>
                <td class="content-izq">Observaciones</td>
                <td class="content-der"><?php echo $obser; ?></td>
            </tr>
        </table>

    </div>
</page>

<!-- <page pageset="old"> </page> -->

<?php
    $content = ob_get_clean();
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Vacaciones.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>