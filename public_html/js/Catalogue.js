$(document).ready(function()
{	
	// When a menu link is clicked, appropriate tiles are shown. 
	$("nav#catalogueMenu button, nav#catalogueMenu a").click(function(event)
	{
		// Prevent scrolling to the top of the page caused by clicking a link.
		event.preventDefault();
		
		// Display the tiles. Category is the data-category attribute of the menu item.
		var category = $(this).attr("data-category");
		displayTiles(category);
	});
	
});

// Displays the all tiles that belong to "category" category
function displayTiles(category)
{
	// If category was not given, stop the procedure.
	if(category == null || category == "undefined" || category == 0 || category == "")
	{
		return;
	}
	
	// Clean the catalogue.
	$("div#catalogue").html("");
	
	// Retrieve the thumbnails of the tiles
	$.post('/tiles', {"category": category}, function(data)
	{
	    var row = 0;
		// Iterate over all the thumbnails
		for(var i = 0; i < data.tiles.length; ++i)
		{
		    if(i % 4 == 0)
		    {
		        row++;
		    }
		    var col = i % 4 + 1;
		    
			// Name is the part of the filename before the .extension part. The newline is discarded.
			name = data.tiles[i].split("\.")[0].split("\n")[0];
			
			// Path is /img/category/"filename" with the newline discarded.
			path = "img/catalogue/" + category + "/" + data.tiles[i].split("\n")[0];
			
			// Append the thumbnail to the page
			$("div#catalogue").append(
			"<div class='col-lg-3 thumb'>\
                <span class=''>" + name + "</span>\
				<a class='thumbnail' href='#'>\
					<img class='' src='" + path + "' alt='" + data.tiles[i].split("\n")[0] + "'>\
				</a>\
			</div>");
		}
	});
}
//<span class=''>" + name + "</span>\
                //<span>(row "+row+", col "+col+"), "+(i+1)+", rev-row"+(49-row)+"</span>
