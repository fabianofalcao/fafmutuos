<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $route = 'users';
    private $page = ['plural' => 'usuários', 'singular' => 'usuário'];
    private $totalPerPage = 10;
    private $model;
    private $colunmSearch = ['name', 'email', 'is_active',];
    private $colunms = [
        'name' => ['value' => 'Nome', 'aling' => 'left'],
        'is_active' => ['value' => 'Status', 'aling' => 'left'],
        'email' => ['value' => 'E-mail', 'aling' => 'left'],
        'actions' => ['value' => 'Ações', 'aling' => 'center'],
    ];

    public function __construct(User $model)
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
        return view('admin.users.index', compact('colunmsTitle', 'list', 'routeName', 'page', 'btnCaption', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
