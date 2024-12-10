@extends('dashboard.layout')

@section('content')
<p class="card-title">Page</p>
<div class="pb-3"><a href="{{route('halaman.create')}}" class="btn btn-primary">+ Tambah Halaman</a></div>
<div class="table-responsive">
    <table class="table table stripped">
        <thead>
            <tr>
                <th class="col-1">no</th>
                <th>judul</th>
                <th class="col-2">aksi</th>
            </tr>
        </thead>
        <tboby>
            <?php $i = 1 ?>
            @foreach ($data as $item)
            <tr>
                <td>{{$i}}</td>
                <td>{{$item->judul}}</td>
                <td>
                    <a href='{{route('halaman.edit', $item->id)}}' class="btn btn-sm btn-warning">Edit</a>
                    <form onsubmit="return confirm('Yakin mau hapus data ini?')" action="{{route('halaman.destroy', $item->id)}}" class="d-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit" name="submit">Del</button>
                    </form>
                    
                </td>
            </tr> 
            <?php $i++; ?>
            @endforeach
        </tboby>
    </table>
    
</div>
@endsection
