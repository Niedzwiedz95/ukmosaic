$(document).ready(function()
{
    // Za mało nawiasów, pozdro.
    $("img").click(function(event)
    {
        event.preventDefault();
        alert("dziala click");
    });
});