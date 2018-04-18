<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(ProvincesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(ChoicesTableSeeder::class);
        $this->call(AddressTypesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(BuildingTypesTableSeeder::class);

        $this->call(OrganisationTypesTableSeeder::class);

        $this->call(NationalitiesTableSeeder::class);
        $this->call(ClaimRelationshipTypeTableSeeder::class);

        $this->call(CampaignCategoriesTableSeeder::class);
        $this->call(CampaignTypesTableSeeder::class);
        $this->call(NoteTypesTableSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
