<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="statics/css/form.css?version=1">
    </head>
    <body>
        <div id="box-wrapper">
            <div id="box-container">
                <div style="text-align: center;">
                    <h1>REGISTER</h1>
                </div>
                <form id="input-form" method="POST">
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
                            <input id="username" name="username" required
                                onfocusout="focusHandler('username', false)"
                                onfocus="focusHandler('username', true)"
                                onkeyup="triggerValidation('username')">
                            <div class="validation">
                                <img id="username-validation" class="validation-hide" src="statics/img/question.png" >
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-field">
                            <label for="email">Email</label>    
                        </div>
                        <div class="input-value">
                            <input id="email" type="text" name="email" required
                                onfocusout="focusHandler('email', false)"
                                onfocus="focusHandler('email', true)"
                                onkeyup="triggerValidation('email')">
                            <div class="validation">
                                <img id="email-validation" class="validation-hide" src="statics/img/question.png" >
                            </div>
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
                            <textarea id="address" name="address" rows="4" required></textarea>
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
                        <button id="submit" type="button" name="submit" onclick="failureCheck()">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="statics/js/failure-notif.js"></script>
    <script type="text/javascript">
        document.addEventListener('keypress', (event) => {
            if (event.keyCode == 13) {
                failureCheck();
            }
        });

        var inputStatus = {
            username: true,
            email: true
        }

        let failure = <?php getvar("failure", true); ?>;
        if (failure != null) {
            showFailureNotif(failure);
        }

        function failureCheck() {
            if (!inputStatus.username) {
                showFailureNotif("username is exist");
            } else if (!inputStatus.email) {
                showFailureNotif("email is exist");
            } else {
                if (document.getElementById("input-form").reportValidity()) {
                    document.getElementById("input-form").submit();
                }
            }
        }
    </script>
    <script src="statics/js/ajax.js"></script>
    <script type="text/javascript">
        function focusHandler(elementId, isFocus)  {
            let value = document.getElementById(elementId).value;
            if (value.length == 0) {
                if (isFocus) {
                    document.getElementById(elementId + '-validation').className = "validation-show";
                } else {
                    document.getElementById(elementId + '-validation').className = "validation-hide";
                }
            }
        }

        let timer = {
            username: null,
            email: null
        }
        function triggerValidation(elementId) {
            clearTimeout(timer[elementId]);
            timer[elementId] = setTimeout(() => validateValue(elementId), 300);
        }

        let ajax = {
            username: null,
            email: null
        }
        function validateValue(elementId) {
            let value = document.getElementById(elementId).value;
            if (value.length == 0) {
                changeValidationImage(elementId, VALIDATION_NULL);
                return;
            }
            let data = {}; 
            data[elementId] = value;
            if (ajax[elementId]) {
                ajax[elementId].abort();
                ajax[elementId] = null;
            }
            ajax[elementId] = requestPost(
                'register.php',
                data,
                function(result) {
                    if (result.status == 0) {
                        if (result.data.valid) {
                            changeValidationImage(elementId, VALIDATION_TRUE);
                            inputStatus[elementId] = true;
                        } else {
                            changeValidationImage(elementId, VALIDATION_FALSE);
                            inputStatus[elementId] = false;
                        }
                    }
                }
            );
        }

        const VALIDATION_NULL = "statics/img/question.png";
        const VALIDATION_TRUE = "statics/img/valid.png";
        const VALIDATION_FALSE = "statics/img/invalid.png";
        function changeValidationImage(elementId, validationStatus) {
            document.getElementById(elementId+'-validation').src = validationStatus;
        }
    </script>
</html>