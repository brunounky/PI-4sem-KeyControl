<head>
  <link rel="stylesheet" type="text/css" href="../public/assets/css/style1.css">
</head>

<!-- nav -->
<nav class="navbar navbar-expand-sm">
  <div class="container">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav align-items-center">
        <li>
          <a class="nav-link" href="../views/home.php"><img src="../public/assets/img/Logomarca.png" width="110px"></a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="./lista_imobiliarias.php">Imobiliarias Parceiras</a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="./cadastro_superior.php">Novo Superior</a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#">Teste</a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#">Dashboard Superior</a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="../views/perfil.php"><i class="bi bi-person-fill-gear fs-5"></i> <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuário'); ?></a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="../app/controllers/logout.php"><i class="bi bi-box-arrow-right fs-4"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
