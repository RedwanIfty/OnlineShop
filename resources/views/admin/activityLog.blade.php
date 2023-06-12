@extends('admin.layouts.app')
@section('title')
    Activity Log
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Activity Log Information</h4>
        <div class="card">
            <h2 class="card-header text-center" style="color: green">Activity Log</h2>
                <table class="table table-responsive table-light" id="example">
                    <thead>
                    <tr>
                        <th>Log Name</th>
                        <th>Description</th>
                        <th>Properties</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($logs as $log)
                            <tr>
                                <td>{{$log->log_name}}</td>
                                <td>{{$log->description}}</td>
                                <td>
                                    @php
                                        $properties = json_decode($log->properties, true);
                                        $keys = array_keys($properties);
                                        $last_key = end($keys);
                                    @endphp

                                    @foreach($properties as $key => $value)
                                        <strong>{{ $key }}:</strong> {{ $value }}{{ $key != $last_key ? ',' : '' }}
                                    @endforeach

                                </td>
                                <td>{{$log->created_at}}</td>
                                <td>{{$log->updated_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>

                </table>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                response:true,
                "ordering":false,
            });
        });
    </script>
@endsection
