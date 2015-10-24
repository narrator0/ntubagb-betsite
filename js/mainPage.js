
//the argument will decide whitch page to load
function loadMain(page)
{
	$(".main").load("page/" + page + ".html");

	setNav();
}


//routing
/*
the routing here is really simple by changing the hash
and after "/" will be the id of the things you want to show.
for example "player/2" means that the page is showing a player whose ID is 2
*/
window.onhashchange = function(){
    if (window.location.hash == "" || window.location.hash == "#")
	    loadMain("home");
    else
        loadMain(window.location.hash.slice(1).split("/")[0]);
};


//initialize load
/*
i try to use mvc design pattern so this page will be the controll page which 
i load all the content dynamically to this page
*/

//load header file
$(".header").load("templates/header.html");

//load main page
//in case of always go to the same page when refreshing the page
if (window.location.hash == "" || window.location.hash == "#")
  loadMain("home");
else
  loadMain(window.location.hash.slice(1).split("/")[0]);

//load footer file
$(".footer").load("templates/footer.html");


//set nav bar
//the html file name must be the same as the id name of the nav tag
//the file must be placed under the page folder
function setNav()
{
	$('.navbar-collapse a').click(function(){
	    $(".navbar-collapse").collapse('hide');
	});
	
	$(".navTag").removeClass("active");

	if (window.location.hash == "")
		$('#home').addClass("active");
	else if (window.location.hash.slice(1).split('/')[0] == 'pictureSingle')
		$('#pictureAll').addClass("active");
	else
		$('#' + window.location.hash.slice(1).split("/")[0]).addClass("active");

	//collapse onclick
	$('.nav a').on('click', function(){
    	$(".btn-navbar").click() 
	});

}

//----------------------------------------------------------


///
///data dealing
///

(function($){

	//this function counts the rate of 2-p shot, 3-p shot and free shot
	function countData(tableData)
	{
		for (var j = 0; j < tableData.length; j++)
		{
			tableData[j]['兩分球'] = tableData[j]['兩分進球'] + '-' + tableData[j]['兩分失手'];
			tableData[j]['兩分進球率'] = tableData[j]['兩分進球'] / (parseFloat(tableData[j]['兩分進球']) + parseFloat(tableData[j]['兩分失手']));
			if (tableData[j]['兩分進球'] == 0 && tableData[j]['兩分失手'] == 0)
				tableData[j]['兩分進球率'] = 'x';
			else
				tableData[j]['兩分進球率'] = Math.round(tableData[j]['兩分進球率'] * 100) + '%';

			tableData[j]['三分球'] = tableData[j]['三分進球'] + '-' + tableData[j]['三分失手'];
			tableData[j]['三分進球率'] = tableData[j]['三分進球'] / (parseFloat(tableData[j]['三分進球']) + parseFloat(tableData[j]['三分失手']));
			if (tableData[j]['三分進球'] == 0 && tableData[j]['三分失手'] == 0)
				tableData[j]['三分進球率'] = 'x';
			else
				tableData[j]['三分進球率'] = Math.round(tableData[j]['三分進球率'] * 100) + '%';

			tableData[j]['罰球'] = tableData[j]['罰球進球'] + '-' + tableData[j]['罰球失手'];
			tableData[j]['罰球進球率'] = tableData[j]['罰球進球'] / (parseFloat(tableData[j]['罰球進球']) + parseFloat(tableData[j]['罰球失手']));
			if (tableData[j]['罰球進球'] == 0 && tableData[j]['罰球失手'] == 0)
				tableData[j]['罰球進球率'] = 'x';
			else
				tableData[j]['罰球進球率'] = Math.round(tableData[j]['罰球進球率'] * 100) + '%';

			tableData[j]['效率'] = 2 * parseInt(tableData[j]['兩分進球']) + 3 * parseInt(tableData[j]['三分進球']) + parseInt(tableData[j]['罰球進球'])
				+ parseInt(tableData[j]['進攻籃板']) + parseInt(tableData[j]['防守籃板']) + parseInt(tableData[j]['助攻']) + parseInt(tableData[j]['抄截'])
				+ parseInt(tableData[j]['阻攻']) - parseInt(tableData[j]['兩分失手']) - parseInt(tableData[j]['三分失手']) - parseInt(tableData[j]['罰球失手'])
				- parseInt(tableData[j]['失誤']);

		}
	}

	//this is use to create Game data(all games from spacific cup)
	function setTableGame(playerData, gameData, i)
	{
		var hashInfo = window.location.hash.slice(1).split('/');
		var cupId = hashInfo[1];
		var tableData;

		$.when(
			$.getJSON('manage/data/' + cupId + '-' + gameData[i]['id'] + '.json', function(data){
				tableData = data;
			})
		).then(function(){

			countData(tableData);

			for (var j = 0; j < tableData.length; j++)
			{
				for (var k = 0; k < playerData.length; k++)
				{
					if (tableData[j]['player_id'] == playerData[k]['id'])
						tableData[j]['球員'] = "<a href='#dataGame/player/" + playerData[k]['id'] + "'>" + playerData[k]['name'] + "</a>";
				}
			}
			

			$('.dataTable' + gameData[i]['id']).tgs(tableData);


		});
	}

	//this is use to create cup table data
	function setTableCup(id, playerData, gameData)
	{
		var tableData;
		var hashInfo = window.location.hash.slice(1).split('/');
		var cupId = hashInfo[1];

		$.when(
			$.getJSON('manage/data/' + id + '.json', function(data){
				tableData = data;
			})
		).then(function(){
			
			countData(tableData);
			
			for (var j = 0; j < tableData.length; j++)
			{
				for (var k = 0; k < playerData.length; k++)
				{
					if (tableData[j]['player_id'] == playerData[k]['id'])
						tableData[j]['球員'] = "<a href='#dataGame/player/" + playerData[k]['id'] + "'>" + playerData[k]['name'] + "</a>";
				}

				tableData[j]['效率'] = Math.round(parseFloat(tableData[j]['效率']) / parseFloat(tableData[j]['count']) * 100) / 100;
			}


			$('.dataTable' + id).tgs(tableData);
		});
	}

	function setTablePlayer(playerId, cupData, gameData)
	{
		var tableData, arrangedData = [], addUpData = [];

		$.when(
			$.getJSON('manage/data/player' + playerId + '.json', function(data){
				tableData = data;
			})
		).then(function(){

			var cupName, gameEnemy;

			addUpData['兩分進球'] = parseInt(tableData[0]['兩分進球']);
			addUpData['兩分失手'] = parseInt(tableData[0]['兩分失手']);
			addUpData['三分進球'] = parseInt(tableData[0]['三分進球']);
			addUpData['三分失手'] = parseInt(tableData[0]['三分失手']);
			addUpData['罰球進球'] = parseInt(tableData[0]['罰球進球']);
			addUpData['罰球失手'] = parseInt(tableData[0]['罰球失手']);
			addUpData['防守籃板'] = parseInt(tableData[0]['防守籃板']);
			addUpData['進攻籃板'] = parseInt(tableData[0]['進攻籃板']);
			addUpData['失誤'] = parseInt(tableData[0]['失誤']);
			addUpData['助攻'] = parseInt(tableData[0]['助攻']);
			addUpData['抄截'] = parseInt(tableData[0]['抄截']);
			addUpData['阻攻'] = parseInt(tableData[0]['阻攻']);
			addUpData['犯規'] = parseInt(tableData[0]['犯規']);
			addUpData['效率'] = parseInt(tableData[0]['效率']);

			for (var i = 1; i < tableData.length; i++)
			{
				for (title in tableData[i])
				{
					addUpData[title] += parseInt(tableData[i][title]);
				}
			}

			addUpData['盃賽'] = '總和';
			addUpData['對手'] = 'x';

			tableData.push(addUpData);

			countData(tableData);

			for (var j = 0; j < tableData.length; j++)
			{
				for (var k = 0; k < cupData.length; k++)
				{
					if (cupData[k]['id'] == tableData[j]['cup_id'] && typeof tableData[j]['cup_id'] != 'undefined')
					{
						cupName = cupData[k]['name'];
						tableData[j]['盃賽'] = "<a href='#dataGame/" + tableData[j]['cup_id'] + "'>" + cupName + "</a>";
					}
				}

				for (var k = 0; k < gameData.length; k++)
				{
					if (gameData[k]['id'] == tableData[j]['game_id'] && typeof tableData[j]['game_id'] != 'undefined')
					{
						gameEnemy = gameData[k]['vs'];
						tableData[j]['對手'] = "<a href='#dataGame/" + tableData[j]['cup_id'] + "/" + tableData[j]['game_id'] + "'>" + gameEnemy + "</a>";
					}
				}

				if (tableData[j]['盃賽'] == '總和')
					tableData[j]['效率'] = Math.round(parseFloat(tableData[j]['效率']) / (tableData.length - 1) * 100) / 100;
			}


			
			for (var i = 0; i < cupData.length; i++)
				for (var j = 0; j < tableData.length; j++)
				{
					if (tableData[j]['cup_id'] == cupData[i]['id'])
						arrangedData.push(tableData[j]);
				}

			//put the add up data into arrangedData
			arrangedData.push(tableData[tableData.length - 1]);
			

			$('.dataTable').tgs(tableData);


		});
	}

	$.createDataPage = function(){
		var hashInfo = window.location.hash.slice(1).split('/');
		var cupId = hashInfo[1];
		var gameId = hashInfo[2];
		var playerData, cupData, gameData;
		var gameName, cupName;

		$.when(

			$.getJSON('manage/data/player.json', function(data){
				playerData = data;
			}),
			$.getJSON('manage/data/game.json', function(data){
				gameData = data;
			}),
			$.getJSON('manage/data/cup.json', function(data){
				cupData = data;
			})

		).then(function(){

			//this method detects which mode the user is in dataCup, dataGame or some single game
			if (cupId == 'player')
			{
				/*
					1. first find the player name and put it title
					2. get the data of the player
					3. search of cup name and game name for each data
					4. also add up all data and put it on top
					5. link all data to its own place
				*/

				var playerName;
				for (var i = 0; i < playerData.length; i++)
				{
					//in this case the player id will be hashInfo[2]
					if (playerData[i]['id'] == gameId)
					{
						playerName = playerData[i]['name'];
						$('.dataContainer').append("<div class='tableItem'><h2 class='tableTitle'>" + playerName + "</h2><table class='dataTable'><thead><tr><th>盃賽</th><th>對手</th><th>兩分球</th><th>兩分進球率</th><th>三分球</th><th>三分進球率</th><th>罰球</th><th>罰球進球率</th><th>防守籃板</th><th>進攻籃板</th><th>失誤</th><th>助攻</th><th>抄截</th><th>阻攻</th><th>犯規</th><th>效率</th></tr></thead><tbody></tbody></table></div>");
					}
				}

				setTablePlayer(gameId, cupData, gameData);
			}
			else if (typeof cupId === 'undefined')
			{
				//dataCup
				var i;
				for (i = 0; i < cupData.length; i++)
				{
					$('.dataContainer').append("<div class='tableItem'><label class='tableTitle tableTitle" + cupData[i]['id'] + "'></label><label class='cupYear'>" + cupData[i]['year'] + "</label><table class='dataTable" + cupData[i]['id'] + " dataTable'><thead><tr><th>球員</th><th>兩分球</th><th>兩分進球率</th><th>三分球</th><th>三分進球率</th><th>罰球</th><th>罰球進球率</th><th>防守籃板</th><th>進攻籃板</th><th>失誤</th><th>助攻</th><th>抄截</th><th>阻攻</th><th>犯規</th><th>效率</th></tr></thead><tbody></tbody></table></div>");

					cupName = cupData[i]['name'];
					$('.tableTitle' + cupData[i]['id']).html("<a href='#dataGame/" + cupData[i]['id'] + "'>" + cupName + "</a>");

					setTableCup(cupData[i]['id'], playerData, gameData);
				}


			}
			else if (typeof gameId === 'undefined')
			{
				//dataGame
				var cupName;
				for (var i = 0; i < cupData.length; i++)
				{
					if (cupData[i]['id'] == cupId)
					{
						cupName = cupData[i]['name'];
						$('.dataContainer').prepend("<label class='tableTitle'>" + cupName + "</label><label class='cupYear'>" + cupData[i]['year'] + "</label>")
						break;
					}
				}

				//this will be the dataGame mode which view all games in the selected cup
				for (var i = 0; i < gameData.length; i++)
				{
					if (gameData[i]['cup_id'] == cupId)
					{
						$('.dataContainer').append("<div class='tableItem'><h2 class='tableTitle tableTitle" + gameData[i]['id'] + "'></h2><table class='dataTable" + gameData[i]['id'] + " dataTable'><thead><tr><th>球員</th><th>兩分球</th><th>兩分進球率</th><th>三分球</th><th>三分進球率</th><th>罰球</th><th>罰球進球率</th><th>防守籃板</th><th>進攻籃板</th><th>失誤</th><th>助攻</th><th>抄截</th><th>阻攻</th><th>犯規</th><th>效率</th></tr></thead><tbody></tbody></table></div>");


						gameName = "工管女籃 vs. " + gameData[i]['vs'];
						$('.tableTitle' + gameData[i]['id']).html("<a href='#dataGame/" + cupId + "/" + gameData[i]['id'] + "' class = 'game-title'>" + gameName + "</a><label class = 'point'>" + gameData[i]['our_point'] + "-" + gameData[i]['enemy_point'] + "</label>");

						setTableGame(playerData, gameData, i);

					}
				}
			}
			else
			{

				//here will give the browser a single game view
				$('.dataContainer').html("<div class='tableItem'><label class='cupTitle'></label><label class='cupYear'></label><h2 class='tableTitle'></h2><table class='dataTable'><thead><tr><th>球員</th><th>兩分球</th><th>兩分進球率</th><th>三分球</th><th>三分進球率</th><th>罰球</th><th>罰球進球率</th><th>防守籃板</th><th>進攻籃板</th><th>失誤</th><th>助攻</th><th>抄截</th><th>阻攻</th><th>犯規</th><th>效率</th></tr></thead><tbody></tbody></table></div>");

				$.getJSON('manage/data/' + cupId + '-' + gameId + '.json', function(tableData){
				
				var i;

				var cupName;
				for (var i = 0; i < cupData.length; i++)
				{
					if (cupData[i]['id'] == cupId)
					{
						cupName = cupData[i]['name'];
						$('.cupTitle').html("<a href='#dataGame/" + cupData[i]['id'] + "'>" + cupName + "</a>");
						$('.cupYear').html(cupData[i]['year']);
						break;
					}
				}

				for (i = 0; i < tableData.length; i++)
				{
					for (j = 0; j < playerData.length; j++)
					{
						if (tableData[i]['player_id'] == playerData[j]['id'])
							tableData[i]['球員'] = playerData[j]['name'];
					}
				}

				for (i = 0; i < gameData.length; i++)
				{
					if (gameData[i]['id'] == gameId)
					{
						gameName = "工管女籃 vs. " + gameData[i]['vs'];
						$('.tableTitle').text(gameName);
					}
				}

				countData(tableData);

				for (j = 0; j < tableData.length; j++)
				{
					for (k = 0; k < playerData.length; k++)
					{
						if (tableData[j]['player_id'] == playerData[k]['id'])
							tableData[j]['球員'] = "<a href='#dataGame/player/" + playerData[k]['id'] + "'>" + playerData[k]['name'] + "</a>";
					}
				}

				

				$('.dataTable').tgs(tableData);
				
				});
			}

			

			$(".footer").load("templates/footer.html");

		});
	};


})(jQuery);
















