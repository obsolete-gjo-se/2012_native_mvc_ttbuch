<?php
require_once '../../application/bootstrap.php';

$dbh = new entities\person\Person();


try {
    $showAllPerson = $dbh->showAllPerson();
    $zeile = $showAllPerson->fetchObject();
    
    if(isset($_POST['insert'])) {

        $dbh->createPerson();
    }
    
    require_once '../../application/includes/header.php';
    require_once '../../application/includes/navigation.php';
} 
catch (error\myException $e) {
    echo $e->myMessage();
}
?>

<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
  <table border="1">
    <tr>
      <td>ID</td>
      <td>Vorname</td>
      <td>Nachname</td>
      <td>Geb.Datum</td>
      <td>Größe in cm</td>
      <td>Geschlecht</td>
      <td>Gewicht in kg</td>
      <td>Aktion</td>
    </tr>
    <tr>
      <td>einfügen / ändern</td>
      <td><input type="text" name="vorname" value=""></input></td>
      <td><input type="text" name="nachname" value=""></input></td>
      <td><input type="text" name="gebDatum" value=""></input></td>
      <td><input type="text" name="groesse" value=""></input></td>
      <td><input type="text" name="geschlecht" value=""></input></td>
      <td><input type="text" name="gewicht" value=""></input></td>
      <td><input type="submit" name="insert" value="Einfügen"></input></td>
    </tr>
        <?php
            while ($zeile) {
            
                echo "<tr><td>" . $zeile->id . "</td>";
                echo "<td>" . $zeile->vorname . "</td>";
                echo "<td>" . $zeile->nachname . "</td>";
                echo "<td>" . $zeile->gebDatum . "</td>";
                echo "<td>" . $zeile->groesse . "</td>";
                echo "<td>" . $zeile->geschlecht . "</td>";
                echo "<td>" . $zeile->gewicht . "</td>";
                echo "<td><a href=\"person/person_update.php?id=" . $zeile->id . "\">Update</a>
                          <a href=\"person/person_delete.php?id=" . $zeile->id . "\">Delete</a>
                     </td></tr>";
                
                $zeile = $showAllPerson->fetchObject(); 
            }
        ?>
  </table>
</form>

<?php require_once '../../application/includes/footer.php';?>