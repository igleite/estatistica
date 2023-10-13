<?php

use src\Continuos\Continuos;

require __DIR__ . "./src/Continuos.php";

$array = array();
//$array[0]['Inferior'] = 2;
//$array[0]['Superior'] = 4;
//$array[0]['Fi'] = 4;
//
//$array[1]['Inferior'] = 4;
//$array[1]['Superior'] = 6;
//$array[1]['Fi'] = 8;
//
//$array[2]['Inferior'] = 6;
//$array[2]['Superior'] = 8;
//$array[2]['Fi'] = 5;
//
//$array[3]['Inferior'] = 8;
//$array[3]['Superior'] = 10;
//$array[3]['Fi'] = 3;

//$array[0]['Inferior'] = 153;
//$array[0]['Superior'] = 159;
//$array[0]['Fi'] = 2;
//
//$array[1]['Inferior'] = 159;
//$array[1]['Superior'] = 165;
//$array[1]['Fi'] = 5;
//
//$array[2]['Inferior'] = 165;
//$array[2]['Superior'] = 171;
//$array[2]['Fi'] = 8;
//
//$array[3]['Inferior'] = 171;
//$array[3]['Superior'] = 177;
//$array[3]['Fi'] = 6;
//
//$array[4]['Inferior'] = 177;
//$array[4]['Superior'] = 183;
//$array[4]['Fi'] = 4;


//$array[0]['Inferior'] = 50;
//$array[0]['Superior'] = 54;
//$array[0]['Fi'] = 4;
//
//$array[1]['Inferior'] = 54;
//$array[1]['Superior'] = 58;
//$array[1]['Fi'] = 9;
//
//$array[2]['Inferior'] = 58;
//$array[2]['Superior'] = 62;
//$array[2]['Fi'] = 11;
//
//$array[3]['Inferior'] = 62;
//$array[3]['Superior'] = 66;
//$array[3]['Fi'] = 8;
//
//$array[4]['Inferior'] = 66;
//$array[4]['Superior'] = 70;
//$array[4]['Fi'] = 5;
//
//$array[5]['Inferior'] = 70;
//$array[5]['Superior'] = 74;
//$array[5]['Fi'] = 3;

//$array[0]['Inferior'] = 5;
//$array[0]['Superior'] = 8;
//$array[0]['Fi'] = 11;
//
//$array[1]['Inferior'] = 8;
//$array[1]['Superior'] = 11;
//$array[1]['Fi'] = 14;
//
//$array[2]['Inferior'] = 11;
//$array[2]['Superior'] = 14;
//$array[2]['Fi'] = 14;
//
//$array[3]['Inferior'] = 14;
//$array[3]['Superior'] = 17;
//$array[3]['Fi'] = 9;
//
//$array[4]['Inferior'] = 17;
//$array[4]['Superior'] = 20;
//$array[4]['Fi'] = 1;
//
//$array[5]['Inferior'] = 20;
//$array[5]['Superior'] = 23;
//$array[5]['Fi'] = 1;


//$array = Continuos::calcularColunas($array);
//
//echo "<pre>" . print_r($array, true) . "</pre>";
//
//$media = Continuos::media($array, 3);
//$mediana = Continuos::mediana($array, 3);
//$desvio = Continuos::desvioPadrao($array, 3);
//
//
//echo "<br/>Media: ", $media;
//echo "<br/>Mediana: ", $mediana['Mediana'];
//echo "<br/>Classe Mediana: ", $mediana['Inferior'] . " |—— " . $mediana['Superior'];
//
//echo "<br/>Desvio: ", $desvio;


if (!empty($_POST['valores'])) {
    foreach ($_POST['valores'] as $index => $item) {


        $array[$index]['Inferior'] = $item['Inferior'];
        $array[$index]['Superior'] = $item['Superior'];
        $array[$index]['Fi'] = $item['Fi'];

    }
}

$array = Continuos::calcularColunas($array);

//echo "<pre>" . print_r($array, true) . "</pre>";

$media = Continuos::media($array, 3);
$mediana = Continuos::mediana($array, 3);
$variancia = Continuos::variancia($array, 3);
$desvio = Continuos::desvioPadrao($array, 3);


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
        Dados Contínuos
        <br/>
        – Média
        <br/>
        – Desvio Padrão
        <br/>
        <br/>
        <?php

        if (!empty($array)) {

            echo "<br/>Media: ", $media;
            echo "<br/>Mediana: ", $mediana['Mediana'];
            echo "<br/>Variancia: ", $variancia;
            echo "<br/>Desvio: ", $desvio;
            echo "<br/>Classe Mediana: ", $mediana['Inferior'] . " |—— " . $mediana['Superior'];

        }
        ?>


    <form method="post" action="">
        <table class="table">
            <tbody id="formulario">
            <?php

            if (empty($array)):
                ?>

                <tr>
                    <th>Inferior</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Superior</th>
                    <th>Fi</th>
                    <th>Ação</th>
                </tr>

            <?php

            else:
                ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="fw-bold">Soma Fi: <?= $array['total']['somaFi'] ?></td>
                    <td></td>
                    <td class="fw-bold">Soma Xi x Fi: <?= $array['total']['somaXiFi'] ?></td>
                </tr>

                <tr>
                    <th>Inferior</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Superior</th>
                    <th>Fi</th>
                    <th>Xi</th>
                    <th>Xi x Fi</th>
                    <th>Fac</th>
<!--                    <th>Ação</th>-->
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
                                       value="<?= $values['Inferior'] ?>"
                                       disabled
                                       name="valores[<?= $index ?>][Inferior]">
                            </td>
                            <td>
                                |——
                            </td>
                            <td>
                                <input type="number"
                                       class="form-control border-0"
                                       value="<?= $values['Superior'] ?>"
                                       disabled
                                       name="valores[<?= $index ?>][Superior]">
                            </td>
                            <td>
                                <input type="number"
                                       class="form-control border-0"
                                       value="<?= $values['Fi'] ?>"
                                       disabled
                                       name="valores[<?= $index ?>][Fi]">
                            </td>
                            <td>
                                <input type="number"
                                       class="form-control border-0"
                                       value="<?= $values['Xi'] ?>"
                                       disabled
                                       name="valores[<?= $index ?>][Xi]">
                            </td>
                            <td>
                                <input type="number"
                                       class="form-control border-0"
                                       value="<?= $values['XiFi'] ?>"
                                       disabled
                                       name="valores[<?= $index ?>][XiFi]">
                            </td>
                            <td>
                                <input type="number"
                                       class="form-control border-0"
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

            <a type="button" class="btn btn-primary" href="continuos.php">Novo calculo</a>

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
            '<td><input type="number" class="form-control" placeholder="Inferior' + controleCampo + '" required="required" name="valores[' + controleCampo + '][Inferior]"></td>' +
            '<td>|——</td>' +
            '<td><input type="number" class="form-control" placeholder="Superior' + controleCampo + '" required="required" name="valores[' + controleCampo + '][Superior]"></td>' +
            '<td><input type="number" class="form-control" placeholder="Fi' + controleCampo + '" required="required" name="valores[' + controleCampo + '][Fi]"></td>' +
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
