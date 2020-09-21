<div class="modal fade" id="addModalUser">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->

            <div class="modal-header">
                <h4 class="modal-title" id="editUserModalTitle">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                @include('users.error')
                <form class="form-horizontal"  id="add-contact_form" enctype="multipart/form-data" >
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>User Name</h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="addName" name="name" class="form-control" placeholder="Username" >

                                        {{--                                        {{ $errors->first('name') }}--}}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>E-Mail</h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-email"></i>
                                            </span>
                                        </div>
                                        <input type="email" id="addEmail" name="email" class="form-control" placeholder="E-Mail Address" >
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Phone </h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                 <span class="input-group-text">
                                                <i class="mdi mdi-phone"></i>
                                 </span>
                                        </div>
                                        <input type="text" id="addPhone" name="phone" class="form-control" placeholder="Phone" >
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Address </h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-home"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="addAddress" name="address" class="form-control" placeholder="address" >
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>PassWord </h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-home"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="addpassword" name="password" class="form-control" placeholder="PassWord" >
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Status </h4></label>
                                </div>

                                <div class="col-md-4 col-lg-4 inputGroupContainer">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                     <span class="input-group-text">
                                                <i class="mdi mdi-alpha-s-box"></i>
                                     </span>
                                        </div>

                                        <select name="status" id="AddStatus" class="form-control" >
                                            <option value="active"  >active  </option>
                                            <option value="inactive"  >inActive</option>
                                        </select>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Permission </h4></label>
                                </div>

                                <div class="col-md-4 col-lg-4 inputGroupContainer">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                     <span class="input-group-text">
                                                <i class="mdi mdi-alpha-s-box"></i>
                                     </span>
                                        </div>

                                        <select name="role_id[]" id="AddPermission" class="form-control" multiple>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}"> {{$role->name}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Avatar</h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                   <span class="input-group-text">
                                                <i class="mdi mdi-google-photos"></i>
                                   </span>
                                        </div>
                                        <input type="file" class="form-control" id="addAvatar" name="avatar" placeholder="Enter Image"/>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Text area -->

                        <!-- Success message -->
                        <!-- Button -->
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-4 col-lg-4 control-label"></label>
                                <div class="col-md-4 col-lg-4">
                                    <button type="button" class="btn btn-danger  raised" id="add-submit-user" data-url = "{{route('user.store')}}">Submit <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="edit-submit" data-dismiss="modal">Close</button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
        });
    </script>
@endsection

