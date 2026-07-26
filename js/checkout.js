document.addEventListener(
    "DOMContentLoaded",
    function () {

        const deliveryMethod =
            document.getElementById(
                "delivery_method"
            );

        const paymentMethod =
            document.getElementById(
                "payment_method"
            );

        if (
            deliveryMethod
        ) {

            deliveryMethod.addEventListener(
                "change",
                function () {

                    const selected =
                        this.value;

                    const deliveryMessage =
                        document.getElementById(
                            "delivery-message"
                        );

                    if (
                        deliveryMessage
                    ) {

                        if (
                            selected
                            === "Pickup"
                        ) {

                            deliveryMessage.innerText =
                                "You can collect your order from the vendor.";

                        } else {

                            deliveryMessage.innerText =
                                "Your order will be delivered by postage.";

                        }

                    }

                }
            );

        }

        if (
            paymentMethod
        ) {

            paymentMethod.addEventListener(
                "change",
                function () {

                    const paymentInfo =
                        document.getElementById(
                            "payment-info"
                        );

                    if (
                        paymentInfo
                    ) {

                        paymentInfo.innerText =
                            "Payment method selected: "
                            + this.value;

                    }

                }
            );

        }

    }
);