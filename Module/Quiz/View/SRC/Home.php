<?php
namespace Module\Quiz\View\SRC;
    
    use Module\Quiz\View\SRC\Template\Site as Template_Site;
    
    class Home
    {
        function __construct()
        {
            
        }
        
        public function execute(): void
        {
            $template = new Template_Site();
            
            $template->setPageDir('/Module/Quiz/View/HTML/Home.php')
            ->setPageTitle('Home Page');
            
            $template->execute();
        }
    }
