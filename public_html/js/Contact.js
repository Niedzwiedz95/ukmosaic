$(document).ready(function()
{
    $("form#contactForm, form#contactForm textarea").validate({
        rules:
        {
            name:
            {
                required: true,
                rangeLength: [2, 32]
            },
            email:
            {
                required: true,
                email: true
            },
            phoneNumber:
            {
                required: false,
            },
            comments:
            {
                required: true
            }
        },
        messages:
        {
            name:
            {
                required: "This field is required",
                rangeLength: "The name should be between 2 and 32 characters"
            },
            email:
            {
                required: "This field is required",
                email: "This is not a valid email address"
            },
            comments:
            {
                required: "This field is required"
            },
        }
    });
});