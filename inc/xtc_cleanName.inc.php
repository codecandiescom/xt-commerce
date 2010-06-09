<?php
/* -----------------------------------------------------------------------------------------
   $Id: xtc_cleanName.inc.php

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


 function xtc_cleanName($name,$prefix=true) {

     // removing special Chars from products_name
     $name=strtolower($name);
     $name=str_replace('�','ae',$name);
     $name=str_replace('�','ue',$name);
     $name=str_replace('�','oe',$name);
     $name=str_replace(' ','-',$name);
     if (!$prefix) return $name;
     return $name.'.html';
 }

?>
