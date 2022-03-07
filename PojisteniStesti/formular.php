<?php
session_start();
require_once('Db.php');
Db::connect('127.0.0.1', 'pojisteni_stesti', 'root', '');

if (isset($_SESSION['id']))
{
    header('Location: administrace.php');
    exit();
}

if ($_POST)
{
    $uzivatel = Db::queryOne('
        SELECT id, email, heslo, jmeno, prijmeni
        FROM uzivatele
        WHERE email=?
    ', $_POST['email']);
    if (!$uzivatel || !password_verify($_POST['heslo'], $uzivatel['heslo']))
        $zprava = 'Neplatné uživatelské jméno nebo heslo';
    else
    {
      $_SESSION['id'] = Db::getLastId();
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['heslo'] = $uzivatel['heslo'];
        $_SESSION['jmeno'] = $uzivatel['jmeno'];
        $_SESSION['prijmeni'] = $uzivatel['prijmeni'];
        header('Location: administrace.php');
        exit();
    }
}

?>
<body>
  <!--NAVIGACE-->
  <?php include "navigace.php";?> 
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
        <div class="col bg d-none d-lg-block"></div>
        <!--Druhý sloupec-->
        <div class="col p-5 rounded-end">
          <h2 class="fw-bold text-center py-5">Pojištení štestí</h2>
          <!--LOGIN-->
          <form action="formular.php" method="post">          
            <div class="mb-4">
              <label for="email" class="form-label">Váš email</label>
              <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-4">
              <label for="password" class="form-label">Heslo</label>
              <input type="password" class="form-control" name="heslo">
            </div>

            <?php
                if (isset($zprava)) echo('<p>' . $zprava . '</p>');
            ?>
            <div class="d-grid">
              <button type="submit" name="odeslat" class="btn btn-primary">ODESLAT</button>
            </div>
            <div class="my-3">
              <span>Nemáte účet? <a href="regformular.php">Registrujte se zde.</a></span>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
    
      <!--JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>    
   
  