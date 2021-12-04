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
              <form method="POST" action="{{ route('handover_note.store', ['id_request_note' => $request_note->id]) }}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Người tạo phiếu bàn giao:</label>
                    <p>{{ auth()->user()->name }}</p>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Mã phiếu đề nghị:</label>
                    <p>{{ $request_note->id }}</p>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Người tạo phiếu đề nghị:</label>
                    <p>{{ $request_note->creator->name }}</p>
                  </div>
                </div>
                <hr>
                <div>
                  @if ($request_note->is_buy)
                    @include('handover_note.components.create_buy')
                  @else
                    @include('handover_note.components.create_fix')
                  @endif

                </div>
                <a href="{{ route('process_note.detail', ['id' => $request_note->id]) }}"
                  class="btn btn-default mr-1">Quay lại</a>
                <button type="submit" class="btn btn-primary">Tạo phiếu</button>
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
