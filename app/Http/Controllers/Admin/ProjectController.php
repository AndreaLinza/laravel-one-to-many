<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Contracts\Service\Attribute\Required;

class ProjectController extends Controller
{

    // ------------- Index Section ------------- //

    public function index()
    {
        $projects = Project::all();

        foreach($projects as $key => $project){
            $projects[$key]['short_description'] = $this->truncate($project['description'],150);
        }

        //compact lo vado ad utilizzare per poter abbreviare la forma di ['projects'=> $projects]
        return view('admin.projects.index', compact('projects'));
    }


    // ----------- Show Section ------------ //

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->first();
        return view('admin.projects.show', compact('project'));
    }


    // ------------ Create Section ----------- //

    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }


    // ------------ Store Section ---------- //

    public function store(StoreProjectRequest $request)
    {

        $data = $request->validated();

        

        //$data['language'] = explode(',', $data['language']);


        $counter = 0;

        do{
            $slug = Str::slug($data['title']) . ($counter > 0 ? '-' . $counter : '');
    
            $alreadyExists = Project::where('slug', $slug)->first();

            $counter++;

        }while($alreadyExists);

        $data['slug'] = $slug;

        $data['thumb'] = Storage::put('projects', $data['thumb']);


        $project = Project::create($data);
                                                //Il ::create($data) lo vado ad utilizzare al posto di 
                                                //$project = new Project();
                                                //$project->fill($data);
                                                //$project->save()
                                                // In pratica va a fare un fill() e save() automatico

        if(key_exists('technologies',$data)){
            $project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $project->slug);
    }


    // -----------Edit Section----------- //

    public function edit($slug){
        $project = Project::where('slug', $slug)->firstOrFail();
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project','types','technologies'));
    }


    // ----------Update Section-------- //

    public function update(UpdateProjectRequest $request, $slug){
        $project = Project::where('slug', $slug)->firstOrFail();


        $data = $request->validated();

        //$data['language'] = explode(',', $data['language']);

        //Non è detto che vada a cambiare l'immagine ogni volta che faccio l'update
        //perciò si fa un if per evitare di usare lo Storage::put

        if (isset($data['thumb'])){


            //se esiste già un immagine, prima la cancello
            if($project->thumb){
                Storage::delete($project->thumb);
            }

            // salvo il file nel filesystem
            $image_path = Storage::put('projects', $data['thumb']);
            
            $data['thumb'] = $image_path;

        }
        // il sync($data['nome'])
        // esegue il detach SOLO delle technology non presenti nel nuovo array
        // esegue l'attach SOLO delle technology non presenti nel vecchio array
        $project->technologies()->sync($data["technologies"]);


        $project->update($data);

        return redirect()->route('admin.projects.show', $project->slug);
    }

    // -------------Destroy Section---------- //

    public function destroy($slug){
        if(Auth::user()->email !== 'andrealinza@gmail.com'){
            return abort(403);
        }

        $project = Project::where('slug', $slug)->firstOrFail();

        if($project->thumb){
            Storage::delete($project->thumb);
        }

        $project->technologies()->detach();

        $project->delete();
        

        return redirect()->route('admin.projects.index');
    }


    // -------------Truncate Section -------------- //

    private function truncate($text, $chars = 25) {
        if (strlen($text) <= $chars) {
            return $text;
        }
        $text = $text . " ";
        $text = substr($text, 0, $chars);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . "...";
        return $text;
    }

}
