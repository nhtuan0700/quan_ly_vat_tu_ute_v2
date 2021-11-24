@extends('master')
@section('title')
  Quản lý phiếu bàn giao
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div>
                <p class="card-title mr-3">Chi tiết</p>
              </div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <label>Mã phiếu bàn giao:</label>
                  <p>{{ $note->id }}</p>
                </div>
                <div class="col-md-3">
                  <label>Người tạo phiếu bàn giao:</label>
                  <p>{{ $note->creator->name }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label>Mã phiếu đề nghị:</label>
                  <p>{{ $note->request_note->id }}</p>
                </div>
                <div class="col-md-3">
                  <label>Người tạo phiếu đề nghị:</label>
                  <p>{{ $note->request_note->creator->name }}</p>
                </div>
                <div class="col-md-3">
                  <label>Loại phiếu:</label>
                  <p>{{ $note->request_note->category }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <label>Ngày tạo phiếu bàn giao:</label>
                  <p>{{ $note->created_at }}</p>
                </div>
                <div class="col-md-3">
                  <label>Trạng thái:</label>
                  <p>{{ $note->statusText }}</p>
                </div>
              </div>
              <hr>
              {{-- Form --}}
              <form action="{{ route('handover_note.update', ['id' => $note->id]) }}" method="post">
                @csrf
                @method('put')
                <div>
                  @if ($note->request_note->is_buy)
                    @include('handover_note.components.edit_buy', ['note' => $note])
                  @else
                    @include('handover_note.components.edit_fix', ['note' => $note])
                  @endif
                </div>
                <a href="{{ route('handover_note.detail', ['id' => $note->id]) }}"
                  class="btn btn-warning mr-2">Trở về</a>
                @can('update', $note)
                  <button href="#" class="btn btn-primary float-right">Lưu</button>
                @endcan
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
@section('tag_head')
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection
