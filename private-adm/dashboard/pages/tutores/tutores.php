<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../objetos.php");
$listaTutoresAtivos = $usuario->buscaUsuarioAtivo();
$qtdTutoresAtivos = $usuario->buscaQtdUsuarioAtivo();

$listaTutoresBloqueados = $usuario->buscaUsuarioBloqueado();
$qtdTutoresBloqueado = $usuario->buscaQtdUsuarioBloqueado();
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!--style-->
  <link rel="stylesheet" href="/petiti/private-adm/dashboard/pages/tutores/tutores.css" />
</head>

<body >
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
        <a class="menu-item active" href="/petiti/tutores-dashboard">
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
        <a class="menu-item" href="/petiti/categorias-dashboard">
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
      <h1>Tutores</h1>
      <div class="info-tutores">
        <h2>Lista de tutores</h2>
        <div class="perfis-tutores">
          <form action="" method="" class="search-bar">
            <input type="text" name="procurarPerfil" id="procurarPerfil" placeholder="Pesquise por perfis de tutores" class="form-input" />
            <button type="submit">
              <img id="search-img" src="/petiti/private-adm/dashboard/images/search-icon.svg" />
            </button>
          </form>

          <!-- Tab links -->
          <div class="tab">
            <button class="tablinks active" onclick="openTab(event, 'ativo')">
              Ativos
            </button>
            <button class="tablinks" onclick="openTab(event, 'bloqueado')">
              Bloqueados
            </button>
          </div>

          <!-- Tab content -->
          <div id="ativo" class="tabcontent" style="display: block;">
            <h3 id="total-qtd">Total (<?php echo $qtdTutoresAtivos ?>)</h3>
            <div class="cards">
              <?php
              foreach ($listaTutoresAtivos as $linha) {
                $id = $linha['idUsuario'];
                $nome  = $linha['nomeUsuario'];
                $login =  $linha['loginUsuario'];
                $bio = $linha['bioUsuario'];
                $email = $linha['emailUsuario'];
                $dataCompleta = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $verificado =  $linha['verificadoUsuario'];
                if ($verificado == 0) {
                  $verificado = "<p class='badge nao-verificado'>Não</p>";
                } else {
                  $verificado = "<p class='badge verificado'>Sim</p>";
                }
                $tipo = $linha['tipoUsuario'];
                $foto = $linha['caminhoFoto']; ?>

                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Ativo</p>
                    <p class="badge tipo"><?php echo $tipo ?></p>
                  </div>

                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto ?>">
                    <div class="perfil-info">
                      <p><span style="font-weight: 900;"><?php echo $nome ?></span></p>
                      <p><span style="font-weight: 900;">@<?php echo $login ?></span></p>
                      <p><span style="font-weight: 900;">Pets: </span><?php echo $bio ?></p>
                    </div>
                  </div>

                  <div class="card-data">
                    <span class="material-symbols-outlined">
                      date_range
                    </span>
                    <p> Entrou em: <?php echo $dataCompleta ?></p>
                  </div>
                
                  <a class="botao bloquear" href="/petiti/api/bloquear-tutor/<?php echo $id ?>">Bloquear tutor</a>
                </div>
              <?php  }
              ?>
            </div>
          </div>

          <div id="bloqueado" class="tabcontent">
            <h3 id="total-qtd">Total (<?php echo $qtdTutoresBloqueado ?>)</h3>

            <div class="cards">
              <?php
              foreach ($listaTutoresBloqueados as $linha) {
                $id = $linha['idUsuario'];
                $nome  = $linha['nomeUsuario'];
                $login =  $linha['loginUsuario'];
                $bio = $linha['bioUsuario'];
                $email = $linha['emailUsuario'];
                $dataCompleta = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $verificado =  $linha['verificadoUsuario'];
                if ($verificado == 0) {
                  $verificado = "<p class='badge nao-verificado'>Não</p>";
                } else {
                  $verificado = "<p class='badge verificado'>Sim</p>";
                }
                $tipo = $linha['tipoUsuario'];
                $foto = $linha['caminhoFoto']; ?>


                <div class="card">
                  <div class="badges">
                    <p class="badge bloqueado">Bloqueado</p>
                    <p class="badge tipo"><?php echo $tipo ?></p>
                  </div>

                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto ?>">
                    <div class="perfil-info">
                      <p><span style="font-weight: 900;"><?php echo $nome ?></span></p>
                      <p><span style="font-weight: 900;">@<?php echo $login ?></span></p>
                      <p><span style="font-weight: 900;">Pets: </span><?php echo $bio ?></p>
                    </div>
                  </div>

                  <div class="card-data">
                    <span class="material-symbols-outlined">
                      date_range
                    </span>
                    <p> Entrou em: <?php echo $dataCompleta ?></p>
                  </div>
                  <!--<div class="card-perfil">
                    <a href="">Ver perfil</a>
                  </div>-->
                  <a class="botao ativar" href="/petiti/api/ativar-tutor/<?php echo $id ?>">Ativar tutor</a>
                </div>
              <?php  }
              ?>
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
</body>

</html>