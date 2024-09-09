<?php

namespace controllers;

class SolicitacaoController extends Controller
{
    public function __construct($view, $model)
    {
        parent::__construct($view, $model);
    }

    private function checkAccess()
    {
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

    public function index()
    {
        $this->checkAccess();
        try {
            $solicitacoes = $this->model->reader();
            $this->view->render('solicitacao.php', ['solicitacoes' => $solicitacoes]);
        } catch (\Exception $e) {
            error_log("Erro ao carregar produtos: " . $e->getMessage());
            die("Erro ao carregar produtos: " . $e->getMessage());
        }
    }

    public function solicitar()
    {
        $this->view->render('solicitarProduto.php');
    }


    public function criarsolicitacao(){
        if (
            isset(
                $_POST['quantidade'], 
                $_POST['destino'], 
                $_POST['solicitante'], 
                $_POST['obs'], 
                $_POST['produto_id']
            )
        ) {
            // Todos os campos existem no POST, você pode prosseguir
            var_dump($_POST);
            $setor = $_POST['destino'];
            $solicitante = $_POST['solicitante'];
            $produto_id =  $_POST['produto_id'];
            $quantidade_pedida = $_POST['quantidade'];
            $obs = $_POST['obs']; 
            $this->model->add($setor,$solicitante,$produto_id,$quantidade_pedida,$obs);

        } else {
            echo "ERRO";
        }
    }


    public function finalizar(){
        session_start();
        if (isset($_SESSION['dados_form'])) {
            $dados = $_SESSION['dados_form'];
            if (isset($dados['id_sol'])) {
                try {
                    $this->model->updateStatus($dados['id_sol']);
                    unset($_SESSION['dados_form']);
                    // Redirecionar ou exibir uma mensagem de sucesso
                } catch (\Exception $e) {
                    error_log("Erro ao atualizar status: " . $e->getMessage());
                    echo "Erro ao atualizar status.";
                }
            } else {
                echo "ID da solicitação não fornecido.";
            }
        } else {
            echo "Dados do formulário não encontrados na sessão.";
        }
    }
    


}

?>
