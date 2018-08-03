<?php

namespace Src\traits;

trait Generate {

    /**
     * Gera um PIN aleatório
     * 
     * @param type $length = Quantidade de caracteres (máximo de 8 digitos)
     * @return int
     */
    public function generatePin($length = 4) {
        $range = range(1, 9);

        shuffle($range);
        if ((int) $length > 8) {
            $length = 8;
        }

        return (int) implode(array_slice($range, 0, $length), '');
    }

    /**
     * Gera um código para uso interno
     * 
     * @param type $length = Quantidade de caracteres (Mínimo 12)
     * @param type $camelCase = Habilitar o Camel Case
     */
    public function generateCode($length = null, $camelCase = false) {
        $len = ($length == null || $length < 12) ? 12 : $length;
        $alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        $codeParam['ex'] = '';
        $codeParam[] = $alphabet[array_rand($alphabet, 1)];
        $codeParam[] = $alphabet[array_rand($alphabet, 1)];
        $codeParam[] = (string) rand(1, 9);
        $codeParam[] = date("i");
        $codeParam[] = date("s");
        foreach (explode('|', date("y|m|d|H")) as $Cod) {
            $codeParam['ex'] .= ($Cod < count($alphabet)) ? $alphabet[(int) $Cod] : $Cod;
        }
        shuffle($codeParam);
        $code = implode($codeParam, "");

        if (strlen($code) < $len) {
            $code = $alphabet[array_rand($alphabet, 1)] . $code . $alphabet[array_rand($alphabet, 1)];
            $code = strtoupper(substr(md5(uniqid('')), 0, ($len - strlen($code)))) . $code;
        }

        if ($camelCase == true) {
            $newCode = "";
            foreach (str_split($code) as $cd) {
                $rand = rand(0, 1) == 1;
                $cd = ($rand == true) ? strtoupper($cd) : strtolower($cd);
                $newCode .= $cd;
                $code = $newCode;
            }
        }

        return $code;
    }

}
