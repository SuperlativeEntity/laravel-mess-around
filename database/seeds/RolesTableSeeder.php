<?php

use Illuminate\Database\Seeder;

// php artisan db:seed --class=RolesTableSeeder
// ,"admin.user.module":true
class RolesTableSeeder extends Seeder
{
    protected $table            = 'roles';
    protected $userAdminSlug    = 'admin';
    protected $claimantSlug     = 'claimant';
    protected $ownerSlug        = 'owner';
    protected $shareholderSlug  = 'shareholder';
    protected $childSlug        = 'child';
    protected $otherSlug        = 'other';

    public function run()
    {
        DB::table($this->table)->truncate();

        // order of role creation is important!

        Sentinel::getRoleRepository()->createModel()->create(['name' => 'System Administrator','slug' => $this->userAdminSlug]);

        $userAdminRole  = Sentinel::findRoleBySlug($this->userAdminSlug);

        $userAdminRole->permissions =
        [
            'index'                                         => true, // dashboard

            // campaign permissions
            'admin.campaign.module'                         => true, // module
            'admin.campaign.index'                          => true, // grid
            'admin.campaign.list'                           => true, // grid data
            'admin.campaign.create'                         => true, // create page
            'admin.campaign.store'                          => true, // create action
            'admin.campaign.index.html'                     => true, // create html
            'admin.campaign.show'                           => true, // view campaign
            'admin.campaign.modify'                         => true, // select campaign to edit
            'admin.campaign.update'                         => true, // update action
            'admin.campaign.contacts'                       => true, // select campaign contacts
            'admin.campaign.cleanup_contacts'               => true, // cleanup campaign contacts
            'admin.campaign.sms_message'                    => true, // capture sms message
            'admin.campaign.cleanup_sms_message'            => true, // clean and set sms message

            // user permissions
            'admin.user.module'                             => true, // module
            'admin.user.index'                              => true, // grid
            'admin.user.list'                               => true, // grid data
            'admin.user.create'                             => true, // create page
            'admin.user.store'                              => true, // create action
            'admin.user.index.html'                         => true, // create html
            'admin.user.show'                               => true, // view user
            'admin.user.modify'                             => true, // select user to edit
            'admin.user.update'                             => true, // update action
            'admin.user.deactivate'                         => true, // deactivate user
            'admin.user.assign_roles'                       => true, // assign user roles
            'admin.role.list'                               => true, // get a list of roles
            'admin.role.filtered.list'                      => true, // get a list of roles (filtered)

            // organisation permissions
            'admin.organisation.module'                     => true, // module
            'admin.organisation.index'                      => true, // grid
            'admin.organisation.list'                       => true, // grid data (paginated)
            'admin.organisation.create'                     => true, // create page
            'admin.organisation.store'                      => true, // create action
            'admin.organisation.index.html'                 => true, // create html
            'admin.organisation.show'                       => true, // view organisation
            'admin.organisation.modify'                     => true, // select organisation to edit
            'admin.organisation.update'                     => true, // update action
            'admin.organisation.all'                        => true, // list of all organisations
            'admin.organisation.hierarchy'                  => true, // list organisation hierarchy
            'admin.organisation.orphans'                    => true, // list of organisations with no parents or children
            'admin.organisation.recent'                     => true, // list of organisations that were recently created (defaults to last 5 entries)
            'admin.organisation.record'                     => true, // get a specific organisation (JSON)

            // individual permissions (organisation tab)
            'admin.organisation.individual.module'          => true, // sub-module
            'admin.organisation.individual.store'           => true, // create individual
            'admin.organisation.individual.update'          => true, // update individual
            'admin.organisation.individual.link'            => true, // link individual
            'admin.organisation.individual.unlink'          => true, // unlink individual
            'admin.organisation.individual.list'            => true, // list of individuals
            'admin.organisation.individual.record'          => true, // get single individual record
            'admin.organisation.individual.role_ids'        => true, // get list of role ids e.g. 1,3,5
            'admin.organisation.individual.building_ids'    => true, // get list of building ids e.g. 1,3,5

            // building permissions (organisation tab)
            'admin.organisation.building.module'            => true,  // sub-module
            'admin.organisation.building.store'             => true,  // create building
            'admin.organisation.building.update'            => true,  // update building
            'admin.organisation.building.modify'            => true,  // update view
            'admin.organisation.building.list'              => true,  // list of buildings - For Grid
            'admin.organisation.building.collection'        => true,  // collection of buildings (JSON) - For Drop Down
            'admin.organisation.building.collection.count'  => true,  // count how many buildings an organisation has
            'admin.organisation.building.record'            => true,  // get single building record
            'admin.organisation.building.generate'          => true,  // generate buildings

            // individuals (independent of organisation)
            'admin.individual.module'                       => true,  // module
            'admin.individual.index'                        => true,  // grid view
            'admin.individual.index.html'                   => true,  // grid html
            'admin.individual.list'                         => true,  // list of individuals
            'admin.individual.create'                       => true,  // create individual view
            'admin.individual.store'                        => true,  // create individual action
            'admin.individual.modify'                       => true,  // select individual to modify
            'admin.individual.update'                       => true,  // update individual
            'admin.individual.relations'                    => true,  // tab displaying a list of organisations linked to the individuals
            'admin.individual.relations.update'             => true,  // update roles and / or buildings for a specific organisation
            'admin.individual.account.create'               => true,  // create a user account for an individual
            'admin.individual.organisations'                => true,  // get a list of organisations that the individual is linked to
            'admin.individual.organisations_no_member'      => true,  // get a list of organisations that the individual not a member of
            'admin.individual.organisation.link'            => true,  // link individual as a member to one or more organisations

            // individual notes
            'admin.individual.note.module'                  => true,
            'admin.individual.note.store'                   => true,
            'admin.individual.note.update'                  => true,
            'admin.individual.note.manage'                  => true,
            'admin.individual.note.record'                  => true,
            'admin.individual.note.list'                    => true,

            'admin.organisation.service_provider.module'    => true,

            // organisation documents
            'admin.organisation.document.module'            => true,
            'admin.organisation.document.record'            => true,
            'admin.organisation.document.store'             => true,
            'admin.organisation.document.update'            => true,
            'admin.organisation.document.list'              => true,
            'admin.organisation.document.download'          => true,
        ];

        $userAdminRole->save();

        Sentinel::getRoleRepository()->createModel()->create(['name' => 'Claimant','slug' => $this->claimantSlug]);
        Sentinel::getRoleRepository()->createModel()->create(['name' => 'Owner','slug' => $this->ownerSlug]);
        Sentinel::getRoleRepository()->createModel()->create(['name' => 'Shareholder','slug' => $this->shareholderSlug]);
        Sentinel::getRoleRepository()->createModel()->create(['name' => 'Child','slug' => $this->childSlug]);
        Sentinel::getRoleRepository()->createModel()->create(['name' => 'Other','slug' => $this->otherSlug]);
    }
}
