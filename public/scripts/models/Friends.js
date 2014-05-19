function Friends()
{
    // Properties
    this.id     = null;
    this.friendId = null;
    this.userId = null;

    // Methods
    this.getId = function()
    {
        return this.id;
    };
    this.setId = function(id)
    {
        this.id = id;
    };
    this.getFriendId = function()
    {
        return this.friendId;
    };
    this.setFriendId = function(friendId)
    {
        this.friendId = friendId;
    };

    this.getUserId = function()
    {
        return this.userId;
    };
    this.setUserId = function(userId)
    {
        this.userId = userId;
    };

}
