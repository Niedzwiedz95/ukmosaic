$(document).ready(function()
{
    var creator = initCreator();
});

// Initialize the mosaic creator.
function initCreator()
{
	// Store reference to the creator object in 'self' variable, because this changes inside member functions.
    var self = this;
    
    // Initialise properties.
    this.Canvas = $("#creatorCanvas")[0];
    this.Context = this.Canvas.getContext("2d");
    this.isDrawing = false;
    this.DrawingState = "brush"; //Valid states: "brush", "drawLine", "strokeRect", "fillRect", "strokeCirc", "fillCirc"
    this.BeginPoint = null;
    this.EndPoint = null;
    this.Shapes = [];
    
    // Add a "grid" to the canvas.
    for(var i = 0; i < 500; i += 50)
    {
    	for(var j = 0; j < 500; j += 50)
    	{
            self.Context.rect(i, j, i + 50, j + 50);
            self.Context.stroke();
    	}
    }
    
    
    this.getMouseVector = function()
    {
    	return new Vector(self.EndPoint.X - self.BeginPoint.X, self.EndPoint.Y - self.BeginPoint.Y);
    };
    
    // Clears the canvas.
    this.clear = function()
    {
        self.Context.clearRect(0, 0, 500, 500);
    };
    
    // Changes the style and color of the paint.
    $("#paintColor, #lineSize").change(function()
    {
        self.Context.strokeStyle = this.value;
        self.Context.fillStyle = this.value;
        self.Color = this.value;
        self.Context.lineWidth = this.value; 
    });
    
    // Handles switching between different drawing tools.
    $("#brush, #drawLine, #strokeRect, #fillRect, #strokeCirc, #fillCirc").click(function()
    {
        self.DrawingState = $(this).attr("id");
        $("#brush, #drawLine, #strokeRect, #fillRect, #strokeCirc, #fillCirc").removeClass("selected");
        $(this).addClass("selected");
    });
    
    $(this.Canvas).mousedown(function(Event)
    {
        self.isDrawing = true;
        self.Context.beginPath();
        self.BeginPoint = new Point(Event.pageX - $(this).offset().left, Event.pageY - $(this).offset().top);
        self.Context.moveTo(Event.pageX - $(this).offset().left, Event.pageY - $(this).offset().top);
    });
    
    $(this.Canvas).mouseup(function(Event)
    {
        self.isDrawing = false;
        self.EndPoint = new Point(Event.pageX - $(this).offset().left, Event.pageY - $(this).offset().top);
        switch(self.DrawingState)
        {
            case "drawLine":
                self.Context.lineTo(self.EndPoint.X, self.EndPoint.Y);
                self.Context.stroke();
            break;
            case "strokeRect":
                self.Context.rect(self.BeginPoint.X, self.BeginPoint.Y, self.getMouseVector().X, self.getMouseVector().Y);
                self.Context.stroke();
            break;
            case "fillRect":
                self.Context.rect(self.BeginPoint.X, self.BeginPoint.Y, self.getMouseVector().X, self.getMouseVector().Y);
                self.Context.stroke();
                self.Context.fill();
            break;
            case "strokeCirc":
            	self.Context.beginPath();
                self.Context.arc(self.BeginPoint.X, self.BeginPoint.Y, self.getMouseVector().Length, 0, Math.PI * 2);
                self.Context.stroke();
            break;
            case "fillCirc":
            	self.Context.beginPath();
                self.Context.arc(self.BeginPoint.X, self.BeginPoint.Y, self.getMouseVector().Length, 0, Math.PI * 2);
                self.Context.fill();
            break;
        }
    });
    $(this.Canvas).mouseout(function(Event)
    {
        self.isDrawing = false;
        self.BeginPoint = new Point(Event.pageX - $(this).offset().left, Event.pageY - $(this).offset().top);
    });
    $(this.Canvas).mousemove(function(Event)
    {
        if(self.isDrawing == true)
        {
            switch(self.DrawingState)
            {
                case "brush":
                    self.Context.lineTo(Event.pageX - $(this).offset().left, Event.pageY - $(this).offset().top);
                    self.Context.stroke();
                break;
            }
        } 
    });
    
    // Return a reference to the Creator instance.
    return this;
}

// Class that represents a point.
function Point(PosX, PosY)
{
    this.X = PosX;
    this.Y = PosY;
    this.getDistance = function(PointB)
    {
        return Math.sqrt(Math.pow((PointB.X - this.X), 2) + Math.pow((PointB.Y - this.Y), 2));
    };
    return this;
}

function Vector(Coord1, Coord2)
{
    this.X = Coord1;
    this.Y = Coord2;
    this.Length = Math.sqrt(Math.pow(this.X, 2) + Math.pow(this.Y, 2));
    return this;
}
function Square(TopLeft, Length, Color)
{
    this.Vertex.TopLeft = TopLeft;
    this.Diagonal = Length;
    this.Color = Color;
    return this;
}
function Rectangle(TopLeft, BottomRight, Color)
{
    this.Vertex.TopLeft = TopLeft;
    this.Vertex.BottomRight = BottomRight;
    this.Color = Color;
    return this;
}
function Circle(Centre, Radius, Color)
{
    this.Center = Centre;
    this.Radius = Radius;
    this.Color = Color;
    return this;
}

