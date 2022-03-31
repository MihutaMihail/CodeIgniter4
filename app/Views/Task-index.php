<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<?php
    //C'est pour utiliser l'objet VIEW ($this) et nous proposer des méthodes
    use CodeIgniter\View\View; 
?>
<div class="card">
    <div class="card-header">
        Les tâches
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tâche</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <th scope="row"><?= esc($task->id) ?></th>
                        <?php if ($task->done) : ?>
                            <td><s><?= esc($task->text) ?></s></td>
                        <?php else : ?>
                            <td><?=  esc($task->text) ?></td>
                        <?php endif ?>
                        <td>
                            <a class="btn btn-primary" role="button" href="<?='/modifier/'.$task->id?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger" role="button" href="<?='/supprimer/'.$task->id?>"><i class="fas fa-trash-alt"></i></a>
                            <a class="btn btn-secondary" role="button" href="<?='/done/'.$task->id?>"><i class="fas fa-check-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <a class="btn btn-primary" href="/creer"><i class="fas fa-plus"></i></a>
</div>
<?= $this->endSection() ?>