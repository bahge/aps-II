# Trabalho da disciplina de Análise de Projetos de Sistemas II

Post dos arquivos para execução do trabalho de avaliação da disciplina de **Análise de Projetos de Sistemas II**.


## Passos para configuração e instalação

1. Clone o repositório
2. Na pasta **public** execute ```composer install```
3. Na pasta **aps-II** inicie o docker-compose ```docker-compose up -d```
4. Execute o restore do banco de dados;
5. Acesse: ```http://localhost:8095```

## Restore do banco de dados
```docker exec -i mysql mysql -uroot -p"secret"  bdmandala < ./bdmandala.sql```

## Dump do banco de dados
```docker exec mysql sh -c 'exec mysqldump bdmandala -uroot -p"secret"' > ./dump.sql```

## Verbos e rotas ativos
Rotas públicas

| Verbo http    | Rota                      | Ação |
| ---           | ---                       | --- |
| get           | '/'                       | Página Inicial |
| get           | '/cadastrar'              | Página de cadastro de usuários |
| get           | '/quem-somos'             | Página quem somos |
| get           | '/login'                  | Página de login |
| get           | '/esqueciasenha'          | Página de recuperação de senha |
| get           | '/verify-recover/{verify}'| Página de reset de senha |
| get           | '/subjects'               | End-point lista de assuntos |
| get           | '/juries'                 | End-point lista de bancas |
| get           | '/roles'                  | End-point lista de cargos |
| get           | '/disciplines'            | End-point lista de disciplinas |
| get           | '/exams'                  | End-point lista de simulados |
| post          | '/login'                  | End-point de login |
| post          | '/novo-user'              | End-point do cadastro de usuário |
| post          | '/recuperarsenha'         | End-point da verificação da recuperação de senha |
| post          | '/update-new-pass'        | End-point da nova senha |

Rotas de administrador

| Verbo http    | Rota                      | Ação |
| ---           | ---                       | --- |
| get           | '/admin'                  | Página de admin |
| get           | '/user/gerenciar'         | Página de gerenciamento de usuários |
| get           | '/users'                  | End-point da lista de usuários |
| get           | '/user/editar/{id}'       | Página para editar usuários |
| get           | '/assunto/cadastrar'      | Página de cadastro de assunto |
| get           | '/assunto/gerenciar'      | Página de gerenciamento de assuntos |
| get           | '/assunto/editar/{id}'    | Página de edição de assunto |
| get           | '/banca/cadastrar'        | Página de cadastro de banca |
| get           | '/banca/gerenciar'        | Página de gerenciamento das bancas |
| get           | '/banca/editar/{id}'      | Página de edição da banca |
| get           | '/prova/cadastrar'        | Página de cadastro de provas |
| get           | '/prova/gerenciar'        | Página de gerenciamento das provas |
| get           | '/prova/editar/{id}'      | Página de edição da prova |
| get           | '/pergunta/cadastrar'     | Página de cadastro de perguntas |
| get           | '/pergunta/gerenciar'     | Página de gerenciamento das perguntas |
| put           | '/update-user'            | - |
| post          | '/delete-user'            | - |
| post          | '/novo-assunto'           | - |
| post          | '/update-subject'         | - |
| post          | '/delete-subject'         | - |
| post          | '/nova-banca'             | - |
| post          | '/update-jury'            | - |
| post          | '/delete-jury'            | - |
| post          | '/update-exam'            | - |
| post          | '/delete-exam'            | - |
| post          | '/nova-questao'           | - |
| post          | '/novo-simulado'          | - |
| post          | '/novo-cargo'             | - |
| post          | '/update-role'            | - |
| post          | '/delete-role'            | - |
| post          | '/nova-disciplina'        | - |
| post          | '/update-discipline'      | - |
| post          | '/delete-discipline'      | - |



Rotas de usuários

| Verbo http    | Rota                      | Ação |
| ---           | ---                       | --- |
| get           | '/user/listar'            | Página inicial dos usuários |
| get           | '/logout'                 | End-point de deslogar |
| get           | '/questions'              | End-point da lista de questões |
| get           | '/questions/page/{pg}'    | End-point da lista de questões com paginação |
| post          | '/responder'              | End-point da resposta das questões |