<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Location;
use App\Models\Dashboard;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\ModifyDashboardSettingsRequest;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Application|Factory|View
     */
    public function edit()
    {
        $user = User::where('id', Auth::id())->first();
        $user->settings = Dashboard::getUserSettings($user);
        $categories = Category::all('id', 'name');
        $countries = Location::all('id', 'country_name');

        return view('dashboard.settings', compact([
            'user',
            'categories',
            'countries'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ModifyDashboardSettingsRequest $request
     *
     * @return string
     */
    public function update(ModifyDashboardSettingsRequest $request)
    {
        $user = User::where('id', Auth::id())->first();
        Dashboard::checkAndUpdateSettings($request->validated(), $user);

        return redirect()->route('dashboard.settings');
    }

    public function createJob()
    {
        return view('dashboard.post-job');
    }

    public function createTask()
    {
        $categories = Category::all('id', 'name');
        $locations  = Location::all('id', 'country_name');

        return view('dashboard.post-task', compact([
            'categories',
            'locations'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function reviews()
    {
        return view('dashboard.reviews');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function messages()
    {
        return view('dashboard.messages');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function bookmarks()
    {
        return view('dashboard.bookmarks');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function candidates()
    {
        return view('dashboard.manage-candidates');
    }
}