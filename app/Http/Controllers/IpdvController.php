<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\CentroCusto;
use App\Departamento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IpdvController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $centros = CentroCusto::all();
        return view('home', ["centros" => $centros]);
    }

    /********************************                VIEWS                 ********************************************/

    public function getCentroCustoView($id = null){
        $centroCusto = null;
        if($id != null){
            $centroCusto = CentroCusto::find($id);
        }

        $listaCentros = CentroCusto::all();

        return view('postCentro', ["centro" => $centroCusto, "listaCentros" => $listaCentros]);
    }

    public function getDepartamentoView($id = null){
        $dep = null;
        if($id != null){
            $dep = Departamento::find($id);
        }

        $listaDeps = Departamento::with('centroCusto')->get();
        $centros = CentroCusto::all();

        return view('postDepartamento', ["departamento" => $dep, "listaDepartamentos" => $listaDeps, "centros" => $centros]);
    }

    public function getCargoView($id = null){
        $cargo = null;
        if($id != null){
            $cargo = Cargo::find($id);
        }

        $listaCargos = Cargo::with('departamento')->get();
        $departamentos = Departamento::all();

        return view('postCargo', ["cargo" => $cargo, "listaCargos" => $listaCargos, "departamentos" => $departamentos]);
    }

    public function getUserView($id = null){
        $user = null;
        if($id != null){
            $user = User::find($id);
        }

        $listaUsers = User::with('cargo')->where('id', '!=', 1)->get();
        $cargos = Cargo::all();

        return view('postUser', ["user" => $user, "listaUsers" => $listaUsers, "cargos" => $cargos]);
    }



    /*****************************               CREATE/UPDATE              *******************************************/
    /**
     * Function to padronize the response of all create calls
     * @param $code
     * @param $body
     * @return false|string
     */
    private function padraoResp($elemento){
        $code = 200;
        $body = "";
        try{
            $elemento->save();
            $body = $elemento;
        }catch (\Exception $e){
            $code = 500;
            $body = $e->getMessage();
        }
        return json_encode(["code" => $code, "body" => $body]);
    }

    /**
     * Function to save a new centro de custos
     * @param Request $request
     * @return false|string
     */
    public function postCentroCusto(Request $request){
        if($request->idCentro == null){
            $centroCusto = new CentroCusto();
        }else{
            $centroCusto = CentroCusto::find($request->idCentro);
        }
        $centroCusto->nome = $request->nome;
        return $this->padraoResp($centroCusto);
    }

    /**
     * Function to save a new departamento
     * @param Request $request
     * @return false|string
     */
    public function postDepartamento(Request $request){
        if($request->idDepart == null){
            $depart = new Departamento();
        }else{
            $depart = Departamento::find($request->idDepart);
        }
        $depart->nome = $request->nome;
        $depart->idCentro = $request->centro;
        return $this->padraoResp($depart);
    }

    /**
     * Function to save a new cargo
     * @param Request $request
     * @return false|string
     */
    public function postCargo(Request $request){
        if($request->idCargo == null){
            $cargo = new Cargo();
        }else{
            $cargo = Cargo::find($request->idCargo);
        }
        $cargo->nome = $request->nome;
        $cargo->idDepartamento = $request->departamento;
        return $this->padraoResp($cargo);
    }

    /**
     * Function to save a new usuario
     * @param Request $request
     * @return false|string
     */
    public function postUser(Request $request){
        if($request->idUser == null){
            $user = new User();
        }else{
            $user = User::find($request->idUser);
        }
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password = "N/A";
        $user->idCargo = $request->cargo;
        return $this->padraoResp($user);
    }


    /*****************************                      READ                    ***************************************/

    /**
     * Function to padronize the response of all get calls
     * @param $code
     * @param $elemento
     * @return false|string
     */
    private function padraoRespGet($code, $elemento){
        return json_encode(["code" => $code, "body" => $elemento]);
    }

    /**
     * Function to get a deparatamento
     * @param null $id
     * @return false|string
     */
    public function getDepartamento(Request $request){
        //FILTERS
        $centro = $request->centro;

        //QUERY
        $dep = Departamento::with('centroCusto');

        if($centro != 0){
            $dep->where('idCentro', $centro);
        }
        $dep = $dep->get();

        return $this->padraoRespGet(200, $dep);
    }


    /**
     * Function to get a user
     * @param null $id
     * @return false|string
     */
    public function getUser(Request $request){
        //FILTERS
        $centro = $request->centro;
        $departamento = $request->departamento;

        //QUERY
        $user = User::with('cargo');
        if($centro != 0){
            $user->whereHas('cargo.departamento.centroCusto', function ($query) use ($centro){
                $query->where('id', $centro);
            });
        }
        if($departamento != 0){
            $user->whereHas('cargo.departamento', function ($query) use ($departamento){
                $query->where('id', $departamento);
            });
        }
        $user = $user->where('id', '!=', 1)->orderBy('id')->get();

        return $this->padraoRespGet(200, $user);
    }

    /*****************************                    DELETE                     **************************************/

    /**
     * Function to delete data from DB
     * @param $tipo
     * @param $id
     * @return false|string
     */
    public function padraoRespDel($tipo, $id){
        //PEGANDO O DADO PARA SER DELETADO
        switch ($tipo){
            case 0: //CENTRO DE CUSTO
                $dado = CentroCusto::find($id);
                break;
            case 1: //DEPARTAMENTO
                $dado = Departamento::find($id);
                break;
            case 2: //CARGO
                $dado = Cargo::find($id);
                break;
            case 3: //User
                $dado = User::find($id);
                break;
            default: $dado = null;
        }
        try{
            if($dado == null){
                $msg = "Dado não encontrado / Não existente.";
                $code = 404;
            }else{
                $dado->delete();
                $code = 200;
                $msg = "Deletado com sucesso";
            }
            return json_encode(["code" => $code, "body" => $msg]);
        }catch (\Exception $e){
            return json_encode(["code" => 500, "body" => $e->getMessage(), "error" => $e->getCode()]);
        }
    }



    /*****************************                    IMPORTADOR                 **************************************/
    public function importador(Request $request){
        //MODEL NOME,EMAIL,IDCARGO
        //VERIFY EXTENSION
        if($request->import->getClientOriginalExtension() != 'csv'){
            return json_encode(["code" => 500, "body" => "Extensão não permitida, apenas .csv pode ser enviado."]);
        }
        try{
            $file = fopen($request->file('import')->getRealPath(), 'r');
            $import = [];
            if($file){
                while($linha = fgetcsv($file, 1000)){
                    $import[] = ["name" => $linha[0], "email" => $linha[1], "idCargo" => $linha[2], 'password' => "N/A"];
                }
            }
            DB::table('users')->insert($import);
            $code = 200;
            $body = "Importado com sucesso.";
        }catch (\Exception $e){
            $code = 500;
            $body = $e->getMessage();
        }

        return json_encode(["code" => $code, "body" => $body]);
    }

}
