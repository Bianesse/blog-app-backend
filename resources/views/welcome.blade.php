@extends('Layouts.mainLayout')
<x-navbar></x-navbar>
@section('content')
<main class="container">
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
                        <form action="{{ route('delete', ['id' => $v['id']]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('You Sure?');" class="btn btn-danger">Delete</button>
                        </form>
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#comment{{$v['id']}}">
                            Add Comment
                        </button>

                        {{-- MODAL --}}
                        <x-modalcomment id="comment{{$v['id']}}" title="Add Comment" :scrollable="true">
                            <x-slot name="body">
                                <form method="POST" action="{{ route('commentInsert', ['id' => $v['id']] ) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="postContent">Post Content</label>
                                        <input type="text" class="form-control" id="postContent" placeholder="{{ $v['content'] }}" disabled>
                                      </div>
                                      <div class="form-group">
                                        <label for="author">Your Name</label>
                                        <input type="text" class="form-control" id="author" placeholder="{{ auth()->user()->name }}" disabled>
                                      </div><div class="form-group">
                                        <label for="comment">Your Comment</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                      </div>
                            </x-slot>
                            <x-slot name="footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary"></input>
                            </form>
                            </x-slot>
                        </x-modalcomment>
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
@endsection