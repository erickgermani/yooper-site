# yooper-site

## Como executar o projeto

```bash
# Clone este repositório

# Acesse a pasta root do repositório

# Instale as dependências
$ npm install
$ composer install

# Crie uma database yooper de acordo com as variáveis de conexão no .env

# Execute as migrations
$ php artisan migrate --seed

# Sirva o servidor
$ php artisan serve

# Sirva o vite
$ npm run dev

# O servidor iniciará na porta 8000 - acesse <http://localhost:8000>

# Para logar no dashboard, utilize os parâmetros email <root@root.com> senha <root>
# ou a rota <http://localhost:8000/app/registrar> para criar uma nova conta
```
