<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<?php
    //C'est pour utiliser l'objet VIEW ($this) et nous proposer des méthodes
    use CodeIgniter\View\View; 
?>
<div class="card">
    <div class="card-header">
        Vos tâches
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tâche</th>
                    <th scope="col">Création tâche</th>
                    <th scope="col">Tâche effectué</th>
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
                        <!------------------------------------------------------------------------->
                        <td><?= date("m-d-Y H:i:s", strtotime($task->created_at)) ?></td>
                        <!------------------------------------------------------------------------->
                        <?php if ($task->done) : ?>
                            <td><?= date("m-d-Y H:i:s", strtotime($task->done_at)) ?></td>
                        <?php else : ?>
                            <td>Tâche non effectué</td>
                        <?php endif ?>
                        <!------------------------------------------------------------------------->
                        <td>
                            <a class="btn btn-primary" role="button" href="<?='/modifier/'.$task->id?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger" role="button" href="<?='/supprimer/'.$task->id?>"><i class="fas fa-trash-alt"></i></a>
                            <a class="btn btn-secondary" role="button" href="<?='/done/'.$task->id?>"><i class="fas fa-check-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?= $pager->links('default','bootstrapPager') ?>
    </div>
    <div class="card-footer">
        <div class="col-12">
            <a class="btn btn-primary" href="/creer"><i class="fas fa-plus"></i></a>
            <a class="btn btn-secondary active" href="<?= '/reorder/' . user()->id ?>" role="button">
                <i class="fa fa-sort-numeric-asc" aria-hidden="true"> Réordonner</i>
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>