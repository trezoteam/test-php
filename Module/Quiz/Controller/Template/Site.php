<?php
namespace Module\Quiz\Controller\Template;
    
    use Module\Quiz\View\SRC\Template\Site as View_Site;
    
    class Site
    {
        function __construct()
        {
            
        }
        
        public function loadPage(): void
        {
            $view = new View_Site();
            
            $view->execute();
        }
    }
