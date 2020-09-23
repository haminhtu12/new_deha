<div class="modal fade" id="addModalRole">
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
                <div class="col-md-12">
                <form class="form-horizontal" data-action="{{route('roles.store')}}" method="post" id="add_role_form" enctype="multipart/form-data"  >
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Role Name</h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="addName" name="name" class="form-control" placeholder="RoleName" >
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Description</h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">

                                    <textarea name="description" id="descriptionRole" cols="26" rows="3"></textarea>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                                <div class="col-md-12 card border-primary">
                                    @foreach($permissionsParent as $permissionsParentItem)
                                        <div class="card-header text-white" style="background-color: blue;">

                                            <label>
                                                <input type="checkbox" name="permission_id[]"  value="{{$permissionsParentItem->id}}" class="checkbox_wrapper" data-class="{{($permissionsParentItem->slug_name)}}" >
                                            </label>
                                            Module {{$permissionsParentItem->name}}
                                        </div>

                                        <div class="row">
                                            @foreach($permissionsParentItem->permissionsChildren as $permission)
                                        <div class="card-body text-primary col-md-3"  >
                                            <h5 class="card-title">
                                                <label>
                                                    <input type="checkbox" value="{{$permission->id}}"
                                                           name="permission_id[]" class="{{($permissionsParentItem->slug_name).'-select-item'}}">
                                                </label>

                                                {{$permission->name}}
                                            </h5>
                                        </div>
                                            @endforeach

                                        </div>
                                    @endforeach
                                    </div>
                        </div>




                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-4 col-lg-4 control-label"></label>
                                <div class="col-md-4 col-lg-4">
                                    <button type="button" class="btn btn-danger  raised" id="add-submit-role">Submit <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancell-submit-add" data-dismiss="modal">Close</button>
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

