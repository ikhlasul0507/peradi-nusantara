<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2 style="text-align:center;">Transaction Details</h2>

    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Status Code</td>
            <td><?= htmlspecialchars($transaction->status_code) ?></td>
        </tr>
        <tr>
            <td>Transaction ID</td>
            <td><?= htmlspecialchars($transaction->transaction_id) ?></td>
        </tr>
        <tr>
            <td>Gross Amount</td>
            <td><?= htmlspecialchars($transaction->gross_amount) ?></td>
        </tr>
        <tr>
            <td>Currency</td>
            <td><?= htmlspecialchars($transaction->currency) ?></td>
        </tr>
        <tr>
            <td>Order ID</td>
            <td><?= htmlspecialchars($transaction->order_id) ?></td>
        </tr>
        <tr>
            <td>Payment Type</td>
            <td><?= htmlspecialchars($transaction->payment_type) ?></td>
        </tr>
        <tr>
            <td>Signature Key</td>
            <td><?= htmlspecialchars($transaction->signature_key) ?></td>
        </tr>
        <tr>
            <td>Transaction Status</td>
            <td><?= htmlspecialchars($transaction->transaction_status) ?></td>
        </tr>
        <tr>
            <td>Fraud Status</td>
            <td><?= htmlspecialchars($transaction->fraud_status) ?></td>
        </tr>
        <tr>
            <td>Status Message</td>
            <td><?= htmlspecialchars($transaction->status_message) ?></td>
        </tr>
        <tr>
            <td>Merchant ID</td>
            <td><?= htmlspecialchars($transaction->merchant_id) ?></td>
        </tr>
        <tr>
            <td>Virtual Account Bank</td>
            <td><?= htmlspecialchars($transaction->va_numbers[0]->bank) ?></td>
        </tr>
        <tr>
            <td>Virtual Account Number</td>
            <td><?= htmlspecialchars($transaction->va_numbers[0]->va_number) ?></td>
        </tr>
        <tr>
            <td>Payment Amount</td>
            <td><?= htmlspecialchars($transaction->payment_amounts[0]->amount) ?></td>
        </tr>
        <tr>
            <td>Payment Date</td>
            <td><?= htmlspecialchars($transaction->payment_amounts[0]->paid_at) ?></td>
        </tr>
        <tr>
            <td>Transaction Time</td>
            <td><?= htmlspecialchars($transaction->transaction_time) ?></td>
        </tr>
        <tr>
            <td>Expiry Time</td>
            <td><?= htmlspecialchars($transaction->expiry_time) ?></td>
        </tr>
    </table>

</body>
</html>
