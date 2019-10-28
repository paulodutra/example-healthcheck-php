# Exemplo Healthcheck PHP

- Exemplo simples de healthcheck com PHP que faz requisições CURL e escreve os status em um arquivo de log (txt);

## Como utilizar ? 


- Para utilizar de forma "automática", você deverá agendar a sua execução de acordo com o período desejado, veja abaixo um exemplo
em sistemas operacionais Linux "debian like".

- Vá até o terminal e digite:

```
- crontab -e 
```

- Após a execução do comando acima, irá abrir o arquivo de crontab edite ele adicionado o conteúdo da linha abaixo:

```
*/3 * * * * /usr/bin/php -f /var/www/html/example-healthcheck-php/index.php 
```
- Com isso o script irá ser executado para todas as urls informadas de 3 em 3 minutos. 

- OBS: Caso desejar altere o periodo de execução, o **crontab generator** poderá auxiliar você nisso: https://crontab-generator.org/
