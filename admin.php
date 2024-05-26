<title>Admin</title>
<html lang="en">

<?php include('navbar.php'); ?>

<body class="bg-body">
  <div class="container row-offcanvas row-offcanvas-left">
    <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
      
        <!-- Left column -->
        <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
          <div class="card">
            <div class="card-header">Status</div>
            <div class="card-body">
              <h4>SQL Server Status: <span id="serverStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>Database Status: <span id="databaseStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>Data Table Status: <span id="dataTableStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>TBA Table Status: <span id="tbaTableStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>Pit Table Status: <span id="pitTableStatus" class="badge bg-warning">Not Connected</span></h4>
			  <h4>Strike Table Status: <span id="strikeTableStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>LS Table Status: <span id="LSTableStatus" class="badge bg-warning">Not Connected</span></h4>
              <h4>Server: <span id="serverName" class="badge bg-primary">????</span></h4>
              <h4>Database: <span id="databaseName" class="badge bg-primary">????</span></h4>
              <h4>Username: <span id="userName" class="badge bg-primary">????</span></h4>
              <h4>Team Number: <span id="teamNumber" class="badge bg-primary">????</span></h4>
              <h4>TBA Key: <span id="tbaKey" class="badge bg-primary">????</span></h4>
              <h4>Event Code: <span id="eventCode" class="badge bg-primary">????</span></h4>
              <h4>Data Table: <span id="dataTableName" class="badge bg-primary">????</span></h4>
              <h4>TBA Table: <span id="tbaTableName" class="badge bg-primary">????</span></h4>
              <h4>Pit Scout Table: <span id="pitTableName" class="badge bg-primary">????</span></h4>
			  <h4>Strike Scout Table: <span id="strikeTableName" class="badge bg-primary">????</span></h4>
              <h4>LS Table: <span id="LSTableName" class="badge bg-primary">????</span></h4>
            </div>
          </div>
        </div>
        
        <!-- Left column -->
        <div class="col-lg-6 col-sm-6 col-xs-6 gx-3">
          <div class="card">
            <div class="card-header">Configuration</div>
            <div class="card-body">
              <div class="mb-3">
                <label for="writeServer" class="form-label"> MySQL Server URL</label>
                <input type="text" class="form-control" id="writeServer" aria-describedby="serverName">
              </div>
              <div class="mb-3">
                <label for="writeDatabase" class="form-label">Database Name</label>
                <input type="text" class="form-control" id="writeDatabase" aria-describedby="databaseName">
              </div>
              <div class="mb-3">
                <label for="writeDataTable" class="form-label">Data Table Name</label>
                <input type="text" class="form-control" id="writeDataTable" aria-describedby="writeTableName">
              </div>
              <div class="mb-3">
                <label for="writeTBATable" class="form-label">TBA Table Name</label>
                <input type="text" class="form-control" id="writeTBATable" aria-describedby="writeTBATable">
              </div>
              <div class="mb-3">
                <label for="writePitTable" class="form-label">Pit Scout Table Name</label>
                <input type="text" class="form-control" id="writePitTable" aria-describedby="writePitTable">
              </div>
			  <div class="mb-3">
                <label for="writeStrikeTable" class="form-label">Strike Scout Table Name</label>
                <input type="text" class="form-control" id="writeStrikeTable" aria-describedby="writeStrikeTable">
              </div>
              <div class="mb-3">
                <label for="writeLSTable" class="form-label">LS Table Name</label>
                <input type="text" class="form-control" id="writeLSTable" aria-describedby="writeLSTable">
              </div>
              <div class="mb-3">
                <label for="writeUsername" class="form-label">User Name</label>
                <input type="text" class="form-control" id="writeUsername" aria-describedby="userName">
              </div>
              <div class="mb-3">
                <label for="writePassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="writePassword" aria-describedby="password">
              </div>
              <div class="mb-3">
                <label for="writeTeamNumber" class="form-label">Team Number</label>
                <input type="text" class="form-control" id="writeTeamNumber" aria-describedby="writeTeamNumber">
              </div>
              <div class="mb-3">
                <label for="writeTBAKey" class="form-label">TBA Key</label>
                <input type="text" class="form-control" id="writeTBAKey" aria-describedby="tbaKey">
              </div>
              <div class="mb-3">
                <label for="writeEventCode" class="form-label">Event Code</label>
                <input type="text" class="form-control" id="writeEventCode" aria-describedby="tbaEventCode">
              </div>
              
              <button id="writeConfig" class="btn btn-primary">Write Config</button>
              <button id="createDB" class="btn btn-primary">Create DB</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<?php include("footer.php"); ?>

<script>
  function setStatusBadge(isSuccess, id) {
    if (isSuccess) {
      $("#" + id).text("Connected");
      $("#" + id).addClass("bg-success");
      $("#" + id).removeClass("bg-warning");
      $("#" + id).removeClass("bg-danger");
    } else {
      $("#" + id).text("Not Connected");
      $("#" + id).addClass("bg-danger");
      $("#" + id).removeClass("bg-warning");
      $("#" + id).removeClass("bg-success");
    }
  }
  
  function updateStatusValues(statusArray) {
    $("#serverName").text(statusArray["server"]);
    $("#databaseName").text(statusArray["db"]);
    $("#userName").text(statusArray["username"]);
    $("#teamNumber").text(statusArray["teamNumber"]);
    $("#tbaKey").text(statusArray["tbaKey"]);
    $("#eventCode").text(statusArray["eventCode"]);
    $("#dataTableName").text(statusArray["dataTable"]);
    $("#tbaTableName").text(statusArray["tbaTable"]);
    $("#pitTableName").text(statusArray["pitTable"]);
	  $("#strikeTableName").text(statusArray["strikeTable"]);
    $("#LSTableName").text(statusArray["LSTable"]);
    
    setStatusBadge(statusArray["dbExists"], "databaseStatus");
    setStatusBadge(statusArray["serverExists"], "serverStatus");
    setStatusBadge(statusArray["dataTableExists"], "dataTableStatus");
    setStatusBadge(statusArray["tbaTableExists"], "tbaTableStatus");
    setStatusBadge(statusArray["pitTableExists"], "pitTableStatus");
	setStatusBadge(statusArray["strikeTableExists"], "strikeTableStatus");
    setStatusBadge(statusArray["LSTableExists"], "LSTableStatus");
    
    console.log(statusArray);
  }
  
  function getWriteDataArray(){
    var allWriteData = {'server' : $('#writeServer').val(),
                        'db' : $('#writeDatabase').val(),
                        'username' : $('#writeUsername').val(),
                        'password' : $('#writePassword').val(),
                        'teamNumber' : $('#writeTeamNumber').val(),
                        'eventCode' : $('#writeEventCode').val(),
                        'tbaKey' : $('#writeTBAKey').val(),
                        'dataTable' : $('#writeDataTable').val(),
                        'tbaTable' : $('#writeTBATable').val(),
                        'pitTable' : $('#writePitTable').val(),
						            'strikeTable' : $('#writeStrikeTable').val(),
                        'LSTable' : $('#writeLSTable').val()};
    var writeData = {};
    for (const prop in allWriteData){
      if (allWriteData[prop] != ''){
        writeData[prop] = allWriteData[prop];
      }
    }
    return writeData;
  }
  
  $(document).ready(function() {
    // Load data from adminAPI.php.
    $.post("adminAPI.php", {
      "getConfig": true
    }, function(data) {
      console.log(data);
      updateStatusValues(JSON.parse(data));
    });
  });
  
  $("#createDB").on('click', function(event) {
    $.post("adminAPI.php", {
      "createDB": true
    }, function(data) {
      updateStatusValues(JSON.parse(data));
    });
  });
  
  $("#writeConfig").on('click', function(event) {
    var data = getWriteDataArray();
    if (Object.keys(data).length > 0){
      $.post("adminAPI.php", {
        "writeConfig": JSON.stringify(data)
      }, function(data) {
        updateStatusValues(JSON.parse(data));
      });
    }
  });
  
</script>

</html>