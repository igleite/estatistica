<?php

use src\DiscretosAgrupados\DiscretosAgrupados;

require __DIR__ . "./src/DiscretosAgrupados.php";

$array = array();
//$array[] = 1;
//$array[] = 2;
//$array[] = 4;
//$array[] = 5;
//$array[] = 7;
//$array[] = 9;
//$array[] = 8;
//
//echo "<pre>" . print_r($array, true) . "</pre>";
//
//$media = DiscretosNaoAgrupados::media($array, 3);
//$mediana = DiscretosNaoAgrupados::mediana($array);
//$desvio = DiscretosNaoAgrupados::desvioPadrao($array, 3);
//
//
//echo "<br/>Media: ", $media;
//echo "<br/>Mediana: ", $mediana;
//echo "<br/>Desvio: ", $desvio;


if (!empty($_POST['valores'])) {
    foreach ($_POST['valores'] as $index => $item) {


        $array[$index]['xi'] = $item['xi'];
        $array[$index]['fi'] = $item['fi'];

    }
}

$array = DiscretosAgrupados::calcularColunas($array);


//echo "<pre>" . print_r($array, true) . "</pre>";

$media = DiscretosAgrupados::media($array, 3);
$mediana = DiscretosAgrupados::mediana($array, 3);
$variancia = DiscretosAgrupados::variancia($array, 3);
$desvio = DiscretosAgrupados::desvioPadrao($array, 3);


//echo "<br/>Media: ", $media;
//echo "<br/>Mediana: ", $mediana;
//echo "<br/>Variancia: ", $variancia;
//echo "<br/>Desvio: ", $desvio;


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Estatistica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<div class="container my-2">

    <p>
        Dados Discretos (agrupados)
        <br/>
        – Média
        <br/>
        – Desvio Padrão
        <br/>
        <br/>
        <?php

        if (!empty($array)) {

            echo "<br/>Media: ", $media;
            echo "<br/>Mediana: ", $mediana;
            echo "<br/>Variancia: ", $variancia;
            echo "<br/>Desvio: ", $desvio;

        }
        ?>


    <form method="post" action="">
        <table class="table">
            <tbody id="formulario">
            <?php

            if (empty($array)):
                ?>

                <tr>
                    <th>Xi</th>
                    <th>Fi</th>
                    <th>Ação</th>
                </tr>

            <?php

            else:
                ?>

                <tr>
                    <td></td>
                    <td class="fw-bold">Soma Fi: <?= $array['total']['somaFi'] ?></td>
                    <td class="fw-bold">Soma Xi x Fi: <?= $array['total']['somaXiFi'] ?></td>
                </tr>

                <tr>
                    <th>Xi</th>
                    <th>Fi</th>
                    <th>Xi x Fi</th>
                    <th>Fac</th>
                </tr>

            <?php

            endif;
            ?>

            <input type="hidden" name="qnt_campo" id="qnt_campo"/>

            <?php

            if (!empty($array)):

                foreach ($array as $index => $values) :

                    if ($index != "total") :

                        ?>


                        <tr id="campo<?= $index ?>">
                            <td>
                                <input type="number"
                                       class="form-control border-0"
                                       placeholder="valor"
                                       value="<?= $values['Xi'] ?>"
                                       disabled
                                       name="valores[<?= $index ?>][xi]">
                            </td>
                            <td>
                                <input type="number"
                                       class="form-control border-0"
                                       placeholder="valor"
                                       value="<?= $values['Fi'] ?>"
                                       disabled
                                       name="valores[<?= $index ?>][fi]">
                            </td>
                            <td>
                                <input type="number"
                                       class="form-control border-0"
                                       placeholder="valor"
                                       value="<?= $values['XiFi'] ?>"
                                       disabled
                                       name="valores[<?= $index ?>][XiFi]">
                            </td>
                            <td>
                                <input type="number"
                                       class="form-control border-0"
                                       placeholder="valor"
                                       value="<?= $values['Fac'] ?>"
                                       disabled
                                       name="valores[<?= $index ?>][Fac]">
                            </td>
                        </tr>

                    <?php

                    endif;
                endforeach;

            endif;


            ?>


            </tbody>
        </table>

        <a type="button" class="btn btn-secondary" href="index.php">Home</a>

        <?php

        if (!empty($array)) :

            ?>

            <a type="button" class="btn btn-primary" href="discretos_agrupados.php">Novo calculo</a>

        <?php

        else:

            ?>
            <button type="button" class="btn btn-primary" onclick="adicionarCampo()">Adicionar valores</button>
            <button type="submit" class="btn btn-success">Calcular</button>
        <?php
        endif;
        ?>


    </form>


</div>

<!-- generic -->
<script type="text/javascript">
    var controleCampo = 0;

    function adicionarCampo() {
        controleCampo++;
        document.getElementById('formulario').insertAdjacentHTML('beforeend', '<tr id="campo' + controleCampo + '">' +
            '<td><input type="number" class="form-control" placeholder="xi' + controleCampo + '" required="required" name="valores[' + controleCampo + '][xi]"></td>' +
            '<td><input type="number" class="form-control" placeholder="fi' + controleCampo + '" required="required" name="valores[' + controleCampo + '][fi]"></td>' +
            '<td><input type="button" class="btn btn-danger" id="' + controleCampo + '" onclick="removerCampo(' + controleCampo + ')" value="delete"></td>' +
            '</tr>');
        document.getElementById("qnt_campo").value = controleCampo;
    }

    function removerCampo(idCampo) {
        document.getElementById('campo' + idCampo).remove();
    }
</script>


</body>
</html>
