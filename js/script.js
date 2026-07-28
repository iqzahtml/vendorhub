function openLoginModal() {

    const modal =
        document.getElementById("loginModal");

    if (modal) {

        modal.style.display = "flex";

        document.body.style.overflow =
            "hidden";

    }

}

function closeLoginModal() {

    const modal =
        document.getElementById("loginModal");

    if (modal) {

        modal.style.display = "none";

        document.body.style.overflow =
            "auto";

    }

}

window.addEventListener(
    "click",
    function(event) {

        const modal =
            document.getElementById("loginModal");

        if (
            modal &&
            event.target === modal
        ) {

            closeLoginModal();

        }

    }
);

document.addEventListener(
    "keydown",
    function(event) {

        if (
            event.key === "Escape"
        ) {

            closeLoginModal();

        }

    }
);

function toggleMenu() {

    const navLinks =
        document.querySelector(
            ".nav-links"
        );

    if (navLinks) {

        navLinks.classList.toggle(
            "show"
        );

    }
    

}
window.onload = function(){
    document.getElementById("loginModel").style.display="block";

}

