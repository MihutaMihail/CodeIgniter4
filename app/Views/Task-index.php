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
                        <td><a href="<?='/modifier/'.$task->id?>">Modifier</a></td>
                        <td><a href="<?='/supprimer/'.$task->id?>">Supprimer</a></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <a href="/creer">Ajouter</a>
    </div>
    </body>
</html>