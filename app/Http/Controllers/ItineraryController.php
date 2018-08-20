<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Validator;

use App\Http\Controllers\APIController;
use App\Itinerary;
use App\Activity;
use App\Country;

class ItineraryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    // List all itineraries
    public function index()
    {
        $APIobj = new APIController();
        $itineraries = $APIobj->listItineraries();

        return view('itineraries', ['itineraries' => collect($itineraries)]);
    }

    // Delete an itinerary
    public function destroy(Request $request)
    {
        $APIobj = new APIController();
        $APIobj->deleteItinerary($request);

        return redirect('itineraries')->with('deletestatus', 'Delete itinerary ID: '.$request->itinerary_id.' success!');
    }

    // View activitites of an itinerary
    public function view(Request $request)
    {
        // get activities
        $APIobj = new APIController();
        $result = $APIobj->viewActivities($request);

        // get total budget
        $totalbudget = json_decode($APIobj->getTotalBudget($request), true)['totalbudget'];

        return view('activities', ['data' => json_decode($result, true), 'totalbudget' => $totalbudget]);
    }

    // Edit an itinerary
    public function edit(Request $request)
    {
        $APIobj = new APIController();

        $itinerary = $APIobj->viewItinerary($request);
        $countries = $APIobj->listCountries();

        return view('edit_itinerary', ['itinerary' => $itinerary, 'countries' => $countries]);
    }

    // Update itinerary data
    public function update(Request $request)
    {
        $rules = array(
          'title' => 'required|string|max:255',
          'country_id' => 'required|numeric',
          'user_id' => 'required|numeric',
          'itinerary_id' => 'required|numeric',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $errors = $validator->errors();
            return redirect('itineraries/'.$request->itinerary_id.'/edit')->with('errors', $errors);
        }
        else
        {
            $itinerary_id = $request->itinerary_id;
            $itinerary = Itinerary::find($itinerary_id);

            $itinerary->title = $request->title;
            $itinerary->country_id = $request->country_id;
            $itinerary->user_id = $request->user_id;

            $itinerary->save();

            return redirect('itineraries/'.$request->itinerary_id.'/edit')->with('success', "Itinerary updated!");
        }
    }
}
