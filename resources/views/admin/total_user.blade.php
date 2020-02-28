@extends('layouts.main')

@section('title')
    Admin -- Users
@endsection


@section('content')
    @include('partials.admin_nav')
    <div class="page">
        @include('partials.header')
        <div class="breadcrumb-holder">
            <div class="container-fluid">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
              </ul>
            </div>
          </div>


          <section>
              <div class="container-fluid">
                 
                  <div class="row d-flex">
                      <div class="container">
                          <div class="col-lg-12">
                              <div class="card">
                                <div id="feeds-box" class="card-header d-flex justify-content-between align-items-center">
                                    <h2 class="h5 display">User</h4>
                                      <div class="right-column">
                                        <select name="sort" id="sort" class="form-control">
                                          <option value="" selected>All Users</option>
                                          <option value="1">active users</option>
                                          <option value="0">blocked users</option>
                                        </select>
                                      </div>
                                </div>

                               

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table" id="users">
                                            <thead>
                                                <tr>
                                                    {{-- <th>ID</th> --}}
                                                    <th>Fullname</th>
                                                    <th>Email</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email Verified</th>
                                                    <th>status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                        </table>

                                    </div>

                                </div>

                              </div>

                          </div>

                      </div>

                  </div>

              </div>

              <div class="modal fade" id="users_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog"  id="users_modal_body" style="width:900px;">
                 
                </div>
            </div>
          </section>

    </div>
    
@endsection

@push('scripts')
<script src="{{asset('js/totaluser.js')}}"></script>
<script src="{{asset('js/handleactions.js')}}"></script>
@endpush

@push('styles')
 

  /* Tabs*/

@endpush