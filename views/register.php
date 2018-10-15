<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="statics/css/form.css">
    </head>
    <body>
        <div id="box-wrapper">
            <div id="box-container">
                <div style="text-align: center;">
                    <h1>Register</h1>
                </div>
                <form method="POST">
                    <div class="input-group">
                        <div class="input-field">
                            <label for="name">Name</label>    
                        </div>
                        <div class="input-value">
                            <input id="name" type="text" name="name" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <label for="username">Username</label>    
                        </div>
                        <div class="input-value">
                            <input id="username" type="text" name="username" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <label for="email">Email</label>    
                        </div>
                        <div class="input-value">
                            <input id="email" type="text" name="email" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <label for="password-1">Password</label>
                        </div>
                        <div class="input-value">
                            <input id="password-1" type="password" name="password-1" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <label for="password-2">Confirm Password</label>
                        </div>
                        <div class="input-value">
                            <input id="password-2" type="password" name="password-2" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <label for="address">Address</label>
                        </div>
                        <div class="input-value">
                            <textarea id="address" name="address" required></textarea>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <label for="phone">Phone</label>
                        </div>
                        <div class="input-value">
                            <input id="phone" type="tel" name="phone" required>
                        </div>
                    </div>
                    <div id="failure-notif" class="box-center">
                    </div>
                    <div id="box-link">
                        <a href="login.php">Already have an account?</a>
                    </div>
                    <div class="box-center">
                        <button name="submit">Register</button>
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