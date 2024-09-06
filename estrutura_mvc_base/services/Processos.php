<?php

    Class Processos{

            private $registroModel;
            private $produtoModel;


            public function __construct($produtoModel, $registroModel) {
                $this->produtoModel = $produtoModel;
                $this->registroModel = $registroModel;
            }



    }

?>