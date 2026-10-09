<?= $this->include('partials/head', ['title' => 'Sign in | Tasks for Today']) ?>

<section class="auth-shell">
    <div class="page-heading">
        <p class="eyebrow">TASK MANAGEMENT</p>
        <h1>Sign in</h1>
        <p class="muted">Sign in to create, edit, or archive tasks.</p>
    </div>

    <?php if ($message = session()->getFlashdata('error')): ?>
        <p class="notice notice-error"><?= esc($message) ?></p>
    <?php endif; ?>
    <?php if ($message = session()->getFlashdata('success')): ?>
        <p class="notice notice-success"><?= esc($message) ?></p>
    <?php endif; ?>

    <form class="content-card form-card" action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" maxlength="50" autocomplete="username" value="<?= esc(old('username') ?? '') ?>" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required>

        <button class="button" type="submit">Sign in</button>
        <a class="text-link" href="<?= site_url('/') ?>">Return to Welcome</a>
    </form>
</section>

<?= $this->include('partials/foot') ?>
