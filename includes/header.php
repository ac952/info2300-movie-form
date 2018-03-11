<header>
  <h1 id="title"></h1>
  <nav id="menu">
    <ul>
      <?php
      foreach($pages as $i => $value) {
        if ($current_page_id == $i) {
          $id =  "id='current_page'";
        } else {
          $id = "";
        }
        echo "<li><a ". $id. " href='". $i. ".php'>$value</a></li>";
      }
      ?>
      <!-- <form> -->
        <!-- <div id="search">
          <input type="search">
          <button>SEARCH</button>
        </div> -->
      <!-- </form> -->
    </ul>
  </nav>
</header>
