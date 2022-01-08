<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('conteudo') ?>

<header class="container">
    <div class="row">
        <div class="col p-3">
            <h1>Todo List</h1>
        </div>
        <div class="col text-right p-3">
            <a href="<?= site_url("main/newJob") ?>" class="btn btn-primary">Criar uma nova tarefa...</a>
        </div>
    </div>
</header>
<hr>

<?php if (count($jobs) == 0): ?>
    <p class="text-center">Não existem tarefas.</p>
<?php else: ?>
    <table class="table table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th>Tarefa</th>
                <th class="text-center">Data de criação</th>
                <th class="text-center">Data de finalização</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($jobs as $job): ?>
                <tr>
                    <td><?= $job->job ?></td>
                    <td class="text-center"><?= $job->datetime_created?></td>
                    <td class="text-center"><?= $job->datetime_finished?></td>

                    <td class="text-center">
                        <!-- tarefa realizada -->
                        <?php if (empty($job->datetime_finished)):?>
                            <a href="<?= site_url("main/jobDone/". $job->id_job)?>" class="btn btn-success btn-sm mx-2"><i class="fa fa-check"></i></a> 
                            <a href="<?= site_url("main/editJob/". $job->id_job)?>" class="btn btn-primary btn-sm mx-2"><i class="fa fa-pencil"></i></a>
                        <?php else:?>
                            <button class="btn btn-danger btn-sm mx-2" disabled><i class="fa fa-close"></i></button>
                            <button class="btn btn-primary btn-sm mx-2" disabled><i class="fa fa-pencil"></i></button>
                        <?php endif;?>
                        
                        
                        <a href="<?= site_url("main/deleteJob/". $job->id_job)?>" class="btn btn-primary btn-sm mx-2"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>Nº de Tarefas: <strong><?=count($jobs)?></strong></p>

<?php endif; ?>


<?= $this->endSection() ?>