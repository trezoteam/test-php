<?php
namespace Module\Quiz\Controller\Admin;
    
    use Module\Quiz\View\SRC\Admin\Login as View_Login;
    use Module\Quiz\Model\DAO\AdminUser as DAO_AdminUser;
    use Module\Quiz\Model\OBJ\AdminUser as OBJ_AdminUser;
    use Module\Quiz\Model\Util\Login_Session;
    
    class Login
    {
        /**
         * 
         * @var string $user_name;
         */
        private $user_name;
        
        /**
         * 
         * @var string $password;
         */
        private $password;
        
        /**
         * List of all errors geted by validating the form variables.
         * @var array
         */
        private $errors = [];
        
        function __construct()
        {
            
        }
        
        /**
         * Sets the user name.
         * @param string $user_name
         * @return Login
         */
        public function setUserName($user_name): Login
        {
            if (empty($user_name)) {
                $this->errors[] = 'Username not informed';
            } else {
                $this->user_name = $user_name;
            }
            
            return $this;
        }
        
        /**
         * Sets the user password.
         * @param string $password
         * @return Login
         */
        public function setPassword($password): Login
        {
            if (empty($password)) {
                $this->errors[] = 'Password not informed';
            } else {
                $this->password = $password;
            }
            
            return $this;
        }
        
        /**
         * Calls the view, sets his variables and requires the template and pass the content page and load the HTML file.
         */
        public function loadPage(): void
        {
            $view = new View_Login();
            
            $view->execute();
        }
        
        /**
         * Return false on error and true if success.
         * @return void
         */
        public function authenticate(): void
        {
            $value = [];
            $value['errors'] = '';
            
            if (empty($this->errors)) {
                $admin_user = DAO_AdminUser::searchByUserName($this->user_name);
                
                if ($admin_user instanceof OBJ_AdminUser && 
                    password_verify($this->password, $admin_user->getPassword())) {
                    Login_Session::setAdminUserId($admin_user->getId());
                    Login_Session::setAdminUserName($admin_user->getUserName());
                } else {
                    $this->errors[] = 'Sorry, Username or Password are incorrect';
                }
            }
            
            if (count($this->errors) > 0) {
                foreach ($this->errors as $error) {
                    $value['errors'] .= "$error ";
                }
            }
            
            echo json_encode($value);
        }
    }
