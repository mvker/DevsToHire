<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FreelancerController;
use App\Models\Company;
use App\Models\Freelancer;
use App\Models\Location;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use RuntimeException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        if ($data['account-type'] === 'freelancer') {
            return Validator::make($data, [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users'],
                'account-type' => ['required'],
                'password' => [
                    'required_with:password_confirmation',
                    'string',
                    Password::min(8)->letters()->mixedCase()->numbers()
                ],
                'country' => ['required'],
                'hourlyRate' => ['required'],
                'avatar-upload' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,svg', 'max:5192'],
            ]);
        }

        // If account type is Company
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'account-type' => ['required'],
            'password' => [
                'required_with:password_confirmation',
                'string',
                Password::min(8)->letters()->mixedCase()->numbers()
            ],
            'country' => ['required'],
            'avatar-upload' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,svg', 'max:5192'],
            'company-name' => ['sometimes', 'string', 'min:0', 'max:255', 'unique:companies,name'],
            'company-description' => ['sometimes', 'min: 0', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     */
    protected function create(array $data)
    {
        // 2 = Freelancer / 3 = Company
        $data = $this->setRoleId($data);
        $data = $this->setLocationId($data);

        $avatarPicture = $this->checkIfAvatarWasUploaded(app('request'));

        if ($avatarPicture[0] === true) {
            $user = User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'email_verified_at' => null,
                'password' => Hash::make($data['password']),
                'role_id' => $data['account-type'],
                'location_id' => $data['country'],
                'created_at' => Carbon::now(),
                'updated_at' => null,
                'pic_url' => $avatarPicture[1],
                'remember_token' => $avatarPicture[2]->toString(),
            ]);

            $userId = $this->retrieveUserId($data);

            if ($data['account-type'] === 2) {
                $freelancer = [
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'description' => $data['description'],
                    'pic_url' => $user->pic_url,
                    'hourly_rate' => $data['hourlyRate'],
                    'verified' => 0,
                    'CV_url' => null,
                    'user_id' => $userId,
                    'success_rate' => 0,
                    'location_id' => $user->location_id,
                    'joined_at' => Carbon::now(),
                    'category_id' => 1
                ];

                DB::table('freelancers')->insert($freelancer);

                // Fill freelancer_id field in user info
                $freelancerId = Freelancer::where('user_id', $userId)->first()->id;

                User::where('id', $userId)
                    ->update([
                        'freelancer_id' => $freelancerId
                    ]);
            }

            if ($data['account-type'] === 3) {
                $company = [
                    'name'          => $data['company-name'],
                    'slug'          => Str::slug($data['company-name']),
                    'speciality'    => $data['company-speciality'],
                    'description'   => $data['company-description'],
                    'verified'      => 0,
                    'pic_url'       => 'company-logo-placeholder-alt.png',
                    'user_id'       => $userId,
                    'location_id'   => $user->location_id
                ];

                DB::table('companies')->insert($company);

                $companyId = Company::where('user_id', $userId)->first()->id;

                User::where('id', $userId)
                    ->update([
                        'company_id' => $companyId
                    ]);
            }

            return $user;
        }

        return back()->with('error', 'An error occurred during the registration process');
    }

    /**
     * setRoleId method.
     *
     * Replaces the account type string by its id in the DDB
     *
     * @param array $data
     *
     * @return array
     */
    protected function setRoleId(array $data): array
    {
        $data['account-type'] = $data['account-type'] === 'freelancer'
            ? 2
            : 3;

        return $data;
    }

    /**
     * setLocationId method.
     *
     * Replaces the name of the country by its id in the DDB.
     *
     * @param array $data
     *
     * @return array
     */
    protected function setLocationId(array $data): array
    {
        $data['country'] = DB::table('locations')
            ->select('id')
            ->where('country_code', '=', $data['country'])
            ->first()
            ->id;

        return $data;
    }

    /**
     * retrieveUserId method.
     *
     * Fetches the id of the newly created user.
     *
     * @param array $data
     *
     * @return mixed
     */
    protected function retrieveUserId(array $data)
    {
        return DB::table('users as u')
            ->select('u.id')
            ->where('u.email', '=', $data['email'])
            ->where('role_id', '=', $data['account-type'])
            ->first()
            ->id;
    }

    /**
     * checkIfAvatarWasUploaded method.
     *
     * Checks if the user uploaded a profile pic during registration.
     * Resizes and stores the profile picture if the check was successful.
     *
     * @param Request $request Data from the registration form
     *
     * @return bool|array false if no avatar was uploaded, an array if there was.
     */
    protected function checkIfAvatarWasUploaded(Request $request)
    {
        // Generating an unique UUID for the folder's name
        $userUUID = Uuid::fromDateTime(Carbon::now());

        /**
         * Creating the user's avatar dir
         *
         * No need to check if dir exists or not.
         * The user always creates their dir when he finishes the registration process.
         */
        $directoriesCreated = $this->createPictureDirectories($userUUID);

        if ($request->hasfile('avatar-upload')) {
            $avatar = $request->file('avatar-upload');
            $filename = Uuid::fromDateTime(Carbon::now())
                . '.'
                . $avatar->getClientOriginalExtension();

            if ($directoriesCreated) {
                // Creating a 70x70 pic and uploads it
                Image::make($avatar)
                    ->resize(70, 70)
                    ->save(public_path('/images/user/' . $userUUID->toString() . '/avatars/big/' . $filename));

                // Creating a 42x42 pic and uploads it
                Image::make($avatar)
                    ->resize(42, 42)
                    ->save(public_path('/images/user/' . $userUUID->toString() . '/avatars/small/' . $filename));
            }

            return [true, $filename, $userUUID];
        }
        // Case when user doesn't upload pic
        if ($directoriesCreated) {
            $placeholderPicPath = public_path('images/user/user-avatar-placeholder.png');

            // Creating a 70x70 pic and uploads it
            Image::make($placeholderPicPath)
                ->resize(70, 70)
                ->save(public_path('images/user/' . $userUUID->toString() . '/avatars/big/' . 'user-avatar-placeholder.png'));

            // Creating a 42x42 pic and uploads it
            Image::make($placeholderPicPath)
                ->resize(42, 42)
                ->save(public_path('images/user/' . $userUUID->toString() . '/avatars/small/' . 'user-avatar-placeholder.png'));

            return [true, 'user-avatar-placeholder.png', $userUUID];
        }

        return false;
    }

    /**
     * createPictureDirectories method.
     *
     * Handles the creation of the directories used to store avatar pictures during the registration process
     *
     * @param $UUID
     *
     * @return bool
     * @throws RuntimeException
     */
    protected function createPictureDirectories($UUID): bool
    {
        $userDirPath = $_SERVER['DOCUMENT_ROOT'] . '/images/user/' . $UUID->toString();
        $avatarDirPath = $_SERVER['DOCUMENT_ROOT'] . '/images/user/' . $UUID->toString() . '/avatars/';
        $bigPicPath = $_SERVER['DOCUMENT_ROOT'] . '/images/user/' . $UUID->toString() . '/avatars/big/';
        $smallPicPath = $_SERVER['DOCUMENT_ROOT'] . '/images/user/' . $UUID->toString() . '/avatars/small/';

        if (!mkdir($userDirPath, 0755) && !is_dir($userDirPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $userDirPath));
        }
        if (!mkdir($avatarDirPath, 0755) && !is_dir($avatarDirPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $avatarDirPath));
        }
        if (!mkdir($bigPicPath, 0755) && !is_dir($bigPicPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $bigPicPath));
        }
        if (!mkdir($smallPicPath, 0755) && !is_dir($smallPicPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $smallPicPath));
        }

        return true;
    }
}
