
<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Home | PennyWise</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
	<link rel = "stylesheet" href = "style.css">
    <link rel = "stylesheet" href = "bootstrap.min.css">
</head>
<body style="background-color:#bcbbb9">
<?php
error_reporting(E_ALL & ~E_NOTICE);
//INCLUDED FILES
require_once "amazon.php";
include_once "flipkart.php";
echo "<div class='header' style='padding-left:450px'>";
    echo "<div class='container'>";
      echo "<img src='logo.jpg'/>";
      
    echo "</div>";
  echo "</div>";
echo "<center>";
include "search.htm";
echo "</center>";

//INITIALIZED ARRAYS FOR DATA, TITLE, IMAGE AND PRICE

$amazon_data = Array();
$amazon_title = Array();
$amazon_img = Array();
$amazon_price = Array();
$amazon_category = Array();
$amazon_rating = Array();
$amazon_r_count = Array();

$flipkart_data = Array();
$flipkart_title = Array();
$flipkart_img = Array();
$flipkart_price = Array();
$flipkart_category = Array();
$flipkart_rating = Array();
$flipkart_r_count = Array();


//IF SEARCH IS NOT FETCHED THROUGH GET METHOD, KILL REST OF THE PAGE (USED WHEN THE PAGE IS OPENED INITIALLY)
if(!isset($_GET['search']))
	die();

//CALLED FUNCTIONS THAT FETCH HTML CODE FROM RESPECTIVE SITES.
$flipkart_data = flipkart($_GET["search"]);

if(!empty($flipkart_data[0][0]))
{
$amazon_data = amazon($skey4);
}
else
{
$amazon_data = amazon($_GET['search']);
$flipkart_data = flipkart($skey6);

}

//STORING DATA IN VARIABLES FOR AMAZON
$j=0;

foreach ($amazon_data[0] as $x)
{ 
    
    $amazon_title[$j] = $x;
    $j++;
    if($j>0)
        break;
}

$j=0;

foreach (@$amazon_data[1] as $x)
{
    $amazon_img[$j] = $x;
    $j++;
    if($j>0)
		break;
}

$j=0;

foreach ($amazon_data[2] as $x)
{
    $x==trim($x," out of 5 stars");
    $amazon_price[$j] = $x;
    $j++;
    if($j>0)
		break;
}

$j=0;

foreach ($amazon_data[3] as $x)
{
    $amazon_category[$j] = $x;
    $j++;
    if($j>0)
        break;
}

$j=0;

foreach ($amazon_data[4] as $x)
{
    $amazon_rating[$j] = $x;
    $j++;
    if($j>0)
        break;
}

$j=0;

foreach ($amazon_data[5] as $x)
{
    $amazon_r_count[$j] = $x;
    $j++;
    if($j>0)
        break;
}

//STORING DATA IN VARIABLES FOR FLIPKART
$j=0;

foreach ($flipkart_data[0] as $x)
{
    $flipkart_title[$j] = $x;
    $j++;
    if($j>0)
        break;
}

$j=0;

foreach ($flipkart_data[1] as $x)
{
    $flipkart_img[$j] = $x;//chop($x, "/");
    $j++;
    if($j>0)
        break;
}

$j=0;

foreach ($flipkart_data[2] as $x)
{

    $flipkart_price[$j] = $x;
    $j++;
    if($j>0)
        break;
}

$j=0;

foreach ($flipkart_data[3] as $x)
{
    $flipkart_category[$j] = $x;
    $j++;
    if($j>1)
        break;
}

$flipkart_category[0]= $flipkart_category[1];
//print_r($flipkart_category);
 //echo $flipkart_category[2][1];

$j=0;

foreach ($flipkart_data[4] as $x)
{
    $flipkart_rating[$j] = $x;
    $j++;
    if($j>2)
        break;
}
 

 $j=0;

foreach ($flipkart_data[5] as $x)
{
    $flipkart_r_count[$j] = $x;
    $j++;
    if($j>2)
        break;
}
$flipkart_r_count[0]= $flipkart_r_count[1];

//DISPLAYING RESULTS FOR FLIPKART
$j=0;
$k=0;
$m=0;

echo "<div class = 'main_div' style = 'float: left;'><center>";
echo "FLIPKART";
if(!empty($flipkart_title[0]))
{
 foreach ($flipkart_title as $x)
 {
    echo "<div class = 'product'>";
    echo "<img src = '".@$flipkart_img[$j]."' style = 'width: 100px; height: 200px;'><br>";
    flush();
    echo @$x."<br>";
    echo "<div class = 'price'>".@$flipkart_price[$j]."</div>";
    if(!empty(@$flipkart_category[$j]))
    echo "<div class = 'price'>".@$flipkart_category[$j]."</div>";
    if(!empty(@$flipkart_rating[$j]))
    echo "<div class = 'price'>".@$flipkart_rating[$j]."</div>";
    if(!empty(@$flipkart_r_count[$j]))
    echo "<div class = 'price'>".@$flipkart_r_count[$j]."</div>";
    echo "<div class = 'spechead'>Specifications of ".@$x."</div>";
    echo @$$flipkart_data[8];

    while(!empty($flipkart_data[7][$k]))
    {
       while(!empty($flipkart_data[6][$m])) 
       {

            if($flipkart_data[7][$k]==$flipkart_data[6][$m])
                {
                    echo "<div class = 'grouphead'>".@strtoupper($flipkart_data[7][$k])."</div>";
                    //if(!empty($flipkart_data[7][$k+1])) 
                    $k++;
                    
                    $m++;

                }
            else
                {   
                    $key=0;
                    while($flipkart_data[6][$m]!=$flipkart_data[7][$k]) 
                         {
                            if($key==0)
                            {
                            echo "<div class = 'specskey'>".@ucwords($flipkart_data[6][$m])."</div>";
                            $m++;
                            $key=1;
                            }
                            else
                            {
                            echo "<div class = 'specsval'>".@ucwords($flipkart_data[6][$m])."</div>";
                            $m++;
                            $key=0;
                            }

                        };
                }
        };
    };
 }



    echo "</div>";
    flush();
    $j++;
}
else
    echo "<div class = 'spechead'>Result Not Found</div>";


echo "</center></div>";




//DISPLAYING RESULTS FOR AMAZON
$j=0;
$k=0;

echo "<div class = 'main_div' style = 'float: right;'><center>";
echo "AMAZON";
if(!empty($amazon_title[0]))
{
foreach ($amazon_title as $x)
{
    echo "<div class = 'product'>";
    echo "<img src = '".@$amazon_img[$j]."' style = 'width: 190px; height: 200px;'><br>";
    flush();
    //echo $amazon_img[$j];
    echo @$x."<br>";
    if(!empty(@$amazon_price[$j]))
    echo "<div class = 'price'>".@$amazon_price[$j]."</div>";
    if(!empty(@$amazon_category[$j]))
    echo "<div class = 'price'>".@$amazon_category[$j]."</div>";
     if(!empty(@$amazon_rating[$j]))
    echo "<div class = 'price'>".@$amazon_rating[$j]."</div>";
     if(!empty(@$amazon_r_count[$j]))
    echo "<div class = 'price'>".@$amazon_r_count[$j]."</div>";
    echo "<div class = 'spechead'>Specifications of ".@$x."</div>";

   while($k<sizeof($amazon_data[6])) 
   {
       echo "<div class = 'specskey'>".@$amazon_data[6][$k]."</div>";
        echo "<div class = 'specsval'>".@$amazon_data[7][$k]."</div>";
        $k++;
   };



    echo "</div>";
    flush();
    $j++;
}
}
else
    echo "<div class = 'spechead'>Result Not Found</div>";


echo "</center></div>";

?>
