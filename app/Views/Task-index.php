<?php  
    use CodeIgniter\View\View;
?>

<!doctype html>
<html lang="fr">
    <head>
        <title><?= $titre ?></title>
    </head>
    <body>
    <div>
            <div>
                Les tâches
            </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tâche</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <th><?= esc($task->id) ?></th>
                        <td><?= esc($task->text) ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    </body>
</html>