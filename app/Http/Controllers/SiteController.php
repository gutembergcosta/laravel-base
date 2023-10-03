<?php 

namespace App\Controllers;

use App\Rules\ValidaFieldTexto;
use App\Actions\ListCategoriasUF;
use App\Actions\EnviaEmail;
use App\Rules\ValidaCadastro;
use App\Actions\Logar;

use App\Services\DataItem;
use App\Services\DataArquivo;
use App\Services\DataCategoria;
use App\Services\DataUsuario;
use App\Services\DataDadosGerais;
use App\Services\DataEstado;


class AgroruralController extends Controller
{

    public function __construct(){
		parent:: __construct(); 

        $this->dadosGerais 			= new DataDadosGerais;
		$this->validaFormTexto 		= new ValidaFieldTexto;
		$this->arquivo 				= new DataArquivo;
		$this->categoria			= new DataCategoria;
		$this->listCategoriasUF		= new ListCategoriasUF;
		$this->enviaEmail 			= new EnviaEmail;
		$this->item 				= new DataItem;
		$this->logarPainel 			= new Logar;
		$this->validaCadastro 		= new ValidaCadastro;
		$this->usuario 				= new DataUsuario;
		$this->estados 				= new DataEstado;

		$this->data['estados']  			= $this->estados->load();
		$this->data['infos']  				= $this->dadosGerais->infos();
		$this->data['redesSociais'] 		= $this->dadosGerais->redesSociais();
		$this->data['categorias'] 			= $this->categoria->load();
		$this->data['categoriasUF']			= $this->listCategoriasUF->list();
		
		$this->data['projetos'] 			= $this->item->listByTipo('projeto');
		$this->data['testemunhos'] 			= $this->item->listByTipo('testemunho');
		$this->data['produtos'] 			= $this->item->listByTipo('produto');
		$this->data['anunciosFooter']		= $this->item->listByTipo('anuncio',3);
		$this->data['destaques'] 			= $this->item->listByTipo('destaque');
		$this->data['igrejas'] 				= $this->item->listByTipo('igreja');
		$this->data['numeros'] 				= $this->item->listByTipo('numeros');
		$this->data['slides'] 				= $this->arquivo->loadGaleria('dados-gerais','slide');
		$this->data['marcas'] 				= $this->arquivo->loadGaleria('dados-gerais','marca');
		$this->data['logoImg'] 				= $this->arquivo->getArquivo('dados-gerais','logo');
		$this->data['bannerLateral'] 		= $this->arquivo->getArquivo('dados-gerais','banner-lateral');
		$this->data['bannerCategoria']		= $this->arquivo->getArquivo('dados-gerais','banner-categoria');
		
	}

	public function index()
	{
		$this->data['categoriaTitulo'] 	= 'Anúncios em destaque';
		$this->data['anuncios']			= $this->item->listByTipo('anuncio');
		dd($this->data['anuncios']->toArray());
		Twig::render('agrorural/home-loja.htm', $this->data);
	}

	public function textual()
	{
		Twig::render('agrorural/textual01.htm', $this->data);
	}

	public function contato(){
		$this->data['paginaNome'] = "Contato";
		Twig::render('agrorural/contato01.htm', $this->data);
	}

	public function categoria($slug){
		$categoria 		= $this->categoria->getBySlug($slug);
		$categoriaId 	= $categoria['id'];

		$this->data['categoriaTitulo'] = $categoria['nome'];
		$this->data['anuncios']	= $this->listItem->addAtributos($this->item->listByCategoriaId($categoriaId));
		Twig::render('agrorural/categoria.htm', $this->data);
	}
	public function produto($slug){
	
		$item 						= $this->item->getBySlug($slug);
		
		$this->data['paginaNome'] 	= $item['nome'];
		$this->data['data'] 		= $item; 
		Twig::render('agrorural/produto.htm', $this->data);


	}
	public function portfolio($tipo = false)
	{

		if($tipo){
			Twig::render("agrorural/portfolio-$tipo.htm", $this->data);
		}

		Twig::render("agrorural/portfolio.htm", $this->data);
	}

	public function registro()
	{
		$this->data['paginaNome'] = "Cadastro";
		Twig::render("agrorural/registro.htm", $this->data);
	}


	public function institucional()
	{
		Twig::render("agrorural/institucional.htm", $this->data);
	}

	public function blog()
	{
		Twig::render("agrorural/blog.htm", $this->data);
	}
	public function artigo()
	{
		Twig::render("agrorural/textual01.htm", $this->data);
	}

	public function enviarEmail(){
	
		$dataForm = $this->request;
		$dataForm['tipo'] = 'mensagem';
		$this->validaFormTexto->validaForm($dataForm);
		$this->enviaEmail->execute('mensagem',$dataForm);
	
	}

	public function cadastrar(){

        $dataForm = $dataUser = $this->request;
		$this->validaCadastro->validaform($dataForm);
		$dataUser['tipo'] = 'user';
		$dataUser['ref'] = uniqid();
        $this->usuario->insert($dataUser);
        $this->enviaEmail->execute('cadastro',$dataForm);

    }




	
}
