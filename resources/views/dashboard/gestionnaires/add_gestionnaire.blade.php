@extends('../baseapp')
@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            @if(session('validation_errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Validation Echoué</strong> 
                    <p>{{ session('validation_errors') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session('emptyhotelerror'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Empty Hotel</strong>
                    <p>{{ session('emptyhotelerror') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('notfounderror'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Hotel Non Trouvé</strong> 
                <p>{{ session('notfounderror') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('servererror'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erreur du serveur</strong>
                <p>{{ session('servererror') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block">
                    <img src="{{asset('img/undraw_add_user.svg')}}" alt="" srcset="" style="width:500px;height:500px;">
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Ajouter un Compte Gestionnaire dans HospitalityPro </h1>
                        </div>
                        <form class="user" method="POST" action="{{url('/registergestionnaire')}}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id=""
                                        placeholder="Nom" name="nom">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id=""
                                        placeholder="Account username" name="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="hotel" id="" class="form-control">
                                    @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel->id }}" name="hotel">{{ $hotel->designation }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" name="email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id=""
                                    placeholder="Contact" name="telephone">
                            </div>
                            <div class="form-group">
                                <select name="sexe" id="" class="form-control">
                                    <option value="M">Masculin</option>
                                    <option value="F">Feminin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id=""
                                    placeholder="Adresse" name="adresse">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" name="password">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Repeat Password" name="password_confirmation">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Ajouter le Compte
                            </button>
                            <hr>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection