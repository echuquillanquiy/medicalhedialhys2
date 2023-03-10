<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Medical;
use App\Order;
use App\Room;
use App\Shift;

use App\Http\Controllers\Controller;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order = Order::all();
        $rooms = Room::all();
        $shifts = Shift::all();

        $patient = $request->get('patient');
        $room = $request->get('room');
        $shift = $request->get('shift');
        $created_at = $request->get('created_at');

        $medicals = Medical::orderBy('created_at', 'desc')
            ->patient($patient)
            ->room($room)
            ->shift($shift)
            ->created_at($created_at)
            ->paginate(15);
        return view('medicals.index', compact('medicals', 'order', 'rooms', 'shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        return view('medicals.create');
    }*/

    public function performValidation (Request $request) {

        $rules = [
            'start_weight' => 'required|min:2',
            'start_pa' => 'required|min:2',
            'fc' => 'required|min:2',
            'clinical_trouble' => 'min:5',
            'hour_hd' => 'required|min:2',
            'heparin' => 'required|min:2',
            'dry_weight' => 'required|min:2',
            'uf' => 'required|min:4',
            'qb' => 'required|min:2',
            'qd' => 'required|min:2',
            //'bathroom' => 'required|min:2',
            //'temperature' => 'required|min:2',
            'cnd' => 'required|min:1',
            'start_na' => 'required|min:2',
            'end_na' => 'required|min:2',
            'area_filter' => 'required|min:2',
            'membrane' => 'required|min:2',
            //'serological' => 'required|min:2',
            'profile_uf' => 'required|min:2',
            //'dializer' => 'required|min:5',
            'bicarbonat' => 'required|min:2',
            //'na_in_solution' => 'required|min:2'
            'user_id' => 'required'

        ];

        $messages = [
            'start_weight.min' => 'El peso debe tener 2 car??cteres.',
            'start_weight.required' => 'Es necesario ingresar el peso.',
            'start_pa.required' => 'Es necesario la presi??n inicial',
            'start_pa.min' => 'La Presi??n arterial debe tener 2 m??nimo car??cteres.',
            'fc.required' => 'Es necesaria la frecuencia cardiaca',
            'fc.min' => 'La frecuencia cardiaca debe tener 2 m??nimo car??cteres.',
            'hour_hd.required' => 'Las horas de HD son requeridas',
            'hour_hd.min' => 'Las horas de HD deben tener m??nimo 2 car??cteres.',
            'heparin.required' => 'La dosis de Heparina es requerida',
            'heparin.min' => 'La dosis de Heparina debe tener m??nimo 2 car??cteres.',

            'dry_weight.min' => 'el Peso seco debe tener minimo 2 car??cteres.',
            'dry_weight.required' => 'el Peso seco es requerido.',

            'uf.min' => 'el Utra Filtrado debe tener minimo 4 car??cteres.',
            'qb.min' => 'EL QB debe tener minimo 2 car??cteres.',
            'qd.min' => 'El QD debe tener minimo 2 car??cteres.',
            'bathroom.min' => 'El Ba??o debe tener minimo 2 car??cteres.',
            'temperature.min' => 'La Temperatura debe tener minimo 2 car??cteres.',
            'cnd.min' => 'El CND debe tener minimo 1 caracter.',
            'start_na.min' => 'La NA Inicial debe tener minimo 2 car??cteres.',
            'end_na.min' => 'La NA Final debe tener minimo 2 car??cteres.',
            'area_filter.min' => 'El ??rea / Filtro debe tener minimo 2 car??cteres.',
            'membrane.min' => 'La membrana debe tener minimo 2 car??cteres.',
            'serological.min' => 'La condici??n Serologica debe tener minimo 8 car??cteres.',

            'uf.required' => 'el Utra Filtrado es requerido.',
            'qb.required' => 'EL QB es requerido.',
            'qd.required' => 'El QD es requerido.',
            'bathroom.required' => 'El Ba??o es requerido.',
            'temperature.required' => 'La Temperatura es requerido.',
            'cnd.required' => 'El CND es requerido.',
            'start_na.required' => 'La NA Inicial es requerido.',
            'end_na.required' => 'La NA Final es requerido.',
            'area_filter.required' => 'El ??rea / Filtro es requerido.',
            'membrane.required' => 'La membrana es requerida.',
            'serological.required' => 'La condici??n Serologica es requerida.',

            'profile_uf.required' => 'El perfil UF es requerido.',
            'dializer.required' => 'El campo dializador es requerido.',
            'bicarbonat.required' => 'El bicarbonato es requerido.',
            'na_in_solution.required' => 'El calcio en soluci??n es requerido.',

            'profile_uf.min' => 'El campo Perfil UF debe tener m??nimo 2 car??cteres',
            'dializer.min' => 'El campo dializador debe tener m??nimo 5 car??cteres',
            'bircarbonat.min' => 'El campo Bicarbonatodebe tener m??nimo 2 car??cteres',
            'na_in_solution.min' => 'El campo Calcio en soluci??n debe tener m??nimo 2 car??cteres',
            'user_id.required' => 'El usuario es requerido.'

        ];

        $this->validate($request, $rules, $messages);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        //$this->performValidation($request);
        $existsMedicalsToday = Medical::where('patient', $request->input('patient'))
            ->whereDate('created_at', date('Y-m-d'))->exists();

        // $from = '2019-08-01';
        // $to = $request->input();
        // ->whereBetween('created_at', [$from, $to])

        if ($existsMedicalsToday) {
            $notification = 'Este paciente ya tiene un parte medico registrada hoy. Intente nuevamente ma??ana.';
            return redirect('/medicals/')->with(compact('notification'));
        }

        Medical::create($request->all());

        $notification = 'El Parte m??dico se ha registrado correctamente.';
        return redirect('/medicals')->with(compact('notification'));
    }*/

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
        $medical = Medical::findOrFail($id);
        return view('medicals.edit', compact('medical'));
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
        $this->performValidation($request);
        $medical = Medical::findOrFail($id);

        $data = $request->all();

        $medical->fill($data);
        $medical->save();

        $notification = 'El Parte M??dico se ha actualizado correctamente.';
        return back()->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Medical $medical)
    {
        $medicalId = $medical->id;
        $medical->delete();

        $notification = "El parte medico N?? $medicalId se ha eliminado correctamente.";
        return redirect('/medicals')->with(compact('notification'));
    }*/
}
