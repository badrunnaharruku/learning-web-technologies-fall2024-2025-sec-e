<?php
require_once('header.php');
require_once('../model/billModel.php');

$bills = getUpcomingBills();
?>

<html>
    <head>
        <title>Bill Management</title>
    </head>
    <body>
        <h1>Bill Management</h1>

        <h2>All Bills</h2>
        <table border="1">
            <tr>
                <th>Bill ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($bills)) { ?>
                <?php foreach ($bills as $bill) { ?>
                    <tr>
                        <td><?= $bill['id'] ?></td>
                        <td><?= $bill['name'] ?></td>
                        <td>$<?= $bill['amount'] ?></td>
                        <td><?= $bill['due_date'] ?></td>
                        <td><?= $bill['status'] ?></td>
                        <td>
                            <form method="post" action="../controller/updateBillController.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $bill['id'] ?>">
                                <button type="submit" name="action" value="paid">Mark as Paid</button>
                            </form>
                            <form method="post" action="../controller/deleteBillController.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $bill['id'] ?>">
                                <button type="submit" name="action" value="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6">No bills found.</td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
