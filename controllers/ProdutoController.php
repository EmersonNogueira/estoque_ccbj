<?php
	namespace controllers;

	class ProdutoController extends Controller{
	
		//private $produtos; 
		public function __construct($view,$model){
			$this->checkAccess();
			parent::__construct($view,$model);

		}



		private function checkAccess() {
			// Verifica se a sessão está iniciada
			if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
				// Usuário não está logado, redireciona para a página de login
				header('Location: /estrutura_mvc_base/Login/login');
				exit;
			}
	
			// Verifica se o tipo de usuário é admin
			if (isset($_SESSION['user_type']) && $_SESSION['user_type'] !== 'admin') {
				// Tipo de usuário não é admin, exibe uma mensagem de acesso negado ou redireciona
				die('Acesso para ADM.');
			}
		}







		public function index(){//pegar do banco os produtos e enviar para view produtos
			try {
				$produtos = $this->model->reader();
				$this->view->render('produto.php',['produtos' => $produtos]);
			} catch (\Exception $e) {
				error_log("Erro ao carregar produtos: " . $e->getMessage());
				die("Erro ao carregar produtos: " . $e->getMessage());
			}
		}

		public function produtosolicitar(){
			try {
				$produtos = $this->model->readerComSaldo();
				$this->view->render('produtoSolicitar.php',['produtos' => $produtos]);
			} catch (\Exception $e) {
				error_log("Erro ao carregar produtos: " . $e->getMessage());
				die("Erro ao carregar produtos: " . $e->getMessage());
			}
        }


		public function add(){ // chamar view de adicionar produto 
			$this->view->render('addproduto.php');
		}

		public function adicionarprod($postData){//enviar para o banco produto para cadastro
			$result = $this->model->cadastrar($postData);
			if ($result) {
				//echo "Produto cadastrado com sucesso!";
				$this->index(); // Chama o método index da instância atual
			} else {
				echo "Erro ao cadastrar o produto.";
			}
		}

		public function editarprod(){ //view de para edição
			
			$data = [
				'id' => $_GET['id'],
				'nome' => $_GET['nome'],
				'local' => $_GET['local'],
				'categoria' => $_GET['categoria'],
				'custo' => $_GET['custo']
			];
			
			$this->view->render('atualizar.php', ['produto' => $data]);		
		}

		public function atualizar($postData){
			$result = $this->model->atualizar($postData);
			if ($result) {
				//echo "Produto cadastrado com sucesso!";
				header("Location: /estrutura_mvc_base/");
				exit();
			} else {
				echo "Erro ao atuallizar o produto.";
			}

		}

		public function registroprod(){
			
			$data = [
				'id' => $_GET['id'],
				'nome' => $_GET['nome'],
				'local' => $_GET['local'],
				'categoria' => $_GET['categoria'],
				'custo' => $_GET['custo'],
				'saldo_final' =>$_GET['saldo_final']
			];
			$this->view->render('registroprod.php');


		}


		



	}





?>