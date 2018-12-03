<?php

namespace Src\traits;

trait Security {

    private function crypto($str, $create) {
        $string = (string) ($create == true) ? base64_encode(utf8_encode($str)) : substr(base64_decode($str), 4);
        $lines = strlen($string) / 4;

        $strBreak = array(
            'on' => substr($string, 0, $lines),
            'tw' => substr($string, $lines * 1, $lines),
            'th' => substr($string, $lines * 2, $lines),
            'fo' => substr($string, $lines * 3, $lines)
        );

        if ($create == true) {
            $newStr = base64_encode(date('md') . $strBreak['tw'] . $strBreak['fo'] . $strBreak['on'] . $strBreak['th']);
        } else {
            $newStr = $strBreak['th'] . $strBreak['on'] . $strBreak['fo'] . $strBreak['tw'];
            $newStr = utf8_decode(base64_decode($newStr));
        }

        return $newStr;
    }

    /**
     * Criptografa a string
     * 
     * @param type $str = String de entrada
     */
    public function encrypt($str) {
        return $this->crypto($str, true);
    }

    /**
     * Decriptografa a string
     * 
     * @param type $str String criptografada
     */
    public function decrypt($str) {
        return $this->crypto($str, false);
    }

}
