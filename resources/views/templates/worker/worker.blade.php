@extends('templates.template')

@section('content')
 
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@isset($title) {{$title}} @endisset</h1>

        <a class="btn btn-success btn-sm" href="{{route('new.worker')}}" >Cadastrar </a>
        <a class="btn btn-primary btn-sm" href="{{route('workerHome')}}" >Tabela </a>
        
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <h2>@isset($subtitle) {{$subtitle}} @endisset</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
        @csrf
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>B.I</th>
              <th>Categoria</th>
              <th>Origem</th>
              <th>Contact</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
          @isset($datalist)
          @if($datalist->count()===0)
              Nenhum dado encontrado!
          @else
          @foreach($datalist as $worker)
            
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$worker->relPeople->firstname}} {{$worker->relPeople->lastname}}</td>
              <td>{{$worker->relPeople->relIdentity->identity}}</td>
              <td>{{$worker->category}}</td>
              <td>{{$worker->relPeople->relCity->city}}
                  ({{$worker->relPeople->relCity->relProvince->province}}
                  / {{$worker->relPeople->relCity->relProvince->relCountry->country}}
                  )
              </td>
              <td>
              @foreach($worker->relContacts as $contacts)
                {{$contacts->telephone}} <br/>
               @endforeach
              </td>
              <td>
                <a href="worker/{{$worker->id_worker}}">
                  <button class="btn btn-dark btn-sm" >Visualizar</button> </a>
                <a href="worker/{{$worker->id_worker}}/edit">
                  <button class="btn btn-primary btn-sm" >Editar</button> </a>
                <a id="{{$worker->id_worker}}">
                  <button class="btn btn-danger btn-sm" >Apagar</button> </a>
              </td>
            </tr>
            
          @endforeach
          @endif
          @endisset
          </tbody>
        </table>
      </div>

@endsection