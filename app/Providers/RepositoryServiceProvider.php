<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ProjectRepository::class, \App\Repositories\ProjectRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProjectMemberRepository::class, \App\Repositories\ProjectMemberRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProjectRoleRepository::class, \App\Repositories\ProjectRoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LabelRepository::class, \App\Repositories\LabelRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\IssueTypeRepository::class, \App\Repositories\IssueTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StatusRepository::class, \App\Repositories\StatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TaskStatusRepository::class, \App\Repositories\TaskStatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\IssueRepository::class, \App\Repositories\IssueRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TaskRepository::class, \App\Repositories\TaskRepositoryEloquent::class);
        //:end-bindings:
    }
}
