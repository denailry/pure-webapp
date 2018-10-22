<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body>
        <div id="main">
            <div id="profile">
                <img id="edit-profile" style="height: 100%; cursor: pointer;" src="statics/img/edit-profile.png"
                    onclick="window.location.href='editprofile.php';">
            </div>
            <div style="background-color: #00374c">
                <img id="profile-picture" src="statics/img/default-profile-picture.png">
            </div>
            <div id="profile-name">
                <span class="name"><?php getvar('name'); ?></span>
            </div>
            <h2>My Profile</h2>
            <table style="table-layout:fixed; width: 70%; margin-left: 50px">
                <tr>
                    <td style="width: 5px">
                        <img id="username" style="height: 100%" src="statics/img/username.png">
                    </td>
                    <td style="width: 40px">Username</td>
                    <td>@<?php getvar('username'); ?></td>
                </tr>
                <tr>
                    <td><img id="email" style="height: 100%" src="statics/img/email.png"></td>
                    <td>Email</td>
                    <td><?php getvar('email'); ?></td>
                </tr>
                <tr>
                    <td><img id="address" style="height: 100%" src="statics/img/address.png"></td>
                    <td>Address</td>
                    <td><?php getvar('address'); ?></td>
                </tr>
                <tr>
                    <td><img id="phone" style="height: 100%" src="statics/img/phone.png"></td>
                    <td>Phone Number</td>
                    <td><?php getvar('phone'); ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>