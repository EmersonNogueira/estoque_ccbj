<?php

class Application {

    const DEFAULT = 'Produto';

    public function run() {
        // Pega a URL, removendo barras no início e no final
        $url = isset($_GET['url']) ? explode('/', trim($_GET['url'], '/')) : [self::DEFAULT, 'index'];

        // Define o nome do controlador e método com base no tipo de requisição
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controllerName = isset($url[1]) ? ucfirst($url[1]) : ucfirst(self::DEFAULT);
            $method = isset($url[2]) ? $url[2] : 'index';
            $param = $_POST;
        } else {
            $controllerName = ucfirst($url[0]);
            $method = isset($url[1]) ? $url[1] : 'index';
            $param = isset($url[2]) ? $url[2] : null;
        }

    
        $class = 'controllers\\' . $controllerName . 'Controller';
        $view = 'views\\' . $controllerName . 'View';
        $model = 'models\\' . $controllerName . 'Model';

        // Verifica se as classes de controlador, visualização e modelo existem
        if (class_exists($class) && class_exists($view) && class_exists($model)) {
            $controller = new $class(new $view, new $model);

            if (method_exists($controller, $method)) {
                // Chama o método do controlador com ou sem parâmetro
                $controller->$method($param);
            } else {
                die('Método não encontrado.');
            }
        } else {
            die('Controlador, visualização ou modelo não encontrados.');
        }
    }
}

?>
