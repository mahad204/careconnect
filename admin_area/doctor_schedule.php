<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Doctor Schedule Management</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-danger">Doctor Schedule List</h6>
                </div>
                <div class="col d-flex justify-content-end" >
                    <button class="btn btn-success btn-circle btn-sm" type="button" name="add_sched">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_filter">
                                <label for="">
                                    Search
                                    <input type="search" class="form-control form-control-sm" placeholder aria-control="doctor_schedule_table">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable no-footer" width="100%" cellspacing="0" role="grid">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width:104px;">
                                        Schedule Date
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width:98px;">
                                        Schedule Day
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width:75px;">
                                        Start Time
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width:67px;">
                                        End Time
                                        </th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width:117px;">
                                        Consulting Time
                                        </th>
                                        <th class="sorting_disabled" tabindex="0" rowspan="1" colspan="1" style="width:58px;">
                                        Status
                                        </th>
                                        <th class="sorting_disabled" tabindex="0" rowspan="1" colspan="1" style="width:58px;">
                                        Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm status_button">
                                                Active
                                            </button>
                                        </td>
                                        <td>
                                            <div align="center">
                                                <button class="btn btn-warning btn-circle btn-sm edit_button" name="edit_button_sched">
                                                    <i class="fas fa-edit">
                                                    </i>
                                                </button>
                                                <button class="btn btn-warning btn-circle btn-sm edit_button" name="delete_btn">
                                                    <i class="fas fa-times">
                                                    </i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>