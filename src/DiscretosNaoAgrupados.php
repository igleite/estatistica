<?php

namespace src\DiscretosSoltos;

/**
 * Dados Discretos (não agrupados)
 */
class DiscretosNaoAgrupados
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
     * @param int|null $round
     * @return int|float|null
     */
    public static function media(array $data, ?int $round = null): int|float|null
    {
        if (!self::count($data)) {
            return null;
        }

        $sum = array_sum($data);

        return self::round($sum / self::count($data), $round);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function mediana(array $data): mixed
    {
        $count = self::count($data);
        if (!$count) {
            return null;
        }

        sort($data);

        $var = $count % 2 == 0;

        $valor1 = $count / 2;
        if ($var) {
            $valor2 = $count / 2 - 1;
            $mediana = ($data[$valor1] + $data[$valor2]) / 2;
        } else {
            $mediana = $data[$valor1];
        }

        return $mediana;

    }

    /**
     * @param array $data
     * @param int|null $round
     * @return float|null
     */
    public static function desvioPadrao(array $data, ?int $round = null): float|null
    {
        $count = self::count($data);
        if (!$count) {
            return null;
        }

        $variance = self::variancia($data, $round);
        return self::round(sqrt($variance), $round);
    }

    /**
     * @param array $data
     * @param int|null $round
     * @return float|null
     */
    public static function variancia(array $data, ?int $round = null): float|null
    {

        $count = self::count($data);
        if (!$count) {
            return null;
        }

        $somaDasDiferencasObtidas = 0.0;
        $media = self::media($data);

        // percorre todos os valores do array
        foreach ($data as $i) {

            // Diferença entre cada elemento e a média:
            // (valor - media) elevada ao expoente

            $somaDasDiferencasObtidas += pow(($i - $media), 2);
        }

        var_dump($count);

        return self::round($somaDasDiferencasObtidas / ($count), $round);
    }

}