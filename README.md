## Teste IPDV

Teste requisitado pela ipdv, seguindo os seguintes requisitos: 

- CRIAR um usuário, cargo, departamento e um centro de custo;
- LISTAR os usuários existentes por departamento , listar os departamentos existentes por centro de custo;
- ATUALIZAR os dados desse usuário, departamento e centro de custo ;
- DELETAR esse usuário,departamento e centro de custo.
- E por ultimo importar uma lista de funcionários  atrelados ao seu respectivo departamento e centro de custo.

A aplicação deverá usar um token de sessão que devera expirar em 60 minutos sendo necessário renova-lo.

O front-end poderá ser em qualquer framework/linguagem  ou até mesmo  HTML, CCS e Java Script.

Layout e design ficam a sua escolha.

Modelar o banco de dados e encaminhar o diagrama Entidade Relacionamento.

Por ser um CRUD acredito que o ideal seria usar uma lib de banco para não escrever tanta código SQL, mas fica por conta do candidato. Caso use alguma lib informar qual.

## Pergunta

Framework: Utilizando Laravel versão 7.x, ele automatiza vários pontos da aplicação, como por exemplo a session de logon da aplicação, session encriptografada, middlewares de csrf e etc.

## SETUP
 - Necessário ter PHP7+ instalado
 - Necessário ter mysql instalado (WAMP/XAMP funcionam), para utilizar as constraints de tabela é necessário que a engine do banco seja a InnoDb

Para rodar o projeto, baixe o repositório e rode o comando: `php composer.phar install`
Esse comando instalará as dependencias de todo o sistema. (composer está indo incluso no repositório)

Segundo, edite o arquivo .env para colocar as credenciais do banco, edite as linhas:
```
DB_DATABASE=NOME DO BANCO
DB_USERNAME=USUARIO
DB_PASSWORD=SENHA
```

Terceiro, rode: `php artisan migrate:fresh --seed`
Esse comando irá rodar as migrations do banco criando as tables e constraints necessárias para o sistema, assim como o usuário admin para logar no mesmo.
User: admin@admin.com
Senha: 123456

OBS: os usuários criados não possuem credenciais, logo não será possível logar com eles.