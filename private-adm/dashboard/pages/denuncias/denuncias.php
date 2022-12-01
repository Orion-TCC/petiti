<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once("../objetos.php");
$denunciaPublicacao = new DenunciaPublicacao();
$denunciaUsuario = new DenunciaUsuario();
$denunciaComentario = new denunciaComentario();

$listaDenunciasPublicacaoAtivas = $denunciaPublicacao->buscaDenunciaPubicacaoAtiva();
$listaDenunciasPublicacaoEmAnalise = $denunciaPublicacao->buscaDenunciaPubicacaoEmAnalise();
$listaDenunciasPublicacaoResolvidas = $denunciaPublicacao->buscaDenunciaPubicacaoResolvida();
$buscaDenunciaPublicacaoApagada = $denunciaPublicacao->buscaDenunciaPublicacaoApagada();

$listaDenunciasUsuarioAtivas = $denunciaUsuario->buscaDenunciaUsuarioAtiva();
$listaDenunciasUsuarioEmAnalise = $denunciaUsuario->buscaDenunciaUsuarioEmAnalise();
$listaDenunciasUsuarioResolvidas = $denunciaUsuario->buscaDenunciaUsuarioResolvida();

$listaDenunciasComentarioAtivas = $denunciaComentario->buscaDenunciaComentarioAtiva();
$listaDenunciasComentarioEmAnalise = $denunciaComentario->buscaDenunciaComentarioEmAnalise();
$listaDenunciasComentarioResolvidas = $denunciaComentario->buscaDenunciaComentarioResolvida();

require_once("../../../../api/database/conexao.php");
$con = Conexao::conexao();
@session_start();
if ($_SESSION['tipo'] != "Adm") {
  header("Location: /petiti/feed");
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--style-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  <link rel="stylesheet" href="/petiti/private-adm/dashboard/pages/denuncias/denuncias.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <script src="/petiti/private-adm/dashboard/js/script.js"></script>
  <script src="/petiti/views/assets/js/funcs.js"></script>
</head>

<body>
  <div class="container">

    <?php
    if (isset($_COOKIE["usuarioBloqueado"])) {
      echo ($_COOKIE["usuarioBloqueado"]);
    } else if (isset($_COOKIE["usuarioAtivado"])) {
      echo ($_COOKIE["usuarioAtivado"]);
    } else if (isset($_COOKIE["denunciaApagada"])) {
      echo ($_COOKIE["denunciaApagada"]);
    }
    ?>
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
        <a class="menu-item" href="/petiti/categorias-dashboard">
          <span class="material-icons-round">category</span>
          <h3>Categorias</h3>
        </a>
        <a class="menu-item active" href="/petiti/denuncias-dashboard">
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
      <h1>Denúncias</h1>
      <div class="info-pets">
        <h2>Lista de Denúncias</h2>
        <div class="perfis-pets">
          <form action="" method="" class="search-bar">
            <input type="text" name="procurarPerfil" id="procurarPerfil" placeholder="Pesquise por denúncias" class="form-input" />
            <button type="submit">
              <img id="search-img" src="/petiti/private-adm/dashboard/images/search-icon.svg" />
            </button>
          </form>

          <!-- Tab links -->
          <div class="tab">
            <button class="tablinks active" onclick="openTab(event, 'nova')">
              Novas
            </button>
            <button class="tablinks" onclick="openTab(event, 'analise')">
              Em Análise
            </button>
            <button class="tablinks" onclick="openTab(event, 'resolvida')">
              Resolvidas
            </button>
          </div>

          <!-- Tab content -->
          <div id="nova" class="tabcontent" style="display: block;">
            <h3 style="margin-bottom: 0.5rem;"> Denúncias de Postagens</h3>
            <h3 id="total-qtd-publicacoes">Total(<?php echo $denunciaPublicacao->buscaQtdDenunciaPublicacaoAtiva(); ?>)</h3>
            <div class="denunciasPublicacao">
              <?php foreach ($listaDenunciasPublicacaoAtivas as $linha) {
                $idDenunciaPublicacao = $linha['idDenunciaPublicacao'];
                $textoDenuncia = $linha['textoDenunciaPublicacao'];
                $data = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $denunciado = $linha['usuarioDenunciado'];
                $denunciador = $linha['usuarioDenunciador'];
                $foto = $linha['caminhoFotoPublicacao'];
                $textoPub = $linha['texto'];
              ?>
                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Ativo</p>
                  </div>
                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto; ?>">
                    <div class="denuncia-info">
                      <p><span style="font-weight: 900; font-size: 1.2rem;">Perfil </span><br>
                      <span style="font-weight: 600; font-size: 1.2rem"><a target="_blank" href="/petiti/<?php echo $denunciado ?>">@<?php echo $denunciado ?></a></span></p>
                    </div>
                  </div>
                  <div class="card-data">
                    <span class="material-symbols-outlined">
                      date_range
                    </span>
                    <div class="data-denunciador">
                      <p> Denuncia feita em: <?php echo $data; ?></p>

                    </div>
                  </div>
                  <p><span style="font-weight: 900;font-size: 15px;">Denunciado por: </span><span style="font-weight: 600;font-size: 15px;"><a target="_blank" href="/petiti/<?php echo $denunciador ?>">@<?php echo $denunciador ?></a></span></p>
                  <p><span style="font-weight: 900; color: #d30c1d">Causa: </span><span style="font-weight: 600;"> <?php echo $textoDenuncia ?></span></p>
                  <a href="/petiti/api/passar-denuncia-analise/publicacao/<?php echo $idDenunciaPublicacao; ?>" class="botao analisar" style="color: black">Passar para análise</a>
                </div>
              <?php
              }
              ?>
            </div>

            <div style="margin-top: 1rem; border-bottom: 1px solid #c1c1c1"></div>

            <h3 style="margin-top: 1rem; margin-bottom: 0.5rem;"> Denúncias de Usuários</h3>
            <h3 id=" total-qtd-usuarios">Total(<?php echo $denunciaUsuario->buscaQtdDenunciaUsuarioAtiva(); ?>)</h3>
            <div class="denunciasUsuarios">
              <?php foreach ($listaDenunciasUsuarioAtivas as $linha) {
                $idDenunciaUsuario = $linha['idDenunciaUsuario'];
                $textoDenuncia = $linha['textoDenunciaUsuario'];
                $data = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $denunciado = $linha['usuarioDenunciado'];
                $denunciador = $linha['usuarioDenunciador'];
                $foto = $linha['caminhoFoto'];
              ?>
                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Ativo
                  </div>
                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto; ?>">
                    <div class="denuncia-info">
                      <p><span style="font-weight: 900; font-size: 1.2rem;">Perfil </span><br>
                      <span style="font-weight: 600; font-size: 1.2rem"><a target="_blank" href="/petiti/<?php echo $denunciado ?>">@<?php echo $denunciado ?></a></span></p>
                    </div>
                  </div>
                  <div class="card-data">
                    <span class="material-symbols-outlined">date_range</span>
                    <div class="data-denunciador">
                      <p> Denuncia feita em: <?php echo $data; ?></p>
                    </div>
                  </div>
                  <p><span style="font-weight: 900;font-size: 15px;">Denunciado por: </span><span style="font-weight: 600;font-size: 15px;"><a target="_blank" href="/petiti/<?php echo $denunciador ?>">@<?php echo $denunciador ?></a></span></p>
                  <p><span style="font-weight: 900; color: #d30c1d">Causa: </span><span style="font-weight: 600;"> <?php echo $textoDenuncia ?></span></p>
                  <a href="/petiti/api/passar-denuncia-analise/usuario/<?php echo $idDenunciaUsuario; ?>" class="botao analisar">Passar para análise</a>
                </div>
              <?php
              } ?>
            </div>

            <div style="margin-top: 1rem; border-bottom: 1px solid #c1c1c1"></div>

            <h3 style="margin-top: 1rem; margin-bottom: 0.5rem;">Denúncias de Comentários</h3>
            <h3 id=" total-qtd-comentarios">Total(<?php echo $denunciaComentario->buscaQtdDenunciaComentarioAtiva(); ?>)</h3>
            <div class="denunciasComentarios">
              <?php foreach ($listaDenunciasComentarioAtivas as $linha) {
                $idDenunciaComentario = $linha['idDenunciaComentario'];
                $textoDenunciaComentario = $linha['textoDenunciaComentario'];
                $data = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $denunciado = $linha['usuarioDenunciado'];
                $denunciador = $linha['usuarioDenunciador'];
                $foto = $linha['caminhoFoto'];
                $textoComentario = $linha['textoComentario'];
              ?>
                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Ativo
                  </div>
                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto; ?>">
                    <div class="denuncia-info">
                      <p><span style="font-weight: 900; font-size: 1.2rem;">Perfil </span><br>
                      <span style="font-weight: 600; font-size: 1.2rem;"><a target="_blank" href="/petiti/<?php echo $denunciado ?>">@<?php echo $denunciado ?></a></span></p>
                    </div>
                  </div>
                  <p><span style="font-weight: 900; font-size: 15px;">Comentário: </span><span style="font-weight: 600; font-size: 15px;"> <?php echo $textoComentario; ?> </span></p>
                  <div class="card-data">
                    <span class="material-symbols-outlined">date_range</span>
                    <div class="data-denunciador">
                      <p> Denuncia feita em: <?php echo $data; ?></p>
                    </div>
                  </div>
                  <p><span style="font-weight: 900;font-size: 15px;">Denunciado por: </span><span style="font-weight: 600;font-size: 15px;"><a target="_blank" href="/petiti/<?php echo $denunciador ?>">@<?php echo $denunciador ?></a></span></p>
                  <p><span style="font-weight: 900; color: #d30c1d">Causa: </span><span style="font-weight: 600;"> <?php echo $textoDenunciaComentario ?></span></p>
                  <a href="/petiti/api/passar-denuncia-analise/comentario/<?php echo $idDenunciaComentario; ?>" class="botao analisar">Passar para análise</a>
                </div>

              <?php } ?>
            </div>

          </div>

          <div id="analise" class="tabcontent">
            <h3 style="margin-bottom: 0.5rem;"> Denúncias de Postagens</h3>
            <h3 id="total-qtd-publicacoes">Total(<?php echo $denunciaPublicacao->buscaQtdDenunciaPublicacaoEmAnalise(); ?>)</h3>
            <div class="denunciasPublicacao">
              <?php foreach ($listaDenunciasPublicacaoEmAnalise as $linha) {
                $idDenunciaPublicacao = $linha['idDenunciaPublicacao'];
                $textoDenuncia = $linha['textoDenunciaPublicacao'];
                $data = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $denunciado = $linha['usuarioDenunciado'];
                $denunciador = $linha['usuarioDenunciador'];
                $foto = $linha['caminhoFotoPublicacao'];
                $textoPub = $linha['texto'];
                $idDenunciado = $linha['denunciado'];
                $idPub = $linha['idPub'];
              ?>


                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Em análise</p>
                  </div>
                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto ?>">
                    <div class="denuncia-info">
                      <p><span style="font-weight: 900; font-size: 1.2rem;">Perfil </span><br>
                      <span style="font-weight: 600; font-size: 1.2rem;"><a target="_blank" href="/petiti/<?php echo $denunciado ?>">@<?php echo $denunciado ?></a></span></p>
                    </div>
                  </div>
                  <div class="card-data">
                    <span class="material-symbols-outlined">
                      date_range
                    </span>
                    <div class="data-denunciador">
                      <p> Denuncia feita em: <?php echo $data; ?></p>
                    </div>
                  </div>
                  <p><span style="font-weight: 900;font-size: 15px;">Denunciado por: </span><span style="font-weight: 600;font-size: 15px;"><a target="_blank" href="/petiti/<?php echo $denunciador ?>">@<?php echo $denunciador ?></a></span></p>
                  <p><span style="font-weight: 900; color: #d30c1d">Causa: </span><span style="font-weight: 600;"> <?php echo $textoDenuncia ?></span></p>

                  <a id="<?php echo $idDenunciaPublicacao; ?>" href="#modal-analisar-denuncia-publicacao<?php echo $idDenunciaPublicacao; ?>" rel="modal:open" class="botao analisar-agora">Analisar agora</a>
                </div>

                <section>
                  <div id="modal-analisar-denuncia-publicacao<?php echo $idDenunciaPublicacao; ?>" class="modal">
                    <div class="modalAnalise">
                      <div class="titulo-modal-denuncia">
                        <span id="span-modal-denuncia">Análise de denúncia</span>
                      </div>
                      <div class="textoPubDenuncia">
                        <span style="font-weight: 600; font-size: 15px;">Legenda da publicação: </span><span id="texto-pub" style="font-size: 15px;"><?php echo $textoPub; ?></span>
                      </div>
                      <div class="fotoPub">
                        <img class="foto-analise-denuncia" src="<?php echo $foto; ?>">
                      </div>
                      <div class="motivo-denuncia-modal">
                        <span style="font-size: 15px; font-weight:600;">Causa apontada: </span><span style="font-size: 15px; font-weight:400;"> <?php echo $textoDenuncia; ?></span>
                      </div>
                      <div class="denunciador-modal">
                        <span style="font-size: 15px; font-weight:600;">Denunciado por: </span> <a target="_blank" href="/petiti/<?php echo $denunciador; ?>"><span style="font-size: 15px; font-weight:400;">@<?php echo $denunciador; ?></span></a>
                      </div>
                      <div class="botoesDecisaoDenuncia">
                        <div class="linhaBotoesDenuncia">
                          <a class="botao decisao-conta" href="/petiti/api/bloquear-tutor-denunciado/publicacao/<?php echo $idDenunciado; ?>/<?php echo $idDenunciaPublicacao; ?>"><span id="span-bloquear-conta">Bloquear conta</span></a>
                          <a class="botao decisao-conta" href="/petiti/api/publicacao-denunciada/delete/<?php echo $idPub; ?>/<?php echo $idDenunciaPublicacao; ?>"><span id="span-decisao-conta">Excluir publicação</span></a>
                        </div>
                        <div class="linhaBotoesDenuncia">
                          <a class="botao decisao-conta" href="/petiti/api/excluir-denuncia/publicacao/<?php echo $idDenunciaPublicacao; ?>"><span id="span-decisao-conta">Excluir denúncia</span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>

              <?php
              }
              ?>
            </div>

            <div style="margin-top: 1rem; border-bottom: 1px solid #c1c1c1"></div>

            <h3 style="margin-top: 1rem; margin-bottom: 0.5rem;"> Denúncias de Usuários:</h3>
            <h3 id="total-qtd-usuarios">Total(<?php echo $denunciaUsuario->buscaQtdDenunciaUsuarioEmAnalise(); ?>)</h3>
            <div class="denunciasUsuarios">
              <?php foreach ($listaDenunciasUsuarioEmAnalise as $linha) {
                $idDenunciaUsuario = $linha['idDenunciaUsuario'];
                $idDenunciado = $linha['denunciado'];
                $idDenunciador = $linha['denunciador'];
                $textoDenuncia = $linha['textoDenunciaUsuario'];
                $data = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $denunciado = $linha['usuarioDenunciado'];
                $denunciador = $linha['usuarioDenunciador'];
                $foto = $linha['caminhoFoto'];
              ?>
                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Ativo</p>
                  </div>
                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto; ?>">
                    <div class="denuncia-info">
                      <p><span style="font-weight: 900; font-size: 1.2rem;">Perfil </span><br>
                      <span style="font-weight: 600; font-size: 1.2rem;"><a target="_blank" href="/petiti/<?php echo $denunciado ?>">@<?php echo $denunciado ?></a></span></p>
                    </div>
                  </div>
                  <div class="card-data">
                    <span class="material-symbols-outlined">date_range</span>
                    <div class="data-denunciador">
                      <p> Denuncia feita em: <?php echo $data; ?></p>
                    </div>
                  </div>
                  <p><span style="font-weight: 900;font-size: 15px;">Denunciado por: </span><span style="font-weight: 600;font-size: 15px;"><a target="_blank" href="/petiti/<?php echo $denunciador ?>">@<?php echo $denunciador ?></a></span></p>
                  <p><span style="font-weight: 900; color: #d30c1d">Causa: </span><span style="font-weight: 600;"> <?php echo $textoDenuncia ?></span></p>
                  <a href="#modal-analisar-denuncia-usuario<?php echo $idDenunciaUsuario; ?>" rel="modal:open" class="botao analisar-agora">Passar para análise</a>
                </div>

                <section>
                  <div id="modal-analisar-denuncia-usuario<?php echo $idDenunciaUsuario; ?>" class="modal">
                    <div class="modalAnalise">
                      <div class="titulo-modal-denuncia">
                        <span id="span-modal-denuncia">Análise de denúncia</span>
                      </div>
                      <div class="fotoDenunciado">
                        <a target="_blank" href="/petiti/<?php echo $denunciado; ?>"><img class="foto-analise-denuncia" src="<?php echo $foto; ?>"></a>
                      </div>
                      <div class="motivo-denuncia-modal">
                        <span style="font-size: 20px; font-weight:600;">Causa apontada: </span><span style="font-size: 20px; font-weight:400;"> <?php echo $textoDenuncia; ?></span>
                      </div>
                      <div class="denunciador-modal">
                        <span style="font-size: 15px; font-weight:600;">Denunciado por: </span> <a target="_blank" href="/petiti/<?php echo $denunciador; ?>"><span style="font-size: 15px; font-weight:400;">@<?php echo $denunciador; ?></span></a>
                      </div>
                      <div class="botoesDecisaoDenuncia">
                        <div class="linhaBotoesDenuncia">
                          <a class="botao decisao-conta" href="/petiti/api/bloquear-tutor-denunciado/usuarioDenunciado/<?php echo $idDenunciado; ?>/<?php echo $idDenunciaUsuario; ?>"><span id="span-decisao-conta">Bloquear denunciado (<?php echo $denunciado; ?>)</span></a>
                          <a class="botao decisao-conta" href="/petiti/api/bloquear-tutor-denunciado/usuarioDenunciador/<?php echo $idDenunciador; ?>/<?php echo $idDenunciaUsuario; ?>"><span id="span-decisao-conta">Bloquear denunciador (<?php echo $denunciador; ?>)</span></a>
                        </div>
                        <div class="linhaBotoesDenuncia">
                          <a class="botao decisao-conta" href="/petiti/api/excluir-denuncia/usuario/<?php echo $idDenunciaUsuario; ?>"><span id="span-decisao-conta">Excluir denúncia</span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>

              <?php
              } ?>
            </div>

            <div style="margin-top: 1rem; border-bottom: 1px solid #c1c1c1"></div>

            <h3 style="margin-top: 1rem; margin-bottom: 0.5rem;"> Denúncias de Comentários</h3>
            <h3 id="total-qtd-Comentarios">Total(<?php echo $denunciaComentario->buscaQtdDenunciaComentarioEmAnalise(); ?>)</h3>
            <div class="denunciasComentarios">
              <?php foreach ($listaDenunciasComentarioEmAnalise as $linha) {
                $idDenunciaComentario = $linha['idDenunciaComentario'];
                $idDenunciado = $linha['idUsuarioDenunciado'];
                $idDenunciador = $linha['idUsuarioDenunciador'];
                $textoDenunciaComentario = $linha['textoDenunciaComentario'];
                $foto = $linha['caminhoFoto'];
                $usuarioDenunciado = $linha['usuarioDenunciado'];
                $usuarioDenunciador = $linha['usuarioDenunciador'];
                $textoComentario = $linha['textoComentario'];
                $data = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $idComentario = $linha['idComentario'];
              ?>

                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Em análise</p>
                  </div>
                  <div class="info-card">
                    <img class="foto-info" src="<?php echo $foto ?>">
                    <div class="denuncia-info">
                      <p><span style="font-weight: 900; font-size: 1.2rem;">Perfil </span><br>
                      <span style="font-weight: 600; font-size: 1.2rem"><a target="_blank" href="/petiti/<?php echo $usuarioDenunciado ?>">@<?php echo $usuarioDenunciado ?></a></span></p>
                    </div>
                  </div>
                  <p><span style="font-weight: 900; font-size: 15px;">Comentário: </span><span style="font-weight: 600; font-size: 15px;"> <?php echo $textoComentario; ?> </span></p>
                  <div class="card-data">
                    <span class="material-symbols-outlined">
                      date_range
                    </span>
                    <div class="data-denunciador">
                      <p> Denuncia feita em: <?php echo $data; ?></p>
                    </div>
                  </div>
                  <p><span style="font-weight: 900;font-size: 15px;">Denunciado por: </span><span style="font-weight: 600;font-size: 15px;"><a target="_blank" href="/petiti/<?php echo $usuarioDenunciador ?>">@<?php echo $usuarioDenunciador ?></a></span></p>
                  <p><span style="font-weight: 900;">Motivo: </span><span style="font-weight: 600;"> <?php echo $textoDenunciaComentario ?></span></p>

                  <a id="<?php echo $idDenunciaComentario; ?>" href="#modal-analisar-denuncia-comentario<?php echo $idDenunciaComentario; ?>" rel="modal:open" class="botao analisar-agora">Analisar agora</a>

                </div>

                <section>
                  <div class="modal" id="modal-analisar-denuncia-comentario<?php echo $idDenunciaComentario; ?>">
                    <div class="modalAnalise">
                      <div class="titulo-modal-denuncia">
                        <span id="span-modal-denúncia">Análise de denúncia</span>
                      </div>
                      <div class="textoComenDenunicia">
                        <span style="font-weight: 600; font-size: 15px;">Comentário: </span><span id="texto-pub" style="font-size: 15px;"><?php echo $textoComentario; ?></span>
                      </div>
                      <div class="motivo-denuncia-modal">
                        <span style="font-size: 15px; font-weight:600;">Causa apontada: </span><span style="font-size: 15px; font-weight:400;"> <?php echo $textoDenunciaComentario; ?></span>
                      </div>
                      <div class="denunciador-modal">
                        <span style="font-size: 15px; font-weight:600;">Denunciado por: </span> <a target="_blank" href="/petiti/<?php echo $usuarioDenunciador; ?>"><span style="font-size: 15px; font-weight:400;">@<?php echo $usuarioDenunciador; ?></span></a>
                      </div>
                      <div class="botoesDecisaoDenuncia">
                        <div class="linhaBotoesDenuncia">
                          <a class="botao decisao-conta" href="/petiti/api/bloquear-tutor-denunciado/comentario/<?php echo $idDenunciado; ?>/<?php echo $idDenunciaComentario; ?>"><span id="span-bloquear-conta">Bloquear conta</span></a>
                          <a class="botao decisao-conta" href="/petiti/api/comentario-denunciado/delete/<?php echo $idComentario; ?>/<?php echo $idDenunciaComentario; ?>"> <span id="span-excluir-comentario"> Excluir comentário </span></a>
                        </div>
                        <div class="linhaBotoesDenuncia">
                          <a class="botao decisao-conta" href="/petiti/api/excluir-denuncia/comentario/<?php echo $idDenunciaComentario; ?>"> <span id="span-decisao-conta">Excluir denúncia</span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>

              <?php } ?>

            </div>
          </div>

          <div id="resolvida" class="tabcontent">
            <h3 style="margin-bottom: 0.5rem;"> Denúncias de Postagens</h3>
            <h3 id="total-qtd-publicacoes">Total(<?php echo $denunciaPublicacao->buscaQtdDenunciaPublicacaoResolvida(); ?>)</h3>
            <div class="denunciasPublicacao">
              <?php foreach ($listaDenunciasPublicacaoResolvidas as $linha) {
                $idDenunciaPublicacao = $linha['idDenunciaPublicacao'];
                $textoDenuncia = $linha['textoDenunciaPublicacao'];
                $data = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $denunciado = $linha['usuarioDenunciado'];
                $denunciador = $linha['usuarioDenunciador'];
                $foto = $linha['caminhoFotoPublicacao'];
                $textoPub = $linha['texto'];
              ?>
                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Resolvido</p>
                  </div>
                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto ?>">
                    <div class="denuncia-info">
                      <p><span style="font-weight: 900; font-size: 1.2rem;">Perfil </span><br>
                      <span style="font-weight: 600; font-size: 1.2rem;"><a target="_blank" href="/petiti/<?php echo $denunciado ?>">@<?php echo $denunciado ?></a></span></p>
                    </div>
                  </div>
                  <div class="card-data">
                    <span class="material-symbols-outlined">
                      date_range
                    </span>
                    <div class="data-denunciador">
                      <p> Denuncia feita em: <?php echo $data; ?></p>

                    </div>
                  </div>
                  <p><span style="font-weight: 900;font-size: 15px;">Denunciado por: </span><span style="font-weight: 600;font-size: 15px;"><a target="_blank" href="/petiti/<?php echo $denunciador ?>">@<?php echo $denunciador ?></a></span></p>
                  <p><span style="font-weight: 900;">Decisão da administração: </span><span style="font-weight: 600;"> <?php echo $textoDenuncia ?></span></p>
                  <a href="/petiti/api/passar-denuncia-analise/publicacao/<?php echo $idDenunciaPublicacao; ?>" class="botao analisar">Passar para análise novamente</a>
                </div>

              <?php
              }
              ?>

              <?php foreach ($buscaDenunciaPublicacaoApagada as $linha) {
                $idDenunciaPublicacao = $linha['idDenunciaPublicacao'];
                $textoDenuncia = $linha['textoDenunciaPublicacao'];
                $data = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $denunciado = $linha['usuarioDenunciado'];
                $denunciador = $linha['usuarioDenunciador'];
              ?>
                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Resolvido</p>
                  </div>
                  <div class="infos-card">
                    <div class="denuncia-info">
                      <p><span style="font-weight: 900; font-size: 1.2rem;">Perfil: </span><br>
                      <span style="font-weight: 600; font-size: 1.2rem;"><a target="_blank" href="/petiti/<?php echo $denunciado ?>">@<?php echo $denunciado ?></a></span></p>
                    </div>
                  </div>
                  <div class="card-data">
                    <span class="material-symbols-outlined">
                      date_range
                    </span>
                    <div class="data-denunciador">
                      <p> Denuncia feita em: <?php echo $data; ?></p>

                    </div>
                  </div>
                  <p><span style="font-weight: 900;font-size: 15px;">Denunciado por: </span><span style="font-weight: 600;font-size: 15px;"><a target="_blank" href="/petiti/<?php echo $denunciador ?>">@<?php echo $denunciador ?></a></span></p>
                  <p><span style="font-weight: 900;">Decisão da administração: </span><span style="font-weight: 600;"> <?php echo $textoDenuncia ?></span></p>
                  <a href="/petiti/api/passar-denuncia-analise/publicacao/<?php echo $idDenunciaPublicacao; ?>" class="botao analisar">Passar para análise novamente</a>
                </div>

              <?php
              }
              ?>
            </div>

            <div style="margin-top: 1rem; border-bottom: 1px solid #c1c1c1"></div>

            <h3 style="margin-top: 1rem; margin-bottom: 0.5rem;"> Denúncias de Usuários</h3>
            <h3 id="total-qtd-usuarios">Total(<?php echo $denunciaUsuario->buscaQtdDenunciaUsuarioResolvida(); ?>)</h3>
            <div class="denunciasUsuarios">
              <?php foreach ($listaDenunciasUsuarioResolvidas as $linha) {
                $idDenunciaUsuario = $linha['idDenunciaUsuario'];
                $idDenunciado = $linha['denunciado'];
                $idDenunciador = $linha['denunciador'];
                $textoDenuncia = $linha['textoDenunciaUsuario'];
                $data = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                $denunciado = $linha['usuarioDenunciado'];
                $denunciador = $linha['usuarioDenunciador'];
                $foto = $linha['caminhoFoto'];
              ?>
                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Resolvido</p>
                  </div>
                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto; ?>">
                    <div class="denuncia-info">
                      <p><span style="font-weight: 900; font-size: 1.2rem;">Perfil: </span><br>
                      <span style="font-weight: 600; font-size: 1.2rem;"><a target="_blank" href="/petiti/<?php echo $denunciado ?>">@<?php echo $denunciado ?></a></span></p>
                    </div>
                  </div>
                  <div class="card-data">
                    <span class="material-symbols-outlined">date_range</span>
                    <div class="data-denunciador">
                      <p> Denuncia feita em: <?php echo $data; ?></p>
                    </div>
                  </div>
                  <p><span style="font-weight: 900;font-size: 15px;">Denunciado por: </span><span style="font-weight: 600;font-size: 15px;"><a target="_blank" href="/petiti/<?php echo $denunciador ?>">@<?php echo $denunciador ?></a></span></p>
                  <p><span style="font-weight: 900;">Decisão da administração: </span><span style="font-weight: 600;"> <?php echo $textoDenuncia ?></span></p>
                  <a href="/petiti/api/passar-denuncia-analise/usuario/<?php echo $idDenunciaUsuario; ?>" class="botao analisar">Passar para análise novamente</a>
                </div>
              <?php
              } ?>
            </div>

            <div style="margin-top: 1rem; border-bottom: 1px solid #c1c1c1"></div>

              <h3 style="margin-top: 1rem; margin-bottom: 0.5rem;"> Denúncias de Comentários</h3>
              <h3 id="total-qtd-comentarios">Total(<?php echo $denunciaComentario->buscaQtdDenunciaComentarioResolvida(); ?>)</h3>
              <div class="denunciasComentarios">
                <?php foreach($listaDenunciasComentarioResolvidas as $linha){
                  $idDenunciaComentario = $linha['idDenunciaComentario'];
                  $idDenunciado = $linha['idUsuarioDenunciado'];
                  $idDenunciador = $linha['idUsuarioDenunciador'];
                  $textoDenuncia = $linha['textoDenunciaComentario'];
                  $foto = $linha['caminhoFoto'];
                  $denunciado = $linha['usuarioDenunciado'];
                  $denunciador = $linha['usuarioDenunciador'];
                  $data = $linha['dia'] . " de " . $linha['mes'] . " de " . $linha['ano'];
                }
                ?>
                <div class="card">
                  <div class="badges">
                    <p class="badge ativo">Resolvido</p>
                  </div>
                  <div class="infos-card">
                    <img class="foto-info" src="<?php echo $foto; ?>">
                    <div class="denuncia-info">
                      <p><span style="font-weight: 900; font-size: 1.2rem">Perfil: </span><br>
                      <span style="font-weight: 600; font-size: 1.2rem"><a target="_blank" href="/petiti/<?php echo $denunciado ?>">@<?php echo $denunciado ?></a></span></p>
                    </div>
                  </div>
                  <div class="card-data">
                    <span class="material-symbols-outlined">date_range</span>
                    <div class="data-denunciador">
                      <p> Denuncia feita em: <?php echo $data; ?></p>
                    </div>
                  </div>
                  <p><span style="font-weight: 900;font-size: 15px;">Denunciado por: </span><span style="font-weight: 600;font-size: 15px;"><a target="_blank" href="/petiti/<?php echo $denunciador ?>">@<?php echo $denunciador ?></a></span></p>
                  <p><span style="font-weight: 900;">Decisão da administração: </span><span style="font-weight: 600;"> <?php echo $textoDenuncia ?></span></p>
                  <a href="/petiti/api/passar-denuncia-analise/comentario/<?php echo $idDenunciaComentario; ?>" class="botao analisar">Passar para análise novamente</a>
                </div>
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
  <?php
  if (isset($_COOKIE["denunciaParaAnalise"])) {
    echo ($_COOKIE["denunciaParaAnalise"]);
  } else {
  }
  ?>





  <script src="/petiti/private-adm/dashboard/js/script.js"></script>
</body>

</html>