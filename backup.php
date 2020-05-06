<html>
	<head>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    <script type="text/javascript">
	      	google.load("visualization", "1", {packages:["corechart"]});
	      	google.setOnLoadCallback(drawChart);
	      	google.setOnLoadCallback(drawVisualization);
	      	google.setOnLoadCallback(drawVisualizationLine);
	      	google.setOnLoadCallback(drawVisualizationProblems);
	      	google.setOnLoadCallback(drawVisualizationInterview);
	      	google.setOnLoadCallback(drawVisualizationLecturePie);
	      	google.setOnLoadCallback(drawVisualizationInterviewPie);
	      	google.setOnLoadCallback(drawVisualizationLectureHours);

	      	function drawChart() {

	      		var xhr = new XMLHttpRequest();
				var url = "getProblemStatLevel.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log(json);
				        var data = google.visualization.arrayToDataTable([
				          	['Levels', 'Percentage'],
				          	['Attempted',     json[3]],
				          	['Hard',      json[2]],
				          	['Medium',  json[1]],
				          	['Easy', json[0]]
				        ]);

				        var options = {
				          	title: 'Total I have solved ' + String(json[2] + json[1] + json[0]) + ' problems',
				          	pieHole: 0,
				          	colors: ['#777', '#ef5350', '#fbc02d', '#4db6ac'],
				          	width:600,
			              	height:450
				        };

			        	var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			        	chart.draw(data, options);
				    }
				};
				xhr.send();
	      	}

	      	function drawVisualizationLecturePie() {

	      		var xhr = new XMLHttpRequest();
				var url = "getLectureStat.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log("Lecture");
				        console.log(json);

				        var data=[];
						var Header= ['Topic', 'Percentage'];
						data.push(Header);
						for (var i = 0; i < json.length; i += 2) {
						    var temp=[];
						    temp.push(json[i]);
						    temp.push(parseFloat(json[i + 1]));

						    data.push(temp);
						}
						
						var chartdata = google.visualization.arrayToDataTable(data);
				     
				        console.log(data);

			        	var options = {
				          	title: 'Lecture / Tutorial Topics',
				          	pieHole: 0.4,
				          	colors: ['#b2dfdb', '#80cbc4', '#4db6ac', '#26a69a', '#009688', 
				          	'#00897b', '#00796b', '#00695c', '#004d40'],
				          	width:600,
			              	height:450
				        };

			        	var chart = new google.visualization.PieChart(document.getElementById('chart_div_lecture_pie'));
			        	chart.draw(chartdata, options);
				    }
				};
				xhr.send();
	      	}

	      	function drawVisualizationInterviewPie() {

	      		var xhr = new XMLHttpRequest();
				var url = "getInterviewStatTopics.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log("Interview topics");
				        console.log(json);

				        var data=[];
						var Header= ['Topic', 'Percentage'];
						data.push(Header);
						for (var i = 0; i < json.length; i += 2) {
						    var temp=[];
						    temp.push(json[i]);
						    temp.push(parseFloat(json[i + 1]));

						    data.push(temp);
						}
						
						var chartdata = google.visualization.arrayToDataTable(data);
				     
				        console.log(data);

			        	var options = {
				          	title: 'Topics Covered in Interview',
				          	pieHole: 0.4,
				          	colors: ['#b2dfdb', '#80cbc4', '#4db6ac', '#26a69a', '#009688', 
				          	'#00897b', '#00796b', '#00695c', '#004d40'],
				          	width:600,
			              	height:450
				        };

			        	var chart = new google.visualization.PieChart(document.getElementById('chart_div_interview_pie'));
			        	chart.draw(chartdata, options);
				    }
				};
				xhr.send();
	      	}

	      	function drawVisualizationLectureHours() {

	      		var xhr = new XMLHttpRequest();
				var url = "getLectureStatHours.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log(json);
			        	var data = google.visualization.arrayToDataTable([
			          		['Month', 'Spend hours'],
			          		['Jan',  json[0] / 60],
			          		['Feb',  json[1] / 60],
			          		['Mar',  json[2] / 60],
			          		['Apr',  json[3] / 60],
			          		['May',  json[4] / 60],
			          		['Jun',  json[5] / 60],
			          		['Jul',  json[6] / 60],
			          		['Aug',  json[7] / 60],
			          		['Sep',  json[8] / 60],
			          		['Oct',  json[9] / 60],
			          		['Nov',  json[10] / 60],
			          		['Dec',  json[11] / 60]
			        	]);

			        	var options = {
			          		title : 'How many hours I spend to listen lectures',
			          		vAxis: {title: ''},
			          		hAxis: {title: 'Month'},
			          		seriesType: 'bars',
			          		series: {2: {type: 'line'}},
			          		width:600,
		              		height:450,
		              		colors: ['#4db6ac'],       
			          	};

			        	var chart = new google.visualization.ComboChart(document.getElementById('chart_div_lecture_hours'));
			      	  	chart.draw(data, options);
				    }
				};
				xhr.send();
	      	}

	      	function drawVisualizationInterview() {

	      		var xhr = new XMLHttpRequest();
				var url = "getInterviewStat.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log("Interview");
				        console.log(json);
			        	var data = google.visualization.arrayToDataTable([
			          		['Steps', 'Percentage'],
			          		['Correct Idead',  json[0]],
			          		['Implemented',  json[1]],
			          		['Passed All tests',  json[2]]
			        	]);

			        	var options = {
			          		title : 'Performance in interview',
			          		vAxis: {title: ''},
			          		hAxis: {title: 'Steps'},
			          		seriesType: 'bars',
			          		series: {2: {type: 'line'}},
			          		width:600,
		              		height:450,
		              		colors: ['#4db6ac'],       
			          	};

			        	var chart = new google.visualization.ComboChart(document.getElementById('chart_div_interview_bar'));
			      	  	chart.draw(data, options);
				    }
				};
				xhr.send();
	      	}

	      	function drawVisualization() {

	      		var xhr = new XMLHttpRequest();
				var url = "getProblemStatCount.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log(json);
			        	var data = google.visualization.arrayToDataTable([
			          		['Month', 'Spend hours', 'Solved Problems'],
			          		['Jan',  json[0] / 60, json[1]],
			          		['Feb',  json[2] / 60, json[3]],
			          		['Mar',  json[4] / 60, json[5]],
			          		['Apr',  json[6] / 60, json[7]],
			          		['May',  json[8] / 60, json[9]],
			          		['Jun',  json[10] / 60, json[11]],
			          		['Jul',  json[12] / 60, json[13]],
			          		['Aug',  json[14] / 60, json[15]],
			          		['Sep',  json[16] / 60, json[17]],
			          		['Oct',  json[18] / 60, json[19]],
			          		['Nov',  json[20] / 60, json[21]],
			          		['Dec',  json[22] / 60, json[23]]
			        	]);

			        	var options = {
			          		title : 'How many hours I spend in each month? How many problems I solved in each month?',
			          		vAxis: {title: ''},
			          		hAxis: {title: 'Month'},
			          		seriesType: 'bars',
			          		series: {2: {type: 'line'}},
			          		width:600,
		              		height:450,
		              		colors: ['#fbc02d', '#4db6ac'],       
			          	};

			        	var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
			      	  	chart.draw(data, options);
				    }
				};
				xhr.send();
	        	
	      	}

	      	function drawVisualizationProblems() {
	      		var xhr = new XMLHttpRequest();
				var url = "getProblemStatSpeed.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log(json);
			        	var data = google.visualization.arrayToDataTable([
			          		['Problem Level', 'Time to find a solution', 'Time to implement'],
			          		['Easy',  json[0], json[1]],
			          		['Medium',  json[2], json[3]],
			          		['Hard',  json[4], json[5]]
			        	]);

			        	var options = {
			          		title : 'How fast I solve easy / medium / hard problems? How many minutes I spend to think and implement?',
			          		vAxis: {title: 'minutes'},
			          		hAxis: {title: 'Problem Levels'},
			          		seriesType: 'bars',
			          		series: {2: {type: 'line'}},
			          		width:600,
		              		height:450,
		              		colors: ['#fbc02d', '#4db6ac'],   
			          	};

			        	var chart = new google.visualization.ComboChart(document.getElementById('chart_div_problems'));
			      	  	chart.draw(data, options);
				    }
				};
				xhr.send();
	        	
	      	}

	      	function drawVisualizationLine() {

	      		var xhr = new XMLHttpRequest();
				var url = "getProblemStatHourCount.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        var json = JSON.parse(xhr.responseText);
				        console.log("Strange");
				        console.log(json);
			        	var data = google.visualization.arrayToDataTable([
			          		['Month', 'number of problems that solved in one hour'],
			          		['Jan',  json[0]],
			          		['Feb',  json[1]],
			          		['Mar',  json[2]],
			          		['Apr',  json[3]],
			          		['May',  json[4]],
			          		['Jun',  json[5]],
			          		['Jul',  json[6]],
			          		['Aug',  json[7]],
			          		['Sep',  json[8]],
			          		['Oct',  json[9]],
			          		['Nov',  json[10]],
			          		['Dec',  json[11]]
			        	]);

			        	var options = {
			          		title : 'How many problems I solve in one hour?',
			          		vAxis: {title: 'Minutes'},
			          		hAxis: {title: 'Levels'},
			          		seriesType: 'line',
			          		width:600,
		              		height:450,
		              		colors: ['#4db6ac'],    
			          	};

			        	var chart = new google.visualization.ComboChart(document.getElementById('chart_div_line'));
			      	  	chart.draw(data, options);
				    }
				};
				xhr.send();
	      	}

	      	var cntOne = 0, cntTwo = 0, cntThree = 0;
	      	function startCounting() {
	      		document.getElementById("thinkStart").style = "background: #AAAAAA;";
			  	// Month Day, Year Hour:Minute:Second, id-of-element-container
			  	if (cntOne == 0)
			  		countUpFromTime(new Date(), 'countup1'); // ****** Change this line!
			  	cntOne++;
			};
			function startLectureCounting() {
	      		document.getElementById("lectureStart").style = "background: #AAAAAA;";
			  	// Month Day, Year Hour:Minute:Second, id-of-element-container
			  	if (cntThree == 0)
			  		countUpFromTime(new Date(), 'countup3'); // ****** Change this line!
			  	cntThree++;
			};
			function startCountingImpl() {
	      		document.getElementById("implStart").style = "background: #AAAAAA;";
			  	// Month Day, Year Hour:Minute:Second, id-of-element-container
			  	if (cntTwo == 0)
			  		countUpFromTime(new Date(), 'countup2'); // ****** Change this line!
			  	cntTwo++;
			};
			function countUpFromTime(countFrom, id) {
			  	countFrom = new Date(countFrom).getTime();
			  	var now = new Date(),
			      	countFrom = new Date(countFrom),
			      	timeDifference = (now - countFrom);
			    
			  	var secondsInADay = 60 * 60 * 1000 * 24,
			      	secondsInAHour = 60 * 60 * 1000;
			    
			  	days = Math.floor(timeDifference / (secondsInADay) * 1);
			  	hours = Math.floor((timeDifference % (secondsInADay)) / (secondsInAHour) * 1);
			  	mins = Math.floor(((timeDifference % (secondsInADay)) % (secondsInAHour)) / (60 * 1000) * 1);
			  	secs = Math.floor((((timeDifference % (secondsInADay)) % (secondsInAHour)) % (60 * 1000)) / 1000 * 1);

			  	var idEl = document.getElementById(id);
			  	// idEl.getElementsByClassName('days')[0].innerHTML = days;
			  	// idEl.getElementsByClassName('hours')[0].innerHTML = hours;
			  	idEl.getElementsByClassName('minutes')[0].innerHTML = mins;
			  	idEl.getElementsByClassName('seconds')[0].innerHTML = secs;

			  	clearTimeout(countUpFromTime.interval);
			  	countUpFromTime.interval = setTimeout(function(){ countUpFromTime(countFrom, id); }, 1000);
			}
			function stopThinking() {
				var idEl = document.getElementById('countup1');
				document.getElementById('thinkingTime').innerHTML = idEl.getElementsByClassName('minutes')[0].innerHTML + ":" + idEl.getElementsByClassName('seconds')[0].innerHTML + " minutes";
				document.getElementById('thinkingTimeCopy').innerHTML = parseInt(idEl.getElementsByClassName('minutes')[0].innerHTML) * 60 + parseInt(idEl.getElementsByClassName('seconds')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('minutes')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('seconds')[0].innerHTML);
				document.getElementById('countup1').style.display = "none";
				document.getElementById("thinkStop").style.display = "none";
				document.getElementById("thinkStart").style.display = "none";
				document.getElementById('thinkingTime').style = "position: relative; top: -45px; font-size: 1.5em; color: white;";

				document.getElementById("implRecord").style="pointer-events:auto;";
				document.getElementById("step4").style = "font-weight: 900; color: #EEE; ";
				document.getElementById("step3").style = "font-weight: 900; color: #EEE; position: relative; top: -50px; ";
			}
			function stopLecture() {
				var idEl = document.getElementById('countup3');
				document.getElementById('lectureTime').innerHTML = idEl.getElementsByClassName('minutes')[0].innerHTML + ":" + idEl.getElementsByClassName('seconds')[0].innerHTML + " minutes";
				document.getElementById('lectureTimeCopy').innerHTML = parseInt(idEl.getElementsByClassName('minutes')[0].innerHTML) * 60 + parseInt(idEl.getElementsByClassName('seconds')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('minutes')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('seconds')[0].innerHTML);
				document.getElementById('countup3').style.display = "none";
				document.getElementById("lectureStop").style.display = "none";
				document.getElementById("lectureStart").style.display = "none";
				document.getElementById('lectureTime').style = "position: relative; top: -45px; font-size: 1.5em; color: white;";

				var obj = {
				   table: []
				};

				var eTopicName = document.getElementById("slctTopicTxt");
				var name = eTopicName.options[eTopicName.selectedIndex].value;

				var hour = Math.floor(parseInt(document.getElementById("lectureTimeCopy").innerHTML) / 60.0);

				// console.log(level);
				// console.log(level);
				obj.table.push({topicName:name,topicHour:hour});
				var json = JSON.stringify(obj);
				console.log(json);

				var xhr = new XMLHttpRequest();
				var url = "addTopicSessionController.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        // var json = JSON.parse(xhr.responseText);
				        // console.log(json);
				        // console.log(xhr.responseText);
				        alert("Your topic is added to the interest list");
				        document.getElementById("lecture_sessions").innerHTML = this.responseText;
				        // console.log(this.responseText);
				    }
				};
				var data = json;
				xhr.send(data);
			}
			function stopImpl() {
				var idEl = document.getElementById('countup2');
				document.getElementById('implTime').innerHTML = idEl.getElementsByClassName('minutes')[0].innerHTML + ":" + idEl.getElementsByClassName('seconds')[0].innerHTML + " minutes";
				document.getElementById('implTimeCopy').innerHTML = parseInt(idEl.getElementsByClassName('minutes')[0].innerHTML) * 60 + parseInt(idEl.getElementsByClassName('seconds')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('minutes')[0].innerHTML);
				// console.log(idEl.getElementsByClassName('seconds')[0].innerHTML);
				document.getElementById('countup2').style.display = "none";
				document.getElementById("implStop").style.display = "none";
				document.getElementById("implStart").style.display = "none";
				document.getElementById('implTime').style = "position: relative; top: -45px; font-size: 1.5em; color: white;";

				document.getElementById("selectStatus").style="pointer-events:auto;";
				document.getElementById("step5").style = "font-weight: 900; color: #EEE; ";
				document.getElementById("step4").style = "font-weight: 900; color: #EEE; position: relative; top: -50px; ";
			}

			function addProblem() {
				
				var obj = {
				   table: []
				};
				var eProblemLvl = document.getElementById("slctProblemLvl");
				var level = eProblemLvl.options[eProblemLvl.selectedIndex].value;

				var eProblemTag = document.getElementById("slctproblemTag");
				var tag = eProblemTag.options[eProblemTag.selectedIndex].value;

				var ttime = Math.floor(parseInt(document.getElementById("thinkingTimeCopy").innerHTML) / 60.0);
				var itime = Math.floor(parseInt(document.getElementById("implTimeCopy").innerHTML) / 60.0);

				var eProblemStatus = document.getElementById("slctStatus");
				var pstatus = eProblemStatus.options[eProblemStatus.selectedIndex].value;

				// console.log(level);
				// console.log(level);
				obj.table.push({problemLevel: level, problemTag:tag, thinkTime: ttime, implTime: itime, problemStatus: pstatus});
				var json = JSON.stringify(obj);
				console.log(json);

				var xhr = new XMLHttpRequest();
				var url = "addProblemController.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        // var json = JSON.parse(xhr.responseText);
				        // console.log(json);
				        // console.log(xhr.responseText);
				        alert("Your problem is added to the list");
				        document.getElementById("solvedProblems").innerHTML = this.responseText;
				    }
				};
				var data = json;
				xhr.send(data);
			}

			// document.getElementById("problemTag").style="pointer-events:none;";
			function selectProblem() {
				document.getElementById("problemTag").style="pointer-events:auto;";
				document.getElementById("step2").style = "font-weight: 900; color: #EEE; ";
			}
			function selectProblemTag() {
				document.getElementById("thinkRecord").style="pointer-events:auto;";
				document.getElementById("step3").style = "font-weight: 900; color: #EEE; ";
			}
			function selectProblemTagInt() {
				document.getElementById("hoursSpend").style="pointer-events:auto;";
				document.getElementById("step2Int").style = "font-weight: 900; color: #EEE; ";
			}

			function selectHoursSpend() {
				document.getElementById("slctproblemCorrectness").style="pointer-events:auto;";
				document.getElementById("step3Int").style = "font-weight: 900; color: #EEE; ";
			}

			function selectProblemCorrectness() {
				document.getElementById("problemImpl").style="pointer-events:auto;";
				document.getElementById("step4Int").style = "font-weight: 900; color: #EEE; ";
			}

			function selectImpl() {
				document.getElementById("problemTestPassed").style="pointer-events:auto;";
				document.getElementById("step5Int").style = "font-weight: 900; color: #EEE; ";
			}

			function selectPassedTests() {
				var obj = {
				   table: []
				};

				var eProblemTag = document.getElementById("slctproblemTagInt");
				var tag = eProblemTag.options[eProblemTag.selectedIndex].value;

				var eHoursSpend = document.getElementById("slcthoursSpend");
				var hours = eHoursSpend.options[eHoursSpend.selectedIndex].value;

				var eCorrectIdea = document.getElementById("slctproblemCorrectness");
				var idea = eCorrectIdea.options[eCorrectIdea.selectedIndex].value;

				var eImplementation = document.getElementById("slctImpl");
				var impl = eImplementation.options[eImplementation.selectedIndex].value;

				var ePassedTest = document.getElementById("slctpassedTests");
				var tests = ePassedTest.options[ePassedTest.selectedIndex].value;

				// console.log(level);
				// console.log(level);
				obj.table.push({problemTag:tag, hoursSpend: hours, ideaCorrectness: idea, implCorrectness: impl, passedTests: tests});
				var json = JSON.stringify(obj);
				console.log(json);

				var xhr = new XMLHttpRequest();
				var url = "addInterviewController.php";
				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function () {
				    if (xhr.readyState === 4 && xhr.status === 200) {
				        // var json = JSON.parse(xhr.responseText);
				        // console.log(json);
				        // console.log(xhr.responseText);
				        alert("Your interview details is added to the list");
				        document.getElementById("passedInterviews").innerHTML = this.responseText;
				    }
				};
				var data = json;
				xhr.send(data);
			}

			function addTopic() {
				var obj = {
				   table: []
				};

				var name = document.getElementById("topicTxt").value;

				if (name != "") {
					// console.log(level);
					// console.log(level);
					obj.table.push({topicName:name});
					var json = JSON.stringify(obj);
					console.log(json);

					var xhr = new XMLHttpRequest();
					var url = "addTopicController.php";
					xhr.open("POST", url, true);
					xhr.setRequestHeader("Content-Type", "application/json");
					xhr.onreadystatechange = function () {
					    if (xhr.readyState === 4 && xhr.status === 200) {
					        // var json = JSON.parse(xhr.responseText);
					        // console.log(json);
					        // console.log(xhr.responseText);
					        alert("Your topic is added to the interest list");
					        document.getElementById("topic_area").innerHTML = this.responseText;
					    }
					};
					var data = json;
					xhr.send(data);
					document.getElementById("topicTxt").value = "";
				} else {
					alert("Your topic name shouldn't be empty");
				}
			}

			function selectLectureHours() {
				
			}

			function selectLectureTopic() {
				document.getElementById("lectureStartRecord").style="pointer-events:auto;";
				document.getElementById("step2Lect").style = "font-weight: 900; color: #EEE; ";
			}

	    </script>
		<style type="text/css">

			/*
			 CSS for the main interaction
			*/
			.tabset > input[type="radio"] {
			  	position: absolute;
			  	left: -200vw;
			}

			.tabset .tab-panel {
			  	display: none;
			}

			.tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
			.tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
			.tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
			.tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
			.tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
			.tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
			  	display: block;
			}

			/*
			 Styling
			*/
			body {
			  	font: 16px/1.5em "Overpass", "Open Sans", Helvetica, sans-serif;
			  	color: #333;
			  	font-weight: 300;
			}

			.tabset > label {
			  	position: relative;
			  	display: inline-block;
			  	padding: 15px 15px 25px;
			  	border: 1px solid transparent;
			  	border-bottom: 0;
			  	cursor: pointer;
			  	font-weight: 600;
			}

			.tabset > label::after {
			  	content: "";
			  	position: absolute;
			  	left: 15px;
			  	bottom: 10px;
			  	width: 22px;
			  	height: 4px;
			  	background: #8d8d8d;
			}

			.tabset > label:hover,
			.tabset > input:focus + label {
			  	color: #06c;
			}

			.tabset > label:hover::after,
			.tabset > input:focus + label::after,
			.tabset > input:checked + label::after {
			  	background: #06c;
			}

			.tabset > input:checked + label {
			  	border-color: #ccc;
			  	border-bottom: 1px solid #fff;
			  	margin-bottom: -1px;
			}

			.tab-panel {
			  	padding: 30px 0;
			  	border-top: 1px solid #ccc;
			}

			/*
			 Demo purposes only
			*/
			*,
			*:before,
			*:after {
			  	box-sizing: border-box;
			}

			body {
			  	padding: 30px;
			}

			.tabset {
			  	max-width: 100em;
			}

			/* Reset Select */
			select {
			  	-webkit-appearance: none;
			  	-moz-appearance: none;
			  	-ms-appearance: none;
			  	appearance: none;
			  	outline: 0;
			  	box-shadow: none;
			  	border: 0 !important;
			  	background: #eee;
			  	background-image: none;
			}
			/* Remove IE arrow */
			select::-ms-expand {
			  	display: none;
			}
			/* Custom Select */
			.select {
			  	position: relative;
			  	display: flex;
			  	max-width: 100em;
			  	height: 3em;
			  	line-height: 3;
			  	background: #eee;
			  	overflow: hidden;
			  	/*border-radius: .25em;*/
			}
			select {
			  	flex: 1;
			  	padding: 0 .5em;
			  	color: #555;
			  	cursor: pointer;
			}
			/* Arrow */
			.select::after {
			  	content: '\25BC';
			  	position: absolute;
			  	top: 0;
			  	right: 0;
			  	padding: 0 1em;
			  	background: #ddd;
			  	cursor: pointer;
			  	pointer-events: none;
			  	-webkit-transition: .25s all ease;
			  	-o-transition: .25s all ease;
			  	transition: .25s all ease;
			}
			/* Transition */
			.select:hover::after {
			  	color: #8d8d8d;
			}

			.button {
				border: 0px;
				background: #eee;
				padding: 10px;
				height: 3em;
				cursor: pointer;
				border-radius: 4px;
				padding-left: 25px;
				padding-right: 25px;
			}

			.countup, .countup2 {
			  	text-align: center;
			  	/*margin-bottom: 20px;*/
			}
			.countup .timeel, .countup2 .timeel {
			  	display: inline-block;
			  	padding: 5px;
			  	background: #151515;
			  	/*margin: 0;*/
			  	color: white;
			  	min-width: 2.6rem;
			  	/*margin-left: 13px;*/
			  	border-radius: 4px 0 0 4px;
			}
			.countup span[class*="timeRef"], .countup2 span[class*="timeRef"] {
			  border-radius: 0 4px 4px 0;
			  /*margin-left: 0;*/
			  background: #EEE;
			  color: black;
			}

		</style>
	</head>
	<body>
		<div class="tabset">
		  	<!-- Tab 1 -->
		  	<input type="radio" name="tabset" id="tab1" aria-controls="problem" checked>
		  	<label for="tab1">Problem solving</label>
		  	<!-- Tab 2 -->
		  	<input type="radio" name="tabset" id="tab2" aria-controls="interview">
		  	<label for="tab2">Interview</label>
		  	<!-- Tab 3 -->
		  	<input type="radio" name="tabset" id="tab3" aria-controls="lecture">
		  	<label for="tab3">Lecture listening</label>
		  	<!-- Tab 4 -->
		  	<input type="radio" name="tabset" id="tab4" aria-controls="stat">
		  	<label for="tab4">Statistics</label>
		  
		  	<div class="tab-panels">
		    	<section id="problem" class="tab-panel">
		      		<p style="font-size: 2em; font-weight: 100;">
		      			<?php
		      				$monthNum = date("m");
		      			?>
		      			<strong><?php echo date("d");?></strong> <?php echo date('F', mktime(0, 0, 0, $monthNum, 10)) . ", 20" . date("y");?>
		      		</p>
		      		<br/>
		      		<div id="solvedProblems">
		      			
			      		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;" cellpadding="10" border="0" cellspacing="10" >
			      			<th>Problem level</th>
			      			<th>Problem tag</th>
			      			<th>Time to find a solution</th>
			      			<th>Time to implement</th>
			      			<th>Status</th>
			      			<?php
								$servername = "localhost";
								$username = "root";
								$password = "root";
								$dbname = "preptracker";

								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
								}

								$sql = "SELECT * FROM problems WHERE user_id = 1 AND solved_date = '" . strval(date("Y/m/d")) . "'";
								$result = $conn->query($sql);

								$cnt = 0;
								$time = 0;

								if ($result->num_rows > 0) {
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
								    	if ($row["status"] == "Solved") {
								    		echo "<tr style='background: #e0f7fa;'>";
								    		$cnt++;
								    	} else if ($row["status"] == "Not solved") {
								    		echo "<tr style='background: #ffcdd2;'>";
								    	} else {
								    		echo "<tr style='background: #81b9bf;'>";
								    		$cnt++;
								    	}
								    	$time += intval($row["think_time"]);
								    	$time += intval($row["impl_time"]);
								    	echo "	<td>";
								    	echo "		<center><p>" . $row["problem_level"] . "</p></center>";
								    	echo "	</td>";
								    	echo "	<td>";
								    	echo "		<center><p>" . $row["problem_tag"] . "</p></center>";
								    	echo "	</td>";
								    	echo "	<td>";
								    	echo "		<center><p> ~" . $row["think_time"] . " min.</p></center>";
								    	echo "	</td>";
								    	echo "	<td>";
								    	echo "		<center><p> ~" . $row["impl_time"] . " min.</p></center>";
								    	echo "	</td>";
								    	echo "	<td>";
								    	echo "		<center><p>" . $row["status"] . "</p></center>";
								    	echo "	</td>";
								    	echo "</tr>";
								    }
								} else {
								    echo "0 results";
								}
								$conn->close();
							?>
						</table>
						<table align="right" cellspacing="10" cellpadding="10">
			      			<tr>
			      				<td>
			      					<p style="font-size: 2em; font-weight: 100;"><strong><?php echo number_format(($time / 60), 2);?></strong> hour</p><p style="color: #999; position: relative; top: -2em;">spend hours</p>
			      				</td>
			      				<td>
			      					<p style="font-size: 2em; font-weight: 100;"><strong><?php echo $cnt; ?></strong> problems</p><p style="color: #999; position: relative; top: -2em;">solved problems</p>
			      				</td>
			      			</tr>
			      		</table>
		      		</div>
		      		<br/><br/>
					<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc; background: #424242;" cellpadding="20" border="0" cellspacing="10">
		      			
		      			<tr>
		      				<td valign="top">
		      					
		      					<span style="color: #AAA;">Problem level</span>
		      					<br/><br/>
		      					<div class="select" id="problemSelection">
								  	<select name="slct" id="slctProblemLvl" onchange="selectProblem()">
								    	<option selected disabled>Choose problem level</option>
								    	<option value="Easy">Easy</option>
								    	<option value="Medium">Medium</option>
								    	<option value="Hard">Hard</option>
								  	</select>
								</div>
								<p style="font-weight: 900; color: #EEEE;">Step 1 &#8594; </p>
		      				</td>
		      				<td valign="top">
		      					<span style="color: #AAA;">Problem tag</span>
		      					<br/><br/>
		      					<div class="select" id="problemTag" style="pointer-events: none;">
								  	<select name="slct" id="slctproblemTag" onchange="selectProblemTag()">
								    	<option selected disabled>Choose problem tag</option>
								    	<option value="Array">Array</option>
								    	<option value="Hash Table">Hash Table</option>
								    	<option value="Linked List">Linked List</option>
								    	<option value="Math">Math</option>
								    	<option value="Two pointers">Two pointers</option>
								    	<option value="String">String</option>
								    	<option value="Binary Search">Binary Search</option>
								    	<option value="Divide and Conquer">Divide and Conquer</option>
								    	<option value="Dynamic Programming">Dynamic Programming</option>
								    	<option value="Backtracking">Backtracking</option>
								    	<option value="Stack">Stack</option>
								    	<option value="Heap">Heap</option>
								    	<option value="Greedy">Greedy</option>
								    	<option value="Sort">Sort</option>
								    	<option value="Bit Manipulation">Bit Manipulation</option>
								    	<option value="Tree">Tree</option>
								    	<option value="Depth-first Search">Depth-first Search</option>
								    	<option value="Breadth-first Search">Breadth-first Search</option>
								    	<option value="Union Find">Union Find</option>
								    	<option value="Graph">Graph</option>
								    	<option value="Design">Design</option>
								    	<option value="Topological Sort">Topological Sort</option>
								    	<option value="Trie">Trie</option>
								    	<option value="Binary Indexed Tree">Binary Indexed Tree</option>
								    	<option value="Segment Tree">Segment Tree</option>
								    	<option value="Binary Search Tree">Binary Search Tree</option>
								    	<option value="Recursion">Recursion</option>
								    	<option value="Brainteaser">Brainteaser</option>
								    	<option value="Memorization">Memorization</option>
								    	<option value="Queue">Queue</option>
								    	<option value="Minimax">Minimax</option>
								    	<option value="Reservoir Sampling">Reservoir Sampling</option>
								    	<option value="Ordered Map">Ordered Map</option>
								    	<option value="Geometry">Geometry</option>
								    	<option value="Random">Random</option>
								    	<option value="Rejection Sampling">Rejection Sampling</option>
								    	<option value="Sliding Window">Sliding Window</option>
								    	<option value="Line Sweep">Line Sweep</option>
								    	<option value="Rolling Hash">Rolling Hash</option>
								    	<option value="Suffix Array">Suffix Array</option>
								  	</select>
								</div>
								<p style="font-weight: 900; color: #777; " id="step2">Step 2</p>
		      				</td>
		      				<td valign="top">
		      					<center style="color: #AAA;">Time to find a solution</center>
		      					<br/>
		      					<center id="thinkRecord" style="pointer-events: none;">
		      						<br/>
		      						<a class="button" id="thinkStart" style="background: #16a085; color: white;" onclick="startCounting()">Start</a>
		      						<!-- <a class="button" style="background: #e67e22; color: white;">Pause</a> -->
		      						<a class="button" style="background: #e74c3c; color: white;" onclick="stopThinking()" id="thinkStop">Stop</a>
		      						<br/>
		      						<p id="thinkingTime" style="font-size: 2em; color: white;"></p>
		      						<p id="thinkingTimeCopy" style="display: none;"></p>
		      						<div class="countup" id="countup1">
									  	<span class="timeel minutes">00</span>
									  	<span class="timeel timeRefMinutes">min</span>
									  	<span class="timeel seconds">00</span>
									  	<span class="timeel timeRefSeconds">sec</span>
									</div>
									<p style="font-weight: 900; color: #777;" id="step3">Step 3</p>
		      					</center>

		      				</td>
		      				<td valign="top">
		      					<center style="color: #AAA;">Time to implement</center>
		      					<br/>
		      					<center id="implRecord" style="pointer-events: none;">
		      						<br/>
		      						<a class="button" id="implStart" style="background: #16a085; color: white;" onclick="startCountingImpl()">Start</a>
		      						<!-- <a class="button" style="background: #e67e22; color: white;">Pause</a> -->
		      						<a class="button" style="background: #e74c3c; color: white;" onclick="stopImpl()" id="implStop">Stop</a>
		      						<br/>
		      						<p id="implTime" style="font-size: 2em;"></p>
		      						<p id="implTimeCopy" style="display: none"></p>
		      						<div class="countup2" id="countup2">
									  	<span class="timeel minutes">00</span>
									  	<span class="timeel timeRefMinutes">min</span>
									  	<span class="timeel seconds">00</span>
									  	<span class="timeel timeRefSeconds">sec</span>
									</div>
		      						<p style="font-weight: 900; color: #777;" id="step4">Step 4</p>
		      					</center>
		      				</td>
		      				<td valign="top">
		      					<span style="color: #AAA;">Status</span>
		      					<br/><br/>
		      					<div class="select" id="selectStatus" style="pointer-events: none;">
								  	<select name="slct" id="slctStatus" onchange="addProblem()">
								    	<option selected disabled>Choose problem level</option>
								    	<option value="Solved">Solved</option>
								    	<option value="Not solved">Not solved</option>
								    	<option value="Solved with hints">Solved with hints</option>
								  	</select>
								</div>
								<p style="font-weight: 900; color: #777; " id="step5">Step 5.</p>
		      				</td>
		      			</tr>
		      		</table>
		      		<br/>
		      		<hr style="border: 0px solid #CCC; border-bottom: 1px solid #DDD;"/>
		      		<p style="font-size: 1em; font-weight: 900; color: #777;">
		      			My History
		      		</p>
		      		<br/>
		      		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;" cellpadding="10" border="0" cellspacing="10" >
		      			<th width="5%">#</th>
		      			<th>Solved date</th>
			      		<th>Problem level</th>
			      		<th>Problem tag</th>
			      		<th>Time to find a solution</th>
			     		<th>Time to implement</th>
			      		<th>Status</th>
			      		<?php
							$servername = "localhost";
							$username = "root";
							$password = "root";
							$dbname = "preptracker";

							// Create connection
							$conn = new mysqli($servername, $username, $password, $dbname);
							// Check connection
							if ($conn->connect_error) {
							    die("Connection failed: " . $conn->connect_error);
							}

							$sql = "SELECT * FROM problems WHERE user_id = 1 ORDER BY id DESC";
							$result = $conn->query($sql);

							$cnt = 0;
							$time = 0;

							if ($result->num_rows > 0) {
								$cnt = 0;
								// output data of each row
							    while($row = $result->fetch_assoc()) {
							    	if ($row["status"] == "Solved") {
							    		echo "<tr style='background: #e0f7fa;'>";
							    		$cnt++;
							    	} else if ($row["status"] == "Not solved") {
							    		echo "<tr style='background: #ffcdd2;'>";
								    } else {
								   		echo "<tr style='background: #81b9bf;'>";
								   		$cnt++;
								   	}
								   	$time += intval($row["think_time"]);
								  	$time += intval($row["impl_time"]);
								  	if ($row["status"] == "Solved") {
							    		echo "	<td>";
									   	echo "		<center><p>" . $cnt . "</p></center>";
									   	echo "	</td>";
							    	} else if ($row["status"] == "Solved with hints") {
							    		echo "	<td>";
									   	echo "		<center><p>" . $cnt . "</p></center>";
									   	echo "	</td>";
								    } else {
								    	echo "	<td>";
									   	echo "		<center><p></p></center>";
									   	echo "	</td>";
								    }
								  	echo "	<td>";
								   	echo "		<center><p>" . $row["solved_date"] . "</p></center>";
								   	echo "	</td>";
								    echo "	<td>";
								   	echo "		<center><p>" . $row["problem_level"] . "</p></center>";
								   	echo "	</td>";
								   	echo "	<td>";
								   	echo "		<center><p>" . $row["problem_tag"] . "</p></center>";
								   	echo "	</td>";
							    	echo "	<td>";
							    	echo "		<center><p> ~" . $row["think_time"] . " min.</p></center>";
							    	echo "	</td>";
							    	echo "	<td>";
							    	echo "		<center><p> ~" . $row["impl_time"] . " min.</p></center>";
							    	echo "	</td>";
							    	echo "	<td>";
							    	echo "		<center><p>" . $row["status"] . "</p></center>";
								    echo "	</td>";
								   	echo "</tr>";
								}
							} else {
							    echo "0 results";
							}
							$conn->close();
						?>
					</table>
		  		</section>
		    	<section id="interview" class="tab-panel">
		      		<p style="font-size: 2em; font-weight: 100;">
		      			<?php
		      				$monthNum = date("m");
		      			?>
		      			<strong><?php echo date("d");?></strong> <?php echo date('F', mktime(0, 0, 0, $monthNum, 10)) . ", 20" . date("y");?>
		      		</p>
		      		<br/>
		      		<div id="passedInterviews">
		      			
			      		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;" cellpadding="10" border="1" cellspacing="10" >
				      			<th>Problem tag</th>
				      			<th>Hours spend</th>
				      			<th>Correct solution / idea</th>
				      			<th>Implemented</th>
				      			<th>Passed all tests</th>
				      			<?php
									$servername = "localhost";
									$username = "root";
									$password = "root";
									$dbname = "preptracker";

									// Create connection
									$conn = new mysqli($servername, $username, $password, $dbname);
									// Check connection
									if ($conn->connect_error) {
									    die("Connection failed: " . $conn->connect_error);
									}

									$sql = "SELECT * FROM interview WHERE user_id = 1";
									$result = $conn->query($sql);

									$cnt = 0;
									$time = 0;
									$performance = 0;

									if ($result->num_rows > 0) {
									    // output data of each row
									    while($row = $result->fetch_assoc()) {
									    	if ($row["passed_tests"] == "100") {
									    		echo "<tr style='background: #e0f7fa;'>";
									    	} else {
									    		echo "<tr style='background: #ffcdd2;'>";
									    	}
									    	$cnt++;
									    	$time += $row["hours"];
									    	$temp = 0;
									    	$temp += $row["idea"];
									    	$temp += $row["passed_tests"];
									    	$temp += $row["implementation"];
									    	$temp /= 3.0;
									    	$performance += $temp;
									    	echo "	<td>";
									    	echo "		<center><p>" . $row["problem_tag"] . "</p></center>";
									    	echo "	</td>";
									    	echo "	<td>";
									    	echo "		<center><p>" . $row["hours"] . " hour</p></center>";
									    	echo "	</td>";
									    	echo "	<td>";
									    	echo "		<center><p>" . $row["idea"] . "%</p></center>";
									    	echo "	</td>";
									    	echo "	<td>";
									    	echo "		<center><p>" . $row["implementation"] . "%</p></center>";
									    	echo "	</td>";
									    	echo "	<td>";
									    	echo "		<center><p>" . $row["passed_tests"] . "%</p></center>";
									    	echo "	</td>";
									    	echo "</tr>";
									    }
									} else {
									    echo "0 results";
									}
									$conn->close();
								?>
						</table>
			      		<table align="right" cellspacing="10" cellpadding="10">
			      			<tr>
			      				<td><p style="font-size: 3em; font-weight: 100;"><strong><?php echo $time;?></strong></p><p style="color: #999; position: relative; top: -2.5em;">spend hours</p></td>
			      				<td><p style="font-size: 3em; font-weight: 100;"><strong><?php echo $cnt;?></strong></p><p style="color: #999; position: relative; top: -2.5em;">interviews</p></td>
			      				<?php
			      					if ($cnt == 0) {
			      				?>
			      						<td><p style="font-size: 3em; font-weight: 100;"><strong>0%</strong></p><p style="color: #999; position: relative; top: -2.5em;">performance</p></td>
			      				<?php
			      					} else {
			      				?>
			      						<td><p style="font-size: 3em; font-weight: 100;"><strong><?php echo number_format(($performance / $cnt), 1); ?>%</strong></p><p style="color: #999; position: relative; top: -2.5em;">performance</p></td>
			      				<?php
			      					}
			      				?>
			      			</tr>
			      		</table>
			      		
			      	</div>
			      	<br/><br/>
		      		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc; background: #424242;" cellpadding="20" border="0" cellspacing="10">
		      			
		      			<tr>
		      				<td valign="top">
		      					<div class="select" id="problemTagInt" style="pointer-events: auto;">
								  	<select name="slct" id="slctproblemTagInt" onchange="selectProblemTagInt()">
								    	<option selected disabled>Choose problem tag</option>
								    	<option value="Array">Array</option>
								    	<option value="Hash Table">Hash Table</option>
								    	<option value="Linked List">Linked List</option>
								    	<option value="Math">Math</option>
								    	<option value="Two pointers">Two pointers</option>
								    	<option value="String">String</option>
								    	<option value="Binary Search">Binary Search</option>
								    	<option value="Divide and Conquer">Divide and Conquer</option>
								    	<option value="Dynamic Programming">Dynamic Programming</option>
								    	<option value="Backtracking">Backtracking</option>
								    	<option value="Stack">Stack</option>
								    	<option value="Heap">Heap</option>
								    	<option value="Greedy">Greedy</option>
								    	<option value="Sort">Sort</option>
								    	<option value="Bit Manipulation">Bit Manipulation</option>
								    	<option value="Tree">Tree</option>
								    	<option value="Depth-first Search">Depth-first Search</option>
								    	<option value="Breadth-first Search">Breadth-first Search</option>
								    	<option value="Union Find">Union Find</option>
								    	<option value="Graph">Graph</option>
								    	<option value="Design">Design</option>
								    	<option value="Topological Sort">Topological Sort</option>
								    	<option value="Trie">Trie</option>
								    	<option value="Binary Indexed Tree">Binary Indexed Tree</option>
								    	<option value="Segment Tree">Segment Tree</option>
								    	<option value="Binary Search Tree">Binary Search Tree</option>
								    	<option value="Recursion">Recursion</option>
								    	<option value="Brainteaser">Brainteaser</option>
								    	<option value="Memorization">Memorization</option>
								    	<option value="Queue">Queue</option>
								    	<option value="Minimax">Minimax</option>
								    	<option value="Reservoir Sampling">Reservoir Sampling</option>
								    	<option value="Ordered Map">Ordered Map</option>
								    	<option value="Geometry">Geometry</option>
								    	<option value="Random">Random</option>
								    	<option value="Rejection Sampling">Rejection Sampling</option>
								    	<option value="Sliding Window">Sliding Window</option>
								    	<option value="Line Sweep">Line Sweep</option>
								    	<option value="Rolling Hash">Rolling Hash</option>
								    	<option value="Suffix Array">Suffix Array</option>
								  	</select>
								</div>
								<p style="font-weight: 900; color: #eee; " id="step1Int">Step 1 &#8594; </p>
		      				</td>
		      				<td valign="top">
		      					<div class="select" id="hoursSpend" style="pointer-events: none;">
								  	<select name="slct" id="slcthoursSpend" onchange="selectHoursSpend()">
								    	<option selected disabled>Choose hours spend</option>
								    	<option value="0,25">0.25 hour</option>
								    	<option value="0.5">0.5 hour</option>
								    	<option value="0.75">0.75 hour</option>
								    	<option value="1">1 hour</option>
								    	<option value="1.25">1.25 hour</option>
								    	<option value="1.5">1.5 hour</option>
								    	<option value="2">2 hour</option>
								  	</select>
								</div>
								<p style="font-weight: 900; color: #777; " id="step2Int">Step 2</p>
		      				</td>
		      				<td valign="top">
		      					<div class="select" id="problemCorrectness" style="pointer-events: none;">
								  	<select name="slct" id="slctproblemCorrectness" onchange="selectProblemCorrectness()">
								    	<option selected disabled>Choose idea correctness %</option>
								    	<option value="0">0%</option>
								    	<option value="10">10%</option>
								    	<option value="20">20%</option>
								    	<option value="30">30%</option>
								    	<option value="40">40%</option>
								    	<option value="50">50%</option>
								    	<option value="60">60%</option>
								    	<option value="70">70%</option>
								    	<option value="80">80%</option>
								    	<option value="90">90%</option>
								    	<option value="100">100%</option>
								  	</select>
								</div>
								<p style="font-weight: 900; color: #777; " id="step3Int">Step 3</p>
		      				</td>
		      				<td valign="top">
		      					<div class="select" id="problemImpl" style="pointer-events: none;">
								  	<select name="slct" id="slctImpl" onchange="selectImpl()">
								    	<option selected disabled>Choose implementation correctness</option>
								    	<option value="0">0%</option>
								    	<option value="10">10%</option>
								    	<option value="20">20%</option>
								    	<option value="30">30%</option>
								    	<option value="40">40%</option>
								    	<option value="50">50%</option>
								    	<option value="60">60%</option>
								    	<option value="70">70%</option>
								    	<option value="80">80%</option>
								    	<option value="90">90%</option>
								    	<option value="100">100%</option>
								  	</select>
								</div>
								<p style="font-weight: 900; color: #777; " id="step4Int">Step 4</p>
		      				</td>
		      				<td valign="top">
		      					<div class="select" id="problemTestPassed" style="pointer-events: none;">
								  	<select name="slct" id="slctpassedTests" onchange="selectPassedTests()">
								    	<option selected disabled>Percentage of passed tests</option>
								    	<option value="0">0%</option>
								    	<option value="10">10%</option>
								    	<option value="20">20%</option>
								    	<option value="30">30%</option>
								    	<option value="40">40%</option>
								    	<option value="50">50%</option>
								    	<option value="60">60%</option>
								    	<option value="70">70%</option>
								    	<option value="80">80%</option>
								    	<option value="90">90%</option>
								    	<option value="100">100%</option>
								  	</select>
								</div>
								<p style="font-weight: 900; color: #777; " id="step5Int">Step 5</p>
		      				</td>
		      			</tr>
		      		</table>
		      		
		    	</section>
		    	<section id="lecture" class="tab-panel">
		      		<p style="font-size: 2em; font-weight: 100;">
		      			<?php
		      				$monthNum = date("m");
		      			?>
		      			<strong><?php echo date("d");?></strong> <?php echo date('F', mktime(0, 0, 0, $monthNum, 10)) . ", 20" . date("y");?>
		      		</p>
		      		<br/>
		      		<p style="font-weight: 900;">My topics</p>
		      		<div id="topic_area">
			      		<table border="0" width="100%" cellpadding="10" cellspacing="10">
			      			<?php
								$servername = "localhost";
								$username = "root";
								$password = "root";
								$dbname = "preptracker";

								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);
								// Check connection
								if ($conn->connect_error) {
								    die("Connection failed: " . $conn->connect_error);
								}

								$sql = "SELECT * FROM topics WHERE user_id = 1";
								$result = $conn->query($sql);

								$i = 0;

								if ($result->num_rows > 0) {
									$del = 4;
								    // output data of each row
								    while($row = $result->fetch_assoc()) {
								    	if ($i % $del == 0) {
								    		echo "<tr>";
								    	}
								    	echo "<td style='border: 1px solid #CCC; border-radius: 4px;'>" . $row["topic_name"] . "</td>";
								    	if ($i % $del == $del - 1) {
								    		echo "</tr>";
								    	}
								        $i = $i + 1;
								    }
								} else {
								    echo "0 results";
								}
								$conn->close();
							?>
			      		</table>
			      	</div>
		      		<br/>
		      		<input type="text" placeholder="Type your topic name" style="width: 100%; padding: 15px; border-radius: 4px; border: 1px solid #CCC;" id="topicTxt" />
		      		<br/><br/>
		      		<button style="padding: 15px; width: 100%; border-radius: 4px; background: #EEE;" onclick="addTopic()">Add the topic</button>
		      		<br/>
		      		<br/>
		      		<hr style="border: 1px solid #CCC;"/>
		      		<br/>
		      		<div id="lecture_sessions">
		      			
			      		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;" cellpadding="10" border="1" cellspacing="10">
			      			<th style="background: #EEE;">Lecture / Topic area</th>
			      			<th style="background: #EEE;">Hours spend</th>
			      			<?php
									$servername = "localhost";
									$username = "root";
									$password = "root";
									$dbname = "preptracker";

									// Create connection
									$conn = new mysqli($servername, $username, $password, $dbname);
									// Check connection
									if ($conn->connect_error) {
									    die("Connection failed: " . $conn->connect_error);
									}

									$sql = "SELECT * FROM topic_session WHERE user_id = 1 ORDER BY id DESC";
									$result = $conn->query($sql);
									$s = 0;

									if ($result->num_rows > 0) {
									    // output data of each row
									    while($row = $result->fetch_assoc()) {
									    	echo "<tr>";
									    	echo "<td style='width: 80%;'><center><p>" . $row["topic_name"] . "</p></center></td>";
									    	echo "<td><center><p>" . number_format(floatval($row["hours"]) / 60, 3) . "</p></center></td>";
									    	echo "</tr>";
									    	$s += floatval($row["hours"]);
									    }
									} else {
									    echo "0 results";
									}
									$conn->close();
								?>
			      		</table>
			      		<table align="right" cellspacing="10" cellpadding="10">
			      			<tr>
			      				<td><p style="font-size: 3em; font-weight: 100;"><strong><?php echo number_format($s / 60, 3); ?></strong></p><p style="color: #999; position: relative; top: -2.5em;">spend hours</p></td>
			      			</tr>
			      		</table>
			      	</div>
			      	<br/><br/>
		      		
		      		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc; background: #424242;" cellpadding="20" border="0" cellspacing="10">
		      			<tr>
		      				<td valign="top" width="80%">
		      					<span style="color: #AAA;">Topic</span>
		      					<br/><br/>
		      					<div class="select" id="lectureTxt" onchange="selectLectureTopic()">
								  	<select name="slct" id="slctTopicTxt">
								    	<option selected disabled>Choose topic</option>
								    	<?php
											$servername = "localhost";
											$username = "root";
											$password = "root";
											$dbname = "preptracker";

											// Create connection
											$conn = new mysqli($servername, $username, $password, $dbname);
											// Check connection
											if ($conn->connect_error) {
											    die("Connection failed: " . $conn->connect_error);
											}

											$sql = "SELECT * FROM topics WHERE user_id = 1";
											$result = $conn->query($sql);

											$i = 0;

											if ($result->num_rows > 0) {
												$del = 4;
											    // output data of each row
											    while($row = $result->fetch_assoc()) {
											    	echo "<option value='" . $row["topic_name"] . "'>" . $row["topic_name"] . "</option>";
											    }
											}
											$conn->close();
										?>
								  	</select>
								</div>
								<p style="font-weight: 900; color: #EEEE;">Step 1 &#8594; </p>
		      				</td>
		      				<td valign="top">
		      					<center style="color: #AAA;">Hours spend</center>
		      					<br/>
		      					<center id="lectureStartRecord" style="pointer-events: none;">
		      						<br/>
		      						<a class="button" id="lectureStart" style="background: #16a085; color: white;" onclick="startLectureCounting()">Start</a>
		      						<!-- <a class="button" style="background: #e67e22; color: white;">Pause</a> -->
		      						<a class="button" style="background: #e74c3c; color: white;" onclick="stopLecture()" id="lectureStop">Stop</a>
		      						<br/>
		      						<p id="lectureTime" style="font-size: 2em; color: white;"></p>
		      						<p id="lectureTimeCopy" style="display: none;"></p>
		      						<div class="countup" id="countup3">
									  	<span class="timeel minutes">00</span>
									  	<span class="timeel timeRefMinutes">min</span>
									  	<span class="timeel seconds">00</span>
									  	<span class="timeel timeRefSeconds">sec</span>
									</div>
									<p style="font-weight: 900; color: #777;" id="step2Lect">Step 2</p>
		      					</center>

		      				</td>
		      				<!-- <td valign="top">
		      					<div class="select" style="pointer-events: none;" id="step2LectSlct">
								  	<select name="slct" id="slctTopicHours" onchange="selectLectureHours()">
								    	<option selected disabled>Choose hours spend</option>
								    	<option value="0.25">0.25 hour</option>
								    	<option value="0.5">0.5 hour</option>
								    	<option value="0.75">0.75 hour</option>
								    	<option value="1">1 hour</option>
								    	<option value="1.25">1.25 hour</option>
								    	<option value="1.5">1.5 hour</option>
								    	<option value="2">2 hour</option>
								  	</select>
								</div>
								<p style="font-weight: 900; color: #777; " id="step2Lect">Step 2</p>
		      				</td> -->
		      			</tr>
		      		</table>
		      		
		    	</section>
		    	<section id="stat" class="tab-panel">
		    		<h2 style="font-weight: 100;">Preparation History</h2>
		    		<hr style="border: 1px solid #eee;"/>
		    		<table cellpadding="10" cellspacing="10">
		    			<tr>
		    				<td style="background: #4db6ac;">
		    					<p>Problem solved</p>
		    				</td>
		    				<td style="background: #aed581;">
		    					<p>Problem solved + Interview passed</p>
		    				</td>
		    				<td style="background: #90a4ae;">
		    					<p>Problem solved + Interview passed + Lecture / Tutorial watched</p>
		    				</td>
		    			</tr>
		    			<tr>
		    				<td style="background: #f06292;">
		    					<p>Interview passed</p>
		    				</td>
		    				<td style="background: #64b5f6;">
		    					<p>Problem solved + Lecture / Tutorial watched</p>
		    				</td>
		    			</tr>
		    			<tr>
		    				<td style="background: #fff176;">
		    					<p>Lecture / Tutorial watched</p>
		    				</td>
		    				<td style="background: #ff8a65;">
		    					<p>Interview passed + Lecture / Tutorial watched</p>
		    				</td>
		    			</tr>
		    		</table>
		    		<hr style="border: 1px solid #eee;"/>
		    		<br/>
		    		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;" border="0" cellpadding="10">
		    			<tr>
		    				<td width="8.3%">January</td>
		    				<td width="8.3%">February</td>
		    				<td width="8.3%">March</td>
		    				<td width="8.3%">April</td>
		    				<td width="8.3%">May</td>
		    				<td width="8.3%">June</td>
		    				<td width="8.3%">July</td>
		    				<td width="8.3%">August</td>
		    				<td width="8.3%">September</td>
		    				<td width="8.3%">October</td>
		    				<td width="8.3%">Novermber</td>
		    				<td width="8.3%">December</td>
		    			</tr>
		    		</table>
		    		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;" border="1" cellpadding="10">
		    			<?php
		    				$servername = "localhost";
							$username = "root";
							$password = "root";
							$dbname = "preptracker";

							// Create connection
							$conn = new mysqli($servername, $username, $password, $dbname);
							// Check connection
							if ($conn->connect_error) {
							    die("Connection failed: " . $conn->connect_error);
							}

							$sql = "SELECT * FROM problems WHERE user_id = 1";
							$result = $conn->query($sql);

							$dates = array();
							$used = array();

							if ($result->num_rows > 0) {
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							    	$date = new DateTime($row['solved_date']);
							    	array_push($dates, $date->format('z') + 3);
							    	array_push($used, false);
							    }
							}

							$sql = "SELECT * FROM topic_session WHERE user_id = 1";
							$result = $conn->query($sql);

							$lecture_dates = array();
							$used_lect = array();

							if ($result->num_rows > 0) {
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							    	$date = new DateTime($row['learned_date']);
							    	array_push($lecture_dates, $date->format('z') + 3);
							    	array_push($used_lect, false);
							    }
							}

							$sql = "SELECT * FROM interview WHERE user_id = 1";
							$result = $conn->query($sql);

							$intr_dates = array();
							$used_intr = array();

							if ($result->num_rows > 0) {
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							    	$date = new DateTime($row['interview_date']);
							    	array_push($intr_dates, $date->format('z') + 3);
							    	array_push($used_intr, false);
							    }
							}

							$conn->close();

							$uniq_dates = array();
		    				$dates_cnt = array();

		    				for ($i = 0; $i < count($dates); $i++) {
		    					if ($used[$i] == false) {
		    						$cnt = 0;
		    						for ($j = $i; $j < count($dates); $j++) {
		    							if ($dates[$i] == $dates[$j]) {
		    								$used[$j] = true;
		    								$cnt++;
		    							}
		    						}
		    						array_push($uniq_dates, $dates[$i]);
		    						array_push($dates_cnt, $cnt);
		    					}
		    				}

		    				$uniq_dates_lect = array();
		    				$dates_cnt_lect = array();

		    				for ($i = 0; $i < count($lecture_dates); $i++) {
		    					if ($used_lect[$i] == false) {
		    						$cnt = 0;
		    						for ($j = $i; $j < count($lecture_dates); $j++) {
		    							if ($lecture_dates[$i] == $lecture_dates[$j]) {
		    								$used_lect[$j] = true;
		    								$cnt++;
		    							}
		    						}
		    						array_push($uniq_dates_lect, $lecture_dates[$i]);
		    						array_push($dates_cnt_lect, $cnt);
		    					}
		    				}

		    				$uniq_dates_intr = array();
		    				$dates_cnt_intr = array();

		    				for ($i = 0; $i < count($intr_dates); $i++) {
		    					if ($used_intr[$i] == false) {
		    						$cnt = 0;
		    						for ($j = $i; $j < count($intr_dates); $j++) {
		    							if ($intr_dates[$i] == $intr_dates[$j]) {
		    								$used_intr[$j] = true;
		    								$cnt++;
		    							}
		    						}
		    						array_push($uniq_dates_intr, $intr_dates[$i]);
		    						array_push($dates_cnt_intr, $cnt);
		    					}
		    				}

		    				// var_dump($uniq_dates_lect);
		    				// var_dump($dates_cnt_lect);

		    				// for ($i = 0; $i < 52; $i++) {
		    				// 	echo "<th style='font-size: 0.1em;'></th>";
		    				// }
		    				
		    				for ($i = 0; $i < 7; $i++) {
		    					$cnt = $i + 1;
		    					echo "<tr style='font-size: 0.1em;'>";
		    					for ($j = 0; $j < 52; $j++) {
		    						$found = false;
		    						$problemFound = false;
		    						$lectFound = false;
		    						$intrFound = false;
		    						for ($k = 0; $k < count($uniq_dates); $k++) {
		    							if ($uniq_dates[$k] == $cnt) {
		    								$found = true;
		    								$problemFound = true;
		    								break;
		    							}
		    						}

		    						for ($k = 0; $k < count($uniq_dates_lect); $k++) {
		    							if ($uniq_dates_lect[$k] == $cnt) {
		    								$found = true;
		    								$lectFound = true;
		    								break;
		    							}
		    						}

		    						for ($k = 0; $k < count($uniq_dates_intr); $k++) {
		    							if ($uniq_dates_intr[$k] == $cnt) {
		    								$found = true;
		    								$intrFound = true;
		    								break;
		    							}
		    						}

		    						if ($problemFound == true && $lectFound == false && $intrFound == false && $dates_cnt[$k] > 0 && $dates_cnt[$k] <= 1) {
		    							echo "<td style='font-size: 0.1em; background: #b2dfdb;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == false && $intrFound == false && $dates_cnt[$k] > 1 && $dates_cnt[$k] <= 2) {
		    							echo "<td style='font-size: 0.1em; background: #4db6ac;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == false && $intrFound == false && $dates_cnt[$k] > 2 && $dates_cnt[$k] <= 3) {
		    							echo "<td style='font-size: 0.1em; background: #009688;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == false && $intrFound == false && $dates_cnt[$k] > 3) {
		    							echo "<td style='font-size: 0.1em; background: #00796b;'></td>";
		    						}

		    						if ($problemFound == false && $lectFound == true && $intrFound == false && $dates_cnt_lect[$k] > 0 && $dates_cnt_lect[$k] <= 1) {
		    							echo "<td style='font-size: 0.1em; background: #fff9c4;'></td>";
		    						}
		    						if ($problemFound == false && $lectFound == true && $intrFound == false && $dates_cnt_lect[$k] > 1 && $dates_cnt_lect[$k] <= 2) {
		    							echo "<td style='font-size: 0.1em; background: #fff176;'></td>";
		    						}
		    						if ($problemFound == false && $lectFound == true && $intrFound == false && $dates_cnt_lect[$k] > 2 && $dates_cnt_lect[$k] <= 3) {
		    							echo "<td style='font-size: 0.1em; background: #ffeb3b;'></td>";
		    						}
		    						if ($problemFound == false && $lectFound == true && $intrFound == false && $dates_cnt_lect[$k] > 3) {
		    							echo "<td style='font-size: 0.1em; background: #fbc02d;'></td>";
		    						}

		    						if ($problemFound == false && $intrFound == true && $lectFound == false && $dates_cnt_intr[$k] > 0 && $dates_cnt_intr[$k] <= 1) {
		    							echo "<td style='font-size: 0.1em; background: #f8bbd0;'></td>";
		    						}
		    						if ($problemFound == false && $intrFound == true && $lectFound == false && $dates_cnt_intr[$k] > 1 && $dates_cnt_intr[$k] <= 2) {
		    							echo "<td style='font-size: 0.1em; background: #f06292;'></td>";
		    						}
		    						if ($problemFound == false && $intrFound == true && $lectFound == false && $dates_cnt_intr[$k] > 2 && $dates_cnt_intr[$k] <= 3) {
		    							echo "<td style='font-size: 0.1em; background: #e91e63;'></td>";
		    						}
		    						if ($problemFound == false && $intrFound == true && $lectFound == false && $dates_cnt_intr[$k] > 3) {
		    							echo "<td style='font-size: 0.1em; background: #c2185b;'></td>";
		    						}

		    						if ($problemFound == true && $lectFound == true && $intrFound == false && $dates_cnt[$k] * $dates_cnt_lect[$k] > 0 && $dates_cnt[$k] * $dates_cnt_lect[$k] <= 1) {
		    							echo "<td style='font-size: 0.1em; background: #bbdefb;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == true && $intrFound == false && $dates_cnt[$k] * $dates_cnt_lect[$k] > 1 && $dates_cnt[$k] * $dates_cnt_lect[$k] <= 4) {
		    							echo "<td style='font-size: 0.1em; background: #64b5f6;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == true && $intrFound == false && $dates_cnt[$k] * $dates_cnt_lect[$k] > 4 && $dates_cnt[$k] * $dates_cnt_lect[$k] <= 9) {
		    							echo "<td style='font-size: 0.1em; background: #2196f3;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == true && $intrFound == false && $dates_cnt[$k] * $dates_cnt_lect[$k] > 9) {
		    							echo "<td style='font-size: 0.1em; background: #1976d2;'></td>";
		    						}

		    						if ($problemFound == true && $lectFound == false && $intrFound == true && $dates_cnt[$k] * $dates_cnt_intr[$k] > 0 && $dates_cnt[$k] * $dates_cnt_intr[$k] <= 1) {
		    							echo "<td style='font-size: 0.1em; background: #dcedc8;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == false && $intrFound == true && $dates_cnt[$k] * $dates_cnt_intr[$k] > 1 && $dates_cnt[$k] * $dates_cnt_intr[$k] <= 4) {
		    							echo "<td style='font-size: 0.1em; background: #aed581;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == false && $intrFound == true && $dates_cnt[$k] * $dates_cnt_intr[$k] > 4 && $dates_cnt[$k] * $dates_cnt_intr[$k] <= 9) {
		    							echo "<td style='font-size: 0.1em; background: #8bc34a;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == false && $intrFound == true && $dates_cnt[$k] * $dates_cnt_intr[$k] > 9) {
		    							echo "<td style='font-size: 0.1em; background: #689f38;'></td>";
		    						}

		    						if ($problemFound == false && $lectFound == true && $intrFound == true && $dates_cnt_lect[$k] * $dates_cnt_intr[$k] > 0 && $dates_cnt_lect[$k] * $dates_cnt_intr[$k] <= 1) {
		    							echo "<td style='font-size: 0.1em; background: #ffccbc;'></td>";
		    						}
		    						if ($problemFound == false && $lectFound == true && $intrFound == true && $dates_cnt_lect[$k] * $dates_cnt_intr[$k] > 1 && $dates_cnt_lect[$k] * $dates_cnt_intr[$k] <= 4) {
		    							echo "<td style='font-size: 0.1em; background: #ff8a65;'></td>";
		    						}
		    						if ($problemFound == false && $lectFound == true && $intrFound == true && $dates_cnt_lect[$k] * $dates_cnt_intr[$k] > 4 && $dates_cnt_lect[$k] * $dates_cnt_intr[$k] <= 9) {
		    							echo "<td style='font-size: 0.1em; background: #ff5722;'></td>";
		    						}
		    						if ($problemFound == false && $lectFound == true && $intrFound == true && $dates_cnt_lect[$k] * $dates_cnt_intr[$k] > 9) {
		    							echo "<td style='font-size: 0.1em; background: #e64a19;'></td>";
		    						}

		    						if ($problemFound == true && $lectFound == true && $intrFound == true && $dates_cnt[$k]* $dates_cnt_lect[$k] * $dates_cnt_intr[$k] > 0 && $dates_cnt[$k]* $dates_cnt_lect[$k] * $dates_cnt_intr[$k] <= 1) {
		    							echo "<td style='font-size: 0.1em; background: #cfd8dc;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == true && $intrFound == true && $dates_cnt[$k]* $dates_cnt_lect[$k] * $dates_cnt_intr[$k] > 1 && $dates_cnt[$k]* $dates_cnt_lect[$k] * $dates_cnt_intr[$k] <= 4) {
		    							echo "<td style='font-size: 0.1em; background: #90a4ae;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == true && $intrFound == true && $dates_cnt[$k]* $dates_cnt_lect[$k] * $dates_cnt_intr[$k] > 4 && $dates_cnt[$k]* $dates_cnt_lect[$k] * $dates_cnt_intr[$k] <= 9) {
		    							echo "<td style='font-size: 0.1em; background: #607d8b;'></td>";
		    						}
		    						if ($problemFound == true && $lectFound == true && $intrFound == true && $dates_cnt[$k]* $dates_cnt_lect[$k] * $dates_cnt_intr[$k] > 9) {
		    							echo "<td style='font-size: 0.1em; background: #455a64;'></td>";
		    						}

		    						if ($found == false)
			    						echo "<td style='font-size: 0.1em;'></td>";

			    					$cnt += 7;
			    				}
			    				echo "</tr>";
		    				}
		    				
		    				

		    			?>
		    		</table>
		    		<br/>
		      		
		      		<br/>
		      		<h2 style="font-weight: 100;">Statistics by problem diffculcy</h2>
		      		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;" border="1">
		      			<tr>
		      				<td style="width: 50%;">
		      					<div id="piechart_3d"></div>
		      				</td>
		      				<td valign="top" style="padding: 20px;">
		      					<div id="chart_div_problems"></div>
		      				</td>
		      			</tr>
		      		</table>
		      		<br/>
		      		<h2 style="font-weight: 100;">Problem solved and time spend each month</h2>
		      		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;" border="1">
		      			<tr>
		      				<td style="width: 50%;">
		      					<div id="chart_div"></div>
		      				</td>
		      				<td style="width: 50%;">
		      					<div id="chart_div_line"></div>
		      				</td>
		      			</tr>
		      		</table>
		      		<h2 style="font-weight: 100;">Interiew statistics</h2>
		      		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;" border="1">
		      			<tr>
		      				<td style="width: 50%;">
		      					<div id="chart_div_interview_pie"></div>
		      				</td>
		      				<td style="width: 50%; padding: 20px;">
		      					<div id="chart_div_interview_bar"></div>
		      				</td>
		      			</tr>
		      		</table>
		      		<br/>
		      		<h2 style="font-weight: 100;">Lecture / Tutorial listening</h2>
		      		<table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;" border="1">
		      			<tr>
		      				<td style="width: 50%;">
		      					<div id="chart_div_lecture_pie"></div>
		      				</td>
		      				<td style="width: 50%;">
		      					<div id="chart_div_lecture_hours"></div>
		      				</td>
		      			</tr>
		      		</table>
		      		<br/>
		      		
		      		<!-- <p style="text-align: right;">Share my performance to social media</p>
		      		<p style="text-align: right;">Download as <strong>.pdf</strong> or <strong>.jpg</strong></p> -->
		    	</section>
		  </div>
		  
		</div>
	</body>
</html>