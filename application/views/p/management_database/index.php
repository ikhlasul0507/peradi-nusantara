<div class="ml-3">
    <h1>Database Tables Management</h1>
    <ul>
        <?php foreach ($tables as $table): 
            if($this->session->userdata('user_level') > 1 && 
                ($table == 'user' 
                    || $table == 'parameter' 
                    || $table == 'log_history'
                    || $table == 'logic_cs'
                    || $table == 'chat_whatsapp'
                    || $table == 'cart'
                    || $table == 'request_payment'
                    || $table == 'forget_password'
                    || $table == 'history_call_center' 
                    || $table == 'token_wa')){
                continue;
            }?>

            <li><a href="<?= site_url('P/Admin/view/' . $table); ?>"><?= $table; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>