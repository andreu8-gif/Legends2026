<?php include ('inicio.php'); ?>
<style>
.card-body
{
	padding: 20px;
	/* padding: 0px;  !important */
}
.cell {
		padding: 0px;  !important
		font-size: smaller;  !important
}
.container-partit {
    width: 100%;
    height: 650px;
    background-color: #fff;
    color: #fff;
    overflow: auto;
}

.table-partit !important {
    border-width: thin;
    border-color: cadetblue;
    border-collapse: separate;
}

h1 {
    color: green;
}

thead {
    border: 10px;
    border-style: solid;
    border-width: thin;
}

tbody {
    border: 10px;
    border-style: solid;
    border-width: thin;
}

.bdr {
    border-radius: 6px;
    overflow: hidden;
    padding: 4px;
    background-color: #fefefe;
}
</style>


<div class="pagetitle">
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item"><a href="index.php">Clasificación</a></li>
			<li class="breadcrumb-item active">Partidos</li>
		</ol>
	</nav>
</div><!-- End Page Title -->
	
<section class="section">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Partidos</h5>

					<div class="row align-items-top">
					<?php
					$fase = (!empty($_GET['fase']) == true) ? $_GET['fase'] : '';		
					$grupo = (!empty($_GET['grupo']) == true) ? $_GET['grupo'] : '';

					if ($fase == 1)
					{
						$faseId = " =1 ";
						$grupId = "=".$grupo;
						$grupName = getGroupName($grupo);
					} 
					else if ($fase == 2)
						{
							$faseId = " =2 ";
							$grupId = " is null ";
							$grupName = "OCTAVOS";
						}
						else if ($fase == 3)
							{
								$faseId = " =3 ";
								$grupId = " is null ";
								$grupName = "CUARTOS";
							} 
							else 
							{
								$faseId = " in (4,5) ";
								$grupId = " is null ";
								$grupName = "SEMIS/FINAL";
							}
							
						
					include ('partidosfase.php');
					?>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<?php 
	// mysqli_free_result($resultadoApostaPartits);
	
	
	// mysqli_free_result($resultadoPartits);
	// mysqli_free_result($resultadoApostaPartits);
	// mysqli_free_result($resultadoPunts);
							
?>
<?php include ('fin.php'); ?>
