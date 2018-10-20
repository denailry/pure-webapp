<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body>
        <div id="main">
            <div id="profile">
                <img id="edit-profile" style="height: 17%; cursor: pointer;" src="statics/img/edit-profile.png"
                    onclick="window.location.href='edit-profile.php';">
            </div>
            <div id="profile-name">
                <span class="name"><?php getvar('name'); ?></span>
            </div>
            <h2>My Profile</h2>
            <table style="width: 70%">
                <tr>
                    <td>Username</td>
                    <td>@<?php getvar('username'); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php getvar('email'); ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php getvar('address'); ?></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><?php getvar('phone'); ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>