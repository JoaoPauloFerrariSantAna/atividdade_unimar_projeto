# Comandos para reprodução

## Introdução

Enquanto foi desenvolvido esta atividade, eu acabei por decidir ir pelo caminho
difícil e troquei Postman por cURL. Então, comentando isso com o professor,
ele me pediu para deixar um arquivo em texto com os comandos utilizados.

Para que isto funcione, por favor ligue o servidor com 

`$ php artisan serve`

## Comandos

### Departamentos

1. Obter todos os departamentos:

`$ curl -X GET "127.0.0.1:8000/api/departament"`

2. Obter um departamento específico:

`$ curl -X GET "127.0.0.1:8000/api/departament/1"`

3. Inserir um departamento:

`$ curl -X POST
		-H "Content-Type: application/json" \
		-d '{"deptName":"<Nome do departamento>", "deptWorkers":<Quantidade de funcionários>}' \
		"127.0.0.1:8000/api/departament"`

4. Deletar um departamento:

`$ curl -X DELETE "127.0.0.1:8000/api/departament/1"`

5. Corrigir um departamento:

`$ curl -X PATCH
		-H "Content-Type: application/json" \
		-d '{"deptName":"<Nome novo do departamento>", "deptWorkers":<Quantidade nova de funcionários>}' \
		"127.0.0.1:8000/api/departament"`

6. Obter o departamento de um funcionário:

`$ curl -X GET "127.0.0.1:8000/api/departament/worker/2"`

### Funcionários

1. Obter todos os funcionários:

`$ curl -X GET "127.0.0.1:8000/api/worker"`

2. Obter um departamento específico:

`$ curl -X GET "127.0.0.1:8000/api/worker/1"`

3. Inserir um funcionário:

`$ curl -X POST
		-H "Content-Type: application/json" \
		-d '{"wkrName":"<Nome do funcionário>", "wkrSalary":<Salario do funcionário. Padrão é 150.75>, "wkrStart": "<Inserir data de inicío de contrato de funcionário com o padrão AAAA-MM-DD>", "wkrEnd":"<Inserir data de termino de contrato de funcionário com o padrão AAAA-MM-DD. Opcional, neste caso.>", "deptId": <Id do departamento aqui>}'\
		"127.0.0.1:8000/api/departament"`

4. Deletar um funcionário:

`$ curl -X DELETE "127.0.0.1:8000/api/worker/1"`

5. Corrigir um funcionário:

`$ curl -X PATCH
		-H "Content-Type: application/json" \
		-d '{"wkrName":"<Nome do funcionário>", "wkrSalary":<Salario do funcionário. Padrão é 150.75>}' \
		"127.0.0.1:8000/api/worker"`

6. Obter o departamento de um funcionário:

`$ curl -X GET "127.0.0.1:8000/api/worker/departament/2"`
