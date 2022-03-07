<?php
if(!isset($_GET['ID']))
{

    $id = $_GET['ID'];
    $pripojeni = mysqli_connect('localhost', 'root','', 'pojisteni_stesti');

    $sgl="DELETE FROM pojisteni
        WHERE ID = $id";

   if($pripojeni->query($sgl) === TRUE)
    {
        echo "delete to data";

    }
    else
    {
        echo "neco se pokazilo";
    }
      

}
?>

