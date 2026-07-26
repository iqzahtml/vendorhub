<div id="loginModal"
     class="modal">

    <div class="modal-content">

        <button class="close"
                onclick="closeLoginModal()">

            &times;

        </button>

        <div class="auth-logo">

            Vendor<span>Hub</span>

        </div>

        <h2 class="modal-title">

            Welcome Back

        </h2>

        <p class="modal-subtitle">

            Login to continue shopping

        </p>

        <form action="login.php"
              method="POST">

            <div class="form-group">

                <label for="modal-email">

                    Email

                </label>

                <input type="email"
                       id="modal-email"
                       name="email"
                       class="form-control"
                       placeholder="Enter your email"
                       required>

            </div>

            <div class="form-group">

                <label for="modal-password">

                    Password

                </label>

                <input type="password"
                       id="modal-password"
                       name="password"
                       class="form-control"
                       placeholder="Enter your password"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-primary login-button">

                Login

            </button>

        </form>

        <div class="modal-register">

            <p>

                Don't have an account?

                <a href="register.php">

                    Register here

                </a>

            </p>

        </div>

    </div>

</div>