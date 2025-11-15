<div class="client-area">
    <h1>My Profile</h1>
    
    <nav class="breadcrumb">
        <a href="<?php echo BASE_URL; ?>index.php?page=client">My Account</a> &raquo; My Profile
    </nav>
    
    <div class="profile-container">
        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=client&action=updateProfile" class="profile-form">
            <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
            
            <div class="form-section">
                <h2>Account Information</h2>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo e($data['user']['username']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo e($data['user']['email']); ?>" required>
                </div>
            </div>
            
            <div class="form-section">
                <h2>Change Password</h2>
                <p class="help-text">Leave blank to keep your current password</p>
                
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" minlength="6">
                </div>
                
                <div class="form-group">
                    <label for="password_confirm">Confirm New Password</label>
                    <input type="password" id="password_confirm" name="password_confirm" minlength="6">
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="<?php echo BASE_URL; ?>index.php?page=client" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        
        <div class="account-info">
            <h2>Account Details</h2>
            <p><strong>Account Type:</strong> <?php echo ucfirst($data['user']['role']); ?></p>
            <p><strong>Member Since:</strong> <?php echo formatDate($data['user']['created_at']); ?></p>
        </div>
    </div>
</div>

<style>
.client-area {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.breadcrumb {
    margin-bottom: 1.5rem;
    color: #6c757d;
}

.breadcrumb a {
    color: #007bff;
    text-decoration: none;
}

.profile-container {
    display: grid;
    gap: 2rem;
}

.profile-form {
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-section {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #dee2e6;
}

.form-section:last-of-type {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.form-section h2 {
    margin-top: 0;
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.help-text {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.form-group input {
    width: 100%;
    max-width: 500px;
    padding: 0.5rem;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 1rem;
}

.form-group input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.account-info {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 8px;
}

.account-info h2 {
    margin-top: 0;
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.account-info p {
    margin: 0.5rem 0;
}

.btn {
    display: inline-block;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.btn-primary {
    background: #007bff;
    color: white;
}

.btn-primary:hover {
    background: #0056b3;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}
</style>
