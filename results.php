<?php
include("src/functions.php");

$neighborhoodId=$_GET["neighborhood"];
$roomTypeId=$_GET["roomType"];
$accomodates=$_GET["guests"];

if ($neighborhoodId == "Any") $neighborhoodName = "Any";
if ($roomTypeId == "Any") $roomType = "Any";

$results=getQuery($db, $neighborhoodId, $roomTypeId, $accomodates);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">


        <title>Fake Airbnb Results</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet">
        <link rel="icon" href="images/house-heart-fill.svg">
        <link rel="mask-icon" href="images/house-heart-fill.svg" color="#000000">   
        </head>
    <body>
    
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                <h4 class="text-white">About</h4>
                <p class="text-muted">Fake Airbnb. Data c/o http://insideairbnb.com/get-the-data/</p>
                </div>
            </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
            <a href="index.php" class="navbar-brand d-flex align-items-center">
                <i class="bi bi-house-heart-fill my-2"></i>    
                <strong> Fake Airbnb</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            </div>
        </div>
    </header>

    <main>



        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                <div class="col">
                    
                    <?php
                    $neighborhoodName=$results[0]["neighborhood"];
                    $roomType=$results[0]["type"];
                    $count = count($results);

                    echo "<h1>Results ($count):</h1>";
                    echo "<div><b>Neighborhood: </b>$neighborhoodName</div>";
                    echo "<div><b>Room Type: </b>$roomType</div>";
                    echo "<div><b>Accomodates: </b>$accomodates</div>";
                    
                    foreach($results as $result) {
                        $id = $result["id"];
                        $name = $result["name"];
                        $pictureUrl = $result["pictureUrl"];
                        $price = $result["price"];
                        $rating = $result["rating"];

                        echo "
                            <div class='card shadow-sm'>
                                <img src='$pictureUrl'>

                                <div class='card-body'>
                                    <h5 class='card-title'>$name</h5>
                                    <p class='card-text'>$neighborhoodName</p>
                                    <p class='card-text'>$roomType</p>
                                
                                    <p class='card-text'>Accommodates $accomodates</p>
                    
                                    <p class='card-text align-bottom'>
                                        <i class='bi bi-star-fill'></i><span class=''> $rating</span>
                                    </p>
                    
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <div class='btn-group'>
                                            <button type='button' id='$id' class='btn btn-sm btn-outline-secondary viewListing' data-bs-toggle='modal' data-bs-target='#fakeAirbnbnModal'>View</button>
                                        </div>
                                        <small class='text-muted'>$$price</small>
                    
                                    </div>
                                </div>
                            </div><!--.card-->
                        "; // end echo
                    }
                    ?>

                </div><!--.col-->
        </div><!-- .container-->
    </main>

    <footer class="text-muted py-5">
        <div class="container">

            <p class="mb-1">CS 293, Spring 2025</p>
            <p class="mb-1">Lewis & Clark College</p>
        </div>
    </footer>

    <!-- modal-->
    <div class="modal fade modal-lg" id="fakeAirbnbnModal" tabindex="-1" aria-labelledby="fakeAirbnbnModalLabel" aria-modal="true" role="dialog" >
      <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">$name</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <img src="https://a0.muscache.com/pictures/miso/Hosting-595680673819411804/original/a6e6fda5-2935-4e2e-ba34-2fc50bba5cf3.jpeg" class="img-fluid">
                </div>
                <div class="modal-footer" id="modal-footer">
                    <p>$neighborhoodName</p><p>$$price / night</p><p>Accommodates $accomodates</p><p><i class="bi bi-star-fill"></i> $rating</p><p>Hosted by $hostName</p><p>Amenities: $amenities</p><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

  </body>
</html>


