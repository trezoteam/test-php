<?php

namespace Src\traits;

/**
 * Tratamento de $_POST
 *
 * @author Paulo
 */
trait Post {

    /**
     * Tratamento de $_POST
     * 
     * @return array
     */
    public function getPost() {
        $postOrigin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $post = array();

        if (isset($postOrigin) && count($postOrigin) > 0) {
            foreach ($postOrigin as $key => $value) {
                if (is_array($value)) {
                    $post[$key] = $this->cleanArray($value);
                } else {
                    $post[$key] = $this->cleanPost($value);
                }
            }
        }

        return $post;
    }

    /**
     * Limpando arrays no post
     */
    private function cleanArray($post) {
        $arrClean = [];
        foreach ($post as $key => $value) {
            if (is_array($value)) {
                $arrClean[$key] = $this->cleanArray($value);
            } else {
                $arrClean[$key] = $this->cleanPost($value);
            }
        }

        return $arrClean;
    }

    /**
     * Limpando o post
     */
    private function cleanPost($value) {
        switch (trim($value)) {
            case "false":
                return false;
            case "true":
                return true;
            case "":
            case "null":
                return null;
            default :
                return trim($value);
        }
    }

}
