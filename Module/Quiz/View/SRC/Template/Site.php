<?php
namespace Module\Quiz\View\SRC\Template;
    
    class Site
    {
        /**
         * Directory of the page that sult included on the template.
         * @var string $page_dir
         */
        private static $page_dir;
        
        /**
         * Title of the required page.
         * @var string $page_title.
         */
        private static $page_title;
        
        function __construct()
        {
            
        }
        
        /**
         * Sets the page dir to the static variable.
         * @param string $page_dir
         * @return Site
         */
        public function setPageDir(string $page_dir): Site
        {
            self::$page_dir = $page_dir;
            
            return $this;
        }
        
        /**
         * Sets the page title to the static variable.
         * @param string $page_title
         * @return Site
         */
        public function setPageTitle(string $page_title): Site
        {
            self::$page_title = $page_title;
            
            return $this;
        }
        
        public function execute(): void
        {
            require_once SITE_ROOT . '/Module/Quiz/View/HTML/Template/Site.php';
        }
        
        /**
         * Is called on the HTML to return the directory from the content page to be required on the template.
         * @return string|NULL
         */
        public static function getPageDir(): ?string
        {
            return SITE_ROOT . self::$page_dir;
        }
        
        /**
         * Is called on the HTML tamplete to set the tite from the required content page.
         * @return string|NULL
         */
        public static function getPageTitle(): ?string
        {
            return self::$page_title;
        }
    }
