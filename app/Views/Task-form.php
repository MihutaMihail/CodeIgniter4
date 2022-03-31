<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<?php
// On récupère les messages d'erreurs pour les afficher
$errors = session()->getFlashdata('errors');
?>
<body> 
    <div class="card">
        <div class="card-header">
            <?= (isset($task) ? "Modifier une tâche" : "Nouvelle tâche") ?>
        </div>
        <div class="card-body">
            <?= ((session()->has('errors')) ? \Config\Services::validation()->listErrors() : '' ) ?>
            <form class="form-horizontal" action="<?= (isset($task) ? '/sauvegarder/' .$task->id : '/sauvegarder') ?>" method="post">
                <div class="form-group">
                    <form-label for="text">Text :</form-label>
                    <input type="text" name="text" id="text" value="<?= old('text', $task->text ?? '', false) ?>" >
                </div>
                <button class="btn btn-primary" type="submit"><?= (isset($task) ? "Modifier" : "Ajouter" ) ?>
                    <?php if ((!isset($task))) : ?>
                    <i class="fa fa-plus"></i>
                    <?php endif ?>
                </button>
            </form>
        </div>
    </div>
</body>

</html>
<?= $this->endSection() ?>