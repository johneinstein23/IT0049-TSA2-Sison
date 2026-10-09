<?= $this->include('partials/head', ['title' => 'Welcome | Tasks for Today']) ?>

<section class="page-heading">
    <p class="eyebrow">DAILY DASHBOARD</p>
    <h1>Welcome</h1>
    <p class="muted">Tasks scheduled for <?= esc(date('F j, Y', strtotime($today))) ?>.</p>
</section>

<?php if ($message = session()->getFlashdata('success')): ?>
    <p class="notice notice-success"><?= esc($message) ?></p>
<?php endif; ?>
<?php if ($message = session()->getFlashdata('error')): ?>
    <p class="notice notice-error"><?= esc($message) ?></p>
<?php endif; ?>

<?php if (session()->get('userId') !== null): ?>
    <p class="page-actions"><a class="button" href="<?= site_url('tasks/new') ?>">Add a task</a></p>
<?php endif; ?>

<?php if ($tasks === []): ?>
    <section class="empty-state">
        <h2>No tasks for today</h2>
        <p>There are no tasks scheduled for this date.</p>
    </section>
<?php else: ?>
    <section class="task-grid" aria-label="Today's tasks">
        <?php foreach ($tasks as $task): ?>
            <article class="task-card">
                <div class="task-card-top">
                    <span class="task-id">TASK <?= esc($task['id']) ?></span>
                    <span class="status status-<?= esc(url_title($task['status'], '-', true)) ?>"><?= esc(ucwords(str_replace('_', ' ', $task['status']))) ?></span>
                </div>
                <h2><?= esc($task['title']) ?></h2>
                <p class="muted">Due <?= esc(date('M j, Y', strtotime($task['task_date']))) ?></p>
            </article>
        <?php endforeach; ?>
    </section>
<?php endif; ?>

<?= $this->include('partials/foot') ?>
