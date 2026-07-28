/* =========================================================
   HOCHIPOHUB
   modal.js
   Login & Register Modal Controller
========================================================= */

document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       GET MODAL ELEMENTS
    ===================================================== */

    const loginModal = document.getElementById("loginModal");
    const registerModal = document.getElementById("registerModal");


    /* =====================================================
       OPEN LOGIN MODAL
    ===================================================== */

    window.openLogin = function () {

        if (!loginModal) {
            console.error("Login modal was not found.");
            return;
        }

        // Close register modal first
        if (registerModal) {
            registerModal.classList.remove("show");
        }

        loginModal.classList.add("show");

        document.body.classList.add("modal-open");

        // Prevent background scrolling
        document.body.style.overflow = "hidden";

        // Focus email field
        setTimeout(function () {

            const emailInput =
                loginModal.querySelector('input[name="email"]');

            if (emailInput) {
                emailInput.focus();
            }

        }, 200);

    };


    /* =====================================================
       CLOSE LOGIN MODAL
    ===================================================== */

    window.closeLogin = function () {

        if (!loginModal) {
            return;
        }

        loginModal.classList.remove("show");

        document.body.classList.remove("modal-open");

        document.body.style.overflow = "";

    };


    /* =====================================================
       OPEN REGISTER MODAL
    ===================================================== */

    window.openRegister = function () {

        if (!registerModal) {
            console.error("Register modal was not found.");
            return;
        }

        // Close login modal first
        if (loginModal) {
            loginModal.classList.remove("show");
        }

        registerModal.classList.add("show");

        document.body.classList.add("modal-open");

        // Prevent background scrolling
        document.body.style.overflow = "hidden";

        // Focus name field
        setTimeout(function () {

            const nameInput =
                registerModal.querySelector('input[name="name"]');

            if (nameInput) {
                nameInput.focus();
            }

        }, 200);

    };


    /* =====================================================
       CLOSE REGISTER MODAL
    ===================================================== */

    window.closeRegister = function () {

        if (!registerModal) {
            return;
        }

        registerModal.classList.remove("show");

        document.body.classList.remove("modal-open");

        document.body.style.overflow = "";

    };


    /* =====================================================
       SWITCH LOGIN → REGISTER
    ===================================================== */

    window.switchToRegister = function () {

        if (loginModal) {
            loginModal.classList.remove("show");
        }

        if (registerModal) {
            registerModal.classList.add("show");

            document.body.classList.add("modal-open");

            document.body.style.overflow = "hidden";

            setTimeout(function () {

                const nameInput =
                    registerModal.querySelector('input[name="name"]');

                if (nameInput) {
                    nameInput.focus();
                }

            }, 200);
        }

    };


    /* =====================================================
       SWITCH REGISTER → LOGIN
    ===================================================== */

    window.switchToLogin = function () {

        if (registerModal) {
            registerModal.classList.remove("show");
        }

        if (loginModal) {
            loginModal.classList.add("show");

            document.body.classList.add("modal-open");

            document.body.style.overflow = "hidden";

            setTimeout(function () {

                const emailInput =
                    loginModal.querySelector('input[name="email"]');

                if (emailInput) {
                    emailInput.focus();
                }

            }, 200);
        }

    };


    /* =====================================================
       CLOSE WHEN CLICKING OUTSIDE MODAL
    ===================================================== */

    window.addEventListener("click", function (event) {

        if (event.target === loginModal) {

            closeLogin();

        }

        if (event.target === registerModal) {

            closeRegister();

        }

    });


    /* =====================================================
       ESC KEY CLOSES MODAL
    ===================================================== */

    document.addEventListener("keydown", function (event) {

        if (event.key === "Escape") {

            if (
                loginModal &&
                loginModal.classList.contains("show")
            ) {

                closeLogin();

            }

            if (
                registerModal &&
                registerModal.classList.contains("show")
            ) {

                closeRegister();

            }

        }

    });


    /* =====================================================
       PASSWORD SHOW / HIDE
    ===================================================== */

    function createPasswordToggle(input) {

        if (!input) {
            return;
        }

        // Don't create duplicate toggle
        if (
            input.parentElement &&
            input.parentElement.classList.contains("password-wrapper")
        ) {
            return;
        }

        const wrapper = document.createElement("div");

        wrapper.classList.add("password-wrapper");

        input.parentNode.insertBefore(wrapper, input);

        wrapper.appendChild(input);

        const button = document.createElement("button");

        button.type = "button";

        button.className = "password-toggle";

        button.setAttribute(
            "aria-label",
            "Show password"
        );

        button.innerHTML =
            '<i class="fa-solid fa-eye"></i>';

        wrapper.appendChild(button);


        button.addEventListener("click", function () {

            if (input.type === "password") {

                input.type = "text";

                button.innerHTML =
                    '<i class="fa-solid fa-eye-slash"></i>';

                button.setAttribute(
                    "aria-label",
                    "Hide password"
                );

            } else {

                input.type = "password";

                button.innerHTML =
                    '<i class="fa-solid fa-eye"></i>';

                button.setAttribute(
                    "aria-label",
                    "Show password"
                );

            }

        });

    }


    /* =====================================================
       INITIALIZE PASSWORD TOGGLE
    ===================================================== */

    if (loginModal) {

        const loginPassword =
            loginModal.querySelector(
                'input[name="password"]'
            );

        createPasswordToggle(loginPassword);

    }


    if (registerModal) {

        const registerPassword =
            registerModal.querySelector(
                'input[name="password"]'
            );

        const confirmPassword =
            registerModal.querySelector(
                'input[name="confirm_password"]'
            );

        createPasswordToggle(registerPassword);

        createPasswordToggle(confirmPassword);

    }


    /* =====================================================
       CONFIRM PASSWORD CHECK
       ===================================================== */

    if (registerModal) {

        const registerForm =
            registerModal.querySelector("form");

        if (registerForm) {

            registerForm.addEventListener(
                "submit",
                function (event) {

                    const password =
                        registerForm.querySelector(
                            'input[name="password"]'
                        );

                    const confirmPassword =
                        registerForm.querySelector(
                            'input[name="confirm_password"]'
                        );


                    if (
                        password &&
                        confirmPassword &&
                        password.value !== confirmPassword.value
                    ) {

                        event.preventDefault();

                        alert(
                            "Password and confirm password do not match."
                        );

                        confirmPassword.focus();

                    }

                }
            );

        }

    }


    /* =====================================================
       AUTO CLOSE AFTER SUCCESS MESSAGE
    ===================================================== */

    const successMessage =
        document.querySelector(".form-success");

    if (successMessage) {

        setTimeout(function () {

            if (
                loginModal &&
                loginModal.classList.contains("show")
            ) {

                closeLogin();

            }

            if (
                registerModal &&
                registerModal.classList.contains("show")
            ) {

                closeRegister();

            }

        }, 3000);

    }


    /* =====================================================
       RESET FORM WHEN MODAL CLOSES
    ===================================================== */

    function resetModalForm(modal) {

        if (!modal) {
            return;
        }

        const form = modal.querySelector("form");

        if (form) {

            form.reset();

        }

    }


    /* =====================================================
       OPTIONAL RESET ON CLOSE
    ===================================================== */

    const originalCloseLogin = window.closeLogin;

    window.closeLogin = function () {

        originalCloseLogin();

        /*
         * Don't reset the form immediately.
         * This allows validation/error messages
         * to remain visible if needed.
         */
    };


    const originalCloseRegister = window.closeRegister;

    window.closeRegister = function () {

        originalCloseRegister();

        /*
         * Don't reset the form immediately.
         * This allows validation/error messages
         * to remain visible if needed.
         */
    };


    /* =====================================================
       LOG INITIALIZATION
    ===================================================== */

    console.log("HochipoHub modal.js loaded successfully.");

});