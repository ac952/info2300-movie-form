<!DOCTYPE html>
<html>

<head>
  <?php
  include("includes/init.php");

  $current_page_id = "add";
  ?>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="style/all.css" media = "all"/>
  <title>Project 2</title>
</head>

<body>
  <?php include("includes/header.php");?>
  <h1>Add A Movie!</h1>
  <form>
    <p>Movie Image:
    <input type="text" name="image"></p>
    <p>Movie Title:
    <input type="text" name="title"></p>
    <p>Genre:
    <input type="text" name="genre"></p>
    <p>Reviews:</p>
      <div id="reviews">
        <input type="radio" name="stars" value="1"> 1 star<br>
        <input type="radio" name="stars" value="2"> 2 stars<br>
        <input type="radio" name="stars" value="3"> 3 stars<br>
        <input type="radio" name="stars" value="4"> 4 stars<br>
        <input type="radio" name="stars" value="5"> 5 stars
      </div>
    <p>Ratings:
      <select name="ratings">
        <option value="pg13">PG-13</option>
        <option value="pg">PG</option>
        <option value="g">G</option>
        <option value="r">R</option>
      </select>
    </p>
    <input type="submit" value="Submit">
  </form>
<!-- https://www.123rf.com/photo_22401778_popcorn-in-cardboard-box-with-ticket-cinema-with-gradient-mesh-vector-illustration.html -->
  <div>
    <img id="popcornimg" src="images/popcorn.jpg">
  </div>
</body>
</html>
