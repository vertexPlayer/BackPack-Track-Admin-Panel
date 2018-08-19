@extends('layouts.adminpanel')

@section('title', 'Activities')

@section('pageheader', $data['itinerary']['title'])

@section('content')

  <h3 class="title-5 m-b-35">
    By: {{ $data['itinerary']['user']['name'] }} <br>
    Country: {{ $data['itinerary']['country']['name'] }}
  </h3>

  <div class="table-responsive table--no-card m-b-30">
      <table class="table table-borderless table-striped table-earning">
          <thead>
              <tr>
                  <th>Date &amp; Time</th>
                  <th>Activity</th>
                  <th>Description</th>
                  <th>Place</th>
                  <th>Budget</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($data['activities'] as $activities)
                  <tr>
                      <td>
                          {{ date('d-m-Y', strtotime($activities['date'])) }} <br>
                          {{ $activities['time'] }}
                      </td>
                      <td>{{ $activities['activity'] }}</td>
                      <td>{{ $activities['description'] }}</td>
                      <td>
                          {{ $activities['place_name'] }} &nbsp;
                          <a href="https://www.google.com/maps/?q={{ $activities['lat'] }},{{ $activities['lng'] }}" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Location">
                            <i class="fas fa-map-marker-alt"></i>
                          </a>
                      </td>
                      <td>{{ $activities['budget'] }}</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>

@endsection