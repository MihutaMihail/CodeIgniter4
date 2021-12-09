<?php
// On récupère les messages d'erreurs pour les afficher
$errors = session()->getFlashdata('errors');
?>

<!doctype html>
<html lang="fr">

<head>
    <title><?= esc($titre) ?></title>
</head>

<body>
    <div>
        <div>
            <?= (isset($task) ? "Modifier une tâche" : "Nouvelle tâche") ?>
        </div>
        <?= \Config\Services::validation()->listErrors() ?>
        <div>
            <form action="<?= (isset($task) ? '/sauvegarder/{$task->id}' : '/sauvegarder') ?>" method="post">
                <div>
                    <label>Text :</label>
                    <input type="text" name="text" id="text" value="<?= old('text', $task->text ?? '', false) ?>" >
                </div>
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </div>
</body>

</html>