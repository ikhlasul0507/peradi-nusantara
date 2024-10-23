<div class="ml-3" >
    <h4>View : <?= $table; ?></h4>

    <a class="badge badge-danger" href="<?= site_url('P/Admin/management_database'); ?>">Back to Tables</a>
    <a class="badge badge-primary" href="<?= site_url('P/Admin/create/' . $table); ?>">Add New Record</a>
    <?php if($records != null){ ?>
    <div class="table-responsive" style="font-size: 10px;
            color: black ; 
            max-height: calc(80vh - 120px);
                overflow-y: auto;">
        <table border="1" style="overflow-y: scroll; height: 700px; width: 100%; font-size: 12px;color: black">
            <tr>
                <?php foreach (array_keys($records[0]) as $field): ?>
                    <th><?= $field; ?></th>
                <?php endforeach; ?>
                <th>Actions</th>
            </tr>
            <?php foreach ($records as $record): ?>
                <tr>
                    <?php foreach ($record as $value): ?>
                        <td><?= $value; ?></td>
                    <?php endforeach; ?>
                    <td>
                        <a class="badge badge-warning" href="<?= site_url('P/Admin/edit/' . $table . '/' . $record['id_'.$table]); ?>">Edit</a>
                        <a class="badge badge-dark" href="<?= site_url('P/Admin/delete/' . $table . '/' . $record['id_'.$table]); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div>
        <?= $links; // Pagination links ?>
    </div>
    <?php } ?>

</div>

<style type="text/css">
    .pagination {
        display: flex;
        justify-content: center;
        padding: 10px;
    }

    .pagination a {
        margin: 0 5px;
        padding: 8px 16px;
        border: 1px solid #ddd;
        color: #007bff;
        text-decoration: none;
    }

    .pagination a:hover {
        background-color: #f0f0f0;
    }

    .pagination .active a {
        background-color: #007bff;
        color: white;
        border: 1px solid #007bff;
    }

</style>