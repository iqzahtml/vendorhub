<div id="loginModal" class="modal">

    <div class="modal-content">

        <span class="close" onclick="closeLoginModal()">
            &times;
        </span>

        <div class="auth-logo">
            Vendor<span>Hub</span>
        </div>

        <h2>Welcome Back</h2>

        <form action="login.php" method="POST">

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email"
                    required
                >

            </div>

            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Enter your password"
                    required
                >

            </div>

            <button
                type="submit"
                class="btn btn-primary"
                style="width: 100%;"
            >
                Login
            </button>

        </form>

        <p class="modal-register">
            Don't have an account?

            <a href="register.php">
                Register here
            </a>
        </p>

    </div>

</div>