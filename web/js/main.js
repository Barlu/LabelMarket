/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//-----------------------------------------------UTILS
var isDelete = false;

function getEle(id) {
    return document.getElementById(id);
}

function setDelete() {
    isDelete = true;
}

function updateQueryString(key, value, url) {
    if (!url)
        url = window.location.href;
    var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
            hash;

    if (re.test(url)) {
        if (typeof value !== 'undefined' && value !== null)
            window.location.assign(url.replace(re, '$1' + key + "=" + value + '$2$3'));
        else {
            hash = url.split('#');
            url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
            if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                url += '#' + hash[1];
            window.location.assign(url);
        }
    }
    else {
        if (typeof value !== 'undefined' && value !== null) {
            var separator = url.indexOf('?') !== -1 ? '&' : '?';
            hash = url.split('#');
            url = hash[0] + separator + key + '=' + value;
            if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                url += '#' + hash[1];
            window.location.assign(url);
        }
        else
            window.location.assign(url);
    }
}

//-----------------------------------------------VALIDATION
function validateMix() {
    var errors = 0;
    if (!checkEmpty('link')) {
        errors++;
    }
    if (!checkEmpty('name')) {
        errors++;
    }
    if (errors !== 0) {
        return false;
    }
    return true;
}

function validateAlbum() {
    var errors = 0;
    if (!checkEmpty('name')) {
        errors++;
    }
    if (!dropdownIsValid('genre')) {
        errors++;
    }
    if (errors !== 0) {
        return false;
    }
    return true;
}

function validateSong(id) {
    if (isDelete === false) {
        var errors = 0;
        if (id === undefined) {
            id = '';
        }
        if (!checkEmpty('link' + id)) {
            errors++;
        }
        if (!checkEmpty('name' + id)) {
            errors++;
        }
        if (!checkEmpty('artist' + id)) {
            errors++;
        }
        if (!dropdownIsValid('genre' + id)) {
            errors++;
        }
        if (!checkDate('releaseDate' + id, getEle('releaseDate' + id).value)) {
            errors++;
        }
        if (errors !== 0) {
            return false;
        }
    }
    isDelete = false;
    return true;

}

function validateRegistration() {
    var errors = 0;

    if (!checkEmpty('username')) {
        errors++;
    }
    if (!checkEmpty('password')) {
        errors++;
    }
    if (!checkEmpty('passwordRepeat')) {
        errors++;
    }
    if (!checkEmpty('labelName')) {
        errors++;
    }
    if (!dropdownIsValid('genre')) {
        errors++;
    }
    if (!dropdownIsValid('country')) {
        errors++;
    }
    if (errors !== 0) {
        return false;
    }
    return true;
}

function checkEmail(id) {
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email = getEle(id).value;
    var errorId = getEle(id + 'Error');
    if (regex.test(email)) {
        errorId.innerHTML = '';
        return true;
    }
    errorId.innerHTML = '<p class="error"> * Please enter a valid email</p>';
    return false;
}

function dropdownIsValid(id) {
    var selectedIndex = getEle(id).selectedIndex;
    var errorId = getEle(id + 'Error');
    if (selectedIndex !== 0) {
        errorId.innerHTML = '';
        return true;
    }
    if (id === 'genre') {
        errorId.innerHTML = '<p class="error"> * Please select a genre</p>';
        return false;
    }
    if (id === 'country') {
        errorId.innerHTML = '<p class="error"> * Please select a country</p>';
        return false;
    }
    errorId.innerHTML = '<p class="error"> * This field is required</p>';
    return false;
}

function checkEmpty(id) {
    var input = getEle(id).value;

    var errorId = getEle(id + 'Error');
    input = input.replace(/ /g, "");

    if (input.length !== 0) {
        errorId.innerHTML = '';
        return true;
    }
    if (id === 'username') {
        errorId.innerHTML = '<p class="error"> * Please enter a Username</p>';
        return false;
    }
    if (id === 'password') {
        errorId.innerHTML = '<p class="error"> * Please enter a password</p>';
        return false;
    }
    if (id === 'passwordRepeat') {
        errorId.innerHTML = '<p class="error"> * Please confirm your password</p>';
        return false;
    }
    if (id === 'labelName') {
        errorId.innerHTML = '<p class="error"> * Please enter a Label name</p>';
        return false;
    }

    if (id.indexOf('name') !== -1) {
        errorId.innerHTML = '<p class="error"> * Please enter a name</p>';
        return false;
    }

    if (id.indexOf('link') !== -1) {
        errorId.innerHTML = '<p class="error"> * Please enter an embed link</p>';
        return false;
    }

    if (id.indexOf('artist') !== -1) {
        errorId.innerHTML = '<p class="error"> * Please enter an artist</p>';
        return false;
    }
    errorId.innerHTML = '<p class="error"> * This field is required</p>';
    return false;
}

function checkDate(id, input) {

    if (input.trim().length !== 0) {
        var regex = /^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
        var errorId = id + 'Error';

        if (regex.test(input) === true) {
            var trimmedInput = input.replace(/\//g, "");

            var day = trimmedInput[0] + trimmedInput[1];
            day = parseInt(day);

            var month = trimmedInput[2] + trimmedInput[3];
            month = parseInt(month);

            var year = trimmedInput[6] + trimmedInput[7];
            year = parseInt(year);

            var dayMonth31 = [01, 03, 05, 07, 08, 10, 12];
            var dayMonth30 = [04, 06, 09, 11];

            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();
            var currentMonth = currentDate.getMonth();
            var currentDay = currentDate.getDate();

            currentMonth = currentMonth + 1;
            currentMonth = parseInt(currentMonth);

//        Change current year to 2 digit
            currentYear = currentYear.toString();
            currentYear = currentYear.slice(-2);
            currentYear = parseInt(currentYear);

            currentDay = ('0' + currentDay).slice(-2);
            currentDay = parseInt(currentDay);




            if (year < currentYear) {
                getEle(errorId).innerHTML = '<p class="errorM">* This date is in the past. Please enter a current date</p>';

                getEle(id).value = input;
                return false;
            } else if (month < currentMonth && year === currentYear) {

                getEle(errorId).innerHTML = '<p class="error">* This date is in the past. Please enter a current date</p>';

                getEle(id).value = input;
                return false;
            } else if (day <= currentDay && month === currentMonth && year === currentYear) {
                getEle(errorId).innerHTML = '<p class="error">* This date is in the past. Please enter a current date</p>';
                getEle(id).value = input;
                return false;
            } else
//        Check that day input is valid depending on month and that month is valid
            if (dayMonth31.indexOf(month) !== -1 && day < 32) {
                getEle(errorId).innerHTML = '';
                getEle(id).value = input;
                return true;
            } else if (dayMonth30.indexOf(month) !== -1 && day < 31) {
                getEle(errorId).innerHTML = '';
                getEle(id).value = input;
                return true;
            } else if (month === 2 && day < 29) {
                getEle(errorId).innerHTML = '';
                getEle(id).value = input;
                return true;
            } else {
                getEle(errorId).innerHTML = '<p class="error">* The date you have enetered is outside the allowable range. Please try again.</p>';
                getEle(id).value = input;
                return false;
            }

        }
        getEle(errorId).innerHTML = '<p class="error">* This date is not in the correct format. Please make sure the date entered reads dd/mm/yyy</p>';
        getEle(id).value = input;
        return false;
    }
    return true;
}

