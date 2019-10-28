<?php

    /**
     * <b>$urls</b> Define em um array as urls que serão verificadas
     */
    $urls = [
        'url-1',
        'url-2',
    ];

    /**
     * <b>urlTest<b/> Função responsável por realizar a requisição e verificar se o serviço
     * esta ou não disponível de acordo com o status code retornado.
     * @param $url
     * @return true or false;
     */
    function urlTest($url)
    {
        $timeout = 10; //10
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        
        $request = curl_exec($curl);
      
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      
        if($statusCode == "200" || $statusCode == "302")
        {
            return true;
        } else {
            return false;
        }

        curl_close($curl);
    }

    /**
     * <b>writeFile</b> Função responsável por escrever a resposta em um arquivo .txt 
     * chamado "log-healthcheck.txt". 
     * @param String $string
     */
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