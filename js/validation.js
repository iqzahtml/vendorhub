/* =========================================================
   HOCHIPOHUB
   validation.js

   Form Validation Controller
========================================================= */


document.addEventListener(
    "DOMContentLoaded",
    function(){



/* =========================================================
   EMAIL VALIDATION
========================================================= */

function validateEmail(email){

    const pattern =
    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


    return pattern.test(email);

}



/* =========================================================
   MALAYSIA PHONE VALIDATION
========================================================= */

function validatePhone(phone){

    const pattern =
    /^(01)[0-9]{8,9}$/;


    return pattern.test(
        phone.replace(/\s+/g,"")
    );

}



/* =========================================================
   PASSWORD VALIDATION
========================================================= */

function validatePassword(password){

    const rules = {

        length:
        password.length >= 8,


        uppercase:
        /[A-Z]/.test(password),


        lowercase:
        /[a-z]/.test(password),


        number:
        /[0-9]/.test(password),


        special:
        /[@$!%*?&#]/.test(password)

    };


    return rules;

}



/* =========================================================
   PASSWORD STRENGTH
========================================================= */


function passwordStrength(password){


    let score = 0;


    if(password.length >= 8)
        score++;


    if(/[A-Z]/.test(password))
        score++;


    if(/[a-z]/.test(password))
        score++;


    if(/[0-9]/.test(password))
        score++;


    if(/[@$!%*?&#]/.test(password))
        score++;



    return score;

}





/* =========================================================
   PASSWORD STRENGTH UI
========================================================= */


const passwordInputs =
document.querySelectorAll(
    'input[name="password"]'
);



passwordInputs.forEach(
function(passwordInput){


    passwordInput.addEventListener(
        "input",
        function(){


            const strengthBox =
            passwordInput
            .closest("form")
            ?.querySelector(
                ".password-strength"
            );


            if(!strengthBox)
                return;



            const bar =
            strengthBox.querySelector(
                ".password-strength-progress"
            );


            const text =
            strengthBox.querySelector(
                ".password-strength-text"
            );


            let score =
            passwordStrength(
                passwordInput.value
            );



            let width =
            score * 20;



            bar.style.width =
            width + "%";



            bar.className =
            "password-strength-progress";



            if(score <=2){

                bar.classList.add(
                    "password-weak"
                );


                text.innerHTML =
                "Weak password";

            }



            else if(score <=4){

                bar.classList.add(
                    "password-medium"
                );


                text.innerHTML =
                "Medium password";

            }



            else{


                bar.classList.add(
                    "password-strong"
                );


                text.innerHTML =
                "Strong password";

            }


        }
    );


});





/* =========================================================
   SHOW ERROR
========================================================= */


function showError(
    input,
    message
){


    removeError(input);



    input.classList.add(
        "input-error"
    );



    const error =
    document.createElement(
        "small"
    );


    error.className =
    "form-error";


    error.innerHTML =
    message;



    input.parentElement
    .appendChild(error);


}





/* =========================================================
   REMOVE ERROR
========================================================= */


function removeError(input){


    input.classList.remove(
        "input-error"
    );



    const old =
    input.parentElement
    .querySelector(
        ".form-error"
    );


    if(old){

        old.remove();

    }


}






/* =========================================================
   REGISTER FORM VALIDATION
========================================================= */


const registerForms =
document.querySelectorAll(
    "#registerForm"
);



registerForms.forEach(
function(form){



form.addEventListener(
"submit",
function(event){



const name =
form.querySelector(
    'input[name="name"]'
);


const email =
form.querySelector(
    'input[name="email"]'
);



const phone =
form.querySelector(
    'input[name="phone"]'
);



const password =
form.querySelector(
    'input[name="password"]'
);



const confirm =
form.querySelector(
    'input[name="confirm_password"]'
);



let valid=true;



if(name && name.value.trim()===""){


    showError(
        name,
        "Name is required"
    );


    valid=false;

}




if(email && !validateEmail(email.value)){


    showError(
        email,
        "Enter a valid email"
    );


    valid=false;

}




if(phone && !validatePhone(phone.value)){


    showError(
        phone,
        "Enter valid Malaysian phone number"
    );


    valid=false;

}




if(password){


const rules =
validatePassword(
    password.value
);



if(
!rules.length ||
!rules.uppercase ||
!rules.number
){


showError(
password,
"Password must contain 8 characters, uppercase and number"
);


valid=false;


}


}




if(
confirm &&
password &&
confirm.value !== password.value
){


showError(
confirm,
"Password does not match"
);


valid=false;


}




if(!valid){

event.preventDefault();

}



});

});






/* =========================================================
   LOGIN FORM VALIDATION
========================================================= */


const loginForms =
document.querySelectorAll(
    "#loginForm"
);



loginForms.forEach(
function(form){



form.addEventListener(
"submit",
function(event){



const email =
form.querySelector(
'input[name="email"]'
);



const password =
form.querySelector(
'input[name="password"]'
);



let valid=true;



if(
email &&
!validateEmail(
email.value
)
){


showError(
email,
"Invalid email"
);


valid=false;


}



if(
password &&
password.value.length < 8
){


showError(
password,
"Password minimum 8 characters"
);


valid=false;


}




if(!valid){

event.preventDefault();

}



});

});






/* =========================================================
   CLEAR ERROR WHILE TYPING
========================================================= */


document.querySelectorAll(
"input"
)
.forEach(
function(input){


input.addEventListener(
"input",
function(){


removeError(
input
);


});


});








/* =========================================================
   OTP INPUT AUTO MOVE
========================================================= */


const otpInputs =
document.querySelectorAll(
".otp-input"
);



otpInputs.forEach(
function(input,index){



input.addEventListener(
"input",
function(){


if(
this.value.length===1 &&
otpInputs[index+1]
){


otpInputs[index+1]
.focus();


}


});




input.addEventListener(
"keydown",
function(e){



if(
e.key==="Backspace" &&
this.value==="" &&
otpInputs[index-1]
){


otpInputs[index-1]
.focus();


}



});


});







/* =========================================================
   ONLY NUMBER OTP
========================================================= */


otpInputs.forEach(
function(input){


input.addEventListener(
"keypress",
function(e){


if(
!/[0-9]/.test(e.key)
){

e.preventDefault();

}


});


});







/* =========================================================
   SUBMIT LOADING EFFECT
========================================================= */


document.querySelectorAll(
"form"
)
.forEach(
function(form){



form.addEventListener(
"submit",
function(){


const button =
form.querySelector(
"button[type='submit']"
);



if(button){


button.classList.add(
"loading"
);



button.disabled=true;



}



});


});





/* =========================================================
   REMOVE LOADING IF ERROR
========================================================= */


window.removeButtonLoading =
function(){


document.querySelectorAll(
".loading"
)
.forEach(
function(btn){


btn.classList.remove(
"loading"
);


btn.disabled=false;


});


};






console.log(
"HochipoHub validation.js loaded"
);



});