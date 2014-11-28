$(document).ready(function()
{
	// Initialize the map.
	initializeMap();
	
	// Rules whose the form must satisfy to be valid.
    $("form#contactForm, form#contactForm textarea").validate({
        rules:
        {
            name:
            {
                required: true,
                rangeLength: [2, 32]
            },
            email:
            {
                required: true,
                email: true
            },
            phoneNumber:
            {
                required: false,
            },
            comments:
            {
                required: true
            }
        },
        messages:
        {
            name:
            {
                required: "This field is required",
                rangeLength: "The name should be between 2 and 32 characters"
            },
            email:
            {
                required: "This field is required",
                email: "This is not a valid email address"
            },
            comments:
            {
                required: "This field is required"
            },
        }
    });
});

// Initializes the map provided by Google Maps. Code pasted from the Internet.
function initializeMap()
{
        var mapCanvas = document.getElementById('mapCanvas');
        var mapOptions =
        {
          center: new google.maps.LatLng(51.4273718, -0.1984969),
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker(
        {
			position: new google.maps.LatLng(51.4273718, -0.1984969),
		  	map: map,
		  	//title: 'Hello World!'
	  	});
}