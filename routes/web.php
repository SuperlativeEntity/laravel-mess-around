<?php


// publicly accessible routes
Route::group(['middleware' => ['web']], function ()
{
    Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('auth/credentials', ['as' => 'auth.credentials', 'uses' => 'Auth\AuthController@postCredentials']);
    Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

    Route::get('auth/facebook', ['as' => 'auth.facebook', 'uses' => 'Auth\AuthController@redirectToProvider']);
    Route::get('auth/facebook_callback', ['as' => 'auth.facebook.callback', 'uses' => 'Auth\AuthController@handleProviderCallback']);

    Route::get('password/forgot', ['as' => 'forgot.password', 'uses' => 'Auth\PasswordController@getEmail']);
    Route::post('password/request', ['as' => 'forgot.request', 'uses' => 'Auth\PasswordController@postEmail']);

    Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@getReset']);
    Route::post('password/reset', ['as' => 'reset.request', 'uses' => 'Auth\PasswordController@postReset']);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});

Route::group(['middleware' => 'admin'], function ()
{
    Route::group(['prefix' => 'admin/campaigns'], function ()
    {
        Route::get('index', ['as' => 'admin.campaign.index', 'uses' => 'Admin\CampaignController@getIndex']);
        Route::get('index_html', ['as' => 'admin.campaign.index.html', 'uses' => 'Admin\CampaignController@getIndexHtml']);
        Route::get('list', ['as' => 'admin.campaign.list', 'uses' => 'Admin\CampaignController@getList']);
        Route::get('create', ['as' => 'admin.campaign.create', 'uses' => 'Admin\CampaignController@getCreate']);
        Route::get('modify/{id?}', ['as' => 'admin.campaign.modify', 'uses' => 'Admin\CampaignController@getModify']);
        Route::post('store', ['as' => 'admin.campaign.store', 'uses' => 'Admin\CampaignController@postStore']);
        Route::post('update', ['as' => 'admin.campaign.update', 'uses' => 'Admin\CampaignController@postUpdate']);
        Route::get('contacts', ['as' => 'admin.campaign.contacts', 'uses' => 'Admin\CampaignController@getContacts']);
        Route::post('contacts/cleanup', ['as' => 'admin.campaign.cleanup_contacts', 'uses' => 'Admin\CampaignController@postCleanupContacts']);
        Route::get('sms/message', ['as' => 'admin.campaign.sms_message', 'uses' => 'Admin\CampaignController@getSmsMessage']);
        Route::post('sms/cleanup', ['as' => 'admin.campaign.cleanup_sms_message', 'uses' => 'Admin\CampaignController@postCleanupSms']);
    });

    Route::group(['prefix' => 'admin/users'], function ()
    {
        Route::get('index', ['as' => 'admin.user.index', 'uses' => 'Admin\UserController@getIndex']);
        Route::get('index_html', ['as' => 'admin.user.index.html', 'uses' => 'Admin\UserController@getIndexHtml']);
        Route::get('list', ['as' => 'admin.user.list', 'uses' => 'Admin\UserController@getList']);
        Route::get('create', ['as' => 'admin.user.create', 'uses' => 'Admin\UserController@getCreate']);
        Route::get('modify/{id?}', ['as' => 'admin.user.modify', 'uses' => 'Admin\UserController@getModify']);
        Route::post('store', ['as' => 'admin.user.store', 'uses' => 'Admin\UserController@postStore']);
        Route::post('update', ['as' => 'admin.user.update', 'uses' => 'Admin\UserController@postUpdate']);
        Route::post('assign_roles', ['as' => 'admin.user.assign_roles', 'uses' => 'Admin\UserController@postAssignRoles']);
    });

    Route::group(['prefix' => 'admin/individuals'], function ()
    {
        Route::get('index', ['as' => 'admin.individual.index', 'uses' => 'Admin\IndividualController@getIndex']);
        Route::get('index_html', ['as' => 'admin.individual.index.html', 'uses' => 'Admin\IndividualController@getIndexHtml']);
        Route::get('list', ['as' => 'admin.individual.list', 'uses' => 'Admin\IndividualController@getList']);
        Route::get('create', ['as' => 'admin.individual.create', 'uses' => 'Admin\IndividualController@getCreate']);
        Route::post('account/create', ['as' => 'admin.individual.account.create', 'uses' => 'Admin\IndividualController@createAccount']);
        Route::post('store', ['as' => 'admin.individual.store', 'uses' => 'Admin\IndividualController@postStore']);
        Route::get('modify/{id?}', ['as' => 'admin.individual.modify', 'uses' => 'Admin\IndividualController@getModify']);
        Route::post('update', ['as' => 'admin.individual.update', 'uses' => 'Admin\IndividualController@postUpdate']);
        Route::get('relations/{id}', ['as' => 'admin.individual.relations', 'uses' => 'Admin\IndividualController@getRelations']);
        Route::post('relations_update', ['as' => 'admin.individual.relations.update', 'uses' => 'Admin\OrganisationIndividualController@updateRelations']);
        Route::post('link_organisation', ['as' => 'admin.individual.organisation.link', 'uses' => 'Admin\OrganisationIndividualController@linkIndividualToOrganisations']);
        Route::get('organisations/{id}', ['as' => 'admin.individual.organisations', 'uses' => 'Admin\OrganisationIndividualController@getIndividualOrganisations']);
        Route::get('organisations_no_member/{id}', ['as' => 'admin.individual.organisations_no_member', 'uses' => 'Admin\OrganisationIndividualController@getIndividualNonMemberOrganisations']);

        // notes
        Route::get('note/{id?}', ['as' => 'admin.individual.note.module', 'uses' => 'Admin\IndividualNoteController@getModify']);
        Route::get('note/record/{id?}', ['as' => 'admin.individual.note.record', 'uses' => 'Admin\IndividualNoteController@getRecord']);
        Route::post('note/store', ['as' => 'admin.individual.note.store', 'uses' => 'Admin\IndividualNoteController@postStore']);
        Route::post('note/update', ['as' => 'admin.individual.note.update', 'uses' => 'Admin\IndividualNoteController@postUpdate']);
        Route::get('note/list/{id?}', ['as' => 'admin.individual.note.list', 'uses' => 'Admin\IndividualNoteController@getList']);
    });

    Route::group(['prefix' => 'admin/organisations'], function ()
    {
        Route::get('index', ['as' => 'admin.organisation.index', 'uses' => 'Admin\OrganisationController@getIndex']);
        Route::get('index_html', ['as' => 'admin.organisation.index.html', 'uses' => 'Admin\OrganisationController@getIndexHtml']);
        Route::get('list', ['as' => 'admin.organisation.list', 'uses' => 'Admin\OrganisationController@getList']);
        Route::get('record/{id?}', ['as' => 'admin.organisation.record', 'uses' => 'Admin\OrganisationController@getRecord']);
        Route::get('create', ['as' => 'admin.organisation.create', 'uses' => 'Admin\OrganisationController@getCreate']);
        Route::post('store', ['as' => 'admin.organisation.store', 'uses' => 'Admin\OrganisationController@postStore']);
        Route::get('modify/{id?}', ['as' => 'admin.organisation.modify', 'uses' => 'Admin\OrganisationController@getModify']);
        Route::post('update', ['as' => 'admin.organisation.update', 'uses' => 'Admin\OrganisationController@postUpdate']);

        Route::get('orphans', ['as' => 'admin.organisation.orphans', 'uses' => 'Admin\OrganisationRelationsController@getOrphans']);
        Route::get('recent/{take?}', ['as' => 'admin.organisation.recent', 'uses' => 'Admin\OrganisationRelationsController@getRecent']);
        Route::get('all', ['as' => 'admin.organisation.all', 'uses' => 'Admin\OrganisationRelationsController@getAll']);
        Route::get('hierarchy/{id}', ['as' => 'admin.organisation.hierarchy', 'uses' => 'Admin\OrganisationRelationsController@getHierarchy']);

        // individuals tab
        Route::get('individual/{id?}', ['as' => 'admin.organisation.individual.module', 'uses' => 'Admin\OrganisationIndividualController@getModify']);
        Route::get('individual/record/{id?}', ['as' => 'admin.organisation.individual.record', 'uses' => 'Admin\OrganisationIndividualController@getRecord']);
        Route::post('individual/store', ['as' => 'admin.organisation.individual.store', 'uses' => 'Admin\OrganisationIndividualController@postStore']);
        Route::post('individual/update', ['as' => 'admin.organisation.individual.update', 'uses' => 'Admin\OrganisationIndividualController@postUpdate']);
        Route::post('individual/link', ['as' => 'admin.organisation.individual.link', 'uses' => 'Admin\OrganisationIndividualController@postLink']);
        Route::post('individual/unlink', ['as' => 'admin.organisation.individual.unlink', 'uses' => 'Admin\OrganisationIndividualController@postUnlink']);
        Route::get('individual/list/{id?}', ['as' => 'admin.organisation.individual.list', 'uses' => 'Admin\OrganisationIndividualController@getOrganisationIndividuals']);
        Route::get('individual/role_ids/{organisation_id?}/{id?}', ['as' => 'admin.organisation.individual.role_ids', 'uses' => 'Admin\IndividualRelationsController@getRoleIdsByOrganisation']);
        Route::get('individual/building_ids/{organisation_id?}/{id?}', ['as' => 'admin.organisation.individual.building_ids', 'uses' => 'Admin\IndividualRelationsController@getBuildingIdsByOrganisation']);

        // buildings tab
        Route::get('building/{id?}', ['as' => 'admin.organisation.building.module', 'uses' => 'Admin\BuildingController@getModify']);
        Route::get('building/record/{id?}', ['as' => 'admin.organisation.building.record', 'uses' => 'Admin\BuildingController@getRecord']);
        Route::post('building/store', ['as' => 'admin.organisation.building.store', 'uses' => 'Admin\BuildingController@postStore']);
        Route::post('building/update', ['as' => 'admin.organisation.building.update', 'uses' => 'Admin\BuildingController@postUpdate']);
        Route::post('building/generate', ['as' => 'admin.organisation.building.generate', 'uses' => 'Admin\BuildingController@postGenerate']);
        Route::get('building/list/{id?}', ['as' => 'admin.organisation.building.list', 'uses' => 'Admin\BuildingController@getList']);
        Route::get('building/collection/{id?}', ['as' => 'admin.organisation.building.collection', 'uses' => 'Admin\BuildingRelationsController@getByOrganisation']);
        Route::get('building/collection/count/{id?}', ['as' => 'admin.organisation.building.collection.count', 'uses' => 'Admin\BuildingRelationsController@countByOrganisation']);

        // documents tab
        Route::get('document/{id?}', ['as' => 'admin.organisation.document.module', 'uses' => 'Admin\DocumentController@getModify']);
        Route::get('document/record/{id?}', ['as' => 'admin.organisation.document.record', 'uses' => 'Admin\DocumentController@getRecord']);
        Route::post('document/store', ['as' => 'admin.organisation.document.store', 'uses' => 'Admin\DocumentController@postStore']);
        Route::post('document/update', ['as' => 'admin.organisation.document.update', 'uses' => 'Admin\DocumentController@postUpdate']);
        Route::get('document/download/{id?}', ['as' => 'admin.organisation.document.download', 'uses' => 'Admin\DocumentController@getDownload']);
        Route::get('document/list/{id?}', ['as' => 'admin.organisation.document.list', 'uses' => 'Admin\DocumentController@getList']);

        // service providers tab
        Route::get('service_provider/{id?}', ['as' => 'admin.organisation.service_provider.module', 'uses' => 'Admin\ServiceProviderController@getModify']);
    });

    Route::group(['prefix' => 'admin/roles'], function ()
    {
        Route::get('list', ['as' => 'admin.role.list', 'uses' => 'Admin\RoleController@getList']);
        Route::get('filtered_list', ['as' => 'admin.role.filtered.list', 'uses' => 'Admin\RoleController@getFilteredList']);
    });
});

Route::group(['middleware' => 'admin'], function ()
{
    Route::get('/', ['as' => 'index', 'uses' => 'LayoutController@getIndex']);
});

Route::get('admin/drop-down/list/{name}', ['as' => 'admin.drop_down.list', 'uses' => 'Admin\DropDownController@getList']);