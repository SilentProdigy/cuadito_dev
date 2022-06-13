@extends('layouts.dashboard-layout')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <span class="profile-labels">Services</span>
    <div class="float-end">
      <button class="btn btn-primary">Add Service</button>
    </div>
  </div>
  <div class="card-body">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Service</th>
                <th>Bids</th>
                <th>Needed no. of People</th>
                <th>Contact</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Plumber</td>
                <td>10</td>
                <td>2</td>
                <td>09473299876</td>
                <td>2022-10-25</td>
                <td>P20,800</td>
            </tr>
            <tr>
                <td>Electrician</td>
                <td>10</td>
                <td>2</td>
                <td>09473299876</td>
                <td>2022-10-25</td>
                <td>P20,800</td>
            </tr>
            <tr>
                <td>Carpenter</td>
                <td>10</td>
                <td>2</td>
                <td>09473299876</td>
                <td>2022-10-25</td>
                <td>P20,800</td>
            </tr>
            <tr>
                <td>Marketing Manager</td>
                <td>10</td>
                <td>2</td>
                <td>09473299876</td>
                <td>2022-10-25</td>
                <td>P20,800</td>
            </tr>
            <tr>
                <td>Website Developer</td>
                <td>10</td>
                <td>2</td>
                <td>09473299876</td>
                <td>2022-10-25</td>
                <td>P40,000</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$('#example').DataTable();
	});
</script>
@endsection