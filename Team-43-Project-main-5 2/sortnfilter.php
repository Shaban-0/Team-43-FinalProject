<?php 
//sort and filter function for products
session_start();
require_once('connectdb.php');
try{

    //sort products from low to high (price)
    //add condition that leads to this happening
    $sql = "SELECT * FROM prodcuts ORDER BY price ASC";
    $stat = $db->query($sql);
    $rows = $db->query($sql);
    $stat->execute();
    $result = $stat->fetchAll();
    if($result && $rows->rowCount() > 0)
        if ($rows->rowCount()>0){
            while  ($row =  $rows->fetch())	{
        //display products 
        }
    } else{
        echo "No results";
    }

    //sort products from high to low (price)
    //add condition that leads to this happening
    $sql = "SELECT * FROM prodcuts ORDER BY price DESC";
    $stat = $db->query($sql);
    $rows = $db->query($sql);
    $stat->execute();
    $result = $stat->fetchAll();
    if($result && $rows->rowCount() > 0)
        if ($rows->rowCount()>0){
            while  ($row =  $rows->fetch())	{
        //display products 
        }
    } else{
        echo "No results";
    }

    //filter products based on price range, colour, scent, season
    if (isset($_POST['submitted'])) {
        //name min_price, max_price etc must be same in html filter form submission
        $minPrice = isset($_POST['min_price'])?$_POST['min_price']:false;
        $maxPrice = isset($_POST['max_price'])?$_POST['max_price']:false;
        $colour = isset($_POST['colour'])?$_POST['colour']:false;
        $scent = isset($_POST['scent'])?$_POST['scent']:false;
        $season = isset($_POST['season'])?$_POST['season']:false;
        $sql = "SELECT * FROM product WHERE
                (price >= $minPrice)  AND
                (price <= $maxPrice) AND
                (colour = $colour) AND
                (scent = $scent) AND
                (season = $season)";
        $stat = $db->query($sql);
        $rows = $db->query($sql);
        $stat->execute();
        $result = $stat->fetchAll();
        if($result && $rows->rowCount() > 0)
        if ($rows->rowCount()>0){
            while  ($row =  $rows->fetch())	{
            //display products 
            }
        } else{
            echo "No results matching your criteria try being more general";
        }
    }
    else if(!isset($_POST['submitted'])){
        //display products like normal
    }

}
catch (PDOexception $ex){
    echo "Sorry, a database error occurred! <br>";
    echo "Error details: <em>". $ex->getMessage()."</em>";
}

?>