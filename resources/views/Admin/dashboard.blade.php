@extends('Admin.layouts.app')
@section('title', 'Dashboard')

@section('header')
@include('Admin.includes.header', ['function' => 'Dashboard'])
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">&#xE894;</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Top 100</h4>
                <div class="row">
                    <div class="col-md-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Địa chỉ</th>
                                        <th>Views</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($places as $place)
                                        <tr>
                                            <td>
                                               {{ $place->id }}
                                            </td>
                                            <td><a href="{{ route('listing.detail', $place->id) }}">{{ $place->name }}</a></td>
                                            <td>{{ $place->district }} {{ $place->city }}</td>
                                            <td>
                                                {{ $place->count_views }}
                                            </td>
                                            <td>
                                               {{ $place->getRatePlace($place->id) }}
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-1">
                        <div id="worldMap" class="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection