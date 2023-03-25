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
                    @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="fas fa-check"></i>
                        <div>
                         {{session('success')}}
                        </div>
                      </div>
                    @endif
                    <!-- Page Heading -->
                    <p class="mb-4">Les Gestionnaires sont des agents assignés aux différents hotels pour suivie. Ces agents peuvent etre les gérants de l'hotel ou de tierce personnes. 
                        Leur gestion est beaucoup plus pointu et ils sont chargés de configurer les nouveaux hotels. 
                        Une fois donc que l'Administrateur globale assigne un hotel à la gestion de ce dernier, il peut donc le configurer. (renseigner les chambres, les services, voir les reservations, les stats....)
                       <a target="_blank" href="https://datatables.net"></a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gestionnaires des Hotels sur HOSPITALITY PRO</h6>
                        </div>
                         <div class="card-header ml-10">
                            <a class="m-0 font-weight-bold btn btn-primary" href="{{url('/gestionnaire/add')}}">Ajouter (Renseigner) un Gestionnaire <i class="fas fa-plus"></i> </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Adresse</th>
                                            <th>Username</th>
                                            <th>Telephone</th>
                                            <th>Sexe</th>
                                            <th>Hotel de direction</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($gestionnaires as $gestionnaire)
                                        <tr>
                                            <td>{{$gestionnaire->nom}}</td>
                                            <td>{{$gestionnaire->adresse}}</td>
                                            <td>{{$gestionnaire->username}}</td>
                                            <td>{{$gestionnaire->telephone}}</td>
                                            <td>{{$gestionnaire->sexe === "M" ? "Masculin" : "Feminin"}}</td>
                                            <td>{{$gestionnaire->hotel->designation}}</td>
                                            <td>
                                                <a href="{{url('/gestionnaires', ['id'=>$gestionnaire->id])}}" data-toggle="modal" data-target="#detailModal" class="btn btn-secondary">Details</a>
                                                <a href="{{url('/gestionnaires', ['id'=>$gestionnaire->id])}}" data-toggle="modal" data-target="#messageModal" class="btn btn-primary">Message</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informations detaillés</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary">
                        Details de {{$gestionnaire->nom}}
                    </div>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="{{asset('img/undraw_profile.svg')}}" class="img-fluid rounded-start" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">Details</h5>
                              <p class="card-text">Nom :</p>
                              <p class="card-text">Sexe :</p>
                              <p class="card-text">Telephone :</p>
                              <p class="card-text">Adresse :</p>
                              <p class="card-text"><small class="text-muted">Dernière mis à jour de profil:  de celà 3 mins</small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary"  type="button" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- detail Modal-->
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

     <!-- message Modal-->
     <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Envoyer un Message ?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
                <form class="row g-3">
                    <div class="col-12">
                      <label for="subject" class="form-label">Sujet du message</label>
                      <input type="text" class="form-control" name="subject">
                    </div>
                    <div class="col-12">
                      <label for="message" class="form-label">Message</label>
                      <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="clear-"></div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                  </form>
             </div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Quitter</button>
             </div>
         </div>
     </div>
 </div>
@endsection