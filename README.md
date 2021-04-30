# desafio-OM30

## Tecnologias
* Back-end (CodeIgniter 4, PostgreSQL e Docker)
* Front-end (Vuejs e Docker)

Para executar o projeto:

1. Clonar o repositório

2. Acessar a pasta do projeto
> cd desafio-OM30

3. Acessar a pasta back-end
 > cd back-end

4. Copiar o arquivo de configurações
> cp env .env

5. Adicionar as seguintes configurações no arquivo .env
#### CI_ENVIRONMENT = development
#### database.default.hostname = om30-postgres
#### database.default.database = OM30
#### database.default.username = admin
#### database.default.password = admin
#### database.default.port = 5432
#### database.default.DBDriver = Postgre 

6. Acessar a pasta .docker
> cd .docker

7. Iniciar o docker
> docker-compose up -d

8. Entrar no container do fpm
> docker exec -it om30-php-fpm bash

9. Rodar o composer install
> composer install

10. Rodar as migrations
> php spark migrate

11. Acessar a pasta front-end
> cd fron-end

12. Acessar a pasta .docker
> cd .docker

13. Iniciar o docker
> docker-compose up -d

14. Verificar os logs do node para saber quando o serviço está rodando
> docker logs -f om30-node

15. Voltar na pasta raiz do projeto e dar as permissões necessárias
> sudo chown ${USER}:www-data -R .
> sudo chmod 775 -R .

16. Acessar a URL

> http://localhost:8080/