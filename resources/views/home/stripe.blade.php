<!DOCTYPE html>
<html>

<head>
    <title>Thanh Toán Stripe</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .stripe_section {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.08);
            max-width: 400px;
            margin: 40px auto;
            padding: 40px 30px;
        }

        #payment-form button#submit {
            background: #635bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 0;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            transition: background 0.2s;
        }

        #payment-form button#submit:hover {
            background: #554eea;
        }

        #error-message {
            color: #e74c3c;
            margin-top: 10px;
            min-height: 24px;
            text-align: center;
        }

        #toast {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #4BB543;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #toast.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {
                top: 0;
                opacity: 0;
            }

            to {
                top: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                top: 0;
                opacity: 0;
            }

            to {
                top: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                top: 30px;
                opacity: 1;
            }

            to {
                top: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                top: 30px;
                opacity: 1;
            }

            to {
                top: 0;
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="stripe_section" style="padding: 100px 50px;">
        <h2>Thanh Toán {{ $value }}</h2>
        <form id="payment-form">
            <div id="payment-element"></div>
            <button id="submit">Pay</button>
            <div id="error-message"></div>
        </form>
    </div>
    <div id="toast">Thanh toán thành công!</div>
    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('payment') === 'success') {
                var x = document.getElementById("toast");
                if (x) {
                    x.className = "show";
                    x.style.visibility = "visible";
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                        x.style.visibility = "hidden";
                    }, 3000);
                }
            }
        }
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");

        fetch("/stripe", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    value: {{ $value }}
                })
            })
            .then(res => res.json())
            .then(async ({
                clientSecret
            }) => {
                const elements = stripe.elements({
                    clientSecret
                });
                const paymentElement = elements.create("payment");
                paymentElement.mount("#payment-element");

                const form = document.getElementById("payment-form");
                form.addEventListener("submit", async (e) => {
                    e.preventDefault();
                    const {
                        error
                    } = await stripe.confirmPayment({
                        elements,
                        confirmParams: {
                            return_url: "{{ url('/') }}?payment=success",
                        },
                    });
                    if (error) {
                        document.getElementById("error-message").textContent = error.message;
                    }
                });
            });

        // Hiển thị toast nếu thanh toán thành công (Stripe redirect về với ?redirect_status=succeeded)
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('redirect_status') === 'succeeded') {
                var x = document.getElementById("toast");
                x.className = "show";
                setTimeout(function() {
                    x.className = x.className.replace("show", "");
                }, 3000);
            }
        }
    </script>
</body>

</html>
