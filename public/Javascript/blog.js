

/**
 * @param Articleform
 * @returns {string}
 */
function validateArticle(Articleform) {
    let title = Articleform["article-title"];
    let desc = Articleform["article"];
    let text = "";
    if(title.value) {
        text = "Title cannot be empty";
    }
    text += "\n";
    if(desc.value) {
        text += "Article cannot be empty";
    }
    return text;
}

/**
 * @returns {*}
 */
function validateLogin() {

    let x = document.forms["LoginForm"]["u_email"].value;
    let y = document.forms["LoginForm"]["pass"].value;

    if(!x || !y) return false;

    let pattern = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (!pattern.test(x) && x) {
        document.getElementById("email_error").innerText = "Enter valid User Email";
        return false;
    } else if (y) {
        document.getElementById("password_error").innerText =  "Enter valid password";
        return false;
    } else {
        return true;
    }
}

function validateFirstName() {
    let first_name = document.forms["SignupForm"]["first_name"];
    let first_name_error = document.getElementById("first_name_error");
    // let pattern = /^[A-Z]+(?:[\s]+[a-zA-Z]+)*$/;
    let pattern = /^[a-z ,.'-]+$/i;
    if (!pattern.test(first_name.value)) {
        first_name_error.innerHTML = "Enter your name correctly";
        document.getElementById("signupSubmit").disabled = true;
    } else {
        first_name_error.innerHTML = "*";
        document.getElementById("signupSubmit").disabled = false;
    }
}

function validateLastName() {
    let last_name = document.forms["SignupForm"]["last_name"];
    let last_name_error = document.getElementById("last_name_error");
    // let pattern = /^[A-Z]+(?:[\s]+[a-zA-Z]+)*$/;
    let pattern = /^[a-z ,.'-]+$/i;
    if (!pattern.test(last_name.value)) {
        last_name_error.innerHTML = "Enter your name correctly";
        document.getElementById("signupSubmit").disabled =true;
    } else {
        last_name_error.innerHTML = "";
        document.getElementById("signupSubmit").disabled = false;
    }
    if (last_name.value){
        document.getElementById("signupSubmit").disabled = false;        
    }
}

function validateEmail() {
    let email = document.forms["SignupForm"]["email"];
    let email_error = document.getElementById("email_error");
    let pattern = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (!pattern.test(email.value)) {
        email_error.innerHTML = 'Enter a valid e-mail';
        email_error.style.color = "red";
        document.getElementById("signupSubmit").disabled = true;
    } else {
        email_error.innerHTML = '*';
        document.getElementById("signupSubmit").disabled = false;
    }
}

function validatePassword() {
    let password = document.forms["SignupForm"][""];
    let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
    if (!pattern.test(value)) {
        document.getElementById('email_error').innerHTML =
            `Should have at least 1 lowercase character
            Should have atleast 1 uppercase character 
            Should have atleast 1 number
            Should have one special character
            Should be 8 characters long`;
    } else {
        document.getElementById('email_error').innerHTML = '*';
        document.getElementById("signupSubmit").disabled = false;
    }
}

function validateSignup() {
    let x = document.forms["SignupForm"]["pass"].value;
    let y = document.forms["SignupForm"]["rpass"].value;
    let flag = 1;

    let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
    if ((!pattern.test(x)) && (x === y)) {
        flag = 0;
        document.getElementById('rpass_error').innerHTML = 'Password not matching';
        document.getElementById("signupSubmit").disabled = true;
    } else {
        document.getElementById('rpass_error').innerHTML = '*';
        document.getElementById("signupSubmit").disabled = false;
    }

    return (0 === flag);
}

function promptDelete() {
    return (confirm("Sure to delete the Post!"));
}

function promptUpdate() {
    return (confirm("Sure to update the Post!"));
}
