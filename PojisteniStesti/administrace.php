<?php
session_start();
require_once('Db.php');
// Spojení do databáze//
$pripojeni = mysqli_connect('localhost', 'root','', 'pojisteni_stesti');
$email = $_SESSION['email'];

$sgl="SELECT * FROM pojisteni WHERE admin ='$email'" ;
$result=$pripojeni->query($sgl);

if (!isset($_SESSION['id']))
{
    header('Location: formular.php');
    exit();
}

if (isset($_GET['odhlasit']))
{
    session_destroy();
    header('Location: formular.php');
    exit();
}


?>
<!--NAVIGACE-->
<?php include "navigace.php"; ?>
<style>
      body{
        background: #ffe259;
        background: linear-gradient(to right, #e4a76a,#b69c1b );

      }
      .bg{
        background-image: url(image/f.jpg);
        background-position: center center ;
      }
    </style>
<body>
    <!--První sloupec-->
    <div class="container w-75 bg-white mt-5 shadow">
      <div class="row align-items-lg-stretch">
        <div class="col bg d-none d-lg-block">

        </div>
        
        <!--Druhý sloupec-->
        <div class="col p-5 rounded-end">
          <h2 class="fw-bold text-center py-5">Vítejte na vaši osobní stránce pojištení ŠTESTÍ</h2>
          <p>Vítejte v administraci, zde najdete vše podstatné o vašem štěstí. </p>
          <h4><a>Seznam vašeho  štěstí</a></h4>


          <div class="container">
            <table class="table table-striped table-borderrer">
              <tr>
                <!--<th>ID</th>-->
                <th>Jmeno</th>
                <th>Příjmení</th>
                <!--<th>Město</th>-->
                <!--<th>Ulice</th>-->
                <!--<th>psc</th>-->
                <th>Pojistka</th>
                <th> </th>
              </tr>
              <?php
              if($result->num_rows >0)
              {
                while($rew = $result->fetch_assoc())
                {
                  echo "<tr>";
                  //echo "<td>". $rew['ID']."</td>";
                  echo "<td>". $rew['jmeno']."</td>";
                  echo "<td>". $rew['prijmeni']."</td>";
                  //echo "<td>". $rew['mesto']."</td>";
                  //echo "<td>". $rew['ulice']."</td>";
                  //echo "<td>". $rew['psc']."</td>";
                  echo "<td>". $rew['pojistka']."</td>";
                  echo "<td>
                          <div class='btn-group'>
                          <a class='btn btn-info' href = 'view.php?ID=".$rew['ID']."'>Zobrazit</a>
                          <div class='btn-group'>
                          <a class='btn btn-warning' href = 'zmenformular.php?ID=".$rew['ID']."'>Upravit</a>
                          <a class='btn btn-danger' href = 'delete.php?ID=".$rew['ID']."' >Vymazat</a>
                        </td>";
                  echo "</tr>";
                }
              }
              ?>
            </table>


            <div class="container mt-1">
        <div id="centrovac">
            <div class="c">
                <div class="container">
                    <div class="d-grid gap-2 d-md-flex      
                            justify-content-md-center">
                        <div class="col-9">
                        <a href="vlozenipojisky.php"><button type="button" class="btn btn-success btn-lg">VYTVOŘIT NOVÉ ŠTĚSTÍ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </br>
        <div class="d-grid gap-2 d-md-flex        justify-content-md-center">
        <div class="col-4">
                <a href="administrace.php?odhlasit"><button type="button" class="btn btn-primary btn-lg">ODHLÁSIT</button>
        </div>  
    </div>

          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="d-grid gap-2 d-md-flex        justify-content-md-center">      
    </div>
</body>
</html>