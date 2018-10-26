<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body class="nunitofont">
        <div id="main">
            <div class="profile">
                <img src="statics/img/edit-profile.png"
                    onclick="window.location.href='editprofile.php';">
            </div>
            <div class="profile-pic">
                <img src=<?php getvar('profilepicture'); ?>>>
            </div>
            <div id="profile-name">
                <span class="name"><?php getvar('name'); ?></span>
            </div>
            <h2>My Profile</h2>
            <table class="profile">
                <tr>
                    <td class="icon"><img id="username" src="statics/img/username.png"></td>
                    <td class="profiletitle">Username</td>
                    <td>@<?php getvar('username'); ?></td>
                </tr>
                <tr>
                    <td class="icon"><img id="email" src="statics/img/email.png"></td>
                    <td class="profiletitle">Email</td>
                    <td><?php getvar('email'); ?></td>
                </tr>
                <tr>
                    <td class="icon"><img id="address" src="statics/img/address.png"></td>
                    <td class="profiletitle">Address</td>
                    <td><?php getvar('address'); ?></td>
                </tr>
                <tr>
                    <td class="icon"><img id="phone" src="statics/img/phone.png"></td>
                    <td class="profiletitle">Phone Number</td>
                    <td><?php getvar('phone'); ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>