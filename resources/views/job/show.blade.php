@extends('layouts.app')
@section('content')
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Titlebar
        ================================================== -->
        <div class="single-page-header" data-background-image="{{ asset('images/job/single-job.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="single-page-header-inner">
                            <div class="left-side">
                                <div class="header-image">
                                    <a href="{{ route('company.show', [$job->company_id, $job->company_slug]) }}">
                                        <img src="{{ asset('images/companies/' . $job->pic_url) }}" alt="Employer pic">
                                    </a>
                                </div>
                                <div class="header-details">
                                    <h3>{{ $job->title }}</h3>
                                    <h5>About the Employer</h5>
                                    <ul>
                                        <li>
                                            <a href="{{ route('company.show', [$job->company_id, $job->company_slug]) }}">
                                                <i class="icon-material-outline-business"></i>
                                                {{ $job->name }}
                                            </a>
                                        </li>
                                        @if(!is_null($companyRating->rating))
                                            <li>
                                                <div class="star-rating" data-rating="{{ round($companyRating->rating) }}"></div>
                                            </li>
                                        @else
                                            <li>
                                                <span class="company-not-rated">This company hasn't been rated yet</span>
                                            </li>
                                        @endif
                                        <li>
                                            <img class="flag"
                                                 src="{{ asset('images/flags/' . strtolower($job->country_code) . '.svg') }}"
                                                 alt="Flag">
                                            {{ $job->country_name }}
                                        </li>
                                        @if($job->verified)
                                            <li>
                                                <div class="verified-badge-with-title">Verified</div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="right-side">
                                <div class="salary-box">
                                    <div class="salary-type">Annual Salary</div>
                                    <div
                                            class="salary-amount">{{ $job->salary_low . ' € - ' . $job->salary_high . ' €' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <!-- Content -->
                <div class="col-xl-8 col-lg-8 content-right-offset">
                    <div class="single-page-section">
                        <h3 class="margin-bottom-25">Job Description</h3>
                        <p>
                            {{ $job->description }}
                        </p>

                    </div>

                    <div class="single-page-section">
                        <h3 class="margin-bottom-25">Similar Jobs</h3>

                        <!-- Listings Container -->
                        <div class="listings-container grid-layout">
                        @foreach($relatedJobs as $related)
                            <!-- Job Listing -->
                                <a href="{{ route('job.show', [$related->id, $related->slug]) }}" class="job-listing">

                                    <!-- Job Listing Details -->
                                    <div class="job-listing-details">
                                        <!-- Logo -->
                                        <div class="job-listing-company-logo">
                                            <img src="{{ asset('images/companies/' . $related->pic_url) }}"
                                                 alt="Related Job Employer">
                                        </div>

                                        <!-- Details -->
                                        <div class="job-listing-description">
                                            <h4 class="job-listing-company">{{ $related->name }}</h4>
                                            <h3 class="job-listing-title">{{ $related->title }}</h3>
                                        </div>
                                    </div>

                                    <!-- Job Listing Footer -->
                                    <div class="job-listing-footer">
                                        <ul>
                                            <li>
                                                <i class="icon-material-outline-location-on"></i>{{ $related->country_name }}
                                            </li>
                                            <li>
                                                <i class="icon-material-outline-business-center"></i>{{ $related->type }}
                                            </li>
                                            <li><i class="icon-material-outline-account-balance-wallet"></i>
                                                {{ $related->salary_low . '€ - ' . $related->salary_high . ' €' }}
                                            </li>
                                            <li>
                                                <i class="icon-material-outline-access-time"></i>{{ $related->date_posted }}
                                                days ago
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <!-- Listings Container / End -->
                    </div>
                </div>


                <!-- Sidebar -->
                <div class="col-xl-4 col-lg-4">
                    <div class="sidebar-container">
                        @if(Session::has('success'))
                            <div class="notification success closeable">
                                <p>{{ Session::get('success') }}</p>
                                <a class="close"></a>
                            </div>
                        @endif

                        @auth
                            @if(!$alreadyApplied)
                                @if(Auth::user()->role_id === 2)
                                    <a href="#small-dialog" class="apply-now-button popup-with-zoom-anim">Apply Now <i
                                                class="icon-material-outline-arrow-right-alt"></i>
                                    </a>
                                @else

                                    @if(Auth::user()->company_id === $job->companyId)
                                            <a href="{{ route('dashboard.job.manage') }}" class="apply-now-button button-sliding-icon">Manage your job offer
                                                <i class="icon-material-outline-arrow-right-alt"></i>
                                            </a>
                                    @else
                                            <a href="#" class="apply-now-button ">Only freelancers can apply to job offers.
                                            </a>
                                    @endif
                                @endif
                            @else
                                <div>
                                    <form action="{{ route('cancel.job.apply') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="freelancerId" value="{{ Auth::id() }}">
                                        <input type="hidden" name="jobId" value="{{ $job->id }}">

                                        <button class="button full-width margin-bottom-20" type="submit">Cancel your
                                            application
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                            @guest
                                <a href="{{ route('login') }}" class="apply-now-button">Register to apply to this offer
                                    <i class="icon-material-outline-arrow-right-alt"></i>
                                </a>
                            @endguest
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>
                                    <mark class="color">{{ $error }}</mark>
                                </div>
                            @endforeach
                        @endif
                    <!-- Sidebar Widget -->
                        <div class="sidebar-widget">
                            <div class="job-overview">
                                <div class="job-overview-headline">Job Summary</div>
                                <div class="job-overview-inner">
                                    <ul>
                                        <li>
                                            <i class="icon-material-outline-location-on"></i>
                                            <span>Location</span>
                                            <h5>{{ $job->country_name }}</h5>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-business-center"></i>
                                            <span>Job Type</span>
                                            <h5>{{ $job->type }}</h5>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-home"></i>
                                            <span>Remote</span>
                                            <h5>{{ $job->remote }}</h5>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-local-atm"></i>
                                            <span>Yearly Salary</span>
                                            <h5>{{ $job->salary_low . '€ - ' . $job->salary_high . '€' }}</h5>
                                        </li>
                                        <li>
                                            <i class="icon-material-outline-access-time"></i>
                                            <span>Date Posted</span>
                                            <h5>{{ $job->date_posted }} days ago</h5>
                                        </li>
                                        <li>
                                            <i class="icon-line-awesome-certificate"></i>
                                            <span>Field</span>
                                            <h5>{{ $category->name }}</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar Widget -->
                        <div class="sidebar-widget">
                            <h3>Bookmark this job</h3>

                            <!-- Bookmark Button -->
                            <button class="bookmark-button margin-bottom-25">
                                <span class="bookmark-icon"></span>
                                <span class="bookmark-text">Bookmark</span>
                                <span class="bookmarked-text">Bookmarked</span>
                            </button>

                            <!-- Share Buttons -->
                            <div class="share-buttons margin-top-25">
                                <div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
                                <div class="share-buttons-content">
                                    <span>Interesting? <strong>Share It!</strong></span>
                                    <ul class="share-buttons-icons">
                                        <li><a href="#" data-button-color="#3b5998" title="Share on Facebook"
                                               data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
                                        <li><a href="#" data-button-color="#1da1f2" title="Share on Twitter"
                                               data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
                                        <li><a href="#" data-button-color="#dd4b39" title="Share on Google Plus"
                                               data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a>
                                        </li>
                                        <li><a href="#" data-button-color="#0077b5" title="Share on LinkedIn"
                                               data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper / End -->
    @include('layouts.popups.applyJob')
@endsection