


    <div class="login">
        <h1>Login to Web App</h1>
        <!-- form start -->
        <?php echo $this->Form->create('User');?>

            <p>
                <?php echo $this->Form->input('name');?>
            </p>
            <p>
                <?php echo $this->Form->input('password');?>
            </p>
            <p class="remember_me">
                <label>
                    <input type="checkbox" name="remember_me" id="remember_me">
                    Remember me on this computer
                </label>
            </p>
            <p class="submit">
                <!-- submit / Form END -->
                <?php echo $this->Form->end(__('Login')); ?>
            </p>
    </div>

    <div class="login-help">
        <p>Forgot your password? <a href="index.html">Click here to reset it</a>.</p>
    </div>



