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

if(isset($_POST['submit']))
{
    $pripojeni = mysqli_connect('localhost', 'root','', 'pojisteni_stesti');
    if(!$pripojeni)
    {
        echo "neco je špatně";
    }
    
    $a = $_POST['jmeno']; 
    $b = $_POST['prijmeni'];
    $c = $_POST['mesto'];
    $d = $_POST['ulice'];
    $e = $_POST['psc'];
    $f = $_POST['pojistka'];

    $query = "UPDATE pojisteni 
    SET jmeno = '$a', prijmeni = '$b', mesto = '$c', ulice = '$d', psc = '$e', pojistka = '$f'
    WHERE ID = $id";
    
    $odeslani = mysqli_query($pripojeni,$query);
    
    if(!$odeslani)
    {
        die("Neco se pokazilo");
    }
}

?>


<style>
      body{
        background: #ffe259;
        background: linear-gradient(to right, #e4a76a,#b69c1b );

      }
      .bg{
        background-image: url(image/g.jpg);
        background-position: center center ;
      }
    </style>

<!--NAVIGACE-->
<?php include "navigace.php"; ?>
 <!--FORMULAR-->
    <!--První sloupec-->
    <div class="container w-75 bg-white mt-5 shadow">
      <div class="row align-items-lg-stretch">
        <div class="col bg d-none d-lg-block">

        </div>
        
        <!--Druhý sloupec-->
        
<div class="col p-5 rounded-end">
          <h2 class="fw-bold text-center py-5">Formulář pro změnu</h2>
          <!--Formulář-->
    <div class="container">
    <form class="row g-3 needs-validation"  action="" method="post">
    <div class="col-md-7">
        <label for="validationCustom01" class="form-label">POJISTKA</label>
        <input type="text" class="form-control" id="validationCustom01" value="<?= $data['pojistka']?>" required name="pojistka">
    </div>
    
    <div class="col-md-7">
        <label for="validationCustom01" class="form-label">JMÉNO</label>
        <input type="text" class="form-control" id="validationCustom01" value="<?= $data['jmeno']?>" required name="jmeno">
    </div>
    <br />

    <div class="col-md-7">
        <label for="validationCustom02" class="form-label">PŘIJMENÍ</label>
        <input type="text" class="form-control" id="validationCustom02" value="<?= $data['prijmeni']?>" required name="prijmeni">
    </div>
  
    <div class="col-md-7">
        <label for="validationCustom03" class="form-label">MĚSTO</label>
        <input type="text" class="form-control" id="validationCustom03" value="<?=$data['mesto']?>" required name="mesto">
    </div>

    <div class="col-md-7">
        <label for="validationCustom05" class="form-label">ULICE</label>
        <input type="text" class="form-control" id="validationCustom05" value="<?= $data['ulice']?>"required name="ulice">      
    </div>

    <div class="col-7">
        <label for="validationCustom05" class="form-label">PSČ</label>
        <input type="text" class="form-control" id="inputAddress"value="<?= $data['psc']?>" placeholder="" name="psc">
    </div>         
</div>
<br/>
    <div class="col-7">
        <button class="btn btn-primary" type="submit" name = "submit" value = "ODESLAT">ZMĚNIT</button>
    </div>
    <div>
    <?php
            if(isset($_POST['submit']))
            {
                echo "Záznam uložen";
            }
    ?>
    </div>

<div class="container">
        <div class="d-grid gap-2 d-md-flex      
                        justify-content-md-center">
                    <div class="col-3 ">
                    <a href="administrace.php"><button type="button" class="btn btn-success btn-lg">ZPĚT</button>
                    </div> 
</div>
        
    <!--JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>