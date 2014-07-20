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
	// Fetch the products' html from the server and change the page's URL.
	$.post('/productsjson', {"category": category}, function(data)
	{
        $("div#catalogue").html(data.html);
        window.history.replaceState(null, null, '/catalogue/' + category);
	});
}