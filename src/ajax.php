<?php
/* PHP code for AJAX interaction goes here */
include("functions.php");

function listingValues($db) {
    $listingId=$_GET["listingId"];
    try {
        $stmt = $db->prepare("  
                            select name, pictureUrl, price, accommodates, rating, neighborhoods.neighborhood, hosts.hostName
                            from listings
                            join neighborhoods on neighborhoods.id = listings.neighborhoodId
                            join hosts on hosts.id = listings.hostId
                            where listings.id = ?
                            ");
        $data=array($listingId);
        $stmt->execute($data);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;

    } catch (Exception $e) {
        echo $e;
    }
}

function listingAmenities($db) {
    $listingId=$_GET["listingId"];
    try {
        $stmt = $db->prepare("  
                            select amenity
                            from amenities
                            join listingAmenities on listingAmenities.listingID = ?
                            where amenities.id = listingAmenities.amenityID
                            ");
        $data=array($listingId);
        $stmt->execute($data);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;

    } catch (Exception $e) {
        echo $e;
    }
}

$vrows = listingValues($db);
$arows = listingAmenities($db);
$rows = array_merge($vrows, $arows);
echo json_encode($rows);
?>