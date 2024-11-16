<div class="ml-3">
    <a class="badge badge-danger"href="<?= $this->input->server('HTTP_REFERER');?>">Back to Table</a>
    <h4>Create Record in <?= $table; ?></h4>

    <form method="POST">
         <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
         <div style="max-height: calc(80vh - 120px);
                overflow-y: auto;">
        <table>
            <?php foreach ($fields as $field): ?>
            <tr>
                <td><label><?= $field; ?>:</label></td>
                <td><input type="text" name="<?= $field; ?>"></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
        <input type="submit" value="Create">
    </form>
</div>