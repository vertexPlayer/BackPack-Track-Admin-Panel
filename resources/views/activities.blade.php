@extends('layouts.adminpanel')

@section('title', 'Activities')

@section('breadcrumb')
  <li class="list-inline-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
  </li>
  <li class="list-inline-item seprate">
      <span>/</span>
  </li>
  <li class="list-inline-item">
      <a href="{{ route('itineraries') }}">Itineraries</a>
  </li>
  <li class="list-inline-item seprate">
      <span>/</span>
  </li>
  <li class="list-inline-item active">Itinerary ID:{{ $data->id }}</li>
@endsection

@section('pageheader', $data->title)

@section('content')

  <h3 class="title-5 m-b-35">
    By: {{ $data->user->name }} <br>
    Country: {{ $data->country->name }}
  </h3>

  <div class="table-responsive table--no-card m-b-30">
      <table class="table table-borderless table-striped table-earning">
          <thead>
              <tr>
                  <th>Date &amp; Time</th>
                  <th>Activity</th>
                  <th>Description</th>
                  <th>Place</th>
                  <th>Picture</th>
                  <th>Budget</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($data->activities as $activities)
                  <tr>
                      <td>
                          {{ date('d-m-Y', strtotime($activities->date)) }} <br>
                          {{ date('h:i a', strtotime($activities->time)) }}
                      </td>
                      <td>{{ $activities->activity }}</td>
                      <td>{{ $activities->description }}</td>
                      <td>
                          {{ $activities->place_name }} &nbsp;
                          <a href="https://www.google.com/maps/?q={{ $activities->lat }},{{ $activities->lng }}" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Location">
                            <i class="fas fa-map-marker-alt"></i>
                          </a>
                      </td>
                      <td>
                          @if ($activities->pic_url != null)
                            <a href="{{ $activities->pic_url }}" data-lightbox="activities-pic" data-title="{{ $activities->place_name }} - {{ $activities->activity }}">
                              <img src="{{ $activities->pic_url }}">
                            </a>
                          @endif
                      </td>
                      <td>{{ $data->country->currency }} {{ $activities->budget }} ({{ $activities->budgettype->type }})</td>
                  </tr>
              @endforeach
                  <tr>
                      <th colspan="5" align="right">
                          <div style="float: right; text-align: right">Total Budget Spent</div>
                      </th>
                      <td><b>{{ $data->country->currency }} {{ $data->totalbudget }}</b></td>
                  </tr>
          </tbody>
      </table>
  </div>

@endsection
