<?php

use Illuminate\Database\Migrations\Migration;

class CreateVwCampaigns extends Migration
{
    protected $table = 'vw_campaigns';

    public function up()
    {
        if (!Schema::hasTable($this->table))
        {
            DB::statement('CREATE VIEW `vw_campaigns` AS
            SELECT
            campaign_types.name as campaign_type,
            campaign_categories.name as campaign_category,
            created_by_user.email as created_by_user,
            updated_by_user.email as updated_by_user,
            campaigns.name,campaigns.message,
            campaigns.id,campaigns.campaign_type_id,campaigns.campaign_category_id,
            campaigns.start_date,campaigns.created_by,campaigns.updated_by,campaigns.created_at,campaigns.updated_at,campaigns.deleted_at
            FROM campaigns
            LEFT JOIN campaign_types ON campaigns.campaign_type_id = campaign_types.id
            LEFT JOIN campaign_categories ON campaigns.campaign_category_id = campaign_categories.id
            LEFT JOIN users as created_by_user ON campaigns.created_by = created_by_user.id
            LEFT JOIN users as updated_by_user ON campaigns.updated_by = updated_by_user.id
            ORDER BY campaigns.start_date DESC');
        }

    }

    public function down()
    {
        if (Schema::hasTable($this->table))
            DB::statement('DROP VIEW vw_campaigns');
    }
}
