<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="BackPack Track Itinerary">
    <meta name="author" content="Afif Zafri">
    <meta name="keywords" content="BackPack Track Itinerary">

    <!-- Title Page-->
    <title>{{ $data->title }} | {{ config('app.name', 'BackPack Track') }}</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('images/icon/logo-mini.png') }}">

    <!-- Fontfaces CSS-->
    <link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS -->
    <link href="{{ asset('vendor/lightbox2/dist/css/lightbox.css') }}" rel="stylesheet" media="all">

    <style media="screen">
      /*Timeline bar style*/
      ul.timeline {
        list-style-type: none;
        position: relative;
      }
      ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
      }
      ul.timeline > li {
        margin: 30px 0;
        padding-left: 40px;
      }
      ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
      }

      .card-img-top {
          width: 100%;
          height: 25vw;
          object-fit: cover;
      }

      /* Set the size of the div element that contains the map */
      #map {
        height: 600px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }

       /* comment style */
       .comment-box {
            margin-top: 10px !important;
        }
        /* CSS Test end */

        .comment-box img {
            width: 50px;
            height: 50px;
        }
        .comment-box .media-left {
            padding-right: 10px;
            width: 65px;
        }
        .comment-box .media-body p {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .comment-box .media-body .media p {
            margin-bottom: 0;
        }
        .comment-box .media-heading {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 7px 10px;
            position: relative;
            margin-bottom: -1px;
        }
        .comment-box .media-heading:before {
            content: "";
            width: 12px;
            height: 12px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-width: 1px 0 0 1px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            position: absolute;
            top: 10px;
            left: -6px;
        }

    </style>
  </head>
  <body onload="launchApp()">

    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <span class="navbar-brand mb-0 h1"><img src="{{ asset('images/icon/logo-mini.png') }}" width="40px"/> BackPack Track</span>
        <a class="nav-item nav-link active" id="nav-activities-tab" data-toggle="tab" href="#nav-activities" role="tab" aria-controls="nav-activities" aria-selected="true">Activities</a>
        <a class="nav-item nav-link" id="nav-map-tab" data-toggle="tab" href="#nav-map" role="tab" aria-controls="nav-map" aria-selected="false">Map</a>
        <a class="nav-item nav-link" id="nav-budget-tab" data-toggle="tab" href="#nav-budget" role="tab" aria-controls="nav-budget" aria-selected="false">Budget</a>
        <a class="nav-item nav-link" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab" aria-controls="nav-comments" aria-selected="false">Comments</a>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('home') }}">
                            {{ __('Home') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
      </div>
    </nav>

    <br>

    <div class="container">

         <div class="tab-content" id="nav-tabContent">
           <div class="tab-pane fade show active" id="nav-activities" role="tabpanel" aria-labelledby="nav-activities-tab">

               <div class="card">
                  <h4 class="card-header">
                    {{ $data->title }}
                  </h4>
                  <div class="card-body">
                    <h5>
                      <i class="fas fa-user"></i>
                      <a href="/user/{{ $data->user->username }}">{{ $data->user->name }}</a> <small class="text-muted">({{ "@".$data->user->username }})</small>
                    </h5>
                    <h5><i class="fas fa-map-marker-alt"></i> {{ $data->country->name }} </h5>
                    <h5><i class="far fa-calendar"></i> {{ date_format(date_create($data->created_at),"d/m/Y") }} </h5>
                    <h5><i class="fas fa-heart"></i>({{ $totallikes }}) &nbsp;&nbsp; <i class="fas fa-comments"></i>({{ $totalcomments }})</h5>
                  </div>
                </div>
                <br>

                <?php $i = 1; ?>
                @foreach ($data->activities as $date => $activities)

                  <h4>Day {{$i++}} ({{ date_format(date_create($date),"d/m/Y") }})</h4>

                  <ul class="timeline">
                    @foreach ($activities as $activity)

  				            <li>
                        <div class="row">
                        <div class="card" >
                          @if ($activity->pic_url != "" && $activity->pic_url != null)
                            <a href="{{ $activity->pic_url }}" data-lightbox="{{ $activity->id }}" data-title="{{ $activity->place_name }} - {{ $activity->activity }}">
                              <img class="card-img-top" src="{{ $activity->pic_url }}"/>
                            </a>
                          @endif
                          <div class="card-body">
                            <h5 class="card-title">{{ json_decode('"'.$activity->activity.'"') }}</h5>
                            <p class="card-text">{{ json_decode('"'.$activity->description.'"') }}</p>
                            <table cellpadding="10">
                              <tr>
                                <td><i class="far fa-clock"></i> {{ date("g:i a", strtotime($activity->time)) }}</td>
                                <td><i class="fas fa-map-marker-alt"></i> {{ $activity->place_name }}</td>
                                <td><i class="fas fa-dollar-sign"></i> {{ $data->country->currency }} {{ $activity->budget }} ({{ $activity->budgettype->type }})</td>
                              </tr>
                            </table>
                          </div>
                        </div></div>
                      </li>

                    @endforeach
                  </ul>

                  <br><br>

                @endforeach

           </div>
           <div class="tab-pane fade" id="nav-map" role="tabpanel" aria-labelledby="nav-map-tab">

             <!--The div element for the map -->
             <div id="map"></div>
             <br>

           </div>
           <div class="tab-pane fade" id="nav-budget" role="tabpanel" aria-labelledby="nav-budget-tab">

             <!-- Total Budget Expense -->
             <div class="card">
                <h5 class="card-header">
                  Total Budget Expense
                </h5>
                <div class="card-body table-responsive">

                  <!-- pie chart -->
                  <center>
                    <canvas id="budgetChart" width="400" height="400" style="max-height: 400px; max-width: 400px"></canvas>
                  </center>

                  @if (property_exists($typebudget, 'detail'))
                    <br><br>

                    <!-- table -->
                    <table class="table">
                     <tbody>
                       @foreach ($typebudget->detail as $budget)
                         <tr>
                           <th scope="row">{{ $budget->budget_type }}</th>
                           <td>{{ $typebudget->currency }} {{ $budget->totalBudget }}</td>
                         </tr>
                        @endforeach
                       </tbody>
                     </table>
                   @endif

                </div>
              </div>

              <br>

             <!-- Daily Budget Expense -->
             <div class="card">
                <h5 class="card-header">
                  Daily Budget Expense
                </h5>
                <div class="card-body table-responsive">
                  @if (property_exists($dailybudget, 'detail'))
                    <table class="table">
                     <tbody>
                       @foreach ($dailybudget->detail as $budget)
                         <tr>
                           <th scope="row">{{ $budget->day }}</th>
                           <td>{{ $dailybudget->currency }} {{ $budget->totalBudget }}</td>
                         </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                       <tr class="thead-light">
                         <th scope="col">Grand Total</th>
                         <th scope="col">{{ $dailybudget->currency }} {{ $dailybudget->grandTotal }}</th>
                       </tr>
                     </tfoot>
                    </table>
                 @else
                   <p align="center"><i>No data available.</i></p>
                 @endif

                </div>
              </div>


           </div>
           <div class="tab-pane fade" id="nav-comments" role="tabpanel" aria-labelledby="nav-comments-tab">

             @foreach ($comments->comments as $comment)
               <div class="media comment-box">
                   <div class="media-left">
                       <a href="#">
                           @if ($comment->user->avatar_url != null && $comment->user->avatar_url != "")
                             <img class="img-responsive user-photo rounded-circle" src="{{ $comment->user->avatar_url }}">
                           @else
                             <img class="img-responsive user-photo rounded-circle" src="{{ asset('images/icon/avatar.png') }}">
                           @endif
                       </a>
                   </div>
                   <div class="media-body">
                       <h5 class="media-heading">
                           <a href="/user/{{ $comment->user->username }}">{{ $comment->user->name }}</a>
                           <small class="text-muted">
                             {{ "@".$comment->user->username }}
                             &bull;
                             {{ date_format(date_create($comment->created_at),"d/m/Y g:i a") }}
                           </small>
                       </h5>
                       <p>{{ $comment->message }}</p>
                   </div>
               </div>
             @endforeach

           </div>
         </div>

     </div>
     <br><br>

    <!-- Jquery JS-->
    <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS -->
    <script src="{{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chartjs/Chartjs-center-text-plugin.js') }}"></script>
    <script src="{{ asset('vendor/lightbox2/dist/js/lightbox.min.js') }}"></script>

    <script>
    // Auto launch BackPack Track Android App, Android deeplinking
    function launchApp() {
      var itId = <?php echo $data->id; ?>;
      var itTitle = "<?php echo $data->title; ?>";
      var itUserId = <?php echo $data->user_id; ?>;
      window.location.replace('backpacktrack://itinerary?itinerary_id='+itId+'&itinerary_title='+itTitle+'&itinerary_user_id='+itUserId);
    }

    // ----------- Google MAP ----------
    // Initialize and add the map
    function initMap() {
      // get coordinates json from php into javascript
      var coordinates = <?php echo json_encode($coordinates); ?>;
      // only init map if there are coordinates
      if(coordinates.length > 0) {
        var map;
        var mapOptions = {
            mapTypeId: 'roadmap',
            zoom: 12,
            center: new google.maps.LatLng(coordinates[0]['lat'], coordinates[0]['lng']) // zoom to first marker
        };

        // Display a map on the page
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        map.setTilt(45);

        // Info Window Content
        var infoWindowContent = new Array();
        var flightPlanCoordinates = new Array(); // coordinate for polylines
        for( i = 0; i < coordinates.length; i++ ) {
          infoWindowContent[i] = "<h4>"+coordinates[i]['place_name']+"</h4>" +
                                  "<p>"+coordinates[i]['activity']+"</p>" +
                                  "<div class='text-center'><a href='https://www.google.com/maps/dir/"+coordinates[i]['lat']+","+coordinates[i]['lng']+"/' target='_blank' class='btn btn-primary btn-sm'>Get Direction</a></div>";
          flightPlanCoordinates[i] = new google.maps.LatLng(coordinates[i]['lat'], coordinates[i]['lng']);
        }
        var infoWindow = new google.maps.InfoWindow(), marker, i;

        // Loop through our array of markers & place each one on the map
        for( i = 0; i < coordinates.length; i++ ) {
          var place_name = coordinates[i]['place_name'];
          var activity = coordinates[i]['activity'];
          var lat = coordinates[i]['lat'];
          var lng = coordinates[i]['lng'];
          var position = new google.maps.LatLng(lat, lng);
          marker = new google.maps.Marker({
              position: position,
              map: map,
              title: place_name
          });

          // Allow each marker to have an info window
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i]);
                infoWindow.open(map, marker);
            }
          })(marker, i));
        }

        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#000000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);

      } else {
        $("#map").append("<p align='center'><i>No map data available.</i></p>");
      }
    }

    // --------- PIE CHART ----------
    // assign chart data and colors
    var typebudget = new Array();
    <?php
      if(property_exists($typebudget, 'detail')) {
        ?>
          typebudget = <?php echo json_encode($typebudget->detail); ?>;
        <?php
      }
    ?>
    var labels = new Array();
    var chartData = new Array();
    var colors = new Array();
    var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
         };

    for(i = 0; i < typebudget.length; i++) {
      labels[i] = typebudget[i]['budget_type'];
      chartData[i] = typebudget[i]['totalBudget'];
      colors[i] = dynamicColors();
    }

    var ctx = $("#budgetChart");
    //ctx.attr('height',200);
    var data = {
  		"labels": labels,
  		"datasets": [{
  			"label": "Percentage for each budget types",
  			"data": chartData,
  			"backgroundColor": colors
  		}]
  	};
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            elements: {
                center: {
                text: 'Percentage for each budget types',
                //color: '#36A2EB', //Default black
                fontStyle: 'Helvetica', //Default Arial
                sidePadding: 15 //Default 20 (as a percentage)
              }
            },
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  var dataset = data.datasets[tooltipItem.datasetIndex];
                  var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                  var total = meta.total;
                  var currentValue = dataset.data[tooltipItem.index];
                  var percentage = parseFloat((currentValue/total*100).toFixed(1));
                  return ' ' + percentage + '%';
                },
                title: function(tooltipItem, data) {
                  return data.labels[tooltipItem[0].index];
                }
              }
            }
        }
    });
    </script>

    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_lyCrDevPMnD_2TfcXRS8i60HRPQ1IM8&callback=initMap">
    </script>
  </body>
</html>
