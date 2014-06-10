$(document).ready(function()
{	
	// When a menu link is clicked, appropriate tiles are shown. 
	$("nav#catalogueMenu button, nav#catalogueMenu a").click(function(event)
	{
		// Prevent scrolling to the top of the page caused by clicking a link.
		event.preventDefault();
		
		// Display the tiles. Category is the text of the menu item, all lower case.
		var category = $(this).html().split(" ")[0].toLowerCase();
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
			// Name is the part of the filename before the .extension part. The newline is discarded.
			name = data.tiles[i].split("\.")[0].split("\n")[0];
			
			// Path is /img/category/"filename" with the newline discarded.
			path = "img/" + category + "/" + data.tiles[i].split("\n")[0];
			
			// Append the thumbnail to the page
			$("div#catalogue").append(
			"<div class='col-lg-3 thumb'>\
				<a class='thumbnail' href='#'>\
					<img class='' src='" + path + "' alt='" + data.tiles[i].split("\n")[0] + "'>\
				</a>\
			</div>");
		}
	});
}

				//<span class=''>" + name + "</span>