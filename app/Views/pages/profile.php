<?= $this->include('partials/head', ['title' => 'Profile | Tasks for Today']) ?>

<section class="page-heading">
    <p class="eyebrow">DEMO ACCOUNT</p>
    <h1>Profile</h1>
    <p class="muted">The user information stored in the database.</p>
</section>

<?php if ($user === null): ?>
    <section class="empty-state"><h2>No profile record found</h2><p>Run the database seeder to add the demo user.</p></section>
<?php else: ?>
    <section class="profile-card">
        <div class="avatar" aria-hidden="true"><?= esc(strtoupper(substr($user['full_name'], 0, 1))) ?></div>
        <p class="eyebrow">TASKS SYSTEM USER</p>
        <h2><?= esc($user['full_name']) ?></h2>
        <dl class="profile-details">
            <div><dt>Username</dt><dd><?= esc($user['username']) ?></dd></div>
            <div><dt>Email</dt><dd><?= esc($user['email']) ?></dd></div>
            <div><dt>Member since</dt><dd><?= esc(date('M j, Y', strtotime($user['created_at']))) ?></dd></div>
        </dl>
    </section>
<?php endif; ?>

<?= $this->include('partials/foot') ?>
