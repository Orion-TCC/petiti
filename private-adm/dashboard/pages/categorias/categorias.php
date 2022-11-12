<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../objetos.php");
$categoria = new Categoria();
@session_start();
if ($_SESSION['tipo'] != "Adm") {
  header("Location: /petiti/feed");
}
$listaCat = $categoria->buscaCategoriaAtiva();
$qtdCat = $categoria->buscaQtdCategoriaAtiva();

$listaCatBloqueadas = $categoria->buscaCategoriaBloqueada();
$qtdCatBloqueada = $categoria->buscaQtdCategoriaBloqueada();
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - Tutores | Pet iti</title>
  <!-- material icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" />

  <!--style-->
  <link rel="stylesheet" href="/petiti/private-adm/dashboard/pages/categorias/categorias.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="/petiti/private-adm/dashboard/js/script.js"></script>
</head>

<body>
  <div class="container">
    <!------------------- começo - aside ------------------->
    <aside>
      <div class="top">
        <div class="logo">
          <img src="/petiti/private-adm/dashboard/images/logo-petiti.svg" />
          <h1>pet iti</h1>
        </div>
        <div class="close" id="close-btn">
          <span class="material-icons-sharp">close</span>
        </div>
      </div>

      <div class="sidebar">
        <a class="menu-item" href="/petiti/dashboard">
          <span class="material-icons-round">dashboard</span>
          <h3>Dashboard</h3>
        </a>
        <a class="menu-item" href="/petiti/tutores-dashboard">
          <span class="material-icons-round">person_outline</span>
          <h3>Tutores</h3>
        </a>
        <a class="menu-item" href="/petiti/pets-dashboard">
          <span class="material-icons-round">pets</span>
          <h3>Pets</h3>
        </a>
        <a class="menu-item" href="/petiti/empresas-dashboard">
          <span class="material-icons-round">store</span>
          <h3>Empresas</h3>
        </a>
        <a class="menu-item active" href="/petiti/categorias-dashboard">
          <span class="material-icons-round">category</span>
          <h3>Categorias</h3>
        </a>
        <a class="menu-item" href="/petiti/denuncias-dashboard">
          <span class="material-icons-outlined">report</span>
          <h3>Denúncias</h3>
        </a>
        <a id="logout" class="menu-item" href="/petiti/sair">
          <span class="material-icons-round">logout</span>
          <h3>Sair</h3>
        </a>
      </div>
    </aside>
    <!------------------- final do aside ------------------->

    <!------------------- começo - main ------------------->
    <main>
      <h1>Categorias</h1>
      <div class="info-pets">
        <h2>Lista de Categorias</h2>
        <div class="perfis-pets">
          <form action="" method="" class="search-bar">
            <input type="text" onkeyup="myFunction()" name="procurarPerfil" id="procurarCat" placeholder="Pesquise por categorias" class="form-input" />
            <button type="submit">
              <img id="search-img" src="/petiti/private-adm/dashboard/images/search-icon.svg" />
            </button>
          </form>

          <!-- Tab links -->
          <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'ativo')">
              Ativas
            </button>
            <button class="tablinks" onclick="openTab(event, 'bloqueado')">
              Bloqueadas
            </button>
          </div>

          <!-- Tab content -->
          <div id="ativo" class="tabcontent">
            <h3 id="total-qtd">Total(<?php echo $qtdCat ?>)</h3>
            <div class="listaCat">
              <?php
              foreach ($listaCat as $linha) { ?>
                <div class="itemCat">
                  <?php echo $linha['categoria'] ?>
                  <a class="bloquear" href="/petiti/api/bloquear-categoria/<?php echo $linha['idCategoria'] ?>">Bloquear</a>
                </div>

              <?php  } ?>
            </div>
          </div>

          <div id="bloqueado" class="tabcontent">
            <h3 id="total-qtd">Total(<?php echo $qtdCatBloqueada ?>)</h3>
            <div class="listaCat">
              <?php
              foreach ($listaCatBloqueadas as $linha) { ?>
                <div class="itemCatBloqueada"><?php echo $linha['categoria'] ?>
                  <a class="ativar" href="/petiti/api/ativar-categoria/<?php echo $linha['idCategoria'] ?>">Ativar</a>
                </div>

              <?php  } ?>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!------------------- final - main ------------------->

    <div class="right-side">
      <div class="top-right">
        <div class="perfil">
          <div class="info-admin">
            <p>Olá, <span style="font-weight: 800">Admin</span></p>
            <p id="cinza" style="margin-top: 0.3rem">Administrador</p>
          </div>
        </div>
      </div>

      <div class="container-denuncias">
        <h2>Denúncias recentes</h2>
        <div class="denuncias">
          <div class="icon-denuncia">
            <span id="icon-report" class="material-icons-outlined">report</span>
          </div>
          <div class="msg-denuncia">
            <div class="foto-perfil">
              <img id="img-denuncia" src="/petiti/private-adm/dashboard/images/le.jpg" />
            </div>
            <div class="mensagem">
              <p>
                <span style="font-weight: 800">@leandrocoelho</span> denúnciou
                o post de @kauanmatheus. A causa foi "É spam".
              </p>
              <p id="p-small">10 minutos atrás</p>
            </div>
          </div>
          <div class="msg-denuncia">
            <div class="foto-perfil">
              <img id="img-denuncia" src="/petiti/private-adm/dashboard/images/le.jpg" />
            </div>
            <div class="mensagem">
              <p>
                <span style="font-weight: 800">@cauagustavo</span> denúnciou o
                post de @camilamartins. A causa foi "Simplesmente não gostei"
              </p>
              <p id="p-small">10 minutos atrás</p>
            </div>
          </div>
          <div class="msg-denuncia">
            <div class="foto-perfil">
              <img id="img-denuncia" src="/petiti/private-adm/dashboard/images/le.jpg" />
            </div>
            <div class="mensagem">
              <p>
                <span style="font-weight: 800">@marinaliz</span> denúnciou o
                post de @kauanmatheus. A causa foi "Bullying ou assédio".
              </p>
              <p id="p-small">10 minutos atrás</p>
            </div>
          </div>
        </div>
      </div>
      <!------------------- final - denuncias recentes ------------------->

      <div class="categorias-alta">
        <h2>Categorias em alta</h2>
        <div class="categoria">
          <div class="icon">
            <span class="material-icons-round">category</span>
          </div>
          <div class="right">
            <div class="info-cat">
              <h3 style="font-size: 1.3rem">Cachorros</h3>
              <p id="p-small">Últimas 24 horas</p>
            </div>
            <h5 class="sucesso">+71%</h5>
            <h3 style="font-size: 1.2rem">5070</h3>
          </div>
        </div>
        <div class="categoria">
          <div class="icon">
            <span class="material-icons-round">category</span>
          </div>
          <div class="right">
            <div class="info-cat">
              <h3 style="font-size: 1.3rem">Lontrinhas</h3>
              <p id="p-small">Últimas 24 horas</p>
            </div>
            <h5 class="perigo">-10%</h5>
            <h3 style="font-size: 1.2rem">2015</h3>
          </div>
        </div>
        <div class="categoria">
          <div class="icon">
            <span class="material-icons-round">category</span>
          </div>
          <div class="right">
            <div class="info-cat">
              <h3 style="font-size: 1.3rem">Axolote</h3>
              <p id="p-small">Últimas 24 horas</p>
            </div>
            <h5 class="sucesso">+15%</h5>
            <h3 style="font-size: 1.2rem">500</h3>
          </div>
        </div>
      </div>

      <div class="contato">
        <div>
          <span class="material-icons-round">forward_to_inbox </span>
          <h3 style="font-size: 1.2rem; text-align: center">
            Precisa de ajuda ? Entre em contato com a empresa
          </h3>
        </div>
      </div>
    </div>
  </div>
  <!--.container-->
  <script src="/petiti/private-adm/dashboard/js/script.js"></script>

  <?php
    if(isset($_COOKIE["categoriaBloqueada"])){
      echo($_COOKIE["categoriaBloqueada"]);
    }else if(isset($_COOKIE["categoriaAtivada"])){
      echo($_COOKIE["categoriaAtivada"]);
    }
  ?>
</body>

</html>