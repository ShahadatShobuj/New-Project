
@php 
    $data['breadcrumb'] =   [
            'Home' => route('admin.dashboard'),
            'Offers' => route('admin.offers'),
        ];
    $data['title'] = 'Offers';
@endphp

@extends('backend.layouts.default')

@section('page_title')
{{ end($data) }}
@endsection

@section('content')

@include('backend.layouts.modules.navbar')
@include('backend.layouts.modules.sidebar')
@include('backend.layouts.modules.content-header')

  <section class="content">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title d-inline">Offers Items list</h3>
            @if (session('status'))
                <span class="alert alert-success" role="alert">
                    {{ session('status') }}
                </span>
            @elseif (session('warning'))
                <span class="alert alert-danger" role="alert">
                    {{ session('warning') }}
                </span>
            @endif
          </div>
          <!-- /.card-header -->
          <div class="card-body"> 
            <table id="banners" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Model</th>
                  <th>Image</th>
                  <th>Price (BDT)</th>
                  <th>Expires</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $sl = 1;
                @endphp
                @if(count($offers) > 0)
                  @foreach($offers as $offer)
                    <tr>
                      <th class="align-middle">{{$sl}}</th>
                      <td class="align-middle">{{ $offer->model }}</td>                      
                      <td class="align-middle">
                        <img class="img-fluid" src="{{asset('/public/storage/backend/products/'.$offer->model.'/'.$offer->item->attributeFirst()['sku'].'/thumbnail/'.$offer->item->attributeFirst()['images'][0])}}" alt="{{$offer->item->attributeFirst()['images'][0].' image'}}">
                      </td>
                      <td class="align-middle">
                        {{number_format($offer->item->absolutePrice(),2)}}
                      </td>
                      <td class="align-middle">
                        @php
                          echo Carbon\Carbon::parse($offer->expiry_date)->format('d-m-Y');
                        @endphp
                      </td>
                      <td class="align-middle">{{ $offer->created_at->format('H:i d-m-Y') }}</td>
                      <td class="align-middle">
                        <a class="btn btn-info" href="{{ route('admin.offer.edit', ['id' => $offer->id]) }}" title="Edit Subcategory"><i class="far fa-edit"></i></a>
                        <a class="btn btn-success" href="{{ route('admin.offer.details', ['id' => $offer->id]) }}" title="Subcategory details"><i class="far fa-check-square"></i></a>
                        <a class="btn btn-danger" href="{{ route('admin.offer.delete', ['id' => $offer->id]) }}" title="Remove Subcategory"><i class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
                    @php
                      $sl++;
                    @endphp
                  @endforeach
                @else
                  <tr class="empty">
                    <td colspan="4" class="text-center">Subcategory list is empty.</td>
                  </tr>
                @endif
              </tbody>
              <tfoot>
                <tr>
                  <th>Sl No.</th>
                  <th>Model</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Expires</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
    
</div>
<!-- /.content-wrapper -->

@include('backend.layouts.modules.controlbar')

</section>
@endsection