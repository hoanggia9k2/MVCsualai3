<?php

require "models/PostModel.php";
require "views/PostView.php";

class Post {
	public $postModel;
	public $postView;

	public function newModel()
	{
		$this->postModel = new PostModel();
	}

	public function newView()
	{
		
		$this->postView = new PostView();
	}

}

class PostController extends Post {

	public function getPost()
	{
		$this->newModel();
		$rows = $this->postModel -> getAllData();
		$this->newView();
		$this->postView -> showAllData($rows);

	}

	public function addPost()
	{
		$this->newView();
		$this->postView -> showAdd();

		if(isset($_POST['add'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$fullname = $_POST['fullname'];
			$gioitinh = $_POST['gioitinh'];
			$ngaysinh = $_POST['ngaysinh'];
			$diachi = $_POST['diachi'];
			$email = $_POST['email'];
			$sdt = $_POST['sdt'];

			$this->newModel();
			if($this->postModel -> add($fullname,$gioitinh,$ngaysinh,$diachi,$email,$sdt)){
				header('Location: ?');
			}else{
				header('Location: ?action=error');
			}
		}
	}

	public function updatePost()
	{
		if (isset($_GET['id']))
		{
			$id = $_GET['id'];
			$this->postModel = new PostModel();
			$this->postModel -> getData($id);
			$rows = $postModel -> getData($id);

			$this->newView();
			$this->postView -> showUpdate($rows);

			if(isset($_POST['update'])){
				$fullname = $_POST['fullname'];
				$gioitinh = $_POST['gioitinh'];
				$ngaysinh = $_POST['ngaysinh'];
				$diachi = $_POST['diachi'];
				$email = $_POST['email'];
				$sdt = $_POST['sdt'];
				if($this->postModel->update($id,$fullname,$gioitinh,$ngaysinh,$diachi,$email,$sdt)){
					header('Location: ?');
				}else{
					header('Location: ?action=error');
				}
			}
		}
	}

	public function deletePost()
	{
		if (isset($_GET['id'])){
			$id = $_GET['id'];
			$this->newModel();
			$this->postModel -> delete($id);
			if($postModel->update($id,$fullname,$gioitinh,$ngaysinh,$diachi,$email,$sdt)){
				header('Location: ?');
			}else{
				header('Location: ?action=error');
			}
		}
	}

	public function errorPost()
	{
		$this->newView();
		$this->postView -> error();
	}

	public function insertPost()
	{
		if (isset($_GET['id']))
		{
			$id = $_GET['id'];
			$this->newModel();
			$this->postModel -> getData($id);
			$rows = $this->postModel -> getData($id);	

			$this->newView();
			$this->postView -> showInsert($rows);
		}
	}
}
?>