$(document).ready(function()
{
    // Za mało nawiasów, pozdro.
    $("a.thumbnail").click(function(event)
    {
        // Prevent redirecting to the href.
        event.preventDefault();
        
        // Get the data- attributes.
        productName = $(this).attr("data-name");
        price = $(this).attr("data-price");
        
        // Pull up the image.
        $("a.thumbnail").fancybox({
            helpers:
            {
                title:
                {
                    type: 'inside',
                    position: 'top'
                }
            },
            afterLoad   : function()
            {
                //this.inner.prepend(productName + " " + price);
            }
        });
    });
});