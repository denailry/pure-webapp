<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>

<body class="nunitofont">
    <?php embed("main-bar"); setvar('page', 'editprofile'); ?>

    <div id="main">
        <h2>Edit Profile<h2>
    </div>
    <div class="ml-20">
    <form method="POST" id="input-form" autocomplete="off">
        <table class="ahistorybook">
            <col width="100">
            <col width="300">
            <tr>
                <td>
                    <div id="profile-picturee">
                        <img height="100" width="100"  src=<?php getvar('profilepicture'); ?> border="2">
                    </div>
                </td>
                <td>
                    <div class="input-fields-table" id="update-profile-picture">
                        <label>Update profile picture</label>
                    </div>
                    <br>
                    <input class="input-value ml-10 inputbox inputfile" name='fileinput' id="fileinput" type="text" name="fname">
                    <div class="input-value inputfile" id="inputfileprofpic">
                        <input name="profilepic" type="file" id="user-profile-picture" size="50">
                    </div>
                    <button onclick=inputfile() type="button" class="filebutton" id="buttonprofpic">Browse ...</button>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-fields-table">
                        <label for="name">Name</label>
                    </div>
                </td>
                <td>
                    <div id="name-input">
                        <div>
                            <input class="input-value-table" name="name" id="user-name" type="text" value="<?php getvar('name'); ?>">
                        </div>
                    </div>
                </td>
            </tr>
            <td>
                <div class="input-fields-table">
                    <label for="address">Address</label>
                </div>
            </td>
            <td>
                <div>
                    <textarea class="input-value-table" name="address" id="user-address" type="text" rows="4"><?php getvar('address'); ?></textarea>
                </div>
            </td>
            <tr>
                <td>
                    <div class="input-fields-table">
                        <label for="phone-number">Phone Number</label>
                    </div>
                </td>
                <td>
                    <div>
                        <input class="input-value-table" name="phone-number" id="user-phone-number" type="text" value="<?php getvar('phone'); ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="mt-20" onclick=changePage() type="button" id="back-button">Back</button>
                </td>
                <td>
                    <button class="right-button blue-button mt-20" type="submit" name="submit" id="save-button">Save</button>
                </td>
        </table>



    </form>
</div>
</body>
<script type="text/javascript">
    var picture_url = document.getElementById("user-profile-picture");
    picture_url.onchange = function (event) {
        fileinput.value = (picture_url.value);
    }

    function inputfile() {
        var user_profile_picture = document.getElementById("user-profile-picture");
        user_profile_picture.click();
    }

    function changePage() {
        console.log("HTE")
        window.location.href = "profile.php";
    }
</script>

</html>