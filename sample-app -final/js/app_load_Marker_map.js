jQuery(document).ready(function(){

		var href = jQuery(location).attr('href');
    console.log("href -> "+href);
	    var url = jQuery(this).attr('title');
    console.log("url -> "+url);	    
	    var array = href.split('/');
    console.log("array -> "+array);    
	    var lastsegment = array[array.length-1];
    console.log("last segment -> "+lastsegment);

  // hide the  default  loader title  if it comes

  $(".ui-loader.ui-loader-default").hide(0);

  // Load the content of proxy file (proxy_frontend) inside the appfrontend-div to store front

            if(jQuery(".appfrontend1-tech-map-marker-div").length == 0) {

              // jQuery('form[action="/cart/add"]').prepend( "<div class='appfrontend1-bundle-div'></div>" );
              
              jQuery('footer').prepend( "<div class='appfrontend1-tech-map-marker-div'></div>" );

              jQuery('.appfrontend1-tech-map-marker-div').load('/apps/MarkerMap?href='+href);

// "app/proxy_frontend" is the proxy path you given during the app configuration in partners account and proxy url must be given the fullpath of the file whose content you want to load on the store front end.

          }
});