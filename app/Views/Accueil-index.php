<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<div class="card">
    <img class="img-thumbnail rounded float-left" style="height: 200px; width: 200px" src="<?php echo base_url('/images/task.jpg'); ?>" alt="Card image cap">
    <div class="card-body">
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
</div>
<?= $this->endSection() ?>