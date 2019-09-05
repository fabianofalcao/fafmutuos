<?php

namespace App\Http\Controllers\Admin;

use App\Models\Debtor;
use App\Models\Job;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DebtorController extends Controller
{
    private $route = 'debtors';
    private $page = ['plural' => 'propostas de empréstimos', 'singular' => 'proposta de empréstimo'];
    private $totalPerPage = 10;
    private $model, $modelUser, $modelJob;
    private $colunmSearch = ['Devedor', 'Mão-de-obra', 'value'];
    private $colunms = [
        'userName' => ['value' => 'Nome', 'aling' => 'left'],
        'descriptionJob' => ['value' => 'Mão-de-obra', 'aling' => 'left'],
        'value' => ['value' => 'Vlor do empréstimo', 'aling' => 'right'],
        'actions' => ['value' => 'Ações', 'aling' => 'center'],
    ];

    public function __construct(Debtor $model, User $modelUser, Job $modelJob)
    {
        $this->model = $model;
        $this->modelUser = $modelUser;
        $this->modelJob = $modelJob;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colunmsTitle = $this->colunms;
        $list = $this->model->getDevtorsJoin($this->totalPerPage);
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
        $jobs = $this->modelJob->orderBy('description')->get();
        return view('admin.'.$routeName.'.create', compact('routeName', 'page', 'breadcrumb', 'users', 'jobs'));
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
        $register = $this->model->with(['user', 'job'])->find($id);
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

        $routeName = $this->route;
        $page = $this->page;

        $breadcrumb = [
            (object) ['url' => route('admin.home'), 'title' => 'Home',],
            (object) ['url' => route('admin.'.$routeName.'.index'), 'title' => 'Lista de '.$page['plural']],
            (object) ['url' => '', 'title' => "Editar ". $page['singular']],
        ];
        $users = $this->modelUser->orderBy('name')->get();
        $jobs = $this->modelJob->orderBy('description')->get();
        return view('admin.'.$routeName.'.edit', compact('register','routeName', 'page', 'breadcrumb', 'users', 'jobs'));
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
