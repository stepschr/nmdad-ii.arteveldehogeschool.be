function User()
{
    // Properties
    this.name = null;

    // Methods
    this.getName = function()
    {
        return this.name;
    };
    this.setName = function(name)
    {
        this.name = name;
    };
}
