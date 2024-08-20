@extends('layouts.user_type.auth')

@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row m-2">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Projects table</h6>
              <div class="row">
                <div class="col form-group">
                    <label for="example-date-input" class="form-control-label">Min Date</label>
                    <input class="form-control" type="date" id="minDate">
                </div>
                <div class="col form-group">
                    <label for="example-date-input" class="form-control-label">Max Date</label>
                    <input class="form-control" type="date" id="maxDate">
                </div>
                <div class="col d-grid justify-content-sm-end">
                    <button type="button" id="filterBtn" class="btn btn-outline-primary btn-sm mt-4">Filter</button>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0 m-3">
                <table id="myTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomer</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Login</th>
                        </tr>
                      </thead>
                    <tbody>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.min.css"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.3/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.colVis.min.js"></script>

  <script type="text/javascript">
    $(function () {
        const date = new Date();

        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();

        if (day <= 10) day = '0' + day;
        if (month <= 10) month = '0' + month;

        let currentDate = `${year}-${month}-${day}`;
        let min = $('#minDate').val()
        let max = $('#maxDate').val()

        console.log(currentDate,min,max);

        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Data Brits Hotel ' + currentDate
                },
            ],
            ajax: {
                url : "{{ route('tables.index') }}",
                data: function (d) {
                    d.from_date = $('#minDate').val();
                    d.to_date = $('#maxDate').val();
                }
            },
            columns: [
                  {data: 'id', name: 'id'},
                  {data: 'nama_user', name: 'nama_user'},
                  {
                    data: null,
                    render: (data) => data.countryCode + data.nomer_telp,
                  },
                  {
                    data: null,
                    render: (data) => data.created_at.slice(0,10)
                  },
              ],
          });

        $('#filterBtn').click(function(){
            table.draw();
        });
    });
    </script>

  @endsection



