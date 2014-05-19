function Label()
{
    // Properties
    this.id     = null;
    this.name   = null;
    this.colour = null;

    // Methods
    this.getId = function()
    {
        return this.id;
    };
    this.setId = function(id)
    {
        this.id = id;
    };

    this.getName = function()
    {
        return this.name;
    };
    this.setName = function(name)
    {
        this.name = name;
    };

    this.getColour = function()
    {
        return this.colour;
    };
    this.setColour = function(colour)
    {
        this.colour = colour;
    };
}
