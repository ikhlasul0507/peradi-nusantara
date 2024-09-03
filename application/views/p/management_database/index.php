<div class="container">
    <h1>Database Tables Management</h1>
    <ul>
        <?php foreach ($tables as $table): ?>
            <li><a href="<?= site_url('P/Admin/view/' . $table); ?>"><?= $table; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>