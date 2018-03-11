
  <?php
  include("includes/init.php");

  $current_page_id = "add";

  $db = new PDO('sqlite:film.sqlite');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function exec_sql_query($db, $sql, $params) {
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      return $query;
    }
    return NULL;
  }

$messages = array();
  // Get the list of shoes from the database.
$movies = exec_sql_query($db, "SELECT DISTINCT title FROM films", NULL)->fetchAll(PDO::FETCH_COLUMN);

if (isset($_POST["submit_insert"])) {
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
  $actors = filter_input(INPUT_POST, 'actors', FILTER_SANITIZE_STRING);
  $reviews = filter_input(INPUT_POST, 'reviews', FILTER_VALIDATE_INT);
  $ratings = filter_input(INPUT_POST, 'ratings', FILTER_SANITIZE_STRING);

  $invalid_review = FALSE;
  if ( $reviews < 1 or $reviews > 5 ) {
    $invalid_review = TRUE;
  }

  if (in_array($ratings, $movies) ) {
    $invalid_review = TRUE;
  }

  if ($invalid_review) {
    array_push($messages, "Failed to add review. Invalid product or rating.");
  } else {
    // array_push($messages, "Your review has been recorded. Thank you!");
    $sql = "INSERT INTO films (title, genre, actors, reviews, ratings) VALUES (:title, :genre, :actors, :reviews, :ratings)";
    $params = array(
      ':title' => $title,
      ':genre' => $genre,
      ':actors' => $actors,
      ':reviews' => $reviews,
      ':ratings' => $ratings
    );

    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      array_push($messages, "Your review has been recorded. Thank you!");
    } else {
      array_push($messages, "Failed to add review.");
    }

  }
}

function getRecord($record) {
  ?>
  <tr>
    <td><?php echo htmlspecialchars($record["title"]);?></td>
    <td><?php echo htmlspecialchars($record["genre"]);?></td>
    <td><?php echo htmlspecialchars($record["actors"]);?></td>
    <td><?php echo htmlspecialchars($record["reviews"]);?></td>
    <td><?php echo htmlspecialchars($record["ratings"]);?></td>
  </tr>
  <?php
}
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="style/all.css" media = "all"/>
  <title>Project 2</title>
</head>

<body id="add">
  <?php include("includes/header.php");?>
  <h1>Add A Movie!</h1>

  <?php
  // Write out any messages to the user.
  foreach ($messages as $message) {
    echo "<p id='reviewsuccess'><strong>" . htmlspecialchars($message) . "</strong></p>\n";
  }
  ?>

  <!-- FORM ACTION TO INDEX?????????????????????????????????????? -->
  <form id="addform" action="add.php" method="post">
    <p>Movie Title:
    <input type="text" name="title" required></p>
    <p>Genre:
    <input type="text" name="genre" required></p>
    <p>Actors:
    <input type="text" name="actors" required></p>
    <p>Reviews:</p>
      <div id="reviews">
        <input type="radio" name="reviews" value="1" checked> 1 star<br>
        <input type="radio" name="reviews" value="2"> 2 stars<br>
        <input type="radio" name="reviews" value="3"> 3 stars<br>
        <input type="radio" name="reviews" value="4"> 4 stars<br>
        <input type="radio" name="reviews" value="5"> 5 stars
      </div>
    <p>Ratings:
      <select name="ratings">
        <option value="pg13">PG-13</option>
        <option value="pg">PG</option>
        <option value="g">G</option>
        <option value="r">R</option>
      </select>
    </p>
    <button id="button" name="submit_insert" type="submit">Submit</button>
  </form>
<!-- https://www.123rf.com/photo_22401778_popcorn-in-cardboard-box-with-ticket-cinema-with-gradient-mesh-vector-illustration.html -->
  <div>
    <img id="popcornimg" src="images/popcorn.jpg">
  </div>
</body>
</html>
