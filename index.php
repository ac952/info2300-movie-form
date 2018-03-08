<!DOCTYPE html>
<html>

<head>
  <?php
  include("includes/init.php");

  $current_page_id = "index";

  $db = new PDO('sqlite:movie.sqlite');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // GET DB RECORDS
  function get_db_records($db, $sql, $params){
    $query = $db->prepare($sql);
    if($query and $query -> execute($params)) {
      $records = $query->fetchAll();
      return $records;
    }
    return NULL;
  }

  if (isset($_GET['movie'])) {
    $movie = filter_input(INPUT_GET, 'movie', FILTER_SANITIZE_STRING);
  } else {
    // No search provided, so set the product to query to NULL
    $movie = NULL;
  }

  function getRecord($movie){
        global $db;
        $sql = "SELECT * FROM movies;";
        $params = array();
        $records = get_db_records($db, $sql, $params);
        foreach($records as $record) {
            echo "<tr><td>" . htmlspecialchars($record["movie_img"]) . "</td>\n";
            echo "<td>" . htmlspecialchars($record["title"]) . "</td>\n";
            echo "<td>" . htmlspecialchars($record["genre"]) . "</td>\n";
            echo "<td>" . htmlspecialchars($record["reviews"]) . "</td>\n";
            echo "<td>" . htmlspecialchars($record["ratings"]) . "</td></tr>\n";
      }
    }

  ?>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="style/all.css" media = "all"/>
  <title>Project 2</title>
</head>

<body>
  <!-- https://www.stockunlimited.com/vector-illustration/cinema-background-with-movie-objects_1823382.html -->
  <?php include("includes/header.php");?>
  <img src="images/background.jpg">
  <table>
      <tr>
        <th>Movie Image</th>
        <th>Movie Title</th>
        <th>Genre</th>
        <th>Reviews</th>
        <th>Ratings</th>
      </tr>
      <tr>
        <?php
        echo getRecord($movie);
        ?>
      </tr>
    </table>

</body>
</html>
