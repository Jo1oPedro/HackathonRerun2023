# Etapas para executar o projeto

## Objetivo do repositório
Esse repositório foi utilizado para o hackathon da rerun durante a semana da computação de 2023 na UFJF 

## Configurações do projeto
\* É necessário ter o _PHP 8.1+_ e o _Laravel 9_ instalados. Download para fazer a instalação: https://www.apachefriends.org/pt_br/download.html <br>
\* É necessário ter o composer instalado. Download para fazer a instalação: https://getcomposer.org/ <br>
1. Abra o Terminal na Pasta do Projeto;
2. Instale as dependências necessárias: `composer install`;
3. Atualize as dependências: `composer update`;
7. Crie um banco de dados `sql` com o nome de `laravel`;

## Como executar o projeto
1. Para criar a estrutura do projeto através de um arquivo odl, execute o comando no terminal dentro da raiz do projeto: php parser/parser.php 
2. Dentro do terminal digite: php artisan tinker.

### Exemplo para método INDEX(SELECT ALL)
1. $model = new App\Models\TabelaDoBancoSingularComPrimeiraLetraMaiscula;
2. $response = $model->all();
### Exemplo para método STORE(CREATE)
1. Execute: $request = new Illuminate\Http\Request;
2. $request->merge(['indice' => 'valor', ...]); onde cada indice indica um campo no banco de dados.
3. $controller = new App\Http\Controllers\TabelaDoBancoSingularComPrimeiraLetraMaisculaController;
4. $response = $controller->store($request);
### Exemplo para método UPDATE
1. Execute: $request = new Illuminate\Http\Request;
2. $request->merge(['indice' => 'valor', ...]); onde cada indice indica um campo no banco de dados.
3. $model = new App\Models\TabelaDoBancoSingularComPrimeiraLetraMaiscula;
4. $controller = new App\Http\Controllers\TabelaDoBancoSingularComPrimeiraLetraMaisculaController;
5. $response = $controller->update($request, $model);
### Exemplo para método DESTROY(DELETE)
1. Execute: $request = new Illuminate\Http\Request;
2. $request->merge(['indice' => 'valor', ...]); onde cada indice indica um campo no banco de dados.
3. $model = new App\Models\TabelaDoBancoSingularComPrimeiraLetraMaiscula;
4. $controller = new App\Http\Controllers\TabelaDoBancoSingularComPrimeiraLetraMaisculaController;
5. $response = $controller->destroy($request);
