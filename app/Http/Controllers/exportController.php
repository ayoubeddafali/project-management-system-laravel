<?php

namespace App\Http\Controllers;

use App\Historic;
use App\Project;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class exportController extends Controller
{
    public function import(Request $request){
//        $this->validate($request->input('project_template'),'required');
        $this->validate($request, [
            'project_template' => 'required'
        ]);
        Excel::load(Input::file('project_template'), function($reader) {
            $reader->each(function($sheet){
                $file = $sheet->toArray();
                $file['status']=1;
                $project = Project::firstOrCreate($file);
                Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project->id,'comment'=>'A importer le projet :']);

            });

            // reader methods

        });

        return redirect('/projects');
    }

    public function export(){
        $projects = DB::table('projects')->select('projects.libelle as Libelle', 'projects.libelle_long as Description', 'projects.entreprise as Entreprise', 'projects.direction as Direction', 'projects.debut as Debut', 'projects.chef as Responsable ', 'projects.fin as Fin ','statuses.name as status', 'projects.continent as Continent', 'projects.pays as Pays')
            ->join('statuses','statuses.id','=','projects.status')
            ->get();

        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>'','comment'=>'A exporter la liste des projets']);


//         $lastNumber = intval(count($projects));

        array_walk($projects,function (&$item , $key)
        {
            $item = (array) $item ;
        } );

        Excel::create('Projects_Details', function($excel) use($projects) {
            // Set the title
            $excel->setTitle('Projects');

            // Chain the setters
            $excel->setCreator('Admin')
                ->setCompany('ONEP');

            // Call them separately
            $excel->setDescription('The projects Look up !!');

            $excel->sheet('Excel sheet', function($sheet) use($projects) {
                $lastNumber = intval(count($projects)) + 1;


                $sheet->setSize(array(
                    'A1' => array('width'=> 30,'height'=> 23),
                    'B1' => array('width'=> 30,'height'=> 23 ),
                    'C1' => array('width'=> 30,'height'=> 23 ),
                    'D1' => array('width'=> 30,'height'=> 23 ),
                    'E1' => array('width'=> 30,'height'=> 23 ),
                    'F1' => array('width'=> 30,'height'=> 23 ),
                    'G1' => array('width'=> 30,'height'=> 23 ),
                    'H1' => array('width'=> 30,'height'=> 23 ),
                    'I1' => array('width'=> 30,'height'=> 23 ),
                    'J1' => array('width'=> 30,'height'=> 23 ))

                );
                $sheet->setOrientation('landscape');
                    // header cells style
                $sheet->cells('A1:J1', function($cells) {

                    $cells->setAlignment('center');
                    $cells->setBorder('none', 'solid', 'solid', 'solid');
                    $cells->setFont(array(
                        'family'     => 'Lucida',
                        'size'       => '13',
                        'bold'       =>  true
                    ));

                });
                    // rest of cells
                $sheet->cells("A2:J$lastNumber", function($cells) {

                    $cells->setAlignment('center');
                    $cells->setFont(array(
                        'family'     => 'monospace',
                        'size'       => '10',
                        'bold'       =>  false
                    ));

                });

//                $sheet->fromArray($projects);

                $sheet->fromArray($projects, null, 'A1', false, true);
            });


        })->export('xlsx');
        return redirect('/admin/dashboard');


    }

    public function exportAll($project_id){
        Excel::create('Projects_Details', function($excel) use($project_id)  {

        $description = DB::table('projects')->select('projects.libelle as Libelle', 'projects.libelle_long as Description', 'projects.entreprise as Entreprise', 'projects.direction as Direction', 'projects.debut as Debut', 'projects.chef as Responsable ', 'projects.fin as Fin ', 'projects.continent as Continent', 'projects.pays as Pays')->where('projects.id',$project_id)->get();

        $tasks = DB::table('tasks')->select('tasks.object as Task_Objet','tasks.description','tasks.start','tasks.due','tasks.status','tasks.priority','tasks.category','tasks.attached_milestone','tasks.risk')
            ->where('tasks.project_id',$project_id)
            ->get();

        $files = DB::table('files')->select('files.id as file ID','files.name as Filename','users.name as Uploader','projects.libelle as Project')
            ->join('users','users.id','=','files.uploader_id')
            ->join('projects','projects.id','=','files.project_id')
            ->where('files.project_id',$project_id)
            ->get();

        $risks =  DB::table('risks')->select('risks.libelle as Risk_libelle','risks.commentaire as Commentaire','risks.severite as Severite','risks.famille as Famille','risks.actif as Actif','risks.type_mesure as Type\ de\ mesure')
            ->where('risks.project_id',$project_id)
            ->get();

//         $lastNumber = intval(count($projects));

        array_walk($description,function (&$item , $key)
        {
            $item = (array) $item ;
        } );
         array_walk($tasks,function (&$item , $key)
        {
            $item = (array) $item ;
        } );
    array_walk($files,function (&$item , $key)
        {
            $item = (array) $item ;
        } );
            array_walk($risks,function (&$item , $key)
            {
                $item = (array) $item ;
            } );


            $datas = array(
                $description , $tasks , $files , $risks
            );

            $excel->sheet('Description sheet', function($sheet) use($datas) {
                $sheet->setSize(array(
                        'A1' => array('width'=> 30,'height'=> 23),
                        'B1' => array('width'=> 30,'height'=> 23 ),
                        'C1' => array('width'=> 30,'height'=> 23 ),
                        'D1' => array('width'=> 30,'height'=> 23 ),
                        'E1' => array('width'=> 30,'height'=> 23 ),
                        'F1' => array('width'=> 30,'height'=> 23 ),
                        'G1' => array('width'=> 30,'height'=> 23 ),
                        'H1' => array('width'=> 30,'height'=> 23 ),
                        'I1' => array('width'=> 30,'height'=> 23 ),
                        'J1' => array('width'=> 30,'height'=> 23 ))

                );
                $sheet->cells('A1:Z300', function($cells) {

                    $cells->setAlignment('center');
                    $cells->setBorder('none', 'solid', 'solid', 'solid');
                    $cells->setFont(array(
                        'family'     => 'monospace',
                        'size'       => '10',
//                        'bold'       =>  true
                    ));

                });
                $sheet->setOrientation('landscape');
                $total = 0;
                $max =0;
                for($i = 0 ; $i < count($datas) ; $i++){
                    $lastNumber = intval(count($datas[$i]));// 1 -- 5 --
                    $max = $max + $lastNumber + 1 ; // 2 -- 7
                    $total = $max - $lastNumber ;// 1 --   --

//                    $cols = intval(count($datas[$i][$i]));

                    $sheet->setAutoSize(array(
                        'B'
                    ));
                    // STYLE SHEET
                    $sheet->setSize(array(
                            'A'.$total => array('width'=> 30,'height'=> 23),
                            'B'.$total => array('width'=> 30,'height'=> 23 ),
                            'C'.$total => array('width'=> 30,'height'=> 23 ),
                            'D'.$total => array('width'=> 30,'height'=> 23 ),
                            'E'.$total => array('width'=> 30,'height'=> 23 ),
                            'F'.$total => array('width'=> 30,'height'=> 23 ),
                            'G'.$total => array('width'=> 30,'height'=> 23 ),
                            'H'.$total => array('width'=> 30,'height'=> 23 ),
                            'I'.$total => array('width'=> 30,'height'=> 23 ),
                            'J'.$total => array('width'=> 30,'height'=> 23 ),
                            'K'.$total => array('width'=> 30,'height'=> 23 ),
                            'L'.$total => array('width'=> 30,'height'=> 23 ),
                            'M'.$total => array('width'=> 30,'height'=> 23 ),
                            'N'.$total => array('width'=> 30,'height'=> 23 ),
                            'O'.$total => array('width'=> 30,'height'=> 23 ))

                    );
                    $sheet->cells("A$total:Z$total", function($cells) {

                        $cells->setAlignment('center');
//                        $cells->setBorder('none', 'none', 'none', 'none');
                        $cells->setFont(array(
                            'family'     => 'Lucida',
                            'size'       => '13',
                            'bold'       =>  true
                        ));

                    });



                    // END STYLE SHEEt
                  
                    $sheet->fromArray($datas[$i]);
                    }





//                $sheet->fromArray($data[1],null,'A5',false,true);
            });



        })->export('xlsx');
        return redirect('/projects/'.$project_id);
    }




}
