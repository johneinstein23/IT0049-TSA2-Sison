<?= $this->include('partials/head', ['title' => 'About | Tasks for Today']) ?>

<section class="page-heading">
    <p class="eyebrow">ABOUT THIS PROJECT</p>
    <h1>Tasks for Today Management System</h1>
    <p class="muted">A small internal tool for reviewing daily work and tracking task dates.</p>
</section>

<section class="content-card">
    <h2>About the developer</h2>
    <p>This application was developed by <strong>John Einstein Sison</strong> for IT0049 Web System Technologies.</p>
    <p>It uses CodeIgniter 4 models to retrieve task and user records from a MySQL database.</p>
</section>

<?= $this->include('partials/foot') ?>
