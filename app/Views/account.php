<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <div class="card">
                <h2 class="card-header">Modifier vos identifiants</h2>
                <div class="card-body">

                <form action="/confirmationMail" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="email"><?=lang('Auth.email')?></label>
                        <input type="email" id="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                            name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= user()->email ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Modifier E-mail</button>
                </form>
                <br>
                <!-------------------------------------------------------------------------------------------->
                <form action="/confirmationUsername" method="post">
                    <?= csrf_field() ?>   
                    <div class="form-group">
                        <label for="username"><?=lang('Auth.username')?></label>
                        <input id="username" type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= user()->username ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Modifier Nom d'utilisateur</button>
                </form>
                <br>
                <!-------------------------------------------------------------------------------------------->
                <form action="/confirmationPassword" method="post">
                    <?= csrf_field() ?>      
                        <div class="form-group">
                            <label for="password"><?=lang('Auth.password')?></label>
                            <input id="password" type="password" name="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
                    </div>

                    <div class="form-group">
                            <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                            <input type="password" name="pass_confirm" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Modifier Mot de Passe</button>
                </form>
                <br>
                <!-------------------------------------------------------------------------------------------->
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>