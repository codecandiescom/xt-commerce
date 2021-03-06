<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_redirect.inc.php 70 2007-01-07 14:19:12Z mzanier $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(general.php,v 1.225 2003/05/29); www.oscommerce.com 
   (c) 2003	 nextcommerce (xtc_redirect.inc.php,v 1.5 2003/08/13); www.nextcommerce.org
   
   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

  // include needed functions
  
  require_once(DIR_FS_INC . 'xtc_exit.inc.php');
  
  function xtc_redirect($url) {
    if ( (ENABLE_SSL == true) && (getenv('HTTPS') == 'on' || getenv('HTTPS') == '1') ) { // We are loading an SSL page
	if (substr($url, 0, strlen(HTTP_SERVER)) == HTTP_SERVER) { // NONSSL url
	    $url = HTTPS_SERVER . substr($url, strlen(HTTP_SERVER)); // Change it to SSL
	}
    }
    
    header('Location: ' . eregi_replace("[\r\n]+(.*)$", "", $url));

    xtc_exit();
    
  }
?>