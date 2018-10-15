<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="statics/css/login.css">
    </head>
    <body>
        <div id="box-wrapper">
            <div id="box-container">
                <div style="text-align: center;">
                    <h1>Login</h1>
                </div>
                <form method="POST">
                    <div class="input-group">
                        <div class="input-field">
                            <label for="username">Username</label>    
                        </div>
                        <div class="input-value">
                            <input id="username" type="text" name="username">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <label for="password">Password</label>
                        </div>
                        <div class="input-value">
                            <input id="password" type="password" name="password">
                        </div>
                    </div>
                    <div id="failure-notif" class="box-center">
                        <?php getvar("failure"); ?>
                    </div>
                    <div style="margin-top: 5px; margin-bottom: 10px;">
                        <a href="register.php">Dont't have an account?</a>
                    </div>
                    <div class="box-center">
                        <button name="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>