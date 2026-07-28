<div id="loginModal" class="modal">

    <div class="modal-content">

        <span class="close" onclick="closeLoginModal()">&times;</span>

        <div class="login-logo">

            <h2>VendorHub</h2>

            <p>Welcome Back</p>

        </div>

        <form action="login.php" method="POST">

            <div class="input-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required>

            </div>

            <div class="input-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required>

            </div>

            <button
                type="submit"
                class="login-btn">

                Login

            </button>

        </form>

        <p class="register-text">

            Don't have an account?

            <a href="register.php">

                Register

            </a>

        </p>

    </div>

</div>