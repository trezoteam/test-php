<?php
    
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	define('SITE_ROOT', __DIR__);
