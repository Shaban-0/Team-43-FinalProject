<?php 
session_start();
require_once('connectdb.php');
try{
    //search bar for products
    //get search query from search form submission
 
    $searchQuery = isset($_POST['search'])?$_POST['search']:false;
    $sql = "SELECT * FROM product, category WHERE
            product.name LIKE '%$searchQuery%' OR
            category.name LIKE '%$searchQuery%' OR
            product.colour LIKE '%$searchQuery%' OR
            product.season LIKE '%$searchQuery%' OR
            product.scent LIKE '%$searchQuery%'";
    $stat = $db->query($sql);
    $rows = $db->query($sql);
    $stat->execute();
    $result = $stat->fetchAll();
    if($result && $rows->rowCount() > 0)
        if ($rows->rowCount()>0){
            while  ($row =  $rows->fetch())	{
        //display products echo
        }
    } else{
        echo "No results matching your search";
    }
}
catch (PDOexception $ex){
    echo "Sorry, a database error occurred! <br>";
    echo "Error details: <em>". $ex->getMessage()."</em>";
}
?>