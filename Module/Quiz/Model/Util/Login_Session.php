<?php
namespace Module\Quiz\Model\Util;
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    class Login_Session
    {
        function __constructor()
        {
            
        }
        
        /**
         * check authentication
         * 
         * @return bool
         */
        public static function checkAuthentication() : bool
        {
            if (empty(self::get_usuario_id())) {
                return false;
            } else {
                return true;
            }
        }
        
        /** 
         * Function setAdminUserId
         * 
         * @param int $id
         * @return void
         */
        public static function setAdminUserId(int $id) : void
        {
            $_SESSION['login']['admin_user']['id'] = $id;
        }
        
        /** 
         * Function getAdminUserId
         * 
         * @param none
         * @return ?int
         */
        public static function getAdminUserId() : ?int
        {
            if (isset($_SESSION['login']['admin_user']['id'])) {
                return $_SESSION['login']['admin_user']['id'];
            } else {
                return null;
            }
        }
        
        /**
         * Function setAdminUserName
         * 
         * @param string $name
         * @return void
         */
        public static function setAdminUserName(string $name) : void
        {
            $_SESSION['login']['admin_user']['name'] = $name;
        }
        
        /**
         * Function getAdminUserName
         * 
         * @param none
         * @return ?string
         */
        public static function getAdminUserName() : ?string
        {
            if (isset($_SESSION['login']['admin_user']['name'])) {
                return $_SESSION['login']['admin_user']['name'];
            } else {
                return null;
            }
        }
        
        /**
         * Destroi a sessão Inteira.
         */
        public static function finishAuthentication() : void
        {
            unset($_SESSION['login']);
        }
    }
