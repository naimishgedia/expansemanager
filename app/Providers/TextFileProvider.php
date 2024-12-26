<?php
namespace App\Providers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class TextFileProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
   public function boot()
    {
		
			// Listen for the user registered event
			Event::listen(Registered::class, function ($event)   {
            // Extract user data from the event
            $user = $event->user;
			
            // Prepare the data to write to the file
            $data = "Name: ".$user->name.", Email: ".$user->email."" . PHP_EOL;

            // Append the data to a text file in the storage folder
            Storage::append('RegisteredUsers.txt', $data);
        });
    }
}
