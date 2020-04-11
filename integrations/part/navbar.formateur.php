<section id="top-section-header-and-title">
        <header>
            <img src="../integrations/res/img/logo.png" alt="logo">
            <nav>
                <ul>
                    <li>
                    <div class="topnav">
                        <a <?php if($navigation=="accueilFormateurs"){ echo 'class="active"'; } ?> href="../Formateurs/accueilFormateurs.php">Accueil</a>
                        <a <?php if($navigation=="formateurCours"){ echo 'class="active"'; } ?> href="../Formateurs/coursFormateur.php">Cours</a>
                        <a <?php if($navigation=="relevePresence"){ echo 'class="active"'; } ?> href="../Formateurs/relevePresence.php">Relevé de Présence</a>
                        
                        <a href="../Accueil/connexion.php">Déconnexion
                            <i class="fas fa-chalkboard-teacher"></i></a>
                    </div> 
                        
                    </li>
                </ul>
            </nav>
        </header>
    </section>