# Trabalho da disciplina de Análise de Projetos de Sistemas II

Post dos arquivos para execução do trabalho de avaliação da disciplina de **Análise de Projetos de Sistemas II**.


## Passos para configuração e instalação

1. Clone o repositório
2. Na pasta **public** execute ```composer install```
3. Na pasta **aps-II** inicie o docker-compose ```docker-compose up -d```

## Restore do banco de dados
```docker exec -i mysql mysql -uroot -p"secret"  bdmandala < ./bdmandala.sql```

## Dump do banco de dados
```docker exec mysql sh -c 'exec mysqldump bdmandala -uroot -p"secret"' > ./dump.sql```

## Verbos e rotas ativos
Rotas públicas

| Verbo http | Rota |
| --- | --- |
| get | '/cadastrar' |
| get | '/quem-somos' |
| get | '/login' |
| get | '/' |
| post | '/login' |
| post | '/novo-user' |
| get | '/subjects' |
| get | '/juries' |
| get | '/roles' |
| get | '/disciplines' |
| get | '/exams' |
| get | '/esqueciasenha' |
| get | '/verify-recover/{verify}' |
| post | '/recuperarsenha' |
| post | '/update-new-pass' |

Rotas de administrador

| Verbo http | Rota |
| --- | --- |
| get       | '/admin' |
| get       | '/user/gerenciar' |
| get       | '/users' |
| get       | '/user/editar/{id}' |
| put       | '/update-user' |
| post      | '/delete-user' |
| get | '/assunto/cadastrar' |
| get | '/assunto/gerenciar' |
| get | '/assunto/editar/{id}' |
| get | '/banca/cadastrar' |
| get | '/banca/gerenciar' |
| get | '/banca/editar/{id}' |
| get | '/prova/cadastrar' |
| get | '/prova/gerenciar' |
| get | '/prova/editar/{id}' |
| get | '/pergunta/cadastrar' |
| get | '/pergunta/gerenciar' |
| post | '/novo-assunto' |
| post | '/update-subject' |
| post | '/delete-subject' |
| post | '/nova-banca' |
| post | '/update-jury' |
| post | '/delete-jury' |
| post | '/novo-cargo' |
| post | '/update-role' |
| post | '/delete-role' |
| post | '/nova-disciplina' |
| post | '/update-discipline' |
| post | '/delete-discipline' |
| post | '/novo-simulado' |
| post | '/update-exam' |
| post | '/delete-exam' |
| post | '/nova-questao' |

Rotas de usuários

| Verbo http | Rota |
| --- | --- |
| get | '/user/listar' |
| get | '/logout' |
| get | '/questions' |
| get | '/questions/page/{pg}' |
| post | '/responder' |