<?php include("header.php"); ?>

<nav class="navbar navbar-expand-lg custom-nav">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="images/Logo.png" height="40" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="matchForm.php">Match Form</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pit Scout Pages
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="pitInput.php">Pit Input</a>
            </li>
            <li>
              <a class="dropdown-item" href="pictureUpload.php">Picture Upload</a>
            </li>
            <li>
              <a class="dropdown-item" href="pitCheck.php">Pit Check</a>
            </li>
          </ul>
        </li>
		    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Strike Pages
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="strikeInput.php">Strike Scout</a>
            </li>
            <li>
              <a class="dropdown-item" href="strikeView.php">Strike View</a>
            </li>
          </ul>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" href="leadScoutForm.php">LS Input</a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link" href="qrScanner.php">QR Scanner</a>
        </li>
        

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Data Views
          </a>
          <ul class="dropdown-menu">
            <li class="nav-item">
              <a class="nav-link" href="rankings.php">Rankings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="teamData.php">Team Data</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="matchStrategy.php">Match Strategy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="graphView.php">Graph View</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="comparisons.php">Comparison</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="coprs.php">COPRS</a>
            </li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Raw Data
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="tableMatchData.php">Match Data</a>
            </li>
            <li>
              <a class="dropdown-item" href="pitData.php">Pit Data</a>
            </li>
              <a class="dropdown-item" href="strikeData.php">Strike Data</a>
            </li>
            <li>
              <a class="dropdown-item" href="leadScoutData.php">Lead Scout Data</a>
            </li>
          </ul>
        </li>
        <!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             Checks
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="dataValidate.php">Data Validation</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin</a>
        </li>
        -->
      </ul>
    </div>
  </div>
</nav>