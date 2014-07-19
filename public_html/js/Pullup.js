$(document).ready(function()
{
    $(".pullup").fancybox();
    $(".pullup").click(function(event)
    {
        event.preventDefault();
        $(this).fancybox();
    });
    
});