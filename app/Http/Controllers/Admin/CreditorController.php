<?php

namespace App\Http\Controllers\Admin;

use App\Models\Creditor;
use App\Models\EconomicSector;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreditorController extends Controller
{
    private $route = 'creditors';
    private $page = ['plural' => 'propostas de parcerias', 'singular' => 'proposta de parceria'];
    private $totalPerPage = 10;
    private $model, $modelUser, $modelSector;
    private $colunmSearch = ['Parceiro', 'Setor econômico', 'value'];
    private $colunms = [
        'userName' => ['value' => 'Nome', 'aling' => 'left'],
        'descriptionSector' => ['value' => 'Setor econômico', 'aling' => 'left'],
        'value' => ['value' => 'Valor do aporte', 'aling' => 'right'],
        'actions' => ['value' => 'Ações', 'aling' => 'center'],
    ];

    public function __construct(Creditor $model, User $modelUser, EconomicSector $modelSector)
    {
        $this->model = $model;
        $this->modelUser = $modelUser;
        $this->modelSector = $modelSector;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colunmsTitle = $this->colunms;
        $list = $this->model->getCreditorsJoin($this->totalPerPage);
        $routeName = $this->route;
        $page = "Lista de ". $this->page['plural'];
        $btnCaption = "Criar ".$this->page['singular'];

        $breadcrumb = [
            (object) ['url' => route('admin.home'), 'title' => 'Home',],
            (object) ['url' => '', 'title' => $page,],
        ];
        return view('admin.'.$routeName.'.index', compact('colunmsTitle', 'list', 'routeName', 'page', 'btnCaption', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routeName = $this->route;
        $page = $this->page;

        $breadcrumb = [
            (object) ['url' => route('admin.home'), 'title' => 'Home',],
            (object) ['url' => route('admin.'.$routeName.'.index'), 'title' => 'Lista de '.$page['plural']],
            (object) ['url' => '', 'title' => "Adicionar ". $page['singular']],
        ];
        $users = $this->modelUser->orderBy('name')->get();
        $sectors = $this->modelSector->orderBy('description')->get();
        return view('admin.'.$routeName.'.create', compact('routeName', 'page', 'breadcrumb', 'users', 'sectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();
        $dataForm['value'] = str_replace(',', '.', str_replace('.', '', $request->value)) ;
        $insert = $this->model->create($dataForm);
        if($insert){
            return redirect()->route('admin.'.$this->route.'.index')->with(['color' => 'success', 'message' => 'Cadastro realizado com sucesso!']);
        } else {
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Falha ao realizar cadasto!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $register = $this->model->with(['user', 'economic_sector'])->find($id);
        dd($register);
        if(!$register)
            return redirect()
                ->back()
                ->with(['color' => 'danger', 'message' => 'Falha ao editar! regitro inexistente.']);

        $routeName = $this->route;
        $page = $this->page;

        $breadcrumb = [
            (object) ['url' => route('admin.home'), 'title' => 'Home',],
            (object) ['url' => route('admin.users.index'), 'title' => 'Lista de '.$page['plural']],
            (object) ['url' => '', 'title' => "Detalhes do ". $page['singular']],
        ];

        return view('admin.'.$routeName.'.show', compact('register', 'routeName', 'page', 'breadcrumb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $register = $this->model->find($id);

        if(!$register)
            return redirect()
                ->back()
                ->with(['color' => 'danger', 'message' => 'Falha ao editar! regitro inexistente.']);

        //dd($register);

        $routeName = $this->route;
        $page = $this->page;

        $breadcrumb = [
            (object) ['url' => route('admin.home'), 'title' => 'Home',],
            (object) ['url' => route('admin.'.$routeName.'.index'), 'title' => 'Lista de '.$page['plural']],
            (object) ['url' => '', 'title' => "Editar ". $page['singular']],
        ];
        $users = $this->modelUser->orderBy('name')->get();
        //dd($users, $register);
        $sectors = $this->modelSector->orderBy('description')->get();
        return view('admin.'.$routeName.'.edit', compact('register','routeName', 'page', 'breadcrumb', 'users', 'sectors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $register = $this->model->find($id);

        if(!$register)
            return redirect()
                ->back()
                ->with('error', 'Falha ao editar. Registro inexistente!');

        $dataForm = $request->all();
        $dataForm['value'] = str_replace(',', '.', str_replace('.', '', $request->value)) ;

        if($register->update($dataForm))
            return redirect()->route('admin.'.$this->route.'.index')->with(['color' => 'success', 'message' => 'Cadastro editado com sucesso!']);
        else
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Falha ao editar cadastro!'])->withInput();
    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        $colunmsTitle = $this->colunms;
        $list = $this->model->search($request, $this->totalPerPage);
        $routeName = $this->route;
        $page = "Lista de ". $this->page['plural'];
        $btnCaption = "Criar ".$this->page['singular'];

        $breadcrumb = [
            (object) ['url' => route('admin.home'), 'title' => 'Home',],
            (object) ['url' => '', 'title' => $page,],
        ];

        return view('admin.'.$routeName.'.index', compact('colunmsTitle', 'list', 'routeName', 'page', 'btnCaption', 'breadcrumb', 'dataForm'));
    }
}
