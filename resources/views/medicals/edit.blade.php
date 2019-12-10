@extends('layouts.panel')

@section('content')

<div class="card shadow">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0">Medicina</h3>
        <h3>Paciente: {{ $medical->patient }}</h3>
      </div>
      <div class="col text-right">
        <a href="{{ url('medicals') }}" class="btn btn-sm btn-default">
          Cancelar y volver
        </a>
      </div>
    </div>
  </div>
  <div class="card-body">

    @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

                
  <form action="{{ url('medicals/'.$medical->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
      <div class="form-group col-sm-12 col-lg-4">
        <label for="start_weight">Peso Inicial</label>
        <input type="text" name="start_weight" class="form-control" value="{{ old('start_weight', $medical->start_weight) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-4">
        <label for="start_pa">PA Inicial</label>
        <input type="text" name="start_pa" class="form-control" value="{{ old('start_pa', $medical->start_pa) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-4">
        <label for="fc">Frecuencia Cardiaca</label>
        <input type="text" name="fc" class="form-control" value="{{ old('fc', $medical->fc) }}">
      </div>
    </div>

    <div class="row">

      @if ($medical->clinical_trouble == null)
      
        <div class="form-group col-sm-12 col-lg-4">
          <label for="clinical_trouble">Problemas Clínicos</label>
          <textarea class="form-control" id="" name="clinical_trouble" rows="2">{{ old('clinical_trouble', 'ERC-5 HD' ,$medical->clinical_trouble) }}</textarea>
        </div>
      @else
        <div class="form-group col-sm-12 col-lg-4">
          <label for="clinical_trouble">Problemas Clínicos</label>
          <textarea class="form-control" id="" name="clinical_trouble" rows="2">{{$medical->clinical_trouble) }}</textarea>
        </div>
      @endif

      <div class="form-group col-sm-12 col-lg-4">
        <label for="evaluation">Evaluación</label>
        <textarea class="form-control" id="" name="evaluation" rows="2">{{ old('evaluation' ,$medical->evaluation) }}</textarea>
      </div>

      <div class="form-group col-sm-12 col-lg-4">
        <label for="indications">Indicaciones</label>
        <textarea class="form-control" id="" name="indications" rows="2">{{ old('indications', $medical->indications) }}</textarea>
      </div>

    </div>      

    <div class="row">
      <div class="form-group col-sm-12 col-lg-1">
        <label for="hour_hd">HORA HD</label>
        <input type="text" name="hour_hd" class="form-control" value="{{ old('hour_hd', $medical->hour_hd) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-1">
        <label for="heparin">Heparina</label>
        <input type="text" name="heparin" class="form-control" value="{{ old('heparin', $medical->heparin) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-2">
        <label for="dry_weight">Peso Seco</label>
        <input type="text" name="dry_weight" class="form-control" value="{{ old('dry_weight', $medical->dry_weight) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-2">
        <label for="uf">UF</label>
        <input type="text" name="uf" class="form-control" value="{{ old('uf', $medical->uf) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-2">
        <label for="qb">QB</label>
        <input type="text" name="qb" class="form-control" value="{{ old('qb', $medical->qb) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-2">
        <label for="qd">QD</label>
        <input type="text" name="qd" class="form-control" value="{{ old('qd', $medical->qd) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-2">
        <label for="bathroom">BAÑO</label>
        <input type="text" name="bathroom" class="form-control" value="{{ old('bathroom', $medical->bathroom) }}">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm-12 col-lg-1">
        <label for="temperature">T°</label>
        <input type="text" name="temperature" class="form-control" value="{{ old('temperature', $medical->temperature) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-1">
        <label for="cnd">CND</label>
        <input type="text" name="cnd" class="form-control" value="{{ old('cnd', $medical->cnd) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-2">
        <label for="start_na">NA INICIAL</label>
        <input type="text" name="start_na" class="form-control" value="{{ old('start_na', $medical->start_na) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-2">
        <label for="end_na">NA FINAL</label>
        <input type="text" name="end_na" class="form-control" value="{{ old('end_na', $medical->end_na) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-2">
        <label for="area_filter">ÁREA/FILTRO</label>
        <input type="text" name="area_filter" class="form-control" value="{{ old('area_filter', $medical->area_filter) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-2">
        <label for="membrane">MEMBRANA</label>
        <input type="text" name="membrane" class="form-control" value="{{ old('membrane', $medical->membrane) }}">
      </div>

      <div class="form-group col-sm-12 col-lg-2">
        <label for="serological">Cond. Serologica</label>
        <select class="form-control" name="serological" data-toggle="select" title="Simple select" data-placeholder="Select a state">
          <option value="{{ $medical->serological }}" disabled="">{{ $medical->serological }}</option>
          <option value="NEGATIVO">NEGATIVO</option>
          <option value="POSITIVO">POSITIVO</option>
        </select>
      </div>
    </div>


    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>



  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
@endsection