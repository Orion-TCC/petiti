<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../objetos.php");
require_once("../../../../api/database/conexao.php");

$listaCategorias  = $categorias->listarCategoriasPopulares();
@session_start();
if ($_SESSION['tipo'] != "Adm") {
  header("Location: /petiti/feed");
}
$con = Conexao::conexao();
$query = "SELECT COUNT(idUsuario) FROM `tbusuario` WHERE idTipoUsuario = 1 AND dataCriacaoConta >= DATE_SUB(CURDATE(),INTERVAL 24 HOUR)";

$resultado = $con->query($query);
$lista = $resultado->fetchAll();
foreach ($lista as $linha) {
  $qtdTutores = $linha[0];
}

//
$query = "SELECT COUNT(idPet) FROM tbPet";

$resultado = $con->query($query);
$lista = $resultado->fetchAll();
foreach ($lista as $linha) {
  $qtdPets = $linha[0];
}
//

//
$query = "SELECT COUNT(idUsuario) FROM tbusuario WHERE idTipoUsuario != 1 AND idTipoUsuario != 3 AND dataCriacaoConta >= DATE_SUB(CURDATE(),INTERVAL 24 HOUR)";

$resultado = $con->query($query);
$lista = $resultado->fetchAll();
foreach ($lista as $linha) {
  $qtdEmpresas = $linha[0];
}
//
$query = "SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-01-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 1
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-02-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 2
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-03-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 3
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-04-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 4
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-05-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 5
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-06-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 6
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-07-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 7
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-08-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 8
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-09-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 9
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-10-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 10
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-11-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 11
UNION 
SELECT COUNT(idPublicacao) as qtd, IFNULL(MONTHNAME(dataPublicacao), MONTHNAME('2022-12-01')) as mes FROM `tbpublicacao` WHERE MONTH(dataPublicacao) = 12
";
$resultado = $con->query($query);
$listaPostsMes = $resultado->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT COUNT(idUsuario) AS qtd,
 CASE 
 WHEN 
 EXTRACT(DAY from dataCriacaoConta) < 8 THEN 'Semana 1'
 WHEN EXTRACT(DAY from dataCriacaoConta) < 15 THEN 'Semana 2'
 WHEN EXTRACT(DAY from dataCriacaoConta) < 22 THEN 'Semana 3'
 ELSE 'Semana 4'
 END AS semana
 FROM tbusuario WHERE MONTH(dataCriacaoConta) = MONTH(CURRENT_DATE) 
 group BY semana
 ORDER BY EXTRACT(DAY from dataCriacaoConta)
";
$resultado = $con->query($query);
$listaUsuarioSemana = $resultado->fetchAll(PDO::FETCH_ASSOC);


$query = "SELECT COUNT(CASE WHEN pubImpulso = 1 then 1 else null end) as 'Com Impulso', 
COUNT(CASE  WHEN pubImpulso = 0 then 1 else null end) as 'Sem Impulso'  FROM tbpublicacao;
";
$resultado = $con->query($query);
$listaQtdImpulso = $resultado->fetchAll(PDO::FETCH_ASSOC);



$denunciaPublicacao = new DenunciaPublicacao();
$denunciaUsuario = new DenunciaUsuario();

$listaDenunciasPublicacaoAtivas = $denunciaPublicacao->buscaDenunciaPubicacaoAtiva();
$qtdDenunciasPublicacaoesAtivas = $denunciaPublicacao->buscaQtdDenunciaPublicacaoAtiva();

$listaDenunciasUsuarioAtivas = $denunciaUsuario->buscaDenunciaUsuarioAtiva();
$qtdDenunciasUsuarioesAtivas = $denunciaUsuario->buscaQtdDenunciaUsuarioAtiva();

?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | Pet iti</title>
  <!-- material icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!--style-->
  <link rel="stylesheet" href="/petiti/private-adm/dashboard/pages/dashboard/dashboard.css" />
  <script>
    //Gráfico postgens ao mes
    const labels = [<?php foreach ($listaPostsMes as $linha) {
                      echo "'" . $linha['mes'] . "',";
                    } ?>];

    const data = {
      labels: labels,
      datasets: [{
        label: 'Qtd. de publicações ao mês',
        backgroundColor: '#9998D3',
        data: [<?php foreach ($listaPostsMes as $linha) {
                  echo "" . $linha['qtd'] . ",";
                } ?>]
      }]
    };

    const config = {
      type: 'line',
      data: data,
      options: {
          responsive: true,

        plugins: {
          legend: {
            labels: {
              font: {
                size: 20
              }
            }
          }
        },
        scales: {
          y: {
            suggestedMax: 5,
            ticks: {
              precision: 0
            }
          }
        }
      }
    };

    const labelsSemana = [<?php foreach ($listaUsuarioSemana as $linha) {
                            echo "'" . $linha['semana'] . "',";
                          } ?>];

    const dataSemana = {
      labels: labelsSemana,
      datasets: [{
        label: 'Novos usuários por semana',
        backgroundColor: '#9998D3',
        data: [<?php foreach ($listaUsuarioSemana as $linha) {
                  echo "" . $linha['qtd'] . ",";
                } ?>]
      }]
    };

    const configSemana = {
      type: 'bar',
      data: dataSemana,
      options: {
          responsive: true,

        plugins: {
          legend: {
            labels: {
              font: {
                size: 20
              }
            }
          }
        },
        scales: {
          y: {
            suggestedMax: 5,
            ticks: {
              precision: 0
            }
          }
        }
      }
    };

    const labelsImpulso = ["Qtd. Posts Impulsionados", "Qtd. Posts Comuns"];

    const dataImpulso = {
      labels: labelsImpulso,
      datasets: [{
        label: 'Qtd. de posts comuns e impulsionados',
        backgroundColor: ['#9998D3', '#FBD3A4'],
        data: [<?php foreach ($listaQtdImpulso as $linha) {
                  echo "" . $linha['Com Impulso'] . "," . $linha['Sem Impulso'];
                } ?>]
      }]
    };

    const configImpulso = {
      type: 'pie',
      data: dataImpulso,
      options: {
          responsive: true,

        plugins: {
          legend: {
            labels: {
              font: {
                size: 15
              }
            }
          }
        }
      }
    };
  </script>
</head>





<body>
  <div class="container">
    <!------------------- começo - aside ------------------->
    <aside>

      <div class="nuvemHolder"></div>

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
        <a class="menu-item active" href="/petiti/dashboard">
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
      <h1>Dashboard</h1>


      <div class="info-conteudo">
        <div class="tutores">
          <span class="material-icons-round">person_outline</span>
          <div class="info">
            <div class="left-side">
              <h3>Total de Tutores</h3>
              <h2><?php echo $qtdTutores ?> contas</h2>
              <!-- php aqui (puxar a qtd de contas do banco)-->
            </div>
            <div class="progresso">
              <img />
            </div>
          </div>
          <p id="cinza">Últimas 24 horas</p>
        </div>
        <!------------------- final - tutores ------------------->

        <div class="pets">
          <span class="material-icons-round">pets</span>
          <div class="info">
            <div class="left-side">
              <h3>Total de Pets</h3>
              <h2><?php echo $qtdPets ?> contas</h2>
            </div>
          </div>
          <p id="cinza">Últimas 24 horas</p>
        </div>
        <!------------------- final - pets ------------------->

        <div class="empresas">
          <span class="material-icons-round">store</span>
          <div class="info">
            <div class="left-side">
              <h3>Total de Empresas</h3>
              <h2><?php echo $qtdEmpresas ?> contas</h2>
            </div>
            <p id="cinza">Últimas 24 horas</p>
          </div>
        </div>
        <!------------------- final - empresas ------------------->
      </div>

      <div class="informacoes">
        <h2>Informações da Pet Iti</h2>
        <div class="graficos">
          <div class="d-graficos">
            <div class="graficoCima">
            <canvas id="myChartSemana"></canvas>
             <canvas id="myChartImpulso"></canvas>
            </div>
            <div class="graficoBaixo">      
             <canvas id="myChart"></canvas>
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
          <p>
            <?php
            if ($denunciaPublicacao->buscaQtdDenunciaPublicacaoAtiva() != 0) {
              $resultadoUltimaDenuncia = $denunciaPublicacao->ultimaDenuncia();
              $ultimaDenuncia = $resultadoUltimaDenuncia['ultimaDenuncia'];
              $arrayDenunciaPublicacao = $denunciaPublicacao->buscaDenunciaPublicacao($ultimaDenuncia);
              $denunciador = $arrayDenunciaPublicacao['usuarioDenunciador'];
              $denunciado = $arrayDenunciaPublicacao['usuarioDenunciado'];
              $foto = $arrayDenunciaPublicacao['fotoDenunciado'];
            ?>
          <div class="msg-denuncia">
            <div class="foto-perfil">
              <img src="<?php echo $foto; ?>" />
            </div>
            <div class="mensagem">
              O post de <span style="color: #DB310C; font-weight: 750;">@<?php echo $denunciado; ?> </span> foi denunciado por <span style="font-weight: 800">@<?php echo $denunciador; ?>
                </p>
                <p id="p-small">10 minutos atrás</p>
            </div>
          </div>
        <?php
            } else {
              echo ("Sem denúncia de publicação recente");
            }
        ?>

        <?php
        if ($denunciaUsuario->buscaQtdDenunciaUsuarioAtiva() != 0) {
          $resultadoUltimaDenuncia = $denunciaUsuario->ultimaDenuncia();
          $ultimaDenuncia = $resultadoUltimaDenuncia['ultimaDenuncia'];
          $arrayDenunciaUsuario = $denunciaUsuario->buscaDenunciaUsuario($ultimaDenuncia);
          $denunciador = $arrayDenunciaUsuario['usuarioDenunciador'];
          $denunciado = $arrayDenunciaUsuario['usuarioDenunciado'];
          $foto = $arrayDenunciaUsuario['fotoDenunciado'];
        ?>
          <div class="msg-denuncia">
            <div class="foto-perfil">
              <img src="<?php echo $foto; ?>" />
            </div>
            <div class="mensagem">
              O usuário <span style="color: #DB310C; font-weight: 750;">@<?php echo $denunciado; ?></span> foi denunciado por <span style="font-weight: 800">@<?php echo $denunciador; ?><?php  ?></span>
              </p>
              <p id="p-small">10 minutos atrás</p>
            </div>
          </div>
        <?php
        } else {
          echo ("Sem denúncia de usuario recente");
        }
        ?>

        </div>
      </div>
      <!------------------- final - denuncias recentes ------------------->

      <div class="categorias-alta">
        <h2>Categorias em alta</h2>
<?php for ($i=0; $i < 3; $i++) { ?>
 <div class="categoria">
          <div class="icon">
            <span class="material-icons-round">category</span>
          </div>
          <div class="right">
            <div class="info-cat">
               <h3 style="font-size: 1.3rem"> <?php echo $listaCategorias[$i]['categoria']; ?> </h3>
              <p id="p-small">Últimas 24 horas</p>
            </div>
            <h5 class="sucesso">+71%</h5>
            <h3 style="font-size: 1.2rem"><?php echo $listaCategorias[$i]['qtd']; ?></h3>
          </div>
        </div>
<?php } ?>
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

  <script src="/petiti/private-adm/dashboard/js/script.js"></script>
  <script>
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    const myChartSemana = new Chart(
      document.getElementById('myChartSemana'),
      configSemana
    );
    const myChartImpulso = new Chart(
      document.getElementById('myChartImpulso'),
      configImpulso
    );
  </script>
</body>

</html>