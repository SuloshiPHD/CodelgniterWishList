$(document).ready(function () {
    var Item = Backbone.Model.extend({
        defaults: {
            title: '',
            price: '',
            url: '',
            priority: '',
            priorityDescription: '',
            username: ''
        }
    });
    var User = Backbone.Model.extend({
        defaults: {
            username: '',
            password: '',
            name: '',
            wishlist_name: '',
            wishlist_desc: '',
            wishlist_occasion: ''
        }
    });
    var Login = Backbone.Model.extend({
        defaults: {
            username: '',
            password: ''
        }
    });
    var Logout = Backbone.Model.extend({
        urlRoot: 'http://localhost/CodelgniterWishList/index.php/api/logout'
    });
    // Backbone Collection
    var Items = Backbone.Collection.extend({
        url: 'http://localhost/CodelgniterWishList/index.php/api/item',
        comparator: 'priority'
    });
    var Users = Backbone.Collection.extend({
        url: 'http://localhost/CodelgniterWishList/index.php/api/user'
    });
    var Logins = Backbone.Collection.extend({
        url: 'http://localhost/CodelgniterWishList/index.php/api/login'
    });
    var items = new Items();
    var users = new Users();
    var logins = new Logins();
    var currentUserName;
    var userArray;

    users.fetch({
        success: function (response) {
            console.log(response.toJSON());
            userArray = response.toJSON();
            currentUserName = $('#wishListNameValue').val();
            var currentUser;
            for (var i = 0; i < userArray.length; i++) {
                if (userArray[i].username == currentUserName) {
                    currentUser = userArray[i];
                    break;
                }
            }
            if (currentUser) {
                $('#wishListName').html(currentUser.name + "'s " +
                    currentUser.wishlist_name + " | " + currentUser.wishlist_occasion);
                $('#wishListDesc').html(currentUser.wishlist_desc);
            }
        }
    });
    var ItemView = Backbone.View.extend({
        model: new Item(),
        tagName: 'tr',
        initialize: function () {
            this.template = _.template($('.items-list-template').html());
        },
        events: {
            'click .edit-item': 'edit',
            'click .update-item': 'update',
            'click .cancel': 'cancel',
            'click .delete-item': 'delete'
        },
        edit: function () {
            $('.edit-item').hide();
            $('.delete-item').hide();
            this.$('.update-item').show();
            this.$('.cancel').show();
            var title = this.$('.title').html();
            var price = this.$('.price').html();
            var url = this.$('.url').html();
            var priority = this.$('.priorityDescription').html();

            this.$('.title').html('<input type="text" class="form-control title-update" value="' + title + '">');

            this.$('.price').html('<input type="text" class="form-control price-update" value="' + price + '">');
            this.$('.url').html('<input type="text" class="form-control url-update" value="' + url + '">');
            if($('.priorityDescription').html().toLowerCase() === "high"){
                this.$('.priorityDescription').html('<select class="formcontrol priorityDescription-update">' +
                    '<option value="High" selected="selected">High</option>' +
                    '<option value="Medium">Medium</option><option value="Low">Low</option></select>');

            }else if($('.priorityDescription').html().toLowerCase() ===
                "medium"){
                this.$('.priorityDescription').html('<select class="formcontrol priorityDescription-update"><option value="High">High</option>' +
                    '<option value="Medium" selected="selected">Medium</option>' +
                    '<option value="Low">Low</option></select>');

            }else if($('.priorityDescription').html().toLowerCase() === "low"){
                this.$('.priorityDescription').html('<select class="formcontrol priorityDescription-update"><option value="High">High</option>' +
                    '<option value="Medium">Medium</option><option value="Low" selected="selected">Low</option></select>');
            }
        },
        update: function () {
            this.model.set('title', $('.title-update').val());
            this.model.set('price', $('.price-update').val());
            this.model.set('url', $('.url-update').val());
            this.model.set('priorityDescription', $('.priorityDescription-update').val());
            var priority;
            if ($('.priorityDescription-update').val().toLowerCase() =="high") {
                priority = 1;
            } else if ($('.priorityDescription-update').val().toLowerCase() =="medium") {
                priority = 2;
            } else if ($('.priorityDescription-update').val().toLowerCase() == "low") {
                priority = 3;
            } else {
                priority = 0;
            }
            this.model.set('priority', priority);
            this.model.save(null, {
                success: function (response) {
                    console.log('Successfully UPDATED item with _id: ' +
                        response.toJSON().id);
                    items.sort();
                },
                error: function (err, args) {
                    console.log(err)
                    console.log(args)
                }
            });
        },
        cancel: function () {
            itemsView.render();
        },
        delete: function () {
            this.model.destroy({
                success: function (response) {
                    console.log('Successfully DELETED item with _id: ' +
                        response.toJSON().id);
                },
                error: function (err, args) {
                    console.log(err);
                    console.log(args);
                }
            });
        },
        render: function () {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        }
    });
    var ItemsView = Backbone.View.extend({
        model: items,
        el: $('.items-list'),
        initialize: function () {
            var self = this;
            this.model.on('add', this.render, this);
            this.model.on('change', function () {
                setTimeout(function () {
                    self.render();
                }, 30);
            }, this);
            this.model.on('remove', this.render, this);
            this.model.fetch({
                success: function (response) {
                    _.each(response.toJSON(), function (item) {
                        console.log('Successfully GOT item with _id: ' + item.id);
                    })
                },
                error: function () {
                    console.log('Failed to get item!');
                }
            });
        },
        render: function () {
            var self = this;
            this.$el.html('');
            _.each(this.model.toArray(), function (item) {
                self.$el.append((new ItemView({ model: item })).render().$el);
            });
            return this;
        }
    });
    var itemsView = new ItemsView();
    // adding a wish list item
    $('.add-item').on('click', function () {
        if ($('.title-input').val() && $('.price-input').val() && $('.url-input').val() && $('.priorityDescription-input').val()) {
            var priority;
            if ($('.priorityDescription-input').val().toLowerCase() == "high")
            {
                priority = 1;
            } else if ($('.priorityDescription-input').val().toLowerCase() =="medium") {
                priority = 2;
            } else if ($('.priorityDescription-input').val().toLowerCase() == "low") {
                priority = 3;
            } else {
                priority = 0;
            }
            if (priority > 0) {
                var item = new Item({
                    title: $('.title-input').val(),
                    price: $('.price-input').val(),
                    url: $('.url-input').val(),
                    priority: priority,
                    priorityDescription: $('.priorityDescription-input').val(),
                    username: currentUserName
                });
                $('.title-input').val('');
                $('.price-input').val('');
                $('.url-input').val('');
                $('.priorityDescription-input').val('');
                items.add(item);
                item.save(null, {
                    success: function (response) {
                        item.set('id', response.toJSON().id);
                    },
                    error: function (error, args) {
                        console.log(error);
                        console.log(args);
                    }
                });
            }
        } else{
            Swal.fire({
                title: 'Fields Invalid',
                text: 'Some of the fields have not been entered correctly.Please try again!',
                type: 'error',
                confirmButtonText: 'Okay'
        })
        }
    });
    //logout function
    $('#logout').on('click', function () {
        var logout = new Logout();
        logout.save(null, {
            success: function (response) {
                window.location.href =
                    "http://localhost/CodelgniterWishList/index.php/login";
            },
            error: function (error, args) {
                console.log(error);
                console.log(args);
            }
        });
    });
    $('#shareList').on('click', function () {


        Swal.fire({
            title: '<strong>Here is your share link!</strong>',
            icon: 'success',
            text: 'http://localhost/CodelgniterWishList/index.php/wishlist/username/' + currentUserName,
            showCloseButton: true,
            focusConfirm: false,
            confirmButtonText:
                '<i class="fa fa-thumbs-up"></i> Great!',
            confirmButtonAriaLabel: 'Thumbs up, great!'
        })
    })
});