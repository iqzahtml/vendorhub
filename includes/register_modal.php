<div id="registerModal" class="modal">

    <div class="modal-content register-container">

        <span class="close" onclick="closeRegister()">&times;</span>

        <div class="register-left">

            <img src="<?php echo BASE_URL; ?>images/logo.jpg">

            <h2>Create Account</h2>

            <p>Join HochipoHub today.</p>

        </div>

        <div class="register-right">

            <h2>Register</h2>

            <form action="<?php echo BASE_URL; ?>auth/register_process.php" method="POST">

                <div class="input-group">

                    <label>Full Name</label>

                    <input type="text" name="name" required>

                </div>

                <div class="input-group">

                    <label>Email</label>

                    <input type="email" name="email" required>

                </div>

                <div class="input-group">

                    <label>Phone Number</label>

                    <input type="text" name="phone" required>

                </div>

                <div class="input-group">

                    <label>Password</label>

                    <input type="password" name="password" required>

                </div>

                <div class="input-group">

                    <label>Confirm Password</label>

                    <input type="password" name="confirm_password" required>

                </div>

                <div class="input-group">

                    <label>Register As</label>

                    <select name="role">

                        <option value="customer">

                            Customer

                        </option>

                        <option value="vendor">

                            Vendor

                        </option>

                    </select>

                </div>

                <button type="submit" class="btn-register">

                    Register

                </button>

            </form>

            <p>

                Already have an account?

                <a href="#" onclick="switchToLogin()">

                    Login

                </a>

            </p>

        </div>

    </div>

</div>