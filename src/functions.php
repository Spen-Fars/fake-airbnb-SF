<?php

/* Add your functions here */


function dbConnect(){
    /*** connection credentials *******/
    $servername = "mysqlServer";
    $username = "fakeAirbnbUser";
    $password = "apples11Million";
    $database = "fakeAirbnb";
    $dbport = 3306;
    /****** connect to database **************/

    try {
        $db = new PDO("mysql:host=$servername; dbname=$database; charset=utf8mb4; port=$dbport", $username, $password);

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    return $db;
}


/* query with no SQL arguments */
function getListings($db){
    try {
        $stmt = $db->prepare("select * from listings");   
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    
    } catch (Exception $e) {
        echo $e;
    }
    
}


function getNeighborhoods($db){
    try {
        $stmt = $db->prepare("select * from neighborhoods");   
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    
    } catch (Exception $e) {
        echo $e;
    }
    
}


/* query with no SQL arguments */
function getRoomTypes($db){
    try {
        $stmt = $db->prepare("select * from roomTypes");   
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    
    } catch (Exception $e) {
        echo $e;
    }
    
}


function getQuery($db, $hood, $roomType, $guests) {
    try {
    $stmt = $db->prepare("  
                        select * 
                        from listings
                        join neighborhoods on neighborhoods.id=listings.neighborhoodId
                        join roomTypes on roomTypes.id=listings.roomTypeId
                        where neighborhoods.id = ? and roomTypes.id = ? and listings.accomodates < ?
                        ");
    $data=array($hood, $roomType, $guests);
    $stmt->execute($data);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;

    } catch (Exception $e) {
        echo $e;
    }
}

?>