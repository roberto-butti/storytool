<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storyblok\ManagementApi\Endpoints\UserApi;
use Storyblok\ManagementApi\ManagementApiClient;
use Symfony\Component\HttpClient\Exception\ClientException;
use function Termwind\{ask, render};

class Whoami extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:whoami';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show infos of current user';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $token =  config('sb.personal_access_token');
        $client = new ManagementApiClient($token);

        try {
            $currentUser = (new UserApi($client))->me()->data();
            render(
                view('cli.title', [
                        'title' => "Who Am I",
                ])
            );
            $this->newLine();
            render(
                view('cli.label-value', [
                        'label' => "User ID",
                        'value' => $currentUser->id()
                ])
            );
            render(
                view('cli.label-value', [
                        'label' => "User identifier",
                        'value' => $currentUser->userid()
                ])
            );
            render(
                view('cli.label-value', [
                        'label' => "User email",
                        'value' => $currentUser->email()
                ])
            );
            render(
                view('cli.label-check', [
                        'label' => "User has Organization",
                        'value' => $currentUser->hasOrganization(),
                        'truevalue' => $currentUser->orgName(),
                        'falsevalue' => "NO ORG",
                ])
            );
            render(
                view('cli.label-check', [
                        'label' => "User has Partner Portal",
                        'value' => $currentUser->hasPartner(),
                        'truevalue' => "PARTNER PORTAL",
                        'falsevalue' => "NO PARTNER PORTAL",
                ])
            );


         } catch (ClientException $e) {
            echo "Error accessing to API: " . PHP_EOL;
            //echo $e->getResponse()->getContent(false);
            //echo PHP_EOL;
            echo $e->getMessage();
        }

    }
}
