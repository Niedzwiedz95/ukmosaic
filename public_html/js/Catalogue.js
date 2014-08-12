$(document).ready(function()
{	
	// When a menu link is clicked, appropriate tiles are shown. 
	$("nav#catalogueMenu a").click(function(event)
	{
		// Prevent scrolling to the top of the page caused by clicking a link.
		event.preventDefault();
		
		// Display the tiles. Category is the fetched from the href attribute of the link in the menu.
		var splits = $(this).attr('href').split('/')
		var category = splits[splits.length - 1]
		displayTiles(category);
	});
	
	// If the page was loaded with a category, show the category's text.
	// Split the page's URL by slash.
    splits = document.URL.split("/");
    
    // Get the current category.
    category = splits[splits.length - 1];
    
    // Show the category's text.
    showText(category);
	
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
        // Show the appropriate text describing all the products in the requested category.
        showText(category);
        
	    // Fill the catalogue with the appropriate products and change the URL.
        $("div#catalogue").html(data.html);
        window.history.replaceState(null, null, '/catalogue/' + category);
	});
}

// Shows the appropriate text describing all the products in the requested category.
function showText(category)
{
    topCategory = category.split('_')[0] == 'satin&matt' ? 'satin_and_matt' : category.split('_')[0];
    $('div.hideable').hide();
    $('div#' + topCategory).show();
}