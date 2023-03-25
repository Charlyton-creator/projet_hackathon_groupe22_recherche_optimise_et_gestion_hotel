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
                    <p class="mb-4">L'ensemble des Hotels enregistrés dans la base. si vous avez besoin de renseigner un nouveau hotel qui vient d'etre creer, veuillez cliquer sur le boutton "Nouveau" <a target="_blank"
                    href="https://datatables.net"></a>.</p>

                    @if(session('validation_errors'))
                        <div class="alert alert-danger">
                            <p class="m-0 font-weight-bold text-danger">{{session('validation_errors')}}</p>
                        </div>
                    @elseif(session('server_error'))
                        <div class="alert alert-danger">
                            <p class="m-0 font-weight-bold text-danger">{{session('server_error')}}</p>
                        </div>
                    @endif
                    @if(session('success_registering'))
                        <div class="alert alert-success">
                            <p class="m-0 font-weight-bold">{{session('success_registering')}}</p>
                        </div>
                    @endif
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Hotels sur HOSPITALITY PRO</h6>
                        </div>
                        <div class="card-header ml-10">
                            <a class="m-0 font-weight-bold btn btn-primary" href="#" data-toggle="modal" data-target="#addModal">Renseigner nouveau <i class="fas fa-plus"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Designation</th>
                                            <th>Adresse</th>
                                            <th>Region</th>
                                            <th>Ville</th>
                                            <th>Note</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hotels as $hotel)
                                        <tr>
                                            <td>{{$hotel->designation}}</td>
                                            <td>{{$hotel->adresse}}</td>
                                            <td>{{$hotel->region}}</td>
                                            <td>{{$hotel->ville}}</td>
                                            <td>
                                                @for ($i=0; $i <(int)$hotel->note; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            </td>
                                            <td style="width:250px;">
                                                <a class="btn btn-primary" href="{{route('hotel', ['id'=>$hotel->id])}}">Details</a>

                                                <a href="http://" class="btn btn-success">Statistiques</a>
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
    </div>*
    <!-- Logout Modal-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enregistrer un nouvel hotel</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{url('/registerhotel')}}">
                        @csrf
                        <div class="col-md-6">
                          <label for="designation" class="form-label">Designation</label>
                          <input type="text" class="form-control" name="designation" required>
                        </div>
                        <div class="col-md-6">
                          <label for="adresse" class="form-label">Adresse</label>
                          <input type="text" class="form-control" name="adresse" required>
                        </div>
                        <div class="col-md-6">
                          <label for="region" class="form-label">Region</label>
                          <input type="text" class="form-control" id="" placeholder="Kara" name="region" required>
                        </div>
                        <div class="col-md-6">
                          <label for="ville" class="form-label">Ville</label>
                          <input type="text" class="form-control" id="" placeholder="Kara" name="ville" required>
                        </div>
                        <div class="col-12">
                            <label for="note" class="form-label">Note des clients</label>
                            <input type="numeric" class="form-control" id="" placeholder="3" name="note" required>
                        </div>
                        <div class="col-12">
                            <label for="mockup" class="form-label">Choisir une image descriptive</label>
                            <input type="file" class="form-control" id="" placeholder="Auncun fichier selectionner" name="mockup">
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label" required>Description</label>
                            <textarea class="form-control" id="" rows="3"  name="description"></textarea>
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function popupModal(){
            var modalelement = document.getElementById('DetailsModal')
            modaleelement.classList.remove('d-none')
        }
    </script>
@endsection