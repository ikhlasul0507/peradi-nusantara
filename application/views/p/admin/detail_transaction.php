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
            <td>Payment
