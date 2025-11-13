<div class="login-container">
    <div class="login-box">
        <h1>Admin Login</h1>
        
        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=login" class="login-form">
            <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
            
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-large">Login</button>
        </form>
        
        <div class="login-footer">
            <a href="<?php echo BASE_URL; ?>index.php?page=home">← Back to Home</a>
        </div>
    </div>
</div>
