<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storyblok\ManagementApi\Endpoints\SpaceApi;
use Storyblok\ManagementApi\Endpoints\UserApi;
use Storyblok\ManagementApi\ManagementApiClient;
use Symfony\Component\HttpClient\Exception\ClientException;
use function Termwind\{ask, render};

class SpaceList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:space-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List the spaces';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $token =  config('sb.personal_access_token');
        $client = new ManagementApiClient($token);

        try {
            $spaces = (new SpaceApi($client))->all()->data();
            $currentUser = (new UserApi($client))->me()->data();
            render(
                view('cli.title', [
                        'title' => "Spaces",
                ])->render()
            );
            $this->newLine();
            render(
                view('cli.spaces-table', [
                        'spaces' => $spaces,
                        'currentuserid' => $currentUser->id()
                ])->render()
            );


         } catch (ClientException $e) {
            echo "Error accessing to API: " . PHP_EOL;
            //echo $e->getResponse()->getContent(false);
            //echo PHP_EOL;
            echo $e->getMessage();
        }

    }
}
