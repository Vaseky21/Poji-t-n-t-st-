
<!--REGISTRACNI FORMULAR-->
<?php
session_start();
require_once('Db.php');
Db::connect('127.0.0.1', 'pojisteni_stesti', 'root', '');



if ($_POST)
{
    if ($_POST['heslo'] != $_POST['heslo_znovu'])
    {
      $zprava = 'Hesla nesouhlasí';
    }
    else 
  
    {
            $existuje = Db::querySingle('
            SELECT COUNT(*)
            FROM uzivatele
            WHERE email=?
            LIMIT 1
        ', $_POST['email']);
        if ($existuje)
        {
          $zprava = 'Uživatel s touto emailovou adresu je již registrován.';
        }
            
        else
        {
          $heslo = password_hash($_POST['heslo'], PASSWORD_DEFAULT);
          Db::query('
        INSERT INTO uzivatele (jmeno, prijmeni,email,heslo)
        VALUES (?, ?, ?, ?)
          ', $_POST['jmeno'], $_POST['prijmeni'],$_POST['email'],$heslo);
            $_SESSION['id'] = Db::getLastId();
            $_SESSION['jmeno'] = $_POST['jmeno'];
            $_SESSION['prijmeni'] = $_POST['prijmeni'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['heslo'] = $_POST['heslo'];
            header('Location: administrace.php');
            exit();

        }
    } 
} 
?>

<body>
  <!--NAVIGACE-->
  <?php
     include "navigace.php";
     ?>
    <style>
      body{
        background: #ffe259;
        background: linear-gradient(to right, #e4a76a,#b69c1b );

      }
      .bg{
        background-image: url(image/woman-ga8939ceae_1920.jpg);
        background-position: center center ;
      }
    </style>
    <!--FORMULAR-->
    <!--První sloupec-->
    <div class="container w-75 bg-white mt-5 shadow">
      <div class="row align-items-lg-stretch">
        <div class="col bg d-none d-lg-block">

        </div>
        <!--Druhý sloupec-->
        <div class="col p-5 rounded-end">
          <h2 class="fw-bold text-center py-5">Registrační Formulář</h2>
          <!--LOGIN-->
          <form ction="regformular.php" method="post">  

            <div class="mb-4">
                <label for="validationCustom01" class="form-label">Jméno</label>
                <input type="text" name="jmeno" class="form-control" id="validationCustom01" value="" required>
                <div class="valid-feedback">
            </div>
            <div class="mb-4">
                <label for="validationCustom02" class="form-label">Příjmení</label>
                <input type="text" name="prijmeni" class="form-control" id="validationCustom02" value="" required>
                <div class="valid-feedback">
            </div> 
            <div class="mb-4">
              <label for="email" class="form-label">Váš e-mail</label>
              <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-4">
              <label for="password" class="form-label">Heslo</label>
              <input type="password" class="form-control" name="heslo">
            </div>
            <div class="mb-4">
              <label for="password" class="form-label">Heslo znovu</label>
              <input type="password" class="form-control" name="heslo_znovu">
            </div>
            <?php if (isset($zprava)) echo('<p>' . $zprava . '</p>'); ?>
            <div class="d-grid">
              <button type="submit" name="odeslat" class="btn btn-primary">VYTVOŘIT</button>
            </div>        
          </form>
        </div>
      </div>
    </div>
    
      <!--JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
  