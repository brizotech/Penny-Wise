<?php

require_once "core.php";
function flipkart($search)
{

    $search = str_replace(" ", "%20", $search);

    $url = "http://www.flipkart.com/search?q=$search";

    $html = getHTMLcode($url);
    //sleep(2);
    $regex = '/<a class="fk-display-block" data-tracking-id="prd_title" href="(?P<link>[^"]*)" title="(?P<name>[^"]*)">/'; //(?P<name>[^<]*)/';  //*"([^"]*)>/';
    preg_match_all($regex, $html, $title);


    $regex = '/data-src="(?P<img>[^"]*)"/';
    preg_match_all($regex, $html, $image);

    $regex = '/<span class="fk-font-17 fk-bold 11">Rs. (?P<cost>[^<]*)/';
    preg_match_all($regex, $html, $price);

    if(empty(@$price[cost]))
    {
    $regex = '/<span class="fk-font-12">(?P<cost>[^<]*)<\/span>/';
    preg_match_all($regex, $html, $price);
    }


//Move to product page
   $url1="http://www.flipkart.com". @$title[link][0];
   $html1 = getHTMLcode($url1);
  

   $regex = '/<a class="link fk-inline-block" href="([^"]*)" data-tracking-id="(?P<category1>[^"]*)">/';
    preg_match_all($regex, $html1, $category);

   $rate = '/<div class="fk-stars" title="(?P<rating1>[^"]*)">/';
   preg_match_all($rate, $html1, $rating);
   
   $regex = '/<p class="subText">(?P<r_count11>[^<]*)<\/p>/';
   preg_match_all($regex, $html1, $r_count1);
   
   $regex= '/(?:(<th class="groupHead" colspan="2">([^<]*)<\/th>)|(<td class="specsKey">([^<]*)<\/td>)|(<td class="specsValue([^>]*)>([^<]*)<\/td>))/';
   preg_match_all($regex, $html1, $specs1);


$z=sizeof($specs1[4]);
   for($k=0; $k<$z;$k++) {
    if($specs1[4][$k]=='Brand')          
      $skey1=$specs1[7][$k+1];
     if($specs1[4][$k]=='Model ID')          
      $skey2=$specs1[7][$k+1];
    if($specs1[4][$k]=='Model Name')          
      $skey3=$specs1[7][$k+1];
 
   }

   global $skey4;
    $skey5=@$skey1." ".$skey2." ".$skey3;
    $skey4=rawurlencode($skey5);
    if(strlen($skey5)<=2)
    {
    $skey4=$title[name][0];
    $skey4=rawurlencode($skey4);
   }



   $regex = '/<th class="groupHead" colspan="2">([^<]*)<\/th>/';
   preg_match_all($regex, $html1, $specs2);
   
    return Array(@$title[name],@$image[img],@$price[cost],@$category[category1],@$rating[rating1],@$r_count1[r_count11],@$specs1[0],@$specs2[0]); 

}

?>
