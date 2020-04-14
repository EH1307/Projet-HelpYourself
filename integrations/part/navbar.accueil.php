<section id="top-section-header-and-title">
        <header>
            <img src="<?php echo HOST_URL; ?>integrations/res/img/logo.png" alt="logo">
            <nav>
                <ul>
                    <li>
                    <div class="topnav">

                        <a <?php if($navigation=="accueil"){ echo 'class="active"'; } ?> href="<?php echo HOST_URL; ?>index.php">Accueil</a>
                        <a <?php if($navigation=="inscription"){ echo 'class="active"'; } ?> href="<?php echo HOST_URL; ?>Accueil/inscription.php">Inscription</a>
                        
                        <a  <?php if($navigation=="connexion"){ echo 'class="active"'; } ?> href="<?php echo HOST_URL; ?>Accueil/connexion.php" id="login">Connexion</a>
                        
  
                    </div> 
                        
                    </li>
                </ul>
            </nav>
        </header>
    </section>