<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="statics/css/home.css">
</head>

<body>
    <?php embed("main-bar"); setvar('page', 'profile'); ?>

    <div id="main">
        <h2>Edit Profile<h2>
    </div>
    <!-- Mustinya cari dari DB : 
        SELECT profilepic
        FROM user
        WHERE id=this.id;
-->


    <form method="POST" autocomplete="off">
        <div class="flex-container" id="change-profpic">
            <div>
                <img src="/mocks/edit_profile.png" alt="foto profil" height="50" width="50">
            </div>
            <div>

                <div class="input-group">
                    <div class="input-fields">
                        <label>Update profile picture</label>
                    </div>
                    <div class="flex-container">
                        <input id="fileinput" type="text" name="fname">
                        <div class="input-value">
                            <input type="file" id="newProfilePicture" size="50">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="input-group flex-container" id="name-input">
            <div class="input-fields">
                <label for="name">Name</label>
            </div>
            <div class="input-value">
                <input id="name" type="text">
            </div>
        </div>

        <div class="flex-container" id="address-input">
            <div class="input-group flex-container" id="name-input">
                <div class="input-fields">
                    <label for="address">Address</label>
                </div>
                <div class="input-value">
                    <input id="address" type="text">
                </div>
            </div>
        </div>

        <div class="input-group flex-container" id="name-input">
            <div class="input-fields">
                <label for="phone-number">Phone Number</label>
            </div>
            <div class="input-value">
                <input type="text">
            </div>
        </div>

        <button type="submit" id="back-button">Back</button>
        <button class="right-button" type="submit" id="save-button">Save</button>
    </form>

</body>
</html>