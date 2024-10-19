<head>
  <link rel="stylesheet" type="text/css" href="../public/assets/css/style1.css">
</head>

<!-- nav -->
<nav class="navbar navbar-expand-sm">
  <div class="container">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav align-items-center">
        <li>
          <a class="nav-link" href="#"><img src="../public/assets/img/Logomarca.png" width="110px"></a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="drop" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cadastros
          </a>
          <ul class="dropdown-menu" aria-labelledby="drop">
            <li><a class="dropdown-item nav-link" href="../views/cadastro_cliente.php">Clientes</a></li>
            <li><a class="dropdown-item nav-link" href="../views/cadastro_imovel.php">Imóveis</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#">Contrato</a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="drop" role="button" data-bs-toggle="dropdown" aria-expanded="true">
            Finanças
          </a>
          <ul class="dropdown-menu" aria-labelledby="drop">
            <li><a class="dropdown-item nav-link" href="#">Lançamentos a pagar</a></li>
            <li><a class="dropdown-item nav-link" href="#">Lançamentos a receber</a></li>
            <li><a class="dropdown-item nav-link" href="#">Fechamento</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="drop" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Relatórios
          </a>
          <ul class="dropdown-menu" aria-labelledby="drop">
            <li><a class="dropdown-item nav-link" href="#">Clientes</a></li>
            <li><a class="dropdown-item nav-link" href="#">Imóveis</a></li>
            <li><a class="dropdown-item nav-link" href="#">Pagamentos</a></li>
            <li><a class="dropdown-item nav-link" href="#">Vencimentos</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#">Dashboard</a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#"><i class="bi bi-person-fill-gear fs-4"></i> <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuário'); ?></a>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown">
          <a class="nav-link" href="../app/controllers/logout.php"><i class="bi bi-box-arrow-right fs-3"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
