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
	
	// Event handler for toggling submenus.
	$("li.toggleSubmenu, li.toggleSubmenu > a").click(function(event)
	{
		// Prevent subitems from scrolling to the top or hiding the submenu.
		$(this).find("nav").click(function(event)
		{
			event.preventDefault();
			event.stopPropagation();
		});
		
		// Prevent scrolling to the top of the page caused by clicking a link.
		event.preventDefault();
		
		// If this submenu is toggled, hide it.
		if($(this).hasClass("toggled"))
		{
			$(this).removeClass("toggled");
			$(this).find("nav").fadeOut();
		}
		else // If this menu is hidden, toggle it and hide all other submenus.
		{
			$("li.toggled > nav").fadeOut();
			$(this).addClass("toggled");
			$(this).find("nav").fadeIn();
		}
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
			$("div#catalogue").append(
			"<div class='col-lg-3 thumb'>\
				<a class='thumbnail' href='#'>\
					<img class='img-responsive' src='" + path + "' alt='" + data.tiles[i] + "'>\
				</a>\
			</div>");
		}
	});
}

				//<span class=''>" + name + "</span>