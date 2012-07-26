$(function(){
  
  var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
	if(width < 979){
    return;
  }
  
  var $container = $("#flickrCarousel .carousel-inner");
  var imgUrls = [];
  var currentImage = -1;
  var timeout = 5000;
  var startupTimeout = 2000;
  
  var parameters = { 
    api_key: "1f9dd955965f845c4828845466c99e02",
    format: "json",
    method: "flickr.photosets.getPhotos",
    photoset_id:"72157630760953584"
  };
  
  function loadNextImage(){
    loadImage(currentImage+1);
  }
  
  function loadImage(index){
    var url = imgUrls[index];
    var img = new Image();
    img.src = url;
    img.onload = function(){
      $container.append('<div class="item" style="background-image: url('+url+');"></div>');
      $("#flickrCarousel").carousel('next');
      currentImage = index;
    }
  }

  $.getJSON("http://api.flickr.com/services/rest/?jsoncallback=?",
    parameters,
    function(data){
      $(data.photoset.photo).each(function(i,item){
        var url = "http://farm"+item.farm+".static.flickr.com/"+item.server+"/"+item.id+"_"+item.secret+"_b.jpg";
        imgUrls.push(url);
      });
      setTimeout(loadNextImage,startupTimeout);
      $("#flickrCarousel").carousel({
        interval: timeout
      }).carousel('pause'); 
  });
  
  $("#flickrCarousel").on("slid",function(){
    console.log("slid",currentImage)
    if (currentImage == 0){
      $("#flickrCarousel .placeholder").remove();
    }
    if (currentImage+1 < imgUrls.length){
      setTimeout(loadNextImage,timeout);
    } 
    else if (currentImage+1 == imgUrls.length) {
      console.log("start normal cycle");
      $("#flickrCarousel").carousel('cycle');
      currentImage++;
    }
  });
});