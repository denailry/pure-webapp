<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body>
        <div id="main">
            <div id="profile">
<<<<<<< HEAD
                <img id="edit-profile" style="height: 100%; cursor: pointer;" src="statics/img/edit-profile.png"
=======
                <img id="edit-profile" src="statics/img/edit-profile.png"
>>>>>>> 3b36c828d9c91650676c90cef199fb62f138c50a
                    onclick="window.location.href='editprofile.php';">
            </div>
            <div id="profile-picture">
                <img src="statics/img/default-profile-picture.png">
            </div>
            <div id="profile-name">
                <span class="name"><?php getvar('name'); ?></span>
            </div>
            <h2>My Profile</h2>
            <table class="profile">
                <tr>
                    <td class="icon"><img id="username" src="statics/img/username.png"></td>
                    <td class="title">Username</td>
                    <td>@<?php getvar('username'); ?></td>
                </tr>
                <tr>
                    <td class="icon"><img id="email" src="statics/img/email.png"></td>
                    <td class="title">Email</td>
                    <td><?php getvar('email'); ?></td>
                </tr>
                <tr>
                    <td class="icon"><img id="address" src="statics/img/address.png"></td>
                    <td class="title">Address</td>
                    <td><?php getvar('address'); ?></td>
                </tr>
                <tr>
                    <td class="icon"><img id="phone" src="statics/img/phone.png"></td>
                    <td class="title">Phone Number</td>
                    <td><?php getvar('phone'); ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>