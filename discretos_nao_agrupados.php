<?php

use src\DiscretosSoltos\DiscretosNaoAgrupados;

require __DIR__ . "./src/DiscretosNaoAgrupados.php";

//$array = array();
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


$array = array();


foreach ($_POST as $item) {
    $array[] = $item;
}

$media = null;
$mediana = null;
$variancia = null;
$devioPadrao = null;

if (!empty($array)) {
    $media = "Média: " . DiscretosNaoAgrupados::media($array);
    $mediana = "Mediana: " . DiscretosNaoAgrupados::mediana($array);
    $variancia = "Variância: " . DiscretosNaoAgrupados::variancia($array, 3);
    $devioPadrao = "Desvio Padrão: " . DiscretosNaoAgrupados::desvioPadrao($array, 3);

}

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
        Calcular: Dados Discretos (não agrupados)
        <br/>
        – Média
        <br/>
        – Desvio Padrão
        <br/>
        <br/>
        <br/>
        <br/>
        Insira aqui um conjunto de dados (não precisa estar ordenado) para o cálculo.
    </p>

    <form method="post" action="">
        <table id="employee-table" class="table">
            <tbody>

            <?php

            if (empty($array)):
                ?>

                <tr>
                    <th>Valores</th>
                    <th>Ação</th>
                </tr>

            <?php

            else:
                ?>

                <tr>
                    <th>Valores</th>
                </tr>

            <?php

            endif;
            ?>


            <?php

            if (!empty($_POST)):

                foreach ($_POST as $values) :

                    ?>

                    <tr>

                        <td>
                            <input type="number"
                                   class="form-control border-0"
                                   placeholder="valor1"
                                   disabled
                                   value="<?= $values ?>"
                                   name="valor<?= $values ?>">
                        </td>

                    </tr>

                <?php

                endforeach;

            endif;


            ?>

            </tbody>
        </table>

        <a type="button" class="btn btn-secondary" href="index.php">Home</a>

        <?php

        if (!empty($array)) :

            ?>

            <a type="button" class="btn btn-primary" href="discretos_nao_agrupados.php">Novo calculo</a>

        <?php

        else:

            ?>
            <button type="button" class="btn btn-primary" onclick="addNewRow()">Adicionar valores</button>
            <button type="submit" class="btn btn-success">Calcular</button>
        <?php
        endif;
        ?>


    </form>

    <div class="col-12 mt-4">
        <p class="fw-bold"><?= $media ?></p>
        <p class="fw-bold"><?= $mediana ?></p>
        <p class="fw-bold"><?= $variancia ?></p>
        <p class="fw-bold"><?= $devioPadrao ?></p>
    </div>

</div>

<!-- generic -->
<script type="text/javascript">
    /* This method will add a new row */
    function addNewRow() {
        var table = document.getElementById("employee-table");
        var rowCount = table.rows.length;
        var cellCount = table.rows[0].cells.length;

        var row = table.insertRow(rowCount);
        for (var i = 0; i < cellCount; i++) {
            var cell = row.insertCell(i);
            if (i < cellCount - 1) {
                cell.innerHTML = '<input type="number" class="form-control" placeholder="valor" required="required" name="valores' + rowCount + '"/>';
            } else {
                cell.innerHTML = '<input type="button" class="btn btn-danger" value="delete" onclick="deleteRow(this)" />';
            }
        }
    }

    /* This method will delete a row */
    function deleteRow(ele) {
        var table = document.getElementById('employee-table');
        var rowCount = table.rows.length;
        if (rowCount <= 1) {
            alert("There is no row available to delete!");
            return;
        }
        if (ele) {
            //delete specific row
            ele.parentNode.parentNode.remove();
        } else {
            //delete last row
            table.deleteRow(rowCount - 1);
        }
    }
</script>


</body>
</html>