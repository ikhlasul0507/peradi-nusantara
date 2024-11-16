<div class="ml-3">
    <a class="badge badge-danger" href="<?= $this->input->server('HTTP_REFERER');?>">Back to Table</a>
    <h4>Edit Record in <?= $table; ?></h4>

    <form method="POST">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
        
        <!-- Scrollable container -->
        <div style="max-height: calc(80vh - 120px);
                overflow-y: auto;">
            <table>
                <?php foreach ($fields as $field): ?>
                <tr>
                    <td><label><?= $field; ?>:</label></td>
                    <td><input type="text" name="<?= $field; ?>" value="<?= $record[$field]; ?>"></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        
        <input type="submit" value="Update">
    </form>
</div>
