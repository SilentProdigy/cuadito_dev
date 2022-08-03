<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = $this->generateDummyProjects();

        $company = Company::first();

        foreach($projects as $project)
            $company->projects()->create($project);
    }

    public function generateDummyProjects()
    {
        $projects = [];

        for($i = 0; $i < 5; $i++)
        {
            $projects[] = [
                'title' => 'Project 000' . $i,
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure quibusdam rem eligendi repellat, a eum hic nostrum id recusandae, consectetur aperiam itaque exercitationem voluptatum rerum officia. Delectus omnis commodi ab libero modi quos atque fugiat nesciunt officiis ea voluptatem eius corporis, illum accusantium, cupiditate, debitis nostrum nam tenetur obcaecati rerum nulla. Adipisci est animi qui, consequatur iste quae, aut dignissimos amet dicta voluptatibus eveniet ut earum rem aliquid quaerat sit neque ipsa laboriosam magnam rerum. Explicabo iure veritatis alias illo. Totam, quae sint? Architecto delectus ab, provident alias dolorum officia, obcaecati, nulla distinctio nam accusamus officiis voluptatem iste molestias aspernatur!',
                'cost' => 150
            ];
        }

        return $projects;
    }
}
