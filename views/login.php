<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form method="POST">
            <div>
                <?php getvar("failure"); ?>
            </div>
            <div>
                <label for="username">Username:</label>
                <input id="username" type="text" name="username">
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password">
            </div>
            <button name="submit">Submit</button>
        </form>
    </body>
</html>