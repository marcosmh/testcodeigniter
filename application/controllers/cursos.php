<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller
{

    function __construct(){

        parent::__construct();
        $this->load->helper('form');
        $this->load->model('codigofacilito_model');

    }

    function inicio(){
        $this->load->view('codigofacilito/headers');
        $this->load->view('codigofacilito/bienvenido');
    }

    function index(){

        $data['segmento'] = $this->uri->segment(3);
        $this->load->view('codigofacilito/headers');

        if(!$data['segmento']){
            $data['cursos'] = $this->codigofacilito_model->obtenerCursos();
        }
        else{
            $data['cursos'] = $this->codigofacilito_model->obtenerCurso($data['segmento']);
        }


        $this->load->view('cursos/cursos',$data);
    }




    function nuevo(){

        $this->load->view('codigofacilito/headers');
        $this->load->view('cursos/formulario');

    }

    function recibirdatos(){
        $data = array(
            'nombre'=>$this->input->post('nombre'),
            'videos'=>$this->input->post('videos')
        );

        $this->codigofacilito_model->crearCurso($data);
        $this->inicio();
    }

    function editar(){
        $data['id'] = $this->uri->segment(3);
        $data['cursos'] = $this->codigofacilito_model->obtenerCurso($data['id']);
        $this->load->view('codigofacilito/headers');
        $this->load->view('cursos/editar',$data);
    }

    function actualizar(){
        $data = array(
            'nombre'=>$this->input->post('nombre'),
            'videos'=>$this->input->post('videos')
        );

        $this->codigofacilito_model->actualizarCurso($this->uri->segment(3),$data);
        $this->load->view('codigofacilito/headers');
        $this->load->view('codigofacilito/bienvenido');
    }

}