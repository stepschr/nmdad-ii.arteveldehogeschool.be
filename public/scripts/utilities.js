var Util = {
    Store: {
        local: function(key, value) {
            return this.storage(localStorage, key, value);
        },
        session: function(key, value) {
            return this.storage(sessionStorage, key, value);
        },
        storage: function(storage, key, value) {
            if (typeof value === "undefined") {
                var value = storage.getItem(key);
                return value && JSON.parse(value);
            } else {
                storage.setItem(key, JSON.stringify(value));
                return true;
            }
        }
    }
};