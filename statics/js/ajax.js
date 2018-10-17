function newAjax() {
    let ajax;
    try {
        // Opera 8.0+, Firefox, Safari 
        ajax = new XMLHttpRequest();
    } catch (e) {
        // Internet Explorer Browsers
        try {
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                ajax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                // Something went wrong
                alert("Oopss... Sorry, your browser does not support AJAX.");
                return false;
            }
        }
    }
    return ajax;
}

function request(method, url, data, success=null, error=defaultOnError) {
    if (method.toUpperCase() == 'GET') {
        return requestGet(url, data, success, error);
    } else if (method.toUpperCase() == 'POST') {
        return requestPost(url, data, success, error);
    } else {
        console.log("AJAX error! Not supported request method.");
    }
}

function requestGet(url, data=null, success=null, error=defaultOnError) {
    let ajax = newAjax();
    setOnReadyStateChange(ajax, success, error);
    ajax.open('GET', buildQuery(url, data), true);
    ajax.send();
    return ajax;
}

function requestPost(url, data=null, success=null, error=defaultOnError) {
    let ajax = newAjax();
    setOnReadyStateChange(ajax, success, error);
    ajax.open('POST', url, true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send(serialize(data, '%20'));
    return ajax;
}

function defaultOnError(status) {
    console.log("AJAX error with status " + status);
}

function setOnReadyStateChange(ajax, success, error) {
    ajax.onreadystatechange = function() {
        if (this.readyState == 4) {
            let response = null;
            try {
                response = JSON.parse(this.responseText);
            } catch (e) {
                response = this.responseText;
            }
            if (this.status == 200) {
                success(response);
            } else {
                error(this.status, response);
            }
        }
     }
}

function buildQuery(url, query) {
    let queryString = serialize(query);
    if (queryString != null) {
        url += '?' + queryString;
    }
    return url;
}

function serialize(data, spaceEncoder='+') {
    if (data == null) {
        return null;
    }
    let dataString = '';
    let i = 0;
    for (key in data) {
        if (i != 0) {
            dataString += '&';
            i++;
        }
        if (data[key] instanceof Array) {
            data[key].forEach((item, index) => {
                if (index != 0) {
                    dataString += '&';
                }
                dataString += key + '[]=' + item.replace(' ', spaceEncoder);
            });
        } else {
            dataString += key + '=' + data[key].toString().replace(' ', spaceEncoder);
        }
    }
    return dataString;
}