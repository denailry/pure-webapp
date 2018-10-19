<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body>
        <div id="main">
            <h1>My Profile</h1>
            <div id="username-bar">
                <div>
                    <p>Username  <?php getvar('username'); ?></p>
                </div>
            </div>
            <div id="email-bar">
                <div>
                    <p>Email  <?php getvar('email'); ?></p>
                </div>
            </div>
            <div id="address-bar">
                <div>
                    <p>Address  <?php getvar('address'); ?></p>
                </div>
            </div>
            <div id="phone-bar">
                <div>
                    <p>Phone  <?php getvar('phone'); ?></p>
                </div>
            </div>
        </div>
    </body>
</html>