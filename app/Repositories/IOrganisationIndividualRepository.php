<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests\StoreIndividualPostRequest;
use App\Http\Requests\UpdateIndividualPostRequest;
use App\Http\Requests\LinkIndividualPostRequest;
use App\Http\Requests\UnlinkIndividualPostRequest;
use App\Http\Requests\UpdateIndividualRelationsPostRequest;

interface IOrganisationIndividualRepository
{
    public function findById($individual_id);
    public function findByFieldValue($field,$value);
    public function create(StoreIndividualPostRequest $request);
    public function update(UpdateIndividualPostRequest $request);
    public function link(LinkIndividualPostRequest $request);
    public function unlink(UnlinkIndividualPostRequest $request);
    public function getOrganisationIndividuals($id,Request $request);
    public function getIndividualOrganisations($id,Request $request);
    public function getBuildingIdsByOrganisation($organisation_id,$individual_id);
    public function getRoleIdsByOrganisation($organisation_id,$individual_id);
    public function updateRelations(UpdateIndividualRelationsPostRequest $request);
    public function nonMemberOrganisations($individual_id);
    public function linkIndividualToOrganisations(Request $request);
}