<?php

namespace Src\traits;

trait Url {

    private static $format;
    private static $value;

    /**
     * Retorna um array com as URLs
     */
    public function getUrl() {
        $filterGet = filter_input_array(INPUT_GET, array('url' => FILTER_SANITIZE_URL))['url'];
        $url = explode("/", trim($filterGet));

        $lastUrl = count($url) - 1;
        if (count($url) > 1 && $url[$lastUrl] == '') {
            unset($url[$lastUrl]);
        }

        if ($url[0] == '') {
            $url[0] = 'home';
        }

        if (!isset($url[1]) || $url[1] == '') {
            $url[1] = 'pageRender';
        }

        return $url;
    }

    /**
     * Pega a URL atual
     */
    public function getAtualUrl() {
        return implode($this->getUrl(), '/');
    }

    /**
     * Cria uma URL amigável 
     * 
     * @param type $url
     * @return type
     */
    public function createSeoSlug($url) {
        self::$value = strip_tags(trim($url));

        self::$value = str_replace(array("'", '"', "!", "¹", "@", "²", "#", "³", "$", "£", "%", "¢", "¨", "¬", "&", "*", "(", ")", "_", "=", "§", "´", "`", "[", "{", "ª", "^", "~", "]", "}", "º", "/", "?", "°", ";", ":", ">", "<", ".", ",", "|", "\\", "*", "¨¨", "¿", "®", "×", "½", "¼", "¡", "«", "»", "©", "¢", "++"), '', self::$value);
        self::$value = str_replace(array(' '), '+', self::$value);
        self::$value = str_replace(array('++'), '+', self::$value);
        self::$value = str_replace(array('"', "'"), '', self::$value);
        return self::$value;
    }

    /**
     * Cria uma URL limpa
     * 
     * @param type $url
     * @return type
     */
    public function createCleanSlug($url) {
        self::$value = $url;
        self::$format = array();
        self::$format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        self::$value = str_replace(array("'", '"', "!", "¹", "@", "²", "#", "³", "$", "£", "%", "¢", "¨", "¬", "&", "*", "(", ")", "_", "=", "§", "´", "`", "[", "{", "ª", "^", "~", "]", "}", "º", "/", "?", "°", ";", ":", ">", "<", ".", ",", "|", "\\", "*", "¨¨", "¿", "®", "×", "½", "¼", "¡", "«", "»", "©", "¢", "++"), '', self::$value);
        self::$value = strtr(utf8_decode(self::$value), utf8_decode(self::$format['a']), self::$format['b']);
        self::$value = strip_tags(trim(self::$value));
        self::$value = str_replace(' ', '-', self::$value);
        self::$value = str_replace(array('-----', '----', '---', '--'), '-', self::$value);

        return strtolower(utf8_encode(self::$value));
    }

}
