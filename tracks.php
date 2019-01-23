
<!--PDO: php data object-->
<?php
   $pdo = new PDO('sqlite:chinook.db');
   $sql ="
   SELECT
     tracks.Name as name,
     albums.Title as title,
     artists.Name as artist,
     tracks.UnitPrice as price
  FROM tracks
  INNER JOIN albums
  ON tracks.AlbumId = albums.AlbumId
  INNER JOIN artists
  ON albums.ArtistId = artists.ArtistId
  INNER JOIN genres
  ON tracks.GenreId = genres.GenreId
   ";
   // $_GET allows to pull query string data
   if (isset($_GET['genre'])){
     $sql = $sql . ' WHERE genres.Name = ?';
   }
   $statement = $pdo->prepare($sql);
   if (isset($_GET['genre'])){
     $statement->bindParam(1, $_GET['genre']);
   }

   $statement->execute();
   //$invoices = $statement ->fetchAll();
   //var_dump($invoices);
   //echo $invoices[0]['InvoiceDate'];
   $tracks = $statement ->fetchAll(PDO::FETCH_OBJ);
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
        <th>Track Name</th>
        <th>Title</th>
        <th>Artist</th>
        <th>Price</th>
      </tr>
      <?php foreach($tracks as $track) : ?>
        <tr>
          <td>
            <?php echo $track->name ?>
          </td>
          <td>
            <?php echo $track->title ?>
          </td>
          <td>
            <?php echo $track->artist ?>
          </td>
          <td>
            <?php echo $track->price ?>
          </td>
        </tr>
      <?php endforeach ?>
    </table>
  </body>
</html>
