<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="statics/css/form.css?version=6">
    </head>
    <body>
        <div id="box-wrapper">
            <div id="box-container">
                <div>
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
                            <input id="phone" type="text" name="phone" required>
                        </div>
                    </div>
                    <div id="failure-notif" class="box-center">
                    </div>
                    <div id="box-link">
                        <a href="login">Already have an account?</a>
                    </div>
                    <button id="submitter" class="hidden" type="submit" name="submit"></button>
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
                if (isInputFormValid()) {
                    document.getElementById("submitter").click();
                }
            }
        }

        function isInputFormValid() {
            let inputList = [
                'name',
                'username',
                'email',
                'password-1',
                'password-2',
                'address',
                'phone'
            ];
            let i = 0;
            while (i < inputList.length) {
                elementId = inputList[i];
                if (document.getElementById(elementId).value.trim().length == 0) {
                    return showInvalidInput(elementId, 'value of ' + elementId + ' cannot be empty');;
                }
                i++;
            }
            if (!isValidEmail(document.getElementById('email').value)) {
                return showInvalidInput('email', 'value of email is invalid');
            }
            if (!isValidUsername(document.getElementById('username').value)) {
                return showInvalidInput('username', 'value of username is invalid');
            }
            if (!isValidPhone(document.getElementById('phone').value)) {
                return showInvalidInput('phone', 'value of phone is invalid');
            }
            if (!isValidName(document.getElementById('name').value)) {
                return showInvalidInput('name', 'value of name is invalid');
            }
            return true;
        }


        function showInvalidInput(elementId, message) {
            showFailureNotif(message);
            return false;
        }

        function isValidEmail(email) {
            let temp = email.split('@');
            if (temp.length < 2) {
                return false;
            }
            let mailname = temp[0];
            let domain = temp[1].split('.');
            if (domain.length < 2) {
                return false;
            }
            let i = mailname.length;
            while (i--) {
                letter = mailname[i];
                if (!isAlphabet(letter) && !isNumber(letter) && letter != '.') {
                    return false;
                }
            }
            let j = domain.length;
            while (j--) {
                word = domain[j];
                if (word.length == 0) {
                    return false;
                }
                i = word.length;
                while (i--) {
                    letter = word[i];
                    if (!isAlphabet(letter) && !isNumber(letter)) {
                        return false;
                    }
                }
            }
            return true;
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
            while (i--) {
                letter = name[i];
                if (!isAlphabet(letter) && letter != ' ') {
                    return false;
                }
            }
            return true;
        }

        function isValidUsername(username) {
            let i = username.length;
            while (i--) {
                letter = username[i];
                if (!isAlphabet(letter) && !isNumber(letter)) {
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
            if (elementId == 'email') {
                if (!isValidEmail(document.getElementById('email').value)) {
                    changeValidationImage(elementId, VALIDATION_FALSE);
                    inputStatus[elementId] = false;
                    return;
                }
            } else if (elementId == 'username') {
                if (!isValidUsername(document.getElementById('username').value)) {
                    changeValidationImage(elementId, VALIDATION_FALSE);
                    inputStatus[elementId] = false;
                    return;
                }
            }
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
                'register',
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