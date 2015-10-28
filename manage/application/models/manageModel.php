<?php 

	class manageModel extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		//----------private functions----------

		//upload file into JSON data
		private function uploadJSON($fileName)
		{
			//use to write JSON files
			$this->load->helper('file');

			$query = $this->db->get($fileName);
			$json = json_encode($query->result_array());

			if ( ! write_file('data/' . $fileName . '.json', $json, 'w'))
			{
			        echo 'Unable to write the file<br>';
			}
			else
			{
			        echo 'File written!<br>';
			}
		}

		//this method is to write every game data into json at once
		private function uploadAllGameData()
		{
			$query = $this->db->get('cup');

			foreach ($query->result_array() as $cupItem)
			{
				$query = $this->db->get_where('game', array('cup_id' => $cupItem['id']));

				$cupData = NULL;

				foreach ($query->result_array() as $gameItem)
				{
					$query = $this->db->get_where('player_data', array('cup_id' => $cupItem['id'], 'game_id' => $gameItem['id']));

					$data = $query->result_array();

					//here add all the data in one cup
					if (isset($cupData))
					{
						foreach ($data as $dataItem)
						{
						
							$k = 0;

							for ($k = 0; $k < count($cupData); $k ++)
							{
								if ($cupData[$k]['player_id'] == $dataItem['player_id'])
								{
									$cupData[$k]['兩分進球'] += $dataItem['兩分進球'];
									$cupData[$k]['兩分失手'] += $dataItem['兩分失手'];
									$cupData[$k]['三分進球'] += $dataItem['三分進球'];
									$cupData[$k]['三分失手'] += $dataItem['三分失手'];
									$cupData[$k]['罰球進球'] += $dataItem['罰球進球'];
									$cupData[$k]['罰球失手'] += $dataItem['罰球失手'];
									$cupData[$k]['防守籃板'] += $dataItem['防守籃板'];
									$cupData[$k]['進攻籃板'] += $dataItem['進攻籃板'];
									$cupData[$k]['失誤'] += $dataItem['失誤'];
									$cupData[$k]['助攻'] += $dataItem['助攻'];
									$cupData[$k]['抄截'] += $dataItem['抄截'];
									$cupData[$k]['阻攻'] += $dataItem['阻攻'];
									$cupData[$k]['犯規'] += $dataItem['犯規'];
									$cupData[$k]['效率'] += $dataItem['效率'];
									$cupData[$k]['count'] ++;

									break;
								}

								if ($k == count($cupData) - 1)
								{
									array_push($cupData, array(
										'player_id' => $dataItem['player_id'],
										'兩分進球' => $dataItem['兩分進球'],
										'兩分失手' => $dataItem['兩分失手'],
										'三分進球' => $dataItem['三分進球'],
										'三分失手' => $dataItem['三分失手'],
										'罰球進球' => $dataItem['罰球進球'],
										'罰球失手' => $dataItem['罰球失手'],
										'防守籃板' => $dataItem['防守籃板'],
										'進攻籃板' => $dataItem['進攻籃板'],
										'失誤' => $dataItem['失誤'],
										'助攻' => $dataItem['助攻'],
										'抄截' => $dataItem['抄截'],
										'阻攻' => $dataItem['阻攻'],
										'犯規' => $dataItem['犯規'],
										'效率' => $dataItem['效率'],
										'count' => 1

									));
								}
							}
						}
						
					}
					else
					{
						$cupData = $data;

						foreach ($cupData as &$cupDataItem)
						{
							$cupDataItem['count'] = 1;
						}
					}
					
					//use to write JSON files
					$this->load->helper('file');

					$json = json_encode($data);

					if ( ! write_file('data/' . $cupItem['id'] . '-' . $gameItem['id'] . '.json', $json, 'w'))
					{
					        echo 'Unable to write the file<br>';
					}
					else
					{
					        echo 'File data/' . $cupItem['id'] . '-' . $gameItem['id'] . '.json written!<br>';
					}

				}

				//devide by the number of games which per player is involved
				/*
				if (isset($cupData))
				{
					foreach ($cupData as &$cupDataItem)
					{
						$query = $this->db->get_where('player_data', array('cup_id' => $cupItem['id'], 'player_id' => $cupDataItem['player_id']));

						$numberOfGames = count($query->result_array());

						
						if ($numberOfGames != 0)
						{
							$cupDataItem['兩分進球'] /= $numberOfGames;
							$cupDataItem['兩分失手'] /= $numberOfGames;
							$cupDataItem['三分進球'] /= $numberOfGames;
							$cupDataItem['三分失手'] /= $numberOfGames;
							$cupDataItem['罰球進球'] /= $numberOfGames;
							$cupDataItem['罰球失手'] /= $numberOfGames;
							$cupDataItem['防守籃板'] /= $numberOfGames;
							$cupDataItem['進攻籃板'] /= $numberOfGames;
							$cupDataItem['失誤'] /= $numberOfGames;
							$cupDataItem['助攻'] /= $numberOfGames;
							$cupDataItem['抄截'] /= $numberOfGames;
							$cupDataItem['阻攻'] /= $numberOfGames;
							$cupDataItem['犯規'] /= $numberOfGames;
							$cupDataItem['效率'] /= $numberOfGames;
						}
						
					}
				}
				*/
				
				//use to write JSON files
				$this->load->helper('file');

				$json = json_encode($cupData);

				if ( ! write_file('data/' . $cupItem['id'] . '.json', $json, 'w'))
				{
				        echo 'Unable to write the file<br>';
				}
				else
				{
				        echo 'File data/' . $cupItem['id'] . '.json written!<br>';
				}

			}



			//here output the file of the players
			$query = $this->db->get('player');

			foreach ($query->result_array() as $playerItem)
			{
				$query = $this->db->get_where('player_data', array('player_id' => $playerItem['id']));

				//use to write JSON files
				$this->load->helper('file');

				$json = json_encode($query->result_array());

				if ( ! write_file('data/player' . $playerItem['id'] . '.json', $json, 'w'))
				{
				        echo 'Unable to write the file<br>';
				}
				else
				{
				        echo 'File data/player' . $playerItem['id'] . '.json written!<br>';
				}
			}
		}

		private function deleteFile($fileName)
		{
			if(unlink('data/' . $fileName . '.json')) {
			     echo 'deleted successfully';
			}
			else {
			     echo 'errors occured';
			}
		}

		//----------private ends----------

		
		///
		///----------data for video, pictures and player----------
		///

		//----------query---------

		public function getData($dataName)
		{
			$query = $this->db->get($dataName);
			return $query->result_array();
		}

		public function getRowData($dataName, $dataId)
		{
			$query = $this->db->get_where($dataName, array('id' => $dataId));
			return $query->row_array();
		}

		public function getSampleData($dataName)
		{
			if ($dataName == 'statistic')
				$dataName = 'player_data';

			$query = $this->db->get($dataName);
			return $query->row_array();
		}

		//---------delete----------

		//this function is in use of a lot of places
		public function deleteData($dataName, $dataId)
		{
			$this->db->delete($dataName, array('id' => $dataId));
			$this->uploadJSON($dataName);
		}

		//---------video---------

		public function createVideo()
		{
			//get youtube id using regular expression
			$link = $this->input->post('link');
			$reg = "/v=([^&]*)/";

			preg_match($reg, $link, $match);


			$data = array(
				'title' => $this->input->post('title'),
				'link' => "https://www.youtube.com/embed/" . $match[1]
			);

			$this->db->insert('video', $data);
			$this->uploadJSON('video');
		}

		public function changeVideo($dataId)
		{
			//get youtube id using regular expression
			$link = $this->input->post('link');
			$reg = "/embed\/(.+)|v=([^&]*)/";

			preg_match($reg, $link, $match);

			if (isset($match[2]))
				$match[1] = $match[2];

			$data = array(
				'id' => $dataId,
				'title' => $this->input->post('title'),
				'link' => "https://www.youtube.com/embed/" . $match[1]
			);

			$this->db->replace('video', $data);
			$this->uploadJSON('video');
		}

		//----------picture----------

		public function createPicture()
		{
			$data = array(
				'name' => $this->input->post('name'),
				'size' => $this->input->post('size')
			);

			$this->db->insert('picture', $data);
			$this->uploadJSON('picture');
		}

		public function changePicture($dataId)
		{
			$data = array(
				'id' => $dataId,
				'name' => $this->input->post('name'),
				'size' => $this->input->post('size')
			);

			$this->db->replace('picture', $data);
			$this->uploadJSON('picture');
		}

		//----------player----------

		public function createPlayer()
		{
			$data = array(
				'name' => $this->input->post('name'),
				'number' => $this->input->post('number'),
				'grade' => $this->input->post('grade')
			);

			$this->db->insert('player', $data);
			$this->uploadJSON('player');
			$this->uploadAllGameData();
		}

		public function changePlayer($dataId)
		{
			$data = array(
				'id' => $dataId,
				'name' => $this->input->post('name'),
				'grade' => $this->input->post('grade'),
				'number' => $this->input->post('number')
			);

			$this->db->replace('player', $data);
			$this->uploadJSON('player');
		}


		///
		///here start the area for statistics
		///

		//----------cup----------

		public function getCup()
		{
			$query = $this->db->get('cup');
			$cupData = $query->result_array();

			return $cupData;
		}

		public function deleteCup($dataId)
		{
			$this->deleteFile($dataId);

			$query = $this->db->get_where('game', array('cup_id' => $dataId));
			$result = $query->result_array();

			if (!empty($result))
			{
				foreach ($result as $item)
				{
					$this->deleteFile($dataId . '-' . $item['id']);
				}
			}


			//delete all related data
			$this->db->delete('cup', array('id' => $dataId));
			$this->db->delete('game', array('cup_id' => $dataId));
			$this->db->delete('player_data', array('cup_id' => $dataId));

			$this->uploadJSON('cup');
			$this->uploadJSON('game');
			$this->uploadAllGameData();
		}


		public function createCup()
		{
			$data = array(
				'name' => $this->input->post('name'),
				'year' => $this->input->post('year')
			);

			$this->db->insert('cup', $data);
			$this->uploadJSON('cup');
			$this->uploadAllGameData();
		}

		public function changeCup($dataId)
		{
			$data = array(
				'id' => $dataId,
				'name' => $this->input->post('name'),
				'year' => $this->input->post('year')
			);

			$this->db->replace('cup', $data);
			$this->uploadJSON('cup');
		}


		//----------game----------

		public function getGame($cupId)
		{
			$query = $this->db->get_where('game', array('cup_id' => $cupId));
			$gameData = $query->result_array();

			return $gameData;
		}

		public function createGame($cupId)
		{
			$data = array(
				'cup_id' => $cupId,
				'date' => $this->input->post('date'),
				'vs' => $this->input->post('vs'),
				'our_point' => $this->input->post('our_point'),
				'enemy_point' => $this->input->post('enemy_point')
			);


			$this->db->insert('game', $data);
			$this->uploadJSON('game');
			$this->uploadAllGameData();
		}

		public function deleteGame($cupId, $gameId)
		{
			$this->deleteFile($cupId . '-' . $gameId);

			$this->db->delete('game', array('id' => $gameId));
			$this->db->delete('player_data', array('game_id' => $gameId));

			$this->uploadJSON('game');
			$this->uploadAllGameData();
		}

		public function changeGame($dataId, $cupId)
		{
			$data = array(
				'id' => $dataId,
				'cup_id' => $cupId,
				'date' => $this->input->post('date'),
				'vs' => $this->input->post('vs'),
				'our_point' => $this->input->post('our_point'),
				'enemy_point' => $this->input->post('enemy_point')
			);


			$this->db->replace('game', $data);
			$this->uploadJSON('game');
			$this->uploadAllGameData();
		}

		//---------statistic---------

		public function getStatistic($gameId)
		{
			$query = $this->db->get_where('player_data', array('game_id' => $gameId));
			$result = $query->result_array();

			foreach ($result as &$item)
			{
				$playerId = $item['player_id'];

				$query = $this->db->get_where('player', array('id' => $playerId));
				$rowData = $query->row_array();

				$item['player_id'] = $rowData['name'];
			}

			return $result;
		}

		public function getUndataPlayer($gameId)
		{
			//when you create, you don't need to create an exist data. use change instead.
			/*
			1. get player data
			2. get statistic of the game
			3. compare them and delete the data witch is written 
			*/

			$query = $this->db->get('player');
			$playerData = $query->result_array();

			$query = $this->db->get_where('player_data', array('game_id' => $gameId));
			$statisticData = $query->result_array();

			

			foreach ($statisticData as $dataItem)
			{
				$indexToRemove = NULL;

				for ($i = 0; $i < count($playerData); $i ++)
				{
					if ($playerData[$i]['id'] == $dataItem['player_id'])
						$indexToRemove = $i;
				}

				array_splice($playerData, $indexToRemove, 1);
			}
			

			return $playerData;
		}

		public function createSingleStatistic($gameId)
		{
			$query = $this->db->get_where('game', array('id' => $gameId));
			$cupId = $query->row_array()['cup_id'];

			$data = array(
				'cup_id' => $cupId,
				'game_id' => $gameId,
				'player_id' => $this->input->post('playerId'),
				'兩分進球' => $this->input->post('兩分進球'),
				'兩分失手' => $this->input->post('兩分失手'),
				'三分進球' => $this->input->post('三分進球'),
				'三分失手' => $this->input->post('三分失手'),
				'罰球進球' => $this->input->post('罰球進球'),
				'罰球失手' => $this->input->post('罰球失手'),
				'防守籃板' => $this->input->post('防守籃板'),
				'進攻籃板' => $this->input->post('進攻籃板'),
				'失誤' => $this->input->post('失誤'),
				'助攻' => $this->input->post('助攻'),
				'抄截' => $this->input->post('抄截'),
				'阻攻' => $this->input->post('阻攻'),
				'犯規' => $this->input->post('犯規'),
				'效率' => 0
			);

			$this->db->insert('player_data', $data);
			$this->uploadAllGameData();
		}

		public function deleteStatistic($dataId)
		{
			$this->db->delete('player_data', array('id' => $dataId));

			$this->uploadAllGameData();
		}

		public function changeStatistic($cupId, $gameId, $player_id, $dataId)
		{
			$data = array(
					'id' => $dataId,
					'cup_id' => $cupId,
					'game_id' => $gameId,
					'player_id' => $player_id,
					'兩分進球' => $this->input->post('兩分進球'),
					'兩分失手' => $this->input->post('兩分失手'),
					'三分進球' => $this->input->post('三分進球'),
					'三分失手' => $this->input->post('三分失手'),
					'罰球進球' => $this->input->post('罰球進球'),
					'罰球失手' => $this->input->post('罰球失手'),
					'防守籃板' => $this->input->post('防守籃板'),
					'進攻籃板' => $this->input->post('進攻籃板'),
					'失誤' => $this->input->post('失誤'),
					'助攻' => $this->input->post('助攻'),
					'抄截' => $this->input->post('抄截'),
					'阻攻' => $this->input->post('阻攻'),
					'犯規' => $this->input->post('犯規'),
					'效率' => 0
				);

			$this->db->replace('player_data', $data);
			$this->uploadAllGameData();
		}


		//----------data ends----------


		//the test function
		public function updateAll()
		{
			$this->uploadAllGameData();
			$this->uploadJSON('picture');
			$this->uploadJSON('video');
			$this->uploadJSON('cup');
			$this->uploadJSON('player');
			$this->uploadJSON('game');
		}

		public function test()
		{
			
			$query = $this->db->get_where('player_data', array('cup_id' => 1));
			$result = $query->result_array();

			print_r($result);

		}

















	}


 ?>