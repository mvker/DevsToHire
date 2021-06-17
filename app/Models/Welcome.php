<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Welcome extends Model
{
    use HasFactory;

    /**
     * getFeaturedJobs method.
     * Retrieves a random set of featured jobs.
     * @return Collection
     */
    public static function getFeaturedJobs(): Collection
    {
        $featuredJobs = DB::table('jobs as jo')
            ->select('jo.id',
                'jo.title',
                DB::raw('DATEDIFF(jo.created_at, NOW()) as date_posted'),
                'jo.type',
                'co.name as company',
                'co.pic_url as pic',
                'lo.country_name as country')
            ->join('companies as co', 'co.id', '=', 'jo.id')
            ->join('locations as lo', 'co.location_id', '=', 'lo.id')
            ->where('featured', '=', 1)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return self::removeDashesFromDates($featuredJobs);
    }

    /**
     * getFeaturedFreelancers method.
     * Retrieves a random set of featured freelancers.
     * @return Collection
     */
    public static function getFeaturedFreelancers(): Collection
    {
        return DB::table('premium_users as pu')
            ->select(DB::raw('DISTINCT fr.id'),
                'fr.pic_url',
                DB::raw("CONCAT(u.firstname, ' ', u.lastname) as fullName"),
                'lo.country_code',
                'lo.country_name',
                'fr.hourly_rate',
                'fr.success_rate')
            ->join('users as u', 'u.id', '=', 'pu.user_id')
            ->join('freelancers as fr', 'fr.user_id', '=', 'u.id')
            ->join('locations as lo', 'lo.id', '=', 'u.location_id')
            ->where('fr.verified', '=', 1)
            ->inRandomOrder()
            ->limit(6)
            ->get();
    }

    /**
     * removeDashesFromDates method.
     * Removes the dash from the date generated by the DATEDIFF() func. from MYSQL.
     * @param Collection $featuredJobs
     * @return Collection
     */
    public static function removeDashesFromDates(Collection $featuredJobs): Collection
    {
        foreach ($featuredJobs as $job) {
            $job->date_posted = str_replace('-', '', $job->date_posted);
        }

        return $featuredJobs;
    }
}