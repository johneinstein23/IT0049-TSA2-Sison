<?php helper('url'); ?>

<header class="site-header">
    <a class="brand" href="<?= site_url('/') ?>">Tasks for Today</a>
    <nav aria-label="Main navigation">
        <a href="<?= site_url('/') ?>">Welcome</a>
        <a href="<?= site_url('tasks') ?>">Task List</a>
        <a href="<?= site_url('profile') ?>">Profile</a>
        <a href="<?= site_url('about') ?>">About</a>
        <?php if (session()->get('userId') !== null): ?>
            <form class="nav-form" action="<?= site_url('logout') ?>" method="post">
                <?= csrf_field() ?>
                <button class="nav-button" type="submit">Sign out</button>
            </form>
        <?php else: ?>
            <a href="<?= site_url('login') ?>">Sign in</a>
        <?php endif; ?>
    </nav>
</header>
