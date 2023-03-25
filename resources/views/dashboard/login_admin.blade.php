@extends('../baseapp')
@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    @if(session('validation_errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Validation Echoué</strong> 
                            <p>{{ session('validation_errors') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session('invalidcredentialserrors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Invalid Credentials</strong>
                            <p>{{ session('invalidcredentialserrors') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <img src="{{asset('img/undraw_mobile_login.svg')}}" alt="" srcset="" style="width:500px;height:500px;">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Heureux de vous revoir !</h1>
                                </div>
                                <form class="user" method="POST" action="{{url('/login')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                            placeholder="Enter Email Address or your username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Se rappeler de moi</label>
                                        </div>
                                    </div>
                                    <button type="submit" value="admin" name="submit" class="btn btn-primary btn-user btn-block">
                                       Se connecter en tant que Admin
                                    </button>
                                    <hr>
                                    <button type="submit" value="gestionnaire" name="submit" class="btn btn-danger btn-user btn-block">
                                        <i class="fa fa-user"></i> Se connecter en tant que Gestionnaire
                                     </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Mot de passe oublié?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection