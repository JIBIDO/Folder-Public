<?php session_start(); ?>
<?php include('base.folder/linkbd.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  </head>
  <body style="background-color: #4d84e2;">
  <div class="div bg-white col-11 col-md-7 col-sm-7 col-lg-5 col-xl-5 col-xxl-4 h-75 mx-auto" align="center" style="box-shadow: 0 0 128px 0 rgba(0,0,0,0.1), 0 32px 64px -48px rgba(0,0,0,0.5); background:; border-radius: 5px; padding: 10px; box-shadow: ; margin-top: 100px;" valign="center">
    <div class="" style="margin-top: 70px;">
      <i onclick="document.location.href='connexion.php'" style="color: #4d84e2; font-size: 25px;" class="mb-3 bi bi-arrow-left-circle"></i>
    <h2 class="mb-3" style="color:gray; font-size: 22px;">Salut <span style="color:#4d84e2;"><?php echo $_SESSION['username_T'] ?></span></h2>

    <div class="">
      <h6 style="font-size: 12px; width: 70%;">
        Pour nous assurer qu'il s'agit bien de vous nous vous avons envoyer un email, celui-ci contient le code de verification que vous devez nous renseigner
      </h6>
      <form action="verification.php" method="POST">
        <div class="col-8 form-floating mb-3">
  <input <?php if (isset($_SESSION['mail_T'])): ?> style="background: rgba(0, 0, 0, 0.10);" readonly value="<?php echo $_SESSION['mail_T']; ?>"<?php endif ?> name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
  <label class="fs-6 text-gray" for="floatingInput">Email</label>
</div> <div class="col-8 form-floating mb-3">
  <input <?php if(isset($_SESSION['vcode_r'])): ?>value="<?php echo $_SESSION['vcode_r']; ?>"<?php endif ?> name="vcode" type="number" class="form-control" id="floatingInput" placeholder="name@example.com">
  <label class="fs-6 text-gray" for="floatingInput">Code de verification</label>
</div>
    </div>
    </div>
    <center><button type="submit" name="verify" class="btn" style="background-color: #4d84e2; color: white;">Valider</button></center>
    </form>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
<style type="text/css">
  .div{
    position: absolute;
    left: -1000px;
  }
</style>
<script> 
$(document).ready(function(){
  var div = $("div");
  div.animate({left: '0'}, "slow"); 
  div.animate({right: '0'}, "slow");
  setTimeout(function(){
   div.animate({borderRadius: '50%'}, "linear");
  }, 2000)

  
});
</script>

<?php if(isset($_POST['verify'])): ?>
  <?php if (isset($_POST['vcode'])): ?>
   <!-- on verifie si l'utilisateur a deja demander un email de verfication -->
   <?php $_SESSION['vcode_r'] = trim($_POST['vcode']); ?>
   <?php $_SESSION['mail_T'] = trim($_POST['email']); ?>
   <!-- on verifie si l'utilisateur est deja inscris -->
   <?php $is_user = $db->prepare('SELECT * FROM Utilisateurs WHERE Mail =?'); ?>
   <?php $is_user->execute(array(trim($_POST['email']))); ?>
   <?php $is_user = $is_user->rowCount(); ?>
   <?php if($is_user == 0): ?>
   <?php $verification = $db->prepare("SELECT * FROM Verification WHERE Mail =? LIMIT 1"); ?>
   <?php $execution = $verification->execute(array(strtolower($_SESSION['mail_T']))); ?>
   <?php $verification_f = $verification->rowCount(); ?>
 <?php if($execution): ?>
  <?php if($verification_f > 0): ?>
    <?php while($user = $verification->fetch()){ ?>
      <?php if ($user['Cle_de_verification'] == $_SESSION['vcode_r']): ?>  <!-- si le code de verification est correcte -->
      <!-- on inserre les informations de l'utilisateur de façons definitif -->
      <?php $insert = $db->prepare('INSERT INTO Utilisateurs(Mail, Username, Password) VALUES (?, ?, ?)'); ?>
      <?php $insertion = $insert->execute(array($user['Mail'], $user['Username'], $user['Password'])); ?>
      <?php if($insertion): ?>
        <script type="text/javascript">
          var notification = confirm('Bravo vous êtes desormais un membre de CardyPro, cliquer sur Ok pour vous connecter de façons automatique');
          if (notification == true) {   document.location.href = 'Accueil.php'; }else{
       document.location.href = 'connexion.php';
          }
        </script>
      <?php else: ?>
        <script type="text/javascript">
          alert('une erreur est survenu lors de l\'insertion des donnée');
        </script>
      <?php endif ?>
        <?php else: ?>
          <script type="text/javascript">
            alert('Le code de verification est incorrect')
          </script>
      <?php endif ?>
    <?php } ?>
  <?php else: ?>
    <script type="text/javascript">
      alert('Il semble que vous n\'avez pas demander de code de verification ou le code de verification saisis a expiré');
    </script>
  <?php endif ?>
 <?php else: ?>
  <script type="text/javascript">
    alert('Une erreur est survenu lors du traitement de la requette');
  </script>
 <?php endif ?>
<?php else: ?>
  <script type="text/javascript">
    alert('Cette email est deja inscris');
    document.location.href = 'connexion.php';
  </script>

<?php endif ?>
  <?php endif ?>
  <?php endif ?>