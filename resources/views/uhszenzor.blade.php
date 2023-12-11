@extends('layouts.master')
@section('title',"Főoldal")
@section('content')
<div>
    <h1>UH szenzor (távolság riasztó)</h1>

    <div class="table-responsive">
        <table class="table table-success table-striped table-hover">
            <tr>
                <th>Id</th>
                <th>Távolság</th>
                <th>Mérés ideje</th>
            </tr>
            @foreach ($tavolsagok as $tav)
                <tr>
                    <td>{{ $tav->uh_id }}</td>
                    <td>{{ $tav->tavolsag }}cm</td>
                    <td>{{ $tav->meres_ideje }}</td>
                </tr> 
            @endforeach
            
        </table>

        {{ $tavolsagok->links() }}
    </div> 
</div>
@endsection