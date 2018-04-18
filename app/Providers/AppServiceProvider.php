<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('id_number', 'App\Validators\SouthAfricanIdentityNumberValidator@validate');
        Validator::extend('mobile_prefix', 'App\Validators\MobilePrefixValidator@validate');
        Validator::extend('company_reg_no', 'App\Validators\CompanyRegistrationNumberValidator@validate');
        Validator::extend('recaptcha', 'App\Validators\ReCaptchaValidator@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\ICampaignRepository', 'App\Repositories\CampaignRepository');
        $this->app->bind('App\Repositories\ISmsRepository', 'App\Repositories\SmsRepository');

        $this->app->bind('App\Repositories\IUserRepository', 'App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\IRoleRepository', 'App\Repositories\RoleRepository');
        $this->app->bind('App\Repositories\IDropDownRepository', 'App\Repositories\DropDownRepository');
        $this->app->bind('App\Repositories\IActivityRepository', 'App\Repositories\ActivityRepository');
        $this->app->bind('App\Helpers\IDatabaseHelper', 'App\Helpers\MySQLDatabaseHelper');

        $this->app->bind('App\Repositories\IOrganisationRepository', 'App\Repositories\OrganisationRepository');
        $this->app->bind('App\Repositories\IBuildingRepository', 'App\Repositories\BuildingRepository');
        $this->app->bind('App\Repositories\IDocumentRepository', 'App\Repositories\DocumentRepository');
        $this->app->bind('App\Repositories\IIndividualRepository', 'App\Repositories\IndividualRepository');
        $this->app->bind('App\Repositories\IIndividualNotesRepository', 'App\Repositories\IndividualNotesRepository');
        $this->app->bind('App\Repositories\IOrganisationIndividualRepository', 'App\Repositories\OrganisationIndividualRepository');

        if ($this->app->environment('local', 'testing'))
            $this->app->register(DuskServiceProvider::class);
    }
}
