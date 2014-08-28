$(document).ready(function()
{
    // Set the initial total price.
    updateTotalPrice();
    
    // Update the price estimate each time the product type or amount is changed.
    $('form#addToCartForm select, form#addToCartForm input').change(updateTotalPrice);
});

function updateTotalPrice()
{
    // Fetch the type of the product, the amount of tiles and the price from the form.
    type = $('form#addToCartForm select').val();
    amount = $('input#productAmount').val();
    price = parseFloat($('span.price' + type).html());
    
    // Calculate the total price. It has only two decimal places.
    totalPrice = (price * amount).toFixed(2);
    
    // Update the price estimate.
    $('div#totalPrice').html('Total Price £' + totalPrice);
}