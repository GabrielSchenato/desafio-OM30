# desafio-OM30

## Tecnologias
* Back-end (CodeIgniter 4, PostgreSQL e Docker)
* Front-end (Vuejs e Docker)

Para executar o projeto:

1. Clonar o repositório

2. Acessar a pasta back-end
 > cd back-end
3. Copiar o arquivo de configurações
> cp env .env
4. Adicionar as seguintes configurações
#### CI_ENVIRONMENT = development
#### database.default.hostname = om30-postgres
#### database.default.database = OM30
#### database.default.username = admin
#### database.default.password = admin
#### database.default.port = 5432
#### database.default.DBDriver = Postgre 

5. Acessar a pasta .docker
> cd .docker

6. Iniciar o docker
> docker-compose up -d

7. Acessar a pasta front-end
> cd fron-end

8. Acessar a pasta .docker
> cd .docker

9. Iniciar o docker
> docker-compose up -d

10. Acessar a URL

> http://localhost:8080/