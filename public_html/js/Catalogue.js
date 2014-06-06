$(document).ready(function()
{
	// At the start, victorian tiles are shown.
	displayTiles("victorian");
	
	// When a menu link is clicked, appropriate tiles are shown. 
	$("nav#catalogueMenu a").click(function()
	{
		var category = $(this).html().toLowerCase();
		displayTiles(category);
	});
});

// Displays the all tiles that belong to "category" category
function displayTiles(category)
{
	// If category was not given, make sure it's an empty string
	if(category === null || category === "undefined" || category === 0)
	{
		category = "";
	}
	
	// Clean the catalogue.
	$("div#catalogue").html("");
	
	// Retrieve the thumbnails of the tiles
	$.post('/tiles', {"category": category}, function(data)
	{
		// Iterate over all the thumbnails
		for(var i = 0; i < data.tiles.length; ++i)
		{
			// Retrieve the name of the tile and get it's path
			name = data.tiles[i].split("\.")[0];
			path = "img/" + category + "/" + data.tiles[i];
			
			// Append the thumbnail to the page
			$("div.container > div#catalogue").append(
			"<div class='col-lg-3 thumb'>\
				<span class=''>" + name + "</span>\
				<a class='thumbnail' href='#'>\
					<img class='img-responsive' src='" + path + "' alt='" + data.tiles[i] + "'>\
				</a>\
			</div>");
		}
	});
}