<?php
/* -----------------------------------------------------------------------------------------
   $Id: products_media.php,v 1.8 2004/01/02 00:08:25 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2003	 nextcommerce (products_media.php,v 1.8 2003/08/25); www.nextcommerce.org
   
   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

 
$module_smarty= new Smarty;
$module_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
$module_content=array();
$filename='';

// check if allowed to see
require_once(DIR_FS_INC.'xtc_in_array.inc.php');
$check_query=xtc_db_query("SELECT DISTINCT
				products_id
				FROM ".TABLE_PRODUCTS_CONTENT."
				WHERE languages_id='".(int)$_SESSION['languages_id']."'");
//$check_data=xtc_db_fetch_array($check_query);

$check_data=array();
$i='0';
while ($content_data=xtc_db_fetch_array($check_query)) {
 $check_data[$i]=$content_data['products_id'];
 $i++;
}
if (xtc_in_array($_GET['products_id'],$check_data)) {
// get content data

require_once(DIR_FS_INC.'xtc_filesize.inc.php');

  if (GROUP_CHECK=='true') {
   $group_check="group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%' AND";
  }

//get download
$content_query=xtc_db_query("SELECT
				content_id,
				content_name,
				content_link,
				content_file,
				content_read,
				file_comment
				FROM ".TABLE_PRODUCTS_CONTENT."
				WHERE
				products_id='".(int)$_GET['products_id']."' AND
                ".$group_check."
				languages_id='".(int)$_SESSION['languages_id']."'");

				
	while ($content_data=xtc_db_fetch_array($content_query)) {
	$filename='';	
	if ($content_data['content_link']!='')	{

	$icon= xtc_image(DIR_WS_CATALOG.'admin/images/icons/icon_link.gif');
	} else {
	$icon= xtc_image(DIR_WS_CATALOG.'admin/images/icons/icon_'.str_replace('.','',strstr($content_data['content_file'],'.')).'.gif');
	}

	
	
	if ($content_data['content_link']!='')	$filename= '<a href="'.$content_data['content_link'].'" target="new">';
	$filename.=  $content_data['content_name'];
	if ($content_data['content_link']!='') $filename.= '</a>';
	
    if ($content_data['content_link']=='') {
	if (eregi('.html',$content_data['content_file']) 
	or eregi('.htm',$content_data['content_file'])	
	or eregi('.txt',$content_data['content_file'])
	or eregi('.bmp',$content_data['content_file'])
	or eregi('.jpg',$content_data['content_file'])
	or eregi('.gif',$content_data['content_file'])
	or eregi('.png',$content_data['content_file'])
	or eregi('.tif',$content_data['content_file'])
	) 
	{
	

	 $button = '<a style="cursor:hand" onClick="javascript:window.open(\''.xtc_href_link(FILENAME_MEDIA_CONTENT,'coID='.$content_data['content_id']).'\', \'popup\', \'toolbar=0, width=640, height=600\')">'. xtc_image_button('button_view.gif',TEXT_VIEW).'</a>';

	} else {

	$button= '<a href="'.xtc_href_link('media/products/'.$content_data['content_file']).'">'.xtc_image_button('button_download.gif',TEXT_DOWNLOAD).'</a>';	
	
	}
	}	
$module_content[]=array(
			'ICON' => $icon,
			'FILENAME' => $filename,
			'DESCRIPTION' => $content_data['file_comment'],
			'FILESIZE' => xtc_filesize($content_data['content_file']),
			'BUTTON' => $button,
			'HITS' => $content_data['content_read']);
	} 
 
  $module_smarty->assign('language', $_SESSION['language']);
  $module_smarty->assign('module_content',$module_content);
  // set cache ID
  if (USE_CACHE=='false') {
  $module_smarty->caching = 0;
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/products_media.html');
  } else {
  $module_smarty->caching = 1;	
  $module_smarty->cache_lifetime=CACHE_LIFETIME;
  $module_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_SESSION['language'].$_GET['products_id'].$_SESSION['customers_status']['customers_status_name'];
  $module= $module_smarty->fetch(CURRENT_TEMPLATE.'/module/products_media.html',$cache_id);
  }
  $info_smarty->assign('MODULE_products_media',$module);
}
?>