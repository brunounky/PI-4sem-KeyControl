<?php 

   include '../app/controllers/db_conexao.php';

   try {
      $stmt = $pdo->prepare("
        SELECT imobiliaria.nome_fantasia
        FROM usuarios
        INNER JOIN imobiliaria ON usuarios.cnpj = imobiliaria.cnpj
        WHERE usuarios.id = :user_id
      ");
      $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->execute(); 
      $dados = $stmt->fetch(PDO::FETCH_ASSOC);
    
      if (!$dados) {
        echo "Dados da imobiliária ou do usuário não encontrados.";
        exit();
      }
    } catch (PDOException $e) {
      echo "Erro ao buscar os dados: " . $e->getMessage();
      exit();
    }
   
?>