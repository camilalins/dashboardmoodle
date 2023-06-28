<?php

	require_once('../../config.php');
	global $CFG, $DB;
	$titulo = 'Painel Academico';

	$PAGE->set_url($_SERVER['PHP_SELF']);
	$PAGE->set_pagelayout('admin');
	$PAGE->set_context(context_system::instance());
	$PAGE->set_url('/blocks/moodleversion/painel_academico.php');
	$PAGE->navbar->add($titulo, new moodle_url("$CFG->httpswwwroot/local/moodleversion/painel_academico.php"));
	echo $OUTPUT->header();
?>
<link rel="stylesheet" href="meucss.css">
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
<!-- Font Awesome --> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<!-- Total de usuários -->    
 <?php
   $sql = "SELECT COUNT(institution) AS quantidade";
   $sql .= " FROM mdl_user";
   $sql .= " WHERE deleted <> 1 and suspended <> 1 and username <> 'guest' and format(username, 0)";
   $rs = (array) $DB->get_records_sql($sql);
   //print_r ($rs);
   $total_user = array_shift($rs);
 ?>
 <!-- Perfil de estudante apenas username CPF - números / habilitados -->         
 <?php
   $sql = "SELECT count(*) as quantidade";
   $sql .= " FROM mdl_user";
   $sql .= " WHERE deleted <> 1 AND suspended <> 1 AND username <> 'guest' and format(username, 0)";
   $estudante = (array) $DB->get_records_sql($sql);
   //print_r ($rs);
   $total_estudante = array_shift($estudante);
 ?>
 <!-- Perfil Intituição Prefeitura RJ/Guarda Municipal  -->         
 <?php
   $sql = "SELECT count(*) as quantidade";
   $sql .= " FROM mdl_user";
   $sql .= " WHERE deleted <> 1 and suspended <> 1 and username <> 'guest' and format(username, 0) AND department = 'GUARDA MUNICIPAL' AND institution = 'PREFEITURA DO RIO DE JANEIRO'";
   $gmrio = (array) $DB->get_records_sql($sql);
   //print_r ($rs);
   $total_gmrio = array_shift($gmrio);
 ?>
 <!-- Perfil Intituição Prefeitura RJ/Guarda Municipal Aposentado  -->         
 <?php
   $sql = "SELECT count(*) as quantidade";
   $sql .= " FROM mdl_user";
   $sql .= " WHERE deleted <> 1 and suspended <> 1 and username <> 'guest' and format(username, 0) AND department = 'GUARDA MUNICIPAL APOSENTADO' AND institution = 'PREFEITURA DO RIO DE JANEIRO'";
   $gmrioaposentado = (array) $DB->get_records_sql($sql);
   //print_r ($rs);
   $total_gmrioaposentado = array_shift($gmrioaposentado);
 ?> 
 
 
 
 
 
 <!-- Alunos habilitados -->         
 <?php
   $sql = "SELECT count(*) as quantidade";
   $sql .= " FROM mdl_role_assignments ass";
   $sql .= " INNER JOIN mdl_user u ON  u.id = ass.userid";
   $sql .= " WHERE roleid=5 AND deleted <> 1 AND suspended <> 1 AND username <> 'guest'";
   $aluno = (array) $DB->get_records_sql($sql);
   //print_r ($rs);
   $total_aluno = array_shift($aluno);
 ?>
  <!-- Total de curso -->         
  <?php
    $sql = "SELECT count(*) as quantidade";
    $sql .= " FROM mdl_course";
    $curso = (array) $DB->get_records_sql($sql);
    $total_course = array_shift($curso);
  ?>
  <!-- Curso Ativo -->          
  <?php

    $sql = "SELECT count(*) as quantidade";
    $sql .= " FROM mdl_course";
	$sql .= " WHERE visible <> 0";
    $curso_ativo = (array) $DB->get_records_sql($sql);
    //print_r ($rs);
    $total_curso_ativo = array_shift($curso_ativo);
  ?>
  <!-- Curso Inativo -->          
  <?php

    $sql = "SELECT count(*) as quantidade";
    $sql .= " FROM mdl_course";
	$sql .= " WHERE visible <> 1";
    $curso_inativo = (array) $DB->get_records_sql($sql);
    //print_r ($rs);
    $total_curso_inativo = array_shift($curso_inativo);
  ?>  	



  
<h3 class="box-title"><?php echo $titulo; ?></h3>
<section style="display: flex; justify-content: center;">
	<div style="background: #e4eaec; padding: 10px; width: 50%;margin: 5px;">
		<div style="display: flex; justify-content: center;">
			<div style="width:50%;">
				<span class="info-box-icon bg-dodgerblue"><i class="fas fa-user-graduate" style="color:#51666C;"></i></span>
				<p style="font-size: 12px; color: #222222;">USUÁRIOS CADASTRADOS</p>
				<p style="font-size: 24px; color: #222222; line-height: 0px; font-weight: 600;"></p>
				<p style="color: #856404;background-color: #fff3cd;border-color: #ffeeba;padding: 5px;position: relative;margin-bottom: 1rem;border: 1px solid transparent;border-radius: 0.25rem;transition: opacity 0.15s linear;"> <span style="font-weight: bolder; color: #856404;"> Alunos <?php echo $total_estudante->quantidade; ?></p> </span></p>
				<p style="color: #004085;background-color: #cce5ff;border-color: #b8daff;padding: 5px;position: relative;margin-bottom: 1rem;border: 1px solid transparent;border-radius: 0.25rem;transition: opacity 0.15s linear;"> <span style="font-weight: bolder; color: #002752;">Usuários do Sistema </span></p>
			</div>
			<div style="width:50%;">
				<br>
				<br>
				<br>
				<p style="color: #fff;font-size: 12px;background:#11c26d;border: solid 1px #11c26d;border-radius: 4px;padding: 6px 6px 6px 6px;text-align: center;margin: 3px 3px 3px 3px;"><span style="font-weight: bolder; color: #fff;"><?php echo $total_gmrio->quantidade; ?></span>  Servidores da GM Rio </p>
				<p style="color: #fff;font-size: 12px;background:#eb6709;border: solid 1px #eb6709;border-radius: 4px;padding: 6px 6px 6px 6px;text-align: center;margin: 3px 3px 3px 3px;"><span style="font-weight: bolder; color: #fff;"><?php echo $total_gmrioaposentado->quantidade; ?></span> Servidores Aposentados da GM Rio</span> </p>
				<p style="color: #fff;font-size: 12px;background:#9463f7;border: solid 1px #9463f7;border-radius: 4px;padding: 6px 6px 6px 6px;text-align: center;margin: 3px 3px 3px 3px;"><span style="font-weight: bolder; color: #fff;"></span>Externos</p>
			</div>
		</div>
		
		<br>
		<br>
		<p style="color:#034168; font-size: 10px; font-weight: 600;"><a style="color:#034168; font-size: 10px; font-weight: 600;" href="curso_turma.php" ><i class="fas fa-angle-double-right"></i> DETALHES</a></p>
		
		<table class="table no-margin">
            <tbody>
									<?php
										require_once("../../config.php");
										global $DB;
										$sql = "select name,COUNT(userid) AS quantidade";
										$sql .= " FROM mdl_cohort rs";
										$sql .= " INNER JOIN mdl_cohort_members cm ON cm.cohortid=rs.id";
										$sql .= " INNER JOIN mdl_user u ON cm.userid=u.id";
										$sql .= " GROUP BY cohortid";
										$rs = (array) $DB->get_records_sql($sql);
										if (count($rs)) 
										{
											echo "<thead><tr role=\"row\"><th style=\"text-align: center;\">Nome do Cohort</th><th>Quantidade</th><th>...</th></tr></thead>"; 
											foreach ($rs as $ln) 
											{
												
												echo "<tr class=\"odd\">";
												echo "<td>" . $ln->name .  "</td><td>" . $ln->quantidade .  "</td>";
												;
												echo "</td></tr>";
											} 
										};
									?>
			</tbody>
        </table>
	
	
	</div>

	<div style="background: #e4eaec; padding: 10px; width: 50%;margin: 5px;">
		<div style="display: flex; justify-content: center;">
			<div style="width:50%;">
				<span class="info-box-icon bg-cornflowerblue"><i class="fas fa-book" style="color:#51666C;"></i></span>
				<p style="font-size: 12px; color: #222222;">CURSOS CADASTRADOS</p>
				<p style="font-size: 24px; color: #222222; line-height: 0px; font-weight: 600;"><?php echo $total_course->quantidade; ?></p>
				<p style="color: #856404;background-color: #fff3cd;border-color: #ffeeba;padding: 5px;position: relative;margin-bottom: 1rem;border: 1px solid transparent;border-radius: 0.25rem;transition: opacity 0.15s linear;"> <span style="font-weight: bolder; color: #856404;"> Cursos Inativos </span> <?php echo $total_curso_inativo->quantidade; ?></p>
				<p style="color: #004085;background-color: #cce5ff;border-color: #b8daff;padding: 5px;position: relative;margin-bottom: 1rem;border: 1px solid transparent;border-radius: 0.25rem;transition: opacity 0.15s linear;"> <span style="font-weight: bolder; color: #002752;">Cursos Ativos </span> <?php echo $total_curso_ativo->quantidade; ?></p>
			</div>
			<div style="width:50%;">
				<br>
				<br>
				<br>
				<!--<img style="padding: 4px;" src="chart2.png" alt="some text" width=100 height=100>-->
				<p style="color: #fff;font-size: 12px;background:#11c26d;border: solid 1px #11c26d;border-radius: 4px;padding: 6px 6px 6px 6px;text-align: center;margin: 3px 3px 3px 3px;">77 online</p>
				<p style="color: #fff;font-size: 12px;background:#eb6709;border: solid 1px #eb6709;border-radius: 4px;padding: 6px 6px 6px 6px;text-align: center;margin: 3px 3px 3px 3px;">7 semipresencial</p>
				<p style="color: #fff;font-size: 12px;background:#9463f7;border: solid 1px #9463f7;border-radius: 4px;padding: 6px 6px 6px 6px;text-align: center;margin: 3px 3px 3px 3px;">77 presencial</p>
			</div>
		</div>
		
		<br>
		<br>
		<p style="color:#034168; font-size: 10px; font-weight: 600;"><a style="color:#034168; font-size: 10px; font-weight: 600;" href="curso_turma.php" ><i class="fas fa-angle-double-right"></i> DETALHES</a></p>
	</div>
</section>
<section style="">
	<div style="background:#e4eaec; padding: 10px;margin: 5px;">
		<div style="">
			<p style="font-size: 12px; color: #222222;">DETALHES DO CURSO</p>
			<form action="detalhes_curso.php" method="post" class="form-horizontal">
				<div class="input-group input-group-sm">    
									<?php

										$sql7 = "SELECT disciplina.id, disciplina.fullname AS curso ";
										$sql7 .= "FROM mdl_course AS disciplina ";
										$sql7 .= " ORDER BY disciplina.fullname ASC";
										$disciplina = (array) $DB->get_records_sql($sql7);


										if (count($disciplina)) {
											echo "<div class=\"input-group input-group-sm\">"; 
											echo "<select style=\"border-color: transparent;padding-left: 3.073rem;box-shadow: none;background: #f3f7f9;border-radius: 200px;touch-action: manipulation;box-sizing: border-box;height: 2.573rem;font-weight: 100;width: 60%;padding: .429rem 1rem;font-size: 1rem; line-height: 1.571429; color: #76838f; margin: 0 auto 10px;\" name=\"escolha_curso\" class=\"form-control\"><option>Escolha o curso</option>";
											foreach ($disciplina as $l7) {
												echo "<option value=\"". $l7->curso ."\">" . $l7->curso . "</option>";
											} 
											echo "</select>";
										};
									?>	
					<span class="input-group-btn">
						<button type="submit" style="border-radius: 14px; margin: 1px 0px 0px 7px; padding: 1px 12px 3px 12px;background: #034168; color: #fff;">Pesquisar</button>
					</span>
				</div>
			</form>
			<div style="border-color: transparent;padding-left: 3.073rem;box-shadow: none;background: #f3f7f9;border-radius: 200px;touch-action: manipulation;box-sizing: border-box;height: 2.573rem;font-weight: 100;width: 60%;padding: .429rem 1rem;font-size: 1rem;line-height: 1.571429;color: #76838f;margin: 0 auto 10px;">
				<i style="color: #76838f; left: 8px; font-size: 16px; text-align: center; pointer-events: none;" aria-hidden="true"></i>
				<input style="border: none;background: #f3f7f9;box-shadow: none;border-radius: 200px;width: 100%;" type="text" placeholder="Procurar..">
			</div>				
		</div>
	</div>

</section>
<section style="display: flex; justify-content: center;">
	<div style="background: #e4eaec; padding: 10px; width: 50%;margin: 5px;">
		<div style="display: flex; justify-content: center;">
			<div style="width:50%;">
				<span class="info-box-icon bg-dodgerblue"><i class="fas fa-user-graduate" style="color:#51666C;"></i></span>
				<p style="font-size: 12px; color: #222222;">CURSOS CAPACITAÇÃO</p>
				<p style="font-size: 24px; color: #222222; line-height: 0px; font-weight: 600;"><?php echo $total_user->quantidade; ?></p>
				<br>
				<br>
				<p style="color:#034168; font-size: 10px; font-weight: 600;"><a  style="color:#034168; font-size: 10px; font-weight: 600;" href="cadastro_geral.php"><i class="fas fa-angle-double-right"></i> DETALHES</a></p>
			</div> 
			<div style="width:50%;">
				<img style="padding: 4px;"  src="chart1.png" alt="some text" width=200 height=200>
			</div>
		</div>
	</div>
	<div style="background: #e4eaec; padding: 10px; width: 50%;margin: 5px;">
		<div style="display: flex; justify-content: center;">
			<div style="width:50%;">
				<span class="info-box-icon bg-dodgerblue"><i class="fas fa-user-graduate" style="color:#51666C;"></i></span>
				<p style="font-size: 12px; color: #222222;">CURSOS LIVRE</p>
				<p style="font-size: 24px; color: #222222; line-height: 0px; font-weight: 600;"><?php echo $total_user->quantidade; ?></p>
				<br>
				<br>
				<p style="color:#034168; font-size: 10px; font-weight: 600;"><a style="color:#034168; font-size: 10px; font-weight: 600;" href="cadastro_geral.php"><i class="fas fa-angle-double-right"></i> DETALHES</a></p>
			</div> 
			<div style="width:50%;">
				<img style="padding: 4px;"  src="chart1.png" alt="some text" width=200 height=200>
			</div>
		</div>
	</div>
	<div style="background:#f3f7f9; padding: 10px; width: 50%;margin: 5px;">
		<span class="info-box-icon bg-cornflowerblue"><i class="fas fa-book" style="color:#51666C;"></i></span>
		<p style="font-size: 12px; color: #222222;">CURSOS EM ANDAMENTO</p>
		<ul style="list-style: none;">
			<li style="border-bottom: 1px solid #e4eaec;">Curso Título 1</li>
			<li style="border-bottom: 1px solid #e4eaec;">Curso Título 2</li>
			<li style="border-bottom: 1px solid #e4eaec;">Curso Título 3</li>
			<li style="border-bottom: 1px solid #e4eaec;">Curso Título 4</li>
			<li style="border-bottom: 1px solid #e4eaec;">Curso Título 5</li>
			<li style="border-bottom: 1px solid #e4eaec;">Curso Título 6</li>
		</ul>
		<br>
		<br>
		<p style="color:#ff9b3d; font-size: 10px; font-weight: 600;"><a style="color:#ff9b3d; font-size: 10px; font-weight: 600;" href="curso_turma.php" ><i class="fas fa-angle-double-right"></i> DETALHES</a></p>
	</div>
</section>
<section style="">
	<div style="background: #e4eaec; padding: 10px;margin: 5px;">
		<div style="display:flex;padding-bottom: 10px;">
			<p style="font-size: 12px; color: #222222;width: 70%;">TOTAL DE ACESSOS</p>
			<p style="font-size: 10px;color: #fff;width: 20%;background: #6b6b6b;padding: 4px;border-radius: 31px;text-align: center;font-weight: 600;">VISUALIZAÇÃO</p>
		</div>
		<div style="display:flex;justify-content: center;">
			<div style="width: 33%;text-align: center;">
				<p style="font-size: 12px; color: #222222;">TOTAL</p>
				<p style="font-size: 12px; color: #034168">20,186</p>
			</div>
			<div style="width: 33%;text-align: center;">
				<p style="font-size: 12px; color: #222222;">MÊS</p>
				<p style="font-size: 12px; color: #034168">261</p>
			</div>
			<div style="width: 33%;text-align: center;">
				<p style="font-size: 12px; color: #222222;">HOJE</p>
				<p style="font-size: 12px; color: #034168">72</p>
			</div>
		</div>
	</div>

</section>

















	<section>
		<div class="rows">
			<div class="col-md-3 col-sm-6 col-xs-12" style="width: 34%;">
				<div class="info-box-topo">
					<span class="info-box-icon bg-dodgerblue"><i class="fas fa-user-graduate" style="color:#51666C;"></i></span>
					<a href="cadastro_geral.php" style="font-weight:800!important; font-size:20px; "> <?php echo $total_user->quantidade; ?></a>
					<div class="info-box-content">
						<span class="info-box-number">
							<a href="cadastro_geral.php">
								<small style="font-weight:100!important;">Usuários Cadastrados</small> 
							</a>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12" style="width: 33%;">
				<div class="info-box-topo">
					<span class="info-box-icon bg-cornflowerblue"><i class="fas fa-book" style="color:#51666C;"></i></span>
					<a href="curso_turma.php" style="font-weight:800!important; font-size:20px; "><?php echo $total_curso_ativo->quantidade; ?></a>
					<div class="info-box-content">
						<span class="info-box-number">
							<a href="curso_turma.php" >
								<small style="font-weight:100!important;">Cursos Cadastrados</small>
							</a>
						</span>
					</div>
				</div>
			</div>
		</div>  
	</section>
	<section>
		<div class="rows">
			<div class="col-md-3 col-sm-6 col-xs-12" style="width: 100%;">
					<div class="info-box-topo">
						
						<div class="info-box-content">
							<span class="info-box-number">
								<h3 class="box-title"><span class="info-box-icon bg-dodgerblue"><i class="fas fa-user-graduate"></i></span><small> Detalhes Sobre o Curso </small></h3>
							</span>
							<form action="detalhes_curso.php" method="post" class="form-horizontal">
								<div class="input-group input-group-sm">    
									<?php

										$sql7 = "SELECT disciplina.id, disciplina.fullname AS curso ";
										$sql7 .= "FROM mdl_course AS disciplina ";
										$sql7 .= " ORDER BY disciplina.fullname ASC";
										$disciplina = (array) $DB->get_records_sql($sql7);


										if (count($disciplina)) {
											echo "<div class=\"input-group input-group-sm\">"; 
											echo "<select name=\"escolha_curso\" class=\"form-control\"><option>Escolha o curso</option>";
											foreach ($disciplina as $l7) {
												echo "<option value=\"". $l7->curso ."\">" . $l7->curso . "</option>";
											} 
											echo "</select>";
										};
									?>	
									<span class="input-group-btn">
										<button type="submit" class="btn btn-info btn-flat">Pesquisar</button>
									</span>
								</div>
							</form>	
						</div>
					</div>
			</div>
		</div>
	</section>	
	



<?php
	$PAGE->set_context($context);
	$PAGE->set_pagelayout('incourse');
	$PAGE->requires->jquery();
	// Never reached if download = true.
	echo $OUTPUT->footer();
?>
