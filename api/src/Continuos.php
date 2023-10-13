<?php

namespace src\Continuos;

/**
 * Dados Contínuos
 */
class Continuos
{

    /**
     * @param float $value
     * @param int|null $round
     * @return float
     */
    public static function round(float $value, ?int $round): float
    {
        return is_null($round) ? $value : round($value, $round);
    }

    /**
     * @param array $data
     * @return int
     */
    public static function count(array $data): int
    {
        return count($data);
    }

    /**
     * @param array $data
     * @return array|null
     */
    public static function calcularColunas(array $data): array|null
    {
        $array = array();

        if (!self::count($data)) {
            return $array;
        }

        $fac = 0;
        $somaFi = 0;
        $somaXiFi = 0;
        $menor = null;
        $maior = null;

        foreach ($data as $index => $item) {

            $xi = ($item['Inferior'] + $item['Superior']) / 2;
            $somaFi += $item['Fi'];
            $somaXiFi += $xi * $item['Fi'];
            $fac += $item['Fi'];


            $array[$index]['Inferior'] = $item['Inferior'];
            $array[$index]['Superior'] = $item['Superior'];
            $array[$index]['Fi'] = $item['Fi'];
            $array[$index]['Xi'] = $xi;
            $array[$index]['XiFi'] = ($xi) * $item['Fi'];
            $array[$index]['Fac'] = $fac;

            if (empty($menor)) {
                $menor = $item['Inferior'];
            }

            if (empty($maior)) {
                $maior = $item['Superior'];
            } elseif ($maior < $item['Superior']) {
                $maior = $item['Superior'];
            }

        }

        $array['total']['somaFi'] = $somaFi;
        $array['total']['somaXiFi'] = $somaXiFi;
        $array['total']['menorValor'] = $menor;
        $array['total']['maiorValor'] = $maior;


        return $array;

    }

    /**
     * @param array $data
     * @return int
     */
    public static function calculaComprimentoClasse(array $data): int
    {
        $menorValor = $data['total']['menorValor'];
        $maiorValor = $data['total']['maiorValor'];
        $total = $data['total']['somaFi'];


        $c = ($maiorValor - $menorValor);
        $c = $c / (self::count($data) - 1);

        return $c;


//        var_dump($c);


//        $aT = $maiorValor - $menorValor;
//
//        $k = sqrt($total);
//        $c = $aT / $k;
//
//
//
//        $whole = (int)$c;
//        $frac = $c - $whole;
//
//        if (substr($frac, 0, 4) >= 0.45) {
//            $c = ceil($c);
//        } else {
//            $c = floor($c);
//        }
//
//        var_dump($c);
//
//        return $c;
    }

    /**
     * @param array $data
     * @param int|null $round
     * @return int|float|null
     */
    public static function media(array $data, ?int $round = null): int|float|null
    {

        if (!self::count($data)) {
            return null;
        }

        $somaFi = $data['total']['somaFi'];
        $somaXiFi = $data['total']['somaXiFi'];

        return self::round($somaXiFi / $somaFi, $round);
    }


    /**
     * @param array $data
     * @param int|null $round
     * @return array
     */
    public static function mediana(array $data, ?int $round = null): array
    {
        $array = array();

        if (!self::count($data)) {

            $array['Inferior'] = null;
            $array['Superior'] = null;
            $array['Mediana'] = null;
            return $array;

        }

        $posicaoFac = ($data['total']['somaFi']) / 2;
//        var_dump($posicaoFac);

        $inferior = 0;
        $superior = 0;
        $mediana = 0;
        foreach ($data as $index => $item) {

            if ($index != "total") {

                if ($item['Fac'] >= $posicaoFac) {

                    $inferior = $item['Inferior'];
                    $superior = $item['Superior'];
                    $frequencia = $item['Fi'];

                    $faca = 0;
                    if (!$index == 0) {
                        $faca = $data[$index - 1]['Fac'];
                    }

                    $mediana = ((($posicaoFac - $faca) * self::calculaComprimentoClasse($data)) / $frequencia) + $inferior;

                    break;

                }

            }


        }

//        var_dump(self::calculaComprimentoClasse($data));


        $array['Inferior'] = $inferior;
        $array['Superior'] = $superior;
        $array['Mediana'] = self::round($mediana, $round);

        return $array;
    }

    /**
     * @param array $data
     * @param int|null $round
     * @return float|null
     */
    public static function variancia(array $data, ?int $round = null): float|null
    {
        if (!self::count($data)) {
            return null;
        }

        $media = self::media($data, $round);
        $soma = 0;
        foreach ($data as $index => $item) {
            if ($index != "total") {

                $soma += pow($item['Xi'] - $media, 2) * $item['Fi'];

            }
        }


        $variancia = $soma / ($data['total']['somaFi']);

        return self::round($variancia, $round);
    }

    /**
     * @param array $data
     * @param int|null $round
     * @return float|null
     */
    public static function desvioPadrao(array $data, ?int $round = null): float|null
    {
        if (!self::count($data)) {
            return null;
        }

        $variance = self::variancia($data, $round);

        return self::round(sqrt($variance), $round);
    }
}