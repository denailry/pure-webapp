<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="statics/css/form.css?version=6">
    </head>
    <body>
        <div id="box-wrapper">
            <div id="box-container">
                <div>
                    <h1>LOGIN</h1>
                </div>
                <form method="POST" autocomplete="off">
                    <div class="input-group">
                        <div class="input-field">
                            <label for="username">Username</label>    
                        </div>
                        <div class="input-value">
                            <input id="username" type="text" name="username" autocomplete="off">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <label for="password">Password</label>
                        </div>
                        <div class="input-value">
                            <input id="password" type="password" name="password" autocomplete="off">
                        </div>
                    </div>
                    <div id="failure-notif" class="box-center">
                    </div>
                    <div id="box-link">
                        <a href="register">Don't have an account?</a>
                    </div>
                    <div class="box-center">
                        <button id="submit" name="submit">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="statics/js/failure-notif.js"></script>
    <script type="text/javascript">
        let failure = <?php getvar("failure", true); ?>;
        if (failure != null) {
            showFailureNotif(failure);
        }
    </script>
</html>