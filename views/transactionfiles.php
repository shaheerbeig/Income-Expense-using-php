<!DOCTYPE html>
<html>
    <head>
        <title>Transactions.</title>
    </head>
    <style>
            table {
                width: 100%;
                text-align: center;
                border-collapse: collapse;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    <body>
        <h1>Toatl Expense And Income </h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check#</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tarnsactions as $action): ?>
                    <tr>
                        <td><?= dateFormat($action['date']) ?></td>
                        <td><?= $action['check'] ?></td>
                        <td><?= $action['description'] ?></td>
                        <td>
                        <?php if($action['amount'] < 0):  ?>
                            <span style="color:red;">
                                <?= convertToDollar($action['amount'])  ?>
                            </span>
                        <?php elseif($action['amount'] > 0):  ?>
                            <span style="color:green;">
                                <?= convertToDollar($action['amount'])?>
                            </span>
                        <?php else: ?>
                                <?=  convertToDollar($action['amount']) ?>   
                            <?php endif ?>
                        </td>
                        </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total Income:</th>
                    <td><?= convertToDollar($totals['totalIncome']) ?? 0 ?></td>
                </tr>
                <tr>
                    <th>Total Expense:</th>
                    <td><?= convertToDollar($totals['totalExpense']) ?? 0 ?></td>
                </tr>
                <tr>
                    <th>Net Total:</th>
                    <td><?= convertToDollar($totals['netTotal']) ?? 0 ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>()