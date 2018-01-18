<!DOCTYPE html>
<?php
/* Template Name: jeu */
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Last Constitution</title>

        <!-- libaries css-->
        <link type="text/css" rel="stylesheet"
              href="../../wp-content/themes/themeLastConstitution/libraries/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet"
              href="../../wp-content/themes/themeLastConstitution/libraries/font-awesome/css/font-awesome.css" />

        <!-- libraries js -->
        <script type="text/javascript"
        src="../../wp-content/themes/themeLastConstitution/libraries/jQuery/jquery-3.2.1.js"></script>
        <script type="text/javascript"
        src="../../wp-content/themes/themeLastConstitution/libraries/tether/dist/js/tether.js"></script>
        <script type="text/javascript"
        src="../../wp-content/themes/themeLastConstitution/libraries/bootstrap/js/bootstrap.js"></script>

        <!-- custom css & js -->
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/outlook-demo.js"></script>
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/global.js"></script>
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/event_javascript.js"></script>
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/loot.js"></script>
        <script type="text/javascript" src="../../wp-content/themes/themeLastConstitution/custom/js/building_javascript.js"></script>
        <link type="text/css" rel="stylesheet" href="../../wp-content/themes/themeLastConstitution/style.css" />
        <link type="text/css" rel="stylesheet" href="../../wp-content/themes/themeLastConstitution/sass/style.css" />
        <link href="//ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <link href="//ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet">
  
 
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.3.min.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/bootstrap.min.js"></script>
  <script src="https://kjur.github.io/jsrsasign/jsrsasign-latest-all-min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.amd.js"></script>
  <script src="../../wp-content/themes/themeLastConstitution/libraries/msgraph-sdk-javascript-dev/lib/graph-js-sdk-web.js"></script>
  
  
    </head>
        
    <?php
    get_template_part("../../plugins/game_plugin/process_general.php");
     
    get_template_part("../../plugins/game_plugin/process_event.php");
    get_template_part("../../plugins/game_plugin/process_loot.php");
    if (is_user_logged_in()) {
        $id_partie_get;
        if (isset($_GET['id'])) {
            $id_partie_get = $_GET['id'];
            $parties = array();
            
            
            error_log("DEBUG : parties = "); 
            foreach (get_games(get_current_user_id()) as $value) {
                array_push($parties, $value[0]);
            }
            if (!in_array($id_partie_get, $parties)) {
                error_log('fin de zsedrfghjfgdzgethryjtkuylu');
                wp_redirect(get_permalink(get_page_by_title('lobby')));
                exit();
            }
            
            if (end_game($id_partie_get)) {
                error_log('fin de partie elle est terminé point');
                $log = wp_redirect(get_permalink(get_page_by_title('fin-de-partie')) . "?id_partie=" . $id_partie_get);
                error_log("redirect : ".$log);
                exit();
            }
        }
    } else {
        error_log("le else de l'enfer !!");
        wp_redirect(home_url());
        exit();
    }
    ?>
    
   <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php#inbox">DASHBOARD</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav authed-nav">
          
          <li id='inbox-nav'><a href="#inbox">Inbox</a></li>
          <li id='inbox-nav'><a href="page_2.php">page2</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right authed-nav">
          <li><a href="#signout">Sign out</a></li>
        </ul>
      </div>
    </div>
  </nav>
    
    <body class="taille_min_global_mobile">
        
        <h1 class="text-center"> Last Constitution </h1>
        <div class="container containerGlobal">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div id="menu" class="menu container taille_min_menu_mobile separation_menu_grille">
                        <div id="onglets" class="row justify-content-around">
                            
                            <button type="submit" class="btn col-2" onclick="show_menu('ville')" > Ville </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('etat')" > Etat </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('zone')" > Zone </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('chat')" > Chat </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('coffre'), loot_from_coffre_ville()" > Coffre </button>
                            <button type="submit" class="btn col-2" onclick="show_menu('rapport')" > Rapport </button>
                        </div>
    
                        <div class="container">
                            <div id="ville"> 
                              <div class="option">  
  <div class="main-container option">
    <div id="signin-prompt" class="jumbotron page">
      <h1>Outlook SPA Demo</h1>
      <p>This example shows how to get an OAuth token from Azure using the <a href="https://azure.microsoft.com/en-us/documentation/articles/active-directory-v2-protocols-implicit/">implicit grant flow</a> and to use that token to make calls to the Outlook APIs.</p>
      <p>
        <a class="btn btn-lg btn-primary" href="http://localhost/test_test_tes/index.php/jeu/" role="button" id="connect-button">Connect to Outlook</a>
      </p>
    </div>
    <!-- logged in user welcome -->

    <!-- unsupported browser message -->
<div id="unsupported" class="jumbotron page">
  <h1>Oops....</h1>
  <p>This page requires browser support for <a href="https://developer.mozilla.org/en-US/docs/Web/API/Web_Storage_API">session storage</a> and <a href="https://developer.mozilla.org/en-US/docs/Web/API/RandomSource/getRandomValues"><code>crypto.getRandomValues</code></a>. Unfortunately, your browser does not support one or both features. Please visit this page using a different browser.</p>
</div>
    <!-- error message -->
<div id="error-display" class="page panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title" id="error-name"></h3>
  </div>
  <div class="panel-body">
    <pre><code id="error-desc"></code></pre>
  </div>
</div>
    <!-- inbox display -->
<div id="inbox" class="page panel panel-default option">
    
    
  <div class=" ">
    
  </div>
  <div id="inbox-status" class="panel-body option">
  </div>
  <div class="" id="message-list">
  
</div>

     

  </div>
    
  
        
        
        
        
        
      
    <!-- Handlebars template for message list -->
    <script id="msg-list-template">
        
<div class="row">
 <div class="col-lg-6"> 
    {{#each messages}}
        <h3 id="msg-from" class="list-group-item-heading">{{this.from.emailAddress.name}}</h3>
        
        <p id="msg-received" class="list-group-item-heading text-muted"><em>Received: {{formatDate this.receivedDateTime}}</em></p>

        <div id="post1" class="azerty">
            <p id="msg-bodyPreview" class="list-group-item-text text-muted azerty"><em>{{this.bodyPreview}}</em></p>
            <div class="demasquer">
                    <p id="msg-uniqueBody" class=""><em>{{{this.uniqueBody.content}}}</em></p>;
            </div>
        </div> 
    {{/each}}
    
     
  
    
    </div>

<div class="col-lg-6">
            <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=fr.french%23holiday%40group.v.calendar.google.com&amp;color=%23125A12&amp;ctz=Europe%2FParis" style="border-width:0" width="700" height="600" frameborder="0" scrolling="no"></iframe>
        </div>     
 
  </div> 
  </script>

  </div>

    </div>
                                
                                
                            </div>
                            <div id="etat" class="hidden">
                                <h2 class="text-center"> Etat </h2>
                                <div id="pseudo">
                                    <p> Pseudo :                      
                                        <B>
                                        <?php
                                        $current_user = wp_get_current_user();
                                        echo $current_user->user_login;
                                        ?> 
                                        </B>
                                    </p>
                                </div>
                                
                                <div>
                                    <p>
                                        Vous avez: <span id="points_action"> <B>
                                            <?php
                                            echo get_points_action(get_current_user_id(), $id_partie_get);
                                            ?> 
                                                </B></span> points d'action.
                                    </p>
                                </div>
                                <div id="num_team">
                                    <p>
                                        Vous êtes dans l'équipe <span class="team"><?php
                                            echo get_team(get_current_user_id(), $id_partie_get);
                                            ?></span>.
                                    Vos points de victoire totaux sont : 
                                    
                                
                                <span id="pts_victoire">
                                <?php 
                                
                                echo get_points_victoire(get_team(get_current_user_id(), $id_partie_get), $id_partie_get)
                                
                                ?></span> /10 (10pts = Victoire)
                                
                                    </p>
                                    
                                </div>
                                <div id="position">
                                    <p>Vous êtes en: 
                                        <b><?php
                                        echo get_position(false, $id_partie_get);
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div id="chat" class="hidden">
                                <h2 class="text-center">
                                    Chat <span id="switch_chat">: ville</span> 
                                </h2>
                                <div id="onglets" class="row justify-content-around">
                                    <button type="submit" class="btn col-2"
                                            onclick="show_menu_chat('ville')">ville</button>
                                    <button type="submit" class="btn col-2"
                                            onclick="show_menu_chat('case')">case</button>
                                </div>
                                <div id="bloc_chat_ville" class="chat_spe">
                                    <div class="chat">
                                        <div id="chat_ville">
                                            <?php
                                            $chat_ville = load_chat_by_tag("ville", $id_partie_get);
                                            if ($chat_ville != null) {
                                                foreach ($chat_ville as $value) {
                                                    ?> 
                                                    <div class="row">
                                                        <div class="col-3"><?php echo $value->heure ?></div>
                                                        <!-- <div class="col-2"><?php //echo get_login_by_id($value->id_joueur);      ?></div> -->
                                                        <div class="col-2"><?php
                                                            get_user_by('id', $value->id_joueur);
                                                            echo $user->login
                                                            ?></div>
                                                        <div class="col-7"><?php echo $value->message; ?></div>
                                                    </div>
                                                    <hr />
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <input type="text" id="message_ville">
                                    <button type="submit" class="btn btn-secondary"
                                            onclick="send_message('ville')">Envoyer</button>
                                </div>
                                <div id="bloc_chat_case" class="chat_spe hidden">
                                    <div class="chat">
                                        <div id="chat_case">
                                            <?php
                                            $chat_case = load_chat_by_tag("case", $id_partie_get);
                                            if ($chat_case != null) {
                                                foreach ($chat_case as $value) {
                                                    ?> 
                                                    <div class="row">
                                                        <div class="col-3"><?php echo $value->heure ?></div>
                                                        <!--  <div class="col-2"><?php //echo get_login_by_id($value->id_joueur);      ?></div>-->
                                                        <div class="col-2"><?php
                                                            $user = get_user_by('id', $value->id_joueur);
                                                            echo $user->login
                                                            ?></div>
                                                        <div class="col-7"><?php echo $value->message; ?></div>
                                                    </div>
                                                    <hr />
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <input type="text" id="message_case" >

                                    <button type="submit" class="btn btn-secondary"
                                            onclick="send_message('case')">Envoyer
                                    </button>
                                          
                                </div>
                                <p id="message_reponse"></p>
                            </div>
                            <div id="zone" class="hidden">
                                <h2 class="text-center">
                                    Zone <span id="nom_position"></span>
                                </h2>
                               
                                <button id="button_fouiller" onclick="loot_zone(<?php echo $id_partie_get ?>)" >FOUILLER ZONE</button>
                                <p id="zone_joueur"></p>
                                
                                 <p id="zone_list_player" ></p>
                                


                            </div>
                            <div id="coffre" class="hidden">
                                <h2 class="text-center"> Coffre de Ville </h2>

                                <div id="arme_list" class="row invent">
                                    <p> Arme  </p>
                                    <p class="result_arme"></p>
                                    <p class="nom_arme">       
                                </div>


                                <div id="vehicule_list" class="row invent">
                                    <p> Véhicules  </p>
                                    <p class="result_vehicule"></p>
                                    <p class="nom_vehicule"> </p>
                                </div>

                                <div id="prot_list" class="row invent">
                                    <p> Protection </p>
                                    <p class="result_protection"></p>
                                    <p class="nom_protection"> </p>
                                </div>

                                <div id="food_list" class="row invent">
                                    <p> Nourritures  </p>
                                    <p class="result_food"></p>
                                    <p class="nom_food"> </p>
                                </div>
                            </div>
                            <div id="rapport" class="hidden">
                                <h2 class="text-center">Résultats des combats</h2>
                                <div id="journal">
                                     </b></p>
                                </div>
                                
                                <div id="journal">
                                	<p> <em> Hier soir de rudes combats ont eu lieu! </em></p>
                                	<p> <em> L'équipe <b>1</b> à générer un score de combat de <b><span id="score_equipe_1"></span></b>. </em></p>
                                        <p> <em> Quant à elle l'équipe <b>2</b> à générer un score de combat de <b><span id="score_equipe_2"></span></b>. </em></p>
                                	<p> <em> L'équipe <b><span id="equipe_gagnante"></b></span> à gagné la bataille </em></p>
                                	<p> <em>Equipe <b>1</b> obtient point(s) de victiore <b><span id="points_victoire_equipe_1"></b></span> et l'équipe <b>2</b> obtient <b><span id="points_victoire_equipe_2"> </span></b>point(s) de victoire, gloire à eux! </em></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="row justify-content-around">
                        <div id="grille" class="text-center">    
                            <?php
                            if (isset($id_partie_get)) {
                                $pos = get_position(false, $id_partie_get);
                                $pos_allies = get_position(true, $id_partie_get);
                                $tableau_position_joueur = get_id_mate($id_partie_get, get_team(get_current_user_id(), $id_partie_get)); // get_position(true);
                                $tuile = array('img4', 'img3', 'img2', 'img1');


                                for ($y = 0; $y < 20; $y ++) :
                                    ?>
                                    <div class=" row ">
                                        <?php
                                        for ($x = 0; $x < 20; $x++):
                                            $color = rand(0, count($tuile) - 1);
                                            $bgcase = $tuile[$color];
                                            ?> 
                                            <div
                                                 class="<?php echo $x ?><?php echo ';' . $y ?> cellule <?php echo $bgcase ?> img_map"
                                                 onclick="move(this, <?php echo $id_partie_get ?>)">
                                                     <?php
                                                     foreach ($tableau_position_joueur as $value) {
                                                         if ($x . ";" . $y == $value[1]) {
                                                             echo '<div onclick="display_pseudo_oncell(this, ' . $id_partie_get . ')" id="';
                                                             echo "joueur" . $value[0] . " ";
                                                             echo '"class="';
                                                             foreach ($pos_allies as $value) {
                                                                 $all_pos = $value["position"];
                                                                 if ($all_pos == $x . ';' . $y) {
                                                                     echo $all_pos . " ";
                                                                 }
                                                             }
                                                             echo ' text-center perso"> X </div>';
                                                             break;
                                                         }
                                                     }
                                                     if ($x == 0 && $y == 0) {
                                                         echo "<div class='ville_map'></div>";
                                                     }
                                                     ?>
                                            </div>
                                    <?php endfor; ?>
                                    </div>
                                    <?php
                                endfor
                                ;
                            }
                            ?>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
           
        
        
        <div id="admin">
            <button type="submit" class="btn btn-secondary"
                    onclick="tour_suivant(<?php echo $id_partie_get ?>)">Tour suivant</button>
            <p id="resultat"></p>
        </div>
        <div id="admin2">
            <button type="submit" class="btn btn-secondary"
                    onclick="delete_partie(<?php echo $id_partie_get ?>)">Supprime partie
            </button>
            <p id="resultat"></p>
        </div>

        <?php
        if ($id_partie_get == 999999) {
            ?>
            <form method="post" action="../../wp-content/plugins/game_plugin/game_demo.php">
                <input type="submit" value="Reset démo" name="reset_demo"/>
            </form>

            <?php
        }
        ?>

    </body>
</html>
