<?php include ('inicio.php'); ?>
<div class="pagetitle">
    <!-- <h1>Dashboard</h1> -->
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Simulador </li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Simulador</h5>
                        <div id="slides" class="pt-3">
                            <?php include ('simuladorpartido.php'); ?>
                        </div><!-- end slides -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<?php include ('fin.php'); ?>