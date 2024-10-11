# Backend API - Laravel 9

Este projeto é uma API desenvolvida com **Laravel 9** para gerenciar vendas e usuários. A aplicação utiliza o padrão **Repository Service** para organizar as camadas de negócio e persistência. A API é protegida por **JWT** para autenticação de usuários.

## Requisitos

- PHP >= 8.0
- Composer
- MySQL
- Laravel 9
  
## Instalação

1. Clone o repositório:

    ```bash
    git clone https://github.com/WatheusHenry/ShopSysBackend
    cd ShopSysBackend
    ```

2. Instale as dependências do projeto:

    ```bash
    composer install
    ```

3. Crie o arquivo `.env` a partir do `.env.example`:

    ```bash
    cp .env.example .env
    ```

4. Configure o arquivo `.env` com os valores corretos para seu banco de dados e serviços:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=shopsys
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

5. Gere a chave da aplicação:

    ```bash
    php artisan key:generate
    ```

6. Execute as migrações e seeds:

    ```bash
    php artisan migrate --seed
    ```

7. Inicie o servidor local:

    ```bash
    php artisan serve
    ```

## Autenticação

A autenticação da API é feita com **JWT**. Para registrar um novo usuário ou fazer login, utilize as rotas:

- **POST /api/register**: Cadastro de usuário
- **POST /api/login**: Login de usuário

Ao realizar o login, será retornado um token JWT, que deve ser utilizado nas demais rotas protegidas, enviando no header `Authorization`:

    Authorization: Bearer {token}

## Rotas da API

### Vendas

- **GET /api/sales**: Retorna todas as vendas
- **GET /api/sales/{id}**: Detalhes de uma venda específica
- **GET /api/sales/user/{id}**: Vendas de um usuário específico
- **POST /api/sales**: Cria uma nova venda
- **PUT /api/sales/{id}**: Atualiza uma venda
- **DELETE /api/sales/{id}**: Exclui uma venda

### Usuários

- **GET /api/users**: Retorna todos os usuários
- **GET /api/users/{id}**: Detalhes de um usuário específico
- **PUT /api/users/{id}**: Atualiza um usuário
- **DELETE /api/users/{id}**: Exclui um usuário

## Configuração do .env

Exemplo de configuração de variáveis de ambiente:

```plaintext
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:Ir+6JnfpvbPMYOLESDXrAcXkSqXxV0DFnklrRohB8uw=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shopsys
DB_USERNAME=root
DB_PASSWORD=root

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME= Seu Username
MAIL_PASSWORD= Sua Senha
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=sistem@sysshop.com
MAIL_FROM_NAME="${APP_NAME}"

JWT_SECRET=C8Ijr2wtK1gNUjjO2cDED1oVTF1y5nVUbdWFnz4Mk5Bb0DuX2Lcd7pUvVasfNGbq
```
## Como usar
  Após instalar e rodar o servidor local, utilize uma ferramenta como Postman ou Insomnia para testar as rotas.
  Certifique-se de adicionar o token JWT no header das requisições protegidas.
  Utilize as rotas de vendas e usuários para gerenciar os dados no sistema.

## Relatório encaminhado por e-mail
  Foi utilizada a ferramenta [Mailtrap](https://mailtrap.io/) para fazer a simulação de uma caixa de entrada

  Para simular um envio de email com relatório de vendar executar o comando:
  ```bash
  php artisan email:send-daily-report
  ```

## Padrão Repository Service
   Este projeto segue o padrão Repository Service para separar as responsabilidades entre as camadas de repositório (persistência) e serviço (lógica de negócio).

Cada entidade possui um repositório que se comunica diretamente com o banco de dados e um serviço que manipula os dados antes de serem retornados para o controlador.

Exemplo de criação de uma venda no SalesService:

```
php
public function createSale(array $data)
{
    $sale = $this->salesRepository->create($data);
    return $sale;
}

```
