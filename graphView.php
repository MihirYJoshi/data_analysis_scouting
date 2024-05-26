<title>Graph View</title>
<html lang="en">

<?php include('navbar.php');?>


<body class="bg-body">
    <div class="container row-offcanvas row-offcanvas-left">
        <div class="well column col-lg-12 col-sm-12 col-xs-12" id="content">
  
            <div class="row">

              <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
                <div class="card mb-3 mt-3">
                  <div class="card-header" id="chartHeader">
                  </div>
                  <div class="card-body">
                    <canvas id="dataChart"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-sm-12 col-xs-12 gx-3">
                <div class="card mb-3 mt-3">
                  <div class="card-body">
                    <div class="mb-3">
                      <label for="selectXAxis" class="form-label">X Axis</label>
                      <select class="form-select graphSelect" id="selectXAxis" aria-label="Graph X Axis">
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="selectYAxis" class="form-label">Y Axis</label>
                      <select class="form-select graphSelect" id="selectYAxis" aria-label="Graph Y Axis">
                      </select>
                    </div>
                  </div>
                </div>
              </div>

            </div>

        </div>
    </div>
</body>

<?php include("footer.php"); ?>
<script type="text/javascript" src="js/charts.js"></script>
<script type="text/javascript" src="js/matchDataProcessor.js?"></script>

<script>
 var teamData = null;
 var dataChart = null;

  function addSelectOptions(){
    var firstTeam = null;
    for (const team in teamData){
      firstTeam = team;
      break;
    }
    for(const key in teamData[firstTeam]){
      $('#selectXAxis').append($(new Option(key, key)));
      $('#selectYAxis').append($(new Option(key, key)));
    }
  }
  
  function generateRandomColor() {
    var hue = 70 + Math.floor(Math.random() * 150); // Random hue
    var saturation = 70 + Math.random() * 120; // Random saturation between 70 and 100
    var lightness = 70 + Math.random() * 150; // Random lightness between 50 and 60
    return 'rgba(' + hue + ', ' + saturation + ', ' + lightness + ', ' + 0.75 + ')';
  }
  function generateRandomBorder() {
    var hue = 70 + Math.floor(Math.random() * 150); // Random hue
    var saturation = 70 + Math.random() * 120; // Random saturation between 70 and 100
    var lightness = 70 + Math.random() * 150; // Random lightness between 50 and 60
    return 'rgba(' + hue + ', ' + saturation + ', ' + lightness + ', ' + 1 + ')';
  }

  function getTeamScatterDatasets(xLabel, yLabel){
    var data = {};
    data['datasets'] = [];
    for (const team in teamData){
      var scatterData = {};
      scatterData['label'] = team;
      scatterData['data'] = [{'x': teamData[team][xLabel], 'y': teamData[team][yLabel]}];
      if (team == "3647"){
        scatterData['backgroundColor'] = 'rgba(255, 0, 0, 0.85)';
        scatterData['borderColor'] = 'rgba(0, 0, 0, 1)';
        scatterData['borderWidth'] = 3;
      }else{
        scatterData['backgroundColor'] = generateRandomColor();
        scatterData['borderColor'] = generateRandomBorder();
        scatterData['borderWidth'] = 1;
      }
      data['datasets'].push(scatterData);
    }
    return data;
  }


  function drawChart(xLabel, yLabel){
    if (dataChart != null){
      dataChart.destroy();
    }
    $('#chartHeader').html(`${xLabel} / ${yLabel}`);
    var ctx = document.getElementById('dataChart');
    var teamDatasets = getTeamScatterDatasets(xLabel, yLabel);

    dataChart = new Chart(ctx, {
      type: 'scatter',
      data: teamDatasets,
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: `${xLabel} / ${yLabel}`,
          }
        },
        elements: {
          point: {
            radius: 7,
            hoverRadius: 8
          }
        },
        scales: {
          y: {
            title: {
              display: true,
              text: yLabel
            },
          },
          x: {
            title: {
              display: true,
              text: xLabel
            },
          }
        }
      }
    });

  }

  function calculateMatchAverage(matches, func){
    var out = 0;
    for (var i = 0; i != matches.length; i++){
      out += func(matches[i]);
    }
    return out/matches.length;
  }

  function calculateMatchMax(matches, func){
    var out = 0;
    for (var i = 0; i != matches.length; i++){
      out = Math.max(func(matches[i]), out);
    }
    return out;
  }

  function getMatchAutoPlusEndgamePoints(row){
    return getMatchPointsAuto(row) + getTeleopChargeStationPoints(row);
  }

  function matchDataToTeamData(matchData){
    var teamMatchDataLookup = {};
    for (var i = 0; i != matchData.length; i++){
      var team = matchData[i]['teamNumber'];
      if (! (team in teamMatchDataLookup)){
        teamMatchDataLookup[team] = [];
      }
      teamMatchDataLookup[team].push(matchData[i]);
    }

    var teamToData = {};
    for (const team in teamMatchDataLookup){
      var matches = teamMatchDataLookup[team];
      teamToData[team] = {};
      teamToData[team]['Avg Amp Notes Auto'] = calculateMatchAverage(matches, getAmpAuto);
      teamToData[team]['Avg Speaker Notes Auto'] = calculateMatchAverage(matches, getSpeakerAuto);
      teamToData[team]['Avg Auto Pieces'] = calculateMatchAverage(matches, getAutoPieces);
      teamToData[team]['Avg Amp Notes Teleop'] = calculateMatchAverage(matches, getAmpTeleop);
      teamToData[team]['Avg Sepaker Notes Teleop'] = calculateMatchAverage(matches, getSpeakerTeleop);
      teamToData[team]['Avg Shuttle Notes Teleop'] = calculateMatchAverage(matches, getShuttleTeleop);
      teamToData[team]['Avg Speaker Notes Teleop'] = calculateMatchAverage(matches, getTotalSpeakerTeleop);
      teamToData[team]['Avg Teleop Pieces'] = calculateMatchAverage(matches, getTeleopPieces);
      teamToData[team]['Avg Teleop Pieces With Shuttle'] = calculateMatchAverage(matches, getTeleopPiecesWithShuttle);
      teamToData[team]['Avg Trap'] = calculateMatchAverage(matches, getAllTrap);
      teamToData[team]['Avg Total Notes'] = calculateMatchAverage(matches, getNotes);
      teamToData[team]['Avg Climb Points'] = calculateMatchAverage(matches, getTeleopClimbPoints);
      teamToData[team]['Avg Weighted Score'] = calculateMatchAverage(matches, getWeightedScoreFirst);


      teamToData[team]['Max Amp Notes Auto'] = calculateMatchMax(matches, getAmpAuto)
      teamToData[team]['Max Speaker Notes Auto'] = calculateMatchMax(matches, getSpeakerAuto)
      teamToData[team]['Max Auto Pieces'] = calculateMatchMax(matches, getAutoPieces);   
      teamToData[team]['Max Amp Notes Teleop'] = calculateMatchMax(matches, getAmpTeleop)
      teamToData[team]['Max Sepaker Notes Teleop'] = calculateMatchMax(matches, getSpeakerTeleop)
      teamToData[team]['Max Shuttle Notes Teleop'] = calculateMatchMax(matches, getShuttleTeleop)
      teamToData[team]['Max Speaker Notes Teleop'] = calculateMatchMax(matches, getSpeakerTeleop)
      teamToData[team]['Max Teleop Pieces'] = calculateMatchMax(matches, getTeleopPieces);   
      teamToData[team]['Max Teleop Pieces With Shuttle'] = calculateMatchMax(matches, getTeleopPiecesWithShuttle);
      teamToData[team]['Max Trap'] = calculateMatchMax(matches, getAllTrap)
      teamToData[team]['Max Total Notes'] = calculateMatchMax(matches, getNotes)
      teamToData[team]['Max Climb Points'] = calculateMatchMax(matches, getTeleopClimbPoints)
      teamToData[team]['Max Weighted Score'] = calculateMatchMax(matches, getWeightedScoreFirst);
    }
    return teamToData;
  }

  function initiallyLoadGraph(){
    var xTitle = 'Avg Teleop Pieces';
    var yTitle = 'Avg Auto Pieces';
    $('#selectXAxis').val(xTitle);
    $('#selectYAxis').val(yTitle);
    drawChart(xTitle, yTitle);
  }

  function loadTeamData(teamNumber){
    $.get('readAPI.php', {
      'readAllMatchData': true
    }).done(function(data) {
      matchData = JSON.parse(data);
      teamData = matchDataToTeamData(matchData);
      addSelectOptions();
      initiallyLoadGraph();
    });
  }

  $(document).ready(function () {
    loadTeamData();
  });

  $('.graphSelect').change(function (){
    var xAxis = $('#selectXAxis').val();
    var yAxis = $('#selectYAxis').val();
    drawChart(xAxis, yAxis);
  });


</script>
</html>