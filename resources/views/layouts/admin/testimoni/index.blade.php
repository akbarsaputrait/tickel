@extends('master_admin') @section('title', 'Testimoni') @section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Testimoni</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="order">
            <thead>
              <tr>
                <th>
                  Nama
                </th>
                <th>
                  Keterangan
                </th>
                <th>
                  Tanggal
                </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($testimoni as $item)
              <tr>
                <td>
                  {{ $item->user->nama_penumpang }}
                </td>
                <td>
                  {{ $item->content }}
                </td>
                <td>
                  {{ date('d F Y, H:i A', strtotime($item->created_at)) }}
                </td>
                <td>
                  <button type="button" name="button" class="btn btn-danger" id="deleteButton" data-id="{{ $item->id }}" data-menu="testimoni">
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection @section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('table').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
      ],
      order: [
        [2, "desc"]
      ]
    });
  });
</script>
@endsection
