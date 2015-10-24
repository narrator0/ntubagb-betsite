<?php 


	class manageModel extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}



		///
		///here starts videos
		///

		//this method updates the json files
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

		//------------videos--------------------

		public function uploadVideo()
		{
			$data = array(
				'title' => $this->input->post('title'),
				'link' => "https://www.youtube.com/embed/" . $this->input->post('link')
			);


			$this->db->insert('video', $data);

			$this->uploadJSON('video');
		}

		public function deleteVideo()
		{
			$query = $this->db->get_where('video', array('link' => "https://www.youtube.com/embed/" . $this->input->post('id')));
			if (! $query->row_array())
			{
				echo "no data found<br>";
				return "fail";
			}
			else
			{
				$this->db->delete('video', array('link' => "https://www.youtube.com/embed/" . $this->input->post('id')));

				$this->uploadJSON('video');
			}
			
		}


		//-----------------------pictures---------------------------------

		public function uploadPicture()
		{
			$data = array(
				'name' => $this->input->post('name'),
				'size' => $this->input->post('size')
			);

			$this->db->insert('album', $data);

			$this->uploadJSON('album');
		}

		public function deletePicture()
		{
			$query = $this->db->get_where('album', array('name' => $this->input->post('name')));
			if (! $query->row_array())
			{
				echo "no data found<br>";
				return "fail";
			}
			else
			{
				$this->db->delete('album', array('name' => $this->input->post('name')));

				$this->uploadJSON('album');
			}
		}


		///
		///here start to deal with datas
		///

		//this method is to write every game data into json at once
		public function dataUpdate()
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

			$this->uploadJSON('game');
			$this->uploadJSON('cup');
			$this->uploadJSON('player');
		}

		//----------data(for specific game)-----------
		public function addData()
		{
			$data = array(
					'cup_id' => $this->input->post('cup'),
					'game_id' => $this->input->post('game'),
					'player_id' => $this->input->post('player'),
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
		}

		public function getCupData()
		{
			$query = $this->db->get('cup');

			return $query->result_array();
		}

		public function getPlayerData()
		{
			$query = $this->db->get('player');

			return $query->result_array();
		}



		//----------players---------

		public function addPlayer()
		{
			$data = array(
				'name' => $this->input->post('name'),
				'number' => $this->input->post('number'),
				'grade' => $this->input->post('grade')
			);

			$this->db->insert('player', $data);

			$this->uploadJSON('player');
		}


		//----------games-------------

		public function addGame()
		{

			//find the id of the cup name which is typed in 
			$query = $this->db->get_where('cup', array('name' => $this->input->post('cup_id')));
			$cup_id = $query->row_array();
			$cup_id = $cup_id['id'];

			$data = array(
				'cup_id' => $cup_id,
				'date' => $this->input->post('date'),
				'vs' => $this->input->post('vs'),
				'our_point' => $this->input->post('our_point'),
				'enemy_point' => $this->input->post('enemy_point')
			);

			$this->db->insert('game', $data);

			$this->uploadJSON('game');
		}

		//-------------cups----------------

		public function addCup()
		{
			$data = array(
				'name' => $this->input->post('name'),
				'year' => (int)$this->input->post('year')
			);

			$this->db->insert('cup', $data);

			$this->uploadJSON('cup');
		}


		public function deleteCup()
		{
			$id = $this->input->post('cup');
			

			$data = array('id' => $id);
			$this->db->delete('cup', $data);
			$this->uploadJSON('cup');

			$data = array('cup_id' => $id);
			$this->db->delete('game', $data);
			$this->db->delete('player_data', $data);
			$this->uploadJSON('game');
		}


		//------------------------------

		public function getVideoData($videoId = NULL)
		{
			if (empty($videoId))
			{
				$query = $this->db->get('video');
				return $query->result_array();
			}
			else
			{
				$query = $this->db->get_where('video', array('id' => $videoId));
				return $query->row_array();
			}
		}

		public function fixVideo($videoId)
		{
			$data = array(
				'id' => $videoId,
				'title' => $this->input->post('title'),
				'link' => $this->input->post('link')
			);

			$this->db->replace('video', $data);

			$this->uploadJSON('video');
		}

	}




 ?>