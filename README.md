# GamesHub 🎮

Mini-CRM de gestão de jogos e estúdios PlayStation, desenvolvido em Laravel.

## Tecnologias

- Laravel 12
- PHP 8.2
- MySQL
- Bootstrap 5
- Laravel Fortify

## Funcionalidades

### Público

- Listagem de estúdios com logo e número de jogos
- Listagem de jogos por estúdio
- Pesquisa por nome de estúdio e jogo
- Filtros por plataforma e género
- Reviews e rating de jogos

### Utilizador autenticado

- Dashboard com boas vindas
- Editar dados dos jogos
- Criar reviews (1-5 estrelas)

### Administrador

- CRUD completo de estúdios
- CRUD completo de jogos
- Apagar reviews
- Acesso à zona /admin

## Instalação

### Requisitos

- PHP 8.2+
- Composer
- MySQL

### Passos

**1. Clonar o repositório**

```bash
git clone https://github.com/costa404/gameshub.git
cd gameshub
```

**2. Instalar dependências**

```bash
composer install
```

**3. Configurar o ambiente**

```bash
cp .env.example .env
php artisan key:generate
```

**4. Configurar a base de dados no `.env`**

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gameshub
DB_USERNAME=root
DB_PASSWORD=
```

**5. Correr as migrations e seeders**

```bash
php artisan migrate --seed
```

**6. Criar link do storage**

```bash
php artisan storage:link
```

**7. Iniciar o servidor**

```bash
php artisan serve
```

Acede a `http://localhost:8000`

## Credenciais de teste

| Perfil        | Email              | Password |
| ------------- | ------------------ | -------- |
| Administrador | admin@gameshub.com | password |
| Utilizador    | user@gameshub.com  | password |

## Estrutura da base de dados

| Tabela  | Descrição                         |
| ------- | --------------------------------- |
| users   | Utilizadores com campo is_admin   |
| studios | Estúdios de desenvolvimento       |
| games   | Jogos associados a estúdios       |
| reviews | Reviews de jogos por utilizadores |

## Autor

NunoCosta — 2026
