function Pomodoro()
{
    // Properties
    this.description = null;
    this.taskId = null;

    // Methods
    this.getDescription = function()
    {
        return this.description;
    };
    this.setDescription = function(description)
    {
        this.description = description;
    };

    this.getTaskId = function()
    {
        return this.taskId;
    };
    this.setTaskId = function(taskId)
    {
        this.taskId = taskId;
    };
}
