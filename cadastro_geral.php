<?php
  require_once('../../config.php');
  global $CFG, $DB;
  $titulo = 'Cadastro Geral';

  $PAGE->set_url($_SERVER['PHP_SELF']);
  $PAGE->set_pagelayout('admin');
  $PAGE->set_context(context_system::instance());
  $PAGE->set_url('/blocks/moodleversion/painel_academico.php'.'/blocks/moodleversion/cadastro_geral.php');
  $PAGE->navbar->add($titulo, new moodle_url("$CFG->httpswwwroot/blocks/moodleversion/cadastro_geral.php"));
  echo $OUTPUT->header();
?>
<link rel="stylesheet" href="meucss.css">
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
<!-- Font Awesome --> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<?php
	require_once("../../config.php");
    global $DB;
    $sql2 = "SELECT COUNT(institution) AS quantidade";
    $sql2 .= " FROM mdl_user";
    $sql2 .= " WHERE deleted <> 1 and suspended <> 1 and username <> 'guest' and format(username, 0)";
    $rss = (array) $DB->get_records_sql($sql2);
	$total_user = array_shift($rss);
?> 
  <h3 class="box-title"><?php echo $titulo; ?></h3>
  <section style="background: #e4eaec;">
	<div style="display: flex;padding: 15px;">
		<p style="width: 70%;"><small>USUÁRIOS CADASTRADOS</small> <small style="font-size: 15px; color: #222222; line-height: 0px; font-weight: 600;"><?php echo $total_user->quantidade; ?></small></p>
		<p><a style="font-size: 12px;border: solid 1px #b50e14;background: #dc3545;border-radius: 4px;padding: 6px 6px 6px 6px;text-align: center;margin: 0px 3px 0px 3px;color: #fff;" href="javascript:history.go(-1)"><i class="fas fa-arrow-left"></i> Voltar</a></small></p>
		<p><a style="font-size: 12px;border: solid 1px #11c26d;background: #11c26d;border-radius: 4px;padding: 6px 6px 6px 6px;text-align: center;margin: 0px 3px 0px 3px;color: #fff;" href="exportar_cadastro_geral.php"><i class="fas fa-download"></i> Exportar</a></p>
	</div>
	<div style="border-color: transparent;padding-left: 3.073rem;box-shadow: none;background: #f3f7f9;border-radius: 200px;touch-action: manipulation;box-sizing: border-box;height: 2.573rem;font-weight: 100;width: 60%;padding: .429rem 1rem;font-size: 1rem;line-height: 1.571429;color: #76838f;margin: 0 auto 10px;">
        <i style="color: #76838f; left: 8px; font-size: 16px; text-align: center; pointer-events: none;" aria-hidden="true"></i>
        <input style="border: none;background: #f3f7f9;box-shadow: none;border-radius: 200px;width: 100%;" type="text" placeholder="Procurar..">
    </div>
	<div class="table-responsive" style="width: 100%;">
        <table class="table no-margin">
            <tbody>
									<?php
										require_once("../../config.php");
										global $DB;
										$sql = "select id, institution, department, quantidade ";
										$sql .= " from (SELECT id, institution, department, COUNT(institution) AS quantidade";
										$sql .= " FROM mdl_user rs";
										$sql .= " WHERE deleted <> 1 and suspended <> 1 and username <> 'guest' and format(username, 0)";
										$sql .= " GROUP BY department, institution)x";
										$sql .= " ORDER BY quantidade DESC";
										$rs = (array) $DB->get_records_sql($sql);
										if (count($rs)) 
										{
											echo "<thead><tr role=\"row\"><th style=\"text-align: center;\">Instituição</th><th>Área de Atuação</th><th>Quantidade</th></tr></thead>"; 
											foreach ($rs as $l) 
											{
												echo "<tr class=\"odd\">";
												echo "<td>" . $l->institution .  "</td><td>" . $l->department .  "</td><td style=\"text-align: center;\">" . $l->quantidade .  "</td>";
												;
												echo "</td></tr>";
											} 
										};
									?>
			</tbody>
        </table>
    </div>
</section>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
	<section>
  		<div class="rows">
			<div class="box" style="width: 100%;" >
          		<div class="box-header with-border">
            		<small><a class="btn btn-comum" href="javascript:history.go(-1)"><i class="fas fa-arrow-left"></i> Voltar</a></small>
            		<small><a class="btn btn-comum" href="exportar_cadastro_geral.php"><i class="fas fa-download"></i> Exportar</a></small>
            		<br>
            		<br>
            		<h3 class="box-title"><small>Usuários Cadastrados</small> <?php echo $total_user->quantidade; ?></h3>
          		</div>
          		<div class="box-body">
            		<div class="rows">
              			<div class="table-responsive" style="width: 100%;">
            				<table class="table no-margin">
              					<tbody>
									<?php
										require_once("../../config.php");
										global $DB;
										$sql = "select id, institution, department, quantidade ";
										$sql .= " from (SELECT id, institution, department, COUNT(institution) AS quantidade";
										$sql .= " FROM mdl_user rs";
										$sql .= " WHERE deleted <> 1 and suspended <> 1 and username <> 'guest' and format(username, 0)";
										$sql .= " GROUP BY department, institution)x";
										$sql .= " ORDER BY quantidade DESC";
										$rs = (array) $DB->get_records_sql($sql);
										if (count($rs)) 
										{
											echo "<thead><tr role=\"row\"><th>Instituição</th><th>Área de Atuação</th><th>Quantidade</th></tr></thead>"; 
											foreach ($rs as $l) 
											{
												echo "<tr class=\"odd\">";
												echo "<td>" . $l->institution .  "</td><td>" . $l->department .  "</td><td>" . $l->quantidade .  "</td>";
												;
												echo "</td></tr>";
											} 
										};
									?>
								</tbody>
            				</table>
            			</div>
        			</div>
    			</div>
     		</div>    
        </div>    
	</section>

<?php
	$PAGE->set_context($context);
	$PAGE->set_pagelayout('incourse');
	$PAGE->set_url('/blocks/moodleversion/painel_academico.php');
	$PAGE->requires->jquery();
	// Never reached if download = true.
	echo $OUTPUT->footer();
?>