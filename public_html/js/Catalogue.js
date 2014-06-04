$(document).ready(function()
{
	$.post('/thumbnails', function(data)
	{
		for(var i = 0; i < data.thumbnails.length; ++i)
		{
			name = data.thumbnails[i].split("\.")[0];
			console.log(name);
			path = "img/big_niewyciete/" + data.thumbnails[i];
			$("div.container > div.row > div").append(
			"<div class='col-lg-3 thumb'>\
				<span class=''>" + name + "</span>\
				<a class='thumbnail' href='#'>\
					<img class='img-responsive' src='" + path + "' alt='" + data.thumbnails[i] + "'>\
				</a>\
			</div>");
		}
	});
});