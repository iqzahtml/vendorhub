<div id="loginModal" class="modal">

    <div class="modal-content login-container">

        <span class="close" onclick="closeLogin()">&times;</span>

        <div class="login-left">

            <img src="<?php echo BASE_URL; ?>images/logo.jpg" alt="Logo">

            <h2>Welcome Back</h2>

            <p>Login to continue shopping with HochipoHub.</p>

        </div>

        <div class="login-right">

            <h2>Login</h2>

            <form action="<?php echo BASE_URL; ?>auth/login_process.php" method="POST">

                <div class="input-group">

                    <label>Email</label>

                    <input type="email" name="email" required>

                </div>

                <div class="input-group">

                    <label>Password</label>

                    <input type="password" name="password" required>

                </div>

                <div class="remember">

                    <label>

                        <input type="checkbox" name="remember">

                        Remember Me

                    </label>

                </div>

                <button type="submit" class="btn-login">

                    Login

                </button>

            </form>

            <div class="login-links">

                <a href="<?php echo BASE_URL; ?>auth/forgot_password.php">

                    Forgot Password?

                </a>

            </div>

            <p>

                Don't have an account?

                <a href="#" onclick="switchToRegister()">

                    Register

                </a>

            </p>

        </div>

    </div>

</div>