@extends('Layouts.mainLayout')
@extends('layouts.navbar')

@section('content')
<section class="py-3 py-md-5">
    <div class="container">
      <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
        <div class="col-12 col-lg-6 col-xl-7">
          <div class="row justify-content-xl-center">
            <div class="col-12 col-xl-11">
              <h2 class="mb-3">{{ $post->title }}</h2>

              <div class="row gy-4 gy-md-0 gx-xxl-5X">
                <div class="col-12 col-md-6">
                  <div class="d-flex">

                    <div>
                      <p class="text-secondary mb-0">{{ $post->content }}</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container my-5 py-5">
      <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="card text-body">
            <div class="card-body p-4">
              <h4 class="mb-0">Recent comments</h4>
              <p class="fw-light mb-4 pb-2">Latest Comments section by users</p>
  
              @foreach ($commentList as $v)
              <hr>
              <div class="d-flex flex-start">
                <img class="rounded-circle shadow-1-strong me-3"
                  src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(23).webp" alt="avatar" width="60"
                  height="60" />
                <div>
                  <h6 class="fw-bold mb-1">Maggie Marsh</h6>
                  <div class="d-flex align-items-center mb-3">
                    <p class="mb-0">
                      March 07, 2021
                      <span class="badge bg-primary">Pending</span>
                    </p>
                    <a href="#!" class="link-muted"><i class="fas fa-pencil-alt ms-2"></i></a>
                    <a href="#!" class="link-muted"><i class="fas fa-redo-alt ms-2"></i></a>
                    <a href="#!" class="link-muted"><i class="fas fa-heart ms-2"></i></a>
                  </div>
                  <p class="mb-0">
                    {{$v->comment}}
                  </p>
                </div>
              </div>
              @endforeach
             

            </div>  
            
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection