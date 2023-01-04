<?php

namespace src\DiscretosAgrupados;

/**
 * Dados Discretos (agrupados)
 */
class DiscretosAgrupados
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

        foreach ($data as $index => $item) {

            $somaFi += $item['fi'];
            $fac += $item['fi'];
            $somaXiFi += $item['xi'] * $item['fi'];


            $array[$index]['Xi'] = $item['xi'];
            $array[$index]['Fi'] = $item['fi'];
            $array[$index]['XiFi'] = $item['xi'] * $item['fi'];
            $array[$index]['Fac'] = $fac;

        }

        $array['total']['somaFi'] = $somaFi;
        $array['total']['somaXiFi'] = $somaXiFi;

        return $array;

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
     * @return mixed
     */
    public static function mediana(array $data, ?int $round = null): mixed
    {
        if (!self::count($data)) {
            return null;
        }

        $posicao = ($data['total']['somaFi'] + 1) / 2;

        $mediana = null;
        foreach ($data as $index => $item) {

            if ($index != "total") {

                if ($item['Fac'] >= $posicao) {

                    $mediana = $item['Xi'];
                    break;

                }

            }


        }

        return self::round($mediana, $round);

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

        $media = self::media($data);
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