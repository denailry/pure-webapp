let hideFailureNotif = function() {
    document.getElementById("failure-notif").style.display = "none";
}

let failureNotifTimer = null;
let showFailureNotif = function(message) {
    document.getElementById("failure-notif").innerHTML = message;
    document.getElementById("failure-notif").style.display = "block";
    clearTimeout(failureNotifTimer);
    failureNotifTimer = setTimeout(hideFailureNotif, 3000);
}