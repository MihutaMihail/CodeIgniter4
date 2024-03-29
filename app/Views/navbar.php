<div class="my-navbar"> 
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top mr-2">
        <a class="navbar-brand" href="">LesTâches</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Accueil</a>
            </li>
            <?php if(logged_in() == true) : ?>
                <?php if(in_groups('Admin')) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= '/taches' ?>">Liste des tâches - ADMIN</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= '/taches/' . user()->id ?>">Liste des tâches</a>
                    </li>
                <?php endif ?>
            <?php endif ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <?php if(logged_in() == true) : ?>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href=""><i class="fas fa-user-circle mr-2"></i><?= user()->username ?></a>
                        <a class="dropdown-item" href=""><i class="fa fa-envelope mr-2" aria-hidden="true"></i><?= user()->email ?></a>
                        <?php if(in_groups('admin')) : ?>
                        <a class="dropdown-item" href=""></i>Mode Admin</a>
                        <?php endif ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/account"><i class="fas fa-cog mr-2"></i>Modification compte</a>
                        <a class="dropdown-item" href="/logout"><i class="fa fa-sign-out mr-2"></i>Déconnexion</a>
                    </div>
                    </li>
                <?php else : ?>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href=""><i class="fas fa-user-circle mr-2"></i>Visiteur</a>
                        <a class="dropdown-item" href="/register"><i class="fas fa-cog mr-2"></i>Créer un compte</a>
                        <a class="dropdown-item" href="/login"><i class="fas fa-cog mr-2"></i>Connexion</a>
                    </div>
                    </li>
                <?php endif ?>
        </ul>
    </div>
    </nav>
</div>