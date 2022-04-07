<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<?= helper('auth') ?>
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
                    <form-label for="text">Text</form-label>
                    <input class="form-control" type="text" name="text" id="text" value="<?= old('text', $task->text ?? '') ?>" >
                    <!----------------------------------------------------------------------------------------->
                    <form-label for="order">Ordre</form-label>
                    <input class="form-control" type="text" name="order" id="order" value="<?= old('order', $task->order ?? '') ?>" >
                    <!----------------------------------------------------------------------------------------->
                    <form-label for="user_id"></form-label>
                    <input type="hidden" name="user_id" id="user_id" value="<?= user()->id ?>" >
                    <!----------------------------------------------------------------------------------------->
                    <form-label for="created_at"></form-label>
                    <input type="hidden" name="created_at" id="created_at" value="<?= date('Y-m-d H:i:s') ?>" >
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