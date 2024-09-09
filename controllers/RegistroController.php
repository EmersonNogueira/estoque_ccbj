<?php
	namespace controllers;

	class RegistroController extends Controller{
	
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

        public function finalizar(){
            session_start();
            if(isset($_POST)){
                $this->processa_registro($_POST);
                $_SESSION['dados_form'] = $_POST;
                header('Location: ' . '/estrutura_mvc_base/Solicitacao/finalizar');
                exit(); 


                

            }
        }



            public function index(){//pegar do banco os produtos e enviar para view registro
                try {
                    $registros = $this->model->reader();
                    $this->view->render('registro.php',['registro' => $registros]);
                } catch (\Exception $e) {
                    error_log("Erro ao carregar produtos: " . $e->getMessage());
                    die("Erro ao carregar produtos: " . $e->getMessage());
                }
            }


            public function processa_registro($postData) {
                // Verifica se o campo 'tipo_operacao' está presente no POST
                if (isset($postData['tipo_operacao'])) {
                    $tipoOperacao = $postData['tipo_operacao'];
                    $id = $postData['id'];
                    $quantidade = $postData['quantidade'];
                    $saldo_atual = $postData['saldo_atual'];

                    $destino = $postData['destino'];
                    $obs = $postData['obs'];
                    
                    // Dependendo do tipo de operação, realiza uma ação específica
                    switch ($tipoOperacao) {
                        case 'compra':
                            // Lógica para a operação de compra
                            $saldo_final = $saldo_atual + $quantidade;
                            $this->model->processa_registro($id,$saldo_final,$tipoOperacao,$destino,$obs,$quantidade);
                            header("Location: /estrutura_mvc_base/");
                            break;
            
                        case 'retirada':
                            // Lógica para a operação de venda
                            $saldo_final = $saldo_atual - $quantidade;
                            $this->model->processa_registro($id,$saldo_final,$tipoOperacao,$destino,$obs,$quantidade);
                            header("Location: /estrutura_mvc_base/");
                            break;
            
                        case 'devolucao':
                            // Lógica para a operação de devolução
                            $saldo_final = $saldo_atual + $quantidade;
                            $this->model->processa_registro($id,$saldo_final,$tipoOperacao,$destino,$obs,$quantidade);
                            header("Location: /estrutura_mvc_base/");
                            break;
            
                        default:
                            // Se o tipo de operação não for reconhecido
                            echo "Operação inválida!";
                            break;
                    }
                } else {
                    // Se o campo 'tipo_operacao' não estiver presente
                    echo "Tipo de operação não especificado!";
                }


            }


   
        


    }


?>