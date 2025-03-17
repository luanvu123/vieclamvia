@extends('layout')
@section('content')

    <div class="main-content" id="main-content">

        <div class="card card-body">
            <h4 class="bold">Lịch Sử Giao Dịch</h4>

            <div class="table-responsive m-t-30">
                <div id="table-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="user_log">
                              <thead>
    <tr>
        <th>ID</th>
        <th>Số Tiền</th>
        <th>Loại</th>
        <th>Nội Dung</th>
        <th>Trạng Thái</th>
        <th>Thời Gian</th>
    </tr>
</thead>
<tbody>
    @foreach ($deposits as $key => $deposit)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>
                @if ($deposit->type === 'mua hàng')
                    <span style="color: red;">- {{ number_format($deposit->money, 0, ',', '.') }} VND</span>
                @elseif ($deposit->type === 'nạp tiền')
                    <span style="color: green;">+ {{ number_format($deposit->money, 0, ',', '.') }} VND</span>
                @else
                    {{ number_format($deposit->money, 0, ',', '.') }} VND
                @endif
            </td>
            <td>{{ $deposit->type }}</td>
            <td>{{ $deposit->content }}</td>
            <td>{{ $deposit->status }}</td>
            <td>{{ $deposit->created_at->format('d/m/Y H:i:s') }}</td>
        </tr>
    @endforeach
</tbody>

                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
