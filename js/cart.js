document.addEventListener(
    "DOMContentLoaded",
    function () {

        const quantityInputs =
            document.querySelectorAll(
                ".cart-quantity"
            );

        quantityInputs.forEach(
            function (input) {

                input.addEventListener(
                    "change",
                    function () {

                        if (
                            this.value < 1
                        ) {

                            this.value = 1;

                        }

                    }
                );

            }
        );

        const removeButtons =
            document.querySelectorAll(
                ".remove-cart-item"
            );

        removeButtons.forEach(
            function (button) {

                button.addEventListener(
                    "click",
                    function (event) {

                        const confirmation =
                            confirm(
                                "Remove this item from cart?"
                            );

                        if (
                            !confirmation
                        ) {

                            event.preventDefault();

                        }

                    }
                );

            }
        );

    }
);