<?php
include("includes/init.php");

$current_page_id = "index";

$db = new PDO('sqlite:film.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function exec_sql_query($db, $sql, $params){
  $query = $db->prepare($sql);
  if($query and $query -> execute($params)) {
    return $query;
  }
  return NULL;
}

$messages = array();

#search form
const SEARCH_FIELDS = [
  "title" => "By Title",
  "genre" => "By Genre",
  "actors" => "By Actors",
  "reviews" => "By Reviews",
  "ratings" => "By Ratings"
];

// check if search and category are empty or not
if (isset($_GET['search']) and isset($_GET['category'])) {
  $do_search = TRUE;
  $category = filter_input(INPUT_GET,'category', FILTER_SANITIZE_STRING);
  $search = filter_input(INPUT_GET,'search', FILTER_SANITIZE_STRING);
  $search = trim($search);
  if (in_array($category, array_keys(SEARCH_FIELDS))){
    $search_field = $category;
  } else {
    $search_field = NULL;
    array_push($messages, "Invalid category for search");
    $do_search = FALSE;
  }
} else {
  $do_search = FALSE;
  $category = NULL;
  $search = NULL;
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

<body>
  <!-- https://www.stockunlimited.com/vector-illustration/cinema-background-with-movie-objects_1823382.html -->
  <?php include("includes/header.php");?>
  <img src="images/background.jpg">

  <!-- search form -->
  <form id="searchForm" action="index.php" method="get">
    <select name="category">
      <option value="" selected disabled>Search By</option>
      <?php
      foreach(SEARCH_FIELDS as $field_name => $label){
        ?>
        <option value="<?php echo $field_name;?>"><?php echo $label;?></option>
        <?php
      }
      ?>
    </select>
    <input type="text" name="search"/>
    <button type="submit">Search</button>
  </form>

  <?php
  if($do_search) {
    ?>

    <h2 id="searchresult">Search Results</h2>

    <?php
    $sql = "SELECT * FROM films WHERE ".$search_field." LIKE '%' || :search || '%'";
    $params = array(':search' => $search);

  } else{

    $sql = "SELECT * FROM films";
    $params = array();
    ?>

    <?php
    $sql = "SELECT * FROM films";
    $params = array();
  }
  $records = exec_sql_query($db, $sql, $params)->fetchAll();
  if (isset($records) and !empty($records)) {
    ?>
    <table>
      <tr>
        <th>Movie Title</th>
        <th>Genre</th>
        <th>Actors</th>
        <th>Reviews (stars)</th>
        <th>Ratings</th>
      </tr>
      <?php
      foreach($records as $record) {
        getRecord($record);
      }
      ?>
    </table>
    <?php
  } else {
    echo "<p class = 'messages'>No reviews for that search.</p>";
  }
  ?>
</body>
</html>
