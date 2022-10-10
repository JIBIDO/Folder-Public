<?php session_start(); ?>
<?php include('base.folder/linkbd.php'); ?>
<?php include('function.folder/connexion_function.php') ?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css.folder/style.css" />
    <title>Connexion & inscription</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="connexion.php" method="POST" class="sign-in-form">
                    <h2 class="title">Connexion</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input <?php if (isset($_SESSION['mail_T'])): ?>value="<?php echo $_SESSION['mail_T']; ?>"<?php endif ?> required name="maili" type="text" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input required name="password" type="password" placeholder="Mot de passe" />
                        <br>
                        <span class="alertPass" style="color: red; font-size: 13px;"></span>
                    </div>
                    <input name="connect" type="submit" value="Connexion" class="btn solid" />
                    <p class="social-text">Contactez-nous sur reseaux</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
                <form action="connexion.php" method="POST" class="sign-up-form">
                    <h2 class="title">Creer un compte </h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input value="<?php if(isset($_SESSION['username_T'])){ echo $_SESSION['username_T']; } ?>" name="username" type="text" placeholder="Creer un nom d'utilisateur" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input minlength="5" maxlength="900" required value="<?php if(isset($_SESSION['mail_T'])){ echo $_SESSION['mail_T']; } ?>" name="mail" type="email" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input minlength="6" maxlength="100" required value="<?php if(isset($_SESSION['password_T'])){ echo $_SESSION['password_T']; } ?>" name="password" type="password" placeholder="Mot de passe " />
                    </div>
                    <input  name="register" type="submit" class="btn" value="Soumettre" />
                    <p class="social-text">Suivez vous sur nos reseaux</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Identifiiez-vous ?</h3>
                    <p>
                        Vous ne pouvez vous connecter qu'aprés une inscription. UNe connexion vous permet d'acceder profondément dans le sites tout en mettant a jour vos informations.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Creer un compte
                    </button>
                </div>
                <img src="images/log.png" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Deja membre ? </h3>
                    <p>
                       Si vous étes deja membre nous vous invitons a vous connecter.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Connexion
                    </button>
                </div>
                <img src="images" class="image" alt="" />
            </div>
        </div>
    </div>

    <script sr="javascript.folder/app.js" defer>
        const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
});
// fonction a executer si l'utilisateur veux creer un comnpte
function create_account_animation (){
     container.classList.add("sign-up-mode");
}
// fonction a executer si l'utilisateur veux acceder a son comnpte
function acces_account_animation (){
    container.classList.remove("sign-up-mode");
}
    </script>
}
</body>

</html>

<!-- 
================================================================
TRAITEMENT DU FORMULAIRE D'INSCRIPTION
========================================================

 -->
 <?php if (isset($_POST['register'])): ?><!-- si l'utilisateur clique sur le bouton d'envoie du formaulaire d'inscription -->
 <!-- username -->
 <?php if(is_user($db, trim($_POST['mail']))['find_user'] == 0): ?>
    <?php if (isset($_POST['username'])): ?>
        <?php $_SESSION['username_T'] = trim($_POST['username']); ?>
        <?php $_SESSION['mail_T'] = trim( $_POST['mail'] ); ?>
        <?php $_SESSION['password_T'] = trim( $_POST['password'] ); ?>
        <?php if (!empty(trim($_POST['username']))): ?>
            <?php if(strlen(trim($_POST['username'])) > 2): ?>

               <!-- email -->

      <?php if (!empty(trim($_POST['mail']))): ?>
            <?php if(strlen(trim($_POST['mail'])) > 5): ?>


                    <!-- password -->

      <?php if (!empty(trim($_POST['password']))): ?>
            <?php if(strlen(trim($_POST['password'])) > 5): ?>

               <!-- si la premiere carcatere du mot de passe est une lettre -->
               <?php if(ctype_alpha(trim($_POST['password']))): ?>

                          <?php if (ctype_upper(substr(trim($_POST['password']), 0, 1))): ?>
                              <!-- si la premiere lettre est en majuscule -->
                             
                              <?php $exec_p = insert($db); ?>
<?php $exec = $exec_p['execution']; ?>
<?php $is_sendable = $exec_p['sendable']; ?>
<?php if($exec){
 ?>
<?php if($is_sendable){ ?>
<?php if(sendmail($_SESSION['mail_T'])){ ?>
<?php unset($_SESSION['vcode']); ?>
<script>
alert('Nous venons de vous envoyer une email de verification');
document.location.href = 'verification.php';
</script>
<script>
    goToQuart();
</script>
<?php } else { ?>
<script>
alert('Une erreur est survenu lors de l\'envoie du mail veuiller re-essayer');
</script>
<?php }; ?>
<?php }else{ ?>
    
<?php }
                  }else{?>
<script>
alert('une erreur est survenu lors de l\'enregistrement des données');
</script>
<?php } ?>

<?php else: ?>
    <script type="text/javascript">
        alert('Le mot de passe doit commencer par une lettre majuscule si la premiere caractére est une lettre')
    </script>

                          <?php endif ?>



                <!-- /////////// -->
            <?php else: ?>
               <!-- si le mot de passe ne commece pas par une lettre -->

                             
                              <?php $exec_p = insert($db); ?>
<?php $exec = $exec_p['execution']; ?>
<?php $is_sendable = $exec_p['sendable']; ?>
<?php if($exec){
 ?>
<?php if($is_sendable){ ?>
<?php if(sendmail($_SESSION['mail_T'])){ ?>
<?php unset($_SESSION['vcode']); ?>
<script>
alert('Nous venons de vous envoyer une email de verification');
document.location.href = 'verification.php';
</script>
<script>
    goToQuart();
</script>
<?php } else { ?>
<script>
alert('Une erreur est survenu lors de l\'envoie du mail veuiller re-essayer');
</script>
<?php }; ?>
<?php }else{ ?>
    
<?php }
                  }else{?>
<script>
alert('une erreur est survenu lors de l\'enregistrement des données');
</script>
<?php } ?>



            <?php endif ?>

            <?php else: ?>
                <!-- si le nom dutilisateur ne contient pas 3 plus de 3 caractéres -->
                <script type="text/javascript">
                    alert('Le mot de passe doit contenir au moins 6');
                </script>
            <?php endif ?>
            <?php else: ?>
                <!-- si le nom dutilisateur n'est pas vide ou est remplis avec uniquement de l'espace -->
                <script type="text/javascript">
                    alert('Veuiller entrer un mot de passe valide');
                </script>
        <?php endif ?>

               <!-- fin password -->


            <?php else: ?>
                <!-- si le nom dutilisateur ne contient pas 3 plus de 3 caractéres -->
                <script type="text/javascript">
                    alert('Entrer un email valide, elle doit contenir au minimum');
                </script>
            <?php endif ?>
            <?php else: ?>
                <!-- si le nom dutilisateur n'est pas vide ou est remplis avec uniquement de l'espace -->
                <script type="text/javascript">
                    alert('Veuiller entrer un email');
                </script>
        <?php endif ?>

               <!-- fin password -->



            <?php else: ?>
                <!-- si le nom dutilisateur ne contient pas 3 plus de 3 caractéres -->
                <script type="text/javascript">
                    alert('Le nom d\'utilisateur doit contenir au moins 3 caractéres');
                </script>
            <?php endif ?>
            <?php else: ?>
                <!-- si le nom dutilisateur n'est pas vide ou est remplis avec uniquement de l'espace -->
                <script type="text/javascript">
                    alert('Veuiller entrez correctement le nom d\'utilisateur');
                </script>
        <?php endif ?>
    <?php else: ?>
        <!-- si le nom dutilisateur n'est pas definis -->
                <script type="text/javascript">
                    alert('Nous ne savons pas comment vous avez faits mais sachez que le nom d\'utilisateurs n\'est pas defini');
                </script>
    <?php endif ?>

<?php else: ?>
    <!-- si l'utilisateur EST DEJA  Inscria -->
    <script type="text/javascript">
        alert('Désolé mais cet email est déja inscris');
    </script>
<?php endif ?>
<?php endif ?>
<!-- 
================================================================
FIN DE TRAITEMENT DU FORMULAIRE D'INSCRIPTION
========================================================

 -->
 <?php if(isset($_SESSION['username_T']) AND !isset($_POST['connect'])): ?>

 <script type="text/javascript">


     create_account_animation();


 </script>
 <?php endif ?>

















 <!-- 
+===============================================================
TRAITEMENT DU FORMULAIRE DE CONNEXION
================================================================
  --> 

<?php if (isset($_POST['connect'])): ?>
    <?php $_SESSION['mail_T'] = trim($_POST['maili']); ?>
    <?php  $connecting = $db->prepare('SELECT * FROM Utilisateurs WHERE Mail =? LIMIT 1'); ?>
    <?php $connecting->execute(array(strtolower(trim($_POST['maili'])))); ?>
    <?php $is_exist = $connecting->rowCount(); ?>
    <?php if ($is_exist > 0): ?>
     <!-- avant d'autoriser l'accés nous verifierons si l'utilisateur n'est pas bannis -->
     <?php while($user = $connecting->fetch()){ ?>
        <?php if($user['Password'] == $_POST['password']): ?>
            <?php if($user['Ban'] == 0): ?>
                <?php $_SESSION['Mail'] = $user['Mail'];  ?>
                <?php $_SESSION['Username'] = $user['username']; ?>
                
                    <?php $update = $db->prepare('UPDATE Utilisateurs SET Derniere_connexion = CURRENT_TIMESTAMP WHERE Mail = ?'); ?>
                    <?php $updating = $update->execute(array($_SESSION['Mail'])); ?>
                    <?php if($updating): ?>
                    <script type="text/javascript">
                        document.location.href = 'Accueil.php'
                    </script>
                <?php else: ?>
                   <?php session_destroy(); ?>
                <?php endif ?>
                   
            <?php else: ?>
                <script type="text/javascript">
                    alert('Il semble que vous avez etait bannis pour des raisons de securités, contacter le service client pour plus d\'informations');
                </script>
            <?php endif ?>
        <?php else: ?>
            <script type="text/javascript">
                let alert = document.querySelector('span.alertPass');
                alert.textContent = 'Mot de passe incorrecte'
            </script>
        <?php endif ?>
     <?php } ?>
        <?php else: ?>
            <script type="text/javascript">
                var want_register = confirm('Désolé mais vous n\'êtes pas membre de CardyPro, si vous souhaité faire partie de notre communauté, alors cliquer sur ok, si non cliquer sur annuler');
                if (want_register == true) { create_account_animation(); }else{

                }
            </script>
    <?php endif ?>
<?php endif ?>


  <!-- 
+===============================================================
FIN DU TRAITEMENT DU FORMULAIRE DE CONNEXION
================================================================
  -->