@extends('layouts.registered')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Elementi</h1>
        </div>

        <h2>Appartamenti</h2>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="text-end mb-3">
            <a class="btn btn-primary text-white" href="{{ route('registered.apartments.create') }}"
                role="button">Inserisci un
                Appartemento</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Immagine</th>
                        <th scope="col">Visibilità</th>
                        <th scope="col">Creato il</th>
                        <th scope="col">Aggiornato il</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apartments as $apartment)
                        <tr>
                            <td>{{ $apartment->id }}</td>
                            <td>{{ $apartment->address }}</td>
                            <td>
                                <img height="50" src="{{ asset('storage/' . $apartment->image) }}"
                                    alt="{{ $apartment->title }}">
                            </td>
                            <td>
                                @if ($apartment->visibility === 1)
                                    <div class="visibility ">
                                        <i class="fa-solid fa-eye"></i>
                                    </div>
                                @else
                                    <div class="novisibility ">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $apartment->created_at }}</td>
                            <td>{{ $apartment->updated_at }}</td>
                            <td>
                                <a href="{{ route('guest.apartments.show', $apartment->slug) }}"
                                    class="btn btn-primary"><i class="fas fa-eye text-white"></i></a>
                                <a href="{{ route('registered.apartments.edit', $apartment->id) }}"
                                    class="btn btn-secondary"><i class="fas fa-pencil-alt"></i></a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $apartment->id }}">
                                    <i class="fas fa-trash text-white"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="delete{{ $apartment->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modal_{{ $apartment->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminare definitivamente l'appartamento numero
                                                    <strong>{{ $apartment->id }}</strong>?
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Stai per eliminare definitivamente l'appartamento in
                                                <strong>{{ $apartment->address }}</strong>! Sei sicuro di voler
                                                continuare?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Annulla</button>
                                                <form
                                                    action="{{ route('registered.apartments.destroy', $apartment->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $apartments->links() }}
        </div>
    </div>
@endsection
