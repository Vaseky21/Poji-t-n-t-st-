<?php
if(!isset($_GET['ID']))
{
    die('neco je špatně');
}

// Spojení do databáze//
$id = $_GET['ID'];
$pripojeni = mysqli_connect('localhost', 'root','', 'pojisteni_stesti');

$sgl="SELECT * FROM pojisteni WHERE ID = $id" ;
$result=$pripojeni->query($sgl);
if($result->num_rows != 1)
{
    die('není čislo ID');
}
$data = $result->fetch_assoc();  
?>
<!--NAVIGACE-->
<?php include "navigace.php"; ?>
<body>
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
    

    <div class="container w-75 bg-white mt-5 shadow">
      <div class="row align-items-lg-stretch">
        <div class="col p-5 rounded-end">
          <h2 class="fw-bold text-center py-5">Náhled Dohody</h2>
            <p>Jmeno a Příjmení pojištěnce: <?= $data['jmeno']?> <?= $data['prijmeni']?></p>
            <p>
            Adresa pojištěnce: <?= $data['ulice']?> <?= $data['mesto']?>
            </p>
            <p>
            PSČ pojištěnce: <?= $data['psc']?>
            </p>
            <p>
            Druch pojištění <?= $data['pojistka']?>
            </p>
            <p>
            Ujednání: <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo beatae et rerum ut accusamus officiis neque, praesentium sapiente pariatur ipsam quos blanditiis cupiditate harum voluptatum velit, sint itaque illum. Atque.</p>
            </p>
          </div>
            </div>
                <div class="d-grid gap-2 col-6 mx-auto py-2">
                <a href="administrace.php" class="btn d-grid gap-2 d-md-flex justify-content-md-center btn-primary">ZPĚT</a>   
                </div>
        </div>
    </br>
    <div>
</body>
