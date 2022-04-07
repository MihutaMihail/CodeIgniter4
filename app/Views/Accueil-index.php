<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<?= helper('auth') ?>
<style>
    body {
        background-image: url('/images/background.jpg');
        height:auto;
        background-repeat : no-repeat
    }
    h1 {
        left: 0;
        line-height: 200px;
        margin-top: -100px;
        position: absolute;
        text-align: center;
        top: 50%;
        width: 100%;
        color : black;
        text-shadow: 2px 1px 1px #ffffff;
 }
</style>
   <a href="<?= isset(user()->id) ? '/taches/' . user()->id : '/login' ?>"><h1>Cliquer ici pour créer vos tâches<h1></a>
<?= $this->endSection() ?>