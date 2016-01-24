<?php

require_once "core.php"; 

function amazon($search)
{
    

    $url="http://www.amazon.in/s/ref=nb_sb_noss/280-5472358-5762825?url=search-alias%3Daps&field-keywords=$search";

    $html= getHTMLcode($url);
   
    //sleep(2);

    $image = '/<img alt="Product Details" src="(?P<img>[^"]*)"/';
    preg_match_all($image,$html,$data);

    $title = '/<h2 class="a-size-medium a-color-null s-inline s-access-title a-text-normal">(?P<val>[^<]*)<\/h2>/';
    preg_match_all($title,$html,$value);
    global $skey6;
    $skey6=$value[1][0];
    $skey6=rawurlencode($skey6);

    $price ='/<span class="a-size-base a-color-price s-price a-text-bold"><span class="currencyINR">&nbsp;&nbsp;<\/span>(?P<price>[^>]*)</';
    preg_match_all($price,$html,$cost);

    $categ = '/<span class="a-text-bold">(?P<category1>[^:]*):<\/span>/';
    preg_match_all($categ, $html, $category);


    $regex = '/<a class="a-link-normal a-text-normal" href="(?P<link1>[^"]*)">/';
    preg_match_all($regex, $html, $link); 

    $url1="".@$link[link1][3];
    $html1 = getHTMLcode($url1);

  
    $regex ='/<i class="a-icon a-icon-star-medium a-star-medium-([^"]*)"><span class="a-icon-alt">(?P<rate2>[^<]*)<\/span>/';
    preg_match_all($regex, $html1, $rating2);

     $regex ='/<i class="a-icon a-icon-star-medium a-star-medium-([^"]*)"><span class="a-icon-alt">([^<]*)<\/span><\/i>(?P<r_count22>[^<]*<\/a>)/';
    preg_match_all($regex, $html1, $r_count2);

    $regex = '/<td class="label">(?P<specskey>[^<]*)<\/td>/';
    preg_match_all($regex, $html1, $specs3);

    $regex = '/<td class="value">(?P<specsvalue>[^<]*)<\/td>/';
    preg_match_all($regex, $html1, $specs4);
    
    return Array(@$value[val], @$data[img], @$cost[price], @$category[category1], @$rating2[rate2], @$r_count2[r_count22],@$specs3[0],@$specs4[0]);

}

?>
 
