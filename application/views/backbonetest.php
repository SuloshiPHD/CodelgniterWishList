<?php


?>

<html>
<head>
    <script src="/CodelgniterWishList/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="/CodelgniterWishList/js/underscore.js" type="text/javascript"></script>
    <script src="/CodelgniterWishList/js/backbone.js" type="text/javascript"></script>
</head>
<body>
<div id="dataEntryPanel">

    <div id="name"></div>
    <div id="status"></div>
    <div id="userdata"></div>
    <input type="text" id="textData" value=" "/>
    <input type="button" id="btnChange" value="Change Me Local" />
    <input type="button" id="btnGet" value="GET Me" />

<!--    <input type="button" value="GET Me" onclick="doGet()"/>-->
    <!--retrieve the user from the rest server and display name-->
<!--    <input type="button" value="PUT Me" onclick="doPut()"/>-->
    <!--modified the retrieve data and call the server-->
<!--    <input type="button" value="DELETE Me" onclick="doDelete()"/>-->
    <!--call the server and delete the user-->
<!--    <input type="button" value="POST Me" onclick="doPost()"/>-->
<!--    <input type="button" value="Change Me Local" onclick="doChange()"/>-->

</div>
<script type="text/javascript" lang="javascript">

    var User = Backbone.Model.extend({
        url: '/CodelgniterWishList/index.php?/api/user/users/id/1',
        idAttribute: 'id',
        defaults:
        //{"id":1,"name":"John","email":"john@example.com","fact":"Loves coding"}
            {
                "id": null,
                "name": "",
                "email": "",
                "fact": ""
            }
    });

    //use collection get more than one record
    var UserList = Backbone.Collection.extend({
        url: '/CodelgniterWishList/index.php?/api/user/users/',
        model: User
    });
    var userList = new UserList();
   // userList.fetch({async: false});
    //alert(userList)

    var DataEntryView = Backbone.View.extend({
        el: '#dataEntryPanel',

        initialize: function () {
            this.listenTo(this.model, 'sync change ', this.render);
            this.listenTo(this.model, 'add ', this.render);
            //this.model.fetch();
        },
        render: function (){
            var stuff = 'hi we have the following !';
            this.model.each(function (item) {
                stuff += '<br/>Name:' + item.get('name');
            } );
            $('#userdata').html(stuff);
        },
        events: {
            'click #btnChange': 'doChange',
            'click #btnGet': 'doGet'
        },
        doChange: function () {
            var firstName = $('#textData').val();
            var newUser = new User();
            newUser.set('name', firstName);
            newUser.save();
            this.model.add(newUser);
            //this.render();
            //alert('Do change clicked');
        },
        doGet: function () {
           this.model.fetch();
        }
    });
    var daraEntryView = new DataEntryView({model:userList});


    //now let use a view to automate
    /*var UserEntryView = Backbone.View.extend({
        el: '#userdata',

        initialize: function () {

            this.listenTo(this.model, 'sync change ', this.render);
            this.listenTo(this.model, 'change', this.myfunc);
            this.model.fetch();
            //this.render();
        },

        render: function () {
            var html = '<table border="1"><tr><td style="color: red"><b> Name: </b>  </td><td>' + this.model.get('name');
            html += '</td><td> eMail </td><td>' + this.model.get('email') + '</td></tr></table>';

            this.$el.html(html);
            //similar to Jquery -> document.getElementById('userdata').innerHTML = '';
            //similar to JS -> $('#userdata').html('');
            return this;
        },
        myfunc: function () {
            // alert('Boo')
        }
    });
    var userEntry = new User();
    var displayUser = new UserEntryView({model: userEntry});

    function doChange() {

        userEntry.set('name', 'Hi my Crush! ');
    }

    function doGet() {

        userEntry.fetch();
    }

    function doPut() {

        userEntry.save();
    }

    function doPost() {
        userEntry.set('id', null);
        userEntry.save();
    }

    function doDelete() {
        userEntry.destroy();
    }*/


    // userEntry.set('name','Duneesha');
    // userEntry.save({async: false});
    // alert(userEntry.get('name'));
    //$('#status').html('save called');

    /*var DataEntryView = Backbone.View.extend({
        el: '#dataEntryPanel',
        events: {
            'click #btnChange': 'doChange',
            'click #btnGet': 'doGet'
        },
        doChange: function () {
            alert('Do change clicked');
        },
        doGet: function () {
            alert("Do GET button Clicked");
        }
    });
    var daraEntryView = new DataEntryView();*/


    //fetch is asynchronous by default, so this code
    //displays null // Make it synchronous using async:false
    // userEntry.fetch({async: false});
    //by hand
    // $('#name').html(userEntry.get('name') + ' '+ userEntry.get('email'));
    // userEntry.set('name','Duneesha');
    //userEntry.set('id',null);
    //userEntry.save({async:false});


    // $('#status').html(userEntry.get('name') + ' '+ userEntry.get('email'));

    //userEntry.destroy({async: false});
    // $('#status').html('save called -users_put()');
    //alert(userEntry.get('name'));
    //document.getElementById('name').innerHTML =userEntry.get('name');


</script>


</body>
</html>
