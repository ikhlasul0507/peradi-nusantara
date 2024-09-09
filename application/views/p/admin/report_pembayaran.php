<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
            <h6 class="m-0 font-weight-bold text-primary">List Virtual Account</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>transaction_id</th>
                            <th>transaction_time</th>
                            <th>transaction_status</th>
                            <th>payment_type</th>
                            <th>gross_amount</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>transaction_id</th>
                            <th>transaction_time</th>
                            <th>transaction_status</th>
                            <th>payment_type</th>
                            <th>gross_amount</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($transactions as $value) { ?>
                        <tr>
                            <td><?= $value['transaction_id'];?></td>
                            <td><?= $value['transaction_time'];?></td>
                            <td><?= $value['transaction_status'];?></td>
                            <td><?= $value['payment_type'];?></td>
                            <td><?= "Rp " . number_format($value['gross_amount'], 0, ',', '.');?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
