<?php
/* Add your functions here */


function dbConnect() {
    /******* connection credentials *******/
    $servername = "mysqlServer";
    $username = "fakeAirbnbUser";
    $password = "apples11Million";
    $database = "fakeAirbnb";
    $dbport = 3306;
    /******* connect to database *******/

    try {
        $db = new PDO("mysql:host=$servername; dbname=$database; charset=utf8mb4; port=$dbport", $username, $password);

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    return $db;
}


/* query with no SQL arguments */
function getListings($db) {
    try {
        $stmt = $db->prepare("select * from listings");   
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    
    } catch (Exception $e) {
        echo $e;
    }
    
}


/* query for neighborhoods */
function getNeighborhoods($db) {
    try {
        $stmt = $db->prepare("select * from neighborhoods order by neighborhood");   
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    
    } catch (Exception $e) {
        echo $e;
    }
    
}


/* query for room types */
function getRoomTypes($db) {
    try {
        $stmt = $db->prepare("select * from roomTypes");   
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    
    } catch (Exception $e) {
        echo $e;
    }
    
}


/* query for user designated SQL arguments */
function getQuery($db, $neighborhoodId, $roomTypeId, $accommodates) {
    try {
    $stmt = $db->prepare("  
                        select pictureUrl, name, accommodates, rating, listings.id, price, neighborhoods.neighborhood, roomTypes.type
                        from listings
                        join neighborhoods on neighborhoods.id=listings.neighborhoodId
                        join roomTypes on roomTypes.id=listings.roomTypeId
                        where neighborhoods.id = ? and roomTypes.id = ? and listings.accommodates = ?
                        ");
    $data=array($neighborhoodId, $roomTypeId, $accommodates);
    $stmt->execute($data);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;

    } catch (Exception $e) {
        echo $e;
    }
}


function getNeighborhoodNameFromId($db, $id) {
    try {
        $stmt = $db->prepare("  
                            select neighborhood
                            from neighborhoods
                            where neighborhoods.id = ?
                            ");
        $data=array($id);
        $stmt->execute($data);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;

    } catch (Exception $e) {
        echo $e;
    }
}


function getRoomTypeFromId($db, $id) {
    try {
        $stmt = $db->prepare("  
                            select type
                            from roomTypes
                            where roomTypes.id = ?
                            ");
        $data=array($id);
        $stmt->execute($data);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;

    } catch (Exception $e) {
        echo $e;
    }
}


function getHostNameFromId($db, $id) {
    try {
        $stmt = $db->prepare("  
                            select hostName
                            from hosts
                            where hosts.id = ?
                            ");
        $data=array($id);
        $stmt->execute($data);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;

    } catch (Exception $e) {
        echo $e;
    }
}


$db=dbConnect();
?>