<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentica extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('usuario');
		$this->load->helper('url');
		$this->load->helper('security');
	}
	function index(){
		$this->load->library('form_validation');

		//Define os campos de login como obrigatorios
		$this->form_validation->set_message('required', 'Campo %s obrigatorio');
		$this->form_validation->set_rules('login','Email ou Usuario','trim|required');
		$this->form_validation->set_rules('password','Senha','trim|required');

		//Verifica se os campos obrigatorios foram preenchidos
		if($this->form_validation->run() == FALSE){
			//se nao forem preenchidos a pagina e atualizada
			redirect('login','refresh');
		}else{
			//Faz a requisição dos dados do login caso tenham sido inseridos
			$login = $this->input->post('login');
			$senha = $this->input->post('password');
			//faz uma consulta no model login para verificar se os dados existem
			$result = $this->usuario->login($login, $senha);

			//caso os dados existam ele faz a query para criar a sessão
			if((isset($result)) && (!empty($result))){
				foreach($result as $usuario){
					$configArray = array(
						'nomeUsuario' => $usuario->nome,
						'loginUsuario' => $usuario->login,
						'emailUsuario' => $usuario->email,
						'dataCadastro' => $usuario->created_at
					);
				}
				//cria a sessão com os dados da array
				$this->session->set_userdata('logged_in', $configArray);
				//redireciona para a pagina do dashboard caso tenha dado tudo certo
				redirect('home/dashboard', 'refresh');
			}else{
				//caso o usuario nao tenha sido encontrado ele atualiza a pagina
				redirect('login','refresh');
			}
		}
	}

}
