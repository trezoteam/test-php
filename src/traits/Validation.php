<?php

namespace Src\traits;

/**
 * Validações Gerais
 *
 * @author Paulo
 */
trait Validation {

    /**
     * Executa a verificação de um email
     * 
     * @param string $email
     * @return boolean
     */
    public function isValidEmail($email) {
        $exp = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';
        if (preg_match($exp, $email)) {
            return true;
        } else {
            return false;
        }
    }

    
    
    
    
    
    
    
}
