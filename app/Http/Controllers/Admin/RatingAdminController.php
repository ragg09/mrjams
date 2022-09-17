<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_as_clinic;
use App\Models\User_as_customer;
use App\Models\User;
use App\Models\Ratings as ModelRating;

class RatingAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalRating = ModelRating::where('users_id_ratee', '=', 1)->avg('rating');
        round($totalRating, 2);

        $rating = ModelRating::where('users_id_ratee', '=', 1)->get();

        foreach ($rating as $key) {
            $user = User::where('id', '=', $key->users_id_rater)->first();
            if (!is_null($user->role)) {
                if ($user->role == 'customer') {
                    $data = User_as_customer::where('users_id', '=', $user->id)->first();
                    $name = $data->fname;
                } else {
                    $data = User_as_clinic::where('users_id', '=', $user->id)->first();
                    $name = $data->name;
                }
                $allRating[] = (object) array(
                    "id" => $key->id,
                    "name" => $name,
                    "comment" => $key->comment,
                    "rating" => $key->rating,
                    "role" => $user->role,
                );
            }
            // echo $user;
            // echo '<br><br>';
        }

        // echo $rating;

        // return $allRating;

        return view('adminViews.ratingAdmin', ['totalRating' => $totalRating, 'allRating' => $allRating]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
