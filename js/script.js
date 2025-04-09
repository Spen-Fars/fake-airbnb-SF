$(document).ready(function(){

    $(".viewListing").click(function(){
      
        var id=$(this).attr("id");
        // console.log(id);

        $.ajax({
            method: "GET",
            url: "src/ajax.php",
            data: { listingId: id }
        })
        .done(function( data ) {
            console.log(data);
        
            json=JSON.parse(data);
            console.log(json);

            var name=json[0].name;
            var pictureUrl=json[0].pictureUrl;
            var neighborhoodName=json[0].neighborhood;
            var price=json[0].price;
            var accommodates=json[0].accommodates;
            var rating=json[0].rating;
            var hostName=json[0].hostName;

            // my SQL sucks and I don't know how to fix it, so this is my fix
            var amenities = "";
            for(let i = 1; i < json.length; i++) {
                amenities = amenities + json[i].amenity + ", ";
            }

            amenities = amenities.substring(0, amenities.length-2);

            $("#modal-title").html(name);
            var body_html="<img src='"+pictureUrl+"' class='img-fluid'>";
            $("#modal-body").html(body_html);
            var footer_html = "<p>"+neighborhoodName+"</p><p>$"+price +" / night</p><p>Accommodates "+accommodates+"</p><p><i class='bi bi-star-fill'></i> "+rating+"</p><p>Hosted by "+hostName+"</p><p>Amenities: "+amenities+"</p><button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
            $("#modal-footer").html(footer_html);
            //console.log(name);

      });


    });


  });