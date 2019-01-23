
<!--PDO: php data object-->
<?php
   $pdo = new PDO('sqlite:chinook.db');
   $sql ="
    SELECT * from genres;
   ";
   // $_GET allows to pull query string data

   $statement = $pdo->prepare($sql);
   $statement->execute();
   //$invoices = $statement ->fetchAll();
   //var_dump($invoices);
   //echo $invoices[0]['InvoiceDate'];
   $genres = $statement ->fetchAll(PDO::FETCH_OBJ);
  // var_dump($invoices);
//   echo $invoices[0]->InvoiceDate;
   //die();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Week2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  </head>
  <body>
    <table class="table">
      <tr>
        <th>Genre ID</th>
        <th>Genre Name</th>
      </tr>
      <?php foreach($genres as $genre) : ?>
        <tr>
          <td>
            <?php echo $genre->GenreId ?>
          </td>
          <td>
            <a href="tracks.php?genre=<?php echo urlencode($genre->Name) ?>"><?php echo $genre->Name ?></a>
          </td>
        </tr>
      <?php endforeach ?>
    </table>
  </body>
</html>
