# Projeto-Clinica

### Descrição do Projeto
- Somos uma clínica de psicologia e necessitamos desenvolver um sistema que seja usado pelos nossos clientes para nos encontrarem na internet e também para nos conhecerem! Esse sistema também deve ser utilizado pelos profissionais da clínica (psicólogos e atendentes), existindo a possibilidade de consultar e acrescentar informações dos clientes (cada profissional com sua devida permissão de acesso e visualização).


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

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=2cb66a7b48b00a
MAIL_PASSWORD=d1360d168b747a
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=from@example.com
MAIL_FROM_NAME="${APP_NAME}"
```
> Caso queria receber o email do MailTrap, substituia as informações de email acima pelas suas cadastradasno site o MailTrap
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
npm install jspdf 
```
```sh
npm install nodemailer
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

Acesse a pagina Inicial do Site da Clinica:
[http://localhost:8080](http://localhost:8080)

Acesse o Banco de Dados MySQL (phpMyAdmin):
[http://localhost:8081](http://localhost:8081)


### Pessoas Desenvolvedoras: 
- Beatriz Cupa Newman
- Daniela Akemi Hayashi
- Flávia Cristina Medeiros
- Giovana Salazar Alarcon
- Luana Bresciani Baptista
