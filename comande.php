<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="comandestyle.css">    
</head>
<body>
    <div class="grid-container">
        <div class="item1">username</div>

        <div class="item2">COMANDE</div>

        <div class = "item3">
        <form action="comande.php" method ='post'>
        <select name="filtro">
        <option value="">-SELEZIONA-</option>
        <option value="1">ATTIVE</option>
        <option value="0">CONCLUSE</option>
        <option value="">TUTTE</option>
        </select>
         <input type="submit" value="Submit" />
        </form>
        </div>

        <div class = "item5"><button>AGGIUNGI</button></div>

        <div class="item4">
        <?php
        include 'collegamenti.php'; 
        echo "<table>"; 
        echo "<tr><th>ID_COMANDA</th><th>N_TAVOLO</th><th>ID_CAMERIERE</th><th>STATO</th><th>DATA</th><th>ORA</th><th>DETTAGLIO</th></tr>";
        $sql = "SELECT id_comanda, n_tavolo, id_cameriere, stato, data , time_format(ora,'%H %i %s') as ora FROM comanda WHERE true ";
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if ($_POST['filtro'] != '')
            {
                $sql .="AND stato=".$_POST['filtro'] ;
            }
        }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

     while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row["id_comanda"]."</td>";
    echo "<td>".$row["n_tavolo"]."</td>";
    echo "<td>".$row["id_cameriere"]."</td>";
    if ($row["stato"] == 1)
    {
        echo "<td><button class ='buttontrue'></button></td>";
    }   else if ($row["stato"] == 0)
    {
        echo "<td><button class ='buttonfalse'></button></td>";
    }
    echo "<td>".$row["data"]."</td>";
    echo "<td>".$row["ora"]."</td>";
    echo "<form action='dettaglio.php' method='post'>";
    echo "<input hidden type='int' name='id_comanda' value='". $row["id_comanda"]."'>";
    echo "<td><input  type='submit'  value='VEDI 🔍'></td>";
    echo "</tr>";
    echo "</form>";
    }
    } 
      ?>
    </div> 


    </div>
</body>
</html>