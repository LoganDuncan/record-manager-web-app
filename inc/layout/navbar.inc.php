<?php // Filename: navbar.inc.php ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="display-records.php">Student Record Manager</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?=echoActiveClassIfRequestMatches("display-records");?>">
        <a class="nav-link" href="display-records.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?= echoActiveClassIfRequestMatches("create-record");?>">
        <a class="nav-link" href="create-record.php">Create Record</a>
      </li>
      <li class="nav-item <?= echoActiveClassIfRequestMatches("advanced-search");?>">
        <a class="nav-link" href="advanced-search.php">Advanced Search</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Resources
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="http://ctec.clark.edu/CTEC122">CTEC 122 Resources</a>
          <a class="dropdown-item" href="http://php.net">PHP.net</a>
          <a class="dropdown-item" href="https://getbootstrap.com">Bootstrap</a>
        </div>
      </li>
    </ul>
    <form action="search-records.php" method="POST" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>