<div class="auth-container">
    <div class="auth-card">
        <h1>Create Account</h1>
        <p class="auth-subtitle">Join <?php echo SITE_NAME; ?> to manage your orders and enrollments</p>
        
        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=register" class="auth-form">
            <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required minlength="6">
                <small class="form-help">Must be at least 6 characters</small>
            </div>
            
            <div class="form-group">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" id="password_confirm" name="password_confirm" required minlength="6">
            </div>
            
            <button type="submit" class="btn btn-primary btn-full">Create Account</button>
        </form>
        
        <div class="auth-footer">
            <p>Already have an account? <a href="<?php echo BASE_URL; ?>index.php?page=login">Log In</a></p>
        </div>
    </div>
</div>

<style>
.auth-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 200px);
    padding: 2rem 1rem;
}

.auth-card {
    background: white;
    padding: 2.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    max-width: 450px;
    width: 100%;
}

.auth-card h1 {
    margin: 0 0 0.5rem 0;
    font-size: 1.75rem;
    text-align: center;
}

.auth-subtitle {
    text-align: center;
    color: #6c757d;
    margin-bottom: 2rem;
}

.auth-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    font-weight: 500;
    color: #333;
}

.form-group input {
    padding: 0.75rem;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 1rem;
}

.form-group input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
}

.form-help {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 0.25rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary {
    background: #007bff;
    color: white;
}

.btn-primary:hover {
    background: #0056b3;
}

.btn-full {
    width: 100%;
}

.auth-footer {
    margin-top: 2rem;
    text-align: center;
    padding-top: 1.5rem;
    border-top: 1px solid #dee2e6;
}

.auth-footer p {
    margin: 0;
    color: #6c757d;
}

.auth-footer a {
    color: #007bff;
    text-decoration: none;
}

.auth-footer a:hover {
    text-decoration: underline;
}
</style>
