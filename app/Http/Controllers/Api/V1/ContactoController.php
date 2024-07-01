<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\Models\Contacto;
use App\Models\Telefono;
use App\Models\Email;
use App\Models\Direccion;

class ContactoController extends Controller
{

    public function index(Request $request)
    {
        $pageNumber = $request->page; 
        $pageSize = $request->per_page;
        $search = $request->search;

        $contactos = Contacto::with( 'telefonos', 'emails', 'direcciones' )
            ->when( ! in_array( $search, [ null, '' ] ), function( $q ) use( $search ) {
                $q->orWhereHas( 'telefonos', function($query) use( $search ) {
                    $query->where( 'telefono', 'like', '%' . $search . '%' );
                });
                $q->orWhereHas( 'emails', function($query) use( $search ) {
                    $query->where( 'email', 'like', '%' . $search . '%' );
                });
                $q->orWhereHas( 'direcciones', function($query) use( $search ) {
                    $query->where( 'direccion', 'like', '%' . $search . '%' );
                });
                $q->orWhere( 'name', 'like', '%' . $search . '%' );
            })
            ->orderBy( 'id', 'DESC' )
            ->paginate( $pageSize );

        return response()->json( $contactos );
    }

    public function search($id){
        $contacto = Contacto::with( 'telefonos', 'emails', 'direcciones' )
        ->where('id', $id)
        ->first();
        return response()->json($contacto);
    }

    public function store(Request $request){

        $datos = (object)$request;

        $contacto = Contacto::create(
            [
                'name' => $datos->name
            ]
        );

        if($contacto){
            foreach($datos->telefonos as $tel){
                $telefonos = Telefono::create( 
                    [
                        'contacto_id' => $contacto->id,
                        'telefono' => $tel
                    ]
                );
            }

            foreach($datos->direcciones as $direccion){
                $direcciones = Direccion::create( 
                    [
                        'contacto_id' => $contacto->id,
                        'direccion' => $direccion
                    ]
                );
            }

            foreach($datos->emails as $email){
                $emails = Email::create( 
                    [
                        'contacto_id' => $contacto->id,
                        'email' => $email
                    ]
                );
            }

            return response()->json(true, 200);
        }
    }

    public function update($id, Request $request): Contacto {
        $contacto = Contacto::findOrFail($id);
        $contacto->name = $request->name;
        $contacto->update();

        $array_tels = $request->telefonos;
        $telefonos = collect($contacto->telefonos);
        $tels_exists = $this->findExistsItems($contacto, Telefono::class, $array_tels, $telefonos, 'telefono', 'telefonos');

        $array_emails = $request->emails;
        $emails = collect($contacto->emails);
        $emails_exists = $this->findExistsItems($contacto, Email::class, $array_emails, $emails, 'email', 'emails');

        $array_direcciones = $request->direcciones;
        $direcciones = collect($contacto->direcciones);
        $direcciones_exists = $this->findExistsItems($contacto, Direccion::class, $array_direcciones, $direcciones, 'direccion', 'direcciones');

        $contacto->telefonos()->whereNotIn('telefono', $tels_exists)->delete();
        $contacto->emails()->whereNotIn('email', $emails_exists)->delete();
        $contacto->direcciones()->whereNotIn('direccion', $direcciones_exists)->delete();

        return $contacto;
    }

    public function findExistsItems( 
        Contacto $contacto, 
        $model,
        Array $array_form, 
        Object $db_items, 
        string $field, 
        string $relation 
    ): array {

        $arr = [];

        for ($i=0; $i < count($array_form); $i++) {
            if(! $db_items->where( $field, $array_form[$i] )->first()) {
                $item = new $model([ $field => $array_form[$i] ]);
                $contacto->$relation()->save( $item );
                array_push( $arr, $array_form[$i] );
            }
            else {
                array_push( $arr, $array_form[$i] );
            }
        }

        return $arr;
    }

    public function destroy($id){

        $telefonos = Telefono::where('contacto_id', $id)
        ->delete();

        $emails = Email::where('contacto_id', $id)
        ->delete();

        $direcciones = Direccion::where('contacto_id', $id)
        ->delete();

        $contacto = Contacto::where('id', $id)
        ->delete();

        return response()->json(true, 200);
    }

    




}
