# Projeto-MUV

### Descrição do Projeto
- Somos uma agencia de viagens e necessitamos desenvolver um sistema que seja usado pelos nossos clientes para nos encontrarem na internet e também para nos conhecerem! Esse sistema também deve ser utilizado pelos profissionais da empresa (secretaria e atendentes), existindo a possibilidade de consultar e acrescentar informações dos clientes (cada profissional com sua devida permissão de acesso e visualização).


## Comandos Para a Instalação do Projeto:
Instale a imagem Node e sua o container:
```sh
docker pull node
```
```sh
docker run --name node_container -it node
```
Instale os recursos necessarios para a utilizacao do Electron:
```sh
npm install
```
Entre na pasta WWW onde contem o Framework Laravel:
```sh
cd www
```
Crie o arquivo .env:
```sh
cp .env.example .env
```
Atualize as variáveis de ambiente do arquivo .env:
```sh
APP_NAME=Laravel
APP_URL=http://localhost:8080

DB_PASSWORD=root
```
Suba o container do Projeto:
```sh
docker compose up -d
```
Acesse o container:
```sh
docker compose exec app bash
```
Instale as dependências do projeto:
```sh
composer install
```
Gere a key do projeto Laravel:
```sh
php artisan key:generate
```
Suba as Tabelas no phpMyAdmin:
```sh
php artisan migrate:fresh --seed
```

Saia do container:
```sh
exit
```
Instale os recursos necessarios para utilizar VueJS/Tailwindcss do projeto:
```sh
npm install
```
```sh
npm run dev
```
Instale os recursos adicionais para utilização do codigo:
```sh
php artisan storage:link
```

## Comandos Rodar o Projeto:
Caso esteja dentro da pasta WWW volte para Pasta Inicial do projeto (Projeto Clinica):
```sh
cd ..
```
Acesse o Servidor Electron:
```sh
npm start electron .
```

Acesse a pagina Inicial do Site da Agencia:
[http://localhost:8080](http://localhost:8080)

Acesse o Banco de Dados MySQL (phpMyAdmin):
[http://localhost:8081](http://localhost:8081)


### Pessoas Desenvolvedoras: 
- Daniela Akemi Hayashi
- Flávia Cristina Medeiros
- Giovana Salazar Alarcon
- Gabriel Hideki Yamamoto
