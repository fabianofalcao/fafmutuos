<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    private $route = 'jobs';
    private $page = ['plural' => 'mãos-de-obra', 'singular' => 'mão-de-obra'];
    private $totalPerPage = 10;
    private $model;
    private $colunmSearch = ['description'];
    private $colunms = [
        'description' => ['value' => 'Descrição', 'aling' => 'left'],
        'actions' => ['value' => 'Ações', 'aling' => 'center'],
    ];

    public function __construct(Job $model)
    {
        $this->model = $model;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colunmsTitle = $this->colunms;
        $list = $this->model->paginate($this->totalPerPage);
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
            (object) ['url' => route('admin.jobs.index'), 'title' => 'Lista de '.$page['plural']],
            (object) ['url' => '', 'title' => "Adicionar ". $page['singular']],
        ];
        return view('admin.'.$routeName.'.create', compact('routeName', 'page', 'breadcrumb'));
    }

    public function show($id)
    {
    //
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
        $insert = $this->model->create($dataForm);
        if($insert){
            return redirect()->route('admin.jobs.index')->with(['color' => 'success', 'message' => 'Cadastro realizado com sucesso!']);
        } else {
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Falha ao realizar cadasto!']);
        }
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
            (object) ['url' => route('admin.jobs.index'), 'title' => 'Lista de '.$page['plural']],
            (object) ['url' => '', 'title' => "Editar ". $page['singular']],
        ];
        return view('admin.'.$routeName.'.edit', compact('register','routeName', 'page', 'breadcrumb'));
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

        if($register->update($request->all()))
            return redirect()->route('admin.jobs.index')->with(['color' => 'success', 'message' => 'Cadastro editado com sucesso!']);
        else
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Falha ao editar cadastro!'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $register = $this->model->find($id);

        if(!$register)
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Falha ao excluir registro! Registro inexistente.'])->withInput();

        if($register->delete()){
            return redirect()->route('admin.'.$this->route.'.index')->with(['color' => 'success', 'message' => 'Registro excluído com sucesso!']);
        }else{
            return redirect()->back()->with(['color' => 'danger', 'message' => 'Falha ao excluir registro.'])->withInput();
        }
    }


    public function search(Request $request)
    {
        dd($request->all());
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
