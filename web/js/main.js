/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//-----------------------------------------------UTILS
function getEle(id) {
    return document.getElementById(id);
}

//-----------------------------------------------VALIDATION

function validateRegistration(){
    var errors = 0;
    
    if(!checkEmpty('username')){
        errors++;
    }
    if(!checkEmpty('password')){
        errors++;
    }
    if(!checkEmpty('passwordRepeat')){
        errors++;
    }
    if(!checkEmpty('labelName')){
        errors++;
    }
    if(!dropdownIsValid('genre')){
        errors++;
    }
    if(!dropdownIsValid('country')){
        errors++;
    }
    if(errors !== 0){
        return false;
    }
    return true;
}

function dropdownIsValid(id) {
    var selectedIndex = getEle(id).selectedIndex;
    var errorId = getEle(id + 'Error');
    if (selectedIndex !== 0) {
        errorId.innerHTML = '';
        return true;
    }
    errorId.innerHTML = '<p class="error"> * This field is required</p>';
    return false;
}

function checkEmpty(id) {
    var input = getEle(id).value;
    console.log(input);
    var errorId = getEle(id + 'Error');
    input = input.replace(/ /g, "");
    console.log(input);
    if (input.length !== 0) {
        errorId.innerHTML = '';
        return true;
    }
    errorId.innerHTML = '<p class="error"> * This field is required</p>';
    return false;
}

function checkDate(id, input) {
    var regex = /^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
    var errorId = 'error' + id;
    
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


//        Check that input date is past current date    

        if (year < currentYear) {
            if (id !== 'dateFrom') {
                getEle(errorId).innerHTML = '<p class="errorMessage">* This date is in the past. Please enter a current date</p>';
            } else {
                getEle(errorId).innerHTML = '<p class="errorMessage">* This date is either before or the same as drop off. Please enter a current date</p>';
            }
            getEle(id).value = input;
            return false;
        } else if (month < currentMonth && year === currentYear) {
            if (id !== 'dateFrom') {
                getEle(errorId).innerHTML = '<p class="errorMessage">* This date is in the past. Please enter a current date</p>';
            } else {
                getEle(errorId).innerHTML = '<p class="errorMessage">* This date is either before or the same as drop off. Please enter a current date</p>';
            }
            getEle(id).value = input;
            return false;
        } else if (day <= currentDay && month === currentMonth && year === currentYear) {
            if (id !== 'dateFrom') {
                getEle(errorId).innerHTML = '<p class="errorMessage">* This date is in the past. Please enter a current date</p>';
            } else {
                getEle(errorId).innerHTML = '<p class="errorMessage">* This date is either before or the same as drop off. Please enter a current date</p>';
            }
            getEle(id).value = input;
            return false;
        } else
//        Check that day input is valid depending on month and that month is valid
        if (dayMonth31.indexOf(month) !== -1 && day < 32) {
            getEle(id).value = input;
            return true;
        } else if (dayMonth30.indexOf(month) !== -1 && day < 31) {
            getEle(id).value = input;
            return true;
        } else if (month === 2 && day < 29) {
            getEle(id).value = input;
            return true;
        } else {
            getEle(errorId).innerHTML = '<p class="errorMessage">* The date you have enetered is outside the allowable range. Please try again.</p>';
            getEle(id).value = input;
            return false;
        }

    }
    getEle(errorId).innerHTML = '<p class="errorMessage">* This date is not in the correct format. Please make sure the date entered reads dd/mm/yyy</p>';
    getEle(id).value = input;
    return false;
}

