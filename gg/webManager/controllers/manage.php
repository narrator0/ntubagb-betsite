<?php 

	class manage extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->load->model('manageModel');
		}

		public function index($page = "index")
		{
			$data['title'] = "manage";

			$this->load->view('templates/header.php', $data);
			$this->load->view('manage/'. $page .'.php', $data);
			$this->load->view('templates/footer.php', $data);
		}

		public function uploadVideo()
		{
			$data['title'] = "videoUpload";

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('title', 'Title', 'required');
    		$this->form_validation->set_rules('link', 'Link', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('manage/videoUpload', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->uploadVideo();
		        $data['result'] = "success<br>";
		        $this->load->view('manage/result', $data);
		    }
			
		}

		public function deleteVideo()
		{
			$data['title'] = "videoDelete";

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('id', 'Youtube ID', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('manage/deleteVideo', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        if ($this->manageModel->deleteVideo() == "fail")
		        	$data['result'] = "fail<br>";
		        else
		        	$data['result'] = "success<br>";

		        $this->load->view('manage/result', $data);
		    }
		}

		public function uploadPicture()
		{
			$data['title'] = "uploadPicture";

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('name', 'Name', 'required');
    		$this->form_validation->set_rules('size', 'Size', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('manage/uploadPicture', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->uploadPicture();
		        $data['result'] = "success<br>";
		        $this->load->view('manage/result', $data);
		    }
		}

		public function deletePicture()
		{
			$data['title'] = "pictureDelete";

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('name', 'Name', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('manage/deletePicture', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        if ($this->manageModel->deletePicture() == "fail")
		        	$data['result'] = "fail<br>";
		        else
		        	$data['result'] = "success<br>";

		        $this->load->view('manage/result', $data);
		    }
		}

		public function toDataManage()
		{
			$data['title'] = "dataManage";

			$this->load->view('templates/header', $data);
			$this->load->view('manage/dataManage', $data);
			$this->load->view('templates/footer', $data);
		}

		public function addPlayer()
		{
			$data['title'] = "addPlayer";

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('name', 'Name', 'required');
    		$this->form_validation->set_rules('number', '背號', 'required');
			$this->form_validation->set_rules('grade', '年級', 'required');


    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('manage/addPlayer', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->addPlayer();

		        $this->load->view('manage/result', $data);
		    }
		}

		public function addGame()
		{
			$data['title'] = "addGame";
			$data['cupData'] = $this->manageModel->getCupData(); 

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('cup_id', '盃賽名稱', 'required');
    		$this->form_validation->set_rules('date', '日期', 'required');
			$this->form_validation->set_rules('vs', '對手', 'required');
			$this->form_validation->set_rules('our_point', '我們的分數', 'required');
			$this->form_validation->set_rules('enemy_point', '對手的分數', 'required');


    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('manage/addGame', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->addGame();

		        $this->load->view('manage/result', $data);
		    }
		}

		public function addCup()
		{
			$data['title'] = "addCup";

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('name', '盃賽名稱', 'required');
    		$this->form_validation->set_rules('year', '西元年', 'required');


    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('manage/addCup', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->addCup();

		        $this->load->view('manage/result', $data);
		    }
		}

		public function deleteCup()
		{
			$data['title'] = 'deleteCup';
			$data['cupData'] = $this->manageModel->getCupData();

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('cup', '盃賽', 'required');


    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('manage/deleteCup', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->deleteCup();
		        $this->manageModel->dataUpdate();

		        $this->load->view('manage/result', $data);
		    }
		}

		public function addData()
		{
			$data['title'] = "addData";
			$data['cupData'] = $this->manageModel->getCupData();
			$data['playerData'] = $this->manageModel->getPlayerData();


			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('cup', '盃賽名稱', 'required');
    		$this->form_validation->set_rules('game', '比賽名稱', 'required');
    		$this->form_validation->set_rules('player', '選手名稱', 'required');
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
				$this->load->view('manage/addData', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->addData();
		        $this->manageModel->dataUpdate();

		        $this->load->view('manage/result', $data);
		    }
		}


		public function updateDataToJSON()
		{
			$this->manageModel->dataUpdate();
		}

		//here is a new start

		public function viewVideo()
		{
			$data['title'] = "Video Manage";
			$data['videoData'] = $this->manageModel->getVideoData();


			$this->load->view('templates/header', $data);
			$this->load->view('manage/viewVideo', $data);
			$this->load->view('templates/footer', $data);
		}

		public function fixVideo($videoId = 1)
		{
			$data['title'] = "Manage Video Data";
			$data['videoData'] = $this->manageModel->getVideoData($videoId);
			

			$this->load->helper('form');
    		$this->load->library('form_validation');

    		$this->form_validation->set_rules('title', 'Title', 'required');
    		$this->form_validation->set_rules('link', 'Link', 'required');

    		if ($this->form_validation->run() === false)
    		{
    			$this->load->view('templates/header', $data);
				$this->load->view('manage/fixVideo/1', $data);
				$this->load->view('templates/footer', $data);
    		}
    		else
		    {
		        $this->manageModel->fixVideo($videoId);
		        $data['result'] = "success<br>";
		        $data['url'] = "viewVideo";
		        $this->load->view('manage/result', $data);
		    }
		}


		//---------test about pictures

		public function changePictureName()
		{
			$dir = "data/pictures/2015女籃管院盃";

			$fileList = scandir($dir);

			$count = 1;
			foreach ($fileList as $fileName)
			{				
				if (explode('.', $fileName)[1] == 'jpg' || explode('.', $fileName)[1] == 'JPG')
				{
					rename($dir . '/' . $fileName, $dir . '/' . $count . '.jpg');
					$count ++;
				}				
			}
		}


	}
 ?>



