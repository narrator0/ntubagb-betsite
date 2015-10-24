<?php 



	class manageController extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('manageModel');
		}


		public function index()
		{
			$data['title'] = "Data Manage Main Page";


			$this->load->view('templates/header', $data);
			$this->load->view('page/mainPage', $data);
			$this->load->view('templates/footer', $data);
		}

		///
		///this block is for data managing
		///

		//this is for managing video, picture, and member
		public function viewData($dataName)
		{
			$data['title'] = "Data Managing";
			$data['dataName'] = $dataName;
			$data['sampleRowData'] = $this->manageModel->getSampleData($dataName);	
			$data['data'] = $this->manageModel->getData($dataName);
			

			$this->load->view('templates/header', $data);
			$this->load->view('page/view/viewData', $data);
			$this->load->view('templates/footer', $data);
		}


		public function deleteData($dataName, $dataId)
		{
			$this->manageModel->deleteData($dataName, $dataId);
			header("Location: /web/manage/index.php/manageController/viewData/" . $dataName);
		}

		
		//---------video----------

		public function createVideo()
		{
			$data['title'] = "Create New video";

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('title', 'Title', 'required');
    		$this->form_validation->set_rules('link', 'Link', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/create/createVideo', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->createVideo();
		        header("Location: /web/manage/index.php/manageController/viewData/video");
		    }
		}

		public function changeVideo($dataId)
		{
			$data['title'] = "Change video data";
			$data['videoData'] = $this->manageModel->getRowData('video', $dataId);

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('title', 'Title', 'required');
    		$this->form_validation->set_rules('link', 'Link', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/change/changeVideo', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->changeVideo($dataId);
		        header("Location: /web/manage/index.php/manageController/viewData/video");
		    }
		}

		//----------picture----------

		public function createPicture()
		{
			$data['title'] = "Create New pictures";

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('name', 'Name', 'required');
    		$this->form_validation->set_rules('size', 'Size', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/create/createPicture', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->createPicture();
		        header("Location: /web/manage/index.php/manageController/viewData/picture");
		    }
		}

		public function changePicture($dataId)
		{
			$data['title'] = "Change picture data";
			$data['pictureData'] = $this->manageModel->getRowData('picture', $dataId);

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('name', 'Name', 'required');
    		$this->form_validation->set_rules('size', 'Size', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/change/changePicture', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->changePicture($dataId);
		        header("Location: /web/manage/index.php/manageController/viewData/picture");
		    }
		}

		//---------player----------

		public function createPlayer()
		{
			$data['title'] = "Create New Member";

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('name', 'Name', 'required');
    		$this->form_validation->set_rules('number', '背號', 'required');
			$this->form_validation->set_rules('grade', '年級', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/create/createPlayer', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->createPlayer();
		        header("Location: /web/manage/index.php/manageController/viewData/player");
		    }
		}

		public function changePlayer($dataId)
		{
			$data['title'] = "Change Member Data";
			$data['playerData'] = $this->manageModel->getRowData('player', $dataId);

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('name', 'Name', 'required');
    		$this->form_validation->set_rules('number', '背號', 'required');
			$this->form_validation->set_rules('grade', '年級', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/change/changePlayer', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->changePlayer($dataId);
		        header("Location: /web/manage/index.php/manageController/viewData/player");
		    }
		}


		//-----------------------------------------------


		///
		///this part will be for the statistics
		///

		//----------cup----------

		public function viewCup()
		{
			$data['title'] = "Cup Data Manage";
			$data['dataName'] = "cup";
			$data['data'] = $this->manageModel->getCup();

			$this->load->view('templates/header', $data);
			$this->load->view('page/view/viewCup', $data);
			$this->load->view('templates/footer', $data);
		}

		public function deleteCup($dataId)
		{
			$this->manageModel->deleteCup($dataId);
			header("Location: /web/manage/index.php/manageController/viewCup");
		}

		public function createCup()
		{
			$data['title'] = "Create New Cup";

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('name', '盃賽名稱', 'required');
    		$this->form_validation->set_rules('year', '西元年', 'required');


    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/create/createCup', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->createCup();
		        header("Location: /web/manage/index.php/manageController/viewCup");
		    }
		}

		public function changeCup($dataId)
		{
			$data['title'] = "Change Cup Data";
			$data['cupData'] = $this->manageModel->getRowData('cup', $dataId);

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('name', '盃賽名稱', 'required');
    		$this->form_validation->set_rules('year', '西元年', 'required');


    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/change/changeCup', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->changeCup($dataId);
		        header("Location: /web/manage/index.php/manageController/viewCup");
		    }
		}

		//----------game----------

		public function viewGame($cupId)
		{
			$data['title'] = "Game Data Manage";
			$data['dataName'] = "game";
			$data['cupId'] = $cupId;
			$data['data'] = $this->manageModel->getGame($cupId);

			$this->load->view('templates/header', $data);
			$this->load->view('page/view/viewGame', $data);
			$this->load->view('templates/footer', $data);
		}

		public function createGame($cupId)
		{
			$data['title'] = "Create Game";
			$data['cupId'] = $cupId;

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('date', '日期', 'required');
			$this->form_validation->set_rules('vs', '對手', 'required');
			$this->form_validation->set_rules('our_point', '我們的分數', 'required');
			$this->form_validation->set_rules('enemy_point', '對手的分數', 'required');


    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/create/createGame', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->createGame($cupId);
		        header("Location: /web/manage/index.php/manageController/viewGame/" . $cupId);
		    }
		}


		//-----------------------------

	    public function viewStatistic($gameId)
	    {
	    	$data['title'] = "Statistic";
			$data['dataName'] = "statistic";
			$data['gameId'] = $gameId;
			$data['data'] = $this->manageModel->getStatistic($gameId);

			$this->load->view('templates/header', $data);
			$this->load->view('page/view/viewStatistic', $data);
			$this->load->view('templates/footer', $data);
	    }


		//---------create----------

		
		

		

		public function createStatistic($gameId)
		{

		}


		//----------delete---------

		

		

		public function deleteGame($cupId, $gameId)
		{
			$this->manageModel->deleteGame($cupId, $gameId);
			header("Location: /web/manage/index.php/manageController/viewData/game/" . $cupId);
		}

		public function deleteStatistic($gameId, $dataId)
		{
			$this->manageModel->deleteStatistic($dataId);
			header("Location: /web/manage/index.php/manageController/viewData/Statistic/" . $gameId);
		}


		//---------change---------


		

		

		

		

		public function changeGame($dataId, $cupId)
		{
			$data['title'] = "Change Game Data";
			$data['data'] = $this->manageModel->getRowData('game', $dataId);

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('date', '日期', 'required');
			$this->form_validation->set_rules('vs', '對手', 'required');
			$this->form_validation->set_rules('our_point', '我們的分數', 'required');
			$this->form_validation->set_rules('enemy_point', '對手的分數', 'required');


    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/change/changeGame', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->changeGame($dataId, $cupId);
		        header("Location: /web/manage/index.php/manageController/viewData/game/" . $cupId);
		    }
		}

		public function changeStatistic($cupID, $gameId, $playerId, $dataId)
		{
			$data['title'] = "Change Statistic Data";
			$data['data'] = $this->manageModel->getRowData('player_data', $dataId);



			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('兩分進球', '兩分進球數據', 'required');
    		$this->form_validation->set_rules('兩分失手', '兩分失手數據', 'required');
    		$this->form_validation->set_rules('三分進球', '三分進球數據', 'required');
    		$this->form_validation->set_rules('三分失手', '三分失手數據', 'required');
    		$this->form_validation->set_rules('罰球進球', '罰球進球數據', 'required');
    		$this->form_validation->set_rules('罰球失手', '罰球失手數據', 'required');
    		$this->form_validation->set_rules('防守籃板', '防守籃板數據', 'required');
    		$this->form_validation->set_rules('進攻籃板', '進攻籃板數據', 'required');
    		$this->form_validation->set_rules('失誤', '失誤數據', 'required');
    		$this->form_validation->set_rules('助攻', '助攻數據', 'required');
    		$this->form_validation->set_rules('抄截', '抄截數據', 'required');
    		$this->form_validation->set_rules('阻攻', '阻攻數據', 'required');
    		$this->form_validation->set_rules('犯規', '犯規數據', 'required');


    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('page/change/changeStatistic', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		    	$this->manageModel->changeStatistic($cupID, $gameId, $playerId, $dataId);
		        header("Location: /web/manage/index.php/manageController/viewData/statistic/" . $gameId);
		    }
		}

		///
		///----------data ends----------
		///

		//this is for testing
		public function test()
		{
			$this->manageModel->test();
		}

	}


 ?>