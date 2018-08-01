<?php
namespace Module\Quiz\View\SRC\Admin;
    
    use Module\Quiz\View\SRC\Template\Site as Template_Site;
    
    class Login
    {
        function __construct()
        {
            
        }
        
        public function execute(): void
        {
            $template = new Template_Site();
            
            $template->setPageDir('/Module/Quiz/View/HTML/Admin/Login.php')
                     ->setPageTitle('Login Admin');
            
            $template->execute();
        }
    }
