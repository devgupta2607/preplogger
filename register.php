<html>
	<head>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    <script type="text/javascript">
	      	var cntOne = 0, cntTwo = 0, cntThree = 0;
	      	function startCounting() {
	      		document.getElementById("thinkStart").style = "background: #AAAAAA;";
			  	// Month Day, Year Hour:Minute:Second, id-of-element-container
			  	if (cntOne == 0)
			  		countUpFromTime(new Date(), 'countup1'); // ****** Change this line!
			  	cntOne++;
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
				        document.getElementById("problemTag").style="pointer-events:none;";
						// document.getElementById("thinkRecord").style="pointer-events:none;";
						// document.getElementById("hoursSpend").style="pointer-events:none;";
						// document.getElementById("slctproblemCorrectness").style="pointer-events:none;";
						// document.getElementById("problemImpl").style="pointer-events:none;";
						// document.getElementById("problemTestPassed").style="pointer-events:none;";
						document.getElementById("problemAddition").style.display ="none";
						// document.getElementById("slctStatus").style="pointer-events:none;";
						// document.getElementById("selectStatus").style.display = "none";
						// document.getElementById("added").style.display = "auto";
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
	    </script>
	    <link rel="stylesheet" type="text/css" href="theme.css">
	</head>
	<body style="background: #EEE;">
		<!-- <img src="imgs/bg3.png" style="position: absolute; top: 0px; z-index: -1; height: 50%;" /> -->
		<!-- <br/><br/><br/> -->
		<form action="registerController.php" method="post">
			<table align="center" width="100%" border="0" style="
						-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
						-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
						box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
						border-radius: 10px; background: rgba(255, 255, 255, 0.2); height: 100%;" cellspacing="0" cellpadding="20">
				<tr>
					<td width="50%" style="-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
											-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
											box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
											border-radius: 10px;
											background: #44a08d; /* Old browsers */
											background: -moz-linear-gradient(top,  #44a08d 0%, #093637 100%); /* FF3.6-15 */
											background: -webkit-linear-gradient(top,  #44a08d 0%,#093637 100%); /* Chrome10-25,Safari5.1-6 */
											background: linear-gradient(to bottom,  #44a08d 0%,#093637 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
											filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#44a08d', endColorstr='#093637',GradientType=0 ); /* IE6-9 */">
						<center>
							<table>
								<tr>
									<td valign="top">
										<center><img src="imgs/icon.png" style="width: 150px; border: 2px dashed #63d7cb; padding: 10px; border-radius: 100px;" /></center>
									</td>
								</tr>
								<tr>
									<td>
										<br/>
										<center>
											<h2 style="color: white; font-weight: 900;">
												Prep<span style="color: #63d7cb;">Logger</span>
											</h2>
										</center>
									</td>
								</tr>
								<tr>
									<td>
										<!-- <p style="color: white; font-size: 10em;">
											&ldquo;
										</p> -->

											<center>
												<p style="color: white; font-weight: 100; color: #DDD; width: 90%;">
													Discipline is the bridge between goals and accomplishment.
												</p>
												<hr style="width: 30%; border: 0px; border-bottom: 1px solid #FFF;"/>
												<p style="color: white; font-weight: 100; color: #DDD; width: 90%;">
													~Jim Rohn
												</p>
											</center>
									</td>
								</tr>
							</table>
						</center>
						
					</td>
					<td>
						<table border="0" width="100%" cellspacing="10">
							<tr>
								<td>
									<h2 style="font-weight: 100;">
										Sign up
									</h2>
								</td>
							</tr>
							<tr>
								<td>
									<p>
										User name
									</p>
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" style="width: 100%; border-radius: 4px; border: 1px solid #bbb; padding: 10px; background: rgba(200, 200, 200, 0.2);
																-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
																-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
																box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" name="username" />
									<br/>
								</td>
							</tr>
							<tr>
								<td>
									<p>
										Password
									</p>
								</td>
							</tr>
							<tr>
								<td>
									<input type="password" style="width: 100%; border-radius: 4px; border: 1px solid #bbb; padding: 10px; background: rgba(200, 200, 200, 0.2);
																	-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
																	-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
																	box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" name="password" />
									<br/>
								</td>
							</tr>
							<tr>
								<td>
									<p>
										Confirm password
									</p>
								</td>
							</tr>
							<tr>
								<td>
									<input type="password" style="width: 100%; border-radius: 4px; border: 1px solid #bbb; padding: 10px; background: rgba(200, 200, 200, 0.2);
																	-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
																	-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
																	box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" name="confirmPassword" />
									<br/><br/>
									<?php
										if (isset($_GET['error'])) {
											echo "<center><p style='color: #ef5350;'>*" . $_GET['error'] . "</p></center>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td>
									<a href="main.php"><input type="submit" style="width: 100%; border-radius: 4px; border: 1px solid #26a69a; padding: 10px; background: #44a08d; font-size: 1em; color: white;
																-webkit-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
																-moz-box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);
																box-shadow: 7px 7px 29px -11px rgba(170,170,170,1);" value="Sign up" /></a>
									<br/><br/>
								</td>
							</tr>
							<tr>
								<td>
									<hr style="border: 1px dashed #CCC;" />
								</td>
							</tr>
							<tr>
								<td>
									<br/>
									<p>
										Already have an account? Then 
										<a href="index.php" style="color: #00695c; text-decoration: none;">
											Login &#8594;
										</a>
									</p>
									
									<br/>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
		<br/>
		<center>Contact us at hello@preplogger.com</center>
	</body>
</html>