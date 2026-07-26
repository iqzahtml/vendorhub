<div id="loginModal" class="modal">

    <div class="modal-content">

        <button class="close" onclick="closeLoginModal()">
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

        <form action="login.php" method="POST">

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email"
                    required>

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Enter your password"
                    required>

            </div>

            <button
                type="submit"
                class="login-button">

                Login

            </button>

        </form>

        <div class="modal-register">

            Don't have an account?

            <a href="register.php">
                Register Here
            </a>

        </div>

    </div>

</div>