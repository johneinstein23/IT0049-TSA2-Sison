<?= $this->include('partials/head', ['title' => $title . ' | Tasks for Today']) ?>

<section class="page-heading">
    <p class="eyebrow">TASK MANAGEMENT</p>
    <h1><?= esc($title) ?></h1>
    <p class="muted">Title and task date are required.</p>
</section>

<?php $errors = session()->getFlashdata('errors') ?? []; ?>
<?php if ($errors !== []): ?>
    <div class="notice notice-error" role="alert">
        <strong>Please correct the following:</strong>
        <ul><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul>
    </div>
<?php endif; ?>

<form class="content-card form-card" action="<?= esc($action) ?>" method="post">
    <?= csrf_field() ?>
    <label for="title">Task title <span class="required">Required</span></label>
    <input id="title" name="title" type="text" maxlength="150" value="<?= esc(old('title') ?? $task['title']) ?>" required>

    <label for="task_date">Task date <span class="required">Required</span></label>
    <input id="task_date" name="task_date" type="date" value="<?= esc(old('task_date') ?? $task['task_date']) ?>" required>

    <label for="status">Status</label>
    <?php $selectedStatus = old('status') ?? $task['status']; ?>
    <select id="status" name="status" required>
        <option value="pending" <?= $selectedStatus === 'pending' ? 'selected' : '' ?>>Pending</option>
        <option value="in_progress" <?= $selectedStatus === 'in_progress' ? 'selected' : '' ?>>In progress</option>
        <option value="completed" <?= $selectedStatus === 'completed' ? 'selected' : '' ?>>Completed</option>
    </select>

    <div class="form-actions">
        <button class="button" type="submit"><?= esc($submitLabel) ?></button>
        <a class="button button-secondary" href="<?= site_url('tasks') ?>">Cancel</a>
    </div>
</form>

<?= $this->include('partials/foot') ?>
