<section id="top-section-header-and-title">
        <header>
            <img src="integrations/res/img/logo.png" alt="logo">
            <nav>
                <ul>
                    <li>
                    <div class="topnav">
                        <a <?php if($navigation=="utilisateur"){ echo 'class="active"'; } ?> href="listeDesUtilisateurs.php">Utilisateurs</a>
                        <a <?php if($navigation=="classe"){ echo 'class="active"'; } ?> href="listeDesClasses.php">Classes</a>
                        <a <?php if($navigation=="cour"){ echo 'class="active"'; } ?> href="listeDesCours.php">Cours</a>
                        <a href="connexion.php">Déconnexion
                            <i class="fas fa-chalkboard-teacher"></i></a>
                    </div> 
                        
                    </li>
                </ul>
            </nav>
        </header>
    </section>