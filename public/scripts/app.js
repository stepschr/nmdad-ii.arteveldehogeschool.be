$(document).on("mobileinit", function() {
    console.info("jQuery", $.prototype.jquery
        , "|", "jQuery Mobile", $.mobile.version
        , "|", "Lo-Dash", _.VERSION
//        , "|", "Modernizr", Modernizr._version
    );
    /**
     * jQuery Mobile defaults: http://api.jquerymobile.com/global-config/
     */
    $.mobile.ajaxEnabled = false;
    $.mobile.allowCrossDomainPages = true;/* $.support.cors = true; // needed for Apache Cordova or Adobe PhoneGap */
    $.mobile.loader.prototype.options.html = "";
    $.mobile.loader.prototype.options.textVisible = false;
    $.mobile.loader.prototype.options.theme = "b";
    $.mobile.ns = ""; // Set a namespace for jQuery Mobile data attributes
    $.mobile.page.prototype.options.theme = "a";
    $.mobile.popup.prototype.options.overlayTheme = "b";
    $.ajaxSetup({
        cache: false,
        contentType: "application/json",
        dataType: "json",
        timeout: 30 * 1000 // 30 seconds to timeout
    });
    App.init();
});

/**
 * App object with properties and methods
 */

var baseUrl = "/nmdad-ii.arteveldehogeschool.be/public/api/";
var App = {
    init: function() {
        this.bindEvents();

        this.loadUsers();
        this.loadDeletedUsers();
        this.loadAllTasks();
        this.loadTasks();
        this.loadFinished();
        this.loadLists();




        console.info("App initialized");
    },

    loadUsers: function(){
        var that = this;
        $.ajax({
            type: "GET",
            url: baseUrl + "users",
            cache: false,
            success: function(userlijst){
                that.renderUsers(userlijst);
               // console.log(userlijst);

            },
            error: function(){

            }
        });
    },

    renderUsers: function(userlijst){
        var that = this;
        //console.log(userlijst);
        var userList = "";
        $.each(userlijst, function(i, user){
            userList += _.template(that.templates.user, {"user": user});
        });
        $("#userlist").html(userList);
    },

    loadDeletedUsers: function(){
        var that = this;
        $.ajax({
            type: "GET",
            url: baseUrl + "deletedusers",
            cache: false,
            success: function(userlijst){
                that.renderDeletedUsers(userlijst);

            },
            error: function(){

            }
        });
    },

    renderDeletedUsers: function(userlijst){
        var that = this;
        var userList = "";
        $.each(userlijst, function(i, user){
            userList += _.template(that.templates.restoreuser, {"user": user});
        });
        $("#deleteduserlist").html(userList);
    },

    loadTasks: function(){
        var that = this;
        $.ajax({
            type: "GET",
            url: baseUrl + "tasklijst",
            cache: false,
            success: function(taskslijst){
                that.renderTasks(taskslijst);
               // console.log(taskslijst);
            },
            error: function(){

            }
        });
    },

    renderTasks: function(taskslijst){
        var that = this;
        var taskList = "";
        $.each(taskslijst, function(i, task){
            taskList += _.template(that.templates.task, {"task": task});
            //console.log(task);
        });
        $("#tasks").html(taskList);

    },

    loadFinished: function(){
        var that = this;
        $.ajax({
            type: "GET",
            url: baseUrl + "finishedlijst",
            cache: false,
            success: function(taskslijst){
                that.renderFinished(taskslijst);
                //console.log(taskslijst);
            },
            error: function(){

            }
        });
    },
    loadAllTasks: function(){
        var that = this;
        $.ajax({
            type: "GET",
            url: baseUrl + "alltask",
            cache: false,
            success: function(taskslijst){
                that.renderAllTasks(taskslijst);
                //console.log(taskslijst);

            },
            error: function(){

            }
        });
    },

    renderAllTasks: function(taskslijst){
        var that = this;
        var taskList = "";
        $.each(taskslijst, function(i, task){
            taskList += _.template(that.templates.task, {"task": task});
        });
        $("#alltask").html(taskList);
    },

    renderFinished: function(taskslijst){
        var that = this;
        var taskList = "";
        $.each(taskslijst, function(i, task){
            taskList += _.template(that.templates.finished, {"task": task});
        });
        $("#finishedtasks").html(taskList);
    },

    loadLists: function(){
        var that = this;
        $.ajax({
            type: "GET",
            url: baseUrl + "list",
            cache: false,
            success: function(lists){
             console.log(lists);
                that.renderLists(lists);

            },
            error: function(){

            }
        });
    },

    renderLists: function(lists){
        var that = this;
        var lijstList = "";
       // console.log(lists);
        $.each(lists, function(i, list){
            lijstList += _.template(that.templates.list, {"list": list});

            var taskList = "";
            $.each(list.tasks, function(j, task) {
                taskList += _.template(that.templates.task, {"task": task});
                //console.log(taskList);
            });
            lijstList +=
                $(_.template(that.templates.lijst, { "list": list }))
                    .find("ul.lijstTodos")
                    .html(taskList)
                    .end()
                    .prop("outerHTML")
            ;

        });
        $("#lijsten").html(lijstList);
    },

        bindEvents: function() {
            var that = this;
            $(document)

                 //Delete User
                 .on("click", ".userDelete", function(ev) {
                 var id = $(this).parents("[data-role=collapsible]").first().attr("data-user-id");
                 that.destroyUser(id);
                 location.reload();
                 })

                //Restore User
                .on("click", ".userRestore", function(ev) {
                    var id = $(this).parents("[data-role=collapsible]").first().attr("data-user-id");
                    that.restoreUser(id);
                    location.reload();
                })

                // Destroy Task
                .on("click", ".taskDelete", function(ev) {
                    var id = $(this).parents("[data-role=collapsible]").first().attr("data-task-id");
                    console.log("delete")
                    that.destroyTask(id);

                })
                // Done Task
                .on("click", ".taskDone", function(ev) {
                    var id = $(this).parents("[data-role=collapsible]").first().attr("data-task-id");
                    that.doneTask(id);
                    location.reload();
                })

                // Redo Task
                .on("click", ".taskRedo", function(ev) {
                    var id = $(this).parents("[data-role=collapsible]").first().attr("data-task-id");
                    that.redoTask(id);
                    location.reload();
                })
                //Update Task
                .on("click", ".taskEdit", function(ev) {
                    var id = $(this).parents("[data-role=collapsible]").first().attr("data-task-id");
                    that.updateTask(id);
                })

                // Destroy List
                .on("click", ".listDelete", function(ev) {
                    var id = $(this).parents("[data-role=collapsible]").first().attr("data-list-id");
                    that.destroyList(id);
                })

                // Update List
                .on("click", ".listUpdate", function(ev) {
                    var id = $(this).parents("[data-role=collapsible]").first().attr("data-list-id");
                    that.updateList(id);
                })

                /*
                .on("blur", "#form-pomodoro-update textarea", function(ev) {
                    var form = $(this).parents("form").first();
                    that.updatePomodoro(form);
                })
                .on("change", "#form-pomodoro-update select", function(ev) {
                    var form = $(this).parents("form").first();
                    that.updatePomodoro(form);
                })
                // Destroy Label
                .on("click", "[data-label-id] a[data-label-destroy]", function(ev) {
                    var id = $(this).parent().attr("data-label-id");
                    that.destroyLabel(id);
                })

                // Destroy Task
                .on("click", "[data-role=collapsible] button", function(ev) {
                    var id = $(this).parents("[data-role=collapsible]").first().attr("data-task-id");
                    that.destroyTask(id);
                })
                // Destroy Task show/hide button
                .on("listviewcreate", "#page-tasks [data-role=listview]", function(ev, ui) {
                    if (0 < $(this).children("li").length) {
                        $(this).prev("button").hide();
                    } else {
                        $(this).prev("button").show();
                    }
                })
                // Destroy List
                .on("click", "[data-role=collapsible] button", function(ev) {
                    var id = $(this).parents("[data-role=collapsible]").first().attr("data-lists-id");
                    that.destroyLists(id);
                })
                // Destroy List show/hide button
                .on("listviewcreate", "#page-lists [data-role=listview]", function(ev, ui) {
                    if (0 < $(this).children("li").length) {
                        $(this).prev("button").hide();
                    } else {
                        $(this).prev("button").show();
                    }
                })
                // Load model per page
                .on("pagecontainerbeforeshow", "body", function(ev, ui) {
                    var activePage = $(this).pagecontainer("getActivePage").attr("id");
                    switch (activePage) {
                        case "page-label":
                            var id = Util.Store.session("label-id");
                            if (!_.isNull(id)) {
                                that.load("label", id).done(that.renderLabel);
                            }
                            break;
                        case "page-labels":
                            that.load("label").done(that.renderLabels);
                            break;
                        case "page-pomodoro":
                            var id = Util.Store.session("pomodoro-id");
                            if (!_.isNull(id)) {
                                that.load("pomodoro", id).done(that.renderPomodoro);
                            }
                            break;
                        default:
                            //console.warn("Unknown page '" + activePage + "'.");
                            break;
                    }
                })
                // Set active Label
                .on("click", "[data-label-id] a[href=#page-label]", function(ev) {
                    var id = Number($(this).parent().attr("data-label-id"));
                    Util.Store.session("label-id", id);
                })

                // Store Label
                .on("submit", "#form-label-add", function(ev) {
                    ev.preventDefault();
                    var form = $(this);
                    that.storeLabel(form);
                })
*/
                // Store Task
                .on("submit", "#form-task-add", function(ev) {
                    ev.preventDefault();
                    var form = $(this);
                    that.storeTask(form);
                })


                /*
                // Store List
                .on("submit", "#form-lists-add", function(ev) {
                    ev.preventDefault();
                    var form = $(this);
                    that.storeLists(form);
                })
                // Timer
                .on("click", "#pomodoro-timer", function(ev) {
                    ev.preventDefault();
                    if (_.isNull(that.Timer.data.intervalId)) {
                        that.Timer.start();
                        $(this)
                            .removeClass("ui-icon-forbidden")
                            .addClass("ui-icon-clock")
                        ;
                        $("#sound-pomodoro-started")[0].play();
                    } else {
                        that.Timer.stop();
                        var form = $(this).parents("#form-pomodoro-update").first();
                        that.updatePomodoro(form);
                        $(this)
                            .removeClass("ui-icon-clock")
                            .addClass("ui-icon-forbidden")
                        ;
                        $("#sound-pomodoro-paused")[0].play();
                    }
                })
                // Update Label
                .on("submit", "#form-label-update", function(ev) {
                    ev.preventDefault();
                    var form = $(this);
                    that.updateLabel(form);
                })*/
            ;
        },
    destroy: function(modelName, id) {
        var that = this;

        return $.ajax({
            type: "DELETE",
            url: baseUrl + modelName + "/" + id,
            beforeSend: function(jqXHR) {
                $.mobile.loading("show");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                that.logErrors(jqXHR, textStatus, errorThrown);
            },
            complete: function() {
                $.mobile.loading("hide");
            }
        });
    },
    destroyTask: function(id) {
        var taskElement = $("[data-task-id=" + id + "]");
        taskElement.hide();
        console.log("delete")
        this.destroy("taskDel", id)
            .fail(function() {
                taskElement.show();
                console.log("delete");
            })
        ;
    },
    destroyList: function(id) {
        var listElement = $("[data-list-id=" + id + "]");
        listElement.hide();
        this.destroy("listDel", id)
            .fail(function() {
                listElement.show();
            })
        ;
    },

         destroyUser: function(id) {
             var userElement = $("[data-user-id=" + id + "]");
             userElement.hide();
             this.destroy("userDel", id)
             .fail(function() {
                userElement.show();
             })
            ;
        },

    restore: function(modelName, id) {
        var that = this;

        return $.ajax({
            type: "GET",
            url: baseUrl + modelName + "/" + id,
            beforeSend: function(jqXHR) {
                $.mobile.loading("show");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                that.logErrors(jqXHR, textStatus, errorThrown);
            },
            complete: function() {
                $.mobile.loading("hide");
            }
        });
    },
         restoreUser: function(id) {
             var userElement = $("[data-user-id=" + id + "]");
             userElement.hide();
             this.restore("userRestore", id)
            .fail(function() {
                userElement.show();
            })
        ;
    },
    update: function(modelName, id) {
        var that = this;
        console.log("Button for post " + id + " clicked.");
        return $.ajax({
            type: "GET",
            url: baseUrl + modelName + "/" + id


        });

    },

    updateTask: function(id) {
           this.update("taskEdit", id);
    },

    updateList: function(id) {
        this.update("listEdit", id);
    },

    finish: function(modelName, id) {
        var that = this;
        return $.ajax({
            type: "PUT",
            url: baseUrl + modelName + "/" + id


        });

    },
    doneTask: function(id){
        this.finish("taskDone", id);
    },
    redoTask: function(id){
        this.finish("taskRedo", id);
    },
 /*
        destroyLabel: function(id) {
            var labelElement = $("[data-label-id=" + id + "]");
            labelElement.hide();
            this.destroy("label", id)
                .fail(function() {
                    labelElement.show();
                })
            ;
        },

        destroyTask: function(id) {
            var taskElement = $("[data-task-id=" + id + "]");
            taskElement.hide();
            this.destroy("task", id)
                .fail(function() {
                    taskElement.show();
                })
            ;
        },
        destroyLists: function(id) {
            var listsElement = $("[data-lists-id=" + id + "]");
            listsElement.hide();
            this.destroy("lists", id)
                .fail(function() {
                    listsElement.show();
                })
            ;
        },

        renderLabel: function(label) {
            var that = this;
            $("#page-label")
                .find("#label-name")
                .val(label.name)
                .end()
                .find("#label-colour")
                .val(label.colour)
            ;
        },
        renderLabels: function(labels) {
            var compiledLabelTemplates = "";
            $.each(labels, function(i, label) {
                compiledLabelTemplates += _.template(App.templates.label, { "label": label });
            });
            $("#labels")
                .html(compiledLabelTemplates)
                .trigger("listviewcreate")
                .listview().listview("refresh")
            ;
        },


        renderTask: function(task) {
            var compiledTaskTemplate = _.template(this.templates.task, { "task": task });
            $("#tasks")
                .append(compiledTaskTemplate)
                .trigger("create")
            ;
        },

        renderTasks: function(tasks) {
            var that = this;
            var compiledTaskTemplates = "";
            $.each(tasks, function(i, task) {
                var compiledPomodoroTemplates = "";
                $.each(task.pomodori, function(j, pomodoro) {
                    compiledPomodoroTemplates += _.template(App.templates.pomodoro, { "pomodoro": pomodoro });
                });
                compiledTaskTemplates +=
                    $(_.template(App.templates.task, { "task": task }))
                        .find("ul")
                        .append(compiledPomodoroTemplates)
                        .end()
                        .prop("outerHTML")
                ;
            });
            $("#tasks")
                .html(compiledTaskTemplates)
    //              .collapsibleset("refresh")
                .trigger("create")
            ;
            console.log(tasks);
        },
        renderList: function(lists) {
            var compiledListsTemplate = _.template(this.templates.lists, { "lists": lists });
            $("#lists")
                .append(compiledListsTemplate)
                .trigger("create")
            ;
        },
        renderLists: function(lists) {

            var that = this;
            var compiledListsTemplates = "";

            $.each(lists, function(i, lists) {
                var compiledPomodoroTemplates = "";
                //$.each(lists.pomodori, function(j, pomodoro) {
                  //  compiledPomodoroTemplates += _.template(App.templates.pomodoro, { "pomodoro": pomodoro });
                //});
                compiledListsTemplates +=
                    $(_.template(App.templates.lists, { "lists": lists }))
                        .find("ul")
                        //.append(compiledPomodoroTemplates)
                        .end()
                        .prop("outerHTML")
                ;
            });
            $("#lists")
                .html(compiledListsTemplates)
    //              .collapsibleset("refresh")
                .trigger("create")
            ;
            console.log(lists);

        },
        store: function(modelName, model) {
            var that = this;

            return $.ajax({
                type: "POST",
                url: baseUrl + modelName,
                data: JSON.stringify(model),
                error: function(jqXHR, textStatus, errorThrown) {
                    that.logErrors(jqXHR, textStatus, errorThrown);
                }
            });
        },
        storeLabel: function(form) {
            var that = this;
            var nameInput = form.find("input[name=label-name]");
            var label = new Label();
            label.setName(nameInput.val().trim());

            that.store("label", label)
                .done(function() {
                    nameInput.val("");
                    that.load("label").done(that.renderLabels);
                })
            ;
        },
*/
        storeTask: function(form) {
            var that = this;
            var nameInput = form.find("input[name=task-name]");
            var dueInput = form.fin
            var task = new Task();
            task.setName(nameInput.val().trim());
                console.log(task);
            that.store("task", task)
                .done(function(task) {
                    nameInput.val("");
                    that.renderTask(task);
                })
            console.log(task);
            ;
        },/*
        storeLists: function(form) {
            var that = this;
            var nameInput = form.find("input[name=lists-name]");
            var lists = new Lists();
            lists.setName(nameInput.val().trim());

            that.store("lists", lists)
                .done(function(lists) {
                    nameInput.val("");
                    that.renderLists(lists);
                })
            console.log(lists);
            ;
        },

        updateLabel: function(form) {
            var that = this;
            var nameInput   = form.find("input[name=label-name]");
            var colourInput = form.find("input[name=label-colour]");
            var label = new Label();
            label.setName(nameInput.val().trim());
            label.setColour(colourInput.val().trim());
            var id = Util.Store.session("label-id");

            that.update("label", label, id)
                .done(function() {
                    $("#page-label a").first().click();
                })
            ;
        },


        logErrors: function(jqXHR, textStatus, errorThrown) {
            console.group("Error");
            console.error(textStatus);
            console.info(jqXHR);
            console.log(errorThrown);
            console.groupEnd();
        },
    */
    templates: {
        user: '<div data-role="collapsible" data-collapsed="false" data-user-id="${user.id}">' +
            '<p><img id="profile_user" src="../publicimages/profile_pictures/${user.profile_picture}"/> ${user.username} </br>${user.email}</p>' +
            '<button class="ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-delete userDelete ui-mini">Verwijder: ${user.username}</button>' +
            '</div>',
        restoreuser: '<div data-role="collapsible" data-collapsed="false" data-user-id="${user.id}">' +
            '<p>${user.username}</p>' +
            '<button class="ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-delete userRestore ui-mini">Restore: ${user.username}</button>' +
            '</div>',
        finished: '<div data-role="collapsible" data-collapsed="false" data-task-id="${task.id}">' +
            '<button class="taskRedo"></button>'+
            '<p><span class="bold">${task.name}</span></p><span class="taakdue">${task.due_at}</span>'+
            '<div class="${task.prioriteit}"></div>'+
            '<ul class="inLijst" >' +
            '</ul>' +
            '<button class="ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-delete taskDelete ui-mini">Verwijder ${task.name}</button>' +
            '<a class="ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-edit taskEdit ui-mini" href="/nmdad-ii.arteveldehogeschool.be/public/api/taskEdit/${task.id}">Edit ${task.name}</a>' +
            '</div>',
         task: '<div id="taken" data-role="collapsible" data-collapsed="false" data-task-id="${task.id}">' +
             '<button class="taskDone"></button>'+
             '<p><span class="bold">${task.name}</span></p><span class="taakdue">${task.due_at}</span>'+
            '<div class="${task.prioriteit}"></div>'+
            '<ul>' +
            '</ul>' +
            '<button class="ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-delete taskDelete ui-mini">Verwijder ${task.name}</button>' +
            '<a class="ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-edit taskEdit ui-mini" href="/nmdad-ii.arteveldehogeschool.be/public/api/taskEdit/${task.id}">Edit ${task.name}</a>' +
            '</div>',
        list: '<div data-role="collapsible" data-collapsed="false" data-list-id="${list.id}">' +
            '<li>${list.name}</li>' +
            '<button class="ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-delete listDelete ui-mini">Verwijder ${list.name}</button>' +
            '<a class="ui-btn ui-corner-all ui-btn-inline ui-btn-icon-left ui-icon-edit listUpdate ui-mini" href="/nmdad-ii.arteveldehogeschool.be/public/api/listEdit/${list.id}">Edit ${list.name}</a>' +
            '<p>Taken in deze lijst:</p>' +
            '<ul class="lijstTodos">' +
            '</ul>' +
            '</div>'
    }
}

App.init();