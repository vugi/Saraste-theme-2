$(function(){

  $container = $("#flickrCarousel .carousel-inner");
  
  var parameters = { 
    api_key: "1f9dd955965f845c4828845466c99e02",
    format: "json",
    method: "flickr.photosets.getPhotos",
    photoset_id:"72157630760953584"
  };

  $.getJSON("http://api.flickr.com/services/rest/?jsoncallback=?",
    parameters,
    function(data){
      $(data.photoset.photo).each(function(i,item){
        var url ="http://farm"+item.farm+".static.flickr.com/"+item.server+"/"+item.id+"_"+item.secret+"_b.jpg";
        var itemClass = "item";
        if(i==0){ itemClass += " active" }
        $container.append('<div class="'+itemClass+'" style="background-image: url('+url+');"></div>');
      });
    $("#flickrCarousel").carousel({
      interval: 5000
    });
  });
  
});