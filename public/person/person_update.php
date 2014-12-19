<?php
require_once '../../application/bootstrap.php';

$dbh = new entities\person\Person();

try {
    $selectForUpdate = $dbh->selectForUpdatePerson();
    $zeile = $selectForUpdate->fetchObject();
    
    if (isset($_POST['update'])){
    
        $dbh->updatePerson();
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
        <?php while ($zeile):?>
        <td><?php echo $zeile->id;?><input type="hidden" name="id" value="<?php echo $zeile->id;?>"></input></td>
        <td><input type="text" name="vorname" value="<?php echo $zeile->vorname;?>"></input></td>
        <td><input type="text" name="nachname" value="<?php echo $zeile->nachname;?>"></input></td>
        <td><input type="text" name="gebDatum" value="<?php echo $zeile->gebDatum;?>"></input></td>
        <td><input type="text" name="groesse" value="<?php echo $zeile->groesse;?>"></input></td>
        <td><input type="text" name="geschlecht" value="<?php echo $zeile->geschlecht;?>"></input></td>
        <td><input type="text" name="gewicht" value="<?php echo $zeile->gewicht;?>"></input></td>
        <td><input type="submit" name="update" value="Ändern"></td>
        <?php $zeile = $selectForUpdate->fetchObject()?>
        <?php endwhile;?>
      </tr>                
    </table>
  </form>

<?php  require_once '../../application/includes/footer.php';?>