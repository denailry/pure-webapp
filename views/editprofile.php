<!DOCTYPE html>
<html>
    <head>
        <title>Edit Profile</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    </head>

    <body class="nunitofont">
        <?php setvar('page', 'profile'); embed("main-bar"); ?>

        <div id="main">
            <div class="ml-20">
            <form method="POST" id="input-form" autocomplete="off" enctype="multipart/form-data">
                <table class="ahistorybook">
                    <caption>Edit Profile</caption>
                    <tr>
                        <td>
                            <div id="profile-picturee">
                                <img style="height: 100px; object-fit: scale-down;" src="<?php getvar('profilepicture'); ?>">
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
                            <div id="failure-notif" class="box-center red-font"></div>
                            </div>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="mt-20" onclick=changePage() type="button" id="back-button">Back</button>
                        </td>
                        <td>
                            <button onclick="validateEditProfile()" class="right-button blue-button mt-20" type="button" name="submit" id="save-button">Save</button>
                            <button type="submit" id="editProfileSubmit"></button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </body>
    <script src="statics/js/failure-notif.js"></script>
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
            window.location.href = "profile.php";
        }

        function isValidPhone(phone) {
                if (phone.length < 9 || phone.length > 12) {
                    return false;
                }
                let i = phone.length;
                while (i--) {
                    letter = phone[i];
                    if (!isNumber(letter)) {
                        return false;
                    }
                }
                return true;
            }

        function isValidName(name) {
            let i = name.length;
            if(i>20){
                return false;
            }
            while (i--) {
                letter = name[i];
                if (!isAlphabet(letter) && letter != ' ') {
                    return false;
                }
            }
            return true;
        }

        
        function isAlphabet(letter) {
                return (letter >= 'a' && letter <= 'z') || 
                    (letter >= 'A' && letter <= 'Z');
            }

        function isNumber (letter) {
            return (letter >= '0' && letter <= '9');
        }

        function validateEditProfile(){
            var nama = document.getElementById("user-name").value;
            var address = document.getElementById("user-address").value;
            var phone = document.getElementById("user-phone-number").value;

            if(nama.trim() === ""){
                showFailureNotif("Name is empty");
            }
            else if(!isValidName(nama)){
                showFailureNotif("Name is invalid");
            }
            else if(address.trim() === ""){
                showFailureNotif("Address is empty");
            }
            else if(phone.trim() === ""){
                showFailureNotif("Phone number is empty");
            }
            else if(!isValidPhone(phone)){
                showFailureNotif("Phone number is invalid");
            }
            else{
                document.getElementById('editProfileSubmit').click();
            }
        }
    </script>

</html>