Echo.channel('organisation.update.1')
.listen('.App.Events.Organisation.OrganisationUpdatedEvent', (e) =>
{
    console.log(e.organisation);
});