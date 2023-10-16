<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectUpsertRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::all();
        return view('admin.projects.index', ['projects' => $projects]);
    }

    public function show($slug) {
        $project = Project::where("slug", $slug)->firstOrFail();
        return view('admin.projects.show', ['project' => $project]);
    }

    public function create() {
        $types = Type::all();
        return view('admin.projects.create', ["types" => $types]); //secondo argomento types
    }

    public function store(ProjectUpsertRequest $request) {
        $data = $request->validated();

        $data["slug"] = $this->generateSlug($data["title"]); //invoco funzione della creazione slug

        $data['image'] = Storage::put("projects", $data["image"]);

        
        $project = Project::create($data); //fill e save
        return redirect()->route('admin.projects.show', $project->slug);
    }

    public function edit($slug) {
        $project = Project::where("slug", $slug)->firstOrFail();
        $types = Type::all();

        return view('admin.projects.edit', compact("project", "types"));
    }

    public function update(ProjectUpsertRequest $request, $slug) {//va passato l'id come secondo argomento
        $project = Project::where("slug", $slug)->firstOrFail();
        $data = $request->validated();

        //funzione aggiorno slug
        if ($data["title"] !== $project->title) { //se il titolo è diverso dal precedente
            $data["slug"] = $this->generateSlug($data["title"]); //crea nuovo slug
        }

        if (isset($data["image"])) {
            if ($project->image) {
                Storage::delete($project->image); //cancello dallo storage l'immagine che c'era prima della modifica
            }
            //salvo file nel sistema
            $image_percorso = Storage::put("projects", $data["image"]);
            $data['image'] = $image_percorso;
        }
    

        $project -> update($data);// fill + save

        return redirect()->route('admin.projects.show',$project->slug); //mando il mio utende alla pagina dello show del comic
    }

    public function destroy($slug) {
        $project = Project::where("slug", $slug)->firstOrFail();

        if ($project->image) {
            Storage::delete($project->image); //cancello dallo storage l'immagine
        }
        $project->delete();
        
        return redirect()->route('admin.projects.index');
    }

    //funzione per generare lo slug
    protected function generateSlug($title) {
        $contatore = 0;
        do {
            $slug = Str::slug($title) . ($contatore > 0 ? "-" . $contatore : ""); //creo slug e se contatore >0 allora concateno 
            $esiste = Project::where("slug", $slug)->first(); //creo se esiste
            $contatore++; 
        } while ($esiste);
        return $slug;
    }
}
