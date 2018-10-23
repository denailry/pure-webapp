<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="statics/css/home.css">
</head>

<body>
    <?php embed("main-bar"); ?>

    <div id="main">
        <h2>Edit Profile<h2>
    </div>
    <!-- Mustinya cari dari DB : 
        SELECT profilepic
        FROM user
        WHERE id=this.id;
-->
    <form method="POST" autocomplete="off">
        <table style="width:100%">
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <div id="profile-picture">
                        <img src="/mocks/edit_profile.png" alt="foto profil" height="50" width="50">
                    </div>
                </td>
                <td>
                    <div class="input-fields">
                        <label>Update profile picture</label>
                    </div>
                    <br>
                    <textarea id="fileinput" type="text" name="fname">
                    <div class="input-value">
                        <input name="profilepic" type="file" id="user-profile-picture" size="50">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-fields">
                        <label for="name">Name</label>
                    </div>
                </td>
                <td>
                    <div class="input-value" id="name-input">
                        <div>
                            <textarea name = "name" id="user-name" type="text" value="<?php getvar('name'); ?>">
                        </div>
                    </div>
                </td>
            </tr>
            <td>
                <div class="input-fields">
                    <label for="address">Address</label>
                </div>
            </td>
            <td>
                <div class="input-value">
                    <textarea name="address" id="user-address" type="text" value="<?php getvar('address'); ?>">
                    <br>
                    <br>
                    <br>
                </div>
            </td>
            <tr>
                <td>
                    <div class="input-fields">
                        <label for="phone-number">Phone Number</label>
                    </div>
                </td>
                <td>
                    <div class="input-value">
                        <textarea name="phone-number" id="user-phone-number" type="text" value="<?php getvar('phone'); ?>">
                    </div>
                </td>
            </tr>
        </table>
    </form>


    <button type="submit" id="back-button">Back</button>
    <button class="right-button" type="submit" id="save-button">Save</button>
    </form>

</body>

<script type="text/javascript">
    document.getElementById("menu-profile").setAttribute("data-menu-selected", "");
</script>

</html>