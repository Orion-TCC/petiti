<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../../../../api/database/conexao.php");

$con = Conexao::conexao();


$query = "SELECT idUsuario, 
nomeUsuario, 
senhaUsuario, 
loginUsuario, 
verificadoUsuario, 
emailUsuario, 
tbtipousuario.idTipoUsuario,
tipoUsuario,
bioUsuario,
localizacaoUsuario, 
siteUsuario
FROM tbusuario 
INNER JOIN tbtipousuario ON tbtipousuario.idTipoUsuario = tbusuario.idTipoUsuario
WHERE statusUsuario = 1";

$resultado = $con->query($query);
$listaUsuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);


$query = "SELECT idUsuario, 
nomeUsuario, 
senhaUsuario, 
loginUsuario, 
verificadoUsuario, 
emailUsuario, 
tbtipousuario.idTipoUsuario,
tipoUsuario,
bioUsuario,
localizacaoUsuario, 
siteUsuario
FROM tbusuario 
INNER JOIN tbtipousuario ON tbtipousuario.idTipoUsuario = tbusuario.idTipoUsuario
WHERE statusUsuario = 0";
$resultado = $con->query($query);
$listaUsuariosBloqueados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT COUNT(idUsuario) as qtd FROM tbusuario WHERE statusUsuario = 1";
$resultado = $con->query($query);
$listaUsuariosQtd = $resultado->fetchAll(PDO::FETCH_ASSOC);
foreach ($listaUsuariosQtd as $linha) {
  $qtdUsuarios = $linha['qtd'];
}

$query = "SELECT COUNT(idUsuario) as qtd FROM tbusuario WHERE statusUsuario = 0";
$resultado = $con->query($query);
$listaUsuariosQtd = $resultado->fetchAll(PDO::FETCH_ASSOC);
foreach ($listaUsuariosQtd as $linha) {
  $qtdUsuariosBloqueados = $linha['qtd'];
}
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
  <link rel="stylesheet" href="tutores.css" />
</head>

<body>
  <div class="container">
    <!------------------- começo - aside ------------------->
    <aside>
      <div class="top">
        <div class="logo">
          <img src="../../images/logo-petiti.svg" />
          <h1>pet iti</h1>
        </div>
        <div class="close" id="close-btn">
          <span class="material-icons-sharp">close</span>
        </div>
      </div>

      <div class="sidebar">
        <a class="menu-item" href="../dashboard/dashboard.php">
          <span class="material-icons-round">dashboard</span>
          <h3>Dashboard</h3>
        </a>
        <a class="menu-item active" href="tutores.php">
          <span class="material-icons-round">person_outline</span>
          <h3>Tutores</h3>
        </a>
        <a class="menu-item " href="../pets/pets.php">
          <span class="material-icons-round">pets</span>
          <h3>Pets</h3>
        </a>
        <a class="menu-item" href="../empresas/empresas.php">
          <span class="material-icons-round">store</span>
          <h3>Empresas</h3>
        </a>
        <a class="menu-item" href="../categorias/categorias.php">
          <span class="material-icons-round">category</span>
          <h3>Categorias</h3>
        </a>
        <a class="menu-item" href="../denuncias/denuncias.php">
          <span class="material-icons-outlined">report</span>
          <h3>Denúncias</h3>
        </a>
        <a id="logout" class="menu-item" href="/petiti/sair.php">
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
              <img id="search-img" src="../../images/search-icon.svg" />
            </button>
          </form>

          <!-- Tab links -->
          <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'ativo')">
              Ativos
            </button>
            <button class="tablinks" onclick="openTab(event, 'bloqueado')">
              Bloqueados
            </button>
          </div>

          <!-- Tab content -->
          <div id="ativo" class="tabcontent">
            <h3 id="total-qtd">Total (<?php echo $qtdUsuarios?>)</h3>
            <div class="tabelaUsuarios">
              <table>
                <thead class="">
                  <th>
                    Id
                  </th>
                  <th>
                    Nome
                  </th>
                  <th>
                    Usuário
                  </th>
                  <th>
                    Email
                  </th>
                  <th>
                    Verificado
                  </th>
                  <th>
                    Tipo conta
                  </th>
                </thead>
                <tbody>
                <?php 
                    foreach ($listaUsuarios as $linha) { 
                    $id = $linha['idUsuario'];
                     $nome  = $linha['nomeUsuario'];
                     $login =  $linha['loginUsuario'];
                     $email = $linha['emailUsuario'];
                     $verificado =  $linha['verificadoUsuario'];
                     $tipo = $linha['tipoUsuario']; ?>
                    
                    <td>
                      <?php echo $id ?>
                    </td>

                    <td>
                      <?php echo $nome?>
                    </td>

                    <td>
                      <?php echo $login?>
                    </td>

                    <td>
                    <?php echo $email?>
                    </td>

                    <td>
                      <?php echo $verificado?>
                    </td>

                    <td>
                      <?php echo $tipo?>
                    </td>


                  <?php  }
                  ?>
                </tbody>
              </table>

            </div>
          </div>

          <div id="bloqueado" class="tabcontent">
            <h3 id="total-qtd">Total (<?php echo $qtdUsuariosBloqueados?>)</h3>
          
            <div class="tabelaUsuarios">
              <table>
                <thead class="">
                  <th>
                    Id
                  </th>
                  <th>
                    Nome               
                  </th>
                  <th>
                    Usuário
                  </th>
                  <th>
                    Email
                  </th>
                  <th>
                    Verificado
                  </th>
                  <th>
                    Tipo conta
                  </th>
                </thead>
                <tbody>
                  <?php 
                    foreach ($listaUsuariosBloqueados as $linha) { 
                    $id = $linha['idUsuario'];
                     $nome  = $linha['nomeUsuario'];
                     $login =  $linha['loginUsuario'];
                     $email = $linha['emailUsuario'];
                     $verificado =  $linha['verificadoUsuario'];
                     $tipo = $linha['tipoUsuario']; ?>
                    
                    <td>
                      <?php echo $id ?>
                    </td>

                    <td>
                      <?php echo $nome?>
                    </td>

                    <td>
                      <?php echo $login?>
                    </td>

                    <td>
                    <?php echo $email?>
                    </td>

                    <td>
                      <?php echo $verificado?>
                    </td>

                    <td>
                      <?php echo $tipo?>
                    </td>


                  <?php  }
                  ?>
                </tbody>
              </table>

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
              <img id="img-denuncia" src="../../images/le.jpg" />
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
              <img id="img-denuncia" src="../../images/le.jpg" />
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
              <img id="img-denuncia" src="../../images/le.jpg" />
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

  <script src="../../js/script.js"></script>
</body>

</html>