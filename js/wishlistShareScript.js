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
        url: 'http://localhost/CodelgniterWishList/index.php/api/share',
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
    var ItemShareView = Backbone.View.extend({
        model: new Item(),
        tagName: 'tr',
        initialize: function () {
            this.template = _.template($('.items-share-list-template').html());
        },
        render: function () {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        }
    });
    var ItemsShareView = Backbone.View.extend({
        model: items,
        el: $('.items-share-list'),
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
                        console.log('Successfully GOT item with _id: ' +  item.id);
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
                self.$el.append((new ItemShareView({ model: item
                })).render().$el);
            });
            return this;
        }
    });
    var itemsShareView = new ItemsShareView();
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
});