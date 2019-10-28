<?php

    $urls = [
        'http://aedes.cnm.org.br/',
        'https://carteirinha.cnm.org.br/',
        'http://www.crack.cnm.org.br/observatorio_crack/',
        'https://credenciamento.cnm.org.br/',
        'http://desastres.cnm.org.br/',
        'http://doadores.cnm.org.br/',
        'http://li.cnm.org.br/',
        'http://lixoes.cnm.org.br/',
        'http://politico.cnm.org.br/',
        'https://credenciamento.cnm.org.br/',
        'http://www2.conquistas.cnm.org.br/rp.php',
        'http://agua.cnm.org.br/',
        'http://municipios.cnm.org.br',
        'http://areastecnicas.cnm.org.br/',
        'http://barracnm.org.br/',
        'http://dialogo.cnm.org.br/',
        'http://doadores.cnm.org.br/',
        'http://fia.cnm.org.br/',
        'http://forumagua.cnm.org.br/',
        'http://fotos.cnm.org.br',
        'http://leidatransparencia.cnm.org.br/',
        'http://lgotp.cnm.org.br/',
        'http://lixoes.cnm.org.br/',
        'http://memoria.cnm.org.br/',
        'http://mobilizacao.cnm.org.br/',
        'http://mobilizacaopermanente.cnm.org.br/',
        'http://nordeste.cnm.org.br/',
        'http://novosgestores.cnm.org.br/',
        'http://ods.cnm.org.br/',
        'http://panorama.cnm.org.br/',
        'http://politico.cnm.org.br/',
        'http://www.processoseletivo.cnm.org.br/',
        'http://www.realidade.cnm.org.br/',
        'http://rede.cnm.org.br/',
        'http://reinserir.cnm.org.br/',
        'http://relatorioanual.cnm.org.br/',
        'http://restosapagar.cnm.org.br/',
        'http://ssd.cnm.org.br/'
    ];

    function urlTest($url)
    {
        $timeout = 10; //10
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        
        $request = curl_exec($curl);
        //$response = trim(strip_tags($request));
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //var_dump($statusCode); //die();

        //var_dump($statusCode); die();
        if($statusCode == "200" || $statusCode == "302")
        {
            return true;
        } else {
            return false;
        }

        curl_close($curl);
    }

    function writeFile($string)
    {
        $file = fopen('/var/www/html/healthcheck/log-healthcheck.txt', "a+");
        fwrite($file, $string);
        fclose($file);
    }

    echo "Analise iniciada ...";
    foreach($urls as $uri)
    {
       
        if(!urlTest($uri)){
            $date = date('Y-m-d H:i:s');
            //escrever no arquivo
           $string = "{$date} - {$uri} - Esta fora \n";
           writeFile($string);
        }else{
            //escrever no arquivo
            $date = date('Y-m-d H:i:s');
            $string = "{$date} - {$uri} - Esta funcionando \n";
            writeFile($string);
        }

      

    }
    echo "Analise finalizada ...";

?>