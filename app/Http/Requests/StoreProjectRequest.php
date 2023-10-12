<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //Qualora ci fossero più utenti si usa questo metodo per poter autorizzare la visione della pagina
        //Quindi se l'utente è autenticato
        $user = Auth::user();
        //se è andrealinza@gmail.com (anche se non si usa l'email per poter accedere in questo modo)
        if ($user->email === 'andrealinza@gmail.com') {
            // se ritorno true l'operazione viene permessa
            return true;
        }
        // se ritoro false l'operazione viene bloccata e ritorna un errore 403
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'thumb' => 'required|image|max:5120',
            'release' => 'required|date',
            'link' => 'required|string',
            'language' => 'nullable|string',
            //exists si assicura che l'id passato esista nella tabella
            'type_id' => 'required|exists:types,id',
            'technologies' => 'required|exists:technologies,id',
            //'project_id' => 'required|exists:projects,id'

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'E\' necessario specificare un titolo della repository',
            'title.max' => 'Mi sembra che il titolo sia un po\' troppo lungo',
            'description.required' => 'Di cosa parla questa repository?',
            'thumb.required' => 'E\' richiesta un\'immagine',
            'thumb.max' => 'L\'immagine sembra essere troppo lunga, inserire un\'immagine di max 5MB',
            'release'=> 'Selezionare la data di pubblicazione della repo',
            'link' => 'Inserire il link per la repo',
            //In questo caso per stampare il messaggio di errore si usa .exists
            'type_id.exists' => 'Selezionare una tipologia',
            'technologies' => 'Selezionare uno o più linguaggi utilizzati'

        ];
    }
}
