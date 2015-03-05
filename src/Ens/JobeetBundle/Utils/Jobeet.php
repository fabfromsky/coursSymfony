<?php
namespace Ens\JobeetBundle\Utils;

class Jobeet
{
  
  /**
   * slugify url
   *
   * @return
   */
  static public function slugify($text) {
    
    //replace all special chars by -
    $text = preg_replace('#[^\\pL\d]+#u', '-', $text);
    
    //to avoid transliteration bugs
    if(function_exists('iconv')) {
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }

    //trim and lowercase
    $text = strtolower(trim($text, '-'));
    
    //remove unwanted chars
    $text = preg_replace('#[^-\w]+#', '', $text);
    //if empty returns n-a
    if(empty($text)) {
      return 'n-a';
    }

    return $text;
  }
}
?>
