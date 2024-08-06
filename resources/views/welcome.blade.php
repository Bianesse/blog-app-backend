<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-light">
    <main class="container">
        <a href="{{ route('logout') }}" onclick="return confirm('Are you sure?');" class="nav-link">
            <button type="button" class="btn btn-danger">Logout</button>
          </a>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <form action='{{route('insert')}}' method='post'>
                @csrf
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='title' id="judul">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Author</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='author' id="pengarang" value="{{ auth()->user()->name }}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_publikasi" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-50" name='content' id="tanggal_publikasi">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-4">Title</th>
                        <th class="col-md-3">Author</th>
                        <th class="col-md-2">Content</th>
                        <th class="col-md-2">Comment</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($postList as $v)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$v['title']}}</td>
                        <td>{{$v['author']}}</td>
                        <td>{{$v['content']}}</td>
                        <td><ul>@foreach ($v['comments'] as $commentV)
                            <li>{{ $commentV['author'] }}, {{ $commentV['comment'] }}</li>
                        @endforeach</td></ul>
                        <td>
                            <a href="{{ route('edit', ['id' => $v['id']]) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('delete', ['id' => $v['id']]) }}" onclick="return confirm('You Sure?');" class="btn btn-danger btn-sm">Del</a>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>

        </div>
        <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

</body>

</html>