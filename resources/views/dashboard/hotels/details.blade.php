@extends('baseapp')
@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       @include('dashboard.layouts.dashboard_sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('dashboard.layouts.dashboard_header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <p class="mb-4">Ayez une vu precise sur un hotel.<a target="_blank"
                    href="https://datatables.net"></a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Details de {{ $hotel->designation}}</h6>
                        </div>
                        <div class="card-header ml-10">
                            <a class="m-0 font-weight-bold btn btn-primary" href="{{route('allhotels')}}" >Retour vers la liste<i class="fas fa-angle-rigth"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="card mb-3" style="max-width: 900px;">
                                    <div class="row g-0">
                                      <div class="col-md-4">
                                        <img src="{{isset($hotel->mockup) ? asset('images_hotels/'.$hotel->mockup) : asset('img/undraw_rocket.svg')}} " alt="" srcset="" class="img-fluid img-rounded">
                                      </div>
                                      <div class="col-md-8">
                                        <div class="card-body">
                                          <h5 class="card-title">Hotel {{$hotel->designation}}</h5>
                                          <p class="text-sm">Nom du Gestionnaire:{{$hotel->gestionnaire != null ? $hotel->gestionnaire->nom : ''}} </p>
                                          <p class="text-sm">Telephone du Gestionnaire:{{$hotel->gestionnaire != null ? $hotel->gestionnaire->telephone : ''}} </p>
                                          <p class="text-sm">Sexe du Gestionnaire:{{$hotel->gestionnaire != null ? $hotel->gestionnaire->sexe == "M" ? "Masculin" : "Feminin" : ''}} </p>
                                          <p class="text-sm">Note: {{ (int)$hotel->note }} étoiles </p>
                                          <p class="text-sm">Adresse: {{ $hotel->adresse }}</p>
                                          <p class="text-sm">Ville: {{ $hotel->ville }}</p>
                                          <p class="text-sm">Qualite service: {{"Bonne"}} </p>
                                          <p class="card-text text-sm"><small class="text-muted">dernière mis à jour 3 mins</small></p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           @include('dashboard.layouts.dahboard_footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- details Modal-->
    <div class="modal fade d-none" id="DetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Localisation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                      
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
@endsection