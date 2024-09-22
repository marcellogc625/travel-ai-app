
# Projeto de Roteiro de Viagens - Back-end

Este projeto é a parte do back-end de uma aplicação de roteiros de viagens, desenvolvido em PHP utilizando Symfony, Composer e o ORM Doctrine. O banco de dados utilizado é o MySQL.

## Requisitos

Antes de iniciar, certifique-se de ter os seguintes requisitos instalados no seu sistema:

- **PHP 8.1 ou superior**: [Download do PHP](https://www.php.net/downloads)
- **Composer**: [Instalar o Composer](https://getcomposer.org/download/)
- **MySQL**: [Instalar MySQL](https://dev.mysql.com/downloads/)
- **Symfony CLI** (opcional, mas recomendado): [Instalar o Symfony CLI](https://symfony.com/download)

## Configuração do Projeto

### Passo 1: Clonar o Repositório

Clone este repositório em seu ambiente local:

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
```

Acesse a pasta do projeto:

```bash
cd seu-repositorio
```

### Passo 2: Instalar Dependências com Composer

Com o Composer instalado, execute o seguinte comando para instalar todas as dependências do projeto:

```bash
composer install
```

### Passo 3: Configuração do Banco de Dados

1. Crie um banco de dados no MySQL:

```sql
CREATE DATABASE nome_do_banco;
```

2. Copie o arquivo `.env` e renomeie para `.env.local`. Edite o arquivo `.env.local` para incluir as informações do banco de dados:

```
DATABASE_URL="mysql://usuario:senha@127.0.0.1:3306/nome_do_banco"
```

### Passo 4: Rodar as Migrações

Para preparar o banco de dados com as tabelas necessárias, execute o seguinte comando para rodar as migrações:

```bash
php bin/console doctrine:migrations:migrate
```

### Passo 5: Executar o Servidor de Desenvolvimento

Agora você pode iniciar o servidor de desenvolvimento do Symfony com:

```bash
symfony server:start
```

Ou, se preferir, utilize o PHP embutido:

```bash
php -S localhost:8000 -t public/
```

O servidor estará disponível em `http://localhost:8000`.

## Comandos Úteis

### Criar uma Nova Entidade

```bash
php bin/console make:entity
```

### Rodar Migrações

```bash
php bin/console doctrine:migrations:migrate
```

### Limpar o Cache

```bash
php bin/console cache:clear
```

## Testes

### Executar Testes Unitários

Caso você tenha configurado testes, você pode executá-los com:

```bash
php bin/phpunit
```

## Documentação

- [Symfony Documentation](https://symfony.com/doc/current/index.html)
- [Composer Documentation](https://getcomposer.org/doc/)
- [Doctrine ORM Documentation](https://www.doctrine-project.org/projects/orm.html)
