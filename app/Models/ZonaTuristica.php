<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZonaTuristica extends Model
{
    protected $table = 'zona_turistica';
    protected $fillable = [
        'zona_turistica',
        'zona_turistica_pai_id',
        'ativo'
    ];

    public $timestamps = false;

    public function zonaTuristicaPai(){
        return $this->belongsTo(ZonaTuristica::class);
    }

    public function getZT($request = []){
        $conditions = [];

        if(isset($request['zona_turistica']) && !empty($request['zona_turistica'])){
            $conditions[] = ['zona_turistica', 'LIKE', "%".$request['zona_turistica']."%"];
        }  

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }  

        return $this
            ->where($conditions)
            ->with('zonaTuristicaPai')
            ->paginate(7);
    }

    public function setZT($request = []){
        try{
            $this->fill([
                'zona_turistica' => $request['name'],
                'ativo' => $request['ativo'],
                'zona_turistica_pai_id' => $request['zona_turistica_pai']
            ])->save();

            return [
                'error' => false,
                'msg' => 'Registro inserido com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Ocorreu um erro ao salvar o registro',
                'code' => $error->getCode()
            ];
        }
    }

    public function updateZT($id, $request = []){
        try{
            $zt = $this->find($id);
            $zt->fill([
                'zona_turistica' => $request['name'],
                'ativo' => $request['ativo'],
                'zona_turistica_pai_id' => $request['zona_turistica_pai']
            ])->save();
                
            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível atualizar o registro'
            ];
        }
    }

    public function deleteZT($id){
        if($this->find($id)->delete()){
            return [ 
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }else{
            return [ 
                'error' => true,
                'msg' => 'Não foi possível excluir o registro'
            ];  
        }
    }

    public function deleteRowsZT($request = []){
        if($this->whereIn('id', $request['ids'])->delete()){
            return [
                'error' => false,
                'msg' => count($request['ids']). " registros excluído(s)"
            ];
        }else{
            return [
                'error' => true,
                'msg' => "Não foi possível excluir os registros"
            ];
        }
    }


    public function getZTById($id){
        return $this->find($id);
    }

    public function getListZT(){
        return $this->pluck('zona_turistica', 'id')->toArray();
    }

}
