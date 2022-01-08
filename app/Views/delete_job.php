<?= $this->extend('layouts/main_layout');?>

<?= $this->section('conteudo') ?>

<header class="container">
    <div class="row">
        <div class="col p-3">
            <h1>Todo List</h1>
        </div>
        <div class="col text-right p-3">
            <p>Eliminar tarefa</p>
        </div>
    </div>
</header>
<hr>

<div class="container">
    <div class="row">
        <div class="col text-center">
            <h3>Deseja eliminar a tarefa?</h3>
            <div class="card p-3 bg-light my-3">
                <h4><?=$job->job?></h4>
            </div>
            
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col text-center">
            <a href="<?= site_url('main')?>" class="btn btn-secondary">Não</a>
            <a href="<?= site_url('main/deleteJobConfirmed/'. $job->id_job)?>" class="btn btn-primary">Sim</a>
            
        </div>
    </div>
</div>

<?= $this->endSection();?>