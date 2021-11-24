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
                <p>
                  {{ $note->request_note->id }} 
                  <a href="{{ route('process_note.detail', ['id' => $note->request_note->id]) }}" target="_blank">
                    <i class="fas fa-eye"></i>
                  </a>
                </p>
              </div>
              <div class="col-md-3">
                <label>Người tạo phiếu đề nghị:</label>
                <p>{{ $note->request_note->creator->name }}</p>
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
            <div>
              @if ($note->request_note->is_buy)
                @include('handover_note.components.detail_buy', ['note' => $note])
              @else
                @include('handover_note.components.detail_fix')
              @endif        
            </div>
            <a href="{{ route('handover_note.index') }}" class="btn btn-warning mr-2">Trở về</a>
            <a href="#" class="btn btn-secondary mr-2">In phiếu</a>
            @can('update', $note)
              <a href="{{ route('handover_note.edit', ['id' => $note->id]) }}" class="btn btn-info mr-2">Sửa</a>
            @endcan
            @can('confirm', $note)
              <form action="{{ route('handover_note.confirm', ['id' => $note->id]) }}" method="post" 
                class="float-right">
                @csrf
                <button class="btn btn-primary">Xác nhận</button>
              </form>
            @endcan
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection