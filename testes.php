<?php echo uniqid();
    
        if (isset($_GET['cep'])) {
            $url = "https://viacep.com.br/ws/$cep/json/";


            $json = file_get_contents($url);
            $dados = json_decode($json);

            $logradouro = @$dados->logradouro;
            $bairro = @$dados->bairro;
            $localidade = @$dados->localidade;
            $uf = @$dados->uf;
        }
        ?>