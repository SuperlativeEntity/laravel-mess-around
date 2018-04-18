**Background**

Busy messing around conceptually with Laravel regarding a legacy app that needs to be rewritten.
I'm here to learn from the community and provide a useful tool to get a project up and running.

**Mildly Interesting**

Managed to get pjax working, which makes the views load pretty quickly.

Have a look at in the browser developer tools -> network section

After a menu option is selected a second time, a minimal amount of assets are loaded Hence I don't minify any assets due to the layout not been reloaded

Additional tabs only load their content upon request

**What I think could be much better**

Rather use  
https://github.com/spatie/laravel-permission
https://github.com/santigarcor/laratrust

Instead of

https://github.com/cartalyst/sentinel (seems outdated )

*Implement*
https://laravelcollective.com/docs/master/annotations
Routes seem to get out of hand

https://github.com/yajra/laravel-datatables
Instead of Kendo UI

Change gulp / bower stuff to webpack
Move models to their own folder.
Implement Community Suggestions Implement PHP 7 syntax Implement better Laravel methodologies (e.g. relationships, scopes, helpers etc.)
Add Tests (Unit / Dusk)

**Installation**
 - copy .env.example as .env 
 - composer install 
 - php artisan key:generate
 - create mysql database
 - change database settings 
 - php artisan migrate --seed
 - php artisan ide-helper:generate

username: demo@example.com  
password: Abc123

**Optional**

npm install  
bower update

**Kendo UI** 

This is a trial version of their product.
You'd need to purchase the full version if you want to use it commercially.