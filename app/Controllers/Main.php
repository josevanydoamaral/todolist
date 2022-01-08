<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Main extends Controller
{
    // =======================================================================
    public function index()
    {
        // get all jobs from database
        $dados = $this->getAllJobs();

        // display the homepage
        return view('Home', ['jobs' => $dados]);
    }

    public function newJob() {
        return view('new_job');
    }

    public function newJobSubmition() {

        if (!$_SERVER["REQUEST_METHOD"] == 'POST') {
            return redirect()->to(site_url('main'));
        } 

        

        $param = [
            'job' => $this->request->getPost('job_name')
        ];

        // Guardar na bd
        $db = db_connect();
            $db->query("INSERT INTO jobs (job, datetime_created) VALUES (:job:, now())", $param);
        $db->close();

        return redirect()->to(site_url('main'));

    }

    public function jobDone($id_job = -1) {
        // atualizar na bd a tarefa como tendo sido realizada
        $db =db_connect();
        $param = [
            'id_job' => $id_job
        ];
        $db->query("UPDATE jobs
                    SET datetime_finished = now(), datetime_updated = now()
                    WHERE id_job = :id_job:", $param);

        $db->close();

        // atualizar a página inicial
        return redirect()->to(site_url('main'));
    }
    
    // =======================================================================
    public function editJob($id_job=-1) {
        // carregar os dados da tarefa
        $param = [
            'id_job' => $id_job
        ];
        $db = db_connect();
            $dados = $db->query("SELECT * FROM jobs WHERE id_job = :id_job:", $param)->getResultObject();
        $db->close();

        $data['job'] = $dados[0];
        return view('edit_job', $data);
    }

    // =======================================================================
    public function editJobSubmition() {
        // atualizar na base de dados
        $params = [
            'id_job' => $this->request->getPost('id_job'),
            'job' => $this->request->getPost('job_name') 
        ];
        $db = db_connect();
            $db->query("
            UPDATE jobs
            SET job = :job:, datetime_updated = now()
            WHERE id_job = :id_job:", $params);
            $db->close();

        // atualizar a página inicial
        return redirect()->to(site_url('main'));
    }

    public function deleteJob($id_job = -1) {
        // apresentar uma view questionando se pretende eliminar a tarefa
        $params = [
            'id_job' => $id_job
        ];
        $db = db_connect();
            $data['job'] = $db->query("
            SELECT * from jobs 
            WHERE id_job = :id_job:
            ", $params)->getResultObject()[0];
        $db->close();

        return view('delete_job', $data);
    }

    public function deleteJobConfirmed($id_job = -1) {
        // delete da tarefa na bd
        $params = [
            'id_job' => $id_job
        ];
        $db = db_connect();
            $data['job'] = $db->query("
            DELETE from jobs 
            WHERE id_job = :id_job:
            ", $params);
        $db->close();

        //atualização da página inicial

        return redirect()->to(site_url('main'));
    }

    // =======================================================================
    private function getAllJobs() {
        $db = db_connect();
            $dados = $db->query("SELECT * FROM jobs")->getResultObject();
        $db->close();
        return $dados;
    }

    // =======================================================================
}
