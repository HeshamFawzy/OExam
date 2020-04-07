@extends('layouts.dashboard')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold">Employee Info</p>
    </div>
    <div class="card-body">
        <button style="float: right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add New Exam</button>

        <div class="row">
            <div class="col-md-6 text-nowrap">
                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show <select
                            class="form-control form-control-sm custom-select custom-select-sm">
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select></label></div>
            </div>
            <div class="col-md-6">
                <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search"
                            class="form-control form-control-sm" aria-controls="dataTable"
                            placeholder="Search" /></label></div>
            </div>
        </div>
        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table dataTable my-0" id="dataTable">
                <thead>
                    <tr>
                        <th>Exam Title</th>
                        <th>Date & Time</th>
                        <th>Duration</th>
                        <th>Total Question</th>
                        <th>Right Answer Mark</th>
                        <th>Wrong Answer Mark</th>
                        <th>Status</th>
                        <th>Question</th>
                        <th>Enroll</th>
                        <th>Result</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6 align-self-center">
                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27
                </p>
            </div>
            <div class="col-md-6">
                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span
                                    aria-hidden="true">«</span></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                    aria-hidden="true">»</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>

            <div class="form-group">
                <label for="title">Exam Title* :</label>
                <input type="text" class="form-control" name="title" required="" placeholder="Enter Exam Title" />
            </div>

            <div class="form-group">
                <label for="date">Exam Date & Time* :</label>
                <input type="date" class="form-control" name="date" required="" />
            </div>

            
            <div class="form-group">
                <label for="duration">Exam Duration* :(Minutes)</label>
                <input type="number" class="form-control" name="duration" required="" placeholder="Enter Exam Duration in Minutes"/>
            </div>

            
            <div class="form-group">
                <label for="total">Total Question* :(Number)</label>
                <input type="number" class="form-control" name="total" required="" placeholder="Enter Exam Total Questions Number"/>
            </div>

            
            <div class="form-group">
                <label for="right">Marks For Right Answer* :(Marks)</label>
                <input type="number" class="form-control" name="right" required=""placeholder="Enter Exam Marks Per Right Answer" />
            </div>

            <div class="form-group">
                <label for="wrong">Marks For Wrong Answer* :(Marks)</label>
                <input type="number" class="form-control" name="wrong" required="" placeholder="Enter Exam Marks Per Wrong Answer"/>
            </div>
    
    
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </div>
@endsection