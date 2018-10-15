let hideFailureNotif = function() {
    document.getElementById("failure-notif").style.display = "none";
}

let showFailureNotif = function(message) {
    document.getElementById("failure-notif").innerHTML = message;
    document.getElementById("failure-notif").style.display = "block";
    setTimeout(hideFailureNotif, 3000);
    clearTimetout(hideFailureNotif);
}