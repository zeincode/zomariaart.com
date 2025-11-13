<h1><?php echo $data['class'] ? 'Edit Class' : 'Add New Class'; ?></h1>

<form method="POST" action="<?php echo BASE_URL; ?>index.php?page=admin&action=saveClass" class="admin-form">
    <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
    <?php if ($data['class']): ?>
        <input type="hidden" name="class_id" value="<?php echo $data['class']['id']; ?>">
    <?php endif; ?>
    
    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" required 
               value="<?php echo $data['class'] ? e($data['class']['title']) : ''; ?>">
    </div>
    
    <div class="form-group">
        <label for="description">Description *</label>
        <textarea id="description" name="description" rows="6" required><?php echo $data['class'] ? e($data['class']['description']) : ''; ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="syllabus">Syllabus</label>
        <textarea id="syllabus" name="syllabus" rows="4"><?php echo $data['class'] ? e($data['class']['syllabus']) : ''; ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="required_materials">Required Materials</label>
        <textarea id="required_materials" name="required_materials" rows="4"><?php echo $data['class'] ? e($data['class']['required_materials']) : ''; ?></textarea>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label for="date">Date *</label>
            <input type="date" id="date" name="date" required 
                   value="<?php echo $data['class'] ? $data['class']['date'] : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="time">Time *</label>
            <input type="time" id="time" name="time" required 
                   value="<?php echo $data['class'] ? $data['class']['time'] : ''; ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="location">Location *</label>
        <input type="text" id="location" name="location" required 
               value="<?php echo $data['class'] ? e($data['class']['location']) : ''; ?>">
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label for="price">Price *</label>
            <input type="number" id="price" name="price" step="0.01" required 
                   value="<?php echo $data['class'] ? $data['class']['price'] : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="capacity">Capacity *</label>
            <input type="number" id="capacity" name="capacity" required 
                   value="<?php echo $data['class'] ? $data['class']['capacity'] : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="status">Status *</label>
            <select id="status" name="status" required>
                <option value="upcoming" <?php echo ($data['class'] && $data['class']['status'] === 'upcoming') ? 'selected' : ''; ?>>Upcoming</option>
                <option value="in_progress" <?php echo ($data['class'] && $data['class']['status'] === 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                <option value="completed" <?php echo ($data['class'] && $data['class']['status'] === 'completed') ? 'selected' : ''; ?>>Completed</option>
                <option value="cancelled" <?php echo ($data['class'] && $data['class']['status'] === 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            </select>
        </div>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save Class</button>
        <a href="<?php echo BASE_URL; ?>index.php?page=admin&action=classes" class="btn btn-secondary">Cancel</a>
    </div>
</form>
