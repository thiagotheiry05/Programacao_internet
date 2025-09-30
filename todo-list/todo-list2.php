<?php 

# Conexão com o banco de dados

$localhost = 'localhost'; 
$usario = 'root';
$senha = '';
$database = 'todo_list'; 

$conn = new mysqli($localhost,$usario,$senha, $database);

if($conn->connect_error){
    die('Deu erro na conexão'. $conn->connect_error);
}

# criacao de tarefas
if(isset($_POST['descricao']) && !empty(trim($_POST['descricao']))){
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $sqlInsert = "INSERT INTO tarefas (descricao) VALUES ('$descricao')"; 

    if($conn->query($sqlInsert) === TRUE){
        header("location: todo-list2.php") ; 
    }
}



# Exclusão de tarefas



# Listar tarefas
$tarefas=[]; 

$sqlSelect = "SELECT * FROM tarefas ORDER BY data_criacao DESC"; 
$result = $conn->query($sqlSelect);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $tarefas[]=$row;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo-list</title>
</head>
<body>

    <h1>TO-DO List</h1>
    <form action="todo-list2.php" method="POST">
        <input type="text" placeholder="Descrição da sua tarefa" name="descricao"/>
        <button type="submit">Adicionar</button> 
    </form>

    <h2>Suas tarefas</h2>
    <?php if(!empty($tarefas)):?>
    <h3>Minhas tarefas</h3>
    <?php else:?>
    <h3>Não tem tarefas</h3>
    <?php endif;?>

</body>
</html>
