//Comment Functions
function getProblematicCannedCommentMatchCount(data){
    var problematicComments = ['Tipped', 'Didn\'t Move', 'Broken', 'Did Not Show Up', 'Bumpers Fell Off'];
    var commentDict = getCannedCommentsDictionary(data);
    var matchList = [];
    for (var i = 0; i != problematicComments.length; i++){
        var comment = problematicComments[i];
        if (comment in commentDict){
            matchList = [...matchList, ...commentDict[comment]];
        }
    }
    var matchSet = new Set(matchList);
    return matchSet.size;
}
function getCannedCommentsDictionary(data) {
    /* Returns a mapping of comment to list of matches */
    var commentLookup = {};
    for (var i = 0; i != data.length; i++) {
        var row = data[i];
        if (row['cannedComments'] === '' || row['cannedComments'] == 0) {
            continue;
        }
        var cannedSplit = row['cannedComments'].split(',');
        for (var j = 0; j != cannedSplit.length; j++) {
            var comment = cannedSplit[j];
            if (!(comment in commentLookup)) {
                commentLookup[comment] = [];
            }
            commentLookup[comment].push(row['matchNumber']);
        }
    }
    return commentLookup;
}
function getWrittenComments(data) {
    var comments = [];
    for (var i = 0; i != data.length; i++) {
        var row = data[i];
        if (row['textComments'] === '') {
            continue;
        }
        comments.push(row['textComments']);
        comments.push("Match " + row['matchNumber'] + ": ");
    }
    return comments;
}
//Climb Functions
function getMobilityAuto(row) {
    return row['autoMobility'] === 1;
}
function getNotInStage(row) {
    return row['climb'] == 'NONE';
}
function getInStage(row) {
    return row['climb'] == 'PARKED';
}
function getClimb(row) {
    return row['climb'] == 'ONSTAGE';
}
function getTrappedWhileClimbed(row) {
    return row['climb'] == 'TRAP';
}
function getSpotlighted(row) {
    return row['climbSpotlighted'] === 1;
}
function getHarmony(row) {
    return row['climbHarmony'] === 1;
}
function getTeleopClimbPoints(row){
    var points = 0;
	if (getInStage(row)){
		return 1;
	}
	points += getClimb(row) ? 3 : 0;
	points += getTrappedWhileClimbed(row) ? 5 : 0;

	if (points == 0){
		return 0;
	}

	if((getHarmony(row)) && (getSpotlighted(row))){
		points+=3;
	}else if((getHarmony(row))){
		points+=2;
	}else if ((getSpotlighted(row))){
		points+=1;
	}
    return points;
}
//Auto Piece Functions

function getAmpAuto(row){
	return row['autoAmpNote'];
}
function getSpeakerAuto(row) {
	return row['autoSpeakerNote'];
}

//Teleop Piece Functions
function getAmpTeleop(row){
	return row['teleopAmpNote'];
}
function getSpeakerTeleop(row){
	return row['teleopSpeaker'];
}
function getShuttleTeleop(row){
	return row['teleopSpeakerAmplified'];
}
function getTotalSpeakerTeleop(row){
	return row['teleopSpeaker'];
}
function getTrapTeleop(row){
	return row['teleopTrap'];
}
function getAllTrap(row){
	var climb = getTrappedWhileClimbed(row) ? 1 : 0;
	return climb + getTrapTeleop(row);
}

//Piece Functions
function getAutoPieces(row){
	return (row['autoSpeakerNote'] + 
		row['autoAmpNote']);
}
function getTeleopPieces(row){
	return (row['teleopSpeaker'] + 
		row['teleopAmpNote'] + 
		row['teleopTrap']);
}
function getTeleopPiecesWithShuttle(row){
	return (row['teleopSpeaker'] + 
		row['teleopAmpNote'] + 
		row['teleopTrap']) + 
		row['teleopSpeakerAmplified'];
}
function getNotes(row){
	return getAutoPieces(row) + getTeleopPieces(row) + (getTrappedWhileClimbed(row) ? 1 : 0);
}
//Get Point Functions
function getMatchPointsAuto(row) {
	var points = 0;
	if (getMobilityAuto(row)) {
		points += 2;
	}
	points += 2 * getSpeakerAuto(row);
	points += 5 * getAmpAuto(row);
	return points;
}

function getMatchPointsTeleop(row) {
	var points = 0;
	
	points = getTeleopClimbPoints(row);

	points += 2 * getSpeakerTeleop(row);
	points += 1 * getAmpTeleop(row);
	points += 5 * getTrapTeleop(row);
	return points;
}

function getMatchPoints(row) {
	var points = 0;

	points += getMatchPointsTeleop(row);
	points += getMatchPointsAuto(row);

	return points;
}

function getWeightedScoreFirst(row) {
	var weightedScore = 0;

	weightedScore +=  5 * getSpeakerAuto(row);
	weightedScore +=  5 * getTrapTeleop(row);
	weightedScore +=  5 * getTrappedWhileClimbed(row);
	weightedScore +=  1 * getShuttleTeleop(row);
	weightedScore +=  4 * getSpeakerTeleop(row);
	weightedScore +=  3.75 * getClimb(row);
	weightedScore +=  1 * getSpotlighted(row);
	weightedScore +=  3 * getAmpTeleop(row);
	weightedScore -=  1 * getAmpAuto(row);
	weightedScore +=  2 * getHarmony(row);
	weightedScore +=  0.5 * getInStage(row);
	weightedScore +=  0.5 * getMobilityAuto(row);
	return weightedScore;
}