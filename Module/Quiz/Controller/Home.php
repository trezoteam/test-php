<?php
namespace Module\Quiz\Controller;
    
    use Module\Quiz\View\SRC\Home as View_Home;
    
    class Home
    {
        function __construct()
        {
            
        }
        
        /**
         * Calls the view, sets his variables and requires the template and pass the content page and load the HTML file.
         */
        public function loadPage(): void
        {
            $view = new View_Home();
            
            $view->execute();
        }
    }
