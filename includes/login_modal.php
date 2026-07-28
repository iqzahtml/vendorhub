<div id="loginModal" class="modal">

    <div class="login-box">

        <span class="close" onclick="closeLoginModal()">&times;</span>

        <h2 class="logo">VendorHub</h2>

        <p class="subtitle">Welcome Back</p>

        <form action="login.php" method="POST">

            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required>
            </div>

            <button type="submit" class="login-btn">
                LOGIN
            </button>

        </form>

        <div class="bottom-text">

            Don't have an account?

            <a href="register.php">

                Register

            </a>

        </div>

    </div>

</div>