<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storyblok\ManagementApi\Data\Space;
use Storyblok\ManagementApi\Endpoints\SpaceApi;
use Storyblok\ManagementApi\ManagementApiClient;

use function Termwind\render;

class MainMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storytool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Launch an interactive menu with fuzzy search';


    protected array $menu = [
        'Set Space ID'      => 'set-space',
        'Space List'      => 'sb:spaces',
        'Handle a space'      => 'sb:space',
        'Information about current user' => 'sb:whoami',
        'Clear Cache' => 'cache:clear',
        'Exit' => null,
    ];

    private ?string $spaceId = null;
    private ?Space $space = null;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->write(PHP_EOL.'  <fg=blue>
.d88888b    dP                                dP                     dP
88.    "    88                                88                     88
`Y88888b. d8888P .d8888b. 88d888b. dP    dP d8888P .d8888b. .d8888b. 88
      `8b   88   88:  `88 88:  `88 88    88   88   88:  `88 88:  `88 88
d8:   .8P   88   88.  .88 88       88.  .88   88   88.  .88 88.  .88 88
 Y88888P    dP   `88888P: dP       `8888P88   dP   `88888P: `88888P: dP
                                        .88
                                    d8888P    </>'.PHP_EOL.PHP_EOL);

        $this->info("=== Laravel Artisan Menu ===");
        $token =  config('sb.personal_access_token');
        $client = new ManagementApiClient($token);

        while (true) {

            if ($this->space) {
                render(
                    view('cli.label-value', [
                            'label' => "Selected Space ID",
                            'value' => $this->space->id()
                    ])
                );
                render(
                    view('cli.label-value', [
                            'label' => "Selected Space",
                            'value' => $this->space->name()
                    ])
                );

            }

            $choice = $this->choice(
                'Select an option:',
                array_keys($this->menu),
                0
            );

            if ($choice === 'Exit') {
                $this->info('Goodbye!');
                break;
            }

            $command = $this->menu[$choice];

            if ($command === 'set-space') {
                $spaceId = $this->ask('Enter Space ID');
                try {
                    $space = (new SpaceApi($client))->get($spaceId)->data();
                    $this->space = $space;

                    $this->info("Space ID set to: {$this->space->id()}");
                    $this->info("Space          : {$this->space->name()}");
                } catch (\Exception $e) {
                    $this->error("Space now valid for : {$spaceId}");
                    //$this->space = null;
                }

                continue;
            }

            if ($command) {
                $this->call($command);
            }
        }

        return 0;
    }

}
